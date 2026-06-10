<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { echo json_encode(['ok'=>false,'error'=>'Method']); exit; }
if (!verify_csrf($_POST['csrf_token'] ?? ''))  { echo json_encode(['ok'=>false,'error'=>'CSRF']); exit; }

$image_id = (int)($_POST['image_id'] ?? 0);
$alt_text  = trim($_POST['alt_text']  ?? '');
$caption   = trim($_POST['caption']   ?? '');

if (!$image_id) { echo json_encode(['ok'=>false,'error'=>'ID manquant']); exit; }

$db = getDB();
$st = $db->prepare("UPDATE page_section_images SET alt_text=?, caption=? WHERE id=?");
$st->execute([$alt_text, $caption, $image_id]);

echo json_encode(['ok'=>true]);
