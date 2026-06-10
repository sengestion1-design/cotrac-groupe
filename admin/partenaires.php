<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$message_retour = '';
$type_retour    = '';

$poles_labels = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie','tous'=>'Tous les pôles'];
$poles_colors = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad','tous'=>'#64748b'];

// ---- Suppression ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $row = $db->prepare("SELECT logo FROM partenaires WHERE id=?");
    $row->execute([$id]);
    $data = $row->fetch();
    if ($data && !empty($data['logo'])) {
        $p = __DIR__ . '/../assets/images/logos/' . $data['logo'];
        if (file_exists($p)) @unlink($p);
    }
    $db->prepare("DELETE FROM partenaires WHERE id=?")->execute([$id]);
    header('Location: partenaires.php?msg=supprime&type=success'); exit;
}

// ---- Toggle actif ----
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $db->prepare("UPDATE partenaires SET actif = NOT actif WHERE id=?")->execute([(int)$_GET['toggle']]);
    header('Location: partenaires.php?msg=toggle&type=success'); exit;
}

// ---- Ajout / Modif ----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify()) {
        $message_retour = 'Erreur de sécurité. Veuillez réessayer.'; $type_retour = 'error';
    } else {
        $nom    = trim($_POST['nom']    ?? '');
        $pole   = in_array($_POST['pole'] ?? '', array_keys($poles_labels)) ? $_POST['pole'] : 'tous';
        $ordre  = (int)($_POST['ordre']  ?? 0);
        $edit_id = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

        if (!$nom) {
            $message_retour = 'Le nom du partenaire est obligatoire.'; $type_retour = 'error';
        } else {
            $logo_name = null;
            if (!empty($_FILES['logo']['name'])) {
                $ext     = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                $allowed = ['jpg','jpeg','png','webp','svg'];
                if (!in_array($ext, $allowed)) {
                    $message_retour = 'Format non supporté. Utilisez JPG, PNG, WEBP ou SVG.'; $type_retour = 'error';
                } elseif ($_FILES['logo']['size'] > 2 * 1024 * 1024) {
                    $message_retour = 'Le logo ne doit pas dépasser 2 Mo.'; $type_retour = 'error';
                } else {
                    $logo_name = 'partner_' . uniqid() . '.' . $ext;
                    $dest = __DIR__ . '/../assets/images/logos/' . $logo_name;
                    if (!move_uploaded_file($_FILES['logo']['tmp_name'], $dest)) {
                        $logo_name = null;
                        $message_retour = 'Erreur lors de l\'enregistrement du logo.'; $type_retour = 'error';
                    }
                }
            }

            if ($type_retour !== 'error') {
                if ($edit_id > 0) {
                    if ($logo_name) {
                        // Supprimer l'ancien logo
                        $old = $db->prepare("SELECT logo FROM partenaires WHERE id=?");
                        $old->execute([$edit_id]);
                        $oldData = $old->fetch();
                        if ($oldData && !empty($oldData['logo'])) {
                            $oldPath = __DIR__ . '/../assets/images/logos/' . $oldData['logo'];
                            if (file_exists($oldPath)) @unlink($oldPath);
                        }
                        $db->prepare("UPDATE partenaires SET nom=?, pole=?, ordre=?, logo=? WHERE id=?")
                           ->execute([$nom, $pole, $ordre, $logo_name, $edit_id]);
                    } else {
                        $db->prepare("UPDATE partenaires SET nom=?, pole=?, ordre=? WHERE id=?")
                           ->execute([$nom, $pole, $ordre, $edit_id]);
                    }
                    $message_retour = 'Partenaire modifié avec succès.'; $type_retour = 'success';
                } else {
                    $db->prepare("INSERT INTO partenaires (nom, pole, logo, ordre, actif) VALUES (?,?,?,?,1)")
                       ->execute([$nom, $pole, $logo_name, $ordre]);
                    $message_retour = 'Partenaire ajouté avec succès.'; $type_retour = 'success';
                }
            }
        }
    }
}

// Feedback depuis redirect
$msg_labels = [
    'supprime' => 'Partenaire supprimé.',
    'toggle'   => 'Visibilité mise à jour.',
];
if (!$message_retour && isset($_GET['msg']) && isset($msg_labels[$_GET['msg']])) {
    $message_retour = $msg_labels[$_GET['msg']];
    $type_retour    = ($_GET['type'] ?? '') === 'success' ? 'success' : 'error';
}

// ---- Édition ----
$edit_data = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $stmt = $db->prepare("SELECT * FROM partenaires WHERE id=?");
    $stmt->execute([(int)$_GET['edit']]);
    $edit_data = $stmt->fetch();
}

// ---- Liste ----
$partenaires = $db->query("SELECT * FROM partenaires ORDER BY ordre ASC, nom ASC")->fetchAll();

$nb_messages = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
$current_page = 'partenaires';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Partenaires - Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>🤝 Partenaires</h1>
      <div class="admin-topbar-actions">
        <span class="admin-user">Connecté : <strong><?= e($_SESSION['admin_user'] ?? 'Admin') ?></strong></span>
        <a href="<?= SITE_URL ?>/a-propos.php#partenaires" target="_blank" class="btn-site">🌐 Voir sur le site</a>
      </div>
    </div>

    <div class="admin-content">

      <?php if ($message_retour): ?>
        <div class="alert alert-<?= $type_retour === 'success' ? 'success' : 'error' ?>">
          <?= e($message_retour) ?>
        </div>
      <?php endif; ?>

      <!-- Formulaire ajout/modif -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3><?= $edit_data ? '✏️ Modifier le partenaire' : '➕ Ajouter un partenaire' ?></h3>
          <?php if ($edit_data): ?>
            <a href="partenaires.php" class="btn-icon btn-edit">✕ Annuler</a>
          <?php endif; ?>
        </div>
        <form method="POST" enctype="multipart/form-data" style="display:grid;grid-template-columns:1fr 1fr;gap:20px 24px;">
          <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
          <?php if ($edit_data): ?>
            <input type="hidden" name="edit_id" value="<?= (int)$edit_data['id'] ?>">
          <?php endif; ?>

          <div class="form-group">
            <label>Nom du partenaire *</label>
            <input type="text" name="nom" value="<?= e($edit_data['nom'] ?? '') ?>" placeholder="Ex : SENELEC" required>
          </div>

          <div class="form-group">
            <label>Pôle associé</label>
            <select name="pole">
              <?php foreach ($poles_labels as $val => $lbl): ?>
                <option value="<?= $val ?>" <?= ($edit_data['pole'] ?? 'tous') === $val ? 'selected' : '' ?>><?= $lbl ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Logo (JPG, PNG, WEBP, SVG - max 2 Mo)</label>
            <?php if (!empty($edit_data['logo'])): ?>
              <div style="margin-bottom:8px;">
                <img src="<?= SITE_URL ?>/assets/images/logos/<?= e($edit_data['logo']) ?>" alt="Logo actuel"
                     style="height:48px;object-fit:contain;border:1px solid #e2e8f0;border-radius:6px;padding:4px;background:#fff;">
                <span style="font-size:.75rem;color:#718096;display:block;margin-top:4px;">Logo actuel - laisser vide pour conserver</span>
              </div>
            <?php endif; ?>
            <input type="file" name="logo" accept="image/*">
          </div>

          <div class="form-group">
            <label>Ordre d'affichage</label>
            <input type="number" name="ordre" value="<?= (int)($edit_data['ordre'] ?? 0) ?>" min="0" max="999">
          </div>

          <div style="grid-column:1/-1;">
            <button type="submit" class="btn-primary"><?= $edit_data ? '💾 Enregistrer les modifications' : '➕ Ajouter le partenaire' ?></button>
          </div>
        </form>
      </div>

      <!-- Liste des partenaires -->
      <div class="admin-card">
        <div class="admin-card-header">
          <h3>📋 Liste des partenaires (<?= count($partenaires) ?>)</h3>
        </div>
        <?php if (empty($partenaires)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">🤝</div>
            <p>Aucun partenaire enregistré. Ajoutez-en un ci-dessus.</p>
          </div>
        <?php else: ?>
          <div style="overflow-x:auto;">
            <table class="table">
              <thead>
                <tr>
                  <th>Logo</th>
                  <th>Nom</th>
                  <th>Pôle</th>
                  <th>Ordre</th>
                  <th>Statut</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($partenaires as $p): ?>
                  <tr>
                    <td>
                      <?php if (!empty($p['logo'])): ?>
                        <img src="<?= SITE_URL ?>/assets/images/logos/<?= e($p['logo']) ?>" alt="<?= e($p['nom']) ?>"
                             style="height:40px;width:80px;object-fit:contain;border:1px solid #e2e8f0;border-radius:6px;background:#fff;padding:4px;">
                      <?php else: ?>
                        <span style="color:#aaa;font-size:.8rem;">Aucun logo</span>
                      <?php endif; ?>
                    </td>
                    <td><strong><?= e($p['nom']) ?></strong></td>
                    <td>
                      <span class="pole-badge" style="background:<?= $poles_colors[$p['pole']] ?? '#ccc' ?>;">
                        <?= e($poles_labels[$p['pole']] ?? $p['pole']) ?>
                      </span>
                    </td>
                    <td><?= (int)$p['ordre'] ?></td>
                    <td>
                      <?php if ($p['actif']): ?>
                        <span class="badge badge-termine">✅ Visible</span>
                      <?php else: ?>
                        <span class="badge badge-nonlu">🚫 Masqué</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="action-btns">
                        <a href="partenaires.php?edit=<?= (int)$p['id'] ?>" class="btn-icon btn-edit">✏️ Modifier</a>
                        <a href="partenaires.php?toggle=<?= (int)$p['id'] ?>" class="btn-icon"
                           style="background:#f0f4ff;color:#1a6bb5;">
                          <?= $p['actif'] ? '👁 Masquer' : '👁 Afficher' ?>
                        </a>
                        <a href="partenaires.php?delete=<?= (int)$p['id'] ?>" class="btn-icon btn-delete"
                           onclick="return confirm('Supprimer ce partenaire ?')">🗑 Suppr.</a>
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
