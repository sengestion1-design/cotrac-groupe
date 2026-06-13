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

      <!-- Carte iso 3D : image PNG officielle COTRAC + SVG overlay zones cliquables -->
      <div class="carto-map-container" id="carto-map-container">

        <img
          src="<?= SITE_URL ?>/PHOTOCOTRAC/senegal2.PNG"
          alt="Carte du Sénégal - 14 régions COTRAC"
          class="carto-img"
          id="carto-img"
          draggable="false"
        />

        <!-- SVG overlay : viewBox cale sur les dimensions reelles 1536x1024 -->
        <svg
          id="senegal-map"
          viewBox="0 0 1536 1024"
          xmlns="http://www.w3.org/2000/svg"
          class="carto-svg-overlay"
          aria-hidden="true"
        >
          <!-- Saint-Louis : bande nord orange, large -->
          <ellipse class="region" id="reg-saint-louis" data-name="Saint-Louis"
            cx="430" cy="195" rx="215" ry="120"/>

          <!-- Matam : nord-est, bleu clair -->
          <ellipse class="region" id="reg-matam" data-name="Matam"
            cx="790" cy="255" rx="190" ry="130"/>

          <!-- Louga : centre-nord gauche, bleu -->
          <ellipse class="region" id="reg-louga" data-name="Louga"
            cx="270" cy="335" rx="155" ry="115"/>

          <!-- Diourbel : petit, centre -->
          <ellipse class="region" id="reg-diourbel" data-name="Diourbel"
            cx="335" cy="455" rx="80" ry="65"/>

          <!-- Thiès : côte nord-ouest -->
          <ellipse class="region" id="reg-thies" data-name="Thiès"
            cx="200" cy="435" rx="90" ry="80"/>

          <!-- Dakar : presqu'île extrême gauche, très petit -->
          <ellipse class="region" id="reg-dakar" data-name="Dakar"
            cx="90" cy="445" rx="48" ry="40"/>

          <!-- Tambacounda : très grand, centre-est bleu foncé -->
          <ellipse class="region" id="reg-tambacounda" data-name="Tambacounda"
            cx="840" cy="510" rx="230" ry="185"/>

          <!-- Kédougou : extrême sud-est orange -->
          <ellipse class="region" id="reg-kedougou" data-name="Kédougou"
            cx="1055" cy="670" rx="110" ry="90"/>

          <!-- Kaolack : centre-bas, orange -->
          <ellipse class="region" id="reg-kaolack" data-name="Kaolack"
            cx="330" cy="545" rx="90" ry="72"/>

          <!-- Kaffrine : centre, bleu -->
          <ellipse class="region" id="reg-kaffrine" data-name="Kaffrine"
            cx="490" cy="530" rx="105" ry="80"/>

          <!-- Fatick : côte, Sine-Saloum -->
          <ellipse class="region" id="reg-fatick" data-name="Fatick"
            cx="205" cy="545" rx="75" ry="75"/>

          <!-- Kolda : sud centre-est -->
          <ellipse class="region" id="reg-kolda" data-name="Kolda"
            cx="615" cy="710" rx="110" ry="72"/>

          <!-- Sédhiou : sud centre-ouest -->
          <ellipse class="region" id="reg-sedhiou" data-name="Sédhiou"
            cx="430" cy="730" rx="100" ry="68"/>

          <!-- Ziguinchor : extrême sud-ouest, orange -->
          <ellipse class="region" id="reg-ziguinchor" data-name="Ziguinchor"
            cx="240" cy="740" rx="110" ry="72"/>

        </svg>
      </div><!-- /.carto-map-container -->

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
  max-width: 760px;
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

/* Conteneur image : ombre douce pour renforcer l'effet 3D isométrique natif */
.carto-map-container {
  position: relative;
  display: block;
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
  background: transparent;
  box-shadow:
    0 32px 80px rgba(26,107,181,0.22),
    0 8px 24px rgba(0,0,0,0.12);
  transition: box-shadow 0.4s ease, transform 0.4s ease;
}
.carto-map-container:hover {
  box-shadow:
    0 40px 100px rgba(26,107,181,0.32),
    0 12px 32px rgba(0,0,0,0.16);
  transform: translateY(-4px);
}

/* Image iso 3D — on l'affiche telle quelle, sans filtre */
.carto-img {
  display: block;
  width: 100%;
  height: auto;
  user-select: none;
  -webkit-user-drag: none;
}

/* SVG overlay : exactement superposé sur l'image */
.carto-svg-overlay {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
}

/* Régions : invisibles par défaut, réactives au hover/clic */
#section-carte .region {
  fill: transparent;
  stroke: transparent;
  cursor: pointer;
  transition: fill 0.2s ease, stroke 0.2s ease, filter 0.2s ease, transform 0.28s cubic-bezier(0.34,1.56,0.64,1);
  transform-box: fill-box;
  transform-origin: center;
}
#section-carte .region:hover {
  fill: rgba(247, 148, 29, 0.35);
  stroke: #f7941d;
  stroke-width: 2.5;
  filter: drop-shadow(0 4px 18px rgba(247,148,29,0.65));
  transform: scale(1.04);
}
#section-carte .region.clicked {
  fill: rgba(247, 148, 29, 0.55);
  stroke: #fff;
  stroke-width: 3;
  filter: drop-shadow(0 0 20px rgba(247,148,29,0.95)) drop-shadow(0 0 8px rgba(255,255,255,0.7));
  transform: scale(1.06);
  animation: region-pulse 1.8s ease-in-out infinite;
}
@keyframes region-pulse {
  0%, 100% { filter: drop-shadow(0 0 18px rgba(247,148,29,0.9)) drop-shadow(0 0 6px rgba(255,255,255,0.6)); }
  50%       { filter: drop-shadow(0 0 30px rgba(247,148,29,1))   drop-shadow(0 0 14px rgba(255,255,255,0.9)); }
}

/* Tooltip */
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

@media (max-width: 600px) {
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
    tooltip.textContent = '📍 ' + name;
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
})();
</script>
