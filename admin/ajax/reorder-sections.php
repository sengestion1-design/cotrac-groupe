<?php
/**
 * COTRAC CMS — AJAX : Réordonnancement des sections par drag & drop
 * POST params: csrf_token, order[] (tableau d'IDs dans le nouvel ordre)
 */
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['admin_logged'])) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit;
}
if (!csrf_verify()) {
    http_response_code(403);
    echo json_encode(['ok'=>false,'error'=>'Token CSRF invalide']); exit;
}

$order = $_POST['order'] ?? [];
if (!is_array($order) || empty($order)) {
    echo json_encode(['ok'=>false,'error'=>'Ordre manquant']); exit;
}

try {
    $db  = getDB();
    $upd = $db->prepare("UPDATE page_sections SET sort_order=? WHERE id=?");
    foreach ($order as $i => $id) {
        if (!ctype_digit((string)$id)) continue;
        $upd->execute([(($i + 1) * 10), (int)$id]);
    }
    echo json_encode(['ok'=>true,'message'=>'Ordre sauvegardé']);
} catch (Exception $e) {
    error_log('[CMS reorder] ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
}
