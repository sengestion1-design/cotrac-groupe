<?php
/**
 * COTRAC CMS — AJAX : Upload d'image pour une section
 * POST params:
 *   csrf_token, section_id, field_key (pour champ image simple)
 *   OU gallery_section_id + alt_text + caption (pour galerie)
 * FILE: image
 */
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

define('CMS_UPLOAD_DIR', __DIR__ . '/../../uploads/cms/');
define('CMS_UPLOAD_URL', SITE_URL . '/uploads/cms/');
define('CMS_MAX_SIZE',   5 * 1024 * 1024); // 5 Mo
define('CMS_ALLOWED',    ['jpg','jpeg','png','webp','gif']);

// Auth
if (!isset($_SESSION['admin_logged'])) {
    http_response_code(401);
    echo json_encode(['ok'=>false,'error'=>'Non autorisé']);
    exit;
}

// CSRF
if (!csrf_verify()) {
    http_response_code(403);
    echo json_encode(['ok'=>false,'error'=>'Token CSRF invalide']);
    exit;
}

// Vérifier fichier
if (empty($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    $err = $_FILES['image']['error'] ?? 99;
    $msgs = [
        UPLOAD_ERR_INI_SIZE   => 'Fichier trop lourd (limite serveur)',
        UPLOAD_ERR_FORM_SIZE  => 'Fichier trop lourd',
        UPLOAD_ERR_PARTIAL    => 'Upload incomplet',
        UPLOAD_ERR_NO_FILE    => 'Aucun fichier reçu',
    ];
    echo json_encode(['ok'=>false,'error'=>$msgs[$err] ?? 'Erreur d\'upload']);
    exit;
}

$file = $_FILES['image'];

// Taille
if ($file['size'] > CMS_MAX_SIZE) {
    echo json_encode(['ok'=>false,'error'=>'L\'image ne doit pas dépasser 5 Mo']);
    exit;
}

// Extension
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, CMS_ALLOWED, true)) {
    echo json_encode(['ok'=>false,'error'=>'Format non supporté. Utilisez : JPG, PNG, WEBP']);
    exit;
}

// Vérification MIME réelle
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime  = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
$allowed_mimes = ['image/jpeg','image/png','image/webp','image/gif'];
if (!in_array($mime, $allowed_mimes, true)) {
    echo json_encode(['ok'=>false,'error'=>'Type MIME non autorisé']);
    exit;
}

// Créer le répertoire si nécessaire
if (!is_dir(CMS_UPLOAD_DIR)) {
    mkdir(CMS_UPLOAD_DIR, 0755, true);
}

// Nom de fichier unique
$filename = 'cms_' . uniqid() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
$dest     = CMS_UPLOAD_DIR . $filename;

if (!move_uploaded_file($file['tmp_name'], $dest)) {
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>'Impossible de sauvegarder l\'image']);
    exit;
}

$db = getDB();

try {
    $mode = $_POST['mode'] ?? 'field'; // 'field' ou 'gallery'

    if ($mode === 'gallery') {
        // ---- Mode galerie : ajouter une image dans page_section_images ----
        $section_id = isset($_POST['section_id']) && ctype_digit($_POST['section_id'])
            ? (int)$_POST['section_id'] : 0;
        if ($section_id <= 0) throw new RuntimeException('section_id invalide');

        $alt     = mb_substr(strip_tags(trim($_POST['alt_text']   ?? '')), 0, 255);
        $caption = mb_substr(strip_tags(trim($_POST['caption']    ?? '')), 0, 255);

        // Prochain sort_order
        $maxOrder = $db->prepare(
            "SELECT COALESCE(MAX(sort_order),0)+1 FROM page_section_images WHERE section_id=?"
        );
        $maxOrder->execute([$section_id]);
        $nextOrder = (int)$maxOrder->fetchColumn();

        $ins = $db->prepare(
            "INSERT INTO page_section_images (section_id, image_path, alt_text, caption, sort_order)
             VALUES (?, ?, ?, ?, ?)"
        );
        $ins->execute([$section_id, $filename, $alt, $caption, $nextOrder]);
        $image_id = $db->lastInsertId();

        echo json_encode([
            'ok'        => true,
            'filename'  => $filename,
            'url'       => CMS_UPLOAD_URL . $filename,
            'image_id'  => (int)$image_id,
            'message'   => 'Image ajoutée à la galerie',
        ]);

    } else {
        // ---- Mode champ image simple ----
        $section_id = isset($_POST['section_id']) && ctype_digit($_POST['section_id'])
            ? (int)$_POST['section_id'] : 0;
        $field_key  = preg_replace('/[^a-z0-9_]/', '', strtolower($_POST['field_key'] ?? ''));

        if ($section_id <= 0 || empty($field_key)) {
            throw new RuntimeException('Paramètres manquants');
        }

        // Récupérer l'ancienne image pour la supprimer
        $old = $db->prepare(
            "SELECT field_value FROM page_section_fields WHERE section_id=? AND field_key=?"
        );
        $old->execute([$section_id, $field_key]);
        $oldRow = $old->fetch();
        if ($oldRow && !empty($oldRow['field_value'])) {
            $oldPath = CMS_UPLOAD_DIR . $oldRow['field_value'];
            if (file_exists($oldPath) && strpos($oldRow['field_value'], '..') === false) {
                @unlink($oldPath);
            }
        }

        // Mettre à jour le champ
        $upd = $db->prepare(
            "UPDATE page_section_fields SET field_value=? WHERE section_id=? AND field_key=?"
        );
        $upd->execute([$filename, $section_id, $field_key]);

        echo json_encode([
            'ok'       => true,
            'filename' => $filename,
            'url'      => CMS_UPLOAD_URL . $filename,
            'message'  => 'Image mise à jour',
        ]);
    }

} catch (Exception $e) {
    // Supprimer le fichier uploadé si erreur DB
    @unlink($dest);
    error_log('[CMS upload-image] ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
}
