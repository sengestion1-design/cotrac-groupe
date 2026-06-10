-- ============================================================
-- COTRAC CMS — Schéma de la gestion des contenus de pages
-- ============================================================

-- Table principale : sections de contenu par page
CREATE TABLE IF NOT EXISTS `page_sections` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_slug`    VARCHAR(60)  NOT NULL COMMENT 'ex: index, btp, energie, routes, industrie, a-propos, realisations, actualites, contact',
  `section_key`  VARCHAR(80)  NOT NULL COMMENT 'identifiant machine unique, ex: hero, intro_text, stats, services_cards',
  `section_type` ENUM('hero','text','image','gallery','stats','cards') NOT NULL DEFAULT 'text',
  `label`        VARCHAR(120) NOT NULL COMMENT 'Nom lisible affiché dans l admin',
  `sort_order`   SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `active`       TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_page_section` (`page_slug`, `section_key`),
  KEY `idx_page_order` (`page_slug`, `sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des champs de contenu (EAV flexible)
CREATE TABLE IF NOT EXISTS `page_section_fields` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id`   INT UNSIGNED NOT NULL,
  `field_key`    VARCHAR(60)  NOT NULL COMMENT 'ex: title, subtitle, body, image_path, alt',
  `field_type`   ENUM('text','textarea','html','image','number','color','url') NOT NULL DEFAULT 'text',
  `field_label`  VARCHAR(120) NOT NULL,
  `field_value`  MEDIUMTEXT   DEFAULT NULL,
  `sort_order`   SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_section_field` (`section_id`, `field_key`),
  KEY `idx_section` (`section_id`),
  CONSTRAINT `fk_field_section`
    FOREIGN KEY (`section_id`) REFERENCES `page_sections` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table des images de galerie (pour sections type=gallery)
CREATE TABLE IF NOT EXISTS `page_section_images` (
  `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id`   INT UNSIGNED NOT NULL,
  `image_path`   VARCHAR(255) NOT NULL,
  `alt_text`     VARCHAR(255) DEFAULT NULL,
  `caption`      VARCHAR(255) DEFAULT NULL,
  `sort_order`   SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `created_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_section_images` (`section_id`),
  CONSTRAINT `fk_img_section`
    FOREIGN KEY (`section_id`) REFERENCES `page_sections` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Données initiales : définition des sections par page
-- (les field_value seront NULL = fallback vers contenu statique)
-- ============================================================

-- PAGE : index (Accueil)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('index','hero',          'hero',   'Section Hero (bannière principale)', 10),
('index','intro_text',    'text',   'Texte d\'introduction',              20),
('index','poles_cards',   'cards',  'Cartes des pôles d\'activité',       30),
('index','stats',         'stats',  'Chiffres clés',                      40),
('index','cta',           'text',   'Appel à l\'action (CTA)',            50);

-- PAGE : btp (Pôle BTP)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('btp','hero',            'hero',   'Section Hero BTP',                   10),
('btp','intro_text',      'text',   'Introduction du pôle',               20),
('btp','services_cards',  'cards',  'Cartes des services BTP',            30),
('btp','gallery',         'gallery','Galerie de réalisations BTP',        40),
('btp','stats',           'stats',  'Chiffres clés BTP',                  50);

-- PAGE : energie (Pôle Énergie)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('energie','hero',        'hero',   'Section Hero Énergie',               10),
('energie','intro_text',  'text',   'Introduction du pôle',               20),
('energie','services_cards','cards','Cartes des services Énergie',        30),
('energie','gallery',     'gallery','Galerie de réalisations Énergie',    40),
('energie','stats',       'stats',  'Chiffres clés Énergie',              50);

-- PAGE : routes (Pôle Routes)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('routes','hero',         'hero',   'Section Hero Routes',                10),
('routes','intro_text',   'text',   'Introduction du pôle',               20),
('routes','services_cards','cards', 'Cartes des services Routes',         30),
('routes','gallery',      'gallery','Galerie de réalisations Routes',     40),
('routes','stats',        'stats',  'Chiffres clés Routes',               50);

-- PAGE : industrie (Pôle Industrie)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('industrie','hero',       'hero',   'Section Hero Industrie',             10),
('industrie','intro_text', 'text',   'Introduction du pôle',               20),
('industrie','services_cards','cards','Cartes des services Industrie',     30),
('industrie','gallery',    'gallery','Galerie de réalisations Industrie',  40),
('industrie','stats',      'stats',  'Chiffres clés Industrie',            50);

-- PAGE : a-propos (À propos)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('a-propos','hero',        'hero',   'Section Hero À propos',              10),
('a-propos','mission',     'text',   'Notre mission',                      20),
('a-propos','vision',      'text',   'Notre vision',                       30),
('a-propos','histoire',    'text',   'Notre histoire',                     40),
('a-propos','equipe_img',  'image',  'Photo de l\'équipe',                 50),
('a-propos','stats',       'stats',  'Chiffres clés entreprise',           60);

-- PAGE : realisations (Réalisations)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('realisations','hero',    'hero',   'Section Hero Réalisations',          10),
('realisations','intro_text','text', 'Texte d\'introduction',              20),
('realisations','gallery', 'gallery','Galerie principale',                 30);

-- PAGE : actualites (Actualités)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('actualites','hero',      'hero',   'Section Hero Actualités',            10),
('actualites','intro_text','text',   'Texte d\'introduction',              20);

-- PAGE : contact (Contact)
INSERT IGNORE INTO `page_sections` (`page_slug`,`section_key`,`section_type`,`label`,`sort_order`) VALUES
('contact','hero',         'hero',   'Section Hero Contact',               10),
('contact','intro_text',   'text',   'Texte d\'introduction',              20),
('contact','adresse',      'text',   'Adresse et coordonnées',             30),
('contact','map_embed',    'text',   'URL Google Maps embed',              40);

-- ============================================================
-- Champs pour chaque type de section
-- ============================================================

-- Champs HERO (on les insère pour toutes les sections de type hero)
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'title',       'text',    'Titre principal',       10 FROM page_sections s WHERE s.section_type='hero';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'subtitle',    'textarea','Sous-titre / accroche', 20 FROM page_sections s WHERE s.section_type='hero';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'bg_image',    'image',   'Image de fond',         30 FROM page_sections s WHERE s.section_type='hero';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'btn_text',    'text',    'Texte du bouton CTA',   40 FROM page_sections s WHERE s.section_type='hero';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'btn_url',     'url',     'URL du bouton CTA',     50 FROM page_sections s WHERE s.section_type='hero';

-- Champs TEXT
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'title',  'text', 'Titre de la section', 10 FROM page_sections s WHERE s.section_type='text';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'body',   'html', 'Contenu (HTML)',       20 FROM page_sections s WHERE s.section_type='text';

-- Champs IMAGE
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'title',      'text',  'Titre / légende',  10 FROM page_sections s WHERE s.section_type='image';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'image_path', 'image', 'Image',            20 FROM page_sections s WHERE s.section_type='image';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'alt_text',   'text',  'Texte alternatif', 30 FROM page_sections s WHERE s.section_type='image';

-- Champs STATS (5 stats max, chacune avec valeur + label)
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat1_value','text','Stat 1 — Valeur (ex: 150+)',10 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat1_label','text','Stat 1 — Libellé',          11 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat2_value','text','Stat 2 — Valeur',           20 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat2_label','text','Stat 2 — Libellé',          21 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat3_value','text','Stat 3 — Valeur',           30 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat3_label','text','Stat 3 — Libellé',          31 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat4_value','text','Stat 4 — Valeur',           40 FROM page_sections s WHERE s.section_type='stats';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'stat4_label','text','Stat 4 — Libellé',          41 FROM page_sections s WHERE s.section_type='stats';

-- Champs CARDS (4 cartes max, chacune titre + description + icône/image)
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'section_title','text','Titre de la section cartes',  5 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card1_title','text',    'Carte 1 — Titre',           10 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card1_text', 'textarea','Carte 1 — Description',     11 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card1_icon', 'image',   'Carte 1 — Image/icône',     12 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card2_title','text',    'Carte 2 — Titre',           20 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card2_text', 'textarea','Carte 2 — Description',     21 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card2_icon', 'image',   'Carte 2 — Image/icône',     22 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card3_title','text',    'Carte 3 — Titre',           30 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card3_text', 'textarea','Carte 3 — Description',     31 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card3_icon', 'image',   'Carte 3 — Image/icône',     32 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card4_title','text',    'Carte 4 — Titre',           40 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card4_text', 'textarea','Carte 4 — Description',     41 FROM page_sections s WHERE s.section_type='cards';
INSERT IGNORE INTO `page_section_fields` (`section_id`,`field_key`,`field_type`,`field_label`,`sort_order`)
SELECT s.id, 'card4_icon', 'image',   'Carte 4 — Image/icône',     42 FROM page_sections s WHERE s.section_type='cards';
