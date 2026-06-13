<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../config/database.php';

echo "<h2>Debug videos.php</h2>";

// Test DB
try {
    $db = getDB();
    echo "✅ DB OK<br>";
} catch(Exception $e) {
    echo "❌ DB: " . $e->getMessage() . "<br>";
}

// Test CREATE TABLE
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    echo "✅ Table videos_chantiers OK<br>";
} catch(Exception $e) {
    echo "❌ Table: " . $e->getMessage() . "<br>";
}

// Test SELECT
try {
    $videos = $db->query("SELECT * FROM videos_chantiers ORDER BY id DESC")->fetchAll();
    echo "✅ SELECT OK — " . count($videos) . " vidéo(s)<br>";
} catch(Exception $e) {
    echo "❌ SELECT: " . $e->getMessage() . "<br>";
}

// Test upload dir
$upload_dir = __DIR__ . '/../uploads/videos/';
if (!is_dir($upload_dir)) {
    if (mkdir($upload_dir, 0755, true)) echo "✅ Dossier uploads/videos/ créé<br>";
    else echo "❌ Impossible de créer uploads/videos/<br>";
} else {
    echo "✅ Dossier uploads/videos/ existe<br>";
}

// Test messages table
try {
    $nb = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();
    echo "✅ Table messages OK — $nb non lus<br>";
} catch(Exception $e) {
    echo "❌ Table messages: " . $e->getMessage() . "<br>";
}

// Test sidebar
$sidebar = __DIR__ . '/includes/sidebar.php';
echo (file_exists($sidebar) ? "✅" : "❌") . " includes/sidebar.php<br>";

$footer = __DIR__ . '/includes/footer.php';
echo (file_exists($footer) ? "✅" : "❌") . " includes/footer.php<br>";

$css = __DIR__ . '/css/admin.css';
echo (file_exists($css) ? "✅" : "❌") . " css/admin.css<br>";

echo "<br><b>PHP version:</b> " . PHP_VERSION . "<br>";
echo "<b>Session admin_logged:</b> " . (isset($_SESSION['admin_logged']) ? 'OUI' : 'NON') . "<br>";
