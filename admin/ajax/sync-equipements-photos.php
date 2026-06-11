<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

// Association nom partiel → fichier dans assets/ressources/
// Format : [fragment du nom en DB => chemin relatif depuis la racine du site]
$mapping = [
    // Engins
    'Chargeur Caterpillar'          => 'assets/ressources/engin-chargeur.jpg',
    'Camions 20m'                   => 'assets/ressources/engin-camion-60t.jpg',
    'Camion benne 12m'              => 'assets/ressources/engin-camions-16m3.jpg',
    'Camion porte-charge'           => 'assets/ressources/engin-camion-benne.jpg',
    'Camion-citerne'                => 'assets/ressources/prod-citerne.jpg',
    'Véhicules de liaison'          => 'assets/ressources/engin-camions.jpg',
    // BTP / logistique
    'Bétonnières'                   => 'assets/ressources/logi-betonnieres.jpg',
    'Monte-charge'                  => 'assets/ressources/logi-monte-charge.jpg',
    // Électrique
    'Luminaires'                    => 'assets/ressources/elec-eclairage-poteau.jpg',
    'Transformateurs'               => 'assets/ressources/elec-poste-transformation.jpg',
    'Cellules préfabriquées'        => 'assets/ressources/elec-cellule-hta.jpg',
    'Câbles électriques'            => 'assets/ressources/elec-tranchee-cable.jpg',
    'Poteaux béton'                 => 'assets/ressources/elec-pose-poteau.jpg',
    'Pylônes métalliques'           => 'assets/ressources/elec-pose-poteaux-grue.jpg',
    'Groupe électrogène 15'         => 'assets/ressources/logi-chargeur-echafaudage.jpg',
    'Groupes électrogènes jusqu'    => 'assets/ressources/elec-genie-industriel.jpg',
    // Génie industriel
    'Postes à souder'               => 'assets/ressources/logi-chargeur-echafaudage.jpg',
    'Machines-outils'               => 'assets/ressources/elec-genie-industriel.jpg',
    'Matériels topographiques'      => 'assets/ressources/elec-plan-reseau.jpg',
];

// Pour la colonne image on stocke le chemin relatif assets/...
// nos-ressources.php construit l'URL avec SITE_URL . '/' . $eq['image']
// Donc on stocke : assets/ressources/xxx.jpg (sans slash initial)

$all = $db->query("SELECT id, nom FROM equipements")->fetchAll();
$updated = 0;

foreach ($all as $eq) {
    $img = '';
    foreach ($mapping as $fragment => $path) {
        if (mb_stripos($eq['nom'], $fragment) !== false) {
            $img = $path;
            break;
        }
    }
    if ($img) {
        $db->prepare("UPDATE equipements SET image=? WHERE id=? AND (image IS NULL OR image='')")
           ->execute([$img, $eq['id']]);
        $updated++;
    }
}

header('Location: ../equipements.php?synced=' . $updated);
exit;
