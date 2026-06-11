<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

// Ne rien faire si déjà peuplé
$count = (int)$db->query("SELECT COUNT(*) FROM equipements")->fetchColumn();
if ($count > 0) {
    header('Location: ../equipements.php');
    exit;
}

$data = [
    // [nom, description, quantite, categorie]
    ['Pelle mécanique Caterpillar 325C',      'Terrassement & excavation',           '2 unités',    'engins'],
    ['Bulldozer Caterpillar D8R',             'Décapage & nivellement',              '2 unités',    'engins'],
    ['Chargeur Caterpillar 930-950',          'Chargement & manutention',            '2 unités',    'engins'],
    ['Niveleuse Caterpillar 140H',            'Mise en forme plateforme',            '2 unités',    'engins'],
    ['Compacteurs mécaniques',               'Compactage des sols',                 '2 unités',    'engins'],
    ['Foreuses / Foreuse de forage',          'Forage & fondations',                 '3 unités',    'engins'],
    ['Vibreurs (aiguilles vibrantes)',        'Vibration & mise en place béton',     '14 unités',   'engins'],
    ['Dumper / Tombereau',                    'Transport matériaux chantier',        '4 unités',    'engins'],
    ['Grue de chantier',                      'Levage & manutention lourde',         '',            'engins'],
    ['Monte-charge électrique 1000kg',        'Élévation charges',                  '1 unité',     'engins'],
    ['Compresseur à air',                     'Outils pneumatiques',                '1 unité',     'engins'],
    ['Conteneurs 20 pieds',                   'Stockage matériaux & outillage',      '10 unités',   'engins'],
    ['Brouettes',                             'Manutention manuelle chantier',       '75 unités',   'engins'],
    ['Serre-joints',                          'Assemblage & coffrage',               '2000 unités', 'engins'],
    ['Camions 20m³',                          'Transport grands volumes',            '5 unités',    'vehicules'],
    ['Camion benne 12m³ & 20m³',             'Transport matériaux chantier',        '2 unités',    'vehicules'],
    ['Camion porte-charge Renault Crax 440',  'Transport engins lourds',             '1 unité',     'vehicules'],
    ['Camion-citerne',                        'Alimentation eau chantier',           '1 unité',     'vehicules'],
    ['Véhicules de liaison pick-up',          'Mobilité équipes terrain',            '7 unités',    'vehicules'],
    ['Groupe électrogène 15 KVA',             'Alimentation électrique chantier',    '1 unité (parc)', 'electrique'],
    ['Groupes électrogènes jusqu\'à 450 KVA','Fourniture & pose sur site client',   'installation client', 'electrique'],
    ['Poteaux béton armé',                    'Supports lignes aériennes HTA/BT',   'fourniture & pose', 'electrique'],
    ['Pylônes métalliques',                   'Supports lignes haute tension',       'fourniture & pose', 'electrique'],
    ['Transformateurs HTA/BT',               'Construction postes de transformation','fourniture & pose', 'electrique'],
    ['Cellules préfabriquées HTA',            'Distribution haute tension',          'fourniture & pose', 'electrique'],
    ['Luminaires LED / SHP',                  'Éclairage public & industriel',       'fourniture & pose', 'electrique'],
    ['Câbles électriques HTA/BT',             'Réseaux aériens & souterrains',       'fourniture & pose', 'electrique'],
    ['Postes à souder',                       'Soudage MIG/TIG/Arc',                '12 unités',   'industriel'],
    ['Jeux de chalumeaux complets',           'Soudage oxyacétylénique',             '4 unités',    'industriel'],
    ['Meuleuses grand modèle',               'Meulage & découpe',                   '2 unités',    'industriel'],
    ['Meuleuses petit modèle',               'Finition & ébarbage',                 '2 unités',    'industriel'],
    ['Caisses à outils soudeurs',             'Outillage soudure',                   '3 unités',    'industriel'],
    ['Caisses à outils chaudronnerie',        'Outillage chaudronnerie',             '3 unités',    'industriel'],
    ['Palans & élingues',                     'Levage industriel',                   '',            'industriel'],
    ['Machines-outils (tour, fraiseuse)',     'Usinage pièces mécaniques',           '',            'industriel'],
    ['Bétonnières 500 L',                     'Préparation béton',                   '3 unités',    'industriel'],
    ['Matériels topographiques',             'Relevés & implantations',             '1 unité',     'industriel'],
];

$couleurs = [
    'engins'     => '#1a6bb5',
    'vehicules'  => '#f7941d',
    'electrique' => '#27ae60',
    'industriel' => '#8e44ad',
];

$stmt = $db->prepare("INSERT INTO equipements (nom, description, quantite, categorie, couleur, sort_order) VALUES (?,?,?,?,?,?)");
foreach ($data as $i => $row) {
    $stmt->execute([$row[0], $row[1], $row[2], $row[3], $couleurs[$row[3]], $i]);
}

header('Location: ../equipements.php?imported=1');
exit;
