<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'COTRAC - Compagnie des Travaux et Constructions | Dakar, Sénégal';
$page_desc  = 'COTRAC est une entreprise sénégalaise spécialisée en BTP, réseaux électriques HTA/BT, construction de routes et pistes, et génie industrielle. Basée à Dakar depuis 2015, nous bâtissons l\'avenir du Sénégal avec excellence.';
cms_load('index');
require_once 'includes/images.php';
require_once 'includes/header.php';
$db = getDB();
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION HERO
═══════════════════════════════════════════════════════════ -->
<?php $_index_hero_bg = cms_bg_url(cms('index','hero','bg_image','')); ?>
<section class="hero hero-photo-only">
  <?php if ($_index_hero_bg): ?>
  <div class="hero-parallax-bg" style="background-image:url('<?= e($_index_hero_bg) ?>');background-size:cover;background-position:center 20%;"></div>
  <?php else: ?>
  <div class="hero-parallax-bg" style="background:none;">
    <img src="<?= SITE_URL ?>/assets/images/plan.webp?v=4" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(5,18,45,0.35) 0%,rgba(8,25,58,0.25) 15%,rgba(9,28,64,0.17) 25%,rgba(10,30,70,0.10) 40%,rgba(10,30,70,0.20) 60%,rgba(10,30,70,0.32) 80%,rgba(10,30,70,0.45) 100%);z-index:1;"></div>
  </div>
  <?php endif; ?>
</section>

<!-- Contenu hero : sous la photo -->
<section class="hero hero-content-only">
  <div class="container">
    <div class="hero-layout">

      <div class="hero-left animate-fade-up">

        <h1 class="hero-title">
          <?= t('index_hero_titre') ?>
        </h1>

        <p class="hero-subtitle">
          <?= t('index_hero_sous_titre') ?>
        </p>

        <div class="hero-actions">
          <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary"><?= t('index_hero_btn_realisations') ?></a>
          <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline-white"><?= t('index_hero_btn_contact') ?></a>
        </div>

        <!-- Agréments -->
        <div class="hero-agrements">
          <span class="agrement-label">Agréé :</span>
          <span class="agrement-badge">✓ SENELEC</span>
          <span class="agrement-badge">✓ AGEROUTE</span>
          <span class="agrement-badge">✓ ASER</span>
          <span class="agrement-badge">✓ SN HLM</span>
          <span class="agrement-badge">✓ PUDC</span>
          <span class="agrement-badge">✓ SENICO</span>
          <span class="agrement-badge">✓ SEN EAU</span>
          <span class="agrement-badge">✓ PATISEN</span>
          <span class="agrement-badge">✓ SICAP SA</span>
          <span class="agrement-badge">✓ SOBOA</span>
          <span class="agrement-badge">✓ GB FOODS</span>
          <span class="agrement-badge">✓ SARL depuis 2018</span>
        </div>

        <!-- Stats -->
        <div class="hero-stats">
          <div class="stat-card">
            <span class="stat-value" data-target="10" data-suffix="+">10+</span>
            <span class="stat-label"><?= t('index_hero_stat_ans') ?></span>
          </div>
          <div class="stat-card">
            <span class="stat-value" data-target="25" data-suffix="+">25+</span>
            <span class="stat-label"><?= t('index_hero_stat_projets') ?></span>
          </div>
          <div class="stat-card">
            <span class="stat-value" data-target="14" data-suffix="">14</span>
            <span class="stat-label">Régions couvertes</span>
          </div>
          <div class="stat-card">
            <span class="stat-value" data-target="15" data-suffix="+">15+</span>
            <span class="stat-label"><?= t('index_hero_stat_partenaires') ?></span>
          </div>
        </div>

      </div>

    </div>

  </div>

</section>

<!-- ═══ Récit d'un chantier : Tambacounda (image collante + étapes au défilement) ═══ -->
<section class="story" id="story-tambacounda" aria-labelledby="story-titre">
  <div class="container story-grid">
    <div class="story-media">
      <figure class="story-frame">
        <img data-step="0" src="<?= SITE_URL ?>/assets/images/energie/tamba/poste-tamba-01.jpg" alt="Rencontre avec les autorités locales avant le démarrage du chantier" loading="lazy" class="is-active">
        <img data-step="1" src="<?= SITE_URL ?>/assets/images/energie/tamba/poste-tamba-04.jpg" alt="Dressage d'un poteau béton par l'équipe COTRAC" loading="lazy">
        <img data-step="2" src="<?= SITE_URL ?>/assets/images/energie/tamba/poste-tamba-03.jpg" alt="Technicien COTRAC en tête de poteau installant un luminaire" loading="lazy">
        <video data-step="3" src="<?= SITE_URL ?>/assets/videos/tamba/poste-tamba-04.mp4" poster="<?= SITE_URL ?>/assets/images/energie/tamba/poste-tamba-video-04.jpg" muted playsinline loop preload="none" aria-label="Tirage du câble sur le tracé de la ligne"></video>
        <img data-step="4" src="<?= SITE_URL ?>/assets/images/energie/tamba/poste-tamba-08.jpg" alt="Ligne électrique tirée sur poteaux béton, mise en service" loading="lazy">
      </figure>
      <p class="story-place">Tambacounda — cabine poste préfabriquée 36 kV, transformateur 400 kVA. Photos et vidéos prises sur le chantier.</p>
    </div>
    <div class="story-steps">
      <h2 id="story-titre">Un chantier, du premier poteau à la mise sous tension</h2>
      <p class="story-intro">Suivez une réalisation COTRAC telle qu'elle s'est déroulée, étape par étape.</p>
      <div class="story-step is-active" data-step="0">
        <span class="story-num" aria-hidden="true">1</span>
        <h3>Rencontre avec les autorités locales</h3>
        <p>Avant le premier coup de pelle, l'équipe présente le projet aux autorités et aux habitants : tracé, calendrier, sécurité. Un chantier bien accueilli avance vite.</p>
      </div>
      <div class="story-step" data-step="1">
        <span class="story-num" aria-hidden="true">2</span>
        <h3>Dressage des poteaux béton</h3>
        <p>Chaque poteau est levé, aligné et scellé selon les normes SENELEC. Sur ce chantier, les équipes ont travaillé par fortes chaleurs, avec un contrôle qualité à chaque implantation.</p>
      </div>
      <div class="story-step" data-step="2">
        <span class="story-num" aria-hidden="true">3</span>
        <h3>Équipement en tête de poteau</h3>
        <p>Armements, isolateurs et luminaires d'éclairage public sont posés à la nacelle ou à l'échelle, par des monteurs habilités travaux en hauteur.</p>
      </div>
      <div class="story-step" data-step="3">
        <span class="story-num" aria-hidden="true">4</span>
        <h3>Tirage des lignes</h3>
        <p>Le câble est déroulé et tendu tronçon par tronçon jusqu'à la cabine poste préfabriquée 36 kV, équipée de son transformateur 400 kVA.</p>
      </div>
      <div class="story-step" data-step="4">
        <span class="story-num" aria-hidden="true">5</span>
        <h3>Raccordement et mise sous tension</h3>
        <p>Essais, raccordement à la cabine, mise en service : le quartier est alimenté. Les équipes restent disponibles pour la maintenance.</p>
      </div>
      <div class="story-cta"><a href="<?= SITE_URL ?>/energie.php#ref-tambacounda" class="btn btn-outline-white">Voir toute la réalisation</a></div>
    </div>
  </div>
</section>
<script src="<?= SITE_URL ?>/assets/js/home-story.js?v=1" defer></script>

<!-- Bande photos défilante — hors hero pour lisibilité -->
<?php
$photos = [
  ['src'=>'assets/images/energie/pose-poteau-grue.jpg',           'alt'=>'Pose poteau'],
  ['src'=>'assets/images/energie/tranchee-cable-bt.jpg',          'alt'=>'Tranchée BT'],
  ['src'=>'assets/images/equipe/equipe-terrain.jpg',              'alt'=>'Équipe terrain'],
  ['src'=>'assets/images/energie/poteau-transformateur.jpg',      'alt'=>'Transformateur'],
  ['src'=>'assets/images/energie/armoire-coupure-hta.jpg',        'alt'=>'Armoire HTA'],
  ['src'=>'assets/images/equipe/gilet-cotrac.jpg',                'alt'=>'Équipe COTRAC'],
  ['src'=>'assets/images/industrie/genie-industriel-chantier.jpg','alt'=>'Génie industriel'],
  ['src'=>'assets/images/energie/raccordement-cable.jpg',         'alt'=>'Raccordement'],
  ['src'=>'assets/images/energie/ligne-hta-transformateur.jpg',   'alt'=>'Ligne HTA'],
  ['src'=>'assets/images/energie/jonction-cable-hta.jpg',         'alt'=>'Jonction HTA'],
  ['src'=>'assets/images/equipe/equipe-bureau.jpg',               'alt'=>'Équipe COTRAC en réunion'],
];
$photos = array_merge($photos, $photos);
?>
<div class="hero-slider-wrap">
  <div class="hero-slider">
    <div class="hero-slider-track">
      <?php foreach ($photos as $p): ?>
      <div class="hero-slider-card">
        <img src="<?= SITE_URL ?>/<?= e($p['src']) ?>" alt="<?= e($p['alt']) ?>" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS 4 PÔLES D'ACTIVITÉS
═══════════════════════════════════════════════════════════ -->
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/index-page.css?v=5"><section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('index_poles_tag') ?></span>
      <h2 class="section-title"><?= t('index_poles_titre') ?></h2>
      <p class="section-sub">
        <?= t('index_poles_desc') ?>
      </p>
    </div>

    <div class="poles-grid">

      <!-- BTP -->
      <div class="pole-card animate-fade-up delay-1">
        <div class="pole-photo-wrap">
          <img class="pole-photo" src="<?= SITE_URL ?>/assets/images/poles/reel/pole-btp.jpg"<?= cotrac_srcset('assets/images/poles/reel/pole-btp.jpg') ?> alt="Chantier BTP COTRAC" loading="lazy">
        </div>
        <div class="pole-body">
        <div class="pole-icon">
          <span class="ico ico-btp"><!--btp--></span>
        </div>
        <h3 class="pole-title"><?= t('pole_btp_titre') ?></h3>
        <p class="pole-desc">
          <?= t('pole_btp_desc') ?>
        </p>
        <div class="pole-tags">
          <span class="tag"><?= t('pole_btp_tag1') ?></span>
          <span class="tag"><?= t('pole_btp_tag2') ?></span>
          <span class="tag"><?= t('pole_btp_tag3') ?></span>
          <span class="tag"><?= t('pole_btp_tag4') ?></span>
        </div>
        <a href="<?= SITE_URL ?>/btp.php" class="pole-link">
          <?= t('btn_en_savoir_plus') ?> <span>→</span>
        </a>
        </div>
      </div>

      <!-- Énergie -->
      <div class="pole-card green animate-fade-up delay-2">
        <div class="pole-photo-wrap">
          <img class="pole-photo" src="<?= SITE_URL ?>/assets/images/poles/reel/pole-energie.jpg"<?= cotrac_srcset('assets/images/poles/reel/pole-energie.jpg') ?> alt="Poste électrique HTA/BT COTRAC" loading="lazy">
        </div>
        <div class="pole-body">
        <div class="pole-icon">
          <span class="ico ico-energie"><!--energie--></span>
        </div>
        <h3 class="pole-title"><?= t('pole_energie_titre') ?></h3>
        <p class="pole-desc">
          <?= t('pole_energie_desc') ?>
        </p>
        <div class="pole-tags">
          <span class="tag"><?= t('pole_energie_tag1') ?></span>
          <span class="tag"><?= t('pole_energie_tag2') ?></span>
          <span class="tag"><?= t('pole_energie_tag3') ?></span>
        </div>
        <a href="<?= SITE_URL ?>/energie.php" class="pole-link">
          <?= t('btn_en_savoir_plus') ?> <span>→</span>
        </a>
        </div>
      </div>

      <!-- Routes -->
      <div class="pole-card animate-fade-up delay-3">
        <div class="pole-photo-wrap">
          <img class="pole-photo" src="<?= SITE_URL ?>/assets/images/poles/reel/pole-routes.jpg"<?= cotrac_srcset('assets/images/poles/reel/pole-routes.jpg') ?> alt="Travaux de terrassement COTRAC" loading="lazy">
        </div>
        <div class="pole-body">
        <div class="pole-icon">
          <span class="ico ico-routes"><!--routes--></span>
        </div>
        <h3 class="pole-title"><?= t('pole_routes_titre') ?></h3>
        <p class="pole-desc">
          <?= t('pole_routes_desc') ?>
        </p>
        <div class="pole-tags">
          <span class="tag"><?= t('pole_routes_tag1') ?></span>
          <span class="tag"><?= t('pole_routes_tag2') ?></span>
          <span class="tag"><?= t('pole_routes_tag3') ?></span>
          <span class="tag"><?= t('pole_routes_tag4') ?></span>
        </div>
        <a href="<?= SITE_URL ?>/routes.php" class="pole-link">
          <?= t('btn_en_savoir_plus') ?> <span>→</span>
        </a>
        </div>
      </div>

      <!-- Industrie -->
      <div class="pole-card purple animate-fade-up delay-4">
        <div class="pole-photo-wrap">
          <img class="pole-photo" src="<?= SITE_URL ?>/assets/images/poles/reel/pole-industrie.jpg"<?= cotrac_srcset('assets/images/poles/reel/pole-industrie.jpg') ?> alt="Technicien COTRAC génie industriel" loading="lazy">
        </div>
        <div class="pole-body">
        <div class="pole-icon">
          <span class="ico ico-industrie"><!--industrie--></span>
        </div>
        <h3 class="pole-title"><?= t('pole_industrie_titre') ?></h3>
        <p class="pole-desc">
          <?= t('pole_industrie_desc') ?>
        </p>
        <div class="pole-tags">
          <span class="tag"><?= t('pole_industrie_tag1') ?></span>
          <span class="tag"><?= t('pole_industrie_tag2') ?></span>
          <span class="tag"><?= t('pole_industrie_tag3') ?></span>
        </div>
        <a href="<?= SITE_URL ?>/industrie.php" class="pole-link">
          <?= t('btn_en_savoir_plus') ?> <span>→</span>
        </a>
        </div>
      </div>

      <div class="pole-card teal animate-fade-up delay-5">
        <div class="pole-photo-wrap">
          <img class="pole-photo" src="<?= SITE_URL ?>/assets/images/poles/reel/pole-froid-clim.jpg"<?= cotrac_srcset('assets/images/poles/reel/pole-froid-clim.jpg') ?> alt="Réseau de ventilation installé par COTRAC" loading="lazy">
        </div>
        <div class="pole-body">
        <div class="pole-icon">
          <span class="ico ico-froid"><!--froid--></span>
        </div>
        <h3 class="pole-title"><?= t('pole_froid_titre') ?></h3>
        <p class="pole-desc">
          <?= t('pole_froid_desc') ?>
        </p>
        <div class="pole-tags">
          <span class="tag"><?= t('pole_froid_tag1') ?></span>
          <span class="tag"><?= t('pole_froid_tag2') ?></span>
          <span class="tag"><?= t('pole_froid_tag3') ?></span>
        </div>
        <a href="<?= SITE_URL ?>/froid-clim.php" class="pole-link">
          <?= t('btn_en_savoir_plus') ?> <span>→</span>
        </a>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : CHIFFRES CLÉS
═══════════════════════════════════════════════════════════ -->
<section class="stats-section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag orange"><?= t('index_stats_tag') ?></span>
      <h2 class="section-title light"><?= t('index_stats_titre') ?></h2>
      <p class="section-sub" style="color:rgba(255,255,255,0.82)">
        <?= t('index_stats_desc') ?>
      </p>
    </div>

    <!-- Desktop : photo gauche + stats centre + photo droite -->
    <div class="stats-photos-layout stats-desktop-layout">

      <!-- Photo gauche -->
      <div class="stats-photo-side" style="border-radius:20px;overflow:hidden;height:300px;box-shadow:0 0 0 4px #f7941d,0 12px 40px rgba(0,0,0,0.35);transform:translateY(-20px);">
        <picture>
          <source srcset="<?= SITE_URL ?>/assets/images/equipe/cotrac2.webp" type="image/webp">
          <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac2.jpg"<?= cotrac_srcset('assets/images/equipe/cotrac2.jpg') ?> alt="Équipe COTRAC" loading="lazy" style="width:100%;height:100%;object-fit:cover;object-position:center top;">
        </picture>
      </div>

      <!-- Stats centre : 2x2 -->
      <div class="stats-chiffres-grid">
        <div class="stats-chiffre-item">
          <div class="stats-val"><span class="counter" data-target="10">10</span>+</div>
          <div class="stats-lbl"><?= t('index_stats_ans_label') ?></div>
        </div>
        <div class="stats-chiffre-item">
          <div class="stats-val"><span class="counter" data-target="25">25</span>+</div>
          <div class="stats-lbl"><?= t('index_stats_projets_label') ?></div>
        </div>
        <div class="stats-chiffre-item">
          <div class="stats-val"><span class="counter" data-target="100">100</span>+</div>
          <div class="stats-lbl"><?= t('index_stats_experts_label') ?></div>
        </div>
        <div class="stats-chiffre-item">
          <div class="stats-val"><span class="counter" data-target="15">15</span>+</div>
          <div class="stats-lbl"><?= t('index_stats_part_label') ?></div>
        </div>
      </div>

      <!-- Photo droite -->
      <div class="stats-photo-side" style="border-radius:20px;overflow:hidden;height:300px;box-shadow:0 0 0 4px #f7941d,0 12px 40px rgba(0,0,0,0.35);transform:translateY(20px);">
        <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-photo.jpg"<?= cotrac_srcset('assets/images/equipe/cotrac-photo.jpg') ?> alt="COTRAC sur chantier" loading="lazy" style="width:100%;height:100%;object-fit:cover;object-position:center top;">
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS ÉQUIPES SUR LE TERRAIN
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="hero-layout" style="gap:24px;">

      <!-- Texte -->
      <div class="hero-left animate-fade-up delay-1">
        <span class="section-tag"><?= t('index_equipes_tag') ?></span>
        <h2 class="section-title"><?= t('index_equipes_titre') ?></h2>
        <p class="section-sub left">
          <?= t('index_equipes_desc1') ?>
        </p>
        <p style="color:var(--gris);line-height:1.85;margin-bottom:32px;font-size:1.02rem;">
          <?= t('index_equipes_desc2') ?>
        </p>
        <a href="<?= SITE_URL ?>/a-propos.php" class="btn btn-primary">
          <?= t('index_equipes_btn') ?>
        </a>
      </div>

      <!-- Grille de 3 photos -->
      <div class="hero-right animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;perspective:1000px;">
        <div class="galerie-item parallax-item" data-parallax-speed="0.12" style="grid-column:span 2;aspect-ratio:16/7;">
          <picture>
            <source srcset="<?= SITE_URL ?>/assets/images/equipe/notreequipe.webp" type="image/webp">
            <img src="<?= SITE_URL ?>/assets/images/equipe/notreequipe.jpg"<?= cotrac_srcset('assets/images/equipe/notreequipe.jpg') ?>
                 alt="<?= t('img_alt_equipe_terrain') ?>"
                 loading="lazy">
          </picture>
        </div>
        <div class="galerie-item parallax-item" data-parallax-speed="0.22" style="aspect-ratio:4/3;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/ingenieure-plans.jpg"<?= cotrac_srcset('assets/images/equipe/ingenieure-plans.jpg') ?>
               alt="<?= t('img_alt_ingenieure_plans') ?>"
               loading="lazy">
        </div>
        <div class="galerie-item parallax-item" data-parallax-speed="-0.18" style="aspect-ratio:4/3;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/cta-fond.jpg"
               alt="<?= t('img_alt_technicien_gilet') ?>"
               style="object-position:center top;"
               loading="lazy">
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : POURQUOI NOUS CHOISIR
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('index_valeurs_tag') ?></span>
      <h2 class="section-title"><?= t('index_valeurs_titre') ?></h2>
      <p class="section-sub">
        <?= t('index_valeurs_desc') ?>
      </p>
    </div>

    <div class="valeurs-grid">

      <div class="valeur-card animate-fade-up delay-1">
        <div class="valeur-icon"><span class="ico ico-target"><!--target--></span></div>
        <h3><?= t('valeur_qualite_titre') ?></h3>
        <p><?= t('valeur_qualite_desc') ?></p>
      </div>

      <div class="valeur-card animate-fade-up delay-2">
        <div class="valeur-icon"><span class="ico ico-handshake"><!--hs--></span></div>
        <h3><?= t('valeur_client_titre') ?></h3>
        <p><?= t('valeur_client_desc') ?></p>
      </div>

      <div class="valeur-card animate-fade-up delay-3">
        <div class="valeur-icon"><span class="ico ico-globe"><!--globe--></span></div>
        <h3><?= t('valeur_local_titre') ?></h3>
        <p><?= t('valeur_local_desc') ?></p>
      </div>

      <div class="valeur-card animate-fade-up delay-4">
        <div class="valeur-icon"><span class="ico ico-wrench"><!--wrench--></span></div>
        <h3><?= t('valeur_expertise_titre') ?></h3>
        <p><?= t('valeur_expertise_desc') ?></p>
      </div>

    </div>
  </div>
</section>


<!-- section video_chantier fusionnée avec la section player macOS ci-dessous -->


<!-- ═══════════════════════════════════════════════════════════
     SECTION : VIDÉO COTRAC — NOS ÉQUIPES EN ACTION
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:#0b1d3a;">
  <div class="container">

    <div class="text-center" style="margin-bottom:36px;">
      <span class="section-tag orange" style="margin-bottom:12px;display:inline-block;">
        <?= icon('play','#f7941d','.8rem') ?> Nos équipes en action
      </span>
      <h2 class="section-title light">COTRAC sur le terrain</h2>
      <p class="section-sub" style="color:rgba(255,255,255,.72);max-width:580px;margin:0 auto;">
        Découvrez nos équipes à l'œuvre sur les chantiers électriques, BTP et infrastructures au Sénégal.
      </p>
    </div>

    <!-- Player style macOS -->
    <div class="index-video-wrap animate-fade-up">
      <div class="index-video-header">
        <span class="index-video-dot" style="background:#ff5f57;"></span>
        <span class="index-video-dot" style="background:#febc2e;"></span>
        <span class="index-video-dot" style="background:#28c840;"></span>
        <span class="index-video-title">COTRAC — Chantiers &amp; Réalisations</span>
      </div>
      <div class="index-video-player" id="cotrac-video-player">
        <video
          id="cotrac-home-video"
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/images/video-cotrac-poster.jpg"
          style="display:block;width:100%;background:#000;">
          <source src="<?= SITE_URL ?>/assets/videos/videocotrac.mp4" type="video/mp4">
        </video>
        <!-- Overlay play button -->
        <div class="index-video-overlay" id="cotrac-video-overlay">
          <button class="index-video-play-btn" id="cotrac-play-btn" aria-label="Lire la vidéo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="#fff"><polygon points="5,3 19,12 5,21"/></svg>
          </button>
          <div class="index-video-overlay-label">Regarder la vidéo</div>
        </div>
      </div>
    </div>
    <script>
    (function(){
      var btn    = document.getElementById('cotrac-play-btn');
      var overlay= document.getElementById('cotrac-video-overlay');
      var video  = document.getElementById('cotrac-home-video');
      if (!btn || !video) return;
      function play() {
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
        video.controls = true;
        video.play();
      }
      btn.addEventListener('click', play);
      overlay.addEventListener('click', play);
      video.addEventListener('play', function(){
        overlay.style.display = 'none';
      });
    })();
    </script>

    <!-- 3 points clés sous la vidéo -->
    <div class="index-video-points">
      <div class="ivp-item">
        <?= icon('zap','#f7941d','1.2rem') ?>
        <span>Réseaux électriques HTA/MT/BT</span>
      </div>
      <div class="ivp-sep"></div>
      <div class="ivp-item">
        <?= icon('hard-hat','#f7941d','1.2rem') ?>
        <span>BTP &amp; Génie Civil</span>
      </div>
      <div class="ivp-sep"></div>
      <div class="ivp-item">
        <?= icon('map-pin','#f7941d','1.2rem') ?>
        <span>14 régions au Sénégal</span>
      </div>
    </div>

  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION : TÉMOIGNAGES CLIENTS
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">
    <div class="text-center" style="margin-bottom:28px;">
      <span class="section-tag"><?= icon('star') ?> <?= t('index_temoig_tag') ?></span>
      <h2 class="section-title"><?= t('index_temoig_titre') ?></h2>
      <p class="section-sub"><?= t('index_temoig_desc') ?></p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">

      <!-- Témoignage 1 : SENELEC -->
      <div class="temoignage-card animate-fade-up delay-1">
        <div class="temoignage-quote"><?= icon('message','#f7941d','1.4rem') ?></div>
        <p class="temoignage-text">
          <?= t('temoig_senelec_texte') ?>
        </p>
        <div class="temoignage-author">
          <div class="temoignage-logo">
            <picture><source srcset="<?= SITE_URL ?>/assets/images/logos/senelec.webp" type="image/webp"><img src="<?= SITE_URL ?>/assets/images/logos/senelec.jpg" alt="SENELEC" loading="lazy"></picture>
          </div>
          <div>
            <div class="temoignage-name"><?= t('temoig_senelec_poste') ?></div>
            <div class="temoignage-company"><?= t('temoig_senelec_org') ?></div>
          </div>
        </div>
        <div class="temoignage-stars">★★★★★</div>
      </div>

      <!-- Témoignage 2 : AGEROUTE -->
      <div class="temoignage-card animate-fade-up delay-2">
        <div class="temoignage-quote"><?= icon('message','#f7941d','1.4rem') ?></div>
        <p class="temoignage-text">
          <?= t('temoig_ageroute_texte') ?>
        </p>
        <div class="temoignage-author">
          <div class="temoignage-logo">
            <picture><source srcset="<?= SITE_URL ?>/assets/images/logos/ageroute.webp" type="image/webp"><img src="<?= SITE_URL ?>/assets/images/logos/ageroute.jpg" alt="AGEROUTE" loading="lazy"></picture>
          </div>
          <div>
            <div class="temoignage-name"><?= t('temoig_ageroute_poste') ?></div>
            <div class="temoignage-company"><?= t('temoig_ageroute_org') ?></div>
          </div>
        </div>
        <div class="temoignage-stars">★★★★★</div>
      </div>

      <!-- Témoignage 3 : Promoteur privé -->
      <div class="temoignage-card animate-fade-up delay-3">
        <div class="temoignage-quote"><?= icon('message','#f7941d','1.4rem') ?></div>
        <p class="temoignage-text">
          <?= t('temoig_prive_texte') ?>
        </p>
        <div class="temoignage-author">
          <div class="temoignage-logo" style="background:linear-gradient(135deg,#1a6bb5,#0f4d8a);color:#fff;font-weight:800;font-size:.8rem;display:flex;align-items:center;justify-content:center;">
            PME
          </div>
          <div>
            <div class="temoignage-name"><?= t('temoig_prive_poste') ?></div>
            <div class="temoignage-company"><?= t('temoig_prive_org') ?></div>
          </div>
        </div>
        <div class="temoignage-stars">★★★★★</div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : RÉALISATIONS RÉCENTES
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('index_real_tag') ?></span>
      <h2 class="section-title"><?= t('index_real_titre') ?></h2>
      <p class="section-sub">
        <?= t('index_real_desc') ?>
      </p>
    </div>

    <div class="projets-grid">
<?php
try {
    $stmt = $db->query('SELECT * FROM projets ORDER BY id DESC LIMIT 3');
    $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($projets as $p):
        $statut_class = match(strtolower($p['statut'] ?? '')) {
            'terminé', 'termine' => 'badge-success',
            'en cours'           => 'badge-info',
            default              => 'badge-warning',
        };
        $statut_label = match(strtolower($p['statut'] ?? '')) {
            'terminé', 'termine' => 'Terminé',
            'en cours'           => 'En cours',
            default              => $p['statut'] ?? t('projet_statut_en_cours'),
        };
?>
      <?php
        $pole_photos = [
            'btp'      => 'equipe/equipe-inspection.jpg',
            'energie'  => 'projets/pose-poteau-grue.jpg',
            'routes'   => 'projets/terrain-chantier.jpg',
            'industrie'=> 'projets/genie-industriel-chantier.jpg',
        ];
        $pole_key = strtolower($p['pole'] ?? 'btp');
        $fallback = $pole_photos[$pole_key] ?? 'projets/tranchee-cable-bt.jpg';
        $has_img  = !empty($p['image']);
      ?>
      <div class="projet-card animate-fade-up">
        <div class="projet-img">
<?php if ($has_img): ?>
          <img src="<?= SITE_URL ?>/uploads/projets/<?= e($p['image']) ?>"<?= cotrac_srcset('uploads/projets/' . e($p['image'])) ?> alt="<?= e($p['titre']) ?>" loading="lazy">
<?php else: ?>
          <img src="<?= SITE_URL ?>/assets/images/<?= $fallback ?>" alt="<?= e($p['titre']) ?>" loading="lazy">
<?php endif; ?>
          <span class="projet-badge <?= e($statut_class) ?>"><?= e($statut_label) ?></span>
        </div>
        <div class="projet-body">
          <?php if (!empty($p['pole'])): ?>
          <span class="projet-pole tag"><?= e($p['pole']) ?></span>
          <?php endif; ?>
          <h3 class="projet-titre"><?= e($p['titre']) ?></h3>
          <?php if (!empty($p['client'])): ?>
          <p class="projet-client"><strong><?= t('index_real_client_label') ?></strong> <?= e($p['client']) ?></p>
          <?php endif; ?>
          <?php if (!empty($p['description'])): ?>
          <p class="projet-desc"><?= e(mb_substr($p['description'], 0, 120)) . (mb_strlen($p['description']) > 120 ? '…' : '') ?></p>
          <?php endif; ?>
          <a href="<?= SITE_URL ?>/realisations.php" class="pole-link" style="margin-top:12px;display:inline-block;">
            <?= t('index_real_voir_details') ?> <span>→</span>
          </a>
        </div>
      </div>
<?php
    endforeach;
    if (empty($projets)):
?>
      <!-- Aucun projet en base : affichage de cards illustratives -->
      <div class="projet-card animate-fade-up delay-1">
        <div class="projet-img">
          <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-inspection.jpg"<?= cotrac_srcset('assets/images/equipe/equipe-inspection.jpg') ?> alt="<?= t('img_alt_chantier_elec') ?>" loading="lazy">
          <span class="projet-badge badge-success"><?= t('projet_statut_termine') ?></span>
        </div>
        <div class="projet-body">
          <span class="tag"><?= t('pole_btp_tag1') ?></span>
          <h3 class="projet-titre">Construction Immeuble R+3 - Dakar Plateau</h3>
          <p class="projet-client"><strong><?= t('index_real_client_label') ?></strong> Promoteur privé</p>
          <p class="projet-desc">Construction complète d'un immeuble résidentiel de 3 niveaux, gros œuvre et second œuvre, livré dans les délais.</p>
          <a href="<?= SITE_URL ?>/realisations.php" class="pole-link" style="margin-top:12px;display:inline-block;"><?= t('index_real_voir_details') ?> <span>→</span></a>
        </div>
      </div>
      <div class="projet-card animate-fade-up delay-2">
        <div class="projet-img">
          <img src="<?= SITE_URL ?>/uploads/projets/pose-poteau-grue.jpg"<?= cotrac_srcset('uploads/projets/pose-poteau-grue.jpg') ?> alt="<?= t('img_alt_chantier_elec') ?>" loading="lazy">
          <span class="projet-badge badge-success"><?= t('projet_statut_termine') ?></span>
        </div>
        <div class="projet-body">
          <span class="tag"><?= t('pole_energie_titre') ?></span>
          <h3 class="projet-titre">Réseau HTA/BT - Zone Industrielle Mbao</h3>
          <p class="projet-client"><strong><?= t('index_real_client_label') ?></strong> SENELEC / Industriel privé</p>
          <p class="projet-desc">Pose de câbles HTA souterrains, installation de postes de transformation et raccordements BT sur 3,5 km.</p>
          <a href="<?= SITE_URL ?>/realisations.php" class="pole-link" style="margin-top:12px;display:inline-block;"><?= t('index_real_voir_details') ?> <span>→</span></a>
        </div>
      </div>
      <div class="projet-card animate-fade-up delay-3">
        <div class="projet-img">
          <img src="<?= SITE_URL ?>/uploads/projets/terrain-chantier.jpg"<?= cotrac_srcset('uploads/projets/terrain-chantier.jpg') ?> alt="<?= t('img_alt_chantier_indus') ?>" loading="lazy">
          <span class="projet-badge badge-info"><?= t('projet_statut_en_cours') ?></span>
        </div>
        <div class="projet-body">
          <span class="tag"><?= t('pole_routes_tag1') ?></span>
          <h3 class="projet-titre">Réhabilitation Piste Rurale - Région de Thiès</h3>
          <p class="projet-client"><strong><?= t('index_real_client_label') ?></strong> AGEROUTE / Collectivité locale</p>
          <p class="projet-desc">Réhabilitation et bitumage de 8 km de piste rurale avec aménagement de dalots et caniveaux d'évacuation.</p>
          <a href="<?= SITE_URL ?>/realisations.php" class="pole-link" style="margin-top:12px;display:inline-block;"><?= t('index_real_voir_details') ?> <span>→</span></a>
        </div>
      </div>
<?php endif; ?>
<?php } catch (Exception $e) { ?>
      <p style="text-align:center;color:#666;padding:40px 0;"><?= t('index_real_chargement') ?></p>
<?php } ?>
    </div>

    <!-- Vidéos SEN'EAU -->
    <div class="seneau-videos-wrap">
      <div class="seneau-videos-header animate-fade-up">
        <?= icon('play','#1a6bb5','1rem') ?>
        <span>Vidéos de chantier — <strong>SEN'EAU</strong></span>
      </div>
      <div class="seneau-videos-grid">

        <!-- Vidéo 1 : Station Bayakh -->
        <div class="seneau-video-card animate-fade-up delay-1">
          <div class="svp-player" id="svp1">
            <video preload="metadata"
              poster="<?= SITE_URL ?>/assets/images/seneau1-poster.jpg"
              style="display:block;width:100%;background:#000;">
              <source src="<?= SITE_URL ?>/assets/videos/seneau1.mp4" type="video/mp4">
            </video>
            <div class="svp-overlay">
              <button class="svp-btn" aria-label="Lire">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="#fff"><polygon points="5,3 19,12 5,21"/></svg>
              </button>
            </div>
          </div>
          <div class="svp-info">
            <span class="svp-tag">SEN'EAU</span>
            <h4 class="svp-titre">Station Bayakh — Travaux hydrauliques</h4>
            <p class="svp-desc">Réhabilitation et mise en service des équipements hydrauliques à la station de Bayakh.</p>
          </div>
        </div>

        <!-- Vidéo 2 : Station F3 -->
        <div class="seneau-video-card animate-fade-up delay-2">
          <div class="svp-player" id="svp2">
            <video preload="metadata"
              poster="<?= SITE_URL ?>/assets/images/seneauF3-poster.jpg"
              style="display:block;width:100%;background:#000;">
              <source src="<?= SITE_URL ?>/assets/videos/seneauF3.mp4" type="video/mp4">
            </video>
            <div class="svp-overlay">
              <button class="svp-btn" aria-label="Lire">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="#fff"><polygon points="5,3 19,12 5,21"/></svg>
              </button>
            </div>
          </div>
          <div class="svp-info">
            <span class="svp-tag">SEN'EAU</span>
            <h4 class="svp-titre">Bayakh Station F3 — Installation équipements</h4>
            <p class="svp-desc">Installation et raccordement des équipements hydrauliques à la station F3 de Bayakh.</p>
          </div>
        </div>

      </div>
    </div>
    <script>
    function svpPlay(el) {
      // el peut être l'overlay ou le bouton enfant
      var overlay = el.classList.contains('svp-overlay') ? el : el.closest('.svp-overlay');
      if (!overlay) return;
      var player = overlay.closest('.svp-player');
      if (!player) return;
      var video = player.querySelector('video');
      if (!video) return;
      overlay.style.display = 'none';
      video.controls = true;
      video.play();
    }
    // Délégation sur le bouton aussi
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.svp-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          svpPlay(btn.closest('.svp-overlay'));
        });
      });
      document.querySelectorAll('.svp-overlay').forEach(function(ov) {
        ov.addEventListener('click', function() { svpPlay(ov); });
      });
    });
    </script>

    <div class="text-center" style="margin-top:40px;">
      <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary">
        <?= t('index_real_btn_tous') ?>
      </a>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════════════════
     SECTION : PARTENAIRES
═══════════════════════════════════════════════════════════ -->
<section class="section section-sm" style="padding-top:40px;">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('index_part_tag') ?></span>
      <h2 class="section-title"><?= t('index_part_titre') ?></h2>
      <p class="section-sub">
        <?= t('index_part_desc') ?>
      </p>
    </div>

    <div class="partenaires-track">
      <div class="partenaires-slider">
        <?php
        $partenaires_slider = [
          ['routes',   'AGEROUTE'],
          ['energie',  'SENELEC'],
          ['building', 'SONES'],
          ['globe',    'APIX'],
          ['briefcase','BHS'],
          ['building', 'ONAS'],
          ['globe',    'PNUD'],
          ['briefcase','Ministère des Infrastructures'],
          ['map-pin',  'Conseil Régional de Dakar'],
          ['zap',      'ANER'],
          ['building', 'Mairie de Dakar'],
          ['leaf',     'Promoteurs Privés'],
        ];
        foreach (array_merge($partenaires_slider, $partenaires_slider) as [$ico, $nom]):
        ?>
        <div class="partenaire-item"><?= icon($ico,'','1rem') ?> <?= $nom ?></div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>


<?php
/* ---- 3 dernières actualités ---- */
$actualites_home = $db->query("SELECT * FROM actualites WHERE actif=1 ORDER BY created_at DESC LIMIT 3")->fetchAll();
$mois_fr_home = ['January'=>'janvier','February'=>'février','March'=>'mars','April'=>'avril',
                 'May'=>'mai','June'=>'juin','July'=>'juillet','August'=>'août',
                 'September'=>'septembre','October'=>'octobre','November'=>'novembre','December'=>'décembre'];
?>
<?php if (!empty($actualites_home)): ?>
<!-- ═══════════════════════════════════════════════════════════
     ACTUALITÉS
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">

    <div class="section-header animate-fade-up" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:40px;">
      <div>
        <span class="section-tag"><?= t('index_actu_tag') ?></span>
        <h2 class="section-title" style="margin-top:8px;"><?= t('index_actu_titre') ?></h2>
      </div>
      <a href="<?= SITE_URL ?>/actualites.php" class="btn btn-outline" style="white-space:nowrap;">
        <?= t('index_actu_btn_toutes') ?>
      </a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:28px;">
      <?php foreach ($actualites_home as $i => $actu):
        $has_img  = !empty($actu['image']);
        $date_fmt = strtr(date('d F Y', strtotime($actu['created_at'])), $mois_fr_home);
      ?>
      <article class="actu-home-card animate-fade-up" style="transition-delay:<?= $i * 100 ?>ms;">
        <div class="actu-home-card-img">
          <?php if ($has_img): ?>
            <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($actu['image']) ?>"<?= cotrac_srcset('uploads/actualites/' . e($actu['image'])) ?>
                 alt="<?= e($actu['titre']) ?>" loading="lazy">
          <?php else: ?>
            <div class="actu-home-card-placeholder">
              <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
            </div>
          <?php endif; ?>
          <div class="actu-home-card-overlay"></div>
        </div>
        <div class="actu-home-card-body">
          <span class="actu-home-card-date">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <?= e($date_fmt) ?>
          </span>
          <h3 class="actu-home-card-title"><?= e($actu['titre']) ?></h3>
          <?php if (!empty($actu['contenu'])): ?>
            <p class="actu-home-card-excerpt"><?= e(mb_strimwidth(strip_tags($actu['contenu']), 0, 110, '…')) ?></p>
          <?php endif; ?>
          <a href="<?= SITE_URL ?>/actualites.php" class="actu-home-card-link">
            <?= t('index_actu_lire_suite') ?>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════
     CARTE SÉNÉGAL — 14 RÉGIONS
═══════════════════════════════════════════════════════════ -->
<?php
$_carte = __DIR__ . '/includes/carte-senegal.php';
if (file_exists($_carte)) {
    try { require_once $_carte; } catch (\Throwable $e) { /* silencieux */ }
}
unset($_carte);
?>

<!-- ═══════════════════════════════════════════════════════════
     CTA FINAL
═══════════════════════════════════════════════════════════ -->
<section style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cta-fond.jpg" alt="Chantier COTRAC" loading="lazy"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div class="container cta-grid" style="position:relative;z-index:2;padding-top:2rem;padding-bottom:2rem;">

    <!-- Gauche : contact info -->
    <div class="animate-fade-up delay-1">
      <span class="section-tag orange"><?= t('index_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-top:10px;"><?= t('index_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        <?= t('index_cta_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <a href="tel:+221338279639" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','.95rem') ?></span>
          +221 33 827 96 39 &nbsp;|&nbsp; +221 77 620 36 03
        </a>
        <a href="mailto:cotracsenegal@gmail.com" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','.95rem') ?></span>
          cotracsenegal@gmail.com
        </a>
        <div style="display:flex;align-items:center;gap:14px;color:rgba(255,255,255,0.72);font-weight:500;">
          <span style="background:rgba(255,255,255,0.12);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('map-pin','','.95rem') ?></span>
          <?= t('index_cta_adresse') ?>
        </div>
      </div>
    </div>

    <!-- Droite : carte action -->
    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#f7941d;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('target','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;"><?= t('index_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        <?= t('index_cta_card_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> <?= t('index_cta_btn_devis') ?>
        </a>
        <a href="<?= SITE_URL ?>/a-propos.php" class="btn btn-outline-white" style="width:100%;justify-content:center;">
          <?= icon('users','','.9rem') ?> <?= t('index_cta_btn_apropos') ?>
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">48h</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('index_cta_delai_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;"><?= t('index_cta_gratuit') ?></div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('index_cta_etude_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">14</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('index_cta_regions_label') ?></div>
        </div>
      </div>
    </div>

  </div>
</section>
<?php require_once 'includes/footer.php'; ?>
