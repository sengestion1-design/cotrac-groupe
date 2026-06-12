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
      <h1>📰 Actualités</h1>
      <div class="admin-topbar-actions">
        <span class="admin-user">Connecté : <strong><?= e($_SESSION['admin_user'] ?? 'Admin') ?></strong></span>
        <a href="<?= SITE_URL ?>" target="_blank" class="btn-site">🌐 Voir le site</a>
      </div>
    </div>

    <div class="admin-content">

      <?php if ($message_retour): ?>
        <div class="alert alert-<?= $type_retour === 'success' ? 'success' : 'error' ?>">
          <?= e($message_retour) ?>
        </div>
      <?php endif; ?>

      <!-- Formulaire -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3><?= $edit_data ? '✏️ Modifier l\'actualité' : '➕ Publier une actualité' ?></h3>
          <?php if ($edit_data): ?>
            <a href="actualites.php" class="btn-icon btn-edit">✕ Annuler</a>
          <?php endif; ?>
        </div>
        <form method="POST" enctype="multipart/form-data">
          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
          <?php if ($edit_data): ?>
            <input type="hidden" name="edit_id" value="<?= (int)$edit_data['id'] ?>">
          <?php endif; ?>

          <div class="form-group">
            <label>Titre *</label>
            <input type="text" name="titre" value="<?= e($edit_data['titre'] ?? '') ?>"
                   placeholder="Ex : COTRAC remporte un nouveau marché à Thiès" required>
          </div>

          <div class="form-group" style="margin-top:16px;">
            <label>Contenu / Description</label>
            <textarea name="contenu" placeholder="Rédigez le contenu de l'actualité..."><?= e($edit_data['contenu'] ?? '') ?></textarea>
          </div>

          <div class="form-group" style="margin-top:16px;">
            <label>Image (JPG, PNG, WEBP - max 3 Mo)</label>
            <?php if (!empty($edit_data['image'])): ?>
              <div style="margin-bottom:8px;">
                <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($edit_data['image']) ?>" alt="Image actuelle"
                     style="height:80px;width:160px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">
                <span style="font-size:.75rem;color:#718096;display:block;margin-top:4px;">Image actuelle - laisser vide pour conserver</span>
              </div>
            <?php endif; ?>
            <input type="file" name="image" accept="image/*">
          </div>

          <div style="margin-top:20px;">
            <button type="submit" class="btn-primary"><?= $edit_data ? '💾 Enregistrer' : '📢 Publier l\'actualité' ?></button>
          </div>
        </form>
      </div>

      <!-- Liste -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3>📋 Actualités publiées (<?= count($actualites) ?>)</h3>
        </div>
        <?php if (empty($actualites)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">📰</div>
            <p>Aucune actualité publiée. Créez-en une ci-dessus.</p>
            <div style="margin-top:16px;padding:14px 18px;background:#f0f7ff;border:1px solid #bee3f8;border-radius:10px;text-align:left;">
              <strong style="color:#1a6bb5;">Démarrage rapide</strong>
              <p style="margin:6px 0 12px;font-size:.85rem;color:#4a5568;">Importez des articles prêts à l'emploi que vous pourrez modifier avec vos vraies informations et photos.</p>
              <div style="display:flex;gap:10px;flex-wrap:wrap;">
                <form method="post" action="ajax/insert-actu-btp.php" style="margin:0;">
                  <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
                  <button type="submit" class="btn-primary" style="font-size:.85rem;padding:9px 20px;">📰 Publier l'article Vision 2050 & BTP</button>
                </form>
                <form method="post" action="ajax/import-actualites.php" style="margin:0;">
                  <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
                  <button type="submit" class="btn-secondary" style="font-size:.85rem;padding:9px 20px;">Importer 4 articles d'exemple</button>
                </form>
              </div>
            </div>
          </div>
        <?php else: ?>
          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Titre</th>
                  <th>Aperçu contenu</th>
                  <th>Date</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($actualites as $a): ?>
                  <tr>
                    <td>
                      <?php if (!empty($a['image'])): ?>
                        <img class="actu-img-preview"
                             src="<?= SITE_URL ?>/uploads/actualites/<?= e($a['image']) ?>"
                             alt="<?= e($a['titre']) ?>">
                      <?php else: ?>
                        <div style="width:100px;height:60px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">📰</div>
                      <?php endif; ?>
                    </td>
                    <td><strong><?= e($a['titre']) ?></strong></td>
                    <td>
                      <span class="actu-contenu-preview">
                        <?= e($a['contenu'] ?: '(aucun contenu)') ?>
                      </span>
                    </td>
                    <td style="white-space:nowrap;color:#718096;font-size:.82rem;">
                      <?= e(date('d/m/Y', strtotime($a['created_at']))) ?>
                    </td>
                    <td>
                      <?php if ($a['actif']): ?>
                        <span class="badge badge-termine">✅ Publiée</span>
                      <?php else: ?>
                        <span class="badge badge-nonlu">🚫 Masquée</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="action-btns">
                        <a href="actualites.php?edit=<?= (int)$a['id'] ?>" class="btn-icon btn-edit">✏️ Modifier</a>
                        <a href="actualites.php?toggle=<?= (int)$a['id'] ?>" class="btn-icon" style="background:#f0f4ff;color:#1a6bb5;">
                          <?= $a['actif'] ? '👁 Masquer' : '👁 Afficher' ?>
                        </a>
                        <a href="actualites.php?delete=<?= (int)$a['id'] ?>" class="btn-icon btn-delete"
                           onclick="return confirm('Supprimer cette actualité ?')">🗑 Suppr.</a>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        <?php endif; ?>
      </div>

    </div>
  </main>
</div>
</body>
</html>
