<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = t('energie_page_title') ?: 'Réseaux Électriques HTA/MT/BT | COTRAC';
$page_desc  = t('energie_page_desc')  ?: 'COTRAC réalise vos travaux de réseaux électriques HTA/MT/BT au Sénégal.';
cms_load('energie');
require_once 'includes/header.php';
?>

<style>
/* ── Responsive overrides — energie.php ── */

/* Hero : 2 colonnes → 1 colonne sous 768px */
.energie-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
}
.energie-hero-stats {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

/* CTA : 2 colonnes → 1 colonne sous 768px */
.energie-cta-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 64px;
  align-items: center;
}

/* ── Galerie chantier : grille pro avec bordures ── */
.energie-galerie-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-template-rows: 220px 220px 220px;
  gap: 12px;
  margin-top: 8px;
}
.energie-galerie-grid .galerie-item {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  cursor: pointer;
  background: var(--gris-clair);
  border: 2px solid rgba(255,255,255,.9);
  box-shadow: 0 4px 18px rgba(0,0,0,.12);
  transition: box-shadow .3s, transform .3s;
}
.energie-galerie-grid .galerie-item:hover {
  box-shadow: 0 8px 32px rgba(26,107,181,.25);
  transform: translateY(-2px);
}
.energie-galerie-grid .galerie-item img {
  width: 100%; height: 100%; object-fit: cover; display: block;
  transition: transform .4s ease;
}
.energie-galerie-grid .galerie-item:hover img { transform: scale(1.06); }
.energie-galerie-grid .galerie-item-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,22,40,.7) 0%, transparent 55%);
  opacity: 0; transition: opacity .3s;
  display: flex; align-items: flex-end; padding: 14px;
}
.energie-galerie-grid .galerie-item:hover .galerie-item-overlay { opacity: 1; }
.energie-galerie-grid .energie-galerie-caption {
  color: #fff; font-size: .78rem; font-weight: 600;
  text-shadow: 0 1px 4px rgba(0,0,0,.6);
  letter-spacing: .02em;
}
/* items featured */
.energie-galerie-grid .gi-wide  { grid-column: span 2; }
.energie-galerie-grid .gi-tall  { grid-row: span 2; }
.energie-galerie-grid .gi-big   { grid-column: span 2; grid-row: span 2; }

/* ── Vidéo player style macOS — taille réduite ── */
.energie-video-wrap {
  margin: 28px auto 0;
  max-width: 560px;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0,0,0,.3);
  border: 1px solid rgba(255,255,255,.1);
}
.energie-video-header {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 11px 16px;
  background: #1c2a3e;
  border-bottom: 1px solid rgba(0,0,0,.3);
}
.energie-video-dot {
  width: 11px; height: 11px; border-radius: 50%;
  flex-shrink: 0;
}
.energie-video-title {
  color: rgba(255,255,255,.75);
  font-size: .78rem;
  font-weight: 600;
  margin-left: 8px;
  letter-spacing: .02em;
}
.energie-video-wrap video {
  display: block;
  width: 100%;
  max-height: 320px;
  background: #000;
}

/* Normes */
.energie-normes-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 28px;
  max-width: 900px;
  margin: 0 auto;
}

@media (max-width: 900px) {
  .energie-galerie-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: none;
    grid-auto-rows: 180px;
  }
  .energie-galerie-grid .gi-big { grid-column: span 2; grid-row: span 1; }
  .energie-galerie-grid .gi-tall { grid-row: span 1; }
}
@media (max-width: 768px) {
  .energie-hero-grid,
  .energie-cta-grid { grid-template-columns: 1fr; gap: 32px; }
  .energie-hero-stats { grid-template-columns: 1fr 1fr; }
  .energie-cta-grid { gap: 24px; }
  .energie-galerie-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: none;
    grid-auto-rows: 150px;
  }
  .energie-galerie-grid .gi-wide,
  .energie-galerie-grid .gi-big { grid-column: span 2; grid-row: span 1; }
  .energie-galerie-grid .gi-tall { grid-row: span 1; }
  .energie-video-wrap { max-width: 100%; }
}
</style>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
═══════════════════════════════════════════════════════════ -->
<?php $_energie_hero_bg = cms_bg_url(cms('energie','hero','bg_image','')); ?>
<section class="page-hero" style="position:relative;overflow:hidden;min-height:420px;<?= $_energie_hero_bg ? 'background-image:url(\''.e($_energie_hero_bg).'\');background-size:cover;background-position:center;' : '' ?>">
  <?php if (!$_energie_hero_bg): ?>
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac2.png" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 5%;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,30,70,0.85) 50%,rgba(10,30,70,0.65));z-index:1;"></div>
  <?php endif; ?>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container energie-hero-grid">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('breadcrumb_accueil') ?></a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles"><?= t('breadcrumb_poles') ?></a>
        <span class="sep">›</span>
        <span><?= t('energie_breadcrumb_current') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('energie','hero','title', t('energie_hero_titre')) ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('energie','hero','subtitle', t('energie_hero_desc')) ?>
      </p>
    </div>
    <!-- Chiffres clés énergie -->
    <div class="animate-fade-up delay-2 energie-hero-stats">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">10+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('energie_stat_projets') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">22kV</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('energie_stat_hta') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">450kVA</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('energie_stat_groupes') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;"><?= t('energie_stat_agree') ?></div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">SENELEC</div>
      </div>
    </div>
  </div>
  </div><!-- /z-index wrapper -->
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : TRAVAUX HTA/BT
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('energie_services_tag') ?></span>
      <h2 class="section-title"><?= t('energie_services_titre') ?></h2>
      <p class="section-sub">
        <?= t('energie_services_desc') ?>
      </p>
    </div>

    <ul class="services-list">

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><span class="ico ico-energie"><!--energie--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s1_titre') ?></h3>
          <p><?= t('energie_s1_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><span class="ico ico-poste"><!--poste--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s2_titre') ?></h3>
          <p><?= t('energie_s2_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><span class="ico ico-eclairage"><!--eclairage--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s3_titre') ?></h3>
          <p><?= t('energie_s3_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><span class="ico ico-eclairage"><!--eclairage--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s4_titre') ?></h3>
          <p><?= t('energie_s4_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><span class="ico ico-solaire"><!--solaire--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s5_titre') ?></h3>
          <p><?= t('energie_s5_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><span class="ico ico-signalisation"><!--signal--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s6_titre') ?></h3>
          <p><?= t('energie_s6_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><span class="ico ico-wrench"><!--wrench--></span></div>
        <div class="service-body">
          <h3><?= t('energie_s7_titre') ?></h3>
          <p><?= t('energie_s7_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('zap', 'service-ico', '1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('energie_s8_titre') ?></h3>
          <p><?= t('energie_s8_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('shield', 'service-ico', '1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('energie_s9_titre') ?></h3>
          <p><?= t('energie_s9_desc') ?></p>
        </div>
      </li>

    </ul>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : GALERIE CHANTIERS ÉLECTRIQUES
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('energie_galerie_tag') ?></span>
      <h2 class="section-title"><?= t('energie_galerie_titre') ?></h2>
      <p class="section-sub">
        <?= t('energie_galerie_desc') ?>
      </p>
    </div>

    <?php
    $_e_g1 = cms_img_url(cms('energie','services_cards','card1_icon','assets/images/energie/pose-poteau-grue.jpg'));
    $_e_g2 = cms_img_url(cms('energie','services_cards','card2_icon','assets/images/energie/lampadaire-solaire.jpg'));
    $_e_g3 = cms_img_url(cms('energie','services_cards','card3_icon','assets/images/energie/ligne-hta-transformateur.jpg'));
    $_e_g4 = cms_img_url(cms('energie','services_cards','card4_icon','assets/images/energie/armoire-coupure-hta.jpg'));
    ?>

    <!-- Grille masonry pro : 4 colonnes, hauteurs variables -->
    <div class="energie-galerie-grid">

      <!-- Grande image vedette -->
      <div class="galerie-item gi-big animate-fade-up delay-1">
        <img src="<?= e($_e_g1) ?>" alt="<?= t('energie_galerie_alt1') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap1') ?></span></div>
      </div>

      <!-- Colonne droite : 2 petites empilées -->
      <div class="galerie-item animate-fade-up delay-2">
        <img src="<?= e($_e_g2) ?>" alt="<?= t('energie_galerie_alt2') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap2') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= e($_e_g3) ?>" alt="<?= t('energie_galerie_alt3') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap3') ?></span></div>
      </div>

      <!-- Rang 2 : 4 égales -->
      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= e($_e_g4) ?>" alt="<?= t('energie_galerie_alt4') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap4') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/energie/poste-transformation.jpg" alt="<?= t('energie_galerie_alt5') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap5') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= SITE_URL ?>/assets/images/energie/tranchee-cable-bt.jpg" alt="<?= t('energie_galerie_alt6') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap6') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= SITE_URL ?>/assets/images/energie/tetes-cable-hta.jpg" alt="<?= t('energie_galerie_alt7') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap7') ?></span></div>
      </div>

      <!-- Rang 3 : large + 2 petites -->
      <div class="galerie-item gi-wide animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/energie/pose-poteau-equipe.jpg" alt="<?= t('energie_galerie_alt10') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap10') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= SITE_URL ?>/assets/images/energie/tranchee-fourreaux.jpg" alt="<?= t('energie_galerie_alt8') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap8') ?></span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= SITE_URL ?>/assets/images/energie/support-mesure.jpg" alt="<?= t('energie_galerie_alt9') ?>" loading="lazy">
        <div class="galerie-item-overlay"><span class="energie-galerie-caption"><?= t('energie_galerie_cap9') ?></span></div>
      </div>

    </div>

    <!-- Vidéo player style macOS encadré -->
    <div class="energie-video-wrap animate-fade-up">
      <div class="energie-video-header">
        <span class="energie-video-dot" style="background:#ff5f57;"></span>
        <span class="energie-video-dot" style="background:#febc2e;"></span>
        <span class="energie-video-dot" style="background:#28c840;"></span>
        <span class="energie-video-title"><?= t('energie_video_titre') ?></span>
      </div>
      <video
        src="<?= SITE_URL ?>/assets/videos/energie-pose-poteau.mov"
        controls
        preload="metadata"
        poster="<?= SITE_URL ?>/assets/images/energie/pose-poteau-grue.jpg">
        <?= t('energie_video_fallback') ?>
      </video>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NORMES & CERTIFICATIONS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('energie_normes_tag') ?></span>
      <h2 class="section-title"><?= t('energie_normes_titre') ?></h2>
      <p class="section-sub">
        <?= t('energie_normes_desc') ?>
      </p>
    </div>

    <div class="energie-normes-grid">

      <div class="valeur-card animate-fade-up delay-1" style="text-align:center;padding:24px 24px;">
        <div style="font-size:2.4rem;margin-bottom:16px;"><span class="ico ico-globe"><!--globe--></span></div>
        <h3 style="color:#1a6bb5;font-weight:800;font-size:1.3rem;margin-bottom:12px;">IEC</h3>
        <p style="color:var(--gris);line-height:1.7;font-size:0.94rem;">
          <?= t('energie_norme_iec_desc') ?>
        </p>
      </div>

      <div class="valeur-card animate-fade-up delay-2" style="text-align:center;padding:24px 24px;">
        <div style="font-size:2.4rem;margin-bottom:16px;"><span class="ico ico-certificate"><!--cert--></span></div>
        <h3 style="color:#1a6bb5;font-weight:800;font-size:1.3rem;margin-bottom:12px;">IEEE</h3>
        <p style="color:var(--gris);line-height:1.7;font-size:0.94rem;">
          <?= t('energie_norme_ieee_desc') ?>
        </p>
      </div>

      <div class="valeur-card animate-fade-up delay-3" style="text-align:center;padding:24px 24px;">
        <div style="font-size:2.4rem;margin-bottom:16px;"><span class="ico ico-senegal"><!--sn--></span></div>
        <h3 style="color:#1a6bb5;font-weight:800;font-size:1.3rem;margin-bottom:12px;">SENELEC</h3>
        <p style="color:var(--gris);line-height:1.7;font-size:0.94rem;">
          <?= t('energie_norme_senelec_desc') ?>
        </p>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : PARTENAIRES ÉNERGIE
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('energie_part_tag') ?></span>
      <h2 class="section-title"><?= t('energie_part_titre') ?></h2>
      <p class="section-sub">
        <?= t('energie_part_desc') ?>
      </p>
    </div>

    <div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:center;">
      <?php
      $partenaires = [
          'PROQUELEC', 'Expresso Sénégal', 'SENELEC', 'SOBOA',
          'ICS - Industries Chimiques du Sénégal', 'DIYAR KABLO',
          'Armatek (Turquie)', 'SENICO', 'SEN\'EAU', 'WISE Energy Solutions',
      ];
      foreach ($partenaires as $i => $p):
        $delay = ($i % 3) + 1;
      ?>
      <span class="tag animate-fade-up delay-<?= $delay ?>" style="font-size:0.95rem;padding:10px 20px;background:#fff;border:2px solid #1a6bb5;color:#1a6bb5;border-radius:50px;font-weight:600;">
        <?= e($p) ?>
      </span>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$galerie_titre  = t('energie_galerie2_titre');
$galerie_photos = [
  ['src'=>'assets/images/energie/pose-poteau-grue.jpg',        'alt'=>t('energie_galerie_alt1'),  'caption'=>t('energie_galerie_cap1')],
  ['src'=>'assets/images/energie/tranchee-cours.jpg',          'alt'=>t('energie_galerie_alt6'),  'caption'=>t('energie_galerie_cap6')],
  ['src'=>'assets/images/energie/jonction-cable-hta.jpg',      'alt'=>t('energie_galerie_alt7'),  'caption'=>t('energie_galerie_cap7')],
  ['src'=>'assets/images/energie/armoire-coupure-hta.jpg',     'alt'=>t('energie_galerie_alt4'),  'caption'=>t('energie_galerie_cap4')],
  ['src'=>'assets/images/energie/tranchee-grillage.jpg',       'alt'=>t('energie_galerie_alt8'),  'caption'=>t('energie_galerie_cap8')],
  ['src'=>'assets/images/energie/poteau-transformateur.jpg',   'alt'=>t('energie_galerie_alt5'),  'caption'=>t('energie_galerie_cap5')],
  ['src'=>'assets/images/energie/dechargement-supports.jpg',   'alt'=>t('energie_galerie_alt9'),  'caption'=>t('energie_galerie_cap9')],
  ['src'=>'assets/images/energie/lampadaire-solaire.jpg',      'alt'=>t('energie_galerie_alt2'),  'caption'=>t('energie_galerie_cap2')],
  ['src'=>'assets/images/energie/equipe-proquelec.jpg',        'alt'=>t('energie_galerie_alt10'), 'caption'=>t('energie_galerie_cap10')],
];
require 'includes/galerie.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION : CTA
═══════════════════════════════════════════════════════════ -->
<section style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container energie-cta-grid">
    <div>
      <span class="section-tag orange" style="margin-bottom:20px;display:inline-block;"><?= t('energie_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-bottom:16px;"><?= t('energie_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.75);font-size:.95rem;line-height:1.8;margin-bottom:32px;">
        <?= t('energie_cta_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;align-items:center;gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','1.1rem') ?></div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('energie_cta_tel_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">+221 33 827 96 39 &nbsp;|&nbsp; +221 77 630 16 46</div>
          </div>
        </div>
        <div style="display:flex;align-items:center;gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','1.1rem') ?></div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('energie_cta_email_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">cotracsenegal@gmail.com</div>
          </div>
        </div>
      </div>
    </div>
    <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.13);border-radius:20px;padding:28px 28px;text-align:center;backdrop-filter:blur(8px);">
      <div style="width:64px;height:64px;background:rgba(240,128,20,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;"><?= icon('zap','','1.8rem') ?></div>
      <h3 style="color:#fff;font-size:1.3rem;font-weight:700;margin-bottom:12px;"><?= t('energie_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.65);font-size:.88rem;line-height:1.7;margin-bottom:28px;">
        <?= t('energie_cta_card_desc') ?>
      </p>
      <a href="<?= SITE_URL ?>/realisations.php?pole=energie" class="btn btn-primary" style="width:100%;display:block;text-align:center;margin-bottom:12px;">
        <?= t('energie_cta_btn_real') ?>
      </a>
      <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline" style="width:100%;display:block;text-align:center;margin-bottom:12px;">
        <?= t('energie_cta_btn_devis') ?>
      </a>
      <a href="<?= SITE_URL ?>/assets/docs/plaquette-energie.pdf" download
         style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.85);text-decoration:none;font-size:.88rem;font-weight:600;transition:.2s;">
        <?= icon('file','','.9rem') ?> <?= t('energie_cta_btn_plaquette') ?>
      </a>
    </div>
  </div>
  </div>
</section>


<?php require_once 'includes/footer.php'; ?>

