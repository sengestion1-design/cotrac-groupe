<!-- COTRAC - Carte SVG Senegal - 14 Regions -->

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

      <div class="carto-map-container">
        <!-- Tooltip -->
        <div class="carto-tooltip" id="carto-tooltip"></div>

        <svg
          id="senegal-map"
          viewBox="0 0 800 600"
          xmlns="http://www.w3.org/2000/svg"
          class="carto-svg"
          aria-label="Carte du Sénégal - 14 régions couvertes par COTRAC"
          role="img"
          style="perspective: 800px;"
        >
          <defs>
            <filter id="region-shadow" x="-10%" y="-10%" width="120%" height="120%">
              <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(26,107,181,0.25)" />
            </filter>
            <filter id="region-shadow-hover" x="-20%" y="-20%" width="140%" height="140%">
              <feDropShadow dx="0" dy="5" stdDeviation="8" flood-color="rgba(247,148,29,0.50)" />
            </filter>
            <filter id="region-shadow-click" x="-25%" y="-25%" width="150%" height="150%">
              <feDropShadow dx="0" dy="12" stdDeviation="12" flood-color="rgba(26,107,181,0.50)" />
            </filter>
          </defs>

          <!-- Saint-Louis (nord, grande bande horizontale) -->
          <path
            class="region"
            id="reg-saint-louis"
            data-name="Saint-Louis"
            d="M 290 20 L 560 20 L 580 30 L 590 55 L 585 90 L 565 115 L 540 130 L 510 140 L 480 145 L 450 142 L 420 135 L 395 125 L 370 118 L 345 125 L 320 135 L 300 145 L 278 138 L 262 120 L 255 95 L 258 65 L 270 40 Z"
          />

          <!-- Matam (nord-est, grand) -->
          <path
            class="region"
            id="reg-matam"
            data-name="Matam"
            d="M 560 20 L 720 20 L 740 35 L 755 60 L 752 95 L 738 125 L 715 148 L 688 162 L 658 170 L 625 172 L 595 165 L 568 152 L 548 138 L 535 120 L 530 98 L 535 72 L 548 48 Z"
          />

          <!-- Louga (centre-nord, grande) -->
          <path
            class="region"
            id="reg-louga"
            data-name="Louga"
            d="M 178 95 L 210 85 L 245 82 L 278 88 L 310 100 L 338 118 L 350 140 L 348 168 L 338 192 L 318 210 L 292 222 L 262 228 L 232 225 L 205 215 L 182 198 L 165 178 L 158 155 L 160 128 Z"
          />

          <!-- Tambacounda (est, tres grande region) -->
          <path
            class="region"
            id="reg-tambacounda"
            data-name="Tambacounda"
            d="M 490 165 L 535 160 L 570 168 L 605 182 L 638 202 L 665 228 L 682 258 L 688 292 L 682 328 L 665 358 L 640 380 L 608 395 L 572 402 L 535 398 L 500 385 L 470 365 L 448 340 L 432 310 L 425 278 L 425 245 L 432 215 L 448 190 L 468 175 Z"
          />

          <!-- Kedougou (extreme sud-est, coin) -->
          <path
            class="region"
            id="reg-kedougou"
            data-name="Kédougou"
            d="M 640 380 L 670 368 L 700 355 L 725 338 L 742 315 L 752 288 L 752 260 L 742 235 L 725 215 L 705 202 L 688 195 L 688 258 L 682 292 L 665 328 L 648 358 Z"
          />

          <!-- Diourbel (centre, petit) -->
          <path
            class="region"
            id="reg-diourbel"
            data-name="Diourbel"
            d="M 232 225 L 268 222 L 300 228 L 322 242 L 332 262 L 328 282 L 312 298 L 290 308 L 265 310 L 242 302 L 225 285 L 218 265 L 220 245 Z"
          />

          <!-- Thies (ouest) -->
          <path
            class="region"
            id="reg-thies"
            data-name="Thiès"
            d="M 148 175 L 182 168 L 210 172 L 228 190 L 232 215 L 218 238 L 202 255 L 180 265 L 155 268 L 132 258 L 115 240 L 110 218 L 118 198 Z"
          />

          <!-- Dakar (presqu'ile, tres petit coin ouest) -->
          <path
            class="region"
            id="reg-dakar"
            data-name="Dakar"
            d="M 90 195 L 115 185 L 125 198 L 128 218 L 120 235 L 105 245 L 88 242 L 75 228 L 72 212 Z"
          />

          <!-- Kaolack (centre) -->
          <path
            class="region"
            id="reg-kaolack"
            data-name="Kaolack"
            d="M 262 308 L 298 305 L 328 315 L 348 335 L 352 360 L 340 382 L 318 395 L 292 400 L 265 392 L 245 375 L 238 350 L 242 325 Z"
          />

          <!-- Kaffrine (centre) -->
          <path
            class="region"
            id="reg-kaffrine"
            data-name="Kaffrine"
            d="M 330 282 L 365 278 L 398 288 L 420 308 L 425 335 L 415 358 L 395 375 L 368 382 L 340 378 L 318 362 L 312 338 L 318 312 Z"
          />

          <!-- Fatick (centre-ouest, Sine-Saloum) -->
          <path
            class="region"
            id="reg-fatick"
            data-name="Fatick"
            d="M 155 268 L 195 265 L 228 272 L 248 290 L 252 315 L 240 338 L 218 352 L 192 358 L 165 352 L 142 335 L 132 312 L 135 288 Z"
          />

          <!-- Ziguinchor (sud-ouest, Casamance) -->
          <path
            class="region"
            id="reg-ziguinchor"
            data-name="Ziguinchor"
            d="M 95 442 L 130 432 L 162 430 L 190 438 L 208 458 L 210 482 L 195 500 L 168 512 L 138 515 L 108 508 L 85 490 L 75 468 Z"
          />

          <!-- Sedhiou (sud, Casamance centre) -->
          <path
            class="region"
            id="reg-sedhiou"
            data-name="Sédhiou"
            d="M 205 430 L 242 425 L 275 430 L 298 448 L 305 472 L 295 495 L 272 510 L 245 515 L 218 508 L 200 490 L 195 465 Z"
          />

          <!-- Kolda (sud-est, Casamance est) -->
          <path
            class="region"
            id="reg-kolda"
            data-name="Kolda"
            d="M 298 428 L 338 422 L 375 428 L 405 445 L 420 468 L 418 495 L 400 515 L 372 525 L 342 525 L 312 515 L 292 495 L 288 468 Z"
          />

        </svg>
      </div><!-- /.carto-map-container -->

      <div class="carto-counter">
        <span class="carto-count">14</span> régions &middot; <span class="carto-count">14</span> couvertes &middot; <span class="carto-count">100%</span> du territoire
      </div>
    </div><!-- /.carto-wrapper -->
  </div>
</section>

<!-- STYLES -->
<style>
/* --- Section wrapper --- */
.carto-section {
  padding: 5rem 0;
  background: #f4f8fd;
}

/* --- Wrapper carte --- */
.carto-wrapper {
  max-width: 680px;
  margin: 0 auto;
  position: relative;
}

/* --- Légende --- */
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
  width: 10px;
  height: 10px;
  border-radius: 50%;
}

/* --- Conteneur SVG --- */
.carto-map-container {
  position: relative;
  background: linear-gradient(160deg, #e8f1fb 0%, #f0f6ff 100%);
  border-radius: 20px;
  padding: 24px;
  box-shadow: 0 4px 32px rgba(26,107,181,0.10), inset 0 0 0 1px rgba(26,107,181,0.08);
}

/* --- SVG --- */
.carto-svg {
  width: 100%;
  height: auto;
  display: block;
}

/* --- Régions : état de base --- */
#section-carte .region {
  fill: #1a6bb5;
  stroke: #fff;
  stroke-width: 2;
  stroke-linejoin: round;
  cursor: pointer;
  filter: url(#region-shadow);
  transform-box: fill-box;
  transform-origin: center;
  transition:
    fill 0.22s ease,
    filter 0.22s ease,
    transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
}

/* --- Régions masquées avant animation (ajoutées par JS) --- */
#section-carte .region.region-hidden {
  opacity: 0;
  transform: scale(0.8) translateY(10px);
}

/* --- Hover --- */
#section-carte .region:hover {
  fill: #f7941d;
  filter: url(#region-shadow-hover) drop-shadow(0 5px 10px rgba(247,148,29,0.35));
}

/* --- Clic / sélection active --- */
#section-carte .region.clicked {
  fill: #f7941d;
  filter: url(#region-shadow-click);
  transform: translateY(-4px) scale(1.04);
}

/* --- Animation d'entrée au scroll --- */
@keyframes regionIn {
  from {
    opacity: 0;
    transform: scale(0.8) translateY(10px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

#section-carte .region.region-visible {
  animation: regionIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

/* --- Tooltip --- */
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
.carto-tooltip::before {
  content: '';
  position: absolute;
  bottom: -6px;
  left: 50%;
  transform: translateX(-50%);
  border: 6px solid transparent;
  border-bottom: none;
  border-top-color: #1a3a5c;
}
.carto-tooltip.visible {
  opacity: 1;
  transform: translateY(0);
}

/* --- Compteur bas --- */
.carto-counter {
  margin-top: 16px;
  font-family: 'Poppins', sans-serif;
  font-size: .82rem;
  color: #6b7280;
  text-align: center;
  letter-spacing: 0.02em;
}
.carto-count {
  font-weight: 700;
  color: #1a6bb5;
}

/* --- Responsive --- */
@media (max-width: 480px) {
  .carto-wrapper {
    max-width: 100%;
    padding: 0 8px;
  }
  .carto-map-container {
    padding: 12px;
    border-radius: 14px;
  }
}
</style>

<!-- JAVASCRIPT -->
<script>
(function () {
  var map     = document.getElementById('senegal-map');
  var regions = map ? map.querySelectorAll('.region') : [];
  var tooltip = document.getElementById('carto-tooltip');
  var section = document.getElementById('section-carte');
  var active  = null;
  var animated = false;

  if (!regions.length || !tooltip || !section) return;

  /* --- Masquer toutes les régions via JS avant animation --- */
  regions.forEach(function (r) {
    r.classList.add('region-hidden');
  });

  /* ---- Tooltip ---- */
  function showTooltip(e, name) {
    tooltip.textContent = name;
    tooltip.classList.add('visible');
    moveTooltip(e);
  }

  function moveTooltip(e) {
    var x = e.clientX;
    var y = e.clientY;
    tooltip.style.left = (x - tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top  = (y - tooltip.offsetHeight - 14) + 'px';
  }

  function hideTooltip() {
    tooltip.classList.remove('visible');
  }

  /* ---- Clic effet 3D ---- */
  function handleClick(region) {
    if (active === region) {
      /* Desélection */
      region.classList.remove('clicked');
      active = null;
    } else {
      if (active) {
        active.classList.remove('clicked');
      }
      region.classList.add('clicked');
      active = region;
    }
  }

  /* ---- Binding événements par région ---- */
  regions.forEach(function (region) {
    var name = region.getAttribute('data-name');

    region.addEventListener('mouseenter', function (e) {
      showTooltip(e, name);
    });
    region.addEventListener('mousemove', moveTooltip);
    region.addEventListener('mouseleave', hideTooltip);

    region.addEventListener('click', function () {
      handleClick(region);
    });

    /* Support tactile */
    region.addEventListener('touchstart', function (e) {
      e.preventDefault();
      var t = e.touches[0];
      showTooltip(t, name);
      handleClick(region);
      setTimeout(hideTooltip, 2000);
    }, { passive: false });
  });

  /* ---- Animation stagger au scroll ---- */
  function animateRegions() {
    if (animated) return;
    animated = true;

    regions.forEach(function (region, i) {
      setTimeout(function () {
        region.classList.remove('region-hidden');
        region.classList.add('region-visible');
      }, i * 60);
    });
  }

  /* IntersectionObserver */
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          animateRegions();
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    obs.observe(section);
  } else {
    /* Fallback si IntersectionObserver absent */
    regions.forEach(function (r) {
      r.classList.remove('region-hidden');
    });
  }
})();
</script>
