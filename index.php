<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'COTRAC - Compagnie des Travaux et Constructions | Dakar, Sénégal';
$page_desc  = 'COTRAC est une entreprise sénégalaise spécialisée en BTP, réseaux électriques HTA/BT, construction de routes et pistes, et génie industrielle. Basée à Dakar depuis 2015, nous bâtissons l\'avenir du Sénégal avec excellence.';
cms_load('index');
require_once 'includes/header.php';
$db = getDB();
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION HERO
═══════════════════════════════════════════════════════════ -->
<?php $_index_hero_bg = cms_bg_url(cms('index','hero','bg_image','')); ?>
<section class="hero">
  <div class="hero-parallax-bg" <?= $_index_hero_bg ? 'style="background-image:url(\''.e($_index_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>></div>
  <div class="hero-blob hero-blob-1"></div>
  <div class="hero-blob hero-blob-2"></div>
  <div class="container">
    <div class="hero-layout">

      <!-- Colonne gauche : texte -->
      <div class="hero-left animate-fade-up">

        <div class="hero-badge">
          <span class="dot"></span>
          <?= t('index_hero_badge') ?>
        </div>

        <h1 class="hero-title">
          <?= t('index_hero_titre') ?>
        </h1>

        <p class="hero-subtitle">
          <?= t('index_hero_sous_titre') ?>
        </p>

        <div class="hero-actions">
          <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary"><?= t('index_hero_btn_realisations') ?></a>
          <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline"><?= t('index_hero_btn_contact') ?></a>
        </div>

        <!-- Stats sous les boutons -->
        <div class="hero-stats">
          <div class="stat-card">
            <span class="stat-value">10+</span>
            <span class="stat-label"><?= t('index_hero_stat_ans') ?></span>
          </div>
          <div class="stat-card">
            <span class="stat-value">25+</span>
            <span class="stat-label"><?= t('index_hero_stat_projets') ?></span>
          </div>
          <div class="stat-card">
            <span class="stat-value">4</span>
            <span class="stat-label"><?= t('index_hero_stat_poles') ?></span>
          </div>
          <div class="stat-card">
            <span class="stat-value">15+</span>
            <span class="stat-label"><?= t('index_hero_stat_partenaires') ?></span>
          </div>
        </div>

      </div>

      <!-- Colonne droite : slider -->
      <div class="hero-right animate-fade-up delay-2">
        <div class="hero-slider" id="heroSlider">
          <div class="hero-slider-track" id="heroSliderTrack">
            <?php
            $hero_slides = [
              ['src' => 'assets/images/energie/pose-poteau-grue.jpg',        'alt' => 'Pose de poteau COTRAC'],
              ['src' => 'assets/images/energie/ligne-hta-transformateur.jpg', 'alt' => 'Ligne HTA transformateur'],
              ['src' => 'assets/images/equipe/gilet-cotrac.jpg',              'alt' => 'Équipe COTRAC terrain'],
              ['src' => 'assets/images/energie/tranchee-cable-bt.jpg',        'alt' => 'Tranchée câble BT'],
              ['src' => 'assets/images/industrie/genie-industriel-chantier.jpg','alt' => 'Génie industriel chantier'],
              ['src' => 'assets/images/energie/poteau-transformateur.jpg',    'alt' => 'Poteau transformateur'],
              ['src' => 'assets/images/equipe/equipe-terrain.jpg',            'alt' => 'Équipe terrain COTRAC'],
            ];
            foreach ($hero_slides as $slide): ?>
            <div class="hero-slide">
              <img src="<?= SITE_URL ?>/<?= e($slide['src']) ?>"
                   alt="<?= e($slide['alt']) ?>" loading="eager">
            </div>
            <?php endforeach; ?>
          </div>
          <!-- Badge flottant -->
          <div class="hero-photo-badge">
            <span class="stat-value">✓</span>
            <span class="stat-label"><?= t('index_hero_badge_senelec') ?></span>
          </div>
          <!-- Dots de navigation -->
          <div class="hero-slider-dots" id="heroSliderDots">
            <?php foreach ($hero_slides as $i => $slide): ?>
            <button class="hero-dot <?= $i === 0 ? 'active' : '' ?>"
                    onclick="heroGoTo(<?= $i ?>)" aria-label="Slide <?= $i+1 ?>"></button>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Vagues SVG -->
  <div class="hero-waves">
    <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,40 C240,80 480,0 720,40 C960,80 1200,0 1440,40 L1440,80 L0,80 Z" fill="#f4f7fb" opacity="0.6"/>
      <path d="M0,55 C360,10 720,80 1080,30 C1260,10 1380,50 1440,55 L1440,80 L0,80 Z" fill="#f4f7fb"/>
    </svg>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS 4 PÔLES D'ACTIVITÉS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
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

      <!-- Énergie -->
      <div class="pole-card green animate-fade-up delay-2">
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

      <!-- Routes -->
      <div class="pole-card animate-fade-up delay-3">
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

      <!-- Industrie -->
      <div class="pole-card purple animate-fade-up delay-4">
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

    <div class="stats-grid">
      <div class="stat-item">
        <div class="stat-item-num">
          <span class="counter" data-target="10">0</span>+
        </div>
        <div class="stat-item-label"><?= t('index_stats_ans_label') ?></div>
        <div class="stat-item-desc"><?= t('index_stats_ans_desc') ?></div>
      </div>
      <div class="stat-item">
        <div class="stat-item-num">
          <span class="counter" data-target="25">0</span>+
        </div>
        <div class="stat-item-label"><?= t('index_stats_projets_label') ?></div>
        <div class="stat-item-desc"><?= t('index_stats_projets_desc') ?></div>
      </div>
      <div class="stat-item">
        <div class="stat-item-num">
          <span class="counter" data-target="4">0</span>
        </div>
        <div class="stat-item-label"><?= t('index_stats_poles_label') ?></div>
        <div class="stat-item-desc"><?= t('index_stats_poles_desc') ?></div>
      </div>
      <div class="stat-item">
        <div class="stat-item-num">
          <span class="counter" data-target="100">0</span>+
        </div>
        <div class="stat-item-label"><?= t('index_stats_experts_label') ?></div>
        <div class="stat-item-desc"><?= t('index_stats_experts_desc') ?></div>
      </div>
      <div class="stat-item">
        <div class="stat-item-num">
          <span class="counter" data-target="15">0</span>+
        </div>
        <div class="stat-item-label"><?= t('index_stats_part_label') ?></div>
        <div class="stat-item-desc"><?= t('index_stats_part_desc') ?></div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS ÉQUIPES SUR LE TERRAIN
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="hero-layout" style="gap:48px;">

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
      <div class="hero-right animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="galerie-item" style="grid-column:span 2;aspect-ratio:16/7;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-terrain.jpg"
               alt="<?= t('img_alt_equipe_terrain') ?>"
               loading="lazy">
        </div>
        <div class="galerie-item" style="aspect-ratio:4/3;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/ingenieure-plans.jpg"
               alt="<?= t('img_alt_ingenieure_plans') ?>"
               loading="lazy">
        </div>
        <div class="galerie-item" style="aspect-ratio:4/3;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/gilet-cotrac.jpg"
               alt="<?= t('img_alt_technicien_gilet') ?>"
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


<!-- ═══════════════════════════════════════════════════════════
     SECTION : VIDÉO CHANTIER
═══════════════════════════════════════════════════════════ -->
<?php if (cms_active('index','video_chantier')): ?>
<section class="section" style="background:#0a1628;padding:0;overflow:hidden;">
  <div style="position:relative;height:580px;overflow:hidden;">

    <!-- Vidéo -->
    <?php
    $_vid_src_raw = cms('index','video_chantier','video_src','assets/videos/cotrac-chantier.mp4');
    $_vid_src = cms_img_url($_vid_src_raw);
    $_vid_poster_raw = cms('index','video_chantier','poster_img','');
    $_vid_poster = cms_bg_url($_vid_poster_raw);
    ?>
    <video
      id="cotrac-video"
      autoplay muted loop playsinline
      <?= $_vid_poster ? 'poster="'.e($_vid_poster).'"' : '' ?>
      style="position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;object-position:center;opacity:0.52;">
      <source src="<?= e($_vid_src) ?>" type="video/mp4">
    </video>

    <!-- Overlay contenu centré -->
    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:40px 20px;">
      <span style="background:rgba(247,148,29,0.18);border:1px solid rgba(247,148,29,0.4);color:#f7941d;font-size:.78rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:6px 16px;border-radius:50px;margin-bottom:20px;">
        <?= icon('play','#f7941d','.8rem') ?> <?= t('index_video_badge') ?>
      </span>
      <h2 style="color:#fff;font-size:clamp(1.8rem,4vw,3rem);font-weight:800;line-height:1.2;margin-bottom:18px;max-width:700px;font-family:'Poppins',sans-serif;">
        <?= t('index_video_titre') ?>
      </h2>
      <p style="color:rgba(255,255,255,0.82);font-size:1.05rem;line-height:1.7;max-width:540px;margin-bottom:32px;">
        <?= t('index_video_desc') ?>
      </p>
      <div style="display:flex;gap:16px;flex-wrap:wrap;justify-content:center;">
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary">
          <?= icon('arrow-right','','.9rem') ?> <?= t('index_video_btn_real') ?>
        </a>
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline" style="border-color:rgba(255,255,255,0.5);color:#fff;">
          <?= icon('mail','','.9rem') ?> <?= t('index_video_btn_contact') ?>
        </a>
      </div>

      <!-- Mini stats -->
      <div style="display:flex;gap:32px;margin-top:40px;flex-wrap:wrap;justify-content:center;">
        <div style="text-align:center;">
          <div style="font-size:2rem;font-weight:800;color:#f7941d;font-family:'Poppins',sans-serif;">10+</div>
          <div style="font-size:.75rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.08em;"><?= t('index_video_stat_ans') ?></div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.15);"></div>
        <div style="text-align:center;">
          <div style="font-size:2rem;font-weight:800;color:#f7941d;font-family:'Poppins',sans-serif;">25+</div>
          <div style="font-size:.75rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.08em;"><?= t('index_video_stat_projets') ?></div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.15);"></div>
        <div style="text-align:center;">
          <div style="font-size:2rem;font-weight:800;color:#f7941d;font-family:'Poppins',sans-serif;">14</div>
          <div style="font-size:.75rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.08em;"><?= t('index_video_stat_regions') ?></div>
        </div>
      </div>
    </div>

  </div>
</section>
<?php endif; ?>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : TÉMOIGNAGES CLIENTS
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
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

<style>
.temoignage-card {
  background: #fff;
  border-radius: 18px;
  padding: 32px 28px;
  border: 1px solid var(--border);
  box-shadow: 0 2px 16px rgba(26,107,181,0.06);
  display: flex;
  flex-direction: column;
  gap: 18px;
  transition: var(--transition);
  position: relative;
}
.temoignage-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 36px rgba(26,107,181,0.12);
  border-color: rgba(26,107,181,0.2);
}
.temoignage-quote {
  width: 44px; height: 44px;
  background: rgba(247,148,29,0.1);
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
}
.temoignage-text {
  font-size: 0.92rem;
  color: #4b5563;
  line-height: 1.8;
  font-style: italic;
  flex: 1;
}
.temoignage-author {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: 16px;
  border-top: 1px solid var(--border);
}
.temoignage-logo {
  width: 52px; height: 52px;
  border-radius: 10px;
  overflow: hidden;
  flex-shrink: 0;
  border: 1px solid var(--border);
}
.temoignage-logo img {
  width: 100%; height: 100%;
  object-fit: contain;
  padding: 4px;
}
.temoignage-name {
  font-size: 0.88rem;
  font-weight: 700;
  color: var(--texte);
}
.temoignage-company {
  font-size: 0.78rem;
  color: var(--gris);
  margin-top: 2px;
}
.temoignage-stars {
  color: #f7941d;
  font-size: 0.9rem;
  letter-spacing: 2px;
}
@media (max-width: 900px) {
  .temoignage-card { grid-column: span 1; }
  section .container > div[style*="repeat(3"] { grid-template-columns: 1fr !important; }
}
</style>


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
        $has_img  = !empty($p['image']) && file_exists(__DIR__ . '/uploads/projets/' . $p['image']);
      ?>
      <div class="projet-card animate-fade-up">
        <div class="projet-img">
<?php if ($has_img): ?>
          <img src="<?= SITE_URL ?>/uploads/projets/<?= e($p['image']) ?>" alt="<?= e($p['titre']) ?>">
<?php else: ?>
          <img src="<?= SITE_URL ?>/assets/images/<?= $fallback ?>" alt="<?= e($p['titre']) ?>">
<?php endif; ?>
          <span class="projet-badge <?= e($statut_class) ?>"><?= e($p['statut'] ?? t('projet_statut_en_cours')) ?></span>
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
          <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-inspection.jpg" alt="<?= t('img_alt_chantier_elec') ?>">
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
          <img src="<?= SITE_URL ?>/uploads/projets/pose-poteau-grue.jpg" alt="<?= t('img_alt_chantier_elec') ?>">
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
          <img src="<?= SITE_URL ?>/uploads/projets/terrain-chantier.jpg" alt="<?= t('img_alt_chantier_indus') ?>">
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

    <div class="text-center" style="margin-top:48px;">
      <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary">
        <?= t('index_real_btn_tous') ?>
      </a>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : PARTENAIRES
═══════════════════════════════════════════════════════════ -->
<section class="section section-sm">
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
        $has_img  = !empty($actu['image']) && file_exists(__DIR__ . '/uploads/actualites/' . $actu['image']);
        $date_fmt = strtr(date('d F Y', strtotime($actu['created_at'])), $mois_fr_home);
      ?>
      <article class="actu-home-card animate-fade-up" style="transition-delay:<?= $i * 100 ?>ms;">
        <div class="actu-home-card-img">
          <?php if ($has_img): ?>
            <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($actu['image']) ?>"
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

<style>
.actu-home-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 2px 16px rgba(0,0,0,.06);
  border: 1px solid var(--border);
  transition: transform .25s, box-shadow .25s;
  display: flex; flex-direction: column;
}
.actu-home-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 36px rgba(26,107,181,.13);
}
.actu-home-card-img {
  position: relative; height: 190px; overflow: hidden;
  background: linear-gradient(135deg, #e8f1fb, #d4e6f7);
}
.actu-home-card-img img {
  width:100%; height:100%; object-fit:cover; display:block;
  transition: transform .4s ease;
}
.actu-home-card:hover .actu-home-card-img img { transform: scale(1.05); }
.actu-home-card-placeholder {
  width:100%; height:100%;
  display:flex; align-items:center; justify-content:center;
  color: var(--bleu); opacity:.3;
}
.actu-home-card-overlay {
  position:absolute; inset:0;
  background: linear-gradient(to top, rgba(10,22,40,.25), transparent);
}
.actu-home-card-body {
  padding: 20px; display:flex; flex-direction:column; flex:1;
}
.actu-home-card-date {
  display:inline-flex; align-items:center; gap:5px;
  font-size:.72rem; color:var(--gris); margin-bottom:10px;
  text-transform:capitalize;
}
.actu-home-card-title {
  font-size:.98rem; font-weight:700; color:var(--texte);
  line-height:1.4; margin-bottom:8px;
}
.actu-home-card-excerpt {
  font-size:.84rem; color:var(--gris); line-height:1.6; flex:1; margin-bottom:16px;
}
.actu-home-card-link {
  display:inline-flex; align-items:center; gap:6px;
  font-size:.82rem; font-weight:600; color:var(--bleu);
  text-decoration:none; margin-top:auto;
  transition: gap .2s, color .2s;
}
.actu-home-card-link:hover { color:var(--orange); gap:10px; }
</style>
<?php endif; ?>

<!-- ═══════════════════════════════════════════════════════════
     CTA FINAL
═══════════════════════════════════════════════════════════ -->
<section class="stats-section">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center;">

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
          +221 33 827 96 39 &nbsp;|&nbsp; +221 77 630 16 46
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
        <a href="<?= SITE_URL ?>/a-propos.php" class="btn btn-outline" style="width:100%;justify-content:center;">
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

<script>
document.addEventListener('DOMContentLoaded', function(){
  var track  = document.getElementById('heroSliderTrack');
  var dots   = document.querySelectorAll('.hero-dot');
  if (!track) return;
  var slides = track.querySelectorAll('.hero-slide');
  var total  = slides.length;
  var current = 0;
  var timer;

  /* Activer la première slide au départ */
  slides[0].classList.add('active');

  function goTo(n) {
    slides[current].classList.remove('active');
    dots[current] && dots[current].classList.remove('active');
    current = (n + total) % total;
    slides[current].classList.add('active');
    dots[current] && dots[current].classList.add('active');
  }

  function next() { goTo(current + 1); }
  function startAuto() { timer = setInterval(next, 3500); }
  function stopAuto()  { clearInterval(timer); }

  window.heroGoTo = function(n) { stopAuto(); goTo(n); startAuto(); };

  var startX = 0;
  track.parentElement.addEventListener('touchstart', function(e){ startX = e.touches[0].clientX; }, {passive:true});
  track.parentElement.addEventListener('touchend', function(e){
    var dx = e.changedTouches[0].clientX - startX;
    if (Math.abs(dx) > 40) { stopAuto(); goTo(current + (dx < 0 ? 1 : -1)); startAuto(); }
  }, {passive:true});

  startAuto();
});
</script>
<?php require_once 'includes/footer.php'; ?>
