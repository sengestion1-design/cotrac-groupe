<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = t('btp_page_title') ?: 'Bâtiment & Travaux Publics | COTRAC';
$page_desc  = t('btp_page_desc')  ?: 'COTRAC, expert BTP au Sénégal.';
cms_load('btp');
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     RESPONSIVE OVERRIDES BTP
═══════════════════════════════════════════════════════════ -->
<style>
/* Hero : 2 colonnes → 1 colonne sous 768px */
.btp-hero-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: center;
}
/* Chiffres clés hero : 2x2 → 2x2 conservé mais réduit sur très petit écran */
.btp-stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}
/* Galerie réalisations : auto-fit responsive */
.btp-projets-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 28px;
  max-width: 420px;
  margin: 0 auto;
}
/* CTA : 2 colonnes → 1 colonne sous 768px */
.btp-cta-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  align-items: center;
}
/* Images service : hauteur fixe réduite sur mobile */
.btp-service-img {
  width: 100%;
  height: 340px;
  object-fit: cover;
  border-radius: 16px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.14);
}
@media (max-width: 768px) {
  .btp-hero-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }
  .btp-stats-grid {
    grid-template-columns: 1fr 1fr;
    gap: 10px;
  }
  .btp-cta-grid {
    grid-template-columns: 1fr;
    gap: 28px;
  }
  .btp-cta-section {
    min-height: auto !important;
  }
  .btp-service-img {
    height: 220px;
  }
}
@media (max-width: 480px) {
  .btp-stats-grid {
    grid-template-columns: 1fr 1fr;
    gap: 8px;
  }
  .btp-service-img {
    height: 180px;
  }
}
</style>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO BTP
═══════════════════════════════════════════════════════════ -->
<?php $_btp_hero_bg = cms_bg_url(cms('btp','hero','bg_image','')); ?>
<section class="page-hero" style="position:relative;overflow:hidden;min-height:420px;<?= $_btp_hero_bg ? 'background-image:url(\''.e($_btp_hero_bg).'\');background-size:cover;background-position:center;' : '' ?>">
  <?php if (!$_btp_hero_bg): ?>
  <img src="<?= SITE_URL ?>/assets/images/equipe/batiment-chantier.png" alt=""
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 20%;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,30,70,0.85) 50%,rgba(10,30,70,0.65));z-index:1;"></div>
  <?php endif; ?>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container btp-hero-grid">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('breadcrumb_accueil') ?></a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles"><?= t('breadcrumb_poles') ?></a>
        <span class="sep">›</span>
        <span><?= t('btp_breadcrumb_current') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('btp','hero','title', t('btp_hero_titre')) ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('btp','hero','subtitle', t('btp_hero_desc')) ?>
      </p>
    </div>
    <!-- Chiffres clés BTP -->
    <div class="animate-fade-up delay-2 btp-stats-grid">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">15+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('btp_stat_batiments') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">4</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('btp_stat_domaines') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">10+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('btp_stat_annees') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">100%</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('btp_stat_projets') ?></div>
      </div>
    </div>
  </div>
  </div><!-- /z-index wrapper -->
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : SERVICES DÉTAILLÉS (2 colonnes)
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('btp_services_tag') ?></span>
      <h2 class="section-title"><?= t('btp_services_titre') ?></h2>
      <p class="section-sub">
        <?= t('btp_services_desc') ?>
      </p>
    </div>

    <!-- Service 1 : Construction de bâtiments -->
    <div class="section-2col animate-fade-up delay-1" style="margin-bottom:24px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c1 = cms_img_url(cms('btp','services_cards','card1_icon','assets/images/equipe/hopital-construction.png')); ?>
        <img src="<?= e($_btp_c1) ?>"
             alt="<?= t('btp_pole1_img_alt') ?>"
             class="btp-service-img"
             style="object-position:center top;"
             loading="lazy">
      </div>
      <!-- Liste droite -->
      <div>
        <span class="section-tag"><?= t('btp_pole1_tag') ?></span>
        <h3 class="section-title" style="text-align:left;font-size:1.6rem;"><?= t('btp_pole1_titre') ?></h3>
        <p style="color:var(--gris);line-height:1.85;margin-bottom:20px;">
          <?= t('btp_pole1_desc') ?>
        </p>
        <ul class="services-list" style="margin-top:0;">
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole1_item1') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole1_item2') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole1_item3') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole1_item4') ?></h4>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Service 2 : Rénovation et réhabilitation -->
    <div class="section-2col animate-fade-up delay-2" style="margin-bottom:24px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c2 = cms_img_url(cms('btp','services_cards','card2_icon','assets/images/equipe/plomberie-hotel.png')); ?>
        <img src="<?= e($_btp_c2) ?>"
             alt="<?= t('btp_pole2_img_alt') ?>"
             class="btp-service-img"
             style="object-position:center;"
             loading="lazy">
      </div>
      <!-- Liste droite -->
      <div>
        <span class="section-tag"><?= t('btp_pole2_tag') ?></span>
        <h3 class="section-title" style="text-align:left;font-size:1.6rem;"><?= t('btp_pole2_titre') ?></h3>
        <p style="color:var(--gris);line-height:1.85;margin-bottom:20px;">
          <?= t('btp_pole2_desc') ?>
        </p>
        <ul class="services-list" style="margin-top:0;">
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole2_item1') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole2_item2') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole2_item3') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole2_item4') ?></h4>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Service 3 : Études et maîtrise d'œuvre -->
    <div class="section-2col animate-fade-up delay-1" style="margin-bottom:24px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c3 = cms_img_url(cms('btp','services_cards','card3_icon','assets/images/equipe/ingenieures-plans-chantier.png')); ?>
        <img src="<?= e($_btp_c3) ?>"
             alt="<?= t('btp_pole3_img_alt') ?>"
             class="btp-service-img"
             style="box-shadow:0 8px 32px rgba(0,0,0,0.12);"
             loading="lazy">
      </div>
      <!-- Liste droite -->
      <div>
        <span class="section-tag"><?= t('btp_pole3_tag') ?></span>
        <h3 class="section-title" style="text-align:left;font-size:1.6rem;"><?= t('btp_pole3_titre') ?></h3>
        <p style="color:var(--gris);line-height:1.85;margin-bottom:20px;">
          <?= t('btp_pole3_desc') ?>
        </p>
        <ul class="services-list" style="margin-top:0;">
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole3_item1') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole3_item2') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole3_item3') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole3_item4') ?></h4>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <!-- Service 4 : Infrastructures scolaires & sanitaires -->
    <div class="section-2col animate-fade-up delay-2">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c4 = cms_img_url(cms('btp','services_cards','card4_icon','assets/images/equipe/chateau-eau-construction.png')); ?>
        <img src="<?= e($_btp_c4) ?>"
             alt="<?= t('btp_pole4_img_alt') ?>"
             class="btp-service-img"
             style="box-shadow:0 8px 32px rgba(0,0,0,0.12);"
             loading="lazy">
      </div>
      <!-- Liste droite -->
      <div>
        <span class="section-tag"><?= t('btp_pole4_tag') ?></span>
        <h3 class="section-title" style="text-align:left;font-size:1.6rem;"><?= t('btp_pole4_titre') ?></h3>
        <p style="color:var(--gris);line-height:1.85;margin-bottom:20px;">
          <?= t('btp_pole4_desc') ?>
        </p>
        <ul class="services-list" style="margin-top:0;">
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole4_item1') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole4_item2') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole4_item3') ?></h4>
            </div>
          </li>
          <li class="service-item stagger-item">
            <?= icon('check', '', '1.2rem') ?>
            <div class="service-body">
              <h4><?= t('btp_pole4_item4') ?></h4>
            </div>
          </li>
        </ul>
      </div>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : GALERIE CHANTIERS
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('btp_galerie_tag') ?></span>
      <h2 class="section-title"><?= t('btp_galerie_titre') ?></h2>
      <p class="section-sub">
        <?= t('btp_galerie_desc') ?>
      </p>
    </div>

    <div class="galerie-grid">

      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/ossature-metallique-site-industriel.jpg" alt="<?= t('btp_galerie_alt3') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap3') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/equipe/residence-r4-palmiers.png" alt="<?= t('btp_galerie_alt4') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap4') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-eau-ferraillage.jpg" alt="<?= t('btp_galerie_alt5') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap5') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/sas-gb-foods-dakar.jpg" alt="<?= t('btp_galerie_alt6') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap6') ?></div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : RÉALISATIONS NOTABLES
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('btp_real_tag') ?></span>
      <h2 class="section-title"><?= t('btp_real_titre') ?></h2>
      <p class="section-sub">
        <?= t('btp_real_desc') ?>
      </p>
    </div>

    <div class="btp-projets-grid">

      <!-- Projet 1 -->
      <article class="projet-card animate-fade-up delay-1">
        <div class="projet-img" style="height:200px;">
          <img src="<?= SITE_URL ?>/uploads/projets/mur-cloture-cosec-lac-rose.jpg" alt="<?= t('btp_proj1_img_alt') ?>" loading="lazy">
        </div>
        <div class="projet-body" style="padding:24px;">
          <span class="projet-badge"><?= t('btp_real_badge') ?></span>
          <h3 style="font-weight:700;margin:10px 0 8px;font-size:1.05rem;color:var(--bleu);">
            <?= t('btp_proj1_titre') ?>
          </h3>
          <p style="color:var(--gris);font-size:0.92rem;line-height:1.65;">
            <?= t('btp_proj1_desc') ?>
          </p>
          <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap;">
            <span style="background:#e8f0f8;color:#1a6bb5;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj1_tag1') ?></span>
            <span style="background:#e8f0f8;color:#1a6bb5;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj1_tag2') ?></span>
          </div>
        </div>
      </article>

    </div>

    <div class="text-center" style="margin-top:40px;">
      <a href="<?= SITE_URL ?>/realisations.php?pole=btp" class="btn btn-bleu">
        <?= t('btp_real_btn') ?> <?= icon('arrow-right', '', '1rem') ?>
      </a>
    </div>
  </div>
</section>


<!-- Galerie de 6 photos retiree le 2026-09-17 (voir btp.php.avant-suppression-galerie2) -->

<!-- ═══════════════════════════════════════════════════════════
     SECTION : DÉMOLITION & RECONSTRUCTION — POSTE DE SANTÉ
     PARCELLES ASSAINIES UNITÉ 8
═══════════════════════════════════════════════════════════ -->
<style>
.demo-galerie-grid { position:relative; display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-top:32px;max-width:1200px;margin-left:auto;margin-right:auto; }
@media (max-width:900px) { .demo-galerie-grid { grid-template-columns:repeat(3,1fr); } }
@media (max-width:640px) { .demo-galerie-grid { grid-template-columns:repeat(2,1fr); gap:12px; } }

/* Ligne de progression chronologique : relie les vignettes pour souligner l'évolution */
.demo-timeline-track {
  position: relative;
  max-width: 1200px;
  margin: 28px auto 0;
  height: 6px;
  border-radius: 4px;
  background: linear-gradient(90deg, #e8eef5 0%, #e8eef5 100%);
  overflow: hidden;
}
.demo-timeline-track::before {
  content: '';
  position: absolute; inset: 0;
  width: 0%;
  background: linear-gradient(90deg, #1a6bb5, #f7941d);
  border-radius: 4px;
  transition: width 1.4s cubic-bezier(0.22,1,0.36,1);
}
.demo-timeline-track.visible::before { width: 100%; }
.demo-timeline-labels {
  display: flex; justify-content: space-between;
  max-width: 1200px; margin: 8px auto 0; padding: 0 4px;
}
.demo-timeline-labels span {
  font-size: .68rem; font-weight: 700; color: var(--gris);
  text-transform: uppercase; letter-spacing: .05em;
  opacity: 0; transform: translateY(-6px);
  transition: opacity .5s ease, transform .5s ease;
}
.demo-timeline-labels.visible span { opacity: 1; transform: translateY(0); }
.demo-timeline-labels.visible span:nth-child(1) { transition-delay: .1s; }
.demo-timeline-labels.visible span:nth-child(2) { transition-delay: .35s; }
.demo-timeline-labels.visible span:nth-child(3) { transition-delay: .6s; }
.demo-timeline-labels.visible span:nth-child(4) { transition-delay: .85s; }
.demo-timeline-labels.visible span:nth-child(5) { transition-delay: 1.1s; }
.demo-timeline-labels.visible span:nth-child(6) { transition-delay: 1.35s; }

.demo-galerie-grid .galerie-item {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  cursor: pointer;
  aspect-ratio: 3/4;
  background: var(--gris-clair);
  border: 2px solid rgba(255,255,255,.9);
  box-shadow: 0 4px 18px rgba(0,0,0,.12);
  transition: box-shadow .35s ease, transform .35s ease;
}
.demo-galerie-grid .galerie-item:hover { box-shadow: 0 10px 36px rgba(26,107,181,.28); transform: translateY(-4px); }
.demo-galerie-grid .galerie-item img { width:100%; height:100%; object-fit:cover; display:block; transition: transform .5s ease; }
.demo-galerie-grid .galerie-item:hover img { transform: scale(1.08); }
.demo-galerie-grid .galerie-item-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,22,40,.78) 0%, transparent 55%);
  opacity: 0; transition: opacity .3s;
  display: flex; align-items: flex-end; padding: 12px;
}
.demo-galerie-grid .galerie-item:hover .galerie-item-overlay { opacity: 1; }
.demo-galerie-grid .galerie-item-step {
  position: absolute; top: 10px; left: 10px;
  background: rgba(247,148,29,.95); color: #fff;
  font-size: .68rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase;
  padding: 3px 9px; border-radius: 20px; z-index: 2;
  box-shadow: 0 2px 8px rgba(0,0,0,.25);
  animation: demoStepPulse 2.4s ease-in-out infinite;
}
@keyframes demoStepPulse {
  0%, 100% { box-shadow: 0 2px 8px rgba(0,0,0,.25); }
  50% { box-shadow: 0 2px 8px rgba(247,148,29,.55); }
}
.demo-galerie-caption { color:#fff; font-size:.74rem; font-weight:600; text-shadow:0 1px 4px rgba(0,0,0,.6); line-height:1.3; }

/* Cascade d'apparition : chaque vignette suit la précédente pour mimer la progression du chantier */
.demo-galerie-grid .galerie-item.stagger-item { transition-delay: calc(var(--demo-i, 0) * 0.07s); }
.demo-video-row {
  display: flex; justify-content: center; align-items: flex-start; gap: 28px;
  margin-top: 36px; flex-wrap: wrap;
}
.energie-video-wrap {
  position: relative;
  margin: 0 auto;
  max-width: 100%;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0,0,0,.3);
  border: 1px solid rgba(255,255,255,.1);
}
.energie-video-wrap .energie-video-header {
  display: flex; align-items: center; gap: 8px;
  min-height: 46px;
  padding: 11px 16px; background: #1c2a3e;
  border-bottom: 1px solid rgba(0,0,0,.3);
}
.energie-video-wrap .energie-video-dot { width: 11px; height: 11px; border-radius: 50%; flex-shrink: 0; }
.energie-video-wrap .energie-video-step {
  background:#febc2e; color:#1c2a3e; font-weight:700; font-size:.68rem;
  width:18px; height:18px; border-radius:50%; flex-shrink:0;
  display:flex; align-items:center; justify-content:center; margin-left:4px;
}
.energie-video-wrap .energie-video-title {
  color: rgba(255,255,255,.85); font-size: .78rem; font-weight: 600; letter-spacing: .02em;
  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.energie-video-wrap video {
  display: block;
  width: 100%;
  height: 420px;
  object-fit: cover;
  background: #000;
}
@media (max-width: 640px) {
  .energie-video-wrap video { height: 320px; }
}
.energie-video-play-overlay {
  position: absolute; inset: 0; top: 46px;
  display: flex; align-items: center; justify-content: center;
  background: rgba(0,0,0,.12); pointer-events: none; z-index: 1;
  transition: opacity .2s;
}
.energie-video-play-overlay svg { filter: drop-shadow(0 2px 10px rgba(0,0,0,.6)); }
.energie-video-wrap.playing .energie-video-play-overlay { display: none; }
</style>
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Démolition &amp; Reconstruction — Poste de Santé, Parcelles Assainies Unité 8</h2>
      <p class="section-sub">
        COTRAC a assuré la démolition de l'ancien poste de santé des Parcelles Assainies Unité 8 puis sa reconstruction complète : évacuation des gravats, piquetage et fouilles, ferraillage et coulage des fondations, élévation des murs en agglos — un suivi de chantier photo et vidéo, étape par étape.
      </p>
    </div>

    <div class="demo-timeline-track reveal"></div>
    <div class="demo-timeline-labels reveal">
      <span>Démolition</span>
      <span>Fouilles</span>
      <span>Ferraillage</span>
      <span>Coulage</span>
      <span>Élévation</span>
      <span>Suivi</span>
    </div>

    <div class="demo-galerie-grid">

      <div class="galerie-item stagger-item" style="--demo-i:0;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Démolition</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-gravats-facade.jpg" alt="Gravats de l'ancien poste de santé après démolition, Parcelles Assainies Unité 8" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Ancien bâtiment démoli — gravats évacués</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:1;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Démolition</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-agent-securite.jpg" alt="Agent COTRAC en sécurité sur les décombres du chantier" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Sécurisation du site après démolition</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:2;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Démolition</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-supervision-decombres.jpg" alt="Superviseur COTRAC donnant des instructions sur les décombres du chantier" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Supervision COTRAC sur site</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:3;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Fouilles</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-fouilles-ferraillage.jpg" alt="Fouilles et amorces de ferraillage sur le terrain nettoyé" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Fouilles &amp; premiers aciers en attente</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:4;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Fouilles</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-fouilles-vue-ensemble.jpg" alt="Vue d'ensemble des fouilles et amorces de poteaux avant coulage" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Vue d'ensemble des fouilles</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:5;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Fouilles</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-lecture-plans.jpg" alt="Chef de chantier COTRAC consultant les plans avec l'équipe" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Lecture des plans avec l'équipe</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:6;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Ferraillage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-poteaux-stock.jpg" alt="Stock d'aciers et poteaux en attente, mur de clôture en cours" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Aciers en attente &amp; poteaux de clôture</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:7;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Ferraillage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-ferraillage-1.jpg" alt="Équipe COTRAC posant le ferraillage des fondations" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Pose du ferraillage des fondations</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:8;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Ferraillage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-ferraillage-2.jpg" alt="Assemblage des cages de ferraillage sur le chantier" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Assemblage des cages d'armature</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:9;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Coulage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-coulage-gravier.jpg" alt="Livraison de gravier et ciment pour le coulage des fondations" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Approvisionnement gravier &amp; ciment</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:10;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Coulage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-coulage-approvisionnement.jpg" alt="Réception de gravillon et ciment en bord de rue pour le coulage" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Réception gravillon &amp; ciment</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:11;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Élévation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-coffrage.jpg" alt="Coffrage des longrines avant coulage" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Coffrage des longrines</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:12;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Élévation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-elevation-murs-1.jpg" alt="Élévation des murs en agglos sur les fondations" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Élévation des murs en agglos</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:13;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Élévation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-elevation-murs-2.jpg" alt="Poteaux en béton armé et longrines coulées, mur de clôture" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Poteaux armés &amp; longrines coulées</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:14;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Élévation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-elevation-agglos.jpg" alt="Maçons COTRAC montant les murs en agglos" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Montage des murs par l'équipe COTRAC</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:15;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">6 — Suivi</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/demo-parcelles-suivi-chantier.jpg" alt="Équipe COTRAC en suivi de chantier sur le site du poste de santé" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Suivi de chantier sur site</span></div>
      </div>

    </div>

    <!-- Vidéos player style macOS encadré -->
    <div class="demo-video-row">
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">1</span>
          <span class="energie-video-title">Démolition — vue du site</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <video
          src="<?= SITE_URL ?>/assets/videos/demo-parcelles-1.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/demo-parcelles-1-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">2</span>
          <span class="energie-video-title">Chantier — vue d'ensemble</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <video
          src="<?= SITE_URL ?>/assets/videos/demo-parcelles-2.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/demo-parcelles-2-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">3</span>
          <span class="energie-video-title">Coulage — bétonnière</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <video
          src="<?= SITE_URL ?>/assets/videos/demo-parcelles-3.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/demo-parcelles-3-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">4</span>
          <span class="energie-video-title">Structure élevée — avancement</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <video
          src="<?= SITE_URL ?>/assets/videos/demo-parcelles-4.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/demo-parcelles-4-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
    </div>
  </div>
</section>

<!-- Lightbox dédié à la galerie démolition/reconstruction -->
<div id="iLightbox" class="i-lightbox" onclick="iLbClose(event)">
  <button class="i-lightbox-close" onclick="iLbClose(null, true)">&times;</button>
  <img id="iLightboxImg" src="" alt="">
</div>
<style>
.i-lightbox {
  display: none; position: fixed; inset: 0; z-index: 99999;
  background: rgba(10,22,40,.92);
  align-items: center; justify-content: center;
  backdrop-filter: blur(6px);
  animation: iLbFade .2s ease;
}
.i-lightbox.open { display: flex; }
.i-lightbox img {
  max-width: 97vw; max-height: 96vh; object-fit: contain;
  border-radius: 10px; box-shadow: 0 20px 60px rgba(0,0,0,.5);
  animation: iLbZoom .25s cubic-bezier(0.22,1,0.36,1);
}
.i-lightbox-close {
  position: absolute; top: 20px; right: 24px;
  background: rgba(255,255,255,.12); border: none; color: #fff;
  width: 44px; height: 44px; border-radius: 50%; font-size: 1.6rem; line-height: 1;
  cursor: pointer; transition: background .2s;
}
.i-lightbox-close:hover { background: rgba(255,255,255,.25); }
@keyframes iLbFade { from { opacity: 0; } to { opacity: 1; } }
@keyframes iLbZoom { from { opacity: 0; transform: scale(.9); } to { opacity: 1; transform: scale(1); } }
</style>
<script>
function iLbOpen(src, alt) {
  const lb = document.getElementById('iLightbox');
  document.getElementById('iLightboxImg').src = src;
  document.getElementById('iLightboxImg').alt = alt || '';
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function iLbClose(e, force) {
  if (force || !e || e.target.id === 'iLightbox') {
    document.getElementById('iLightbox').classList.remove('open');
    document.body.style.overflow = '';
  }
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') iLbClose(null, true);
});
</script>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : USINE COTRAC — PRODUCTION D'AGGLOS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Notre usine</span>
      <h2 class="section-title" style="font-size:1.8rem;">Production d'Agglos — Fabrication Intégrée COTRAC</h2>
      <p class="section-sub">
        COTRAC fabrique ses propres agglos en usine : réception des matières premières, alimentation de la presse à parpaings, moulage et contrôle de production, puis séchage sur aire dédiée avant livraison chantier — une maîtrise complète de la chaîne, de la matière première au bloc fini.
      </p>
    </div>

    <div class="demo-galerie-grid" style="margin-top:32px;">

      <div class="galerie-item stagger-item" style="--demo-i:0;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Réception</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-livraison-materiaux.jpg" alt="Camion de livraison de matières premières à l'usine COTRAC" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Livraison des matières premières</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:1;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Réception</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-reception-camion.jpg" alt="Équipe COTRAC réceptionnant un camion à l'usine" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Réception camion à l'usine</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:2;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Alimentation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-convoyeur-alimentation.jpg" alt="Convoyeur alimentant la presse à parpaings en matière première" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Alimentation de la presse par convoyeur</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:3;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Alimentation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-machine-vue-ensemble.jpg" alt="Vue d'ensemble de la machine de fabrication d'agglos Lion Machine" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Vue d'ensemble de la ligne de production</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:4;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Moulage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-moulage-agglos-1.jpg" alt="Opérateur COTRAC pilotant la presse à parpaings" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Moulage des agglos sur presse</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:5;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Moulage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-moulage-agglos-2.jpg" alt="Sortie des agglos fraîchement moulés sur palette" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Sortie des blocs fraîchement moulés</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:6;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Contrôle</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-controle-production.jpg" alt="Équipe COTRAC en contrôle de la ligne de production d'agglos" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Contrôle de la ligne de production</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:7;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Séchage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/usine-sechage-agglos.jpg" alt="Rangées d'agglos en séchage sur l'aire de stockage de l'usine COTRAC" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Séchage sur aire de stockage</span></div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : CONSTRUCTION DE PISTE — KEUR BALA, ZONE SUD
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Construction de Piste — Keur Bala, Zone Sud Sénégal</h2>
      <p class="section-sub">
        COTRAC a réalisé des travaux de piste rurale et de réseau d'eau à Keur Bala, en Casamance : implantation topographique, terrassement à la pelle mécanique, nivellement et enrobage — une prestation complète mobilisant un parc d'engins lourds en zone sud.
      </p>
    </div>

    <div class="demo-galerie-grid" style="margin-top:32px;">

      <div class="galerie-item stagger-item" style="--demo-i:0;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Mobilisation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-livraison-engin.jpg" alt="Livraison d'une pelle mécanique Changlin sur le site de Keur Bala" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Livraison des engins sur site</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:1;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Topographie</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-topographie.jpg" alt="Technicien COTRAC au théodolite pour l'implantation topographique" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Implantation topographique</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:2;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Terrassement</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-terrassement-1.jpg" alt="Pelles mécaniques Changlin et Caterpillar en terrassement" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Terrassement à la pelle mécanique</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:3;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Terrassement</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-terrassement-2.jpg" alt="Niveleuse Changlin en action sur la piste de Keur Bala" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Réglage de la plateforme</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:4;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Réseau d'eau</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-reseau-eau-1.jpg" alt="Équipe COTRAC sur travaux de réseau d'eau à Keur Bala" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Travaux de réseau d'eau associés</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:5;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Réseau d'eau</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-reseau-eau-2.jpg" alt="Pelle Shantui et équipe COTRAC sur canalisations d'eau" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Pose de canalisations</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:6;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Nivellement</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-nivellement.jpg" alt="Niveleuse Changlin nivelant la piste rurale de Keur Bala" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Nivellement de la piste</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:7;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">6 — Enrobage</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/piste-keurbala-enrobage.jpg" alt="Finisseur Bitelli posant l'enrobé sur la piste de Keur Bala" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Pose de l'enrobé au finisseur</span></div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : CHÂTEAU D'EAU SEN'EAU — THIÈS
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Travaux Capitaux d'Eau — Château d'Eau SEN'EAU, Thiès</h2>
      <p class="section-sub">
        COTRAC a réalisé la réhabilitation complète du château d'eau de SEN'EAU à Thiès : traitement de la cuve, peinture technique anticorrosion et fresque décorative aux couleurs de SEN'EAU — un chantier mené en hauteur avec rigueur et finition soignée.
      </p>
    </div>

    <div class="demo-galerie-grid" style="margin-top:32px;">

      <div class="galerie-item stagger-item" style="--demo-i:0;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">1 — Préparation</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-peintre-cotrac.jpg" alt="Technicien COTRAC appliquant la peinture de préparation sur le château d'eau SEN'EAU à Thiès" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Préparation et traçage de la fresque</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:1;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">2 — Peinture en hauteur</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-echafaudage.jpg" alt="Équipe COTRAC sur échafaudage peignant le château d'eau SEN'EAU à Thiès" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Travaux de peinture sur échafaudage</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:2;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Finition</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-peinture-equipe.jpg" alt="Équipe COTRAC finalisant la peinture du château d'eau SEN'EAU à Thiès" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Finition de la cuve</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:3;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">3 — Finition</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-finition-jaune.jpg" alt="Château d'eau SEN'EAU à Thiès en cours de finition peinture jaune" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Application de la teinte jaune SEN'EAU</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:4;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">4 — Fresque</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-fresque-vague.jpg" alt="Fresque de vague bleue peinte sur le château d'eau SEN'EAU à Thiès" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Fresque décorative aux couleurs SEN'EAU</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:5;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Livraison</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-logo-seneau.jpg" alt="Château d'eau SEN'EAU à Thiès terminé avec logo SEN'EAU" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Ouvrage livré avec logo SEN'EAU</span></div>
      </div>

      <div class="galerie-item stagger-item" style="--demo-i:6;" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <span class="galerie-item-step">5 — Livraison</span>
        <img src="<?= SITE_URL ?>/assets/images/btp/reel/chateau-seneau-thies-final.jpg" alt="Château d'eau SEN'EAU à Thiès terminé, vue d'ensemble" loading="lazy">
        <div class="galerie-item-overlay"><span class="demo-galerie-caption">Château d'eau livré, vue d'ensemble</span></div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : CTA
═══════════════════════════════════════════════════════════ -->
<section class="btp-cta-section" style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cta-fond.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container btp-cta-grid">

    <div class="animate-fade-up delay-1">
      <span class="section-tag orange"><?= t('btp_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-top:10px;"><?= t('btp_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        <?= t('btp_cta_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <a href="tel:+221338279639" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','.95rem') ?></span>
          +221 33 827 96 39
        </a>
        <a href="mailto:cotracsenegal@gmail.com" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','.95rem') ?></span>
          cotracsenegal@gmail.com
        </a>
        <!-- Téléchargement plaquette -->
        <a href="<?= SITE_URL ?>/assets/docs/plaquette-btp.pdf" download
           style="display:flex;align-items:center;gap:14px;color:#f7941d;text-decoration:none;font-weight:600;margin-top:6px;">
          <span style="background:rgba(247,148,29,0.15);border:1px solid rgba(247,148,29,0.4);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('file','#f7941d','.95rem') ?></span>
          <?= t('btp_cta_plaquette') ?>
        </a>
      </div>
    </div>

    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#f7941d;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('building','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;"><?= t('btp_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        <?= t('btp_cta_card_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> <?= t('btp_cta_btn_devis') ?>
        </a>
        <a href="<?= SITE_URL ?>/realisations.php?pole=btp" class="btn btn-outline" style="width:100%;justify-content:center;">
          <?= icon('building','','.9rem') ?> <?= t('btp_cta_btn_real') ?>
        </a>
        <a href="<?= SITE_URL ?>/assets/docs/plaquette-btp.pdf" download class="btn" style="width:100%;justify-content:center;background:rgba(255,255,255,0.08);color:#fff;border:1px solid rgba(255,255,255,0.2);">
          <?= icon('file','','.9rem') ?> <?= t('btp_cta_btn_plaquette') ?>
        </a>
      </div>
    </div>

  </div>
  </div>
</section>


<?php require_once 'includes/footer.php'; ?>
