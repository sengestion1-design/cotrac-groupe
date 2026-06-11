
-- Table admin
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table projets/réalisations
CREATE TABLE IF NOT EXISTS projets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    client VARCHAR(255),
    pole ENUM('btp','energie','routes','industrie') NOT NULL,
    statut ENUM('termine','en_cours') DEFAULT 'termine',
    nature_travaux VARCHAR(255),
    image VARCHAR(255),
    ordre INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table partenaires
CREATE TABLE IF NOT EXISTS partenaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    pole ENUM('btp','energie','routes','industrie','tous') DEFAULT 'tous',
    logo VARCHAR(255),
    ordre INT DEFAULT 0,
    actif TINYINT(1) DEFAULT 1
);

-- Table messages contact
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    telephone VARCHAR(30),
    sujet VARCHAR(255),
    message TEXT NOT NULL,
    lu TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table actualites
CREATE TABLE IF NOT EXISTS actualites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    contenu TEXT,
    image VARCHAR(255),
    actif TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin par défaut (mot de passe: Cotrac@2025!)
INSERT INTO admins (username, password) VALUES
('admin', '$2y$12$8K1p/a0dR1xqM4B3lQ9eOeZV7zJ3kN2mP6wX5yH8cT4fI1uS0vR2W');

-- Projets de référence
INSERT INTO projets (titre, description, client, pole, statut, nature_travaux) VALUES
('Piste d\'accès latéritique 25km Matam-Kanel', 'Construction d\'une piste d\'accès latéritique enrobée sur 25 km pour les villes de Matam et Kanel', 'HENAN CHINE', 'routes', 'termine', 'Routes & VRD'),
('Réfection routes bitumées campus ESP/UCAD', 'Travaux de réfection des routes bitumées du campus universitaire de l\'ESP pour un montant de 262 889 361 FCFA', 'Université Cheikh Anta Diop - ESP', 'routes', 'termine', 'Route bitumée'),
('Route bitumée Commune de Ngor', 'Réalisation de travaux de voiries (route bitumée) sur une distance de 3km', 'Commune de Ngor', 'routes', 'termine', 'Voirie bitumée'),
('Pistes rurales Commune de Ngoundiane', 'Réalisation de pistes rurales sur une distance de 10km', 'Commune de Ngoundiane (Thiès)', 'routes', 'termine', 'Pistes rurales'),
('Routes 2 voies allée Fass', 'Réalisation des routes les deux voies de l\'allée Fass', 'Commune de Gueule Tapée Fass-Colobane', 'routes', 'termine', 'Voirie'),
('Ouvrages assainissement Louga', 'Construction d\'ouvrages d\'assainissement des eaux usées pour la ville de Louga', 'SVTP/GC et ONAS', 'btp', 'termine', 'Assainissement, Hydraulique, Génie Civil'),
('Extraction carrière latérite Sébikhotane', 'Extraction d\'une carrière de latérite à Sébikhotane', 'EIFFAGE RAIL', 'routes', 'termine', 'Extraction Latérite'),
('Extraction carrière silex Thiès', 'Extraction d\'une carrière de silex vers Thiès', 'Ministère des Mines', 'routes', 'termine', 'Extraction Gravier Silex'),
('Station de service Diamniadio', 'Construction d\'une station de service à Diamniadio', 'Privé', 'btp', 'termine', 'Construction Station de Service'),
('Excavation sous-sol Les Mamelles', 'Excavation sous-sol, démolition et évacuation déblais sise aux Mamelles', 'GIE REFORME', 'btp', 'termine', 'Excavation, Démolition, Évacuation'),
('Digues de ceinture Ziguinchor', 'Réalisation de deux digues de ceinture à Ziguinchor (Oussouye) - 4 km', 'CGER et PROVAL-CV', 'routes', 'en_cours', 'Construction 2 digues de ceinture'),
('Implantation supports HT SENELEC', 'Projet d\'implantation de supports haute tension pour SENELEC', 'SENELEC', 'energie', 'termine', 'Réseaux HTA'),
('Installation lignes BT Keur Katim', 'Installation de lignes basse tension à Keur Katim', 'PROQUELEC', 'energie', 'termine', 'Réseaux BT'),
('Réhabilitation réseaux électriques ruraux', 'Réhabilitation de réseaux électriques ruraux et urbains', 'SENELEC', 'energie', 'termine', 'Réseaux HTA/BT'),
('Extraction carrière latérite Diack', 'Extraction d\'une carrière de latérite à Diack', 'CSE', 'routes', 'termine', 'Extraction Latérite');

-- Partenaires BTP
INSERT INTO partenaires (nom, pole) VALUES
('Eiffage Construction', 'btp'), ('SENELEC', 'btp'), ('OiLibya', 'btp'),
('Commune de Ngor', 'btp'), ('Ministère de la Santé', 'btp'),
('ALFA - Logement Forces Armées', 'btp'), ('CHN Albert Royer', 'btp'),
('ARM', 'btp'), ('SIFMA', 'btp'), ('Total', 'btp'),
-- Partenaires Énergie
('PROQUELEC', 'energie'), ('Expresso', 'energie'), ('SOBOA', 'energie'),
('ICS', 'energie'), ('DIYAR KABLO', 'energie'), ('armtek ELEKTRIK', 'energie'),
('SENICO', 'energie'), ('SEN\'EAU', 'energie'), ('WISE Energy Solutions', 'energie'),
-- Partenaires Routes
('AGETIP', 'routes'), ('AGEROUTE Sénégal', 'routes'), ('MITTA', 'routes'),
('FERA', 'routes'), ('Bank of Africa Sénégal', 'routes'),
('Banque Islamique du Sénégal', 'routes'), ('NSIA Banque', 'routes'),
('Banque Atlantique', 'routes'), ('HENAN CHINE', 'routes');

-- Migration : ajout colonnes annee, montant, lieu
ALTER TABLE projets ADD COLUMN IF NOT EXISTS annee VARCHAR(10) DEFAULT NULL;
ALTER TABLE projets ADD COLUMN IF NOT EXISTS montant VARCHAR(100) DEFAULT NULL;
ALTER TABLE projets ADD COLUMN IF NOT EXISTS lieu VARCHAR(150) DEFAULT NULL;

-- Mise à jour des données depuis les PDFs
UPDATE projets SET annee='2023', lieu='Dakar' WHERE titre LIKE '%ESP/UCAD%';
UPDATE projets SET annee='2022', lieu='Ngor, Dakar' WHERE titre LIKE '%Commune de Ngor%';
UPDATE projets SET annee='2018', lieu='Ngoundiane, Thiès' WHERE titre LIKE '%Ngoundiane%';
UPDATE projets SET annee='2017', lieu='Fass-Colobane, Dakar' WHERE titre LIKE '%allée Fass%';
UPDATE projets SET lieu='Matam et Kanel' WHERE titre LIKE '%Matam-Kanel%';
UPDATE projets SET lieu='Louga' WHERE titre LIKE '%Louga%';
UPDATE projets SET lieu='Sébikhotane' WHERE titre LIKE '%Sébikhotane%';
UPDATE projets SET lieu='Thiès' WHERE titre LIKE '%silex Thiès%';
UPDATE projets SET lieu='Diamniadio' WHERE titre LIKE '%Diamniadio%';
UPDATE projets SET lieu='Les Mamelles, Dakar' WHERE titre LIKE '%Mamelles%';
UPDATE projets SET lieu='Ziguinchor (Oussouye)' WHERE titre LIKE '%Ziguinchor%';
UPDATE projets SET lieu='Sénégal' WHERE titre LIKE '%SENELEC%';
UPDATE projets SET lieu='Keur Katim' WHERE titre LIKE '%Keur Katim%';
UPDATE projets SET lieu='Diack' WHERE titre LIKE '%Diack%';
