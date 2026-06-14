<?php
session_start();
require_once '../../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: ../login.php'); exit; }
if (!csrf_verify()) { die('Erreur sécurité.'); }

$db = getDB();
$fichier = basename($_POST['fichier'] ?? '');
$eq_id = (int)($_POST['eq_id'] ?? 0);

if ($fichier && $eq_id) {
    $db->prepare("UPDATE equipements SET image=? WHERE id=?")->execute([$fichier, $eq_id]);
}
header('Location: ../check_eq_photos.php');
exit;
