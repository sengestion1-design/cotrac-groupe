<?php
require_once __DIR__ . '/config/database.php';
$db = getDB();

$projets = [
    [
        'titre'         => 'Complexe scolaire 12 classes - Mbour',
        'description'   => "Construction d'un complexe scolaire complet : 12 salles de classe, administration, bibliothèque, toilettes séparées garçons/filles et clôture. Livré en 8 mois pour le Ministère de l'Éducation Nationale.",
        'client'        => "Ministère de l'Éducation Nationale",
        'pole'          => 'btp',
        'statut'        => 'termine',
        'nature_travaux'=> 'Construction neuve — génie civil, maçonnerie, charpente, toiture, menuiseries, électricité, plomberie',
        'lieu'          => 'Mbour',
        'image'         => '',
    ],
    [
        'titre'         => 'Centre de santé communautaire - Tambacounda',
        'description'   => "Réalisation d'un centre de santé de 600 m² : consultation, maternité, laboratoire, pharmacie et logement médecin. Financement USAID - livraison dans les délais contractuels.",
        'client'        => 'USAID',
        'pole'          => 'btp',
        'statut'        => 'termine',
        'nature_travaux'=> 'Construction neuve — structure béton armé, aménagements intérieurs médicaux, réseaux fluides',
        'lieu'          => 'Tambacounda',
        'image'         => '',
    ],
    [
        'titre'         => "Réhabilitation d'immeuble administratif - Thiès",
        'description'   => "Rénovation complète d'un immeuble administratif de 4 étages : façades, toiture, menuiseries, installations électriques et plomberie. Surface : 2 400 m². Durée : 6 mois.",
        'client'        => '',
        'pole'          => 'btp',
        'statut'        => 'termine',
        'nature_travaux'=> 'Réhabilitation — ravalement façades, étanchéité toiture, remplacement menuiseries, mise aux normes électricité et plomberie',
        'lieu'          => 'Thiès',
        'image'         => '',
    ],
];

$stmt = $db->prepare("INSERT INTO projets (titre, description, client, pole, statut, nature_travaux, lieu, image, actif) VALUES (?,?,?,?,?,?,?,?,1)");

foreach ($projets as $p) {
    // Check not already inserted
    $exists = $db->prepare("SELECT id FROM projets WHERE titre=? LIMIT 1");
    $exists->execute([$p['titre']]);
    if ($exists->fetch()) {
        echo "Déjà existant : " . htmlspecialchars($p['titre']) . "<br>";
        continue;
    }
    $stmt->execute([$p['titre'], $p['description'], $p['client'], $p['pole'], $p['statut'], $p['nature_travaux'], $p['lieu'], $p['image']]);
    echo "Inséré (id=" . $db->lastInsertId() . ") : " . htmlspecialchars($p['titre']) . "<br>";
}
echo "<br><strong>Terminé. Supprimez ce fichier !</strong>";
