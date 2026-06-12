<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();

// Migration automatique
try {
    $db->exec("CREATE TABLE IF NOT EXISTS equipements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        categorie VARCHAR(50) NOT NULL DEFAULT 'engins',
        nom VARCHAR(200) NOT NULL,
        description VARCHAR(300) DEFAULT '',
        quantite VARCHAR(50) DEFAULT '',
        couleur VARCHAR(20) DEFAULT '#1a6bb5',
        sort_order INT DEFAULT 0,
        actif TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    try { $db->exec("ALTER TABLE equipements ADD COLUMN image VARCHAR(300) DEFAULT '' AFTER couleur"); } catch (Exception $e) {}
} catch (Exception $e) {}

$message = '';
$type_msg = '';

$categories = [
    'engins'     => ['label' => 'Engins TP',                  'couleur' => '#1a6bb5'],
    'vehicules'  => ['label' => 'Véhicules & Transport',       'couleur' => '#f7941d'],
    'electrique' => ['label' => 'Prestations Électriques',     'couleur' => '#27ae60'],
    'industriel' => ['label' => 'Génie Industriel & Soudure',  'couleur' => '#8e44ad'],
];

// ---- Suppression ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->prepare("DELETE FROM equipements WHERE id=?")->execute([(int)$_GET['delete']]);
    $message = 'Équipement supprimé.';
    $type_msg = 'success';
}

// ---- Toggle actif ----
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $db->prepare("UPDATE equipements SET actif = NOT actif WHERE id=?")->execute([(int)$_GET['toggle']]);
    $message = 'Visibilité mise à jour.';
    $type_msg = 'success';
}

// ---- Ajout / Modification ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $message = 'Erreur de sécurité.';
        $type_msg = 'error';
    } else {
        $nom         = trim($_POST['nom'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $quantite    = trim($_POST['quantite'] ?? '');
        $categorie   = array_key_exists($_POST['categorie'] ?? '', $categories) ? $_POST['categorie'] : 'engins';
        $couleur     = $categories[$categorie]['couleur'];
        $edit_id     = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

        // Gestion upload photo
        $image_name = null;
        if (!empty($_FILES['photo']['name'])) {
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','webp']) && $_FILES['photo']['size'] <= 3*1024*1024) {
                $upload_dir = __DIR__ . '/../uploads/equipements/';
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
                $image_name = 'eq_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $image_name);
            } else {
                $message = 'Format ou taille invalide (max 3 Mo, JPG/PNG/WebP).';
                $type_msg = 'error';
            }
        }

        if (!$nom) {
            $message = 'Le nom est obligatoire.';
            $type_msg = 'error';
        } elseif ($edit_id) {
            if ($image_name) {
                $db->prepare("UPDATE equipements SET nom=?, description=?, quantite=?, categorie=?, couleur=?, image=? WHERE id=?")
                   ->execute([$nom, $description, $quantite, $categorie, $couleur, $image_name, $edit_id]);
            } else {
                $db->prepare("UPDATE equipements SET nom=?, description=?, quantite=?, categorie=?, couleur=? WHERE id=?")
                   ->execute([$nom, $description, $quantite, $categorie, $couleur, $edit_id]);
            }
            $message = 'Équipement mis à jour.';
            $type_msg = 'success';
        } else {
            $max = (int)$db->query("SELECT MAX(sort_order) FROM equipements")->fetchColumn();
            $db->prepare("INSERT INTO equipements (nom, description, quantite, categorie, couleur, image, sort_order) VALUES (?,?,?,?,?,?,?)")
               ->execute([$nom, $description, $quantite, $categorie, $couleur, $image_name ?? '', $max + 1]);
            $message = 'Équipement ajouté.';
            $type_msg = 'success';
        }
    }
}

// ---- Charger l'équipement à éditer ----
$edit_item = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM equipements WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit_item = $stmt->fetch();
}

// ---- Liste par catégorie ----
$equip_all = $db->query("SELECT * FROM equipements ORDER BY categorie, sort_order ASC, id ASC")->fetchAll();
$by_cat = [];
foreach ($equip_all as $eq) {
    $by_cat[$eq['categorie']][] = $eq;
}

// ---- Galerie : migration + chargement ----
try {
    $db->exec("CREATE TABLE IF NOT EXISTS galerie_photos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fichier VARCHAR(300) NOT NULL,
        legende VARCHAR(300) DEFAULT '',
        onglet VARCHAR(50) DEFAULT 'btp',
        couleur VARCHAR(20) DEFAULT '#1a6bb5',
        sort_order INT DEFAULT 0,
        actif TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (Exception $e) {}

$galerie_edit = null;
if (isset($_GET['gedit']) && is_numeric($_GET['gedit'])) {
    $stmt = $db->prepare("SELECT * FROM galerie_photos WHERE id=?");
    $stmt->execute([(int)$_GET['gedit']]);
    $galerie_edit = $stmt->fetch();
}
$galerie_all = $db->query("SELECT * FROM galerie_photos ORDER BY sort_order ASC, id ASC")->fetchAll();
$gal_count   = count($galerie_all);

$nb_messages = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$current_page = 'equipements';
$csrf = csrf_token();
$active_tab = $_GET['tab'] ?? 'equipements';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Équipements — Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
  <style>
    .eq-table { width:100%;border-collapse:collapse;font-size:.875rem; }
    .eq-table th { background:#f8fafd;padding:10px 14px;text-align:left;font-weight:600;color:#4a5568;border-bottom:2px solid #e2e8f0; }
    .eq-table td { padding:10px 14px;border-bottom:1px solid #f0f4f8;vertical-align:middle; }
    .eq-table tr:hover td { background:#fafbff; }
    .eq-table tr.inactive td { opacity:.5; }
    .cat-badge { display:inline-block;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:700;color:#fff; }
    .qty-badge { display:inline-block;padding:3px 10px;border-radius:20px;font-size:.75rem;font-weight:600;background:#eef2ff;color:#4f46e5; }
    .btn-sm { padding:5px 12px;border-radius:6px;font-size:.78rem;font-weight:600;cursor:pointer;border:none;text-decoration:none;display:inline-block; }
    .btn-edit { background:#eef2ff;color:#4f46e5; }
    .btn-edit:hover { background:#e0e7ff; }
    .btn-del { background:#fff5f5;color:#e53e3e; }
    .btn-del:hover { background:#fed7d7; }
    .btn-toggle { background:#f0fff4;color:#276749; }
    .btn-toggle.off { background:#fff5f5;color:#c53030; }
    .form-card { background:#fff;border-radius:14px;padding:28px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:28px; }
    .form-grid { display:grid;grid-template-columns:1fr 1fr;gap:16px; }
    .form-group { display:flex;flex-direction:column;gap:6px; }
    .form-group label { font-size:.82rem;font-weight:600;color:#4a5568; }
    .form-group input, .form-group select, .form-group textarea { border:1.5px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:.875rem;font-family:inherit;transition:border-color .2s; }
    .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline:none;border-color:#1a6bb5; }
    .form-full { grid-column:1/-1; }
    .cat-section-title { display:flex;align-items:center;gap:10px;margin:32px 0 12px; }
    .cat-dot { width:12px;height:12px;border-radius:50%;flex-shrink:0; }
    .cat-count { font-size:.78rem;color:#a0aec0;font-weight:500; }
    .empty-cat { color:#a0aec0;font-size:.85rem;padding:20px 0;text-align:center;font-style:italic; }
    .alert { padding:12px 18px;border-radius:10px;margin-bottom:20px;font-size:.875rem;font-weight:500; }
    .alert.success { background:#f0fff4;color:#276749;border:1px solid #c6f6d5; }
    .alert.error { background:#fff5f5;color:#c53030;border:1px solid #fed7d7; }
    .btn-primary { background:#1a6bb5;color:#fff;border:none;border-radius:8px;padding:10px 22px;font-size:.875rem;font-weight:600;cursor:pointer; }
    .btn-primary:hover { background:#1558a0; }
    .btn-secondary { background:#f7f8fa;color:#4a5568;border:1.5px solid #e2e8f0;border-radius:8px;padding:9px 18px;font-size:.875rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block; }
    .import-note { background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 18px;font-size:.82rem;color:#92400e;margin-bottom:24px; }
    /* Onglets */
    .page-tabs { display:flex;gap:4px;margin-bottom:28px;background:#f0f4f8;border-radius:12px;padding:4px; }
    .page-tab { padding:9px 22px;border-radius:9px;font-size:.875rem;font-weight:600;cursor:pointer;border:none;background:transparent;color:#718096;text-decoration:none; }
    .page-tab.active { background:#fff;color:#1a6bb5;box-shadow:0 1px 6px rgba(0,0,0,.1); }
    .page-tab:hover:not(.active) { color:#1a202c; }
    /* Galerie admin */
    .gal-grid-admin { display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-top:12px; }
    .gal-card-admin { background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 1px 6px rgba(0,0,0,.07);border:1.5px solid #e2e8f0;transition:box-shadow .2s; }
    .gal-card-admin:hover { box-shadow:0 4px 16px rgba(0,0,0,.12); }
    .gal-card-admin.inactive { opacity:.5; }
    .gal-card-admin img { width:100%;height:130px;object-fit:cover;display:block; }
    .gal-card-body { padding:10px 12px; }
    .gal-card-legend { font-size:.82rem;font-weight:600;color:#1a202c;margin-bottom:4px;line-height:1.3; }
    .gal-card-onglet { display:inline-block;padding:2px 9px;border-radius:20px;font-size:.7rem;font-weight:700;color:#fff;margin-bottom:8px; }
    .gal-card-actions { display:flex;gap:6px;flex-wrap:wrap; }
    .gal-no-photo { width:100%;height:130px;background:#f0f4f8;display:flex;align-items:center;justify-content:center;color:#a0aec0;font-size:.75rem; }
  </style>
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1><?= $active_tab === 'galerie' ? 'Galerie Photos' : 'Gestion des Équipements' ?></h1>
      <div class="admin-topbar-actions">
        <a href="<?= SITE_URL ?>/nos-ressources.php" target="_blank" class="btn-site">Voir la page</a>
      </div>
    </div>

    <div class="admin-content">

      <!-- Onglets -->
      <div class="page-tabs">
        <a href="equipements.php?tab=equipements" class="page-tab <?= $active_tab === 'equipements' ? 'active' : '' ?>">Équipements</a>
        <a href="equipements.php?tab=galerie" class="page-tab <?= $active_tab === 'galerie' ? 'active' : '' ?>">Galerie Photos <span style="font-size:.72rem;background:#1a6bb5;color:#fff;border-radius:20px;padding:1px 7px;margin-left:4px;"><?= $gal_count ?></span></a>
      </div>

      <?php if ($message): ?>
      <div class="alert <?= $type_msg ?>"><?= e($message) ?></div>
      <?php endif; ?>

      <?php if ($active_tab === 'galerie'): ?>
      <!-- ══════════════ ONGLET GALERIE ══════════════ -->

      <?php
      $gal_msg = '';
      if (isset($_GET['msg'])) {
          $msgs = ['added'=>'Photo ajoutée.','updated'=>'Photo modifiée.','deleted'=>'Photo supprimée.','toggled'=>'Visibilité mise à jour.','imported'=>'24 photos importées depuis les données par défaut.'];
          $gal_msg = $msgs[$_GET['msg']] ?? '';
      }
      if (isset($_GET['err'])) {
          $errs = ['nophoto'=>'Veuillez sélectionner une photo.','notempty'=>'La galerie contient déjà des photos. Videz-la d\'abord pour réimporter.'];
          $gal_msg = $errs[$_GET['err']] ?? 'Erreur.';
      }
      ?>
      <?php if ($gal_msg): ?>
      <div class="alert <?= isset($_GET['err']) ? 'error' : 'success' ?>"><?= e($gal_msg) ?></div>
      <?php endif; ?>

      <!-- Import si vide -->
      <?php if ($gal_count === 0): ?>
      <div class="import-note">
        ℹ️ La galerie est vide. Cliquez sur <strong>Importer les 24 photos par défaut</strong> pour charger les photos existantes du site.
        <form method="post" action="ajax/import-galerie.php" style="display:inline;margin-left:12px;">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <button type="submit" class="btn-sm btn-edit">Importer les 24 photos par défaut</button>
        </form>
      </div>
      <?php endif; ?>

      <!-- Formulaire ajout / édition galerie -->
      <div class="form-card">
        <h2 style="margin:0 0 20px;font-size:1.05rem;font-weight:700;color:#1a202c;">
          <?= $galerie_edit ? '✏️ Modifier la photo' : '➕ Ajouter une photo' ?>
        </h2>
        <form method="post" enctype="multipart/form-data"
              action="ajax/galerie-action.php?action=<?= $galerie_edit ? 'edit' : 'add' ?>">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <?php if ($galerie_edit): ?>
          <input type="hidden" name="edit_id" value="<?= $galerie_edit['id'] ?>">
          <?php endif; ?>

          <div class="form-grid">
            <div class="form-group">
              <label>Onglet / Catégorie</label>
              <select name="onglet">
                <?php foreach (['engins'=>'Engins & Véhicules','btp'=>'BTP & Travaux','logistique'=>'Logistique'] as $k=>$l): ?>
                <option value="<?= $k ?>" <?= ($galerie_edit['onglet'] ?? 'btp') === $k ? 'selected' : '' ?>><?= $l ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Légende</label>
              <input type="text" name="legende" maxlength="300"
                     value="<?= e($galerie_edit['legende'] ?? '') ?>"
                     placeholder="Ex : Chargeur COTRAC en opération">
            </div>
            <div class="form-group form-full">
              <label>Photo <?= $galerie_edit ? '(laisser vide pour conserver l\'actuelle)' : '*' ?></label>
              <?php if (!empty($galerie_edit['fichier'])):
                $gurl = str_starts_with($galerie_edit['fichier'], 'assets/') ? SITE_URL.'/'.$galerie_edit['fichier'] : SITE_URL.'/uploads/galerie/'.$galerie_edit['fichier'];
              ?>
              <img src="<?= e($gurl) ?>" style="height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;">
              <?php endif; ?>
              <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                     style="border:1.5px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.875rem;">
              <span style="font-size:.75rem;color:#a0aec0;margin-top:4px;">JPG, PNG ou WebP — max 5 Mo</span>
            </div>
          </div>

          <div style="display:flex;gap:12px;margin-top:20px;">
            <button type="submit" class="btn-primary">
              <?= $galerie_edit ? 'Enregistrer les modifications' : 'Ajouter la photo' ?>
            </button>
            <?php if ($galerie_edit): ?>
            <a href="equipements.php?tab=galerie" class="btn-secondary">Annuler</a>
            <?php endif; ?>
          </div>
        </form>
      </div>

      <!-- Grille photos -->
      <div class="form-card" style="padding:20px 24px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
          <h3 style="margin:0;font-size:1rem;font-weight:700;color:#1a202c;">
            Photos en ligne <span class="cat-count"><?= $gal_count ?> photo(s)</span>
          </h3>
        </div>

        <?php if (empty($galerie_all)): ?>
        <div class="empty-cat">Aucune photo. Importez les données par défaut ou ajoutez une photo ci-dessus.</div>
        <?php else: ?>
        <div class="gal-grid-admin">
          <?php
          $onglet_labels = ['engins'=>'Engins & Véhicules','btp'=>'BTP & Travaux','logistique'=>'Logistique'];
          $onglet_colors = ['engins'=>'#1a6bb5','btp'=>'#f7941d','logistique'=>'#8e44ad'];
          foreach ($galerie_all as $gp):
            $gp_url = str_starts_with($gp['fichier'], 'assets/') ? SITE_URL.'/'.$gp['fichier'] : SITE_URL.'/uploads/galerie/'.$gp['fichier'];
            $ocol = $onglet_colors[$gp['onglet']] ?? '#1a6bb5';
            $olbl = $onglet_labels[$gp['onglet']] ?? $gp['onglet'];
          ?>
          <div class="gal-card-admin <?= !$gp['actif'] ? 'inactive' : '' ?>">
            <img src="<?= e($gp_url) ?>" alt="<?= e($gp['legende']) ?>" loading="lazy"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
            <div class="gal-no-photo" style="display:none;">Image introuvable</div>
            <div class="gal-card-body">
              <span class="gal-card-onglet" style="background:<?= $ocol ?>;"><?= $olbl ?></span>
              <div class="gal-card-legend"><?= e($gp['legende']) ?: '<em style="color:#a0aec0;">Sans légende</em>' ?></div>
              <div class="gal-card-actions">
                <a href="equipements.php?tab=galerie&gedit=<?= $gp['id'] ?>" class="btn-sm btn-edit">Modifier</a>
                <a href="ajax/galerie-action.php?action=toggle&id=<?= $gp['id'] ?>&csrf_token=<?= urlencode($csrf) ?>"
                   class="btn-sm btn-toggle <?= !$gp['actif'] ? 'off' : '' ?>"
                   onclick="return confirm('Changer la visibilité ?')">
                  <?= $gp['actif'] ? 'Masquer' : 'Afficher' ?>
                </a>
                <a href="ajax/galerie-action.php?action=delete&id=<?= $gp['id'] ?>&csrf_token=<?= urlencode($csrf) ?>"
                   class="btn-sm btn-del"
                   onclick="return confirm('Supprimer cette photo ?')">Supprimer</a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>

      <?php else: ?>
      <!-- ══════════════ ONGLET ÉQUIPEMENTS ══════════════ -->

      <?php if (isset($_GET['synced'])): ?>
      <div class="alert success"><?= (int)$_GET['synced'] ?> équipement(s) associés aux photos existantes.</div>
      <?php endif; ?>

      <!-- Bouton corriger section électrique -->
      <?php $has_electrique = (int)$db->query("SELECT COUNT(*) FROM equipements WHERE categorie='electrique'")->fetchColumn() > 0; ?>
      <?php if ($has_electrique): ?>
      <div style="background:#fff8e1;border:1px solid #f6d860;border-radius:10px;padding:14px 18px;margin-bottom:18px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
        <div>
          <strong style="color:#b7791f;">⚠️ Section Électrique à corriger</strong>
          <p style="margin:4px 0 0;font-size:.82rem;color:#4a5568;">Déplace le Groupe électrogène 15 KVA dans Engins TP et supprime les 7 prestations électriques.</p>
        </div>
        <form method="post" action="ajax/fix-equipements-electrique.php" style="margin:0;">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <button type="submit" class="btn-sm" style="padding:8px 18px;background:#d97706;color:#fff;border:none;border-radius:6px;cursor:pointer;" onclick="return confirm('Supprimer les prestations électriques et déplacer le groupe électrogène ?')">Corriger section électrique</button>
        </form>
      </div>
      <?php endif; ?>

      <!-- Bouton sync photos -->
      <div style="background:#f0f7ff;border:1px solid #bee3f8;border-radius:10px;padding:14px 18px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
        <div>
          <strong style="color:#1a6bb5;">📷 Synchroniser les photos existantes</strong>
          <p style="margin:4px 0 0;font-size:.82rem;color:#4a5568;">Associe automatiquement les photos de la galerie (assets/ressources/) aux équipements correspondants.</p>
        </div>
        <form method="post" action="ajax/sync-equipements-photos.php" style="margin:0;">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <button type="submit" class="btn-sm btn-edit" style="padding:8px 18px;">Synchroniser les photos</button>
        </form>
      </div>

      <?php
      // Vérifier si la table est vide → proposer import
      $count = (int)$db->query("SELECT COUNT(*) FROM equipements")->fetchColumn();
      if ($count === 0):
      ?>
      <div class="import-note">
        ℹ️ La table est vide. Cliquez sur <strong>Importer les données par défaut</strong> pour charger les équipements actuels du site.
        <form method="post" action="ajax/import-equipements.php" style="display:inline;margin-left:12px;">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <button type="submit" class="btn-sm btn-edit">Importer les données par défaut</button>
        </form>
      </div>
      <?php endif; ?>

      <!-- ══ FORMULAIRE ══ -->
      <div class="form-card">
        <h2 style="margin:0 0 20px;font-size:1.05rem;font-weight:700;color:#1a202c;">
          <?= $edit_item ? '✏️ Modifier l\'équipement' : '➕ Ajouter un équipement' ?>
        </h2>
        <form method="post" enctype="multipart/form-data" action="equipements.php<?= $edit_item ? '?edit='.$edit_item['id'] : '' ?>">
          <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
          <?php if ($edit_item): ?>
          <input type="hidden" name="edit_id" value="<?= $edit_item['id'] ?>">
          <?php endif; ?>

          <div class="form-grid">
            <div class="form-group">
              <label>Nom de l'équipement *</label>
              <input type="text" name="nom" required maxlength="200"
                     value="<?= e($edit_item['nom'] ?? '') ?>"
                     placeholder="Ex : Pelle mécanique Caterpillar 325C">
            </div>
            <div class="form-group">
              <label>Quantité</label>
              <input type="text" name="quantite" maxlength="50"
                     value="<?= e($edit_item['quantite'] ?? '') ?>"
                     placeholder="Ex : 2 unités  (laisser vide si non défini)">
            </div>
            <div class="form-group">
              <label>Catégorie</label>
              <select name="categorie">
                <?php foreach ($categories as $key => $cat): ?>
                <option value="<?= $key ?>" <?= ($edit_item['categorie'] ?? 'engins') === $key ? 'selected' : '' ?>>
                  <?= e($cat['label']) ?>
                </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Description courte</label>
              <input type="text" name="description" maxlength="300"
                     value="<?= e($edit_item['description'] ?? '') ?>"
                     placeholder="Ex : Terrassement & excavation">
            </div>
            <div class="form-group form-full">
              <label>Photo (optionnelle)</label>
              <?php if (!empty($edit_item['image'])):
                $ei_url = str_starts_with($edit_item['image'], 'assets/') || str_starts_with($edit_item['image'], 'uploads/')
                    ? SITE_URL . '/' . $edit_item['image']
                    : SITE_URL . '/uploads/equipements/' . $edit_item['image'];
              ?>
              <img src="<?= e($ei_url) ?>"
                   style="height:80px;object-fit:cover;border-radius:8px;margin-bottom:8px;">
              <?php endif; ?>
              <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                     style="border:1.5px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.875rem;">
              <span style="font-size:.75rem;color:#a0aec0;margin-top:4px;">JPG, PNG ou WebP — max 3 Mo</span>
            </div>
          </div>

          <div style="display:flex;gap:12px;margin-top:20px;align-items:center;">
            <button type="submit" class="btn-primary">
              <?= $edit_item ? 'Enregistrer les modifications' : 'Ajouter l\'équipement' ?>
            </button>
            <?php if ($edit_item): ?>
            <a href="equipements.php" class="btn-secondary">Annuler</a>
            <?php endif; ?>
          </div>
        </form>
      </div>

      <!-- ══ LISTE PAR CATÉGORIE ══ -->
      <?php foreach ($categories as $ckey => $cmeta):
        $items = $by_cat[$ckey] ?? [];
      ?>
      <div class="form-card" style="padding:20px 24px;">
        <div class="cat-section-title">
          <div class="cat-dot" style="background:<?= $cmeta['couleur'] ?>;"></div>
          <h3 style="margin:0;font-size:1rem;font-weight:700;color:#1a202c;"><?= e($cmeta['label']) ?></h3>
          <span class="cat-count"><?= count($items) ?> équipement(s)</span>
        </div>

        <?php if (empty($items)): ?>
        <div class="empty-cat">Aucun équipement dans cette catégorie.</div>
        <?php else: ?>
        <table class="eq-table">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Nom</th>
              <th>Description</th>
              <th>Quantité</th>
              <th>Statut</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($items as $eq): ?>
            <tr class="<?= !$eq['actif'] ? 'inactive' : '' ?>">
              <td>
                <?php if (!empty($eq['image'])):
                  $li_url = str_starts_with($eq['image'], 'assets/') || str_starts_with($eq['image'], 'uploads/')
                      ? SITE_URL . '/' . $eq['image']
                      : SITE_URL . '/uploads/equipements/' . $eq['image'];
                ?>
                <img src="<?= e($li_url) ?>"
                     style="width:52px;height:40px;object-fit:cover;border-radius:6px;">
                <?php else: ?>
                <div style="width:52px;height:40px;background:#f0f4f8;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#cbd5e0;font-size:.7rem;">—</div>
                <?php endif; ?>
              </td>
              <td><strong><?= e($eq['nom']) ?></strong></td>
              <td style="color:#718096;"><?= e($eq['description']) ?></td>
              <td>
                <?php if ($eq['quantite']): ?>
                <span class="qty-badge" style="background:<?= e($eq['couleur']) ?>18;color:<?= e($eq['couleur']) ?>;">
                  <?= e($eq['quantite']) ?>
                </span>
                <?php else: ?>
                <span style="color:#cbd5e0;font-size:.78rem;">—</span>
                <?php endif; ?>
              </td>
              <td>
                <span style="font-size:.78rem;font-weight:600;color:<?= $eq['actif'] ? '#276749' : '#c53030' ?>;">
                  <?= $eq['actif'] ? 'Visible' : 'Masqué' ?>
                </span>
              </td>
              <td style="white-space:nowrap;display:flex;gap:6px;">
                <a href="equipements.php?edit=<?= $eq['id'] ?>" class="btn-sm btn-edit">Modifier</a>
                <a href="equipements.php?toggle=<?= $eq['id'] ?>"
                   class="btn-sm btn-toggle <?= !$eq['actif'] ? 'off' : '' ?>"
                   onclick="return confirm('Changer la visibilité ?')">
                  <?= $eq['actif'] ? 'Masquer' : 'Afficher' ?>
                </a>
                <a href="equipements.php?delete=<?= $eq['id'] ?>" class="btn-sm btn-del"
                   onclick="return confirm('Supprimer cet équipement ?')">Supprimer</a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>

      <?php endif; // fin if galerie / else equipements ?>

    </div>
  </main>
</div>
<?php require_once 'includes/footer.php'; ?>
</body>
</html>
