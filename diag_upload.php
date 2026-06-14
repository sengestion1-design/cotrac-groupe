<?php
require_once __DIR__ . '/config/database.php';
$db = getDB();

echo "<h2>Diagnostic upload vidéo</h2>";
echo "<b>upload_max_filesize:</b> " . ini_get('upload_max_filesize') . "<br>";
echo "<b>post_max_size:</b> " . ini_get('post_max_size') . "<br>";
echo "<b>max_execution_time:</b> " . ini_get('max_execution_time') . "s<br>";
echo "<b>memory_limit:</b> " . ini_get('memory_limit') . "<br><br>";

$dir = __DIR__ . '/uploads/videos/';
echo "<b>Dossier uploads/videos/</b> : ";
if (is_dir($dir)) {
    echo "existe, ";
    echo is_writable($dir) ? "<span style='color:green'>inscriptible ✓</span>" : "<span style='color:red'>NON inscriptible ✗</span>";
} else {
    echo "<span style='color:red'>N'existe PAS ✗</span>";
}
echo "<br><br>";

echo "<b>Vidéos en base :</b><br>";
$rows = $db->query("SELECT id, titre, fichier, actif FROM videos_chantiers ORDER BY id")->fetchAll();
foreach ($rows as $r) {
    $exists = file_exists($dir . basename($r['fichier']));
    echo "id={$r['id']} | {$r['titre']} | {$r['fichier']} | actif={$r['actif']} | fichier " . ($exists ? "<span style='color:green'>présent ✓</span>" : "<span style='color:red'>manquant ✗</span>") . "<br>";
}
echo "<br><b>Supprimez ce fichier après lecture.</b>";
