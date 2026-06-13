<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$upload_dir = __DIR__ . '/../uploads/videos/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

// Migration auto
try {
    $db->exec("CREATE TABLE IF NOT EXISTS videos_chantiers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titre VARCHAR(255) NOT NULL,
        description VARCHAR(500) DEFAULT NULL,
        fichier VARCHAR(300) NOT NULL,
        thumbnail VARCHAR(300) DEFAULT NULL,
        sort_order INT DEFAULT 0,
        actif TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
} catch (Exception $e) {}

$msg = '';
$msg_type = '';

// ---- Suppression ----
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if (empty($_GET['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) { header('Location: videos.php?msg=csrf&type=error'); exit; }
    $id = (int)$_GET['delete'];
    $row = $db->prepare("SELECT fichier, thumbnail FROM videos_chantiers WHERE id=?");
    $row->execute([$id]);
    $data = $row->fetch();
    if ($data) {
        if ($data['fichier'] && file_exists($upload_dir . basename($data['fichier']))) @unlink($upload_dir . basename($data['fichier']));
        if ($data['thumbnail'] && file_exists($upload_dir . basename($data['thumbnail']))) @unlink($upload_dir . basename($data['thumbnail']));
    }
    $db->prepare("DELETE FROM videos_chantiers WHERE id=?")->execute([$id]);
    header('Location: videos.php?msg=supprime&type=success'); exit;
}

// ---- Toggle actif ----
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    if (empty($_GET['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) { header('Location: videos.php?msg=csrf&type=error'); exit; }
    $db->prepare("UPDATE videos_chantiers SET actif = NOT actif WHERE id=?")->execute([(int)$_GET['toggle']]);
    header('Location: videos.php?msg=maj&type=success'); exit;
}

// ---- Ajouter / Modifier ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (!csrf_verify()) { header('Location: videos.php?msg=csrf&type=error'); exit; }

    $titre = mb_substr(trim($_POST['titre'] ?? ''), 0, 255);
    $desc  = mb_substr(trim($_POST['description'] ?? ''), 0, 500);
    $edit_id = (int)($_POST['edit_id'] ?? 0);

    if (empty($titre)) {
        $msg = 'Le titre est obligatoire.'; $msg_type = 'error';
    } else {
        $fichier_name = null;
        $thumb_name   = null;

        // Upload vidéo
        if (!empty($_FILES['fichier']['name']) && $_FILES['fichier']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['mp4','webm','ogg','mov'], true)) {
                $msg = 'Format vidéo non supporté (MP4, MOV, WEBM).'; $msg_type = 'error';
            } elseif ($_FILES['fichier']['size'] > 500 * 1024 * 1024) {
                $msg = 'Vidéo trop lourde (max 500 Mo).'; $msg_type = 'error';
            } else {
                $save_ext = ($ext === 'mov') ? 'mp4' : $ext;
                $fichier_name = 'vid_' . uniqid() . '.' . $save_ext;
                if (!move_uploaded_file($_FILES['fichier']['tmp_name'], $upload_dir . $fichier_name)) {
                    $fichier_name = null; $msg = 'Erreur upload vidéo.'; $msg_type = 'error';
                }
            }
        }

        // Upload thumbnail
        if (empty($msg) && !empty($_FILES['thumbnail']['name']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
            $ext2 = strtolower(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION));
            if (in_array($ext2, ['jpg','jpeg','png','webp'], true) && $_FILES['thumbnail']['size'] <= 5 * 1024 * 1024) {
                $thumb_name = 'thumb_' . uniqid() . '.' . $ext2;
                if (!move_uploaded_file($_FILES['thumbnail']['tmp_name'], $upload_dir . $thumb_name)) {
                    $thumb_name = null;
                }
            }
        }

        if (empty($msg)) {
            if ($edit_id > 0) {
                // Modifier
                if ($fichier_name) {
                    $old = $db->prepare("SELECT fichier FROM videos_chantiers WHERE id=?");
                    $old->execute([$edit_id]);
                    $oldF = $old->fetchColumn();
                    if ($oldF && file_exists($upload_dir . basename($oldF))) @unlink($upload_dir . basename($oldF));
                    $db->prepare("UPDATE videos_chantiers SET titre=?, description=?, fichier=? WHERE id=?")->execute([$titre, $desc, $fichier_name, $edit_id]);
                } else {
                    $db->prepare("UPDATE videos_chantiers SET titre=?, description=? WHERE id=?")->execute([$titre, $desc, $edit_id]);
                }
                if ($thumb_name) {
                    $old2 = $db->prepare("SELECT thumbnail FROM videos_chantiers WHERE id=?");
                    $old2->execute([$edit_id]);
                    $oldT = $old2->fetchColumn();
                    if ($oldT && file_exists($upload_dir . basename($oldT))) @unlink($upload_dir . basename($oldT));
                    $db->prepare("UPDATE videos_chantiers SET thumbnail=? WHERE id=?")->execute([$thumb_name, $edit_id]);
                }
                $msg = 'Vidéo mise à jour.'; $msg_type = 'success';
            } else {
                // Ajouter
                if (!$fichier_name) { $msg = 'Le fichier vidéo est obligatoire.'; $msg_type = 'error'; }
                else {
                    $db->prepare("INSERT INTO videos_chantiers (titre, description, fichier, thumbnail, actif) VALUES (?,?,?,?,1)")
                       ->execute([$titre, $desc, $fichier_name, $thumb_name]);
                    $msg = 'Vidéo ajoutée avec succès.'; $msg_type = 'success';
                }
            }
        }
    }
}

if (isset($_GET['msg'])) { $msg = $_GET['msg'] === 'supprime' ? 'Vidéo supprimée.' : 'Mise à jour effectuée.'; $msg_type = $_GET['type'] ?? 'success'; }

$videos = $db->query("SELECT * FROM videos_chantiers ORDER BY sort_order ASC, id DESC")->fetchAll();
$nb_messages = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();

$edit_data = null;
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $s = $db->prepare("SELECT * FROM videos_chantiers WHERE id=?"); $s->execute([(int)$_GET['edit']]); $edit_data = $s->fetch();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vidéos Chantiers - Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
<div class="admin-topbar">
  <div style="display:flex;align-items:center;gap:12px;">
    <h1 style="margin:0;font-size:1.2rem;font-weight:700;color:#1a202c;">Vidéos Chantiers</h1>
    <span style="background:#fff3e0;color:#c05621;font-size:.75rem;font-weight:700;padding:3px 10px;border-radius:20px;"><?= count($videos) ?> vidéo(s)</span>
  </div>
  <button onclick="document.getElementById('formAjout').style.display=document.getElementById('formAjout').style.display==='none'?'block':'none'"
          class="btn btn-primary btn-sm">+ Ajouter une vidéo</button>
</div>

<?php if ($msg): ?>
<div style="margin:16px 24px;padding:12px 16px;border-radius:8px;font-size:.9rem;font-weight:600;background:<?= $msg_type==='success'?'#f0fff4':'#fff5f5' ?>;color:<?= $msg_type==='success'?'#276749':'#c53030' ?>;border:1px solid <?= $msg_type==='success'?'#c6f6d5':'#fed7d7' ?>;">
  <?= e($msg) ?>
</div>
<?php endif; ?>

<!-- Formulaire ajout/édition -->
<div id="formAjout" style="<?= $edit_data ? 'display:block' : 'display:none' ?>;margin:0 24px 24px;background:#fff;border-radius:12px;border:1px solid #e2e8f0;padding:24px;">
  <h3 style="margin:0 0 16px;font-size:1rem;font-weight:700;"><?= $edit_data ? 'Modifier la vidéo' : 'Ajouter une vidéo' ?></h3>
  <form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
    <input type="hidden" name="action" value="save">
    <input type="hidden" name="edit_id" value="<?= $edit_data ? $edit_data['id'] : 0 ?>">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
      <div>
        <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:4px;">Titre *</label>
        <input type="text" name="titre" value="<?= e($edit_data['titre'] ?? '') ?>" required
               style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.9rem;box-sizing:border-box;">
      </div>
      <div>
        <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:4px;">Description (optionnelle)</label>
        <input type="text" name="description" value="<?= e($edit_data['description'] ?? '') ?>"
               style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.9rem;box-sizing:border-box;">
      </div>
    </div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
      <div>
        <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:4px;">
          Fichier vidéo <?= $edit_data ? '(laisser vide pour garder l\'actuel)' : '*' ?> — MP4, MOV, max 500 Mo
        </label>
        <input type="file" name="fichier" accept="video/mp4,video/quicktime,.mov,.mp4,.webm" <?= $edit_data ? '' : 'required' ?>
               style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.85rem;box-sizing:border-box;background:#f8fafd;">
        <?php if ($edit_data && $edit_data['fichier']): ?>
        <div style="font-size:.75rem;color:#718096;margin-top:4px;">Actuel : <?= e($edit_data['fichier']) ?></div>
        <?php endif; ?>
      </div>
      <div>
        <label style="font-size:.82rem;font-weight:600;color:#4a5568;display:block;margin-bottom:4px;">
          Miniature (optionnelle) — JPG, PNG, max 5 Mo
        </label>
        <input type="file" name="thumbnail" accept="image/jpeg,image/png,image/webp"
               style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:.85rem;box-sizing:border-box;background:#f8fafd;">
        <?php if ($edit_data && $edit_data['thumbnail']): ?>
        <img src="<?= SITE_URL ?>/uploads/videos/<?= e($edit_data['thumbnail']) ?>" style="height:60px;margin-top:6px;border-radius:6px;object-fit:cover;">
        <?php endif; ?>
      </div>
    </div>
    <div style="display:flex;gap:10px;">
      <button type="submit" class="btn btn-primary btn-sm"><?= $edit_data ? 'Enregistrer' : 'Ajouter' ?></button>
      <button type="button" onclick="document.getElementById('formAjout').style.display='none'"
              style="background:#f7fafc;border:1px solid #e2e8f0;border-radius:8px;padding:6px 16px;font-size:.85rem;cursor:pointer;">Annuler</button>
    </div>
  </form>
</div>

<!-- Liste des vidéos -->
<div style="padding:0 24px 40px;">
  <?php if (empty($videos)): ?>
  <div style="text-align:center;padding:60px 20px;color:#a0aec0;">
    <div style="font-size:3rem;margin-bottom:12px;">🎬</div>
    <p>Aucune vidéo. Cliquez sur "+ Ajouter une vidéo" pour commencer.</p>
  </div>
  <?php else: ?>
  <div style="display:flex;flex-direction:column;gap:12px;">
    <?php foreach ($videos as $v): ?>
    <div style="display:flex;gap:16px;align-items:center;padding:14px 16px;border-radius:12px;border:1.5px solid <?= $v['actif'] ? '#e2e8f0' : '#fde8e8' ?>;background:<?= $v['actif'] ? '#fff' : '#fffafa' ?>;">
      <!-- Miniature -->
      <div style="width:100px;height:60px;border-radius:8px;overflow:hidden;background:#0a1628;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
        <?php if ($v['thumbnail']): ?>
          <img src="<?= SITE_URL ?>/uploads/videos/<?= e($v['thumbnail']) ?>" style="width:100%;height:100%;object-fit:cover;">
        <?php else: ?>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.4)" stroke-width="1.5"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
        <?php endif; ?>
      </div>
      <!-- Infos -->
      <div style="flex:1;min-width:0;">
        <div style="font-weight:700;font-size:.95rem;color:#1a202c;"><?= e($v['titre']) ?></div>
        <?php if ($v['description']): ?><div style="font-size:.8rem;color:#718096;margin-top:2px;"><?= e($v['description']) ?></div><?php endif; ?>
        <div style="font-size:.72rem;color:#a0aec0;margin-top:4px;"><?= e($v['fichier']) ?> · <?= date('d/m/Y', strtotime($v['created_at'])) ?></div>
      </div>
      <!-- Statut -->
      <span style="font-size:.7rem;font-weight:700;padding:3px 10px;border-radius:20px;white-space:nowrap;<?= $v['actif'] ? 'background:#f0fff4;color:#276749;' : 'background:#fff5f5;color:#c53030;' ?>">
        <?= $v['actif'] ? 'Publiée' : 'Masquée' ?>
      </span>
      <!-- Actions -->
      <div style="display:flex;gap:6px;flex-shrink:0;">
        <a href="?edit=<?= $v['id'] ?>" style="padding:5px 12px;border-radius:7px;font-size:.78rem;font-weight:600;text-decoration:none;background:#eef2ff;color:#4338ca;">Modifier</a>
        <a href="?toggle=<?= $v['id'] ?>&csrf_token=<?= csrf_token() ?>" style="padding:5px 12px;border-radius:7px;font-size:.78rem;font-weight:600;text-decoration:none;background:#f0f7ff;color:#1a6bb5;"><?= $v['actif'] ? 'Masquer' : 'Afficher' ?></a>
        <a href="<?= SITE_URL ?>/uploads/videos/<?= e($v['fichier']) ?>" target="_blank" style="padding:5px 12px;border-radius:7px;font-size:.78rem;font-weight:600;text-decoration:none;background:#f0fff4;color:#276749;">Voir</a>
        <a href="?delete=<?= $v['id'] ?>&csrf_token=<?= csrf_token() ?>" onclick="return confirm('Supprimer cette vidéo ?')"
           style="padding:5px 12px;border-radius:7px;font-size:.78rem;font-weight:600;text-decoration:none;background:#fff5f5;color:#c53030;">Supprimer</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>

  </main>
</div>
<?php require_once 'includes/footer.php'; ?>
</body>
</html>
