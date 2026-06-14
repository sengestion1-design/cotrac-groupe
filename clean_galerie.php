<?php
require_once __DIR__ . '/config/database.php';
$db = getDB();

// Lister toutes les entrées
$rows = $db->query("SELECT id, legende, onglet, fichier, actif FROM galerie_photos ORDER BY id")->fetchAll();

echo "<h2>Entrées galerie_photos</h2>";
echo "<form method='POST'>";
echo "<table border='1' cellpadding='6' style='border-collapse:collapse;font-size:13px;'>";
echo "<tr><th>ID</th><th>Onglet</th><th>Légende</th><th>Fichier</th><th>Actif</th><th>Supprimer</th></tr>";

foreach ($rows as $r) {
    $empty = empty($r['fichier']) || empty($r['legende']);
    $style = $empty ? 'background:#fff0f0;' : '';
    echo "<tr style='$style'>";
    echo "<td>{$r['id']}</td>";
    echo "<td>" . htmlspecialchars($r['onglet']) . "</td>";
    echo "<td>" . (htmlspecialchars($r['legende']) ?: '<em style="color:red">(vide)</em>') . "</td>";
    echo "<td>" . (htmlspecialchars($r['fichier']) ?: '<em style="color:red">(vide)</em>') . "</td>";
    echo "<td>{$r['actif']}</td>";
    echo "<td><input type='checkbox' name='del[]' value='{$r['id']}'" . ($empty ? ' checked' : '') . "></td>";
    echo "</tr>";
}
echo "</table>";
echo "<br><button type='submit' name='action' value='delete' style='background:red;color:#fff;padding:8px 20px;border:none;cursor:pointer;border-radius:6px;'>Supprimer les cochés</button>";
echo "</form>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['del'])) {
    $ids = array_map('intval', $_POST['del']);
    // Récupérer les fichiers avant suppression
    $in = implode(',', $ids);
    $files = $db->query("SELECT fichier FROM galerie_photos WHERE id IN ($in)")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($files as $f) {
        $path = __DIR__ . '/uploads/galerie/' . basename($f);
        if ($f && file_exists($path)) @unlink($path);
    }
    $db->exec("DELETE FROM galerie_photos WHERE id IN ($in)");
    echo "<br><strong style='color:green'>✓ Supprimé " . count($ids) . " entrée(s). Rechargez la page.</strong>";
    echo "<br><a href='clean_galerie.php'>Recharger</a>";
}

echo "<br><br><strong>Supprimez ce fichier après utilisation.</strong>";
