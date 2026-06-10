<?php
/**
 * Galerie photo lightbox réutilisable
 * Usage : $galerie_photos = [['src'=>'...','alt'=>'...','caption'=>'...'], ...];
 *         $galerie_titre = 'Photos de chantier';
 *         require 'includes/galerie.php';
 */
if (empty($galerie_photos)) return;
$galerie_titre = $galerie_titre ?? 'Galerie photos';
$galerie_id    = 'galerie_' . substr(md5($galerie_titre), 0, 6);
?>

<!-- ═══════════════════════════════════════════════════════════
     GALERIE PHOTOS
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:#fff; padding-bottom:80px;">
  <div class="container">

    <div class="section-header animate-fade-up" style="margin-bottom:36px;">
      <span class="section-tag">Galerie</span>
      <h2 class="section-title" style="margin-top:8px;"><?= htmlspecialchars($galerie_titre, ENT_QUOTES) ?></h2>
    </div>

    <div class="galerie-grid" id="<?= $galerie_id ?>">
      <?php foreach ($galerie_photos as $i => $photo): ?>
      <div class="galerie-item animate-fade-up" style="transition-delay:<?= ($i % 6) * 60 ?>ms;"
           data-index="<?= $i ?>" onclick="ouvrirLightbox('<?= $galerie_id ?>', <?= $i ?>)">
        <img src="<?= SITE_URL ?>/<?= htmlspecialchars($photo['src'], ENT_QUOTES) ?>"
             alt="<?= htmlspecialchars($photo['alt'] ?? '', ENT_QUOTES) ?>"
             loading="lazy">
        <div class="galerie-item-overlay">
          <div class="galerie-item-zoom">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
          </div>
          <?php if (!empty($photo['caption'])): ?>
          <p class="galerie-item-caption"><?= htmlspecialchars($photo['caption'], ENT_QUOTES) ?></p>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ===== LIGHTBOX ===== -->
<div class="lightbox" id="lightbox" onclick="fermerLightbox(event)">
  <button class="lightbox-close" onclick="fermerLightbox(null, true)">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <button class="lightbox-prev" onclick="changerPhoto(-1)">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <div class="lightbox-content" onclick="event.stopPropagation()">
    <img class="lightbox-img" id="lightbox-img" src="" alt="">
    <div class="lightbox-caption" id="lightbox-caption"></div>
    <div class="lightbox-counter" id="lightbox-counter"></div>
  </div>
  <button class="lightbox-next" onclick="changerPhoto(1)">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>
</div>

<style>
/* ---- Grille galerie ---- */
.galerie-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 12px;
}
.galerie-grid .galerie-item:first-child { grid-column: span 2; grid-row: span 2; }

.galerie-item {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  cursor: pointer;
  aspect-ratio: 4/3;
  background: var(--gris-clair);
}
.galerie-item:first-child { aspect-ratio: unset; }

.galerie-item img {
  width: 100%; height: 100%; object-fit: cover; display: block;
  transition: transform .4s ease;
}
.galerie-item:hover img { transform: scale(1.07); }

.galerie-item-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,22,40,.6) 0%, rgba(10,22,40,.0) 50%);
  opacity: 0;
  transition: opacity .3s;
  display: flex; flex-direction: column;
  align-items: center; justify-content: center;
  gap: 8px;
}
.galerie-item:hover .galerie-item-overlay { opacity: 1; }

.galerie-item-zoom {
  width: 48px; height: 48px;
  background: rgba(247,148,29,.85);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  transform: scale(0.7);
  transition: transform .25s;
}
.galerie-item:hover .galerie-item-zoom { transform: scale(1); }

.galerie-item-caption {
  position: absolute; bottom: 12px; left: 12px; right: 12px;
  color: #fff; font-size: .78rem; font-weight: 500;
  text-shadow: 0 1px 4px rgba(0,0,0,.5);
}

/* ---- Lightbox ---- */
.lightbox {
  display: none; position: fixed; inset: 0; z-index: 99999;
  background: rgba(5,12,25,.94);
  align-items: center; justify-content: center;
  backdrop-filter: blur(8px);
}
.lightbox.active { display: flex; }

.lightbox-content {
  max-width: 90vw; max-height: 88vh;
  display: flex; flex-direction: column; align-items: center; gap: 12px;
  animation: lb-in .25s ease;
}
@keyframes lb-in { from { opacity:0; transform:scale(.95); } to { opacity:1; transform:scale(1); } }

.lightbox-img {
  max-width: 90vw; max-height: 78vh;
  border-radius: 12px; object-fit: contain;
  box-shadow: 0 24px 80px rgba(0,0,0,.6);
}
.lightbox-caption { color: rgba(255,255,255,.8); font-size: .88rem; text-align: center; }
.lightbox-counter { color: rgba(255,255,255,.45); font-size: .78rem; }

.lightbox-close {
  position: absolute; top: 20px; right: 24px;
  background: rgba(255,255,255,.12); border: none;
  width: 44px; height: 44px; border-radius: 50%;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: background .2s;
}
.lightbox-close:hover { background: rgba(255,255,255,.22); }

.lightbox-prev, .lightbox-next {
  position: absolute; top: 50%; transform: translateY(-50%);
  background: rgba(255,255,255,.12); border: none;
  width: 52px; height: 52px; border-radius: 50%;
  cursor: pointer; display: flex; align-items: center; justify-content: center;
  transition: background .2s;
}
.lightbox-prev { left: 20px; }
.lightbox-next { right: 20px; }
.lightbox-prev:hover, .lightbox-next:hover { background: rgba(247,148,29,.5); }

@media (max-width: 768px) {
  .galerie-grid { grid-template-columns: repeat(2, 1fr); }
  .galerie-grid .galerie-item:first-child { grid-column: span 2; aspect-ratio: 16/9; }
  .lightbox-prev { left: 8px; }
  .lightbox-next { right: 8px; }
}
</style>

<script>
(function() {
  let _photos = [], _idx = 0;

  window.ouvrirLightbox = function(galerieId, index) {
    const grid = document.getElementById(galerieId);
    _photos = Array.from(grid.querySelectorAll('.galerie-item')).map(el => ({
      src:     el.querySelector('img').src,
      alt:     el.querySelector('img').alt,
      caption: el.querySelector('.galerie-item-caption')?.textContent || ''
    }));
    _idx = index;
    afficher();
    document.getElementById('lightbox').classList.add('active');
    document.body.style.overflow = 'hidden';
    document.addEventListener('keydown', _keyHandler);
  };

  window.fermerLightbox = function(e, force) {
    if (force || e?.target === document.getElementById('lightbox')) {
      document.getElementById('lightbox').classList.remove('active');
      document.body.style.overflow = '';
      document.removeEventListener('keydown', _keyHandler);
    }
  };

  window.changerPhoto = function(dir) {
    _idx = (_idx + dir + _photos.length) % _photos.length;
    afficher();
  };

  function afficher() {
    const p = _photos[_idx];
    const img = document.getElementById('lightbox-img');
    img.style.opacity = '0';
    setTimeout(() => {
      img.src = p.src;
      img.alt = p.alt;
      img.style.transition = 'opacity .2s';
      img.style.opacity = '1';
    }, 100);
    document.getElementById('lightbox-caption').textContent = p.caption;
    document.getElementById('lightbox-counter').textContent = (_idx + 1) + ' / ' + _photos.length;
  }

  function _keyHandler(e) {
    if (e.key === 'ArrowRight') changerPhoto(1);
    if (e.key === 'ArrowLeft')  changerPhoto(-1);
    if (e.key === 'Escape')     fermerLightbox(null, true);
  }
})();
</script>
