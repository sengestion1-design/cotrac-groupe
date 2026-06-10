<?php
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['admin_logged'])) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit; }
if (!csrf_verify()) { http_response_code(403); echo json_encode(['ok'=>false,'error'=>'CSRF invalide']); exit; }

$projet_id = (int)($_POST['projet_id'] ?? 0);
if ($projet_id <= 0) { http_response_code(400); echo json_encode(['ok'=>false,'error'=>'ID projet invalide']); exit; }

if (empty($_FILES['image']['name'])) { echo json_encode(['ok'=>false,'error'=>'Aucun fichier']); exit; }

$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
$allowed = ['jpg','jpeg','png','webp','gif'];
if (!in_array($ext, $allowed)) { echo json_encode(['ok'=>false,'error'=>'Format non supporté']); exit; }
if ($_FILES['image']['size'] > 5 * 1024 * 1024) { echo json_encode(['ok'=>false,'error'=>'Fichier trop lourd (max 5 Mo)']); exit; }

$upload_dir = __DIR__ . '/../../uploads/projets/';
$image_name = uniqid('proj_') . '.' . $ext;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image_name)) {
    echo json_encode(['ok'=>false,'error'=>'Erreur enregistrement']); exit;
}

$db = getDB();
// Supprimer l'ancienne image si elle n'est pas partagée
$old = $db->prepare("SELECT image FROM projets WHERE id=?");
$old->execute([$projet_id]);
$old_img = $old->fetchColumn();
if ($old_img && !str_starts_with($old_img, 'http') && file_exists($upload_dir . $old_img)) {
    @unlink($upload_dir . $old_img);
}

$db->prepare("UPDATE projets SET image=? WHERE id=?")->execute([$image_name, $projet_id]);

echo json_encode(['ok'=>true, 'url'=> SITE_URL . '/uploads/projets/' . $image_name]);
