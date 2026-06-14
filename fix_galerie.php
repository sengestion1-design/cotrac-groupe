<?php
session_start();
require_once __DIR__ . '/config/database.php';
if (!isset($_SESSION['admin_logged'])) { header('Location: /admin/login.php'); exit; }
if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

$db = getDB();
$upload_dir = __DIR__ . '/uploads/galerie/';

// Trouver les entrées dont le fichier est manquant sur le serveur
$rows = $db->query("SELECT * FROM galerie_photos ORDER BY id")->fetchAll();
$broken = [];
foreach ($rows as $r) {
    if (str_starts_with($r['fichier'], 'assets/')) continue; // fichier statique, OK
    $path = $upload_dir . basename($r['fichier']);
    if (!file_exists($path)) $broken[] = $r;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'] ?? '')) die('Token invalide');
    $deleted = 0;
    foreach ($broken as $r) {
        $db->prepare("DELETE FROM galerie_photos WHERE id=?")->execute([$r['id']]);
        $deleted++;
    }
    echo "<p style='color:green;font-weight:bold'>✓ $deleted entrée(s) supprimée(s). <a href='/nos-ressources'>Voir la galerie</a></p>";
    echo "<p>Supprimez ce fichier : <code>fix_galerie.php</code></p>";
    exit;
}
?>
<h2>Images manquantes dans galerie_photos</h2>
<?php if (empty($broken)): ?>
  <p style="color:green">✓ Aucune image manquante — tout est OK.</p>
<?php else: ?>
  <p><?= count($broken) ?> entrée(s) avec fichier introuvable sur le serveur :</p>
  <table border="1" cellpadding="6" style="border-collapse:collapse">
    <tr><th>ID</th><th>Légende</th><th>Fichier</th></tr>
    <?php foreach ($broken as $r): ?>
    <tr style="background:#fff0f0">
      <td><?= $r['id'] ?></td>
      <td><?= htmlspecialchars($r['legende']) ?></td>
      <td><?= htmlspecialchars($r['fichier']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <form method="POST" style="margin-top:16px">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <button name="confirm" value="1" style="background:red;color:#fff;padding:8px 20px;border:none;cursor:pointer;border-radius:6px">
      Supprimer ces <?= count($broken) ?> entrée(s)
    </button>
  </form>
<?php endif; ?>
<p style="margin-top:20px"><strong>Supprimez ce fichier après utilisation.</strong></p>
