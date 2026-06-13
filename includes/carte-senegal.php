<!-- ══════════════════════════════════════════════════════════════
   COTRAC — Carte SVG Interactive du Sénégal — 14 Régions
   Include : <?php require_once __DIR__ . '/includes/carte-senegal.php'; ?>
══════════════════════════════════════════════════════════════ -->

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

    <!-- Carte SVG -->
    <div class="carto-wrapper">
      <div class="carto-legend">
        <span class="carto-legend-dot" style="background:#1a6bb5;"></span> Région couverte
        <span style="width:20px;display:inline-block;"></span>
        <span class="carto-legend-dot" style="background:#f7941d;"></span> Survolée
      </div>

      <div class="carto-map-container">
        <!-- Tooltip -->
        <div class="carto-tooltip" id="carto-tooltip"></div>

        <svg
          id="senegal-map"
          viewBox="0 0 520 480"
          xmlns="http://www.w3.org/2000/svg"
          class="carto-svg"
          aria-label="Carte du Sénégal — 14 régions couvertes par COTRAC"
          role="img"
        >
          <defs>
            <filter id="region-shadow" x="-10%" y="-10%" width="120%" height="120%">
              <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="rgba(26,107,181,0.25)" />
            </filter>
            <filter id="region-shadow-hover" x="-15%" y="-15%" width="130%" height="130%">
              <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="rgba(247,148,29,0.45)" />
            </filter>
          </defs>

          <!-- ══ SAINT-LOUIS (nord, bord mauritanie) ══ -->
          <path
            class="region"
            id="reg-saint-louis"
            data-name="Saint-Louis"
            d="M 90 20 L 200 20 L 220 30 L 230 50 L 225 80 L 210 100 L 195 115 L 180 125 L 160 130 L 140 130 L 120 125 L 100 115 L 80 100 L 72 80 L 72 50 Z"
          />

          <!-- ══ MATAM (nord-est) ══ -->
          <path
            class="region"
            id="reg-matam"
            data-name="Matam"
            d="M 220 20 L 340 20 L 360 35 L 370 55 L 365 80 L 350 100 L 330 115 L 310 125 L 285 130 L 260 130 L 240 120 L 225 105 L 218 85 L 218 55 Z"
          />

          <!-- ══ LOUGA (centre-nord) ══ -->
          <path
            class="region"
            id="reg-louga"
            data-name="Louga"
            d="M 72 100 L 100 90 L 130 88 L 165 90 L 195 100 L 210 115 L 215 140 L 210 162 L 195 178 L 175 188 L 155 192 L 130 192 L 108 185 L 88 172 L 74 155 L 68 135 Z"
          />

          <!-- ══ TAMBACOUNDA (est, grande région) ══ -->
          <path
            class="region"
            id="reg-tambacounda"
            data-name="Tambacounda"
            d="M 285 130 L 320 128 L 355 132 L 388 145 L 415 165 L 435 190 L 445 220 L 440 252 L 425 278 L 405 295 L 380 305 L 352 308 L 325 302 L 300 288 L 280 268 L 265 245 L 258 220 L 258 192 L 265 165 L 275 145 Z"
          />

          <!-- ══ KÉDOUGOU (extrême sud-est) ══ -->
          <path
            class="region"
            id="reg-kedougou"
            data-name="Kédougou"
            d="M 352 308 L 385 308 L 415 298 L 440 282 L 458 260 L 465 235 L 462 208 L 450 188 L 438 175 L 448 175 L 465 188 L 480 210 L 488 240 L 483 268 L 468 292 L 445 310 L 418 322 L 390 328 L 362 325 Z"
          />

          <!-- ══ DIOURBEL (centre-ouest) ══ -->
          <path
            class="region"
            id="reg-diourbel"
            data-name="Diourbel"
            d="M 130 192 L 162 190 L 190 192 L 208 205 L 215 222 L 212 240 L 200 252 L 182 260 L 162 262 L 142 258 L 125 245 L 115 228 L 115 210 Z"
          />

          <!-- ══ THIÈS (ouest) ══ -->
          <path
            class="region"
            id="reg-thies"
            data-name="Thiès"
            d="M 68 155 L 95 150 L 115 152 L 130 165 L 132 192 L 118 210 L 105 222 L 88 228 L 70 225 L 52 215 L 42 198 L 42 175 Z"
          />

          <!-- ══ DAKAR (presqu'île, extrême ouest) ══ -->
          <path
            class="region"
            id="reg-dakar"
            data-name="Dakar"
            d="M 28 175 L 45 168 L 55 178 L 58 195 L 52 212 L 40 218 L 26 215 L 18 202 L 18 188 Z"
          />

          <!-- ══ KAOLACK (centre) ══ -->
          <path
            class="region"
            id="reg-kaolack"
            data-name="Kaolack"
            d="M 162 262 L 195 258 L 220 265 L 238 282 L 242 302 L 235 320 L 218 332 L 198 336 L 178 330 L 160 315 L 150 295 L 150 275 Z"
          />

          <!-- ══ KAFFRINE (centre-est) ══ -->
          <path
            class="region"
            id="reg-kaffrine"
            data-name="Kaffrine"
            d="M 210 250 L 240 248 L 265 255 L 278 272 L 280 295 L 268 315 L 248 328 L 228 330 L 210 322 L 198 305 L 196 285 L 202 265 Z"
          />

          <!-- ══ FATICK (centre-ouest, Sine-Saloum) ══ -->
          <path
            class="region"
            id="reg-fatick"
            data-name="Fatick"
            d="M 88 228 L 120 232 L 148 240 L 160 258 L 158 280 L 148 295 L 130 305 L 110 308 L 90 300 L 74 285 L 68 265 L 70 245 Z"
          />

          <!-- ══ ZIGUINCHOR (sud-ouest, Casamance) ══ -->
          <path
            class="region"
            id="reg-ziguinchor"
            data-name="Ziguinchor"
            d="M 68 340 L 95 332 L 122 330 L 145 338 L 158 355 L 158 375 L 145 390 L 122 400 L 98 402 L 75 395 L 58 378 L 52 358 Z"
          />

          <!-- ══ SÉDHIOU (sud, Casamance centre) ══ -->
          <path
            class="region"
            id="reg-sedhiou"
            data-name="Sédhiou"
            d="M 145 308 L 175 310 L 200 318 L 215 335 L 215 358 L 202 375 L 182 385 L 160 385 L 140 375 L 128 358 L 128 338 Z"
          />

          <!-- ══ KOLDA (sud-est, Casamance est) ══ -->
          <path
            class="region"
            id="reg-kolda"
            data-name="Kolda"
            d="M 212 318 L 245 320 L 275 328 L 295 348 L 298 375 L 285 395 L 262 408 L 238 410 L 215 400 L 200 382 L 198 358 L 205 338 Z"
          />

        </svg>
      </div><!-- /.carto-map-container -->

      <!-- Compteur -->
      <div class="carto-counter">
        <span class="carto-count">14</span> régions · <span class="carto-count">14</span> couvertes · <span class="carto-count">100%</span> du territoire
      </div>
    </div><!-- /.carto-wrapper -->
  </div>
</section>

<!-- ══ STYLES ══ -->
<style>
/* ─── Section wrapper ─── */
.carto-section {
  padding: 5rem 0;
  background: #f4f8fd;
}

/* ─── Wrapper carte ─── */
.carto-wrapper {
  max-width: 500px;
  margin: 0 auto;
  position: relative;
}

/* ─── Légende ─── */
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

/* ─── Conteneur SVG ─── */
.carto-map-container {
  position: relative;
  background: linear-gradient(160deg, #e8f1fb 0%, #f0f6ff 100%);
  border-radius: 20px;
  padding: 24px;
  box-shadow: 0 4px 32px rgba(26,107,181,0.10), inset 0 0 0 1px rgba(26,107,181,0.08);
}

/* ─── SVG ─── */
.carto-svg {
  width: 100%;
  height: auto;
  display: block;
}

/* ─── Régions ─── */
#section-carte .region {
  fill: #1a6bb5;
  stroke: #fff;
  stroke-width: 2;
  stroke-linejoin: round;
  cursor: pointer;
  filter: url(#region-shadow);
  /* État initial pour l'animation */
  opacity: 0;
  transform-origin: center;
  transition:
    fill 0.22s ease,
    filter 0.22s ease,
    transform 0.22s ease;
}

#section-carte .region:hover,
#section-carte .region.hovered {
  fill: #f7941d;
  filter: url(#region-shadow-hover);
  transform: scale(1.03);
}

/* Animation reveal */
#section-carte .region.revealed {
  animation: regionReveal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

@keyframes regionReveal {
  from {
    opacity: 0;
    transform: scale(0.85);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* ─── Tooltip ─── */
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

/* ─── Compteur bas ─── */
.carto-counter {
  margin-top: 16px;
  font-family: 'Poppins', sans-serif;
  font-size: .82rem;
  color: #6b7280;
  text-align: center;
}
.carto-count {
  font-weight: 700;
  color: #1a6bb5;
}
</style>

<!-- ══ JAVASCRIPT ══ -->
<script>
(function() {
  const regions   = document.querySelectorAll('#senegal-map .region');
  const tooltip   = document.getElementById('carto-tooltip');
  const section   = document.getElementById('section-carte');
  let   animated  = false;

  /* ── Tooltip ── */
  function showTooltip(e, name) {
    tooltip.textContent = name;
    tooltip.classList.add('visible');
    moveTooltip(e);
  }
  function moveTooltip(e) {
    const x = e.clientX;
    const y = e.clientY;
    tooltip.style.left = (x - tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top  = (y - tooltip.offsetHeight - 14) + 'px';
  }
  function hideTooltip() {
    tooltip.classList.remove('visible');
  }

  regions.forEach(function(region) {
    const name = region.getAttribute('data-name');

    region.addEventListener('mouseenter', function(e) { showTooltip(e, name); });
    region.addEventListener('mousemove',  moveTooltip);
    region.addEventListener('mouseleave', hideTooltip);

    /* Touch support */
    region.addEventListener('touchstart', function(e) {
      e.preventDefault();
      const t = e.touches[0];
      showTooltip(t, name);
      setTimeout(hideTooltip, 1800);
    }, { passive: false });
  });

  /* ── Animation stagger au scroll ── */
  function animateRegions() {
    if (animated) return;
    animated = true;
    regions.forEach(function(region, i) {
      setTimeout(function() {
        region.classList.add('revealed');
      }, i * 80);
    });
  }

  /* IntersectionObserver */
  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          animateRegions();
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2 });
    obs.observe(section);
  } else {
    animateRegions(); /* fallback */
  }
})();
</script>
