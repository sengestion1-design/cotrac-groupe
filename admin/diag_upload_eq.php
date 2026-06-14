<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$upload_dir = __DIR__ . '/../uploads/equipements/';
$csrf = csrf_token();

$result = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result['csrf_ok'] = csrf_verify();
    $result['post'] = $_POST;
    $result['files'] = $_FILES;
    $result['content_length'] = $_SERVER['CONTENT_LENGTH'] ?? 'non défini';
    $result['post_max_size'] = ini_get('post_max_size');
    $result['upload_max_filesize'] = ini_get('upload_max_filesize');
    $result['post_empty_but_content'] = (!empty($_SERVER['CONTENT_LENGTH']) && empty($_POST));

    if (!empty($_FILES['photo']['name'])) {
        $result['file_name'] = $_FILES['photo']['name'];
        $result['file_size'] = $_FILES['photo']['size'] . ' bytes (' . round($_FILES['photo']['size']/1024/1024, 2) . ' Mo)';
        $result['file_error_code'] = $_FILES['photo']['error'];
        $err_labels = [0=>'OK',1=>'INI_SIZE',2=>'FORM_SIZE',3=>'PARTIAL',4=>'NO_FILE',6=>'NO_TMP_DIR',7=>'CANT_WRITE',8=>'EXTENSION'];
        $result['file_error_label'] = $err_labels[$_FILES['photo']['error']] ?? 'INCONNU';
        $result['tmp_name'] = $_FILES['photo']['tmp_name'];
        $result['tmp_exists'] = file_exists($_FILES['photo']['tmp_name']) ? 'OUI' : 'NON';

        $result['upload_dir'] = $upload_dir;
        $result['upload_dir_exists'] = is_dir($upload_dir) ? 'OUI' : 'NON (sera créé)';
        $result['upload_dir_writable'] = is_dir($upload_dir) ? (is_writable($upload_dir) ? 'OUI' : 'NON') : 'N/A';

        if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $dest = $upload_dir . 'TEST_DIAG_' . time() . '.' . $ext;
            $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $dest);
            $result['move_result'] = $moved ? 'SUCCÈS → ' . basename($dest) : 'ÉCHEC';
            if ($moved) {
                $result['file_on_disk'] = file_exists($dest) ? 'CONFIRMÉ' : 'INTROUVABLE';
                $result['file_size_on_disk'] = file_exists($dest) ? filesize($dest) . ' bytes' : 'N/A';
                // Nettoyage
                unlink($dest);
                $result['cleanup'] = 'Fichier test supprimé';
            }
        }
    } else {
        $result['file_note'] = 'Aucun fichier reçu dans $_FILES[photo]';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Diagnostic Upload — Admin COTRAC</title>
  <style>
    body { font-family: monospace; padding: 30px; background: #f8f9fa; }
    .card { background: #fff; border-radius: 10px; padding: 24px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
    h2 { margin: 0 0 16px; font-size: 1.1rem; }
    table { width: 100%; border-collapse: collapse; font-size: .85rem; }
    td, th { padding: 8px 12px; border: 1px solid #e2e8f0; text-align: left; }
    th { background: #f0f4f8; font-weight: 600; }
    .ok { color: #276749; font-weight: 700; }
    .err { color: #c53030; font-weight: 700; }
    .warn { color: #b7791f; font-weight: 700; }
    input[type=file] { border: 1.5px solid #e2e8f0; border-radius: 8px; padding: 8px; width: 100%; margin: 10px 0; }
    button { background: #1a6bb5; color: #fff; border: none; border-radius: 8px; padding: 10px 24px; cursor: pointer; font-size: .9rem; }
  </style>
</head>
<body>

<div class="card">
  <h2>🔍 Diagnostic Upload Photo Équipement</h2>
  <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
    <p>Sélectionne la même photo que tu essaies d'uploader :</p>
    <input type="file" name="photo" accept="image/*">
    <br>
    <button type="submit">Tester l'upload</button>
  </form>
</div>

<?php if ($result): ?>
<div class="card">
  <h2>📋 Résultats</h2>
  <table>
    <tr><th>Test</th><th>Résultat</th></tr>
    <tr><td>CSRF valide</td><td class="<?= $result['csrf_ok'] ? 'ok' : 'err' ?>"><?= $result['csrf_ok'] ? 'OUI ✓' : 'NON ✗' ?></td></tr>
    <tr><td>upload_max_filesize (PHP)</td><td><?= $result['upload_max_filesize'] ?></td></tr>
    <tr><td>post_max_size (PHP)</td><td><?= $result['post_max_size'] ?></td></tr>
    <tr><td>Content-Length reçu</td><td><?= $result['content_length'] ?></td></tr>
    <tr><td>POST vide malgré Content-Length</td><td class="<?= $result['post_empty_but_content'] ? 'err' : 'ok' ?>"><?= $result['post_empty_but_content'] ? 'OUI → post_max_size dépassé ✗' : 'NON ✓' ?></td></tr>
    <?php if (!empty($result['file_name'])): ?>
    <tr><td>Fichier reçu</td><td><?= $result['file_name'] ?></td></tr>
    <tr><td>Taille fichier</td><td><?= $result['file_size'] ?></td></tr>
    <tr><td>Code erreur PHP</td><td class="<?= $result['file_error_code'] === 0 ? 'ok' : 'err' ?>"><?= $result['file_error_code'] ?> — <?= $result['file_error_label'] ?></td></tr>
    <tr><td>Fichier tmp existe</td><td class="<?= $result['tmp_exists'] === 'OUI' ? 'ok' : 'err' ?>"><?= $result['tmp_exists'] ?></td></tr>
    <tr><td>Dossier destination</td><td><?= $result['upload_dir'] ?></td></tr>
    <tr><td>Dossier existe</td><td><?= $result['upload_dir_exists'] ?></td></tr>
    <tr><td>Dossier accessible en écriture</td><td class="<?= ($result['upload_dir_writable'] ?? '') === 'OUI' ? 'ok' : 'warn' ?>"><?= $result['upload_dir_writable'] ?? 'N/A' ?></td></tr>
    <?php if (isset($result['move_result'])): ?>
    <tr><td>move_uploaded_file()</td><td class="<?= str_starts_with($result['move_result'], 'SUCCÈS') ? 'ok' : 'err' ?>"><?= $result['move_result'] ?></td></tr>
    <?php endif; ?>
    <?php if (isset($result['file_on_disk'])): ?>
    <tr><td>Fichier confirmé sur disque</td><td class="<?= $result['file_on_disk'] === 'CONFIRMÉ' ? 'ok' : 'err' ?>"><?= $result['file_on_disk'] ?></td></tr>
    <?php endif; ?>
    <?php else: ?>
    <tr><td colspan="2" class="warn"><?= $result['file_note'] ?? 'Aucun fichier' ?></td></tr>
    <?php endif; ?>
  </table>
</div>

<div class="card">
  <h2>📁 Fichiers existants dans uploads/equipements/</h2>
  <?php
  if (is_dir($upload_dir)) {
      $files = array_diff(scandir($upload_dir), ['.', '..']);
      $allowed_ext = ['jpg','jpeg','png','webp','gif'];
      $files = array_filter($files, fn($f) => in_array(strtolower(pathinfo($f, PATHINFO_EXTENSION)), $allowed_ext));
      if ($files) {
          echo '<table><tr><th>Fichier</th><th>Taille</th><th>Date</th><th>Aperçu</th></tr>';
          foreach ($files as $f) {
              $fpath = $upload_dir . $f;
              $url = SITE_URL . '/uploads/equipements/' . htmlspecialchars($f, ENT_QUOTES, 'UTF-8');
              $f_safe = htmlspecialchars($f, ENT_QUOTES, 'UTF-8');
              $url_safe = htmlspecialchars(SITE_URL . '/uploads/equipements/' . $f, ENT_QUOTES, 'UTF-8');
              $size = round(filesize($fpath)/1024);
              $date = date('Y-m-d H:i', filemtime($fpath));
              echo '<tr><td>' . $f_safe . '</td><td>' . $size . ' Ko</td><td>' . $date . '</td><td><img src="' . $url_safe . '" style="height:50px;object-fit:cover;border-radius:4px;" onerror="this.outerHTML=\'<span style=&quot;color:red&quot;>introuvable</span>\'"></td></tr>';
          }
          echo '</table>';
      } else {
          echo '<p>Dossier vide.</p>';
      }
  } else {
      echo '<p class="err">Dossier uploads/equipements/ inexistant sur ce serveur.</p>';
  }
  ?>
</div>
<?php endif; ?>

<p><a href="equipements.php">← Retour Admin</a></p>
</body>
</html>
