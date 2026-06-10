<?php
/**
 * COTRAC CMS — AJAX : Sauvegarde d'une section (champs texte/html/number/url)
 * POST params:
 *   csrf_token, section_id, fields[field_key] = value, ...
 *   active (0|1), sort_order (int)
 */
session_start();
require_once '../../config/database.php';
header('Content-Type: application/json; charset=utf-8');

// --- DEBUG LOG (supprimer en production) ---
$debug_log = '[CMS save-section] ' . date('Y-m-d H:i:s') . "\n"
    . '  METHOD      : ' . $_SERVER['REQUEST_METHOD'] . "\n"
    . '  REQUEST_URI : ' . ($_SERVER['REQUEST_URI'] ?? '') . "\n"
    . '  POST keys   : ' . implode(', ', array_keys($_POST)) . "\n"
    . '  section_id  : ' . ($_POST['section_id'] ?? '(absent)') . "\n"
    . '  csrf_token  : ' . (isset($_POST['csrf_token']) ? substr($_POST['csrf_token'], 0, 8) . '...' : '(absent)') . "\n"
    . '  X-CSRF hdr  : ' . (getallheaders()['X-CSRF-Token'] ?? '(absent)') . "\n"
    . '  SESSION csrf: ' . (isset($_SESSION['csrf_token']) ? substr($_SESSION['csrf_token'], 0, 8) . '...' : '(absent)') . "\n";
error_log($debug_log);
// -------------------------------------------

// Auth
if (!isset($_SESSION['admin_logged'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Non autorisé']);
    exit;
}

// CSRF — accepte POST body ou header HTTP
if (!csrf_verify()) {
    error_log('[CMS save-section] CSRF FAILED — see debug above');
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'Token CSRF invalide']);
    exit;
}

$db = getDB();

try {
    // Lire section_id depuis POST (FormData envoie toujours en POST body)
    $raw_id = $_POST['section_id'] ?? '';
    $section_id = (int)trim($raw_id);

    if ($section_id <= 0) {
        throw new RuntimeException(
            'section_id invalide (reçu: ' . ($raw_id === '' ? 'vide' : htmlspecialchars($raw_id)) . ')'
        );
    }

    // Vérifier que la section existe
    $sec = $db->prepare("SELECT id FROM page_sections WHERE id = ?");
    $sec->execute([$section_id]);
    if (!$sec->fetch()) throw new RuntimeException('Section introuvable (id=' . $section_id . ')');

    // Mettre à jour active si fourni
    if (isset($_POST['active'])) {
        $active = (int)(bool)$_POST['active'];
        $db->prepare("UPDATE page_sections SET active = ? WHERE id = ?")
           ->execute([$active, $section_id]);
    }

    // Mettre à jour sort_order si fourni
    if (isset($_POST['sort_order']) && ctype_digit((string)$_POST['sort_order'])) {
        $db->prepare("UPDATE page_sections SET sort_order = ? WHERE id = ?")
           ->execute([(int)$_POST['sort_order'], $section_id]);
    }

    // Mettre à jour les champs
    if (isset($_POST['fields']) && is_array($_POST['fields'])) {
        $upd = $db->prepare(
            "UPDATE page_section_fields
             SET field_value = ?
             WHERE section_id = ? AND field_key = ?"
        );
        foreach ($_POST['fields'] as $fkey => $fvalue) {
            // Sanitiser la clé
            $fkey = preg_replace('/[^a-z0-9_]/', '', strtolower($fkey));
            if (empty($fkey)) continue;

            // Récupérer le type du champ
            $typeRow = $db->prepare(
                "SELECT field_type FROM page_section_fields WHERE section_id=? AND field_key=?"
            );
            $typeRow->execute([$section_id, $fkey]);
            $typeData = $typeRow->fetch();
            if (!$typeData) continue;

            $fvalue = match($typeData['field_type']) {
                'text'     => mb_substr(strip_tags(trim($fvalue)), 0, 500),
                'textarea' => mb_substr(strip_tags(trim($fvalue)), 0, 2000),
                'html'     => trim($fvalue), // échappé à l'affichage
                'number'   => (string)(int)$fvalue,
                'url'      => filter_var(trim($fvalue), FILTER_SANITIZE_URL),
                'color'    => preg_match('/^#[0-9a-fA-F]{3,8}$/', trim($fvalue)) ? trim($fvalue) : '',
                default    => mb_substr(strip_tags(trim($fvalue)), 0, 500),
            };

            $upd->execute([$fvalue, $section_id, $fkey]);
        }
    }

    echo json_encode(['ok' => true, 'message' => 'Section sauvegardée avec succès']);

} catch (Exception $e) {
    error_log('[CMS save-section] EXCEPTION: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
