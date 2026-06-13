<?php
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['admin_logged'])) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit; }
if (!csrf_verify()) { http_response_code(403); echo json_encode(['ok'=>false,'error'=>'CSRF invalide']); exit; }

$projet_id = (int)($_POST['projet_id'] ?? 0);
$field     = $_POST['field'] ?? '';
$value     = $_POST['value'] ?? '';

$allowed_fields = ['titre','client','nature_travaux','statut','pole','description','video_url'];
if ($projet_id <= 0 || !in_array($field, $allowed_fields)) {
    http_response_code(400); echo json_encode(['ok'=>false,'error'=>'Paramètre invalide']); exit;
}

// Valider les champs enum
if ($field === 'statut' && !in_array($value, ['termine','en_cours'])) {
    echo json_encode(['ok'=>false,'error'=>'Statut invalide']); exit;
}
if ($field === 'pole' && !in_array($value, ['btp','energie','routes','industrie'])) {
    echo json_encode(['ok'=>false,'error'=>'Pôle invalide']); exit;
}

$value = mb_substr(strip_tags(trim($value)), 0, 500);

$db = getDB();
$db->prepare("UPDATE projets SET {$field}=? WHERE id=?")->execute([$value, $projet_id]);

echo json_encode(['ok'=>true]);
