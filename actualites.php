<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Actualités | COTRAC';
$page_desc  = 'Suivez les dernières actualités de COTRAC - nouveaux projets, partenariats, chantiers en cours et actualités du secteur BTP au Sénégal.';
cms_load('actualites');
require_once 'includes/header.php';

$db = getDB();
$actualites = $db->query("SELECT * FROM actualites WHERE actif=1 ORDER BY created_at DESC")->fetchAll();
?>

<!-- ===================== PAGE HERO ===================== -->
<?php $_actu_hero_bg = cms_bg_url(cms('actualites','hero','bg_image','')); ?>
<section class="page-hero" <?= $_actu_hero_bg ? 'style="background-image:url(\''.e($_actu_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container" style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;">
    <div>
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <span><?= t('actu_breadcrumb_page') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up"><?= cms('actualites','hero','title', t('actu_hero_titre')) ?></h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= t('actu_hero_desc') ?>
      </p>
    </div>
    <!-- Stat cards -->
    <div class="animate-fade-up delay-2" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
      <?php
      $stats = [
        ['val' => count($actualites), 'suf' => '', 'label' => t('actu_stat1_label')],
        ['val' => 10,  'suf' => '+', 'label' => t('actu_stat2_label')],
        ['val' => 25,  'suf' => '+', 'label' => t('actu_stat3_label')],
        ['val' => 4,   'suf' => '',  'label' => t('actu_stat4_label')],
      ];
      foreach ($stats as $s): ?>
      <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:16px;padding:24px 20px;text-align:center;backdrop-filter:blur(6px);">
        <div class="counter" data-target="<?= $s['val'] ?>" data-suffix="<?= $s['suf'] ?>"
             style="font-size:2.4rem;font-weight:800;color:#f08014;line-height:1;">0</div>
        <div style="font-size:.78rem;color:rgba(255,255,255,0.75);margin-top:6px;text-transform:uppercase;letter-spacing:.08em;"><?= e($s['label']) ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ===================== ACTUALITÉS ===================== -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">

    <?php if (empty($actualites)): ?>
      <div style="text-align:center; padding:80px 0;">
        <div style="font-size:3rem; margin-bottom:16px;">📰</div>
        <h3 style="color:var(--gris-dark); margin-bottom:8px;"><?= t('actu_vide_titre') ?></h3>
        <p style="color:var(--gris);"><?= t('actu_vide_desc') ?></p>
        <a href="<?= SITE_URL ?>/index.php" class="btn btn-primary" style="margin-top:24px;"><?= t('actu_vide_btn') ?></a>
      </div>

    <?php else: ?>
      <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(340px,1fr)); gap:28px;">
        <?php foreach ($actualites as $i => $actu):
          $has_img  = !empty($actu['image']) && file_exists(__DIR__ . '/uploads/actualites/' . $actu['image']);
          $date_fmt = date('d F Y', strtotime($actu['created_at']));
          $mois_fr  = ['January'=>'janvier','February'=>'février','March'=>'mars','April'=>'avril',
                       'May'=>'mai','June'=>'juin','July'=>'juillet','August'=>'août',
                       'September'=>'septembre','October'=>'octobre','November'=>'novembre','December'=>'décembre'];
          $date_fmt = strtr($date_fmt, $mois_fr);
        ?>
        <article class="actu-card animate-fade-up" style="transition-delay:<?= ($i % 3) * 100 ?>ms;">
          <!-- Image -->
          <div class="actu-card-img">
            <?php if ($has_img): ?>
              <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($actu['image']) ?>"
                   alt="<?= e($actu['titre']) ?>" loading="lazy">
            <?php else: ?>
              <div class="actu-card-img-placeholder">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
              </div>
            <?php endif; ?>
            <div class="actu-card-date-badge">
              <span><?= e($date_fmt) ?></span>
            </div>
          </div>

          <!-- Contenu -->
          <div class="actu-card-body">
            <h3 class="actu-card-title"><?= e($actu['titre']) ?></h3>
            <?php if (!empty($actu['contenu'])): ?>
              <p class="actu-card-excerpt">
                <?= e(mb_strimwidth(strip_tags($actu['contenu']), 0, 160, '…')) ?>
              </p>
            <?php endif; ?>
            <div class="actu-card-footer">
              <span class="actu-card-tag">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <?= e($date_fmt) ?>
              </span>
              <span class="actu-card-cotrac">COTRAC</span>
            </div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="stats-section">
  <div class="container">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center;">

      <!-- Gauche : contact -->
      <div>
        <span class="section-tag" style="color:rgba(255,255,255,.7); border-color:rgba(255,255,255,.2); background:rgba(255,255,255,.08);"><?= t('actu_cta_tag') ?></span>
        <h2 style="font-size:2rem; font-weight:800; color:#fff; margin:16px 0 12px;"><?= t('actu_cta_titre') ?></h2>
        <p style="color:rgba(255,255,255,.75); margin-bottom:28px;"><?= t('actu_cta_desc') ?></p>
        <div style="display:flex; flex-direction:column; gap:12px;">
          <a href="tel:+221338279639" style="display:inline-flex;align-items:center;gap:10px;color:#fff;font-weight:600;font-size:.95rem;">
            <span style="width:36px;height:36px;background:var(--orange);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','1rem') ?></span>
            +221 33 827 96 39
          </a>
          <a href="mailto:cotracsenegal@gmail.com" style="display:inline-flex;align-items:center;gap:10px;color:#fff;font-weight:600;font-size:.95rem;">
            <span style="width:36px;height:36px;background:var(--orange);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','1rem') ?></span>
            cotracsenegal@gmail.com
          </a>
        </div>
      </div>

      <!-- Droite : carte action -->
      <div style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px;backdrop-filter:blur(8px);text-align:center;">
        <div style="width:64px;height:64px;background:var(--orange);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;"><?= icon('mail','','2rem') ?></div>
        <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:8px;"><?= t('actu_cta_card_titre') ?></h3>
        <p style="color:rgba(255,255,255,.65);font-size:.88rem;margin-bottom:24px;"><?= t('actu_cta_card_desc') ?></p>
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-orange" style="width:100%;justify-content:center;"><?= t('actu_cta_btn') ?></a>
      </div>

    </div>
  </div>
</section>

<style>
/* ---- Cartes actualités ---- */
.actu-card {
  background: #fff;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 2px 16px rgba(0,0,0,.06);
  transition: transform .25s, box-shadow .25s;
  display: flex;
  flex-direction: column;
}
.actu-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 40px rgba(26,107,181,.13);
}
.actu-card-img {
  position: relative;
  height: 200px;
  overflow: hidden;
  background: linear-gradient(135deg, #e8f1fb, #d4e6f7);
}
.actu-card-img img {
  width: 100%; height: 100%; object-fit: cover;
  transition: transform .4s ease;
}
.actu-card:hover .actu-card-img img { transform: scale(1.04); }
.actu-card-img-placeholder {
  width: 100%; height: 100%;
  display: flex; align-items: center; justify-content: center;
  color: var(--bleu);
  opacity: .35;
}
.actu-card-date-badge {
  position: absolute; bottom: 0; left: 0; right: 0;
  background: linear-gradient(to top, rgba(10,22,40,.7), transparent);
  padding: 20px 16px 10px;
}
.actu-card-date-badge span {
  font-size: .72rem; color: rgba(255,255,255,.85);
  font-weight: 500; text-transform: capitalize;
}
.actu-card-body {
  padding: 20px 20px 16px;
  display: flex; flex-direction: column; flex: 1;
}
.actu-card-title {
  font-size: 1rem; font-weight: 700; color: var(--texte);
  line-height: 1.4; margin-bottom: 10px;
}
.actu-card-excerpt {
  font-size: .87rem; color: var(--gris);
  line-height: 1.6; flex: 1; margin-bottom: 16px;
}
.actu-card-footer {
  display: flex; align-items: center; justify-content: space-between;
  padding-top: 12px;
  border-top: 1px solid var(--border);
}
.actu-card-tag {
  display: flex; align-items: center; gap: 5px;
  font-size: .75rem; color: var(--gris);
}
.actu-card-cotrac {
  font-size: .72rem; font-weight: 700;
  color: var(--bleu); letter-spacing: .06em;
  text-transform: uppercase;
  background: var(--bleu-light);
  padding: 3px 10px; border-radius: 20px;
}

@media (max-width: 768px) {
  .actu-card-img { height: 160px; }
}
</style>

<?php require_once 'includes/footer.php'; ?>
