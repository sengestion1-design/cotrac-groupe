<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

$count = (int)$db->query("SELECT COUNT(*) FROM actualites")->fetchColumn();
if ($count > 0) {
    header('Location: ../actualites.php?msg=notempty&type=error'); exit;
}

$articles = [
  [
    'titre'   => 'COTRAC remporte un nouveau marché de voirie à Dakar',
    'contenu' => "COTRAC vient d'être retenu pour l'exécution des travaux de réhabilitation et d'élargissement d'un axe routier structurant dans la banlieue dakaroise. Ce chantier d'envergure mobilise nos équipes spécialisées en travaux publics ainsi qu'une partie significative de notre parc d'engins : pelles mécaniques Caterpillar, compacteurs et camions bennes.\n\nLes travaux portent sur une longueur de plusieurs kilomètres et incluent la pose de caniveaux, le reprofilage de la chaussée et l'installation d'éclairage public. Le délai d'exécution est fixé à 6 mois.\n\nCe marché confirme la confiance accordée à COTRAC par les maîtres d'ouvrage publics et renforce notre positionnement dans les travaux d'infrastructure au Sénégal.",
    'image'   => '',
  ],
  [
    'titre'   => 'Livraison d\'un poste de transformation HTA/BT — Région de Thiès',
    'contenu' => "COTRAC a réceptionné avec succès la construction et la mise en service d'un poste de transformation HTA/BT dans la région de Thiès. Ce projet s'inscrit dans le cadre de l'électrification rurale et a permis de connecter plusieurs villages au réseau électrique national.\n\nNos équipes de génie électrique ont assuré l'ensemble des opérations : génie civil, installation des cellules HTA préfabriquées EATON, pose du transformateur, raccordement BT et mise sous tension en coordination avec SENELEC.\n\nCOTRAC démontre une fois de plus sa capacité à intervenir sur des projets d'électrification complexes, de la conception à la mise en service.",
    'image'   => '',
  ],
  [
    'titre'   => 'COTRAC au Salon BTP Sénégal 2025 — Rencontres et partenariats',
    'contenu' => "COTRAC a participé au Salon National du BTP qui s'est tenu à Dakar en 2025. Notre stand a accueilli de nombreux professionnels du secteur : architectes, bureaux d'études, promoteurs immobiliers et représentants de l'administration publique.\n\nCette participation a été l'occasion de présenter nos réalisations récentes, nos capacités techniques et notre parc matériel. Plusieurs contacts commerciaux prometteurs ont été établis, ouvrant la voie à de futurs partenariats stratégiques.\n\nCOTRAC réaffirme son engagement à rester un acteur de référence dans le secteur du BTP et des travaux publics au Sénégal.",
    'image'   => '',
  ],
  [
    'titre'   => 'Chantier en cours : construction d\'un complexe industriel à Thiès',
    'contenu' => "COTRAC est actuellement en pleine exécution d'un chantier de construction d'un complexe industriel dans la zone franche de Thiès. Ce projet ambitieux comprend la réalisation de plusieurs bâtiments industriels, la mise en place des réseaux techniques (électricité, eau, assainissement) et l'aménagement des voiries intérieures.\n\nUne équipe de 45 ouvriers et techniciens est mobilisée sur ce chantier, supervisée par nos ingénieurs en génie civil et électrique. Le planning prévoit une livraison partielle d'ici la fin du trimestre.\n\nCe projet illustre parfaitement l'approche multimétiers de COTRAC, capable de prendre en charge l'intégralité d'un projet industriel de A à Z.",
    'image'   => '',
  ],
];

$stmt = $db->prepare("INSERT INTO actualites (titre, contenu, image, actif) VALUES (?,?,?,1)");
foreach ($articles as $a) {
    $stmt->execute([$a['titre'], $a['contenu'], $a['image']]);
}

header('Location: ../actualites.php?msg=imported&type=success'); exit;
