<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = t('btp_page_title') ?: 'Bâtiment & Travaux Publics | COTRAC';
$page_desc  = t('btp_page_desc')  ?: 'COTRAC, expert BTP au Sénégal.';
cms_load('btp');
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO BTP
═══════════════════════════════════════════════════════════ -->
<?php $_btp_hero_bg = cms_bg_url(cms('btp','hero','bg_image','')); ?>
<section class="page-hero" style="<?= $_btp_hero_bg ? 'background-image:url(\''.e($_btp_hero_bg).'\');background-size:cover;background-position:center;' : 'background:linear-gradient(135deg,#0f4d8a 0%,#1a6bb5 100%);' ?>">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
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
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
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
    <div class="section-2col animate-fade-up delay-1" style="margin-bottom:56px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c1 = cms_img_url(cms('btp','services_cards','card1_icon','assets/images/equipe/gilet-cotrac2.jpg')); ?>
        <img src="<?= e($_btp_c1) ?>"
             alt="<?= t('btp_pole1_img_alt') ?>"
             style="width:100%;height:340px;object-fit:cover;object-position:center top;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.14);"
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
    <div class="section-2col animate-fade-up delay-2" style="margin-bottom:56px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c2 = cms_img_url(cms('btp','services_cards','card2_icon','assets/images/equipe/equipe-inspection.jpg')); ?>
        <img src="<?= e($_btp_c2) ?>"
             alt="<?= t('btp_pole2_img_alt') ?>"
             style="width:100%;height:340px;object-fit:cover;object-position:center;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.14);"
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
    <div class="section-2col animate-fade-up delay-1" style="margin-bottom:56px;">
      <!-- Photo gauche -->
      <div>
        <?php $_btp_c3 = cms_img_url(cms('btp','services_cards','card3_icon','assets/images/equipe/ingenieure-plans.jpg')); ?>
        <img src="<?= e($_btp_c3) ?>"
             alt="<?= t('btp_pole3_img_alt') ?>"
             style="width:100%;height:340px;object-fit:cover;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.12);"
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
        <?php $_btp_c4 = cms_img_url(cms('btp','services_cards','card4_icon','assets/images/equipe/equipe-terrain.jpg')); ?>
        <img src="<?= e($_btp_c4) ?>"
             alt="<?= t('btp_pole4_img_alt') ?>"
             style="width:100%;height:340px;object-fit:cover;border-radius:16px;box-shadow:0 8px 32px rgba(0,0,0,0.12);"
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
        <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-terrain.jpg" alt="<?= t('btp_galerie_alt1') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap1') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/equipe/ingenieure-plans.jpg" alt="<?= t('btp_galerie_alt2') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap2') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= SITE_URL ?>/uploads/projets/terrain-chantier.jpg" alt="<?= t('btp_galerie_alt3') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap3') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-1">
        <img src="<?= SITE_URL ?>/uploads/projets/tranchee-cours.jpg" alt="<?= t('btp_galerie_alt4') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap4') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/equipe/gilet-cotrac.jpg" alt="<?= t('btp_galerie_alt5') ?>" loading="lazy">
        <div class="galerie-caption"><?= t('btp_galerie_cap5') ?></div>
      </div>

      <div class="galerie-item animate-fade-up delay-3">
        <img src="<?= SITE_URL ?>/uploads/projets/tranchee-grillage.jpg" alt="<?= t('btp_galerie_alt6') ?>" loading="lazy">
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

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:28px;">

      <!-- Projet 1 -->
      <article class="projet-card animate-fade-up delay-1">
        <div class="projet-img" style="height:200px;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-terrain.jpg" alt="<?= t('btp_proj1_img_alt') ?>" loading="lazy">
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

      <!-- Projet 2 -->
      <article class="projet-card animate-fade-up delay-2">
        <div class="projet-img" style="height:200px;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/gilet-cotrac2.jpg" alt="<?= t('btp_proj2_img_alt') ?>" loading="lazy">
        </div>
        <div class="projet-body" style="padding:24px;">
          <span class="projet-badge"><?= t('btp_real_badge') ?></span>
          <h3 style="font-weight:700;margin:10px 0 8px;font-size:1.05rem;color:var(--bleu);">
            <?= t('btp_proj2_titre') ?>
          </h3>
          <p style="color:var(--gris);font-size:0.92rem;line-height:1.65;">
            <?= t('btp_proj2_desc') ?>
          </p>
          <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap;">
            <span style="background:#e8f5ec;color:#2c7a3e;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj2_tag1') ?></span>
            <span style="background:#e8f5ec;color:#2c7a3e;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj2_tag2') ?></span>
          </div>
        </div>
      </article>

      <!-- Projet 3 -->
      <article class="projet-card animate-fade-up delay-3">
        <div class="projet-img" style="height:200px;">
          <img src="<?= SITE_URL ?>/assets/images/equipe/ingenieure-plans.jpg" alt="<?= t('btp_proj3_img_alt') ?>" loading="lazy">
        </div>
        <div class="projet-body" style="padding:24px;">
          <span class="projet-badge"><?= t('btp_real_badge') ?></span>
          <h3 style="font-weight:700;margin:10px 0 8px;font-size:1.05rem;color:var(--bleu);">
            <?= t('btp_proj3_titre') ?>
          </h3>
          <p style="color:var(--gris);font-size:0.92rem;line-height:1.65;">
            <?= t('btp_proj3_desc') ?>
          </p>
          <div style="display:flex;gap:10px;margin-top:14px;flex-wrap:wrap;">
            <span style="background:#fdf0e6;color:#7f4f24;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj3_tag1') ?></span>
            <span style="background:#fdf0e6;color:#7f4f24;padding:4px 12px;border-radius:20px;font-size:0.82rem;font-weight:600;"><?= t('btp_proj3_tag2') ?></span>
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


<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$galerie_titre  = t('btp_galerie2_titre');
$galerie_photos = [
  ['src'=>'assets/images/equipe/equipe-inspection.jpg',   'alt'=>t('btp_galerie_alt1'),  'caption'=>t('btp_galerie_cap1')],
  ['src'=>'assets/images/equipe/gilet-cotrac2.jpg',       'alt'=>t('btp_galerie_alt2'),  'caption'=>t('btp_galerie_cap2')],
  ['src'=>'assets/images/equipe/ingenieure-plans.jpg',    'alt'=>t('btp_galerie_alt3'),  'caption'=>t('btp_galerie_cap3')],
  ['src'=>'uploads/projets/tranchee-cours.jpg',           'alt'=>t('btp_galerie_alt4'),  'caption'=>t('btp_galerie_cap4')],
  ['src'=>'assets/images/equipe/equipe-terrain.jpg',      'alt'=>t('btp_galerie_alt5'),  'caption'=>t('btp_galerie_cap5')],
  ['src'=>'assets/images/equipe/gilet-cotrac.jpg',        'alt'=>t('btp_galerie_alt6'),  'caption'=>t('btp_galerie_cap6')],
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
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center;">

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
