<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$message_retour = '';
$type_retour    = '';

$poles_labels = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie'];
$poles_colors = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad'];

// ---- Suppression ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Récupérer l'image avant suppression
    $imgRow = $db->prepare("SELECT image FROM projets WHERE id=?");
    $imgRow->execute([$id]);
    $imgData = $imgRow->fetch();
    if ($imgData && !empty($imgData['image'])) {
        $imgPath = UPLOAD_DIR . $imgData['image'];
        if (file_exists($imgPath)) @unlink($imgPath);
    }
    $stmt = $db->prepare("DELETE FROM projets WHERE id=?");
    $stmt->execute([$id]);
    $message_retour = 'Projet supprimé avec succès.';
    $type_retour = 'success';
}

// ---- Toggle visibilité ----
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    $db->prepare("UPDATE projets SET actif = NOT actif WHERE id=?")->execute([$id]);
    $message_retour = 'Visibilité du projet mise à jour.';
    $type_retour = 'success';
}

// ---- Ajout / Modification ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $message_retour = 'Erreur de sécurité. Veuillez réessayer.';
        $type_retour = 'error';
    } else {
        $titre          = trim($_POST['titre'] ?? '');
        $description    = trim($_POST['description'] ?? '');
        $client         = trim($_POST['client'] ?? '');
        $pole           = in_array($_POST['pole'] ?? '', array_keys($poles_labels)) ? $_POST['pole'] : 'btp';
        $statut         = in_array($_POST['statut'] ?? '', ['termine','en_cours']) ? $_POST['statut'] : 'en_cours';
        $nature_travaux = trim($_POST['nature_travaux'] ?? '');
        $edit_id        = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

        if (!$titre) {
            $message_retour = 'Le titre du projet est obligatoire.';
            $type_retour = 'error';
        } else {
            // Gestion upload image
            $image_name = null;
            if (!empty($_FILES['image']['name'])) {
                $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg','jpeg','png','webp','gif'];
                if (!in_array($ext, $allowed)) {
                    $message_retour = 'Format d\'image non supporté. Utilisez : JPG, PNG, WEBP.';
                    $type_retour = 'error';
                } elseif ($_FILES['image']['size'] > 3 * 1024 * 1024) {
                    $message_retour = 'L\'image ne doit pas dépasser 3 Mo.';
                    $type_retour = 'error';
                } else {
                    $image_name = uniqid('proj_') . '.' . $ext;
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR . $image_name)) {
                        $image_name = null;
                        $message_retour = 'Erreur lors de l\'enregistrement de l\'image.';
                        $type_retour = 'error';
                    }
                }
            }

            if ($type_retour !== 'error') {
                if ($edit_id > 0) {
                    if ($image_name) {
                        // Supprimer l'ancienne image
                        $old = $db->prepare("SELECT image FROM projets WHERE id=?");
                        $old->execute([$edit_id]);
                        $oldImg = $old->fetchColumn();
                        if ($oldImg && file_exists(UPLOAD_DIR . $oldImg)) @unlink(UPLOAD_DIR . $oldImg);
                        $stmt = $db->prepare("UPDATE projets SET titre=?, description=?, client=?, pole=?, statut=?, nature_travaux=?, image=? WHERE id=?");
                        $stmt->execute([$titre, $description, $client, $pole, $statut, $nature_travaux, $image_name, $edit_id]);
                    } else {
                        $stmt = $db->prepare("UPDATE projets SET titre=?, description=?, client=?, pole=?, statut=?, nature_travaux=? WHERE id=?");
                        $stmt->execute([$titre, $description, $client, $pole, $statut, $nature_travaux, $edit_id]);
                    }
                    $message_retour = 'Projet modifié avec succès.';
                } else {
                    $stmt = $db->prepare("INSERT INTO projets (titre, description, client, pole, statut, nature_travaux, image, actif) VALUES (?,?,?,?,?,?,?,1)");
                    $stmt->execute([$titre, $description, $client, $pole, $statut, $nature_travaux, $image_name]);
                    $message_retour = 'Projet ajouté avec succès.';
                }
                $type_retour = 'success';
                // Redirection pour éviter re-POST
                header("Location: projets.php?msg=" . urlencode($message_retour) . "&type=success");
                exit;
            }
        }
    }
}

// Récupérer message après redirection
if (isset($_GET['msg']) && isset($_GET['type'])) {
    $message_retour = $_GET['msg'];
    $type_retour    = $_GET['type'] === 'success' ? 'success' : 'error';
}

// ---- Récupérer projet à éditer ----
$edit_projet = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM projets WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit_projet = $stmt->fetch();
}

// ---- Liste tous les projets ----
$projets = $db->query("SELECT * FROM projets ORDER BY created_at DESC")->fetchAll();

$nb_messages = $db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$current_page = 'projets';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Projets - Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>📁 Gestion des Projets</h1>
      <div class="admin-topbar-actions">
        <span class="admin-user">Connecté : <strong><?= e($_SESSION['admin_user'] ?? 'Admin') ?></strong></span>
        <a href="<?= SITE_URL ?>/realisations.php" target="_blank" class="btn-site">🌐 Voir les réalisations</a>
      </div>
    </div>

    <div class="admin-content">

      <?php if ($message_retour): ?>
        <div class="alert alert-<?= $type_retour === 'success' ? 'success' : 'error' ?>">
          <?= $type_retour === 'success' ? '✅' : '⚠️' ?> <?= e($message_retour) ?>
        </div>
      <?php endif; ?>

      <!-- Formulaire ajout / édition -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3><?= $edit_projet ? '✏️ Modifier le projet' : '➕ Ajouter un nouveau projet' ?></h3>
          <?php if ($edit_projet): ?>
            <a href="projets.php" class="btn-cancel">✕ Annuler</a>
          <?php endif; ?>
        </div>

        <form method="POST" action="projets.php" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
          <?php if ($edit_projet): ?>
            <input type="hidden" name="edit_id" value="<?= (int)$edit_projet['id'] ?>">
          <?php endif; ?>

          <div class="form-section-title">Informations principales</div>
          <div class="form-row">
            <div class="form-group">
              <label for="titre">Titre du projet <span class="required">*</span></label>
              <input type="text" id="titre" name="titre" required
                     value="<?= e($edit_projet['titre'] ?? '') ?>"
                     placeholder="Ex : Construction bâtiment administratif">
            </div>
            <div class="form-group">
              <label for="client">Client / Maître d'ouvrage</label>
              <input type="text" id="client" name="client"
                     value="<?= e($edit_projet['client'] ?? '') ?>"
                     placeholder="Ex : Commune de Ngor">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="pole">Pôle d'activité</label>
              <select id="pole" name="pole">
                <?php foreach ($poles_labels as $val => $lab): ?>
                  <option value="<?= $val ?>" <?= (($edit_projet['pole'] ?? 'btp') === $val) ? 'selected' : '' ?>>
                    <?= $lab ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="statut">Statut du projet</label>
              <select id="statut" name="statut">
                <option value="en_cours" <?= (($edit_projet['statut'] ?? '') === 'en_cours') ? 'selected' : '' ?>>🔄 En cours</option>
                <option value="termine"  <?= (($edit_projet['statut'] ?? '') === 'termine')  ? 'selected' : '' ?>>✅ Terminé</option>
              </select>
            </div>
          </div>

          <div class="form-section-title" style="margin-top:8px;">Détails techniques</div>
          <div class="form-row">
            <div class="form-group">
              <label for="nature_travaux">Nature des travaux</label>
              <input type="text" id="nature_travaux" name="nature_travaux"
                     value="<?= e($edit_projet['nature_travaux'] ?? '') ?>"
                     placeholder="Ex : Gros œuvre, charpente, électricité">
            </div>
            <div class="form-group">
              <label for="image">
                Image du projet
                <?php if (!empty($edit_projet['image'])): ?>
                  <span style="font-size:.75rem; color:#718096; font-weight:400;">(changer l'image existante)</span>
                <?php endif; ?>
              </label>
              <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/webp,image/gif">
              <p class="form-hint">JPG, PNG ou WEBP - max 3 Mo<?php if (!empty($edit_projet['image'])): ?> - laisser vide pour conserver l'image actuelle<?php endif; ?></p>
            </div>
          </div>

          <?php if (!empty($edit_projet['image'])): ?>
            <div style="margin-bottom:16px;">
              <label style="font-size:.82rem; font-weight:600; color:#4a5568; display:block; margin-bottom:8px;">Image actuelle</label>
              <img src="<?= SITE_URL ?>/uploads/projets/<?= e($edit_projet['image']) ?>"
                   alt="Image actuelle"
                   style="height:100px; border-radius:8px; object-fit:cover; border:1px solid #e2e8f0;">
            </div>
          <?php endif; ?>

          <div class="form-group" style="margin-bottom:20px;">
            <label for="description">Description du projet</label>
            <textarea id="description" name="description"
                      placeholder="Décrivez les travaux réalisés, les défis techniques, les surfaces couvertes, les délais…"><?= e($edit_projet['description'] ?? '') ?></textarea>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn-submit">
              <?= $edit_projet ? '💾 Enregistrer les modifications' : '➕ Ajouter le projet' ?>
            </button>
            <?php if ($edit_projet): ?>
              <a href="projets.php" class="btn-cancel">✕ Annuler</a>
            <?php else: ?>
              <span class="form-required-note">Les champs <span style="color:#e74c3c;">*</span> sont obligatoires.</span>
            <?php endif; ?>
          </div>
        </form>
      </div>

      <!-- Grille cartes projets -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:-3px;margin-right:6px;"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            Tous les projets
            <span style="font-weight:400;color:#718096;font-size:.88rem;margin-left:6px;">(<?= count($projets) ?>)</span>
          </h3>
          <?php if (count($projets) > 0): ?>
            <span style="font-size:.8rem;color:#718096;background:#f0f4ff;padding:4px 12px;border-radius:20px;">
              <?= array_sum(array_column($projets, 'actif')) ?> actifs · <?= count($projets) - array_sum(array_column($projets, 'actif')) ?> masqués
            </span>
          <?php endif; ?>
        </div>

        <?php if (empty($projets)): ?>
          <div class="empty-state">
            <div class="empty-state-icon" style="font-size:2.5rem;">📂</div>
            <p>Aucun projet pour le moment. Ajoutez le premier ci-dessus !</p>
          </div>
        <?php else: ?>
          <div class="projets-grid">
            <?php foreach ($projets as $proj):
              $pole  = $proj['pole'] ?? 'btp';
              $color = $poles_colors[$pole] ?? '#ccc';
              $label = $poles_labels[$pole] ?? strtoupper($pole);
              $has_img = !empty($proj['image']) && file_exists(UPLOAD_DIR . $proj['image']);
            ?>
            <div class="projet-admin-card <?= !$proj['actif'] ? 'projet-admin-card--masque' : '' ?>">

              <!-- Image ou placeholder couleur pôle -->
              <div class="projet-admin-card-img" style="background:<?= $color ?>22; border-bottom:3px solid <?= $color ?>;">
                <?php if ($has_img): ?>
                  <img src="<?= SITE_URL ?>/uploads/projets/<?= e($proj['image']) ?>" alt="<?= e($proj['titre']) ?>" loading="lazy">
                <?php else: ?>
                  <div class="projet-admin-card-noimg" style="color:<?= $color ?>;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                  </div>
                <?php endif; ?>
                <!-- Badge pôle -->
                <span class="projet-admin-card-pole" style="background:<?= $color ?>;"><?= e($label) ?></span>
                <!-- Badge masqué -->
                <?php if (!$proj['actif']): ?>
                  <span class="projet-admin-card-masque-badge">Masqué</span>
                <?php endif; ?>
              </div>

              <!-- Contenu -->
              <div class="projet-admin-card-body">
                <h4 class="projet-admin-card-title"><?= e($proj['titre']) ?></h4>

                <div class="projet-admin-card-meta">
                  <?php if (!empty($proj['client'])): ?>
                  <div class="projet-admin-card-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <?= e($proj['client']) ?>
                  </div>
                  <?php endif; ?>
                  <?php if (!empty($proj['nature_travaux'])): ?>
                  <div class="projet-admin-card-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                    <?= e(mb_strimwidth($proj['nature_travaux'], 0, 36, '…')) ?>
                  </div>
                  <?php endif; ?>
                  <div class="projet-admin-card-meta-item">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <?= e(date('d/m/Y', strtotime($proj['created_at']))) ?>
                  </div>
                </div>

                <!-- Statut -->
                <div style="margin:10px 0 14px;">
                  <?php if ($proj['statut'] === 'termine'): ?>
                    <span class="badge badge-termine">✅ Terminé</span>
                  <?php else: ?>
                    <span class="badge badge-encours">🔄 En cours</span>
                  <?php endif; ?>
                </div>

                <!-- Actions -->
                <div class="projet-admin-card-actions">
                  <a href="projets.php?edit=<?= (int)$proj['id'] ?>" class="proj-btn proj-btn-edit">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Modifier
                  </a>
                  <a href="projets.php?toggle=<?= (int)$proj['id'] ?>" class="proj-btn proj-btn-toggle" title="<?= $proj['actif'] ? 'Masquer' : 'Afficher' ?>">
                    <?php if ($proj['actif']): ?>
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                      Masquer
                    <?php else: ?>
                      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                      Afficher
                    <?php endif; ?>
                  </a>
                  <a href="projets.php?delete=<?= (int)$proj['id'] ?>" class="proj-btn proj-btn-delete"
                     onclick="return confirm('Supprimer « <?= e(addslashes($proj['titre'])) ?> » ?')">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                  </a>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

      <style>
      .projets-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 4px 2px 8px;
      }
      .projet-admin-card {
        border-radius: 14px;
        border: 1px solid #e8ecf0;
        background: #fff;
        overflow: hidden;
        transition: box-shadow .2s, transform .2s;
        display: flex;
        flex-direction: column;
      }
      .projet-admin-card:hover {
        box-shadow: 0 8px 32px rgba(26,107,181,.12);
        transform: translateY(-3px);
      }
      .projet-admin-card--masque {
        opacity: .65;
        border-style: dashed;
      }
      .projet-admin-card-img {
        position: relative;
        height: 150px;
        overflow: hidden;
      }
      .projet-admin-card-img img {
        width: 100%; height: 100%; object-fit: cover; display: block;
      }
      .projet-admin-card-noimg {
        width: 100%; height: 100%;
        display: flex; align-items: center; justify-content: center;
        opacity: .4;
      }
      .projet-admin-card-pole {
        position: absolute; top: 10px; left: 10px;
        color: #fff; font-size: .7rem; font-weight: 700;
        padding: 3px 10px; border-radius: 20px;
        text-transform: uppercase; letter-spacing: .06em;
      }
      .projet-admin-card-masque-badge {
        position: absolute; top: 10px; right: 10px;
        background: rgba(0,0,0,.55); color: #fff;
        font-size: .68rem; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
      }
      .projet-admin-card-body {
        padding: 14px 16px 14px;
        display: flex; flex-direction: column; flex: 1;
      }
      .projet-admin-card-title {
        font-size: .92rem; font-weight: 700; color: #1a202c;
        line-height: 1.35; margin-bottom: 8px;
      }
      .projet-admin-card-meta {
        display: flex; flex-direction: column; gap: 4px; margin-bottom: 4px;
      }
      .projet-admin-card-meta-item {
        display: flex; align-items: center; gap: 6px;
        font-size: .78rem; color: #718096;
      }
      .projet-admin-card-meta-item svg { flex-shrink: 0; color: #a0aec0; }
      .projet-admin-card-actions {
        display: flex; gap: 6px; margin-top: auto; padding-top: 4px;
      }
      .proj-btn {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 12px; border-radius: 7px;
        font-size: .78rem; font-weight: 600;
        text-decoration: none; transition: background .15s, transform .12s;
      }
      .proj-btn:hover { transform: translateY(-1px); }
      .proj-btn-edit   { background: #ebf8ff; color: #2b6cb0; flex: 1; justify-content: center; }
      .proj-btn-edit:hover { background: #bee3f8; }
      .proj-btn-toggle { background: #f0fff4; color: #276749; flex: 1; justify-content: center; }
      .proj-btn-toggle:hover { background: #c6f6d5; }
      .proj-btn-delete { background: #fff5f5; color: #c53030; padding: 6px 10px; }
      .proj-btn-delete:hover { background: #fed7d7; }
      </style>

    </div>
  </main>
</div>
</body>
</html>
