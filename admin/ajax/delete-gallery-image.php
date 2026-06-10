<?php
/**
 * COTRAC CMS — AJAX : Suppression d'une image de galerie
 * POST params: csrf_token, image_id
 */
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

define('CMS_UPLOAD_DIR', __DIR__ . '/../../uploads/cms/');

if (!isset($_SESSION['admin_logged'])) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit;
}
if (!csrf_verify()) {
    http_response_code(403);
    echo json_encode(['ok'=>false,'error'=>'Token CSRF invalide']); exit;
}

$image_id = isset($_POST['image_id']) && ctype_digit($_POST['image_id'])
    ? (int)$_POST['image_id'] : 0;

if ($image_id <= 0) {
    echo json_encode(['ok'=>false,'error'=>'ID invalide']); exit;
}

try {
    $db = getDB();
    $row = $db->prepare("SELECT image_path FROM page_section_images WHERE id=?");
    $row->execute([$image_id]);
    $img = $row->fetch();

    if (!$img) {
        echo json_encode(['ok'=>false,'error'=>'Image introuvable']); exit;
    }

    // Supprimer le fichier
    $path = CMS_UPLOAD_DIR . $img['image_path'];
    if (file_exists($path) && strpos($img['image_path'], '..') === false) {
        @unlink($path);
    }

    $db->prepare("DELETE FROM page_section_images WHERE id=?")->execute([$image_id]);

    echo json_encode(['ok'=>true,'message'=>'Image supprimée']);

} catch (Exception $e) {
    error_log('[CMS delete-gallery-image] ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
}
