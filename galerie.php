<?php
require_once __DIR__ . '/lang/lang.php';
$page_title = t('galerie_page_title');
$page_desc  = t('galerie_page_desc');
require_once __DIR__ . '/includes/header.php';

/* ═══════════════════════════════════════════════════════════
   1. AUTO-MIGRATION TABLE galerie
═══════════════════════════════════════════════════════════ */
$db = getDB();
$db->exec("CREATE TABLE IF NOT EXISTS `galerie` (
  `id`          INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `titre`       VARCHAR(200)    NOT NULL DEFAULT '',
  `description` TEXT,
  `image`       VARCHAR(500)    NOT NULL,
  `categorie`   ENUM('btp','energie','routes','industrie','general') NOT NULL DEFAULT 'general',
  `ordre`       SMALLINT        NOT NULL DEFAULT 0,
  `actif`       TINYINT(1)      NOT NULL DEFAULT 1,
  `created_at`  DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_cat` (`categorie`,`actif`),
  KEY `idx_ordre` (`ordre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

/* ═══════════════════════════════════════════════════════════
   2. FILTRE + PHOTOS DB
═══════════════════════════════════════════════════════════ */
$cats_valides = ['tous','btp','energie','routes','industrie','general'];
$filtre = (isset($_GET['cat']) && in_array($_GET['cat'], $cats_valides)) ? $_GET['cat'] : 'tous';

if ($filtre === 'tous') {
    $stmt = $db->prepare("SELECT * FROM galerie WHERE actif=1 ORDER BY ordre ASC, id DESC");
    $stmt->execute();
} else {
    $stmt = $db->prepare("SELECT * FROM galerie WHERE actif=1 AND categorie=? ORDER BY ordre ASC, id DESC");
    $stmt->execute([$filtre]);
}
$photos_db = $stmt->fetchAll();
$total_db  = (int)$db->query("SELECT COUNT(*) FROM galerie WHERE actif=1")->fetchColumn();

/* ═══════════════════════════════════════════════════════════
   3. FALLBACK filesystem si table vide
═══════════════════════════════════════════════════════════ */
$fallback = [];
if ($total_db === 0) {
    $sources = ['energie'=>'energie','industrie'=>'industrie','general'=>'equipe'];
    foreach ($sources as $cat => $dossier) {
        $dir = __DIR__ . '/assets/images/' . $dossier . '/';
        if (!is_dir($dir)) continue;
        foreach (glob($dir . '*.jpg') ?: [] as $f) {
            $bn = basename($f);
            $fallback[] = [
                'id'=>null,'actif'=>1,'created_at'=>null,'ordre'=>0,
                'titre'       => ucwords(str_replace(['-','_'],' ', pathinfo($bn, PATHINFO_FILENAME))),
                'description' => '',
                'image'       => 'assets/images/' . $dossier . '/' . $bn,
                'categorie'   => $cat,
            ];
        }
    }
    if ($filtre !== 'tous') {
        $fallback = array_values(array_filter($fallback, fn($p) => $p['categorie'] === $filtre));
    }
}
$photos = $total_db > 0 ? $photos_db : $fallback;

/* ═══════════════════════════════════════════════════════════
   4. COMPTEURS PAR CATÉGORIE
═══════════════════════════════════════════════════════════ */
$compteurs = [];
if ($total_db > 0) {
    foreach ($db->query("SELECT categorie, COUNT(*) n FROM galerie WHERE actif=1 GROUP BY categorie")->fetchAll() as $r)
        $compteurs[$r['categorie']] = (int)$r['n'];
    $compteurs['tous'] = $total_db;
} else {
    foreach (['energie'=>'energie','industrie'=>'industrie','general'=>'equipe'] as $c => $d) {
        $dir = __DIR__ . '/assets/images/' . $d . '/';
        $n = is_dir($dir) ? count(glob($dir.'*.jpg') ?: []) : 0;
        if ($n) $compteurs[$c] = $n;
    }
    $compteurs['tous'] = array_sum($compteurs);
}

$labels   = ['tous'=>t('galerie_label_tous'),'btp'=>t('galerie_label_btp'),'energie'=>t('galerie_label_energie'),'routes'=>t('galerie_label_routes'),'industrie'=>t('galerie_label_industrie'),'general'=>t('galerie_label_general')];
$couleurs = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad','general'=>'#546e7a'];
?>

<!-- HERO -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero-inner">
      <span class="section-tag"><?= t('galerie_tag') ?></span>
      <h1 class="page-hero-title"><?= t('galerie_hero_titre') ?></h1>
      <p class="page-hero-desc"><?= t('galerie_hero_desc') ?></p>
      <div class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <span><?= t('galerie_breadcrumb') ?></span>
      </div>
    </div>
  </div>
</section>

<!-- FILTRES -->
<section class="section" style="padding-bottom:0;padding-top:56px;">
  <div class="container">
    <div class="galerie-filters" role="tablist">
      <?php
      $tabs = ['tous','btp','energie','routes','industrie'];
      if (!empty($compteurs['general'])) $tabs[] = 'general';
      foreach ($tabs as $cat):
        $actif  = ($filtre === $cat) ? 'active' : '';
        $n      = $compteurs[$cat] ?? 0;
        $col    = $couleurs[$cat] ?? '#1a6bb5';
        $href   = SITE_URL . '/galerie.php' . ($cat !== 'tous' ? '?cat=' . $cat : '');
      ?>
      <a href="<?= $href ?>" class="galerie-filter-btn <?= $actif ?>"
         style="<?= $actif ? '--accent:'.$col.';' : '' ?>"
         role="tab" aria-selected="<?= $actif ? 'true' : 'false' ?>">
        <?php if ($cat !== 'tous'): ?>
        <span class="filter-dot" style="background:<?= $col ?>"></span>
        <?php endif; ?>
        <?= $labels[$cat] ?>
        <?php if ($n > 0): ?><span class="filter-count"><?= $n ?></span><?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- GRILLE -->
<section class="section" style="padding-top:32px;">
  <div class="container">

    <?php if (empty($photos)): ?>
    <div class="galerie-empty animate-fade-up">
      <div class="galerie-empty-icon">
        <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3">
          <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
          <polyline points="21 15 16 10 5 21"/>
        </svg>
      </div>
      <h3><?= t('galerie_empty_titre') ?></h3>
      <p><?= t('galerie_empty_desc') ?></p>
      <a href="<?= SITE_URL ?>/galerie.php" class="btn btn-primary" style="margin-top:16px;"><?= t('galerie_voir_tout') ?></a>
    </div>

    <?php else: ?>

    <?php if ($total_db === 0): ?>
    <div class="galerie-notice animate-fade-up">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <?= sprintf(t('galerie_notice'), SITE_URL . '/admin/') ?>
    </div>
    <?php endif; ?>

    <div class="galerie-page-grid" id="galerieGrid">
      <?php foreach ($photos as $i => $photo):
        $src = (strpos($photo['image'], 'http') === 0)
               ? $photo['image']
               : SITE_URL . '/' . ltrim($photo['image'], '/');
        $alt  = !empty($photo['titre']) ? $photo['titre'] : t('galerie_photo_alt');
        $cat  = $photo['categorie'] ?? 'general';
        $col  = $couleurs[$cat] ?? '#1a6bb5';
        $lbl  = $labels[$cat] ?? '';
      ?>
      <div class="galerie-page-item animate-fade-up"
           style="transition-delay:<?= ($i % 9) * 55 ?>ms;"
           data-index="<?= $i ?>"
           onclick="ouvrirLbPage(<?= $i ?>)"
           title="<?= e($alt) ?>">
        <img src="<?= e($src) ?>" alt="<?= e($alt) ?>" loading="lazy">
        <div class="galerie-page-overlay">
          <div class="galerie-page-zoom">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
              <line x1="11" y1="8" x2="11" y2="14"/>
              <line x1="8" y1="11" x2="14" y2="11"/>
            </svg>
          </div>
          <div class="galerie-page-info">
            <span class="galerie-page-cat" style="background:<?= $col ?>"><?= e($lbl) ?></span>
            <?php if ($alt !== 'Photo COTRAC'): ?>
            <p class="galerie-page-caption"><?= e($alt) ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php endif; ?>

  </div>
</section>

<!-- CTA -->
<section style="position:relative;overflow:hidden;min-height:300px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
    <div class="container" style="text-align:center;padding-top:4rem;padding-bottom:4rem;">
      <span class="section-tag"><?= t('galerie_cta_tag') ?></span>
      <h2 class="section-title" style="color:#fff;margin:12px 0 16px;"><?= t('galerie_cta_titre') ?></h2>
      <p style="color:rgba(255,255,255,.75);max-width:520px;margin:0 auto 28px;"><?= t('galerie_cta_desc') ?></p>
      <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary"><?= t('galerie_cta_contact') ?></a>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn" style="border:2px solid rgba(255,255,255,.25);color:#fff;background:transparent;"><?= t('galerie_cta_realisations') ?></a>
      </div>
    </div>
  </div>
</section>

<!-- LIGHTBOX -->
<div class="lightbox-page" id="lightboxPage" onclick="fermerLbPage(event)">
  <button class="lb-close" onclick="fermerLbPage(null,true)" aria-label="<?= t('lb_fermer') ?>">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <button class="lb-prev" onclick="changerLbPage(-1)" aria-label="<?= t('lb_precedent') ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <div class="lightbox-content" onclick="event.stopPropagation()">
    <img class="lightbox-img" id="lbImg" src="" alt="">
    <div class="lb-meta">
      <span class="lb-cat-badge" id="lbCat"></span>
      <p class="lightbox-caption" id="lbCaption"></p>
      <span class="lightbox-counter" id="lbCounter"></span>
    </div>
  </div>
  <button class="lb-next" onclick="changerLbPage(1)" aria-label="<?= t('lb_suivant') ?>">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>
</div>

<style>
/* ── Filtres ── */
.galerie-filters{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:6px;}
.galerie-filter-btn{display:inline-flex;align-items:center;gap:7px;padding:9px 20px;border-radius:50px;background:#f0f4f8;color:#334155;text-decoration:none;font-size:.88rem;font-weight:600;font-family:'Poppins',sans-serif;border:2px solid transparent;transition:background .2s,color .2s,transform .15s;}
.galerie-filter-btn:hover{background:#e2eaf4;transform:translateY(-1px);}
.galerie-filter-btn.active{background:var(--accent,#1a6bb5);color:#fff;border-color:var(--accent,#1a6bb5);box-shadow:0 4px 14px rgba(26,107,181,.22);}
.filter-dot{width:8px;height:8px;border-radius:50%;display:inline-block;flex-shrink:0;}
.filter-count{background:rgba(0,0,0,.12);border-radius:20px;padding:1px 7px;font-size:.72rem;font-weight:700;}
.galerie-filter-btn.active .filter-count{background:rgba(255,255,255,.22);}

/* ── Notice fallback ── */
.galerie-notice{display:flex;align-items:center;gap:10px;background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:12px 18px;font-size:.84rem;color:#92400e;margin-bottom:24px;}
.galerie-notice a{color:#d97706;font-weight:600;}

/* ── Grille masonry ── */
.galerie-page-grid{columns:3;column-gap:14px;}
.galerie-page-item{break-inside:avoid;margin-bottom:14px;position:relative;overflow:hidden;border-radius:14px;cursor:pointer;background:#e8edf3;display:block;}
.galerie-page-item img{width:100%;display:block;object-fit:cover;transition:transform .4s ease;border-radius:14px;}
.galerie-page-item:hover img{transform:scale(1.06);}
.galerie-page-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(5,12,25,.72) 0%,transparent 55%);opacity:0;transition:opacity .3s;border-radius:14px;display:flex;flex-direction:column;align-items:center;justify-content:center;}
.galerie-page-item:hover .galerie-page-overlay{opacity:1;}
.galerie-page-zoom{width:46px;height:46px;background:rgba(247,148,29,.9);border-radius:50%;display:flex;align-items:center;justify-content:center;transform:scale(.75);transition:transform .25s;flex-shrink:0;}
.galerie-page-item:hover .galerie-page-zoom{transform:scale(1);}
.galerie-page-info{position:absolute;bottom:14px;left:14px;right:14px;display:flex;flex-direction:column;gap:4px;}
.galerie-page-cat{display:inline-block;padding:3px 10px;border-radius:30px;font-size:.68rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.06em;width:fit-content;}
.galerie-page-caption{color:#fff;font-size:.78rem;font-weight:500;margin:0;text-shadow:0 1px 4px rgba(0,0,0,.5);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}

/* ── Vide ── */
.galerie-empty{text-align:center;padding:80px 20px;color:#94a3b8;}
.galerie-empty-icon{width:80px;height:80px;background:#f0f4f8;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;color:#cbd5e1;}
.galerie-empty h3{color:#475569;font-size:1.15rem;margin-bottom:8px;}

/* ── Lightbox ── */
.lightbox-page{display:none;position:fixed;inset:0;z-index:99999;background:rgba(5,12,25,.95);align-items:center;justify-content:center;backdrop-filter:blur(10px);}
.lightbox-page.active{display:flex;}
.lightbox-content{max-width:92vw;max-height:90vh;display:flex;flex-direction:column;align-items:center;gap:14px;animation:lb-in .22s ease;}
@keyframes lb-in{from{opacity:0;transform:scale(.95)}to{opacity:1;transform:scale(1)}}
.lightbox-img{max-width:90vw;max-height:78vh;border-radius:12px;object-fit:contain;box-shadow:0 20px 80px rgba(0,0,0,.7);}
.lb-meta{display:flex;flex-direction:column;align-items:center;gap:6px;min-height:44px;}
.lb-cat-badge{display:inline-block;padding:3px 12px;border-radius:30px;font-size:.7rem;font-weight:700;color:#fff;text-transform:uppercase;letter-spacing:.07em;}
.lightbox-caption{color:rgba(255,255,255,.8);font-size:.88rem;text-align:center;margin:0;}
.lightbox-counter{color:rgba(255,255,255,.4);font-size:.75rem;}
.lb-close{position:absolute;top:18px;right:22px;background:rgba(255,255,255,.1);border:none;width:44px;height:44px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s;z-index:2;}
.lb-close:hover{background:rgba(255,255,255,.22);}
.lb-prev,.lb-next{position:absolute;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.1);border:none;width:52px;height:52px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s;}
.lb-prev{left:18px;}.lb-next{right:18px;}
.lb-prev:hover,.lb-next:hover{background:rgba(247,148,29,.5);}

@media(max-width:900px){.galerie-page-grid{columns:2;}}
@media(max-width:560px){.galerie-page-grid{columns:1;}.lb-prev{left:6px;}.lb-next{right:6px;}.galerie-filter-btn{padding:8px 14px;font-size:.82rem;}}
</style>

<script>
(function(){
  var PHOTOS = <?php
    $js = [];
    foreach ($photos as $p) {
        $src = (strpos($p['image'],'http')===0) ? $p['image'] : SITE_URL.'/'.ltrim($p['image'],'/');
        $cat = $p['categorie'] ?? 'general';
        $js[] = [
            'src'    => $src,
            'alt'    => $p['titre'] ?? '',
            'desc'   => $p['description'] ?? '',
            'cat'    => $cat,
            'couleur'=> $couleurs[$cat] ?? '#1a6bb5',
            'label'  => $labels[$cat] ?? '',
        ];
    }
    echo json_encode($js, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
  ?>;
  var idx=0;

  window.ouvrirLbPage=function(i){
    if(!PHOTOS.length)return;
    idx=i; afficher();
    document.getElementById('lightboxPage').classList.add('active');
    document.body.style.overflow='hidden';
    document.addEventListener('keydown',onKey);
  };
  window.fermerLbPage=function(e,force){
    if(force||e&&e.target===document.getElementById('lightboxPage')){
      document.getElementById('lightboxPage').classList.remove('active');
      document.body.style.overflow='';
      document.removeEventListener('keydown',onKey);
    }
  };
  window.changerLbPage=function(d){idx=(idx+d+PHOTOS.length)%PHOTOS.length;afficher();};

  function afficher(){
    var p=PHOTOS[idx];
    var img=document.getElementById('lbImg');
    img.style.opacity='0';
    setTimeout(function(){img.src=p.src;img.alt=p.alt;img.style.transition='opacity .18s';img.style.opacity='1';},90);
    var cat=document.getElementById('lbCat');
    cat.textContent=p.label;cat.style.background=p.couleur;
    cat.style.display=p.label?'inline-block':'none';
    document.getElementById('lbCaption').textContent=p.alt||p.desc;
    document.getElementById('lbCounter').textContent=(idx+1)+' / '+PHOTOS.length;
  }
  function onKey(e){
    if(e.key==='ArrowRight')changerLbPage(1);
    if(e.key==='ArrowLeft')changerLbPage(-1);
    if(e.key==='Escape')fermerLbPage(null,true);
  }
  /* Swipe tactile */
  var tx=0;
  var lb=document.getElementById('lightboxPage');
  lb.addEventListener('touchstart',function(e){tx=e.touches[0].clientX;},{passive:true});
  lb.addEventListener('touchend',function(e){
    var dx=e.changedTouches[0].clientX-tx;
    if(Math.abs(dx)>50)changerLbPage(dx<0?1:-1);
  },{passive:true});
})();
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
