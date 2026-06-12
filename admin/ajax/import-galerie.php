<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

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

$count = (int)$db->query("SELECT COUNT(*) FROM galerie_photos")->fetchColumn();
if ($count > 0) {
    header('Location: ../equipements.php?tab=galerie&err=notempty');
    exit;
}

$photos = [
    ['assets/ressources/engin-camion-60t.jpg',          'Camion 60 tonnes COTRAC',              'engins',    '#1a6bb5'],
    ['assets/ressources/engin-camions.jpg',              'Parc camions — maintenance',            'engins',    '#1a6bb5'],
    ['assets/ressources/engin-camions-16m3.jpg',         'Camions bennes 16m³',                  'engins',    '#1a6bb5'],
    ['assets/ressources/engin-camion-benne.jpg',         'Camions bennes chargement',             'engins',    '#1a6bb5'],
    ['assets/ressources/engin-chargeur.jpg',             'Chargeur COTRAC en opération',          'engins',    '#1a6bb5'],
    ['assets/ressources/prod-presse-briques.jpg',        'Presse à briques — production',         'btp',       '#f7941d'],
    ['assets/ressources/prod-presse-briques2.jpg',       'Machine briques pondeuses COTRAC',      'btp',       '#f7941d'],
    ['assets/ressources/prod-chantier-vue.jpg',          'Vue générale chantier de production',   'btp',       '#f7941d'],
    ['assets/ressources/prod-sechage-agglos.jpg',        'Aire de séchage agglos et bordures',    'btp',       '#f7941d'],
    ['assets/ressources/prod-depot-materiaux.jpg',       'Dépôts sables, agglos et bétons',       'btp',       '#f7941d'],
    ['assets/ressources/prod-citerne.jpg',               'Citerne COTRAC — alimentation eau',     'btp',       '#f7941d'],
    ['assets/ressources/elec-eclairage-poteau.jpg',      'Installation luminaire LED sur poteau', 'btp',       '#1a6bb5'],
    ['assets/ressources/elec-plan-reseau.jpg',           'Ingénieure COTRAC — plan réseau BT',   'btp',       '#1a6bb5'],
    ['assets/ressources/elec-pose-poteau.jpg',           'Pose poteau béton — réseau rural',      'btp',       '#1a6bb5'],
    ['assets/ressources/elec-pose-poteaux-grue.jpg',     'Pose poteaux béton à la grue',          'btp',       '#1a6bb5'],
    ['assets/ressources/elec-tranchee-cable.jpg',        'Tranchée câble souterrain HTA',         'btp',       '#1a6bb5'],
    ['assets/ressources/elec-cellule-hta.jpg',           'Cellule HTA préfabriquée EATON',        'btp',       '#1a6bb5'],
    ['assets/ressources/elec-poste-transformation.jpg',  'Poste de transformation HTA/BT',        'btp',       '#1a6bb5'],
    ['assets/ressources/elec-genie-industriel.jpg',      'Travaux génie industriel — usine',      'btp',       '#1a6bb5'],
    ['assets/ressources/logi-chargeur-echafaudage.jpg',  'Chargeur + échafaudages — logistique',  'logistique','#8e44ad'],
    ['assets/ressources/logi-betonnieres.jpg',           'Bétonnières COTRAC 500L',               'logistique','#8e44ad'],
    ['assets/ressources/logi-monte-charge.jpg',          'Monte-charge électrique chantier',      'logistique','#8e44ad'],
    ['assets/ressources/logi-betonnieres2.jpg',          'Livraison bétonnière 500L',             'logistique','#8e44ad'],
    ['assets/ressources/equipe-terrain.jpg',             'Équipe COTRAC — inspection terrain',    'btp',       '#f7941d'],
];

$stmt = $db->prepare("INSERT INTO galerie_photos (fichier, legende, onglet, couleur, sort_order) VALUES (?,?,?,?,?)");
foreach ($photos as $i => $p) {
    $stmt->execute([$p[0], $p[1], $p[2], $p[3], $i + 1]);
}

header('Location: ../equipements.php?tab=galerie&msg=imported');
exit;
