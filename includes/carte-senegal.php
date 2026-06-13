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

      <!-- Carte : image PNG + zones cliquables SVG superposées -->
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
            cx="700" cy="450" rx="85" ry="80"/>

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
      </div>

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

/* Conteneur relatif pour superposer SVG sur image */
.carto-map-container {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 32px rgba(26,107,181,0.15);
  background: #fff;
  display: inline-block;
  width: 100%;
}

/* Image PNG = la vraie carte, teintee en bleu uniforme */
.carto-img {
  display: block;
  width: 100%;
  height: auto;
  user-select: none;
  -webkit-user-drag: none;
  /* Teinte bleue COTRAC : grayscale puis hue-rotate + saturate */
  filter: grayscale(1) sepia(1) hue-rotate(185deg) saturate(3) brightness(0.75);
}

/* SVG overlay : exactement superpose sur l'image */
.carto-svg-overlay {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}

/* Regions : transparentes par defaut, colorees au hover/clic */
#section-carte .region {
  fill: transparent;
  stroke: transparent;
  cursor: pointer;
  transition: fill 0.2s ease, filter 0.2s ease;
}
#section-carte .region:hover {
  fill: rgba(247, 148, 29, 0.45);
  stroke: #f7941d;
  stroke-width: 2;
  filter: drop-shadow(0 4px 12px rgba(247,148,29,0.5));
}
#section-carte .region.clicked {
  fill: rgba(26, 107, 181, 0.55);
  stroke: #1a6bb5;
  stroke-width: 2.5;
  filter: drop-shadow(0 8px 20px rgba(26,107,181,0.55));
  transform: scale(1.04);
  transform-box: fill-box;
  transform-origin: center;
}

/* Tooltip */
.carto-tooltip {
  position: fixed;
  background: #1a3a5c;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-size: .78rem;
  font-weight: 600;
  padding: 7px 14px;
  border-radius: 8px;
  pointer-events: none;
  white-space: nowrap;
  opacity: 0;
  transform: translateY(6px);
  transition: opacity 0.15s ease, transform 0.15s ease;
  z-index: 9999;
  box-shadow: 0 4px 16px rgba(0,0,0,0.25);
}
.carto-tooltip.visible {
  opacity: 1;
  transform: translateY(0);
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
})();
</script>
