<?php
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

if (!isset($_SESSION['admin_logged'])) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit; }
if (!csrf_verify())                    { http_response_code(403); echo json_encode(['ok'=>false,'error'=>'CSRF invalide']); exit; }

$projet_id = (int)($_POST['projet_id'] ?? 0);
if ($projet_id <= 0) { echo json_encode(['ok'=>false,'error'=>'ID projet manquant']); exit; }

$upload_dir = __DIR__ . '/../../uploads/projets/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

$MAX = 200 * 1024 * 1024; // 200 Mo

if (empty($_FILES['video']) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
    $msgs = [
        UPLOAD_ERR_INI_SIZE  => 'Fichier trop lourd (limite serveur)',
        UPLOAD_ERR_FORM_SIZE => 'Fichier trop lourd',
        UPLOAD_ERR_PARTIAL   => 'Upload incomplet',
        UPLOAD_ERR_NO_FILE   => 'Aucun fichier reçu',
    ];
    $err = $_FILES['video']['error'] ?? 99;
    echo json_encode(['ok'=>false,'error'=>$msgs[$err] ?? 'Erreur upload']); exit;
}

$file = $_FILES['video'];
if ($file['size'] > $MAX) { echo json_encode(['ok'=>false,'error'=>'Vidéo trop lourde (max 200 Mo)']); exit; }

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
// Accepter aussi .mov (QuickTime) converti automatiquement
$allowed_exts = ['mp4','webm','ogg','mov'];
if (!in_array($ext, $allowed_exts, true)) {
    echo json_encode(['ok'=>false,'error'=>'Format non supporté (MP4, MOV, WEBM)']); exit;
}

// Les .mov on les renomme en .mp4 — ils sont souvent H.264 lisibles dans les navigateurs
$save_ext = ($ext === 'mov') ? 'mp4' : $ext;
$filename = 'projet_vid_' . $projet_id . '_' . uniqid() . '.' . $save_ext;
$dest = $upload_dir . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    http_response_code(500); echo json_encode(['ok'=>false,'error'=>'Impossible de sauvegarder la vidéo']); exit;
}

try {
    $db = getDB();

    // Migration auto
    try { $db->exec("ALTER TABLE projets ADD COLUMN IF NOT EXISTS video_url VARCHAR(500) DEFAULT NULL"); } catch(Exception $e){}

    // Supprimer l'ancienne vidéo uploadée si elle existe
    $old = $db->prepare("SELECT video_url FROM projets WHERE id=?");
    $old->execute([$projet_id]);
    $oldVal = $old->fetchColumn();
    if ($oldVal && !str_starts_with($oldVal, 'http')) {
        $safeOld = basename($oldVal);
        if (preg_match('/^[A-Za-z0-9._-]+\.(mp4|webm|ogg)$/i', $safeOld)) {
            $oldPath = realpath($upload_dir . $safeOld);
            $baseDir = realpath($upload_dir);
            if ($oldPath && $baseDir && str_starts_with($oldPath, $baseDir)) {
                @unlink($oldPath);
            }
        }
    }

    $db->prepare("UPDATE projets SET video_url=? WHERE id=?")->execute([$filename, $projet_id]);

    echo json_encode(['ok'=>true, 'filename'=>$filename, 'url'=> SITE_URL . '/uploads/projets/' . $filename]);
} catch (Exception $e) {
    @unlink($dest);
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
}
