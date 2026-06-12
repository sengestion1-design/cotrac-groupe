<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

// Déplacer le groupe électrogène 15 KVA dans engins
$db->prepare("UPDATE equipements SET categorie='engins', couleur='#1a6bb5' WHERE nom LIKE '%Groupe électrogène 15%'")
   ->execute();

// Supprimer tous les autres items électrique (prestations/matériaux)
$db->prepare("DELETE FROM equipements WHERE categorie='electrique' AND nom NOT LIKE '%Groupe électrogène 15%'")
   ->execute();

header('Location: ../equipements.php?fixed=1');
exit;
