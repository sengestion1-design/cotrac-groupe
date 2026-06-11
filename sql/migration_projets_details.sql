-- Migration : ajout colonnes annee, montant, lieu à la table projets
ALTER TABLE projets ADD COLUMN IF NOT EXISTS annee VARCHAR(10) DEFAULT NULL;
ALTER TABLE projets ADD COLUMN IF NOT EXISTS montant VARCHAR(100) DEFAULT NULL;
ALTER TABLE projets ADD COLUMN IF NOT EXISTS lieu VARCHAR(150) DEFAULT NULL;

UPDATE projets SET annee='2023', montant='262 889 361 FCFA', lieu='Dakar' WHERE titre LIKE '%ESP/UCAD%';
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
