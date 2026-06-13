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

          <!-- Saint-Louis (nord, grande bande) -->
          <path class="region" id="reg-saint-louis" data-name="Saint-Louis"
            d="M 268 12 L 295 10 L 322 10 L 380 12 L 435 14 L 490 16 L 530 18 L 558 22
               L 565 35 L 570 52 L 565 72 L 552 90 L 535 105 L 512 115 L 488 120
               L 462 122 L 438 118 L 415 112 L 395 108 L 375 112 L 355 118 L 335 122
               L 318 128 L 305 138 L 292 148 L 278 152 L 262 148 L 248 135 L 238 118
               L 232 100 L 235 80 L 245 62 L 258 45 Z"/>

          <!-- Matam (nord-est) -->
          <path class="region" id="reg-matam" data-name="Matam"
            d="M 558 22 L 598 20 L 638 18 L 678 18 L 715 20 L 742 26 L 758 40
               L 765 58 L 762 80 L 752 100 L 735 118 L 712 132 L 685 142 L 658 148
               L 630 148 L 602 142 L 578 132 L 562 118 L 552 100 L 548 80 L 552 60
               L 558 42 Z"/>

          <!-- Louga (centre-nord) -->
          <path class="region" id="reg-louga" data-name="Louga"
            d="M 165 108 L 192 100 L 222 96 L 255 98 L 285 108 L 312 122 L 330 138
               L 338 158 L 335 178 L 322 196 L 305 210 L 282 220 L 258 225 L 232 222
               L 208 214 L 188 202 L 172 186 L 162 168 L 158 148 L 160 128 L 162 118 Z"/>

          <!-- Tambacounda (est, tres grande) -->
          <path class="region" id="reg-tambacounda" data-name="Tambacounda"
            d="M 462 152 L 495 148 L 528 148 L 558 155 L 585 168 L 608 185 L 628 208
               L 642 232 L 650 260 L 652 290 L 645 320 L 630 348 L 608 370 L 582 385
               L 552 392 L 520 390 L 492 380 L 468 362 L 450 340 L 438 315 L 432 288
               L 432 260 L 438 232 L 450 208 L 448 195 L 445 178 L 452 162 Z"/>

          <!-- Kedougou (extreme sud-est) -->
          <path class="region" id="reg-kedougou" data-name="Kédougou"
            d="M 652 290 L 668 278 L 688 265 L 708 252 L 728 242 L 748 238 L 762 245
               L 768 262 L 765 282 L 755 302 L 738 320 L 718 335 L 695 345 L 670 350
               L 648 348 L 632 338 L 628 320 L 632 305 L 642 295 Z"/>

          <!-- Diourbel (centre, petit) -->
          <path class="region" id="reg-diourbel" data-name="Diourbel"
            d="M 228 222 L 258 218 L 285 222 L 305 235 L 315 252 L 312 272 L 298 286
               L 280 295 L 258 298 L 238 292 L 222 278 L 215 260 L 218 242 Z"/>

          <!-- Thies (ouest) -->
          <path class="region" id="reg-thies" data-name="Thiès"
            d="M 138 178 L 165 172 L 192 175 L 212 188 L 222 208 L 218 230 L 205 248
               L 186 260 L 162 265 L 138 258 L 118 242 L 110 222 L 116 202 Z"/>

          <!-- Dakar (presqu'ile, tres petite) -->
          <path class="region" id="reg-dakar" data-name="Dakar"
            d="M 92 198 L 112 192 L 125 200 L 128 218 L 122 232 L 108 242 L 92 238
               L 78 225 L 75 210 Z"/>

          <!-- Kaolack (centre-ouest, bord Gambie) -->
          <path class="region" id="reg-kaolack" data-name="Kaolack"
            d="M 168 295 L 195 288 L 222 285 L 245 292 L 262 308 L 268 328 L 262 348
               L 248 362 L 228 370 L 205 368 L 185 355 L 172 338 L 165 318 Z"/>

          <!-- Kaffrine (centre) -->
          <path class="region" id="reg-kaffrine" data-name="Kaffrine"
            d="M 298 272 L 330 268 L 362 272 L 390 285 L 412 305 L 420 328 L 415 352
               L 400 368 L 378 378 L 352 380 L 328 372 L 308 355 L 298 332 L 295 308
               L 298 288 Z"/>

          <!-- Fatick (centre-ouest, Sine-Saloum) -->
          <path class="region" id="reg-fatick" data-name="Fatick"
            d="M 138 258 L 165 252 L 192 255 L 215 268 L 228 288 L 225 312 L 212 328
               L 195 338 L 172 340 L 150 330 L 132 312 L 128 290 L 132 272 Z"/>

          <!-- Ziguinchor (sud-ouest Casamance) -->
          <path class="region" id="reg-ziguinchor" data-name="Ziguinchor"
            d="M 62 432 L 92 425 L 125 422 L 155 428 L 175 442 L 180 462 L 172 480
               L 155 492 L 130 498 L 102 495 L 78 480 L 65 462 L 62 445 Z"/>

          <!-- Sedhiou (sud, Casamance centre) -->
          <path class="region" id="reg-sedhiou" data-name="Sédhiou"
            d="M 178 422 L 212 415 L 248 418 L 275 432 L 285 452 L 278 472 L 260 485
               L 235 490 L 208 485 L 188 470 L 180 450 Z"/>

          <!-- Kolda (sud-est, Casamance est) -->
          <path class="region" id="reg-kolda" data-name="Kolda"
            d="M 288 415 L 325 408 L 362 412 L 395 428 L 415 450 L 415 475 L 398 492
               L 372 500 L 342 500 L 315 490 L 295 472 L 285 450 Z"/>

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
