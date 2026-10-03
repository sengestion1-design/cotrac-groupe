<!-- COTRAC - « Le Sénégal s'allume » : carte 3D des 14 régions, réseau électrique animé 2015 → 2026 -->

<section class="carto-section" id="section-carte">
  <div class="container" style="text-align:center;">
    <span class="section-tag" style="border-color:#1a6bb5;color:#1a6bb5;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      Couverture Nationale
    </span>
    <h2 class="section-title" style="margin-top:12px;">
      <span style="color:var(--orange,#f7941d);">14 Régions</span> Couvertes
    </h2>
    <p class="section-sub" style="max-width:560px;margin:0 auto 32px;">
      COTRAC intervient dans chacune des 14 régions administratives du Sénégal,
      de Dakar à Kédougou. Suivez le déploiement du réseau électrique national et
      de nos équipes depuis 2015.
    </p>

    <div class="carto-wrapper">
      <div class="carto-legend">
        <span><span class="carto-legend-dot" style="background:#1a6bb5;"></span> Région raccordée</span>
        <span><span class="carto-legend-dot" style="background:#f7941d;box-shadow:0 0 8px #f7941d;"></span> Lignes HT/MT &amp; poteaux</span>
        <span><span class="carto-legend-dot" style="background:#ffd27a;box-shadow:0 0 8px #ffd27a;"></span> Ville éclairée</span>
        <span class="carto-legend-hint carto-hint-mouse">Glisser : déplacer · Clic droit ou Ctrl + glisser : pivoter · Ctrl + molette : zoom · Clic sur une région : détails</span>
        <span class="carto-legend-hint carto-hint-touch">Un doigt : pivoter · Deux doigts : déplacer / zoomer · Toucher une région : détails</span>
      </div>

      <div class="carto-tooltip" id="carto-tooltip"></div>

      <!-- Carte 3D (three.js). L'image officielle reste en secours si WebGL est indisponible. -->
      <div class="carto-map-container" id="carto-3d" data-scene="<?= SITE_URL ?>/assets/data/senegal-scene.json?v=4">
        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?= SITE_URL ?>/PHOTOCOTRAC/senegal2.PNG?v=2" alt="Carte du Sénégal - 14 régions COTRAC" class="carto-img" draggable="false" />
        <noscript><img src="<?= SITE_URL ?>/PHOTOCOTRAC/senegal2.PNG?v=2" alt="Carte du Sénégal - 14 régions COTRAC" class="carto-img" /></noscript>
        <div class="carto-badge">
          <img src="<?= SITE_URL ?>/assets/images/logo-cotrac.png" alt="COTRAC" />
        </div>
        <div class="carto-year-big" aria-hidden="true"><span id="carto-year-label">2015</span><span class="carto-hour" id="carto-hour">☀️ 08:00</span></div>
        <div class="carto-zoom" aria-label="Zoom">
          <button type="button" data-zoom="in" aria-label="Zoomer">+</button>
          <button type="button" data-zoom="out" aria-label="Dézoomer">−</button>
          <button type="button" data-zoom="home" aria-label="Vue d'ensemble">⌂</button>
        </div>
        <div class="carto-wheel-hint">Ctrl + molette pour zoomer</div>
        <!-- Panneau region (clic sur une region) -->
        <div class="carto-panel" id="carto-panel">
          <button type="button" class="carto-back" id="carto-back">← Vue d'ensemble</button>
          <div class="carto-panel-title">Région</div>
          <div class="carto-panel-year">Raccordée en —</div>
          <ul class="carto-panel-list"></ul>
          <a class="carto-panel-cta" href="<?= SITE_URL ?>/contact.php">Un projet dans cette région ? →</a>
        </div>
      </div>

      <div class="carto-controls">
        <button type="button" class="carto-play" id="carto-play" aria-label="Lecture de l'animation">▶ Lecture</button>
        <div class="carto-slider-wrap">
          <input type="range" id="carto-year" min="0" max="1000" value="0" step="1" aria-label="Année (2015 à 2026)" />
          <div class="carto-ticks"><span>2015</span><span>2018</span><span>2021</span><span>2024</span><span>2026</span></div>
        </div>
      </div>

      <div class="carto-counter">
        <span class="carto-count" id="carto-regions-count">14</span>/14 régions raccordées &middot;
        <span class="carto-count" id="carto-km">3 343</span> km de lignes &middot;
        <span class="carto-count">100%</span> du territoire couvert
      </div>
      <p class="carto-source">Limites régionales et réseau électrique : données © contributeurs OpenStreetMap (ODbL), complétées par les infrastructures SENELEC / OMVG connues. Chronologie indicative.</p>
    </div>
  </div>
</section>

<style>
.carto-section { padding: 5rem 0; background: #f4f8fd; }
.carto-wrapper { max-width: 860px; margin: 0 auto; position: relative; }
.carto-legend { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 6px 22px; font-size: .78rem; color: #6b7280; font-weight: 500; margin-bottom: 16px; font-family: 'Poppins', sans-serif; }
.carto-legend-dot { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 6px; vertical-align: -1px; }

.carto-map-container {
  position: relative; display: block; width: 100%; aspect-ratio: 16 / 10; border-radius: 18px; overflow: hidden;
  background: radial-gradient(120% 100% at 50% 0%, #143a66 0%, #0b1f38 60%, #071528 100%);
  box-shadow: 0 32px 80px rgba(26,107,181,0.25), 0 8px 24px rgba(0,0,0,0.14);
}
.carto-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; user-select: none; -webkit-user-drag: none; transition: opacity .6s ease; }
.carto-map-container.is-3d .carto-img { opacity: 0; pointer-events: none; }
.carto-map-container.is-fallback .carto-img { opacity: 1; }
.carto-canvas { position: absolute; inset: 0; width: 100% !important; height: 100% !important; display: block; }
.carto-badge { position: absolute; top: 14px; right: 16px; z-index: 3; background: rgba(255,255,255,.92); border-radius: 10px; padding: 6px 10px; box-shadow: 0 4px 14px rgba(0,0,0,.18); pointer-events: none; }
.carto-badge img { height: 26px; display: block; }
.carto-map-container { --carto-ink: #fff; }
.carto-year-big { position: absolute; left: 14px; top: 14px; z-index: 3; font-family: 'Poppins', sans-serif; font-weight: 800; font-size: clamp(2rem, 6vw, 3.4rem); color: #fff; letter-spacing: .02em; text-shadow: 0 2px 14px rgba(0,0,0,.45); pointer-events: none; line-height: 1; padding: 10px 16px 10px 14px; border-radius: 14px; background: rgba(8,18,36,.42); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); }
.carto-hour { display: block; font-size: .8rem; font-weight: 600; letter-spacing: .1em; margin-top: 4px; opacity: .85; }
.carto-year-big::after { content: 'LE SÉNÉGAL S’ALLUME'; display: block; font-size: .62rem; font-weight: 600; letter-spacing: .28em; color: #f7941d; margin-top: 6px; }
.carto-map-container.is-fallback .carto-year-big, .carto-map-container:not(.is-3d) .carto-year-big { display: none; }

.carto-zoom { position: absolute; left: 16px; bottom: 16px; z-index: 4; display: flex; flex-direction: column; gap: 4px; }
.carto-zoom button { width: 34px; height: 34px; border: 0; border-radius: 9px; background: rgba(255,255,255,.92); color: #0f2a4a; font: 700 18px/1 'Poppins', sans-serif; cursor: pointer; box-shadow: 0 4px 14px rgba(0,0,0,.3); transition: .15s; }
.carto-zoom button:hover { background: #f7941d; color: #fff; }
.carto-wheel-hint { position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%); z-index: 5; background: rgba(10,20,40,.85); color: #fff; font: 600 .8rem 'Poppins', sans-serif; padding: 10px 18px; border-radius: 999px; opacity: 0; pointer-events: none; transition: opacity .25s; }
.carto-wheel-hint.show { opacity: 1; }
.carto-map-container:not(.is-3d) .carto-zoom { display: none; }
@media (hover: none) { .carto-wheel-hint { display: none; } }
.carto-panel { position: absolute; right: 16px; bottom: 16px; z-index: 4; width: 250px; max-width: calc(100% - 32px); background: rgba(255,255,255,.96); border-radius: 14px; padding: 14px 16px; box-shadow: 0 12px 36px rgba(0,0,0,.35); text-align: left; font-family: 'Poppins', sans-serif; transform: translateY(14px); opacity: 0; pointer-events: none; transition: .35s cubic-bezier(.2,.8,.2,1); }
.carto-panel.open { transform: none; opacity: 1; pointer-events: auto; }
.carto-back { font: 600 .72rem 'Poppins', sans-serif; color: #1a6bb5; background: none; border: 0; padding: 0; cursor: pointer; margin-bottom: 8px; }
.carto-back:hover { text-decoration: underline; }
.carto-panel-title { font-weight: 800; font-size: 1.05rem; color: #0f2a4a; }
.carto-panel-year { font-size: .74rem; color: #f7941d; font-weight: 600; margin: 2px 0 8px; }
.carto-panel-list { margin: 0 0 10px; padding-left: 16px; font-size: .76rem; color: #374151; line-height: 1.5; }
.carto-panel-cta { display: inline-block; font-size: .72rem; font-weight: 600; color: #fff; background: #f7941d; border-radius: 999px; padding: 7px 12px; text-decoration: none; }
.carto-legend-hint { color: #f7941d; font-weight: 600; }
.carto-hint-touch { display: none; }
@media (hover: none) { .carto-hint-mouse { display: none; } .carto-hint-touch { display: inline; } }
.carto-map-container:not(.is-3d) ~ * .carto-legend-hint { display: none; }
@media (max-width: 600px) { .carto-panel { right: 8px; bottom: 8px; left: 8px; width: auto; }
  .carto-year-big { font-size: 1.45rem; padding: 7px 10px 6px; left: 8px; top: 8px; border-radius: 10px; }
  .carto-hour { font-size: .62rem; margin-top: 2px; }
  .carto-year-big::after { font-size: .5rem; letter-spacing: .18em; margin-top: 3px; }
  .carto-zoom { left: auto; right: 8px; top: 54px; bottom: auto; }
  .carto-zoom button { width: 28px; height: 28px; font-size: 15px; border-radius: 7px; }
  .carto-badge { top: 8px; right: 8px; padding: 4px 7px; } .carto-badge img { height: 18px; } }
.carto-controls { display: flex; align-items: center; gap: 14px; margin-top: 16px; font-family: 'Poppins', sans-serif; }
.carto-play { flex: none; font: 600 .78rem/1 'Poppins', sans-serif; letter-spacing: .04em; color: #fff; background: #1a6bb5; border: 0; border-radius: 999px; padding: 11px 18px; cursor: pointer; transition: background .2s, transform .15s; min-width: 108px; }
.carto-play:hover { background: #155a99; transform: translateY(-1px); }
.carto-play.on { background: #f7941d; }
.carto-slider-wrap { flex: 1; min-width: 0; }
#carto-year { width: 100%; -webkit-appearance: none; appearance: none; height: 24px; background: transparent; cursor: pointer; margin: 0; }
#carto-year::-webkit-slider-runnable-track { height: 6px; border-radius: 6px; background: linear-gradient(90deg, #1a6bb5, #f7941d); }
#carto-year::-moz-range-track { height: 6px; border-radius: 6px; background: linear-gradient(90deg, #1a6bb5, #f7941d); }
#carto-year::-webkit-slider-thumb { -webkit-appearance: none; width: 20px; height: 20px; border-radius: 50%; background: #fff; border: 3px solid #f7941d; margin-top: -7px; box-shadow: 0 2px 8px rgba(0,0,0,.25); }
#carto-year::-moz-range-thumb { width: 14px; height: 14px; border-radius: 50%; background: #fff; border: 3px solid #f7941d; box-shadow: 0 2px 8px rgba(0,0,0,.25); }
.carto-ticks { display: flex; justify-content: space-between; font-size: .68rem; color: #9aa3b2; margin-top: 2px; }

.carto-tooltip { position: fixed; background: linear-gradient(135deg, #1a3a5c, #1a6bb5); color: #fff; font-family: 'Poppins', sans-serif; font-size: .78rem; font-weight: 600; padding: 8px 16px; border-radius: 10px; pointer-events: none; white-space: nowrap; opacity: 0; z-index: 9999; box-shadow: 0 4px 16px rgba(0,0,0,0.25); transition: opacity .15s; }
.carto-tooltip.visible { opacity: 1; }

.carto-counter { margin-top: 14px; font-family: 'Poppins', sans-serif; font-size: .82rem; color: #6b7280; text-align: center; }
.carto-count { font-weight: 700; color: #1a6bb5; font-variant-numeric: tabular-nums; }
.carto-source { margin-top: 6px; font-size: .66rem; color: #a0a8b5; text-align: center; }

@media (max-width: 600px) {
  .carto-wrapper { max-width: 100%; padding: 0 8px; }
  .carto-map-container { aspect-ratio: 4 / 3; border-radius: 14px; }
  .carto-badge img { height: 20px; }
  .carto-controls { flex-direction: column; align-items: stretch; }
}
</style>

<script>
// Diagnostic : ajouter ?debug=1 a l'adresse pour afficher les erreurs de la carte 3D directement dans la page (utile sur telephone).
(function(){ if (!/[?&]debug=1/.test(location.search)) return;
  var box = document.createElement('pre'); box.id = 'carto-debug'; box.style.cssText = 'position:fixed;left:0;right:0;bottom:0;z-index:99999;max-height:45vh;overflow:auto;margin:0;padding:10px;background:#111;color:#0f0;font:12px/1.4 monospace;white-space:pre-wrap';
  box.textContent = 'carto debug — UA: ' + navigator.userAgent + '\nwebgl2: ' + !!document.createElement('canvas').getContext('webgl2') + ' | webgl: ' + !!document.createElement('canvas').getContext('webgl') + '\n';
  document.addEventListener('DOMContentLoaded', function(){ document.body.appendChild(box); });
  window.cartoDebug = function(m){ box.textContent += '• ' + m + '\n'; };
  window.addEventListener('error', function(e){ window.cartoDebug('error: ' + (e.message || e) + ' @ ' + (e.filename || '') + ':' + (e.lineno || '')); });
  window.addEventListener('unhandledrejection', function(e){ window.cartoDebug('rejection: ' + (e.reason && (e.reason.stack || e.reason.message) || e.reason)); });
  setTimeout(function(){ var c = document.getElementById('carto-3d'); window.cartoDebug('etat apres 3 s : ' + (c ? c.className : 'pas de conteneur')); }, 3000);
  setTimeout(function(){ var c = document.getElementById('carto-3d'); window.cartoDebug('etat apres 8 s : ' + (c ? c.className : 'pas de conteneur')); }, 8000);
})();
</script>
<script>
// Garde-fou hors module : si la 3D n'est pas prete 12 s apres le chargement (module non execute, WebGL bloque...), on affiche la carte image.
(function(){ function fb(){ var c = document.getElementById('carto-3d'); if (!c || c.classList.contains('is-3d')) return; c.classList.add('is-fallback'); var im = c.querySelector('img.carto-img'); if (im && im.getAttribute('data-src')) im.src = im.getAttribute('data-src'); if (window.cartoDebug) window.cartoDebug('garde-fou hors module : secours affiche'); }
  if (document.readyState === 'complete') setTimeout(fb, 12000); else window.addEventListener('load', function(){ setTimeout(fb, 12000); }); })();
</script>
<script>
// Les erreurs de chargement d'un <script type="module"> (404, reseau coupe, timeout...) ne remontent pas
// toujours a window.onerror sur WebKit/iOS — on ecoute directement l'evenement error/load de la balise.
(function(){
  var s = document.createElement('script');
  s.type = 'module';
  s.src = '<?= SITE_URL ?>/assets/js/carte-senegal-3d.js?v=42';
  s.addEventListener('error', function(){ if (window.cartoDebug) window.cartoDebug('ECHEC chargement du fichier module carte-senegal-3d.js (reseau/404)'); });
  s.addEventListener('load', function(){ if (window.cartoDebug) window.cartoDebug('fichier module carte-senegal-3d.js charge (balise script)'); });
  document.head.appendChild(s);
})();
</script>
