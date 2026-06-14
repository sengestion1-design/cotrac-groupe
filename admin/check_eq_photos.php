<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$upload_dir = __DIR__ . '/../uploads/equipements/';

// Lister les fichiers sur le serveur
$files_on_server = [];
if (is_dir($upload_dir)) {
    foreach (scandir($upload_dir) as $f) {
        if ($f !== '.' && $f !== '..') $files_on_server[] = $f;
    }
}

// Lister les images en DB
$in_db = $db->query("SELECT id, nom, image FROM equipements WHERE image != '' AND image IS NOT NULL")->fetchAll();
$in_db_files = array_column($in_db, 'image');

// Fichiers sur serveur mais pas en DB
$orphans = array_diff($files_on_server, $in_db_files);

echo '<style>body{font-family:sans-serif;padding:20px;} table{border-collapse:collapse;width:100%;} td,th{padding:8px 12px;border:1px solid #ddd;} img{height:60px;}</style>';
echo '<h2>Fichiers dans uploads/equipements/ (' . count($files_on_server) . ')</h2>';
echo '<pre>' . implode("\n", $files_on_server) . '</pre>';

echo '<h2>Fichiers orphelins (sur serveur mais pas en DB) (' . count($orphans) . ')</h2>';
if ($orphans) {
    echo '<table><tr><th>Fichier</th><th>Aperçu</th><th>Action</th></tr>';
    $csrf = csrf_token();
    foreach ($orphans as $f) {
        $url = SITE_URL . '/uploads/equipements/' . $f;
        echo "<tr><td>$f</td><td><img src='$url'></td>";
        echo "<td>";
        // Lister les équipements pour pouvoir associer
        $equips = $db->query("SELECT id, nom FROM equipements ORDER BY nom")->fetchAll();
        echo "<form method='post' action='ajax/assign-eq-photo.php'>";
        echo "<input type='hidden' name='csrf_token' value='$csrf'>";
        echo "<input type='hidden' name='fichier' value='" . htmlspecialchars($f) . "'>";
        echo "<select name='eq_id'><option value=''>-- Associer à --</option>";
        foreach ($equips as $eq) echo "<option value='{$eq['id']}'>" . htmlspecialchars($eq['nom']) . "</option>";
        echo "</select> <button type='submit'>Associer</button></form>";
        echo "</td></tr>";
    }
    echo '</table>';
} else {
    echo '<p>Aucun fichier orphelin.</p>';
}

echo '<h2>Équipements en DB avec image</h2>';
echo '<table><tr><th>ID</th><th>Nom</th><th>Image DB</th><th>Aperçu</th></tr>';
foreach ($in_db as $eq) {
    $url = SITE_URL . '/uploads/equipements/' . $eq['image'];
    echo "<tr><td>{$eq['id']}</td><td>" . htmlspecialchars($eq['nom']) . "</td><td>{$eq['image']}</td><td><img src='$url' onerror=\"this.style.display='none'\"></td></tr>";
}
echo '</table>';
echo '<br><a href="equipements.php">← Retour</a>';
