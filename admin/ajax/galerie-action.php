<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
// Accepte le token en GET (liens toggle/delete) ou POST (formulaires)
if (!empty($_GET['csrf_token'])) $_POST['csrf_token'] = $_GET['csrf_token'];
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

// Migration table galerie_photos
$db->exec("CREATE TABLE IF NOT EXISTS galerie_photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fichier VARCHAR(300) NOT NULL,
    legende VARCHAR(300) DEFAULT '',
    onglet VARCHAR(50) DEFAULT 'btp',
    couleur VARCHAR(20) DEFAULT '#1a6bb5',
    sort_order INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// ---- Suppression ----
if ($action === 'delete' && !empty($_GET['id'])) {
    $id = (int)$_GET['id'];
    $row = $db->prepare("SELECT fichier FROM galerie_photos WHERE id=?")->execute([$id]) ? $db->prepare("SELECT fichier FROM galerie_photos WHERE id=?") : null;
    $stmt = $db->prepare("SELECT fichier FROM galerie_photos WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row && !str_starts_with($row['fichier'], 'assets/')) {
        $path = __DIR__ . '/../../uploads/galerie/' . $row['fichier'];
        if (file_exists($path)) unlink($path);
    }
    $db->prepare("DELETE FROM galerie_photos WHERE id=?")->execute([$id]);
    header('Location: ../equipements.php?tab=galerie&msg=deleted');
    exit;
}

// ---- Toggle actif ----
if ($action === 'toggle' && !empty($_GET['id'])) {
    $db->prepare("UPDATE galerie_photos SET actif = NOT actif WHERE id=?")->execute([(int)$_GET['id']]);
    header('Location: ../equipements.php?tab=galerie&msg=toggled');
    exit;
}

// ---- Ajout / Modification POST ----
if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($action, ['add','edit'])) {
    $legende   = trim($_POST['legende'] ?? '');
    $onglet    = in_array($_POST['onglet'] ?? '', ['engins','btp','logistique']) ? $_POST['onglet'] : 'btp';
    $couleurs  = ['engins'=>'#1a6bb5','btp'=>'#f7941d','logistique'=>'#8e44ad'];
    $couleur   = $couleurs[$onglet];
    $edit_id   = isset($_POST['edit_id']) && is_numeric($_POST['edit_id']) ? (int)$_POST['edit_id'] : 0;

    $fichier = null;
    if (!empty($_FILES['photo']['name'])) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp']) && $_FILES['photo']['size'] <= 5*1024*1024) {
            $upload_dir = __DIR__ . '/../../uploads/galerie/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
            $fichier = 'gal_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir . $fichier);
        }
    }

    if ($edit_id) {
        if ($fichier) {
            // supprimer ancienne photo uploadée
            $old = $db->prepare("SELECT fichier FROM galerie_photos WHERE id=?");
            $old->execute([$edit_id]);
            $old_row = $old->fetch();
            if ($old_row && !str_starts_with($old_row['fichier'], 'assets/')) {
                $old_path = __DIR__ . '/../../uploads/galerie/' . $old_row['fichier'];
                if (file_exists($old_path)) unlink($old_path);
            }
            $db->prepare("UPDATE galerie_photos SET legende=?, onglet=?, couleur=?, fichier=? WHERE id=?")
               ->execute([$legende, $onglet, $couleur, $fichier, $edit_id]);
        } else {
            $db->prepare("UPDATE galerie_photos SET legende=?, onglet=?, couleur=? WHERE id=?")
               ->execute([$legende, $onglet, $couleur, $edit_id]);
        }
        header('Location: ../equipements.php?tab=galerie&msg=updated');
    } else {
        if (!$fichier) {
            header('Location: ../equipements.php?tab=galerie&err=nophoto');
            exit;
        }
        $max = (int)$db->query("SELECT MAX(sort_order) FROM galerie_photos")->fetchColumn();
        $db->prepare("INSERT INTO galerie_photos (fichier, legende, onglet, couleur, sort_order) VALUES (?,?,?,?,?)")
           ->execute([$fichier, $legende, $onglet, $couleur, $max + 1]);
        header('Location: ../equipements.php?tab=galerie&msg=added');
    }
    exit;
}

header('Location: ../equipements.php?tab=galerie');
exit;
