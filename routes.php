<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = t('routes_page_title') ?: 'Routes, Pistes & Ouvrages d\'Art | COTRAC';
$page_desc  = t('routes_page_desc')  ?: 'COTRAC, référence sénégalaise en construction routière.';
cms_load('routes');
require_once 'includes/header.php';
?>

<style>
.specs-table { width:100%; border-collapse:collapse; margin:24px 0; }
.specs-table th { background:var(--bleu); color:#fff; padding:12px 16px; text-align:left; font-size:0.88rem; }
.specs-table td { padding:12px 16px; border-bottom:1px solid var(--border); font-size:0.9rem; color:var(--texte); }
.specs-table tr:nth-child(even) td { background:var(--gris-clair); }
</style>


<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO ROUTES
═══════════════════════════════════════════════════════════ -->
<?php $_routes_hero_bg = cms_bg_url(cms('routes','hero','bg_image','')); ?>
<section class="page-hero" style="<?= $_routes_hero_bg ? 'background-image:url(\''.e($_routes_hero_bg).'\');background-size:cover;background-position:center;' : 'background:linear-gradient(135deg,#7f4f24 0%,#1a6bb5 100%);' ?>">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('breadcrumb_accueil') ?></a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles"><?= t('breadcrumb_poles') ?></a>
        <span class="sep">›</span>
        <span><?= t('routes_breadcrumb_current') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('routes','hero','title', t('routes_hero_titre')) ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('routes','hero','subtitle', t('routes_hero_desc')) ?>
      </p>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">14</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('routes_stat_regions') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">15+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('routes_stat_annees') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">4</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('routes_stat_voirie') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;"><?= t('routes_stat_agree') ?></div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">AGEROUTE</div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS SERVICES ROUTES
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('routes_services_tag') ?></span>
      <h2 class="section-title"><?= t('routes_services_titre') ?></h2>
      <p class="section-sub">
        <?= t('routes_services_desc') ?>
      </p>
    </div>

    <ul class="services-list">

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('target', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s1_titre') ?></h3>
          <p><?= t('routes_s1_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('arrow-right', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s2_titre') ?></h3>
          <p><?= t('routes_s2_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('building', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s3_titre') ?></h3>
          <p><?= t('routes_s3_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('star', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s4_titre') ?></h3>
          <p><?= t('routes_s4_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('map-pin', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s5_titre') ?></h3>
          <p><?= t('routes_s5_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('wrench', '', '1.6rem') ?></div>
        <div class="service-body">
          <h3><?= t('routes_s6_titre') ?></h3>
          <p><?= t('routes_s6_desc') ?></p>
        </div>
      </li>

    </ul>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : SPÉCIFICITÉS TECHNIQUES
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
    <div class="animate-fade-up delay-1">
      <span class="section-tag"><?= t('routes_tech_tag') ?></span>
      <h2 class="section-title" style="text-align:left;margin-top:12px;"><?= t('routes_tech_titre') ?></h2>
      <p style="color:var(--gris);margin-bottom:24px;line-height:1.7;"><?= t('routes_tech_desc') ?></p>
      <table class="specs-table">
        <thead>
          <tr>
            <th><?= t('routes_table_type') ?></th>
            <th><?= t('routes_table_revetement') ?></th>
            <th><?= t('routes_table_capacite') ?></th>
          </tr>
        </thead>
        <tbody>
          <tr><td><?= t('routes_table_r1c1') ?></td><td>Enrobé EB10/EB14</td><td>13 t/essieu</td></tr>
          <tr><td><?= t('routes_table_r2c1') ?></td><td>Enrobé mince / pavés</td><td>8 t/essieu</td></tr>
          <tr><td><?= t('routes_table_r3c1') ?></td><td>Latérite stabilisée</td><td>6 t/essieu</td></tr>
          <tr><td><?= t('routes_table_r4c1') ?></td><td>Latérite compactée</td><td>3,5 t/essieu</td></tr>
          <tr><td><?= t('routes_table_r5c1') ?></td><td>Béton armé (BCA)</td><td>25 t/essieu</td></tr>
          <tr><td><?= t('routes_table_r6c1') ?></td><td>Béton précontraint</td><td>Classe A/B</td></tr>
        </tbody>
      </table>
    </div>
    <div class="animate-fade-up delay-2">
      <?php $_routes_main = cms_img_url(cms('routes','services_cards','card1_icon','uploads/projets/terrain-chantier.jpg')); ?>
      <img src="<?= e($_routes_main) ?>"
           alt="<?= t('routes_img_alt') ?>"
           style="width:100%;height:420px;object-fit:cover;border-radius:20px;box-shadow:0 12px 40px rgba(0,0,0,0.15);">
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px;">
        <div style="background:var(--bleu);color:#fff;border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:1.4rem;font-weight:800;">14</div>
          <div style="font-size:.68rem;opacity:.85;text-transform:uppercase;letter-spacing:.06em;"><?= t('routes_mini_regions') ?></div>
        </div>
        <div style="background:#7f4f24;color:#fff;border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:1.4rem;font-weight:800;">15+</div>
          <div style="font-size:.68rem;opacity:.85;text-transform:uppercase;letter-spacing:.06em;"><?= t('routes_mini_annees') ?></div>
        </div>
        <div style="background:#27ae60;color:#fff;border-radius:12px;padding:16px;text-align:center;">
          <div style="font-size:1.4rem;font-weight:800;">100%</div>
          <div style="font-size:.68rem;opacity:.85;text-transform:uppercase;letter-spacing:.06em;"><?= t('routes_mini_livraisons') ?></div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : 4 ATOUTS DIFFÉRENCIANTS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('routes_atouts_tag') ?></span>
      <h2 class="section-title"><?= t('routes_atouts_titre') ?></h2>
      <p class="section-sub">
        <?= t('routes_atouts_desc') ?>
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:28px;">

      <div class="valeur-card animate-fade-up delay-1" style="padding:36px 28px;display:flex;gap:22px;align-items:flex-start;">
        <div style="min-width:64px;height:64px;background:linear-gradient(135deg,#1a6bb5,#2589d8);border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;">
          <?= icon('target', '', '1.8rem') ?>
        </div>
        <div>
          <h3 style="color:#1a6bb5;font-size:1.15rem;font-weight:700;margin-bottom:10px;"><?= t('routes_atout1_titre') ?></h3>
          <p style="color:var(--gris);line-height:1.75;font-size:0.95rem;">
            <?= t('routes_atout1_desc') ?>
          </p>
        </div>
      </div>

      <div class="valeur-card animate-fade-up delay-2" style="padding:36px 28px;display:flex;gap:22px;align-items:flex-start;">
        <div style="min-width:64px;height:64px;background:linear-gradient(135deg,#7f4f24,#c87941);border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;">
          <?= icon('users', '', '1.8rem') ?>
        </div>
        <div>
          <h3 style="color:#7f4f24;font-size:1.15rem;font-weight:700;margin-bottom:10px;"><?= t('routes_atout2_titre') ?></h3>
          <p style="color:var(--gris);line-height:1.75;font-size:0.95rem;">
            <?= t('routes_atout2_desc') ?>
          </p>
        </div>
      </div>

      <div class="valeur-card animate-fade-up delay-3" style="padding:36px 28px;display:flex;gap:22px;align-items:flex-start;">
        <div style="min-width:64px;height:64px;background:linear-gradient(135deg,#2c7a3e,#1a9e4e);border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;">
          <?= icon('check', '', '1.8rem') ?>
        </div>
        <div>
          <h3 style="color:#2c7a3e;font-size:1.15rem;font-weight:700;margin-bottom:10px;"><?= t('routes_atout3_titre') ?></h3>
          <p style="color:var(--gris);line-height:1.75;font-size:0.95rem;">
            <?= t('routes_atout3_desc') ?>
          </p>
        </div>
      </div>

      <div class="valeur-card animate-fade-up delay-1" style="padding:36px 28px;display:flex;gap:22px;align-items:flex-start;">
        <div style="min-width:64px;height:64px;background:linear-gradient(135deg,#0f4d8a,#1a6bb5);border-radius:14px;display:flex;align-items:center;justify-content:center;color:#fff;">
          <?= icon('star', '', '1.8rem') ?>
        </div>
        <div>
          <h3 style="color:#0f4d8a;font-size:1.15rem;font-weight:700;margin-bottom:10px;"><?= t('routes_atout4_titre') ?></h3>
          <p style="color:var(--gris);line-height:1.75;font-size:0.95rem;">
            <?= t('routes_atout4_desc') ?>
          </p>
        </div>
      </div>

    </div>
  </div>
</section>


<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$galerie_titre  = t('routes_galerie_titre');
$galerie_photos = [
  ['src'=>'uploads/projets/terrain-chantier.jpg',             'alt'=>t('routes_img_alt'),          'caption'=>t('routes_s1_titre')],
  ['src'=>'assets/images/energie/tranchee-chantier.jpg',     'alt'=>t('routes_table_r2c1'),        'caption'=>t('routes_s6_titre')],
  ['src'=>'assets/images/energie/tranchee-chantier2.jpg',    'alt'=>t('routes_table_r3c1'),        'caption'=>t('routes_s6_titre')],
  ['src'=>'assets/images/energie/tranchee-fourreaux.jpg',    'alt'=>t('routes_table_r4c1'),        'caption'=>t('routes_s6_titre')],
  ['src'=>'assets/images/equipe/equipe-inspection.jpg',      'alt'=>t('routes_atout2_titre'),      'caption'=>t('routes_tech_titre')],
  ['src'=>'assets/images/energie/plan-reseau.jpg',           'alt'=>t('routes_s5_titre'),          'caption'=>t('routes_s5_titre')],
];
require 'includes/galerie.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     SECTION : CTA
═══════════════════════════════════════════════════════════ -->
<section class="stats-section" style="padding:64px 0;">
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;">
    <div>
      <span class="section-tag orange" style="margin-bottom:20px;display:inline-block;"><?= t('routes_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-bottom:16px;"><?= t('routes_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.75);font-size:.95rem;line-height:1.8;margin-bottom:32px;">
        <?= t('routes_cta_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:16px;">
        <div style="display:flex;align-items:center;gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','1.1rem') ?></div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('routes_cta_tel_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">+221 33 827 96 39 &nbsp;|&nbsp; +221 77 630 16 46</div>
          </div>
        </div>
        <div style="display:flex;align-items:center;gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','1.1rem') ?></div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('routes_cta_email_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">cotracsenegal@gmail.com</div>
          </div>
        </div>
      </div>
    </div>
    <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.13);border-radius:20px;padding:44px 36px;text-align:center;backdrop-filter:blur(8px);">
      <div style="width:64px;height:64px;background:rgba(240,128,20,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;"><?= icon('map-pin','','1.8rem') ?></div>
      <h3 style="color:#fff;font-size:1.3rem;font-weight:700;margin-bottom:12px;"><?= t('routes_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.65);font-size:.88rem;line-height:1.7;margin-bottom:28px;">
        <?= t('routes_cta_card_desc') ?>
      </p>
      <a href="<?= SITE_URL ?>/realisations.php?pole=routes" class="btn btn-primary" style="width:100%;display:block;text-align:center;margin-bottom:12px;">
        <?= t('routes_cta_btn_real') ?>
      </a>
      <a href="<?= SITE_URL ?>/contact.php" class="btn btn-outline" style="width:100%;display:block;text-align:center;margin-bottom:12px;">
        <?= t('routes_cta_btn_devis') ?>
      </a>
      <a href="<?= SITE_URL ?>/assets/docs/plaquette-routes.pdf" download
         style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.85);text-decoration:none;font-size:.88rem;font-weight:600;transition:.2s;">
        <?= icon('file','','.9rem') ?> <?= t('routes_cta_btn_plaquette') ?>
      </a>
    </div>
  </div>
</section>


<?php require_once 'includes/footer.php'; ?>
