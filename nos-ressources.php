<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Nos Ressources — Équipements & Matériaux | COTRAC';
$page_desc  = 'Découvrez les ressources de COTRAC : machines de production, engins de chantier, véhicules, matériaux et équipements logistiques.';
cms_load('nos-ressources');

// Charger toutes les sections et leurs images depuis la DB
$db  = getDB();
$sections_db = $db->query(
    "SELECT id, section_key, label, active FROM page_sections
     WHERE page_slug='nos-ressources' ORDER BY sort_order"
)->fetchAll();

$images_by_sec = [];
$fields_by_sec = [];
if ($sections_db) {
    $ids = array_column($sections_db, 'id');
    $ph  = implode(',', array_fill(0, count($ids), '?'));
    $imgs = $db->prepare("SELECT * FROM page_section_images WHERE section_id IN ($ph) ORDER BY section_id, sort_order");
    $imgs->execute($ids);
    foreach ($imgs->fetchAll() as $img) {
        $images_by_sec[$img['section_id']][] = $img;
    }
    $flds = $db->prepare("SELECT * FROM page_section_fields WHERE section_id IN ($ph) ORDER BY section_id, sort_order");
    $flds->execute($ids);
    foreach ($flds->fetchAll() as $f) {
        $fields_by_sec[$f['section_id']][$f['field_key']] = $f['field_value'];
    }
}

// Helper : URL d'une image stockée (assets/, uploads/, ressources/ ou uploads/cms/)
function res_img_url(string $path): string {
    if ($path === '') return '';
    if (str_starts_with($path, 'http')) return $path;
    if (str_starts_with($path, 'assets/') || str_starts_with($path, 'uploads/') || str_starts_with($path, 'ressources/')) {
        return SITE_URL . '/' . $path;
    }
    return SITE_URL . '/uploads/cms/' . $path;
}

// Récupérer les sections indexées par section_key
$sec_by_key = [];
foreach ($sections_db as $s) { $sec_by_key[$s['section_key']] = $s; }

$hero_title    = $fields_by_sec[$sec_by_key['hero']['id'] ?? 0]['title']    ?? 'Nos Ressources';
$hero_subtitle = $fields_by_sec[$sec_by_key['hero']['id'] ?? 0]['subtitle'] ?? '';
$hero_bg_raw   = $fields_by_sec[$sec_by_key['hero']['id'] ?? 0]['bg_image'] ?? '';
$hero_bg       = cms_bg_url($hero_bg_raw);

$stats_id = $sec_by_key['stats']['id'] ?? 0;
$stats_f  = $fields_by_sec[$stats_id] ?? [];

// Catégories galerie dans l'ordre
$gallery_cats = [
    'production' => ['label'=>'Production',           'color'=>'#f7941d'],
    'transport'  => ['label'=>'Transport & Engins',   'color'=>'#1a6bb5'],
    'materiaux'  => ['label'=>'Matériaux',            'color'=>'#27ae60'],
    'logistique' => ['label'=>'Logistique',           'color'=>'#8e44ad'],
];

require_once 'includes/header.php';
?>

<style>
.res-hero {
  background: linear-gradient(135deg,#0f4d8a 0%,#1a3c6e 100%);
  padding: 72px 0 56px; color:#fff;
}
.res-hero .breadcrumb { display:flex;align-items:center;gap:6px;font-size:.82rem;opacity:.7;margin-bottom:16px; }
.res-hero .breadcrumb a { color:#fff;text-decoration:none; }
.res-hero-title { font-size:clamp(2rem,5vw,2.8rem);font-weight:800;margin:0 0 .8rem;line-height:1.2; }
.res-hero-title span { color:var(--orange); }
.res-hero-desc { opacity:.85;font-size:1rem;max-width:560px;line-height:1.7; }

.res-filters { display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px; }
.res-filter-btn { border:2px solid #e2e8f0;background:#fff;border-radius:999px;padding:7px 20px;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .2s;color:#4a5568; }
.res-filter-btn:hover,.res-filter-btn.active { background:var(--bleu);border-color:var(--bleu);color:#fff; }

.res-cat-header { display:flex;align-items:center;gap:14px;margin:48px 0 20px; }
.res-cat-bar { width:5px;height:36px;border-radius:3px; }
.res-cat-title { font-size:1.35rem;font-weight:800;color:#1a202c;margin:0; }
.res-cat-count { background:#f0f4f8;color:#718096;border-radius:999px;padding:3px 10px;font-size:.75rem;font-weight:600; }

.res-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:20px; }
.res-card { border-radius:14px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.09);background:#fff;transition:transform .25s,box-shadow .25s;cursor:pointer; }
.res-card:hover { transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.16); }
.res-card-img { width:100%;height:220px;object-fit:cover;display:block; }
.res-card-body { padding:14px 16px; }
.res-card-label { font-size:.82rem;font-weight:700;color:#fff;border-radius:6px;padding:3px 10px;display:inline-block;margin-bottom:6px; }
.res-card-title { font-size:.95rem;font-weight:700;color:#1a202c;margin:0; }

.res-stats { display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;margin-bottom:48px; }
.res-stat-card { background:#fff;border-radius:14px;padding:24px 20px;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.07);border-top:4px solid var(--bleu); }
.res-stat-val { font-size:2rem;font-weight:800;color:var(--bleu);line-height:1; }
.res-stat-label { font-size:.78rem;color:#718096;margin-top:6px;text-transform:uppercase;letter-spacing:.06em; }

.lightbox-overlay { display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.92);align-items:center;justify-content:center; }
.lightbox-overlay.open { display:flex; }
.lightbox-img { max-width:90vw;max-height:88vh;object-fit:contain;border-radius:10px; }
.lightbox-close { position:absolute;top:18px;right:22px;color:#fff;font-size:2.2rem;cursor:pointer;background:none;border:none;line-height:1; }
.lightbox-caption { position:absolute;bottom:24px;left:0;right:0;text-align:center;color:#fff;font-size:.95rem;font-weight:600;text-shadow:0 1px 4px rgba(0,0,0,.6); }
.lightbox-nav { position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;width:52px;height:52px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s; }
.lightbox-nav:hover { background:rgba(255,255,255,.3); }
.lightbox-prev { left:16px; }
.lightbox-next { right:16px; }
</style>

<!-- ══ HERO ══ -->
<section class="res-hero" <?= $hero_bg ? 'style="background-image:url(\''.e($hero_bg).'\');background-size:cover;background-position:center;"' : '' ?>>
  <div class="container">
    <nav class="breadcrumb">
      <a href="<?= SITE_URL ?>/index.php">Accueil</a>
      <span>›</span>
      <span>Nos Ressources</span>
    </nav>
    <h1 class="res-hero-title">Nos <span>Ressources</span></h1>
    <p class="res-hero-desc"><?= nl2br(e($hero_subtitle)) ?></p>
  </div>
</section>

<!-- ══ CONTENU ══ -->
<div class="section bg-gris">
  <div class="container">

    <!-- Stats -->
    <?php if (!empty($stats_f)): ?>
    <div class="res-stats">
      <?php for ($i = 1; $i <= 4; $i++):
        $val   = $stats_f["stat{$i}_value"] ?? '';
        $label = $stats_f["stat{$i}_label"] ?? '';
        if (!$val && !$label) continue;
      ?>
      <div class="res-stat-card">
        <div class="res-stat-val"><?= e($val) ?></div>
        <div class="res-stat-label"><?= e($label) ?></div>
      </div>
      <?php endfor; ?>
    </div>
    <?php endif; ?>

    <!-- Filtres -->
    <div class="res-filters">
      <button class="res-filter-btn active" data-cat="tous">Tout voir</button>
      <?php foreach ($gallery_cats as $ckey => $cmeta): ?>
      <button class="res-filter-btn" data-cat="<?= $ckey ?>"><?= e($cmeta['label']) ?></button>
      <?php endforeach; ?>
    </div>

    <!-- Sections galeries -->
    <?php foreach ($gallery_cats as $ckey => $cmeta):
      $sec   = $sec_by_key[$ckey] ?? null;
      if (!$sec || !$sec['active']) continue;
      $sid   = $sec['id'];
      $imgs  = $images_by_sec[$sid] ?? [];
      $stitle = $fields_by_sec[$sid]['section_title'] ?? $cmeta['label'];
      if (empty($imgs)) continue;
    ?>
    <div class="res-category" data-cat="<?= $ckey ?>">
      <div class="res-cat-header">
        <div class="res-cat-bar" style="background:<?= $cmeta['color'] ?>;"></div>
        <h2 class="res-cat-title"><?= e($stitle) ?></h2>
        <span class="res-cat-count"><?= count($imgs) ?> photo<?= count($imgs)>1?'s':'' ?></span>
      </div>
      <div class="res-grid">
        <?php foreach ($imgs as $idx => $img):
          $url = res_img_url($img['image_path']);
        ?>
        <div class="res-card animate-fade-up"
             onclick="openLightbox('<?= $ckey ?>', <?= $idx ?>)">
          <img class="res-card-img" src="<?= e($url) ?>"
               alt="<?= e($img['alt_text']) ?>" loading="lazy">
          <div class="res-card-body">
            <span class="res-card-label" style="background:<?= $cmeta['color'] ?>;"><?= e($cmeta['label']) ?></span>
            <p class="res-card-title"><?= e($img['caption'] ?: $img['alt_text']) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
</div>

<!-- ══ LIGHTBOX ══ -->
<div class="lightbox-overlay" id="lightbox" onclick="closeLightboxOnOverlay(event)">
  <button class="lightbox-close" onclick="closeLightbox()">×</button>
  <button class="lightbox-nav lightbox-prev" onclick="lightboxNav(-1)">‹</button>
  <img class="lightbox-img" id="lightboxImg" src="" alt="">
  <button class="lightbox-nav lightbox-next" onclick="lightboxNav(1)">›</button>
  <div class="lightbox-caption" id="lightboxCaption"></div>
</div>

<script>
var _lbCats = <?php
  $js = [];
  foreach ($gallery_cats as $ckey => $cmeta) {
    $sec  = $sec_by_key[$ckey] ?? null;
    if (!$sec) continue;
    $imgs = $images_by_sec[$sec['id']] ?? [];
    $js[$ckey] = array_map(function($img) {
      return ['url' => res_img_url($img['image_path']), 'titre' => $img['caption'] ?: $img['alt_text']];
    }, $imgs);
  }
  echo json_encode($js);
?>;

var _lbCat = '', _lbIdx = 0;

function openLightbox(cat, idx) {
  _lbCat = cat; _lbIdx = idx;
  showLightboxItem();
  document.getElementById('lightbox').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function showLightboxItem() {
  var items = _lbCats[_lbCat] || [];
  var item  = items[_lbIdx];
  if (!item) return;
  document.getElementById('lightboxImg').src = item.url;
  document.getElementById('lightboxCaption').textContent = item.titre + ' (' + (_lbIdx+1) + ' / ' + items.length + ')';
}
function lightboxNav(dir) {
  var len = (_lbCats[_lbCat] || []).length;
  _lbIdx = (_lbIdx + dir + len) % len;
  showLightboxItem();
}
function closeLightbox() {
  document.getElementById('lightbox').classList.remove('open');
  document.body.style.overflow = '';
}
function closeLightboxOnOverlay(e) {
  if (e.target === document.getElementById('lightbox')) closeLightbox();
}
document.addEventListener('keydown', function(e) {
  if (!document.getElementById('lightbox').classList.contains('open')) return;
  if (e.key === 'ArrowRight') lightboxNav(1);
  if (e.key === 'ArrowLeft')  lightboxNav(-1);
  if (e.key === 'Escape')     closeLightbox();
});

// Filtres
document.querySelectorAll('.res-filter-btn').forEach(function(btn) {
  btn.addEventListener('click', function() {
    document.querySelectorAll('.res-filter-btn').forEach(function(b){ b.classList.remove('active'); });
    btn.classList.add('active');
    var cat = btn.dataset.cat;
    document.querySelectorAll('.res-category').forEach(function(sec) {
      sec.style.display = (cat === 'tous' || sec.dataset.cat === cat) ? '' : 'none';
    });
  });
});
</script>

<?php require_once 'includes/footer.php'; ?>
