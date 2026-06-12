<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$message_retour = '';
$type_retour    = '';

$upload_actu = __DIR__ . '/../uploads/actualites/';
if (!is_dir($upload_actu)) mkdir($upload_actu, 0755, true);

// ---- Suppression ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id  = (int)$_GET['delete'];
    $row = $db->prepare("SELECT image FROM actualites WHERE id=?");
    $row->execute([$id]);
    $data = $row->fetch();
    if ($data && !empty($data['image'])) {
        $p = $upload_actu . $data['image'];
        if (file_exists($p)) @unlink($p);
    }
    $db->prepare("DELETE FROM actualites WHERE id=?")->execute([$id]);
    header('Location: actualites.php?msg=supprime&type=success'); exit;
}

// ---- Toggle actif ----
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $db->prepare("UPDATE actualites SET actif = NOT actif WHERE id=?")->execute([(int)$_GET['toggle']]);
    header('Location: actualites.php?msg=toggle&type=success'); exit;
}

// ---- Ajout / Modif ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $message_retour = 'Erreur de sécurité. Veuillez réessayer.'; $type_retour = 'error';
    } else {
        $titre   = trim($_POST['titre']   ?? '');
        $contenu = trim($_POST['contenu'] ?? '');
        $edit_id = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

        if (!$titre) {
            $message_retour = 'Le titre est obligatoire.'; $type_retour = 'error';
        } else {
            $image_name = null;
            if (!empty($_FILES['image']['name'])) {
                $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg','jpeg','png','webp'];
                if (!in_array($ext, $allowed)) {
                    $message_retour = 'Format non supporté. Utilisez JPG, PNG ou WEBP.'; $type_retour = 'error';
                } elseif ($_FILES['image']['size'] > 3 * 1024 * 1024) {
                    $message_retour = 'L\'image ne doit pas dépasser 3 Mo.'; $type_retour = 'error';
                } else {
                    $image_name = 'actu_' . uniqid() . '.' . $ext;
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_actu . $image_name)) {
                        $image_name = null;
                        $message_retour = 'Erreur lors de l\'enregistrement de l\'image.'; $type_retour = 'error';
                    }
                }
            }

            if ($type_retour !== 'error') {
                if ($edit_id > 0) {
                    if ($image_name) {
                        $old = $db->prepare("SELECT image FROM actualites WHERE id=?");
                        $old->execute([$edit_id]);
                        $oldData = $old->fetch();
                        if ($oldData && !empty($oldData['image'])) {
                            $oldPath = $upload_actu . $oldData['image'];
                            if (file_exists($oldPath)) @unlink($oldPath);
                        }
                        $db->prepare("UPDATE actualites SET titre=?, contenu=?, image=? WHERE id=?")
                           ->execute([$titre, $contenu, $image_name, $edit_id]);
                    } else {
                        $db->prepare("UPDATE actualites SET titre=?, contenu=? WHERE id=?")
                           ->execute([$titre, $contenu, $edit_id]);
                    }
                    $message_retour = 'Actualité modifiée avec succès.'; $type_retour = 'success';
                } else {
                    $db->prepare("INSERT INTO actualites (titre, contenu, image, actif) VALUES (?,?,?,1)")
                       ->execute([$titre, $contenu, $image_name]);
                    $message_retour = 'Actualité publiée avec succès.'; $type_retour = 'success';
                }
            }
        }
    }
}

// Feedback depuis redirect
$msg_labels = [
    'supprime' => 'Actualité supprimée.',
    'toggle'   => 'Visibilité mise à jour.',
];
if (!$message_retour && isset($_GET['msg']) && isset($msg_labels[$_GET['msg']])) {
    $message_retour = $msg_labels[$_GET['msg']];
    $type_retour    = ($_GET['type'] ?? '') === 'success' ? 'success' : 'error';
}

// ---- Édition ----
$edit_data = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM actualites WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit_data = $stmt->fetch();
}

// ---- Liste ----
$actualites = $db->query("SELECT * FROM actualites ORDER BY created_at DESC")->fetchAll();

// Messages import
if (isset($_GET['msg'])) {
    $msgs = [
        'imported'  => '4 articles d\'exemple importés. Modifiez-les avec vos vraies informations et photos.',
        'notempty'  => 'Des actualités existent déjà. Videz la liste avant de réimporter.',
        'actu_btp'  => 'Article "Vision 2050 & BTP Sénégal" publié. Vous pouvez ajouter une photo via Modifier.',
    ];
    if (isset($msgs[$_GET['msg']])) {
        $message_retour = $msgs[$_GET['msg']];
        $type_retour    = $_GET['type'] ?? 'success';
    }
}

// ---- Auto-import si table vide ----
$count_actu = (int)$db->query("SELECT COUNT(*) FROM actualites")->fetchColumn();
if ($count_actu === 0) {
    $articles_defaut = [
        [
            "Le Sénégal bâtit son avenir : ce que la Vision 2050 change pour le secteur BTP",
            "Le Sénégal vit une décennie de transformation infrastructurelle sans précédent. Avec le lancement officiel de la Vision Sénégal 2050 et de son premier plan opérationnel — la Stratégie Nationale de Développement 2025-2029 — le pays s'engage dans un programme d'investissements publics estimé à 18 496 milliards de francs CFA sur cinq ans. Pour les entreprises du BTP, les opportunités sont massives, concrètes et déjà en marche.\n\nUn chantier national à l'échelle d'une génération\n\nHier encore, les entreprises de travaux publics sénégalaises opéraient sur des marchés fragmentés, dépendants de financements externes incertains. Aujourd'hui, le cadre a changé. Le gouvernement a inscrit dans son Masterplan 2025-2034 la réalisation de corridors routiers et ferroviaires structurants, l'extension de l'électrification rurale à l'ensemble du territoire, la construction de zones industrielles dans les pôles régionaux, et un programme ambitieux de logements sociaux — dont 60 000 unités en cours de livraison dans le cadre du programme des 100 000 logements.\n\nL'autoroute Mbour-Fatick-Kaolack, longue de 100 kilomètres, illustre à elle seule l'ampleur de cette dynamique : financée à hauteur de 738 millions d'euros, présentant un taux d'avancement supérieur à 90 % fin 2025, elle matérialise la volonté de désenclaver les régions productrices et de connecter le centre du pays aux corridors économiques côtiers.\n\nUn secteur BTP en pleine expansion\n\nLa Vision 2050 ne se limite pas aux autoroutes. Elle dessine un Sénégal où six corridors ferroviaires relient les pôles territoriaux, où les zones rurales accèdent à l'énergie grâce à des mini-réseaux solaires, où les villes secondaires disposent d'infrastructures sanitaires, scolaires et industrielles à la hauteur de leur potentiel. Le pôle urbain de Diamniadio — avec ses 40 000 logements planifiés — est déjà devenu le laboratoire grandeur nature de cette ambition.\n\nPour le secteur du BTP, cette trajectoire signifie une demande soutenue en génie civil, en travaux électriques haute et basse tension, en construction de routes et en réhabilitation d'ouvrages d'art. Les entreprises capables d'intervenir à grande échelle, avec rigueur technique et ancrage territorial, sont au cœur de cette révolution silencieuse.\n\nCOTRAC, acteur engagé dans la transformation du Sénégal\n\nDepuis 2015, COTRAC accompagne cette montée en puissance infrastructurelle depuis le terrain. Présente dans 14 régions du Sénégal — de Dakar à Tambacounda, de Saint-Louis à Ziguinchor —, l'entreprise intervient sur les quatre pôles stratégiques que la Vision 2050 place en priorité : ingénierie électrique (HTA, MT, BT), travaux routiers, génie civil et électrification rurale.\n\nPartenaire de SENELEC, d'AGEROUTE et de l'ONAS, COTRAC n'est pas un spectateur de cette transformation : elle en est un acteur de terrain, quotidien, engagé. Avec plus de 25 projets réalisés et une équipe formée aux exigences des marchés publics les plus complexes, COTRAC met son expertise au service du Sénégal qui se construit.\n\nVous avez un projet dans le cadre des grands chantiers nationaux ? Contactez-nous pour une étude gratuite sous 48h."
        ],
        [
            "COTRAC remporte un nouveau marché de voirie à Dakar",
            "COTRAC vient d'être retenu pour l'exécution des travaux de réhabilitation et d'élargissement d'un axe routier structurant dans la banlieue dakaroise. Ce chantier d'envergure mobilise nos équipes spécialisées en travaux publics ainsi qu'une partie significative de notre parc d'engins : pelles mécaniques Caterpillar, compacteurs et camions bennes.\n\nLes travaux portent sur une longueur de plusieurs kilomètres et incluent la pose de caniveaux, le reprofilage de la chaussée et l'installation d'éclairage public. Le délai d'exécution est fixé à 6 mois.\n\nCe marché confirme la confiance accordée à COTRAC par les maîtres d'ouvrage publics et renforce notre positionnement dans les travaux d'infrastructure au Sénégal."
        ],
        [
            "Livraison d'un poste de transformation HTA/BT — Région de Thiès",
            "COTRAC a réceptionné avec succès la construction et la mise en service d'un poste de transformation HTA/BT dans la région de Thiès. Ce projet s'inscrit dans le cadre de l'électrification rurale et a permis de connecter plusieurs villages au réseau électrique national.\n\nNos équipes de génie électrique ont assuré l'ensemble des opérations : génie civil, installation des cellules HTA préfabriquées EATON, pose du transformateur, raccordement BT et mise sous tension en coordination avec SENELEC.\n\nCOTRAC démontre une fois de plus sa capacité à intervenir sur des projets d'électrification complexes, de la conception à la mise en service."
        ],
        [
            "COTRAC au Salon BTP Sénégal 2025 — Rencontres et partenariats",
            "COTRAC a participé au Salon National du BTP qui s'est tenu à Dakar en 2025. Notre stand a accueilli de nombreux professionnels du secteur : architectes, bureaux d'études, promoteurs immobiliers et représentants de l'administration publique.\n\nCette participation a été l'occasion de présenter nos réalisations récentes, nos capacités techniques et notre parc matériel. Plusieurs contacts commerciaux prometteurs ont été établis, ouvrant la voie à de futurs partenariats stratégiques.\n\nCOTRAC réaffirme son engagement à rester un acteur de référence dans le secteur du BTP et des travaux publics au Sénégal."
        ],
        [
            "Chantier en cours : construction d'un complexe industriel à Thiès",
            "COTRAC est actuellement en pleine exécution d'un chantier de construction d'un complexe industriel dans la zone franche de Thiès. Ce projet ambitieux comprend la réalisation de plusieurs bâtiments industriels, la mise en place des réseaux techniques (électricité, eau, assainissement) et l'aménagement des voiries intérieures.\n\nUne équipe de 45 ouvriers et techniciens est mobilisée sur ce chantier, supervisée par nos ingénieurs en génie civil et électrique. Le planning prévoit une livraison partielle d'ici la fin du trimestre.\n\nCe projet illustre parfaitement l'approche multimétiers de COTRAC, capable de prendre en charge l'intégralité d'un projet industriel de A à Z."
        ],
    ];
    $stmt_ins = $db->prepare("INSERT INTO actualites (titre, contenu, image, actif) VALUES (?,?,?,1)");
    foreach ($articles_defaut as $art) {
        $stmt_ins->execute([$art[0], $art[1], '']);
    }
    $actualites = $db->query("SELECT * FROM actualites ORDER BY created_at DESC")->fetchAll();
    $message_retour = '5 articles publiés automatiquement. Modifiez-les avec vos vraies informations et photos.';
    $type_retour = 'success';
}

$nb_messages = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$current_page = 'actualites';
$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualités - Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
  <style>
    .actu-img-preview { height:60px; width:100px; object-fit:cover; border-radius:8px; border:1px solid #e2e8f0; }
    .actu-contenu-preview { font-size:.82rem; color:#718096; max-width:360px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
    textarea { resize:vertical; min-height:160px; font-family:inherit; }
  </style>
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>Actualités</h1>
      <div class="admin-topbar-actions">
        <a href="<?= SITE_URL ?>/actualites.php" target="_blank" class="btn-site">Voir la page</a>
        <button class="btn-primary" onclick="toggleForm()" id="btn-add-toggle" style="display:flex;align-items:center;gap:7px;padding:9px 20px;font-size:.875rem;">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          <?= $edit_data ? 'Modifier l\'article' : 'Nouvel article' ?>
        </button>
      </div>
    </div>

    <div class="admin-content">

      <?php if ($message_retour): ?>
      <div class="alert alert-<?= $type_retour === 'success' ? 'success' : 'error' ?>" style="margin-bottom:20px;">
        <?= e($message_retour) ?>
      </div>
      <?php endif; ?>

      <!-- ══ FORMULAIRE (masqué par défaut sauf si édition) ══ -->
      <div class="actu-form-wrap" id="actu-form-wrap" style="<?= $edit_data ? '' : 'display:none;' ?>">
        <div class="form-card" style="margin-bottom:24px;">
          <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
            <h2 style="margin:0;font-size:1.05rem;font-weight:700;color:#1a202c;">
              <?= $edit_data ? '✏️ Modifier l\'article' : '➕ Nouvel article' ?>
            </h2>
            <button type="button" onclick="toggleForm()" style="background:none;border:none;font-size:1.3rem;cursor:pointer;color:#a0aec0;line-height:1;">✕</button>
          </div>
          <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
            <?php if ($edit_data): ?>
            <input type="hidden" name="edit_id" value="<?= (int)$edit_data['id'] ?>">
            <?php endif; ?>

            <div class="form-group" style="margin-bottom:16px;">
              <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">Titre *</label>
              <input type="text" name="titre" value="<?= e($edit_data['titre'] ?? '') ?>"
                     placeholder="Ex : COTRAC remporte un nouveau marché à Thiès" required
                     style="width:100%;border:1.5px solid #e2e8f0;border-radius:8px;padding:10px 14px;font-size:.9rem;font-family:inherit;box-sizing:border-box;">
            </div>

            <div class="form-group" style="margin-bottom:16px;">
              <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">Contenu</label>
              <textarea name="contenu" placeholder="Rédigez le contenu de l'actualité..."
                        style="width:100%;border:1.5px solid #e2e8f0;border-radius:8px;padding:10px 14px;font-size:.88rem;font-family:inherit;min-height:200px;resize:vertical;box-sizing:border-box;"><?= e($edit_data['contenu'] ?? '') ?></textarea>
              <span style="font-size:.73rem;color:#a0aec0;margin-top:4px;display:block;">Séparez les paragraphes par une ligne vide. Les titres de section courts seront mis en valeur automatiquement.</span>
            </div>

            <div class="form-group" style="margin-bottom:20px;">
              <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:6px;">Image <?= $edit_data ? '(laisser vide pour conserver)' : '(optionnelle)' ?></label>
              <?php if (!empty($edit_data['image'])): ?>
              <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($edit_data['image']) ?>"
                   style="height:80px;width:160px;object-fit:cover;border-radius:8px;margin-bottom:8px;display:block;">
              <?php endif; ?>
              <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                     style="border:1.5px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.875rem;width:100%;box-sizing:border-box;">
              <span style="font-size:.73rem;color:#a0aec0;margin-top:4px;display:block;">JPG, PNG ou WebP — max 3 Mo</span>
            </div>

            <div style="display:flex;gap:12px;align-items:center;">
              <button type="submit" class="btn-primary">
                <?= $edit_data ? 'Enregistrer les modifications' : 'Publier l\'article' ?>
              </button>
              <button type="button" onclick="toggleForm()" class="btn-secondary">Annuler</button>
            </div>
          </form>
        </div>
      </div>

      <!-- ══ LISTE ARTICLES ══ -->
      <div class="form-card" style="padding:20px 24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
          <h3 style="margin:0;font-size:1rem;font-weight:700;color:#1a202c;">
            Articles publiés <span style="font-size:.78rem;color:#a0aec0;font-weight:500;margin-left:6px;"><?= count($actualites) ?> article(s)</span>
          </h3>
        </div>

        <?php if (empty($actualites)): ?>
        <div style="text-align:center;padding:40px 20px;color:#a0aec0;">
          <div style="font-size:2.5rem;margin-bottom:12px;">📰</div>
          <p style="margin:0 0 20px;font-size:.9rem;">Aucun article pour le moment.</p>
          <button onclick="toggleForm()" class="btn-primary" style="font-size:.85rem;padding:10px 22px;">Créer le premier article</button>
        </div>

        <?php else: ?>
        <div style="display:flex;flex-direction:column;gap:14px;">
          <?php foreach ($actualites as $a):
            $has_img = !empty($a['image']);
            $mois_fr = ['January'=>'janvier','February'=>'février','March'=>'mars','April'=>'avril',
                        'May'=>'mai','June'=>'juin','July'=>'juillet','August'=>'août',
                        'September'=>'septembre','October'=>'octobre','November'=>'novembre','December'=>'décembre'];
            $date_fmt = strtr(date('d F Y', strtotime($a['created_at'])), $mois_fr);
            $extrait  = mb_strimwidth(strip_tags($a['contenu']), 0, 120, '…');
          ?>
          <div style="display:flex;gap:16px;align-items:flex-start;padding:16px;border-radius:12px;border:1.5px solid <?= $a['actif'] ? '#e2e8f0' : '#fde8e8' ?>;background:<?= $a['actif'] ? '#fff' : '#fffafa' ?>;">

            <!-- Vignette -->
            <div style="flex-shrink:0;width:90px;height:64px;border-radius:8px;overflow:hidden;background:#f0f4f8;">
              <?php if ($has_img): ?>
              <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($a['image']) ?>"
                   style="width:100%;height:100%;object-fit:cover;" alt="">
              <?php else: ?>
              <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#cbd5e0;font-size:1.4rem;">📰</div>
              <?php endif; ?>
            </div>

            <!-- Infos -->
            <div style="flex:1;min-width:0;">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;flex-wrap:wrap;">
                <strong style="font-size:.9rem;color:#1a202c;line-height:1.3;"><?= e($a['titre']) ?></strong>
                <span style="font-size:.7rem;font-weight:700;padding:2px 9px;border-radius:20px;<?= $a['actif'] ? 'background:#f0fff4;color:#276749;' : 'background:#fff5f5;color:#c53030;' ?>">
                  <?= $a['actif'] ? 'Publiée' : 'Masquée' ?>
                </span>
              </div>
              <p style="margin:0 0 6px;font-size:.8rem;color:#718096;line-height:1.5;"><?= e($extrait) ?></p>
              <span style="font-size:.73rem;color:#a0aec0;"><?= e($date_fmt) ?></span>
            </div>

            <!-- Actions -->
            <div style="flex-shrink:0;display:flex;flex-wrap:wrap;gap:6px;align-items:center;justify-content:flex-end;max-width:220px;">
              <a href="actualites.php?edit=<?= (int)$a['id'] ?>" onclick="showForm()"
                 style="display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:6px;background:#eef2ff;color:#4f46e5;font-size:.75rem;font-weight:600;text-decoration:none;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
              </a>
              <a href="actualites.php?toggle=<?= (int)$a['id'] ?>"
                 style="display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:6px;background:#f0f7ff;color:#1a6bb5;font-size:.75rem;font-weight:600;text-decoration:none;"
                 onclick="return confirm('Changer la visibilité ?')">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                <?= $a['actif'] ? 'Masquer' : 'Afficher' ?>
              </a>
              <a href="<?= SITE_URL ?>/actualite.php?id=<?= (int)$a['id'] ?>" target="_blank"
                 style="display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:6px;background:#f0fff4;color:#276749;font-size:.75rem;font-weight:600;text-decoration:none;">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Voir
              </a>
              <a href="actualites.php?delete=<?= (int)$a['id'] ?>"
                 style="display:inline-flex;align-items:center;gap:4px;padding:5px 11px;border-radius:6px;background:#fff5f5;color:#e53e3e;font-size:.75rem;font-weight:600;text-decoration:none;"
                 onclick="return confirm('Supprimer définitivement ?')">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                Suppr.
              </a>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

    </div>
  </main>
</div>

<style>
.form-card { background:#fff;border-radius:14px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:28px; }
.btn-primary { background:#1a6bb5;color:#fff;border:none;border-radius:8px;padding:10px 22px;font-size:.875rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:7px;text-decoration:none; }
.btn-primary:hover { background:#1558a0; }
.btn-secondary { background:#f7f8fa;color:#4a5568;border:1.5px solid #e2e8f0;border-radius:8px;padding:9px 18px;font-size:.875rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block; }
.actu-form-wrap { animation: slideDown .2s ease; }
@keyframes slideDown { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }
</style>

<script>
function toggleForm() {
  var wrap = document.getElementById('actu-form-wrap');
  var btn  = document.getElementById('btn-add-toggle');
  if (wrap.style.display === 'none') {
    wrap.style.display = 'block';
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Fermer';
    wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
  } else {
    wrap.style.display = 'none';
    btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg> Nouvel article';
  }
}
function showForm() {
  document.getElementById('actu-form-wrap').style.display = 'block';
}
<?php if ($edit_data): ?>
document.getElementById('btn-add-toggle').innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg> Fermer';
<?php endif; ?>
</script>

<?php require_once 'includes/footer.php'; ?>
</body>
</html>
