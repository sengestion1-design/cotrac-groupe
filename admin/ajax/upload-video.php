<?php
/**
 * COTRAC CMS — AJAX : Upload d'une vidéo MP4 pour un champ CMS
 * POST: csrf_token, section_id, field_key
 * FILE: video
 *
 * Prérequis php.ini (XAMPP : /Applications/XAMPP/xamppfiles/etc/php.ini) :
 *   upload_max_filesize = 100M   ; taille max d'un fichier uploadé
 *   post_max_size       = 100M   ; doit être >= upload_max_filesize
 *   max_execution_time  = 120    ; secondes max pour le script
 *   max_input_time      = 120    ; secondes max pour recevoir les données
 */
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

define('CMS_VIDEO_DIR', __DIR__ . '/../../uploads/cms/');
define('CMS_VIDEO_URL', SITE_URL . '/uploads/cms/');
define('CMS_VIDEO_MAX', 50 * 1024 * 1024); // 50 Mo

if (!isset($_SESSION['admin_logged'])) { http_response_code(401); echo json_encode(['ok'=>false,'error'=>'Non autorisé']); exit; }
if (!csrf_verify())                    { http_response_code(403); echo json_encode(['ok'=>false,'error'=>'CSRF invalide']); exit; }

if (empty($_FILES['video']) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
    $err = $_FILES['video']['error'] ?? 99;
    $msgs = [UPLOAD_ERR_INI_SIZE=>'Fichier trop lourd (limite serveur)',UPLOAD_ERR_FORM_SIZE=>'Fichier trop lourd',UPLOAD_ERR_PARTIAL=>'Upload incomplet',UPLOAD_ERR_NO_FILE=>'Aucun fichier reçu'];
    echo json_encode(['ok'=>false,'error'=>$msgs[$err] ?? 'Erreur upload']); exit;
}

$file = $_FILES['video'];
if ($file['size'] > CMS_VIDEO_MAX) { echo json_encode(['ok'=>false,'error'=>'Vidéo trop lourde (max 50 Mo)']); exit; }

$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, ['mp4','webm','ogg'], true)) { echo json_encode(['ok'=>false,'error'=>'Format non supporté (MP4, WEBM, OGG)']); exit; }

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
if (!in_array($mime, ['video/mp4','video/webm','video/ogg','application/octet-stream'], true)) {
    echo json_encode(['ok'=>false,'error'=>'Type MIME non autorisé']); exit;
}

$filename = 'cms_vid_' . uniqid() . '.' . $ext;
$dest     = CMS_VIDEO_DIR . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    http_response_code(500); echo json_encode(['ok'=>false,'error'=>'Impossible de sauvegarder la vidéo']); exit;
}

$section_id = isset($_POST['section_id']) && ctype_digit($_POST['section_id']) ? (int)$_POST['section_id'] : 0;
$field_key  = preg_replace('/[^a-z0-9_]/', '', strtolower($_POST['field_key'] ?? ''));

if ($section_id <= 0 || empty($field_key)) { @unlink($dest); echo json_encode(['ok'=>false,'error'=>'Paramètres manquants']); exit; }

try {
    $db = getDB();
    // Supprimer l'ancienne vidéo uploadée (pas les assets/)
    $old = $db->prepare("SELECT field_value FROM page_section_fields WHERE section_id=? AND field_key=?");
    $old->execute([$section_id, $field_key]);
    $oldVal = $old->fetchColumn();
    if ($oldVal && str_starts_with($oldVal, 'cms_vid_') && file_exists(CMS_VIDEO_DIR . $oldVal)) {
        @unlink(CMS_VIDEO_DIR . $oldVal);
    }

    $db->prepare("UPDATE page_section_fields SET field_value=? WHERE section_id=? AND field_key=?")
       ->execute([$filename, $section_id, $field_key]);

    echo json_encode(['ok'=>true, 'filename'=>$filename, 'url'=> CMS_VIDEO_URL . $filename]);
} catch (Exception $e) {
    @unlink($dest);
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
}
