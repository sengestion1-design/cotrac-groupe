<!-- COTRAC - Carte interactive Senegal - 14 Regions -->

<section class="carto-section" id="section-carte">
  <div class="container" style="text-align:center;">
    <span class="section-tag" style="border-color:#1a6bb5;color:#1a6bb5;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
      Couverture Nationale
    </span>
    <h2 class="section-title" style="margin-top:12px;">
      <span style="color:var(--orange,#f7941d);">14 Régions</span> Couvertes
    </h2>
    <p class="section-sub" style="max-width:520px;margin:0 auto 40px;">
      COTRAC intervient dans chacune des 14 régions administratives du Sénégal,
      de Dakar à Kédougou, avec des équipes terrain déployées en permanence.
    </p>

    <div class="carto-wrapper">
      <div class="carto-legend">
        <span class="carto-legend-dot" style="background:#1a6bb5;"></span> Région couverte
        <span style="width:20px;display:inline-block;"></span>
        <span class="carto-legend-dot" style="background:#f7941d;"></span> Survolée / Sélectionnée
      </div>

      <!-- Tooltip -->
      <div class="carto-tooltip" id="carto-tooltip"></div>

      <!-- Carte : wrapper 3D + image PNG + zones cliquables SVG -->
      <div class="carto-3d-wrap">
      <div class="carto-map-container" id="carto-map-container">

        <!-- Image de référence officielle -->
        <img
          src="<?= SITE_URL ?>/PHOTOCOTRAC/senegal.png"
          alt="Carte du Sénégal - 14 régions"
          class="carto-img"
          id="carto-img"
          draggable="false"
        />

        <!-- SVG overlay transparent avec zones cliquables -->
        <svg
          id="senegal-map"
          viewBox="0 0 790 612"
          xmlns="http://www.w3.org/2000/svg"
          class="carto-svg-overlay"
          aria-hidden="true"
        >
          <!-- Les zones sont des ellipses/polygones approximatifs positionnés
               par-dessus chaque région de l'image PNG.
               Couleurs appliquées via JS au hover/clic (mix-blend-mode: multiply) -->

          <!-- Saint-Louis (nord, grande bande violette dans l'image) -->
          <ellipse class="region" id="reg-saint-louis" data-name="Saint-Louis"
            cx="310" cy="110" rx="185" ry="95"/>

          <!-- Matam (nord-est, bleu ciel) -->
          <ellipse class="region" id="reg-matam" data-name="Matam"
            cx="570" cy="155" rx="145" ry="115"/>

          <!-- Louga (centre-nord, vert) -->
          <ellipse class="region" id="reg-louga" data-name="Louga"
            cx="230" cy="225" rx="130" ry="105"/>

          <!-- Tambacounda (est, marron, tres grand) -->
          <ellipse class="region" id="reg-tambacounda" data-name="Tambacounda"
            cx="545" cy="355" rx="175" ry="155"/>

          <!-- Kedougou (extreme sud-est, jaune) -->
          <ellipse class="region" id="reg-kedougou" data-name="Kédougou"
            cx="660" cy="490" rx="75" ry="65"/>

          <!-- Diourbel (centre, vert fonce) -->
          <ellipse class="region" id="reg-diourbel" data-name="Diourbel"
            cx="248" cy="295" rx="62" ry="48"/>

          <!-- Thies (orange dans image) -->
          <ellipse class="region" id="reg-thies" data-name="Thiès"
            cx="135" cy="290" rx="70" ry="72"/>

          <!-- Dakar (presqu'ile, tres petit) -->
          <ellipse class="region" id="reg-dakar" data-name="Dakar"
            cx="55" cy="300" rx="32" ry="28"/>

          <!-- Kaolack (mauve/violet, bord Gambie) -->
          <ellipse class="region" id="reg-kaolack" data-name="Kaolack"
            cx="195" cy="375" rx="68" ry="58"/>

          <!-- Kaffrine (rose, centre) -->
          <ellipse class="region" id="reg-kaffrine" data-name="Kaffrine"
            cx="310" cy="350" rx="80" ry="68"/>

          <!-- Fatick (bleu navy, Sine-Saloum) -->
          <ellipse class="region" id="reg-fatick" data-name="Fatick"
            cx="135" cy="368" rx="60" ry="65"/>

          <!-- Ziguinchor (rose fushia, Casamance ouest) -->
          <ellipse class="region" id="reg-ziguinchor" data-name="Ziguinchor"
            cx="118" cy="490" rx="78" ry="58"/>

          <!-- Sedhiou (vert olive, Casamance centre) -->
          <ellipse class="region" id="reg-sedhiou" data-name="Sédhiou"
            cx="248" cy="478" rx="68" ry="52"/>

          <!-- Kolda (kaki, Casamance est) -->
          <ellipse class="region" id="reg-kolda" data-name="Kolda"
            cx="375" cy="470" rx="85" ry="52"/>

        </svg>
      </div><!-- /.carto-map-container -->
      </div><!-- /.carto-3d-wrap -->

      <div class="carto-counter">
        <span class="carto-count">14</span> régions &middot;
        <span class="carto-count">14</span> couvertes &middot;
        <span class="carto-count">100%</span> du territoire
      </div>
    </div>
  </div>
</section>

<style>
.carto-section {
  padding: 5rem 0;
  background: #f4f8fd;
}
.carto-wrapper {
  max-width: 680px;
  margin: 0 auto;
  position: relative;
}
.carto-legend {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  font-size: .78rem;
  color: #6b7280;
  font-weight: 500;
  margin-bottom: 16px;
  font-family: 'Poppins', sans-serif;
}
.carto-legend-dot {
  display: inline-block;
  width: 10px; height: 10px;
  border-radius: 50%;
}

/* Wrapper 3D : porte la perspective ET le transform */
.carto-3d-wrap {
  perspective: 900px;
  perspective-origin: 50% 30%;
  /* Effet plateau incline au repos */
  transform: rotateX(6deg) scale(0.97);
  transform-style: preserve-3d;
  transition: transform 0.55s cubic-bezier(0.23,1,0.32,1), box-shadow 0.55s ease;
  will-change: transform;
  border-radius: 22px;
  box-shadow:
    0 30px 70px rgba(26,107,181,0.38),
    0 10px 24px rgba(0,0,0,0.18);
}
/* hover géré par JS — pas de règle CSS ici */

/* Conteneur : clip + fond, PAS de transform */
.carto-map-container {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  background: #1a6bb5;
  display: block;
  width: 100%;
  isolation: isolate;
}

/* Image PNG = la vraie carte, fond blanc rendu transparent par CSS */
.carto-img {
  display: block;
  width: 100%;
  height: auto;
  user-select: none;
  -webkit-user-drag: none;
  /* mix-blend-mode screen : le blanc devient transparent, les couleurs restent */
  mix-blend-mode: screen;
  filter: grayscale(1) brightness(2.2) contrast(1.8) invert(1);
}
/* Fond bleu COTRAC sous l'image */
.carto-map-container {
  background: #1a6bb5 !important;
}
/* SVG overlay : exactement superpose sur l'image */
.carto-svg-overlay {
  position: absolute;
  inset: 0;
  width: 100%;
  z-index: 2;
  height: 100%;
}

/* Regions : transparentes par defaut, colorees au hover/clic */
#section-carte .region {
  fill: transparent;
  stroke: transparent;
  cursor: pointer;
  transition: fill 0.22s ease, filter 0.22s ease, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
  transform-box: fill-box;
  transform-origin: center;
}
#section-carte .region:hover {
  fill: rgba(247, 148, 29, 0.4);
  stroke: #f7941d;
  stroke-width: 2;
  filter: drop-shadow(0 6px 16px rgba(247,148,29,0.6));
  transform: scale(1.05);
}
#section-carte .region.clicked {
  fill: rgba(255,255,255, 0.22);
  stroke: #fff;
  stroke-width: 2.5;
  filter: drop-shadow(0 0 18px rgba(255,255,255,0.8)) drop-shadow(0 0 6px rgba(247,148,29,0.9));
  transform: scale(1.07);
  animation: region-pulse 1.8s ease-in-out infinite;
}
@keyframes region-pulse {
  0%, 100% { filter: drop-shadow(0 0 18px rgba(255,255,255,0.8)) drop-shadow(0 0 6px rgba(247,148,29,0.9)); }
  50%       { filter: drop-shadow(0 0 28px rgba(255,255,255,1))   drop-shadow(0 0 14px rgba(247,148,29,1)); }
}

/* Tooltip avec bounce */
@keyframes tooltip-bounce {
  0%   { transform: translateY(8px) scale(0.85); opacity:0; }
  60%  { transform: translateY(-3px) scale(1.05); opacity:1; }
  100% { transform: translateY(0) scale(1); opacity:1; }
}
.carto-tooltip {
  position: fixed;
  background: linear-gradient(135deg, #1a3a5c, #1a6bb5);
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-size: .78rem;
  font-weight: 600;
  padding: 8px 16px;
  border-radius: 10px;
  pointer-events: none;
  white-space: nowrap;
  opacity: 0;
  transform: translateY(8px);
  transition: opacity 0.15s ease, transform 0.15s ease;
  z-index: 9999;
  box-shadow: 0 4px 16px rgba(0,0,0,0.25);
}
.carto-tooltip.visible {
  animation: tooltip-bounce 0.35s cubic-bezier(0.34,1.56,0.64,1) forwards;
}

/* Compteur */
.carto-counter {
  margin-top: 14px;
  font-family: 'Poppins', sans-serif;
  font-size: .82rem;
  color: #6b7280;
  text-align: center;
}
.carto-count {
  font-weight: 700;
  color: #1a6bb5;
}

@media (max-width: 480px) {
  .carto-wrapper { max-width: 100%; padding: 0 8px; }
}
</style>

<script>
(function () {
  var regions = document.querySelectorAll('#senegal-map .region');
  var tooltip = document.getElementById('carto-tooltip');
  var active  = null;

  if (!regions.length || !tooltip) return;

  function showTooltip(e, name) {
    tooltip.textContent = name;
    tooltip.classList.add('visible');
    moveTooltip(e);
  }
  function moveTooltip(e) {
    var clientX = e.clientX || (e.touches && e.touches[0].clientX) || 0;
    var clientY = e.clientY || (e.touches && e.touches[0].clientY) || 0;
    tooltip.style.left = (clientX - tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top  = (clientY - tooltip.offsetHeight - 14) + 'px';
  }
  function hideTooltip() {
    tooltip.classList.remove('visible');
  }

  regions.forEach(function (region) {
    var name = region.getAttribute('data-name');

    region.addEventListener('mouseenter', function (e) { showTooltip(e, name); });
    region.addEventListener('mousemove', moveTooltip);
    region.addEventListener('mouseleave', hideTooltip);

    region.addEventListener('click', function () {
      if (active === region) {
        region.classList.remove('clicked');
        active = null;
      } else {
        if (active) active.classList.remove('clicked');
        region.classList.add('clicked');
        active = region;
      }
    });

    region.addEventListener('touchstart', function (e) {
      e.preventDefault();
      showTooltip(e.touches[0], name);
      if (active === region) {
        region.classList.remove('clicked');
        active = null;
      } else {
        if (active) active.classList.remove('clicked');
        region.classList.add('clicked');
        active = region;
      }
      setTimeout(hideTooltip, 2000);
    }, { passive: false });
  });

  /* ---- Tilt 3D carte entiere au mouvement souris ---- */
  /* Le wrapper 3D porte le transform; le container interieur gere juste le clip */
  var wrap3d = document.querySelector('.carto-3d-wrap');
  if (wrap3d && window.innerWidth > 768) {
    wrap3d.addEventListener('mousemove', function (e) {
      var rect = wrap3d.getBoundingClientRect();
      var cx   = rect.left + rect.width  / 2;
      var cy   = rect.top  + rect.height / 2;
      var dx   = (e.clientX - cx) / (rect.width  / 2);
      var dy   = (e.clientY - cy) / (rect.height / 2);
      var rotX = -dy * 8;
      var rotY =  dx * 6;
      wrap3d.style.transform =
        'perspective(900px) rotateX(' + rotX + 'deg) rotateY(' + rotY + 'deg) scale(1.02)';
      wrap3d.style.boxShadow =
        (-dx * 14) + 'px ' + (-dy * 14 + 28) + 'px 60px rgba(26,107,181,0.45)';
    });
    wrap3d.addEventListener('mouseleave', function () {
      wrap3d.style.transform = '';
      wrap3d.style.boxShadow = '';
    });
  }
})();
</script>
