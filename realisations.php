<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Nos Réalisations & Références | COTRAC';
$page_desc = 'Découvrez les projets réalisés par COTRAC en BTP, réseaux électriques, routes et génie industrielle au Sénégal et en Afrique.';
cms_load('realisations');
require_once 'includes/header.php';

$db = getDB();

// Migration auto : ajout colonnes si absentes
try {
    $db->exec("ALTER TABLE projets ADD COLUMN IF NOT EXISTS annee VARCHAR(10) DEFAULT NULL");
    // montant volontairement non affiché
    $db->exec("ALTER TABLE projets ADD COLUMN IF NOT EXISTS lieu VARCHAR(150) DEFAULT NULL");
    // Remplir les données manquantes depuis les PDFs
    $updates = [
        ["annee='2023', lieu='Dakar'", "%ESP/UCAD%"],
        ["annee='2022', lieu='Ngor, Dakar'", "%Commune de Ngor%"],
        ["annee='2018', lieu='Ngoundiane, Thiès'", "%Ngoundiane%"],
        ["annee='2017', lieu='Fass-Colobane, Dakar'", "%allée Fass%"],
        ["lieu='Matam et Kanel'", "%Matam-Kanel%"],
        ["lieu='Louga'", "%Louga%"],
        ["lieu='Sébikhotane'", "%Sébikhotane%"],
        ["lieu='Thiès'", "%silex Thiès%"],
        ["lieu='Diamniadio'", "%Diamniadio%"],
        ["lieu='Les Mamelles, Dakar'", "%Mamelles%"],
        ["lieu='Ziguinchor (Oussouye)'", "%Ziguinchor%"],
        ["lieu='Sénégal'", "%SENELEC%"],
        ["lieu='Keur Katim'", "%Keur Katim%"],
        ["lieu='Diack'", "%Diack%"],
    ];
    foreach ($updates as [$set, $like]) {
        $db->exec("UPDATE projets SET $set WHERE titre LIKE '$like' AND lieu IS NULL");
    }
} catch (Exception $e) { /* colonnes déjà présentes */ }

$pole_filter = isset($_GET['pole']) && in_array($_GET['pole'], ['btp','energie','routes','industrie']) ? $_GET['pole'] : 'tous';

if ($pole_filter === 'tous') {
    $stmt = $db->query("SELECT * FROM projets WHERE actif=1 ORDER BY statut ASC, id DESC");
} else {
    $stmt = $db->prepare("SELECT * FROM projets WHERE actif=1 AND pole=? ORDER BY statut ASC, id DESC");
    $stmt->execute([$pole_filter]);
}
$projets = $stmt->fetchAll();

$poles_labels = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie'];
$poles_emojis = ['btp'=>'<span class="ico ico-btp"><!--btp--></span>','energie'=>'<span class="ico ico-energie"><!--energie--></span>','routes'=>'<span class="ico ico-routes"><!--routes--></span>','industrie'=>'<span class="ico ico-industrie"><!--industrie--></span>'];
$poles_colors = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad'];
?>

<!-- ===================== PAGE HERO ===================== -->
<?php $_real_hero_bg = cms_bg_url(cms('realisations','hero','bg_image','')); ?>
<style>
.real-hero-grid { display:grid; grid-template-columns:1fr 1fr; gap:48px; align-items:center; }
.real-hero-stats { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
@media (max-width: 768px) {
  .real-hero-grid { grid-template-columns:1fr; gap:28px; }
  .real-hero-stats > div { padding:16px 12px !important; }
}
.real-cta-grid { display:grid; grid-template-columns:1fr 1fr; gap:64px; align-items:center; }
@media (max-width: 768px) {
  .real-cta-grid { grid-template-columns:1fr; gap:32px; }
}
/* Attestations : réduire padding sur mobile */
@media (max-width: 560px) {
  .projet-card[style*="padding:36px 28px"] { padding: 20px 16px !important; }
}
</style>

<section class="page-hero" <?= $_real_hero_bg ? 'style="background-image:url(\''.e($_real_hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container real-hero-grid">
    <div>
      <nav class="breadcrumb" aria-label="Fil d'Ariane">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <span><?= t('real_breadcrumb_page') ?></span>
      </nav>
      <h1 class="page-hero-title animate-fade-up"><?= cms('realisations','hero','title', t('real_hero_titre')) ?></h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('realisations','hero','subtitle', t('real_hero_desc')) ?>
      </p>
    </div>

    <!-- Chiffres clés -->
    <div class="animate-fade-up delay-2 real-hero-stats">
      <div style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:16px; padding:24px 20px; text-align:center; backdrop-filter:blur(6px);">
        <div class="counter" data-target="15" data-suffix="+" style="font-size:2.4rem; font-weight:800; color:#f08014; line-height:1;">0</div>
        <div style="font-size:.78rem; color:rgba(255,255,255,0.75); margin-top:6px; text-transform:uppercase; letter-spacing:.08em;"><?= t('real_stat1_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:16px; padding:24px 20px; text-align:center; backdrop-filter:blur(6px);">
        <div class="counter" data-target="5" data-suffix="" style="font-size:2.4rem; font-weight:800; color:#f08014; line-height:1;">0</div>
        <div style="font-size:.78rem; color:rgba(255,255,255,0.75); margin-top:6px; text-transform:uppercase; letter-spacing:.08em;"><?= t('real_stat2_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:16px; padding:24px 20px; text-align:center; backdrop-filter:blur(6px);">
        <div class="counter" data-target="10" data-suffix="+" style="font-size:2.4rem; font-weight:800; color:#f08014; line-height:1;">0</div>
        <div style="font-size:.78rem; color:rgba(255,255,255,0.75); margin-top:6px; text-transform:uppercase; letter-spacing:.08em;"><?= t('real_stat3_label') ?></div>
      </div>
      <div style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:16px; padding:24px 20px; text-align:center; backdrop-filter:blur(6px);">
        <div class="counter" data-target="3" data-suffix="" style="font-size:2.4rem; font-weight:800; color:#f08014; line-height:1;">0</div>
        <div style="font-size:.78rem; color:rgba(255,255,255,0.75); margin-top:6px; text-transform:uppercase; letter-spacing:.08em;"><?= t('real_stat4_label') ?></div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== FILTRES ===================== -->
<section style="background:var(--gris-clair); padding:24px 0 0;">
  <div class="container">
    <div class="filter-bar">
      <button class="filter-btn <?= $pole_filter === 'tous' ? 'active' : '' ?>" data-filter="tous">
        <?= t('real_filtre_tous') ?>
      </button>
      <button class="filter-btn <?= $pole_filter === 'btp' ? 'active' : '' ?>" data-filter="btp">
        <span class="ico ico-btp"><!--btp--></span> BTP
      </button>
      <button class="filter-btn <?= $pole_filter === 'energie' ? 'active' : '' ?>" data-filter="energie">
        <span class="ico ico-energie"><!--energie--></span> Énergie
      </button>
      <button class="filter-btn <?= $pole_filter === 'routes' ? 'active' : '' ?>" data-filter="routes">
        <span class="ico ico-routes"><!--routes--></span> Routes
      </button>
      <button class="filter-btn <?= $pole_filter === 'industrie' ? 'active' : '' ?>" data-filter="industrie">
        <span class="ico ico-industrie"><!--industrie--></span> Industrie
      </button>
    </div>
  </div>
</section>

<!-- ===================== GRILLE PROJETS ===================== -->
<section style="background:var(--gris-clair); padding:16px 0 48px;">
  <div class="container">
    <?php if (empty($projets)): ?>
      <div style="text-align:center; padding:60px 20px; color:var(--gris);">
        <div style="font-size:3rem; margin-bottom:16px;">📂</div>
        <h3 style="margin-bottom:8px;"><?= t('real_vide_titre') ?></h3>
        <p><?= t('real_vide_desc') ?></p>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-primary" style="margin-top:24px; display:inline-block;">
          <?= t('real_vide_btn') ?>
        </a>
      </div>
    <?php else: ?>
      <div class="projets-grid" id="projets-grid">
        <?php foreach ($projets as $projet): ?>
          <?php
            $pole = $projet['pole'] ?? 'btp';
            $label_pole = $poles_labels[$pole] ?? strtoupper($pole);
            $emoji_pole = $poles_emojis[$pole] ?? '<span class="ico ico-btp"><!--btp--></span>';
            $color_pole = $poles_colors[$pole] ?? '#f7941d';
            $est_termine = ($projet['statut'] === 'termine');
          ?>
          <article class="projet-card animate-fade-up" data-pole="<?= e($pole) ?>">

            <!-- Image ou fond degrades colore selon le pole -->
            <div class="projet-img">
              <?php if (!empty($projet['image']) && file_exists(UPLOAD_DIR . $projet['image'])): ?>
                <img src="<?= SITE_URL ?>/uploads/projets/<?= e($projet['image']) ?>"
                     alt="<?= e($projet['titre']) ?>"
                     loading="lazy"
                     style="width:100%; height:100%; object-fit:cover;">
              <?php else: ?>
                <div style="
                  width:100%; height:100%;
                  background: linear-gradient(135deg, <?= $color_pole ?>33 0%, <?= $color_pole ?>66 60%, <?= $color_pole ?>22 100%);
                  display:flex; align-items:center; justify-content:center;
                  flex-direction:column; gap:8px;
                ">
                  <span style="font-size:3rem; filter:drop-shadow(0 2px 6px rgba(0,0,0,.12));"><?= $emoji_pole ?></span>
                  <span style="font-size:.7rem; font-weight:700; color:<?= $color_pole ?>; text-transform:uppercase; letter-spacing:.1em; background:rgba(255,255,255,.85); padding:3px 10px; border-radius:20px;">
                    <?= e($label_pole) ?>
                  </span>
                </div>
              <?php endif; ?>

              <!-- Badge statut -->
              <span class="projet-badge <?= $est_termine ? 'badge-termine' : 'badge-encours' ?>">
                <?= $est_termine ? t('real_badge_termine') : t('real_badge_encours') ?>
              </span>
            </div>

            <!-- Corps de la carte -->
            <div class="projet-body">

              <!-- Badge pole colore -->
              <div style="margin-bottom:10px;">
                <span style="
                  display:inline-flex; align-items:center; gap:5px;
                  background:<?= $color_pole ?>18;
                  color:<?= $color_pole ?>;
                  font-size:.68rem; font-weight:700;
                  text-transform:uppercase; letter-spacing:.1em;
                  padding:3px 10px; border-radius:20px;
                  border:1px solid <?= $color_pole ?>33;
                "><?= $emoji_pole ?> <?= e($label_pole) ?></span>
              </div>

              <h3 class="projet-titre"><?= e($projet['titre']) ?></h3>

              <?php if (!empty($projet['client'])): ?>
                <div class="projet-client" style="margin-top:6px; display:flex; align-items:center; gap:4px;">
                  <span style="opacity:.5; font-size:.78rem;"><?= t('real_client_label') ?> &mdash;</span>
                  <strong style="font-size:.84rem;"><?= e($projet['client']) ?></strong>
                </div>
              <?php endif; ?>

              <?php if (!empty($projet['nature_travaux'])): ?>
                <div style="margin-top:6px; font-size:.8rem; color:var(--gris);">
                  &#9881; <?= e(mb_strimwidth($projet['nature_travaux'], 0, 55, '...')) ?>
                </div>
              <?php endif; ?>

              <!-- Détails : lieu, année, montant -->
              <?php if (!empty($projet['lieu']) || !empty($projet['annee']) || !empty($projet['montant'])): ?>
                <div style="margin-top:10px; display:flex; flex-wrap:wrap; gap:6px;">
                  <?php if (!empty($projet['lieu'])): ?>
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:.75rem;color:#555;background:#f1f5f9;padding:3px 9px;border-radius:20px;">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                      <?= e($projet['lieu']) ?>
                    </span>
                  <?php endif; ?>
                  <?php if (!empty($projet['annee'])): ?>
                    <span style="display:inline-flex;align-items:center;gap:4px;font-size:.75rem;color:#555;background:#f1f5f9;padding:3px 9px;border-radius:20px;">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                      <?= e($projet['annee']) ?>
                    </span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <?php if (!empty($projet['description'])): ?>
                <p style="font-size:.85rem; color:var(--gris); margin-top:10px; line-height:1.6; border-top:1px solid var(--border); padding-top:10px;">
                  <?= e(mb_strimwidth($projet['description'], 0, 110, '...')) ?>
                </p>
              <?php endif; ?>
            </div>

          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<!-- ===================== ATTESTATIONS & CERTIFICATIONS ===================== -->
<section class="section bg-gris" style="padding-top:48px;">
  <div class="container">
    <div style="text-align:center; margin-bottom:48px;">
      <span class="section-tag"><?= t('real_tag_attest') ?></span>
      <h2 class="section-title"><?= t('real_titre_attest') ?></h2>
      <p class="section-sub">
        <?= t('real_desc_attest') ?>
      </p>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:28px;">

      <!-- Attestation 1 -->
      <div class="projet-card" style="text-align:center; padding:36px 28px;">
        <div style="width:56px;height:56px;background:var(--bleu-light);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:var(--bleu);"><?= icon('building','','1.6rem') ?></div>
        <h3 style="font-size:1.1rem; margin-bottom:10px; color:var(--bleu);">
          <?= t('real_attest1_titre') ?>
        </h3>
        <p style="font-size:.9rem; color:var(--gris); line-height:1.6;">
          <?= t('real_attest1_desc') ?>
        </p>
        <div style="margin-top:16px;">
          <span class="section-tag" style="font-size:.72rem;"><?= t('real_attest1_tag') ?></span>
        </div>
      </div>

      <!-- Attestation 2 -->
      <div class="projet-card" style="text-align:center; padding:36px 28px;">
        <div style="width:56px;height:56px;background:#fff3e0;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:var(--orange);"><?= icon('star','','1.6rem') ?></div>
        <h3 style="font-size:1.1rem; margin-bottom:10px; color:var(--bleu);">
          <?= t('real_attest2_titre') ?>
        </h3>
        <p style="font-size:.9rem; color:var(--gris); line-height:1.6;">
          <?= t('real_attest2_desc') ?>
        </p>
        <div style="margin-top:16px;">
          <span class="section-tag" style="font-size:.72rem;"><?= t('real_attest2_tag') ?></span>
        </div>
      </div>

      <!-- Attestation 3 -->
      <div class="projet-card" style="text-align:center; padding:36px 28px;">
        <div style="width:56px;height:56px;background:#e8f5e9;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:#27ae60;"><?= icon('globe','','1.6rem') ?></div>
        <h3 style="font-size:1.1rem; margin-bottom:10px; color:var(--bleu);">
          <?= t('real_attest3_titre') ?>
        </h3>
        <p style="font-size:.9rem; color:var(--gris); line-height:1.6;">
          <?= t('real_attest3_desc') ?>
        </p>
        <div style="margin-top:16px;">
          <span class="section-tag" style="font-size:.72rem;"><?= t('real_attest3_tag') ?></span>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ===================== CTA ===================== -->
<section style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container real-cta-grid">

    <!-- Gauche : infos de contact rapide -->
    <div>
      <span class="section-tag orange" style="margin-bottom:20px; display:inline-block;"><?= t('real_cta_tag') ?></span>
      <h2 class="section-title light" style="margin-bottom:16px;"><?= t('real_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,0.75); font-size:.95rem; line-height:1.8; margin-bottom:32px;">
        <?= t('real_cta_desc') ?>
      </p>

      <div style="display:flex; flex-direction:column; gap:16px;">
        <div style="display:flex; align-items:center; gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <?= icon('phone','','1.1rem') ?>
          </div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('real_cta_tel_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">+221 33 827 96 39 &nbsp;|&nbsp; +221 77 630 16 46</div>
          </div>
        </div>
        <div style="display:flex; align-items:center; gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <?= icon('mail','','1.1rem') ?>
          </div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('real_cta_email_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;">cotracsenegal@gmail.com</div>
          </div>
        </div>
        <div style="display:flex; align-items:center; gap:14px;">
          <div style="width:40px;height:40px;background:rgba(240,128,20,0.2);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <?= icon('map-pin','','1.1rem') ?>
          </div>
          <div>
            <div style="font-size:.7rem;text-transform:uppercase;letter-spacing:.1em;color:rgba(255,255,255,0.45);margin-bottom:2px;"><?= t('real_cta_adresse_label') ?></div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;"><?= t('real_cta_adresse_val') ?></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Droite : carte CTA avec fond -->
    <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.13);border-radius:20px;padding:44px 36px;text-align:center;backdrop-filter:blur(8px);">
      <div style="width:64px;height:64px;background:rgba(240,128,20,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
        <?= icon('briefcase','','1.8rem') ?>
      </div>
      <h3 style="color:#fff;font-size:1.3rem;font-weight:700;margin-bottom:12px;"><?= t('real_cta_card_titre') ?></h3>
      <p style="color:rgba(255,255,255,0.65);font-size:.88rem;line-height:1.7;margin-bottom:28px;">
        <?= t('real_cta_card_desc') ?>
      </p>
      <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;display:block;text-align:center;">
        <?= t('real_cta_btn_contact') ?>
      </a>
      <div style="margin-top:20px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.1);display:flex;justify-content:center;gap:24px;">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:var(--orange);">48h</div>
          <div style="font-size:.68rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:.08em;"><?= t('real_cta_reponse_label') ?></div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.1);"></div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:var(--orange);"><?= t('real_cta_gratuit_val') ?></div>
          <div style="font-size:.68rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:.08em;"><?= t('real_cta_devis_label') ?></div>
        </div>
        <div style="width:1px;background:rgba(255,255,255,0.1);"></div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:var(--orange);">10+</div>
          <div style="font-size:.68rem;color:rgba(255,255,255,0.5);text-transform:uppercase;letter-spacing:.08em;"><?= t('real_cta_ans_label') ?></div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
