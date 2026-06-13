<?php
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
$page_title = 'À propos – COTRAC';
$page_desc  = 'Découvrez l\'histoire, la mission et les valeurs de COTRAC, entreprise sénégalaise de BTP et de travaux spécialisés depuis 2015.';
require_once __DIR__ . '/includes/header.php';
?>

<style>
/* ── Page Hero ── */
.page-hero {
  background: linear-gradient(135deg, #0f4880 0%, var(--bleu) 60%, #1e7ed4 100%);
  padding: 5rem 0 4rem;
  color: #fff;
}
.page-hero .breadcrumb {
  display: flex;
  gap: .5rem;
  font-size: .85rem;
  opacity: .75;
  margin-bottom: 1.2rem;
}
.page-hero .breadcrumb a { color: #fff; text-decoration: none; }
.page-hero .breadcrumb span { opacity: .6; }
.page-hero-title { font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; margin: 0 0 1rem; line-height: 1.2; }
.page-hero-title span { color: var(--orange); }
.page-hero-desc { opacity: .85; font-size: 1.05rem; line-height: 1.7; }
@media (max-width: 900px) {
  .page-hero .container[style*="grid-template-columns"] {
    grid-template-columns: 1fr !important;
    gap: 32px !important;
  }
}

/* ── Stats section ── */
.stats-section {
  background: var(--bleu);
  color: #fff;
  padding: 4rem 0;
}
.stats-section .section-tag { color: #fff; border-color: rgba(255,255,255,.6); background: rgba(255,255,255,.15); }
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
  gap: 2rem;
  margin-top: 2.5rem;
  text-align: center;
}
.stat-card { padding: 1.5rem; }
.stat-value { font-size: 2.8rem; font-weight: 800; color: var(--orange); display: block; }
.stat-label { font-size: .95rem; opacity: .85; margin-top: .4rem; }

/* ── Timeline ── */
.timeline-section { padding: 5rem 0; background: var(--gris-clair); }
.timeline { position: relative; max-width: 860px; margin: 3rem auto 0; }
.timeline::before {
  content: '';
  position: absolute;
  left: 50%;
  top: 0; bottom: 0;
  width: 3px;
  background: var(--bleu);
  transform: translateX(-50%);
}
.tl-item {
  display: flex;
  justify-content: flex-end;
  padding-right: calc(50% + 2.5rem);
  margin-bottom: 2.5rem;
  position: relative;
}
.tl-item:nth-child(even) {
  justify-content: flex-start;
  padding-right: 0;
  padding-left: calc(50% + 2.5rem);
}
.tl-dot {
  position: absolute;
  left: 50%;
  top: 1rem;
  transform: translate(-50%, -50%);
  width: 18px; height: 18px;
  background: var(--orange);
  border-radius: 50%;
  border: 3px solid #fff;
  box-shadow: 0 0 0 3px var(--bleu);
}
.tl-box {
  background: #fff;
  border-radius: 12px;
  padding: 1.2rem 1.4rem;
  box-shadow: 0 4px 16px rgba(0,0,0,.08);
  max-width: 320px;
}
.tl-year { font-size: .8rem; font-weight: 700; color: var(--bleu); text-transform: uppercase; letter-spacing: .08em; }
.tl-title { font-size: 1rem; font-weight: 700; margin: .3rem 0 .4rem; color: var(--texte); }
.tl-desc { font-size: .9rem; color: #6b7280; line-height: 1.6; }

@media (max-width: 640px) {
  .timeline::before { left: 14px; }
  .tl-item, .tl-item:nth-child(even) {
    justify-content: flex-start;
    padding-left: 3rem;
    padding-right: 0;
  }
  .tl-dot { left: 14px; }
  .tl-box { max-width: 100%; }
}

/* ── Équipe ── */
.equipe-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 2rem;
  margin-top: 2.5rem;
}
.equipe-card {
  background: #fff;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0,0,0,.08);
  transition: transform .25s;
}
.equipe-card:hover { transform: translateY(-6px); }
.equipe-card img { width: 100%; height: 220px; object-fit: cover; }
.equipe-info { padding: 1.2rem 1.4rem; }
.equipe-name { font-size: 1.05rem; font-weight: 700; color: var(--texte); }
.equipe-role { font-size: .88rem; color: var(--bleu); margin-top: .25rem; }
.equipe-bio { font-size: .88rem; color: #6b7280; margin-top: .5rem; line-height: 1.6; }

/* ── Valeurs ── */
.valeurs-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-top: 2.5rem;
}
.valeur-card {
  background: #fff;
  border-radius: 14px;
  padding: 2rem 1.5rem;
  text-align: center;
  box-shadow: 0 4px 16px rgba(0,0,0,.06);
  border-top: 4px solid var(--bleu);
  transition: transform .25s, box-shadow .25s;
}
.valeur-card:hover { transform: translateY(-4px); box-shadow: 0 8px 28px rgba(0,0,0,.1); }
.valeur-icon {
  width: 52px; height: 52px;
  background: var(--gris-clair);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1rem;
  color: var(--bleu);
}
.valeur-title { font-size: 1rem; font-weight: 700; color: var(--texte); margin-bottom: .5rem; }
.valeur-desc { font-size: .88rem; color: #6b7280; line-height: 1.6; }

/* ── Section 2col ── */
.section-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
.section-2col img { width: 100%; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,.12); }
.section-2col .col-text p { color: #6b7280; line-height: 1.8; margin-bottom: 1rem; }
@media (max-width: 768px) {
  .section-2col { grid-template-columns: 1fr; gap: 2rem; }
}
</style>

<!-- ══ HERO ══ -->
<?php $_apropos_hero_bg = cms_bg_url(cms('a-propos','hero','bg_image','')); ?>
<section class="page-hero" <?= $_apropos_hero_bg ? 'style="background-image:url(\''.e($_apropos_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;">
    <div>
      <nav class="breadcrumb" aria-label="<?= t('apropos_aria_bc') ?>">
        <a href="<?= SITE_URL ?>/index.php"><?= t('apropos_bc_accueil') ?></a>
        <span>›</span>
        <span><?= t('apropos_bc_page') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up"><?= t('apropos_hero_titre') ?></h1>
      <p class="page-hero-desc animate-fade-up" style="margin:0;text-align:left;">
        <?= t('apropos_hero_desc') ?>
      </p>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">10+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('apropos_hero_stat_ans') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">25+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('apropos_hero_stat_projets') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">4</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('apropos_hero_stat_poles') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">14</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;"><?= t('apropos_hero_stat_regions') ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ══ HISTOIRE ══ -->
<section class="section">
  <div class="container">
    <div class="section-2col">
      <div class="col-text animate-fade-up">
        <span class="section-tag"><?= icon('building') ?> <?= t('apropos_hist_tag') ?></span>
        <h2 class="section-title"><?= t('apropos_hist_titre') ?></h2>
        <p><?= t('apropos_hist_p1') ?></p>
        <p><?= t('apropos_hist_p2') ?></p>
        <p><?= t('apropos_hist_p3') ?></p>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary" style="margin-top:1rem;">
          <?= icon('arrow-right') ?> <?= t('apropos_hist_btn') ?>
        </a>
      </div>
      <div class="col-img animate-fade-up">
        <?php $_apropos_equipe = cms_img_url(cms('a-propos','equipe_img','image_path','assets/images/equipe/ingenieure-plans.jpg')); ?>
        <img src="<?= e($_apropos_equipe) ?>" alt="<?= t('img_alt_ingenieure_plans2') ?>">
      </div>
    </div>
  </div>
</section>

<!-- ══ MISSION & VISION ══ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">
    <div class="mv-grid">

      <div class="mv-card mv-card--mission animate-fade-up">
        <div class="mv-icon"><?= icon('target', '', '1.6rem') ?></div>
        <h3><?= t('apropos_mission_titre') ?></h3>
        <p><?= t('apropos_mission_desc') ?></p>
      </div>

      <div class="mv-card mv-card--vision animate-fade-up">
        <div class="mv-icon"><?= icon('globe', '', '1.6rem') ?></div>
        <h3><?= t('apropos_vision_titre') ?></h3>
        <p><?= t('apropos_vision_desc') ?></p>
      </div>

      <div class="mv-card mv-card--engagement animate-fade-up">
        <div class="mv-icon"><?= icon('handshake', '', '1.6rem') ?></div>
        <h3><?= t('apropos_engagement_titre') ?></h3>
        <p><?= t('apropos_engagement_desc') ?></p>
      </div>

    </div>
  </div>
</section>

<style>
.mv-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 0;
}
.mv-card {
  background: #fff;
  border-radius: 18px;
  padding: 36px 28px;
  border: 1px solid var(--border);
  box-shadow: 0 2px 12px rgba(26,107,181,0.05);
  position: relative;
  overflow: hidden;
}
.mv-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 4px;
}
.mv-card--mission::before { background: var(--bleu); }
.mv-card--vision::before  { background: var(--orange); }
.mv-card--engagement::before { background: #27ae60; }
.mv-icon {
  width: 56px; height: 56px;
  border-radius: 14px;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 20px;
  color: var(--bleu);
}
.mv-card--mission .mv-icon { background: var(--bleu-light); color: var(--bleu); }
.mv-card--vision  .mv-icon { background: #fff3e0; color: var(--orange); }
.mv-card--engagement .mv-icon { background: #e8f5e9; color: #27ae60; }
.mv-card h3 {
  font-size: 1.15rem; font-weight: 700; color: var(--texte);
  margin-bottom: 14px; font-family: 'Poppins', sans-serif;
}
.mv-card p { font-size: 0.92rem; color: #4b5563; line-height: 1.8; }
@media (max-width: 900px) { .mv-grid { grid-template-columns: 1fr; } }
@media (min-width: 901px) and (max-width: 1100px) { .mv-grid { grid-template-columns: 1fr 1fr; } }
</style>

<!-- ══ CHIFFRES CLÉS ══ -->
<section class="stats-section">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 380px;gap:48px;align-items:center;">
      <div style="text-align:center;">
        <span class="section-tag"><?= icon('star') ?> <?= t('apropos_stats_tag') ?></span>
        <h2 class="section-title" style="color:#fff;"><?= t('apropos_stats_titre') ?></h2>
        <div class="stats-grid">
          <div class="stat-card">
            <span class="stat-value counter" data-target="10">0</span>
            <div class="stat-label"><?= t('apropos_stats_ans') ?></div>
          </div>
          <div class="stat-card">
            <span class="stat-value counter" data-target="25">0</span>
            <div class="stat-label"><?= t('apropos_stats_projets') ?></div>
          </div>
          <div class="stat-card">
            <span class="stat-value counter" data-target="4">0</span>
            <div class="stat-label"><?= t('apropos_stats_poles') ?></div>
          </div>
          <div class="stat-card">
            <span class="stat-value counter" data-target="15">0</span>
            <div class="stat-label"><?= t('apropos_stats_partenaires') ?></div>
          </div>
        </div>
      </div>
      <div style="border-radius:20px;overflow:hidden;height:320px;box-shadow:0 0 0 4px rgba(247,148,29,0.5),0 12px 40px rgba(0,0,0,0.4);">
        <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
             style="width:100%;height:100%;object-fit:cover;object-position:center top;">
      </div>
    </div>
  </div>
</section>

<!-- ══ TIMELINE ══ -->
<section class="timeline-section">
  <div class="container" style="text-align:center;">
    <span class="section-tag"><?= icon('calendar') ?> <?= t('apropos_tl_tag') ?></span>
    <h2 class="section-title"><?= t('apropos_tl_titre') ?></h2>
  </div>
  <div class="container">
    <div class="timeline">

      <div class="tl-item stagger-item">
        <div class="tl-dot"></div>
        <div class="tl-box">
          <div class="tl-year">2015</div>
          <div class="tl-title"><?= t('tl_2015_titre') ?></div>
          <div class="tl-desc"><?= t('tl_2015_desc') ?></div>
        </div>
      </div>

      <div class="tl-item stagger-item">
        <div class="tl-dot"></div>
        <div class="tl-box">
          <div class="tl-year">2017</div>
          <div class="tl-title"><?= t('tl_2017_titre') ?></div>
          <div class="tl-desc"><?= t('tl_2017_desc') ?></div>
        </div>
      </div>

      <div class="tl-item stagger-item">
        <div class="tl-dot"></div>
        <div class="tl-box">
          <div class="tl-year">2019</div>
          <div class="tl-title"><?= t('tl_2019_titre') ?></div>
          <div class="tl-desc"><?= t('tl_2019_desc') ?></div>
        </div>
      </div>

      <div class="tl-item stagger-item">
        <div class="tl-dot"></div>
        <div class="tl-box">
          <div class="tl-year">2022</div>
          <div class="tl-title"><?= t('tl_2022_titre') ?></div>
          <div class="tl-desc"><?= t('tl_2022_desc') ?></div>
        </div>
      </div>

      <div class="tl-item stagger-item">
        <div class="tl-dot"></div>
        <div class="tl-box">
          <div class="tl-year">2024</div>
          <div class="tl-title"><?= t('tl_2024_titre') ?></div>
          <div class="tl-desc"><?= t('tl_2024_desc') ?></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══ ÉQUIPE DIRIGEANTE ══ -->
<section class="section">
  <div class="container" style="text-align:center;">
    <span class="section-tag"><?= icon('users') ?> <?= t('apropos_equipe_tag') ?></span>
    <h2 class="section-title"><?= t('apropos_equipe_titre') ?></h2>
    <p class="section-sub"><?= t('apropos_equipe_desc') ?></p>

    <!-- Photo d'équipe complète -->
    <div style="margin:0 auto 48px;max-width:860px;border-radius:20px;overflow:hidden;box-shadow:0 12px 48px rgba(0,0,0,0.14);">
      <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-bureau.jpg"
           alt="Équipe COTRAC en réunion de travail"
           style="width:100%;height:420px;object-fit:cover;object-position:center top;display:block;">
    </div>

    <div class="equipe-grid">

      <div class="equipe-card stagger-item">
        <img src="<?= SITE_URL ?>/assets/images/equipe/gilet-cotrac2.jpg" alt="<?= t('img_alt_dg') ?>" style="object-position:center top;">
        <div class="equipe-info">
          <div class="equipe-name"><?= t('equipe_dg_nom') ?></div>
          <div class="equipe-role"><?= t('equipe_dg_role') ?></div>
          <div class="equipe-bio"><?= t('equipe_dg_bio') ?></div>
        </div>
      </div>

      <div class="equipe-card stagger-item">
        <img src="<?= SITE_URL ?>/assets/images/equipe/ingenieure-plans.jpg" alt="<?= t('img_alt_dt') ?>">
        <div class="equipe-info">
          <div class="equipe-name"><?= t('equipe_dt_nom') ?></div>
          <div class="equipe-role"><?= t('equipe_dt_role') ?></div>
          <div class="equipe-bio"><?= t('equipe_dt_bio') ?></div>
        </div>
      </div>

      <div class="equipe-card stagger-item">
        <img src="<?= SITE_URL ?>/assets/images/equipe/equipe-terrain.jpg" alt="<?= t('img_alt_equipe_terrain2') ?>">
        <div class="equipe-info">
          <div class="equipe-name"><?= t('equipe_terrain_nom') ?></div>
          <div class="equipe-role"><?= t('equipe_terrain_role') ?></div>
          <div class="equipe-bio"><?= t('equipe_terrain_bio') ?></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══ ORGANIGRAMME ══ -->
<section class="section">
  <div class="container" style="text-align:center;">
    <span class="section-tag"><?= icon('building') ?> <?= t('apropos_org_tag') ?></span>
    <h2 class="section-title"><?= t('apropos_org_titre') ?></h2>
    <p class="section-sub"><?= t('apropos_org_desc') ?></p>

    <!-- Organigramme complet -->
    <div class="org2-wrap">

      <!-- DG -->
      <div class="org2-row">
        <div class="org2-card org2-card--ceo">
          <div class="org2-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          </div>
          <div class="org2-label">Directeur Général</div>
          <div class="org2-sub">CEO</div>
          <div class="org2-badge">Direction</div>
        </div>
      </div>

      <div class="org2-vline"></div>

      <!-- Ligne horizontale N2 -->
      <div class="org2-hline org2-hline--3"></div>

      <!-- N2 : DGA + Admin + Commercial -->
      <div class="org2-row org2-row--3" style="align-items:flex-start;">

        <div class="org2-branch" style="flex:2;">
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-card org2-card--dir" style="max-width:200px;">
            <div class="org2-icon org2-icon--dir">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            </div>
            <div class="org2-label">Directeur Général Adjoint</div>
            <div class="org2-sub">DGA</div>
          </div>
          <!-- Sous DGA : Direction Technique -->
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-card org2-card--dir org2-card--tech">
            <div class="org2-icon org2-icon--tech">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
            </div>
            <div class="org2-label">Direction Technique & Opérations</div>
            <div class="org2-sub">DTO</div>
          </div>
          <!-- Services techniques -->
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-hline org2-hline--4"></div>
          <div class="org2-row org2-row--4">
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#1a6bb5"></div>
                <div class="org2-label">Ingénierie Électrique</div>
                <div class="org2-sub">HTA, MT, BT</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#1a6bb5"></div>
                <div class="org2-label">Gestion de Projets</div>
                <div class="org2-sub">Travaux Réseaux</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#1a6bb5"></div>
                <div class="org2-label">Supply Chain</div>
                <div class="org2-sub">Logistique</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#1a6bb5"></div>
                <div class="org2-label">Sécurité & Qualité</div>
                <div class="org2-sub">HSE</div>
              </div>
            </div>
          </div>
        </div>

        <div class="org2-branch">
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-card org2-card--dir">
            <div class="org2-icon org2-icon--dir">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div class="org2-label">Direction Administrative</div>
            <div class="org2-sub">DAF</div>
          </div>
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-hline org2-hline--3"></div>
          <div class="org2-row org2-row--3 org2-row--sub">
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#27ae60"></div>
                <div class="org2-label">Direction Financière</div>
                <div class="org2-sub">Comptabilité</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#27ae60"></div>
                <div class="org2-label">Direction RH</div>
                <div class="org2-sub">Ressources Humaines</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#27ae60"></div>
                <div class="org2-label">Direction Juridique</div>
                <div class="org2-sub">Affaires Légales</div>
              </div>
            </div>
          </div>
        </div>

        <div class="org2-branch">
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-card org2-card--dir">
            <div class="org2-icon org2-icon--dir">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="org2-label">Direction Commerciale & Marketing</div>
            <div class="org2-sub">DCM</div>
          </div>
          <div class="org2-vline org2-vline--short"></div>
          <div class="org2-hline org2-hline--2"></div>
          <div class="org2-row org2-row--2 org2-row--sub">
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#f7941d"></div>
                <div class="org2-label">Service Marketing</div>
                <div class="org2-sub">Communication</div>
              </div>
            </div>
            <div class="org2-branch">
              <div class="org2-vline org2-vline--short"></div>
              <div class="org2-card org2-card--service">
                <div class="org2-dot" style="background:#f7941d"></div>
                <div class="org2-label">Service Ventes</div>
                <div class="org2-sub">Développement Commercial</div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<style>
/* ═══════════════ ORGANIGRAMME V2 ═══════════════ */
.org2-wrap {
  max-width: 1200px;
  margin: 56px auto 0;
  font-family: 'Poppins', sans-serif;
  overflow-x: auto;
  padding: 0 16px 8px;
}

.org2-row {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 0;
  position: relative;
}
.org2-row--3 { gap: 8px; align-items: flex-start; }
.org2-row--4 { gap: 6px; }
.org2-row--2 { gap: 8px; }
.org2-row--sub { margin-top: 0; }

.org2-branch {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
  min-width: 0;
}

/* Lignes verticales */
.org2-vline {
  width: 2px;
  height: 24px;
  background: linear-gradient(to bottom, #1a6bb5, #cbd5e1);
  margin: 0 auto;
  flex-shrink: 0;
}
.org2-vline--short { height: 18px; }

/* Lignes horizontales */
.org2-hline {
  height: 2px;
  background: linear-gradient(to right, transparent, #1a6bb5 20%, #1a6bb5 80%, transparent);
  align-self: stretch;
  margin: 0 auto;
}
.org2-hline--3 { width: 66%; }
.org2-hline--4 { width: 88%; }
.org2-hline--2 { width: 44%; }

/* Carte CEO */
.org2-card {
  background: #fff;
  border-radius: 16px;
  padding: 20px 18px 16px;
  text-align: center;
  box-shadow: 0 4px 20px rgba(26,107,181,0.10);
  border: 1.5px solid #e2eaf4;
  transition: transform .22s, box-shadow .22s;
  position: relative;
  width: 100%;
  max-width: 200px;
  cursor: default;
}
.org2-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 36px rgba(26,107,181,0.18);
  border-color: #1a6bb5;
}
.org2-card--ceo {
  background: linear-gradient(135deg, #f7941d 0%, #e07b0f 100%);
  border-color: transparent;
  color: #fff;
  max-width: 220px;
  padding: 20px 24px 16px;
  box-shadow: 0 8px 32px rgba(247,148,29,0.35);
}
.org2-card--ceo:hover { box-shadow: 0 16px 48px rgba(247,148,29,0.45); }
.org2-card--ceo .org2-label { color: #fff; font-size: 1rem; }
.org2-card--ceo .org2-sub   { color: rgba(255,255,255,.8); }

.org2-card--dir {
  background: linear-gradient(135deg, #1a3a5c 0%, #1a6bb5 100%);
  border-color: transparent;
  color: #fff;
  max-width: 190px;
  box-shadow: 0 6px 24px rgba(26,58,92,0.25);
}
.org2-card--dir:hover { box-shadow: 0 12px 36px rgba(26,58,92,0.35); }
.org2-card--dir .org2-label { color: #fff; font-size: .85rem; }
.org2-card--dir .org2-sub   { color: rgba(255,255,255,.7); }

.org2-card--tech {
  background: linear-gradient(135deg, #0f5c96 0%, #1a8bb5 100%);
  max-width: 210px;
}

.org2-card--service {
  background: #f8fafd;
  border: 1.5px solid #dbe8f5;
  max-width: 148px;
  width: 100%;
  padding: 12px 10px 10px;
  box-sizing: border-box;
}
.org2-card--service:hover { border-color: #1a6bb5; background: #fff; }

/* Icônes */
.org2-icon {
  width: 48px; height: 48px;
  background: rgba(255,255,255,0.2);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 12px;
}
.org2-icon svg { width: 22px; height: 22px; stroke: #fff; }
.org2-icon--dir { width: 40px; height: 40px; }
.org2-icon--tech { background: rgba(255,255,255,0.15); }

/* Point coloré services */
.org2-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  margin: 0 auto 10px;
}

/* Textes */
.org2-label {
  font-size: .82rem;
  font-weight: 700;
  color: #1a3a5c;
  line-height: 1.3;
  margin-bottom: 4px;
  opacity: 1 !important;
  transform: none !important;
}
.org2-sub {
  font-size: .72rem;
  color: #7a8fa6;
  font-weight: 500;
  opacity: 1 !important;
  transform: none !important;
}

/* Forcer visibilité organigramme — ne pas toucher aux transforms */
.org2-wrap .org2-label,
.org2-wrap .org2-sub,
.org2-wrap .org2-dot,
.org2-wrap .org2-badge,
.org2-wrap .org2-icon,
.org2-wrap .org2-vline,
.org2-wrap .org2-hline,
.org2-wrap .org2-card,
.org2-wrap .org2-branch {
  opacity: 1 !important;
  visibility: visible !important;
}

/* Badge CEO */
.org2-badge {
  display: inline-block;
  background: rgba(255,255,255,0.25);
  color: #fff;
  font-size: .65rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 50px;
  margin-top: 8px;
}

/* Responsive */
@media (max-width: 1100px) {
  .org2-card--dir { max-width: 170px; }
  .org2-card--service { max-width: 120px; font-size: .75rem; }
  .org2-label { font-size: .75rem; }
  .org2-sub { font-size: .68rem; }
}
@media (max-width: 900px) {
  .org2-row--3 { flex-direction: column; align-items: center; gap: 0; }
  .org2-branch { width: 100%; max-width: 400px; }
  .org2-hline { display: none; }
  .org2-card { max-width: 320px; }
  .org2-row--4, .org2-row--2 { flex-wrap: wrap; justify-content: center; gap: 8px; }
  .org2-card--service { max-width: 160px; }
  .org2-label { font-size: .82rem; }
  .org2-sub { font-size: .72rem; }
}
@media (max-width: 480px) {
  .org2-card { max-width: 100%; }
  .org2-branch { min-width: 0; width: 100%; }
}
</style>

<!-- ══ VALEURS ══ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container" style="text-align:center;">
    <span class="section-tag"><?= icon('target') ?> <?= t('apropos_valeurs_tag') ?></span>
    <h2 class="section-title"><?= t('apropos_valeurs_titre') ?></h2>
    <p class="section-sub"><?= t('apropos_valeurs_desc') ?></p>
    <div class="valeurs-grid">

      <div class="valeur-card stagger-item">
        <div class="valeur-icon"><?= icon('star') ?></div>
        <div class="valeur-title"><?= t('valeur_excellence_titre') ?></div>
        <div class="valeur-desc"><?= t('valeur_excellence_desc') ?></div>
      </div>

      <div class="valeur-card stagger-item">
        <div class="valeur-icon"><?= icon('check') ?></div>
        <div class="valeur-title"><?= t('valeur_integrite_titre') ?></div>
        <div class="valeur-desc"><?= t('valeur_integrite_desc') ?></div>
      </div>

      <div class="valeur-card stagger-item">
        <div class="valeur-icon"><?= icon('wrench') ?></div>
        <div class="valeur-title"><?= t('valeur_innovation_titre') ?></div>
        <div class="valeur-desc"><?= t('valeur_innovation_desc') ?></div>
      </div>

      <div class="valeur-card stagger-item">
        <div class="valeur-icon"><?= icon('globe') ?></div>
        <div class="valeur-title"><?= t('valeur_durabilite_titre') ?></div>
        <div class="valeur-desc"><?= t('valeur_durabilite_desc') ?></div>
      </div>

    </div>
  </div>
</section>

<!-- ══ CERTIFICATIONS ══ -->
<section class="section">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <span class="section-tag"><?= icon('certificate') ?> <?= t('apropos_cert_tag') ?></span>
      <h2 class="section-title"><?= t('apropos_cert_titre') ?></h2>
      <p class="section-sub"><?= t('apropos_cert_desc') ?></p>
    </div>
    <div class="cert-grid">

      <div class="cert-card animate-fade-up">
        <div class="cert-badge">RCCM</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_rccm_titre') ?></div>
          <div class="cert-ref">SN DKR 2018-B-19682</div>
          <div class="cert-desc"><?= t('cert_rccm_desc') ?></div>
        </div>
      </div>

      <div class="cert-card animate-fade-up">
        <div class="cert-badge cert-badge--orange">NINEA</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_ninea_titre') ?></div>
          <div class="cert-ref">006932504 2V2</div>
          <div class="cert-desc"><?= t('cert_ninea_desc') ?></div>
        </div>
      </div>

      <div class="cert-card animate-fade-up">
        <div class="cert-badge cert-badge--vert">SARL</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_sarl_titre') ?></div>
          <div class="cert-ref"><?= t('cert_sarl_ref') ?></div>
          <div class="cert-desc"><?= t('cert_sarl_desc') ?></div>
        </div>
      </div>

      <div class="cert-card animate-fade-up">
        <div class="cert-badge cert-badge--violet">BTP</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_btp_titre') ?></div>
          <div class="cert-ref"><?= t('cert_btp_ref') ?></div>
          <div class="cert-desc"><?= t('cert_btp_desc') ?></div>
        </div>
      </div>

      <div class="cert-card animate-fade-up">
        <div class="cert-badge">HTA</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_hta_titre') ?></div>
          <div class="cert-ref"><?= t('cert_hta_ref') ?></div>
          <div class="cert-desc"><?= t('cert_hta_desc') ?></div>
        </div>
      </div>

      <div class="cert-card animate-fade-up">
        <div class="cert-badge cert-badge--orange">2050</div>
        <div class="cert-body">
          <div class="cert-title"><?= t('cert_2050_titre') ?></div>
          <div class="cert-ref"><?= t('cert_2050_ref') ?></div>
          <div class="cert-desc"><?= t('cert_2050_desc') ?></div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ══ ZONES D'INTERVENTION ══ -->
<section class="section" style="background:var(--gris-clair);">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <span class="section-tag"><?= icon('location') ?> <?= t('apropos_zones_tag') ?></span>
      <h2 class="section-title"><?= t('apropos_zones_titre') ?></h2>
      <p class="section-sub"><?= t('apropos_zones_desc') ?></p>
    </div>
    <div class="zones-layout">
      <div class="zones-list animate-fade-up">
        <?php
        $zones = [
          ['Dakar',        'Siège social - tous pôles actifs'],
          ['Thiès',        'Réseaux HTA/BT & BTP'],
          ['Saint-Louis',  'Routes & ouvrages d\'art'],
          ['Ziguinchor',   'BTP & infrastructures rurales'],
          ['Kaolack',      'Voirie & génie industriel'],
          ['Tambacounda',  'Électrification rurale & pistes'],
          ['Mbour',        'Construction & réhabilitation'],
          ['Louga',        'Réseaux électriques & routes'],
          ['Fatick',       'Infrastructures sanitaires & scolaires'],
          ['Kédougou',     'Génie civil & voirie minière'],
        ];
        foreach ($zones as $i => [$nom, $desc]): ?>
        <div class="zone-item animate-fade-up">
          <div class="zone-num"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></div>
          <div class="zone-body">
            <div class="zone-name"><?= $nom ?></div>
            <div class="zone-desc"><?= $desc ?></div>
          </div>
          <div class="zone-dot"></div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="zones-map animate-fade-up">
        <div class="zones-map-inner">
          <div class="zones-map-label"><?= t('zones_map_label') ?></div>
          <?php foreach ($zones as [$nom, ]): ?>
          <div class="zones-pin"><?= icon('location', '', '0.9rem') ?><span><?= $nom ?></span></div>
          <?php endforeach; ?>
          <div class="zones-coverage">
            <span class="zones-big">14</span>
            <span class="zones-sub"><?= t('zones_map_coverage') ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ PARTENAIRES ══ -->
<section class="section">
  <div class="container">
    <div class="text-center" style="margin-bottom:48px;">
      <span class="section-tag"><?= icon('handshake') ?> <?= t('apropos_part_tag') ?></span>
      <h2 class="section-title"><?= t('apropos_part_titre') ?></h2>
      <p class="section-sub"><?= t('apropos_part_desc') ?></p>
    </div>
    <div class="partenaires-inst-grid">
      <?php
      $partenaires = [
        ['senelec',  'SENELEC',  'Société Nationale d\'Électricité',         'Energie',   '#1558a8', 'jpg'],
        ['ageroute', 'AGEROUTE', 'Agence des Travaux et Gestion des Routes',  'Routes',    '#f08014', 'jpg'],
        ['onas',     'ONAS',     'Office National de l\'Assainissement',      'BTP',       '#27ae60', 'png'],
        ['adie',     'ADIE',     'Agence de l\'Informatique de l\'État',      'Industrie', '#8e44ad', 'png'],
        ['bhs',      'BHS',      'Banque de l\'Habitat du Sénégal',           'BTP',       '#1558a8', 'jpg'],
        ['sapco',    'SAPCO',    'Soc. d\'Aménagement & Promotion des Côtes', 'Routes',    '#f08014', 'png'],
      ];
      foreach ($partenaires as [$slug, $sigle, $nom, $pole, $color, $ext]): ?>
      <div class="partenaire-inst-card animate-fade-up">
        <div class="partenaire-inst-logo">
          <picture>
            <source srcset="<?= SITE_URL ?>/assets/images/logos/<?= $slug ?>.webp" type="image/webp">
            <img src="<?= SITE_URL ?>/assets/images/logos/<?= $slug ?>.<?= $ext ?>"
                 alt="Logo <?= $sigle ?>" loading="lazy">
          </picture>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
/* ── Certifications ── */
.cert-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
}
.cert-card {
  display: flex;
  gap: 16px;
  align-items: flex-start;
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 20px;
  transition: var(--transition);
}
.cert-card:hover { box-shadow: 0 8px 24px rgba(26,107,181,0.10); transform: translateY(-3px); }
.cert-badge {
  flex-shrink: 0;
  width: 52px; height: 52px;
  border-radius: 10px;
  background: var(--bleu);
  color: #fff;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 0.04em;
  display: flex; align-items: center; justify-content: center;
  text-align: center;
}
.cert-badge--orange { background: var(--orange); }
.cert-badge--vert   { background: #27ae60; }
.cert-badge--violet { background: #8e44ad; }
.cert-title { font-size: 0.9rem; font-weight: 700; color: var(--texte); margin-bottom: 3px; }
.cert-ref   { font-size: 0.8rem; color: var(--bleu); font-weight: 600; margin-bottom: 6px; }
.cert-desc  { font-size: 0.82rem; color: #6b7280; line-height: 1.55; }
@media (max-width: 900px) { .cert-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 560px) { .cert-grid { grid-template-columns: 1fr; } }

/* ── Zones ── */
.zones-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 48px;
  align-items: start;
}
.zone-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
}
.zone-num {
  font-size: 0.75rem;
  font-weight: 800;
  color: var(--bleu);
  opacity: 0.4;
  min-width: 28px;
  font-family: 'Poppins', sans-serif;
}
.zone-body { flex: 1; }
.zone-name { font-size: 0.95rem; font-weight: 700; color: var(--texte); }
.zone-desc { font-size: 0.8rem; color: #6b7280; margin-top: 2px; }
.zone-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: var(--orange);
  flex-shrink: 0;
}
.zones-map-inner {
  background: linear-gradient(135deg, var(--bleu-dark) 0%, var(--bleu) 100%);
  border-radius: 20px;
  padding: 48px 32px;
  text-align: center;
  color: #fff;
  min-height: 340px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  position: relative;
  overflow: hidden;
}
.zones-map-inner::before {
  content: '';
  position: absolute; inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23fff' fill-opacity='0.04'%3E%3Ccircle cx='20' cy='20' r='3'/%3E%3C/g%3E%3C/svg%3E");
}
.zones-map-label { font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; opacity: 0.5; margin-bottom: 8px; }
.zones-pin {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: rgba(255,255,255,0.12);
  border-radius: 50px;
  padding: 4px 12px;
  font-size: 0.8rem;
  font-weight: 600;
  margin: 3px;
}
.zones-coverage { margin-top: 20px; }
.zones-big { font-family: 'Poppins', sans-serif; font-size: 3.5rem; font-weight: 800; color: var(--orange); display: block; line-height: 1; }
.zones-sub { font-size: 0.85rem; opacity: 0.7; }
@media (max-width: 768px) { .zones-layout { grid-template-columns: 1fr; } }

/* ── Partenaires institutionnels ── */
.partenaires-inst-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  max-width: 640px;
  margin: 0 auto;
}
.partenaire-inst-card {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 20px;
  text-align: center;
  transition: var(--transition);
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100px;
  overflow: hidden;
}
.partenaire-inst-card:hover { transform: translateY(-4px); box-shadow: 0 10px 32px rgba(26,107,181,0.12); border-color: rgba(26,107,181,0.2); }
.partenaire-inst-logo {
  width: 140px;
  height: 60px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto;
}
.partenaire-inst-logo img {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: contain;
  filter: grayscale(0%);
  transition: filter .3s;
}
.partenaire-inst-card:hover .partenaire-inst-logo img { filter: grayscale(0%) drop-shadow(0 2px 8px rgba(0,0,0,0.12)); }
.partenaire-inst-name { font-size: 0.85rem; font-weight: 600; color: var(--texte); margin-bottom: 5px; line-height: 1.4; word-break: break-word; }
.partenaire-inst-pole {
  font-size: 0.72rem;
  font-weight: 700;
  color: var(--bleu);
  text-transform: uppercase;
  letter-spacing: 0.1em;
  background: var(--bleu-light);
  padding: 3px 10px;
  border-radius: 50px;
  display: inline-block;
  margin-top: 4px;
}
@media (max-width: 768px) { .partenaires-inst-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 480px) { .partenaires-inst-grid { grid-template-columns: 1fr; } }
</style>

<!-- ══ CTA ══ -->
<section style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <!-- Photo pleine largeur en fond -->
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <!-- Overlay sombre pour lisibilité -->
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <!-- Contenu -->
  <div class="container" style="position:relative;z-index:2;display:grid;grid-template-columns:1fr 1fr;gap:56px;align-items:center;padding-top:4rem;padding-bottom:4rem;">
    <!-- Gauche -->
    <div class="animate-fade-up delay-1">
      <span class="section-tag orange"><?= t('apropos_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-top:10px;"><?= t('apropos_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        <?= t('apropos_cta_desc') ?>
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
          <?= t('apropos_cta_adresse') ?>
        </div>
      </div>
    </div>
    <!-- Droite : carte action -->
    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#f7941d;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('handshake','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;"><?= t('apropos_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        <?= t('apropos_cta_card_desc') ?>
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> <?= t('apropos_cta_btn_contact') ?>
        </a>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-outline" style="width:100%;justify-content:center;">
          <?= icon('arrow-right','','.9rem') ?> <?= t('apropos_cta_btn_real') ?>
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">48h</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('apropos_cta_delai_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;"><?= t('apropos_cta_gratuit') ?></div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('apropos_cta_etude_label') ?></div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">14</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;"><?= t('apropos_cta_regions_label') ?></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
(function () {
  const counters = document.querySelectorAll('.counter');
  if (!counters.length) return;
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = +el.dataset.target;
      let current = 0;
      const step = Math.ceil(target / 40);
      const timer = setInterval(() => {
        current = Math.min(current + step, target);
        el.textContent = current + '+';
        if (current >= target) clearInterval(timer);
      }, 40);
      obs.unobserve(el);
    });
  }, { threshold: 0.5 });
  counters.forEach(c => obs.observe(c));
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
