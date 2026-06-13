<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Génie Industriel, VMC & Isolation Thermique | COTRAC';
$page_desc  = 'COTRAC réalise vos installations industrielles au Sénégal : calorifugeage, isolation cryogénique, VMC, chambres froides, charpente métallique, tuyauterie HP et faux plafonds techniques.';
cms_load('industrie');
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
═══════════════════════════════════════════════════════════ -->
<?php $_industrie_hero_bg = cms_bg_url(cms('industrie','hero','bg_image','')); ?>
<section class="page-hero" <?= $_industrie_hero_bg ? 'style="background-image:url(\''.e($_industrie_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles"><?= t('industrie_breadcrumb_poles') ?></a>
        <span class="sep">›</span>
        <span><?= t('industrie_breadcrumb_page') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('industrie','hero','title', t('industrie_hero_titre')) ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('industrie','hero','subtitle', t('industrie_hero_desc')) ?>
      </p>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">10+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('industrie_stat1_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">1T/j</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('industrie_stat2_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">-40°C</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('industrie_stat3_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:1.5rem;font-weight:800;color:#f7941d;line-height:1;"><?= t('industrie_stat4_val') ?></div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('industrie_stat4_label') ?></div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : DOMAINES INDUSTRIELS
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('industrie_tag_domaines') ?></span>
      <h2 class="section-title"><?= t('industrie_titre_domaines') ?></h2>
      <p class="section-sub">
        <?= t('industrie_desc_domaines') ?>
      </p>
    </div>

    <ul class="services-list">

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><span class="ico ico-industrie"><!--industrie--></span></div>
        <div class="service-body">
          <h3><?= t('industrie_s1_titre') ?></h3>
          <p><?= t('industrie_s1_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('wrench','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s2_titre') ?></h3>
          <p><?= t('industrie_s2_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('zap','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s3_titre') ?></h3>
          <p><?= t('industrie_s3_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('shield','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s4_titre') ?></h3>
          <p><?= t('industrie_s4_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('globe','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s5_titre') ?></h3>
          <p><?= t('industrie_s5_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('star','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s6_titre') ?></h3>
          <p><?= t('industrie_s6_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('check','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s7_titre') ?></h3>
          <p><?= t('industrie_s7_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><span class="ico ico-btp"><!--btp--></span></div>
        <div class="service-body">
          <h3><?= t('industrie_s8_titre') ?></h3>
          <p><?= t('industrie_s8_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('target','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s9_titre') ?></h3>
          <p><?= t('industrie_s9_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('briefcase','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s10_titre') ?></h3>
          <p><?= t('industrie_s10_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('users','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s11_titre') ?></h3>
          <p><?= t('industrie_s11_desc') ?></p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('map-pin','','1.4rem') ?></div>
        <div class="service-body">
          <h3><?= t('industrie_s12_titre') ?></h3>
          <p><?= t('industrie_s12_desc') ?></p>
        </div>
      </li>

    </ul>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : ÉQUIPEMENTS INDUSTRIELS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag"><?= t('industrie_tag_equip') ?></span>
      <h2 class="section-title"><?= t('industrie_titre_equip') ?></h2>
      <p class="section-sub">
        <?= t('industrie_desc_equip') ?>
      </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">

      <?php
      $equipements = [
          [
              'icon'  => '<span class="ico ico-energie"><!--energie--></span>',
              'titre' => t('industrie_equip1_titre'),
              'items' => [
                  t('industrie_equip1_i1'),
                  t('industrie_equip1_i2'),
                  t('industrie_equip1_i3'),
                  t('industrie_equip1_i4'),
              ],
          ],
          [
              'icon'  => icon('briefcase','','1.6rem'),
              'titre' => t('industrie_equip2_titre'),
              'items' => [
                  t('industrie_equip2_i1'),
                  t('industrie_equip2_i2'),
                  t('industrie_equip2_i3'),
                  t('industrie_equip2_i4'),
              ],
          ],
          [
              'icon'  => '<span class="ico ico-poste"><!--poste--></span>',
              'titre' => t('industrie_equip3_titre'),
              'items' => [
                  t('industrie_equip3_i1'),
                  t('industrie_equip3_i2'),
                  t('industrie_equip3_i3'),
                  t('industrie_equip3_i4'),
              ],
          ],
          [
              'icon'  => '<span class="ico ico-btp"><!--btp--></span>',
              'titre' => t('industrie_equip4_titre'),
              'items' => [
                  t('industrie_equip4_i1'),
                  t('industrie_equip4_i2'),
                  t('industrie_equip4_i3'),
                  t('industrie_equip4_i4'),
              ],
          ],
          [
              'icon'  => icon('zap','','1.6rem'),
              'titre' => t('industrie_equip5_titre'),
              'items' => [
                  t('industrie_equip5_i1'),
                  t('industrie_equip5_i2'),
                  t('industrie_equip5_i3'),
                  t('industrie_equip5_i4'),
              ],
          ],
          [
              'icon'  => icon('target','','1.6rem'),
              'titre' => t('industrie_equip6_titre'),
              'items' => [
                  t('industrie_equip6_i1'),
                  t('industrie_equip6_i2'),
                  t('industrie_equip6_i3'),
                  t('industrie_equip6_i4'),
              ],
          ],
      ];
      foreach ($equipements as $i => $eq):
        $delay = ($i % 3) + 1;
      ?>
      <div class="valeur-card animate-fade-up delay-<?= $delay ?>" style="padding:28px 24px;">
        <div style="font-size:2rem;margin-bottom:14px;"><?= $eq['icon'] ?></div>
        <h4 style="color:#1a6bb5;font-weight:700;font-size:1.05rem;margin-bottom:14px;"><?= e($eq['titre']) ?></h4>
        <ul style="list-style:none;padding:0;margin:0;">
          <?php foreach ($eq['items'] as $item): ?>
          <li style="color:var(--gris);font-size:0.91rem;line-height:1.65;padding:4px 0;border-bottom:1px solid #f0f0f0;display:flex;gap:8px;align-items:baseline;">
            <span style="color:#f7941d;font-weight:700;flex-shrink:0;">›</span>
            <?= e($item) ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : STATS INDUSTRIE
═══════════════════════════════════════════════════════════ -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">

      <div class="stat-item animate-fade-up delay-1">
        <span class="number">10<span class="plus">+</span></span>
        <span class="stat-label"><?= t('industrie_stats1_label') ?></span>
      </div>

      <div class="stat-item animate-fade-up delay-2">
        <span class="number">1T<span class="plus">/j</span></span>
        <span class="stat-label"><?= t('industrie_stats2_label') ?></span>
      </div>

      <div class="stat-item animate-fade-up delay-3">
        <span class="number">-40°C</span>
        <span class="stat-label"><?= t('industrie_stats3_label') ?></span>
      </div>

      <div class="stat-item animate-fade-up delay-4">
        <span class="number" style="font-size:1.8rem;"><?= t('industrie_stats4_val') ?></span>
        <span class="stat-label"><?= t('industrie_stats4_label') ?></span>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : PHOTO CHANTIER INDUSTRIEL
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;align-items:center;">
      <div class="animate-fade-up delay-1">
        <span class="section-tag"><?= t('industrie_tag_terrain') ?></span>
        <h2 class="section-title" style="font-size:1.8rem;"><?= t('industrie_terrain_titre') ?></h2>
        <p style="color:var(--gris);line-height:1.8;margin-bottom:20px;">
          <?= t('industrie_terrain_desc') ?>
        </p>
        <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:10px;">
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> <?= t('industrie_terrain_check1') ?>
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> <?= t('industrie_terrain_check2') ?>
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> <?= t('industrie_terrain_check3') ?>
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> <?= t('industrie_terrain_check4') ?>
          </li>
        </ul>
      </div>
      <div class="animate-fade-up delay-2">
        <?php $_ind_main = cms_img_url(cms('industrie','services_cards','card1_icon','assets/images/industrie/genie-industriel-chantier.jpg')); ?>
        <img src="<?= e($_ind_main) ?>"
             alt="<?= t('industrie_terrain_img_alt') ?>"
             loading="lazy"
             style="width:100%;border-radius:16px;box-shadow:0 12px 48px rgba(0,0,0,0.18);object-fit:cover;max-height:420px;">
      </div>
    </div>
  </div>
</section>


<?php
$galerie_titre  = t('industrie_galerie_titre');
$galerie_photos = [
  ['src'=>'assets/images/industrie/genie-industriel-chantier.jpg', 'alt'=>'Chantier génie industriel',      'caption'=>'Génie industriel - tuyauterie'],
  ['src'=>'assets/images/energie/support-mesure.jpg',              'alt'=>'Mesures et contrôle technique',  'caption'=>'Contrôle & mesure sur site'],
  ['src'=>'assets/images/energie/raccordement-cable.jpg',          'alt'=>'Raccordement technique',         'caption'=>'Raccordement électrique industriel'],
  ['src'=>'assets/images/energie/tetes-cable-hta.jpg',            'alt'=>'Têtes de câble HTA',             'caption'=>'Installation têtes de câble'],
  ['src'=>'assets/images/equipe/ingenieure-plans.jpg',             'alt'=>'Ingénieure sur plans industriels','caption'=>'Conception et étude technique'],
  ['src'=>'assets/images/energie/pose-poteau-mesure.jpg',         'alt'=>'Mesure sur pylône',              'caption'=>'Instrumentation et mesure'],
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

    <!-- Gauche : contact info -->
    <div class="animate-fade-up delay-1">
      <span class="section-tag orange"><?= t('industrie_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-top:10px;"><?= t('industrie_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        <?= t('industrie_cta_desc') ?>
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
        <div style="display:flex;align-items:center;gap:14px;color:rgba(255,255,255,0.72);font-weight:500;">
          <span style="background:rgba(255,255,255,0.12);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('map-pin','','.95rem') ?></span>
          <?= t('industrie_cta_adresse') ?>
        </div>
      </div>
    </div>

    <!-- Droite : carte action -->
    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#f7941d;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('briefcase','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;"><?= t('industrie_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        <?= t('industrie_cta_card_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> <?= t('industrie_cta_btn_devis') ?>
        </a>
        <a href="<?= SITE_URL ?>/realisations.php?pole=industrie" class="btn btn-outline" style="width:100%;justify-content:center;">
          <?= icon('briefcase','','.9rem') ?> <?= t('industrie_cta_btn_real') ?>
        </a>
        <a href="<?= SITE_URL ?>/assets/docs/plaquette-industrie.pdf" download
           style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.85);text-decoration:none;font-size:.88rem;font-weight:600;">
          <?= icon('file','','.9rem') ?> <?= t('industrie_cta_btn_plaquette') ?>
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;"><?= t('industrie_cta_delai_val') ?></div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('industrie_cta_delai_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;"><?= t('industrie_cta_gratuit_val') ?></div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('industrie_cta_gratuit_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">10+</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('industrie_cta_ans_label') ?></div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>


<?php require_once 'includes/footer.php'; ?>
