<?php
session_start();
require_once '../../config/database.php';
if (!isset($_SESSION['admin_logged'])) { http_response_code(403); exit; }
if (!csrf_verify()) { http_response_code(403); exit; }

$db = getDB();

$titre = "Le Sénégal bâtit son avenir : ce que la Vision 2050 change pour le secteur BTP";

$contenu = "Le Sénégal vit une décennie de transformation infrastructurelle sans précédent. Avec le lancement officiel de la Vision Sénégal 2050 et de son premier plan opérationnel — la Stratégie Nationale de Développement 2025-2029 — le pays s'engage dans un programme d'investissements publics estimé à 18 496 milliards de francs CFA sur cinq ans. Pour les entreprises du BTP, les opportunités sont massives, concrètes et déjà en marche.

Un chantier national à l'échelle d'une génération

Hier encore, les entreprises de travaux publics sénégalaises opéraient sur des marchés fragmentés, dépendants de financements externes incertains. Aujourd'hui, le cadre a changé. Le gouvernement a inscrit dans son Masterplan 2025-2034 la réalisation de corridors routiers et ferroviaires structurants, l'extension de l'électrification rurale à l'ensemble du territoire, la construction de zones industrielles dans les pôles régionaux, et un programme ambitieux de logements sociaux — dont 60 000 unités en cours de livraison dans le cadre du programme des 100 000 logements.

L'autoroute Mbour-Fatick-Kaolack, longue de 100 kilomètres, illustre à elle seule l'ampleur de cette dynamique : financée à hauteur de 738 millions d'euros, présentant un taux d'avancement supérieur à 90 % fin 2025, elle matérialise la volonté de désenclaver les régions productrices et de connecter le centre du pays aux corridors économiques côtiers.

Un secteur BTP en pleine expansion

La Vision 2050 ne se limite pas aux autoroutes. Elle dessine un Sénégal où six corridors ferroviaires relient les pôles territoriaux, où les zones rurales accèdent à l'énergie grâce à des mini-réseaux solaires, où les villes secondaires disposent d'infrastructures sanitaires, scolaires et industrielles à la hauteur de leur potentiel. Le pôle urbain de Diamniadio — avec ses 40 000 logements planifiés — est déjà devenu le laboratoire grandeur nature de cette ambition.

Pour le secteur du BTP, cette trajectoire signifie une demande soutenue en génie civil, en travaux électriques haute et basse tension, en construction de routes et en réhabilitation d'ouvrages d'art. Les entreprises capables d'intervenir à grande échelle, avec rigueur technique et ancrage territorial, sont au cœur de cette révolution silencieuse.

COTRAC, acteur engagé dans la transformation du Sénégal

Depuis 2015, COTRAC accompagne cette montée en puissance infrastructurelle depuis le terrain. Présente dans 14 régions du Sénégal — de Dakar à Tambacounda, de Saint-Louis à Ziguinchor —, l'entreprise intervient sur les quatre pôles stratégiques que la Vision 2050 place en priorité : ingénierie électrique (HTA, MT, BT), travaux routiers, génie civil et électrification rurale.

Partenaire de SENELEC, d'AGEROUTE et de l'ONAS, COTRAC n'est pas un spectateur de cette transformation : elle en est un acteur de terrain, quotidien, engagé. Avec plus de 25 projets réalisés et une équipe formée aux exigences des marchés publics les plus complexes, COTRAC met son expertise au service du Sénégal qui se construit.

Vous avez un projet dans le cadre des grands chantiers nationaux ? Contactez-nous pour une étude gratuite sous 48h.";

$db->prepare("INSERT INTO actualites (titre, contenu, image, actif) VALUES (?,?,?,1)")
   ->execute([$titre, $contenu, '']);

header('Location: ../actualites.php?msg=actu_btp&type=success'); exit;
