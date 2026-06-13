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
          viewBox="-10 0 810 560"
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

          <!-- Saint-Louis -->
          <path class="region" id="reg-saint-louis" data-name="Saint-Louis"
            d="M 384.9 113.9 L 417.8 150.7 L 476.7 86.1 L 481.4 70.8 L 467.4 70.0 L 461.9 61.6 L 453.4 54.1 L 454.6 46.4 L 437.7 34.6 L 425.8 24.4 L 417.1 16.2 L 409.3 12.0 L 393.7 9.7 L 379.7 10.4 L 368.9 8.4 L 356.3 9.0 L 346.3 5.7 L 336.1 8.3 L 324.4 0.8 L 311.8 3.1 L 305.5 15.5 L 282.5 15.8 L 265.2 15.0 L 254.7 23.0 L 232.0 29.1 L 210.5 23.7 L 193.2 24.8 L 175.1 18.8 L 156.9 24.6 L 150.6 40.5 L 146.0 57.1 L 134.9 70.1 L 131.5 81.0 L 127.3 97.0 L 171.7 93.6 L 240.7 90.9 Z"/>

          <!-- Matam -->
          <path class="region" id="reg-matam" data-name="Matam"
            d="M 370.5 276.4 L 394.5 266.2 L 405.9 260.3 L 413.5 268.3 L 513.7 291.9 L 632.0 225.2 L 630.3 219.0 L 612.7 198.8 L 603.6 189.0 L 594.2 182.9 L 601.0 176.6 L 587.9 164.5 L 586.0 158.5 L 588.8 151.8 L 578.8 154.7 L 569.7 145.4 L 562.0 139.2 L 553.6 136.6 L 548.0 132.0 L 546.0 121.0 L 546.7 115.9 L 538.9 103.6 L 536.7 96.8 L 531.9 81.8 L 517.6 78.8 L 519.3 71.9 L 506.6 72.0 L 492.0 76.8 L 470.7 90.5 L 417.8 150.7 L 397.3 146.4 L 353.0 162.0 L 380.1 207.1 L 345.8 260.4 Z"/>

          <!-- Louga -->
          <path class="region" id="reg-louga" data-name="Louga"
            d="M 264.6 251.6 L 334.1 254.1 L 360.2 237.8 L 380.1 207.1 L 373.3 171.6 L 354.9 150.1 L 357.6 96.6 L 247.7 98.4 L 210.0 68.9 L 175.1 88.9 L 160.4 104.5 L 131.2 110.3 L 118.7 129.1 L 89.0 174.5 L 107.2 185.0 L 114.5 192.9 L 119.1 192.7 L 127.1 181.2 L 135.0 170.6 L 148.1 175.3 L 148.9 181.8 L 154.0 181.8 L 158.9 186.1 L 162.8 200.1 L 168.2 210.4 L 172.6 220.9 L 193.8 222.1 L 207.4 216.7 L 220.4 221.3 L 234.5 232.2 L 247.0 235.7 L 266.1 238.8 Z"/>

          <!-- Dakar -->
          <path class="region" id="reg-dakar" data-name="Dakar"
            d="M 45.9 269.0 L 48.2 245.3 L 46.3 239.7 L 35.6 233.8 L 20.6 240.6 L 6.8 245.9 L 1.3 247.2 L -0.2 247.1 L -1.3 248.1 L -3.7 247.9 L -1.5 250.2 L 0.3 252.6 L 3.2 254.9 L 4.2 257.6 L 5.9 257.9 L 7.1 259.7 L 9.0 260.9 L 10.1 257.6 L 10.1 254.9 L 8.8 253.0 L 14.0 249.5 L 28.1 253.3 L 40.6 261.3 L 43.3 264.0 Z"/>

          <!-- Thiès -->
          <path class="region" id="reg-thies" data-name="Thiès"
            d="M 45.9 269.0 L 52.7 278.9 L 56.9 286.0 L 63.2 288.2 L 73.4 300.6 L 79.8 312.8 L 86.4 324.3 L 88.8 325.8 L 93.3 336.8 L 94.4 330.0 L 93.2 325.8 L 95.8 321.8 L 100.0 318.4 L 97.3 311.4 L 111.6 288.9 L 125.6 271.8 L 117.5 265.6 L 115.6 249.3 L 110.2 238.9 L 109.1 230.5 L 119.3 219.2 L 141.4 213.4 L 163.6 221.6 L 169.2 213.5 L 162.8 196.9 L 156.0 181.6 L 151.0 183.9 L 147.0 174.6 L 126.8 179.7 L 119.9 191.7 L 114.2 191.6 L 101.1 179.3 L 72.1 198.1 L 49.3 224.1 L 46.4 240.4 Z"/>

          <!-- Diourbel -->
          <path class="region" id="reg-diourbel" data-name="Diourbel"
            d="M 170.7 220.9 L 163.5 220.9 L 148.7 214.7 L 133.3 214.0 L 119.3 219.2 L 104.9 225.4 L 111.7 232.6 L 111.6 237.6 L 113.0 242.5 L 115.3 252.0 L 113.4 262.2 L 124.0 266.3 L 132.9 267.6 L 147.0 266.7 L 162.4 270.2 L 173.8 273.7 L 193.6 275.6 L 200.6 276.1 L 213.9 272.2 L 219.8 264.6 L 222.5 248.9 L 236.1 254.6 L 260.7 262.4 L 265.0 238.5 L 247.0 235.7 L 235.7 232.8 L 222.6 223.9 L 218.4 218.7 L 204.6 219.0 L 193.6 221.8 L 172.6 220.9 Z"/>

          <!-- Fatick -->
          <path class="region" id="reg-fatick" data-name="Fatick"
            d="M 125.8 266.3 L 116.7 285.5 L 97.3 311.4 L 98.9 319.8 L 96.3 325.3 L 91.4 328.0 L 93.3 336.8 L 98.9 364.6 L 112.5 378.3 L 117.8 390.1 L 122.6 394.0 L 182.1 393.4 L 179.7 389.3 L 175.9 388.4 L 172.2 375.3 L 169.0 358.6 L 162.3 343.7 L 163.2 329.0 L 148.4 323.6 L 145.7 321.8 L 148.2 314.7 L 156.1 306.3 L 186.7 297.3 L 204.1 294.2 L 229.5 280.2 L 240.1 282.2 L 251.1 260.2 L 220.0 249.8 L 210.5 274.1 L 193.4 275.5 L 158.6 269.9 L 130.8 268.2 Z"/>

          <!-- Kaolack -->
          <path class="region" id="reg-kaolack" data-name="Kaolack"
            d="M 181.9 395.4 L 262.6 388.8 L 265.9 369.3 L 255.2 369.0 L 246.6 365.5 L 242.1 371.7 L 233.6 365.7 L 232.4 352.3 L 220.7 337.0 L 211.3 329.9 L 215.1 315.7 L 233.5 300.9 L 231.4 280.8 L 220.7 290.3 L 201.6 293.0 L 188.2 296.0 L 162.3 300.4 L 150.9 309.7 L 148.2 314.7 L 146.1 314.7 L 146.6 321.0 L 145.5 321.9 L 146.1 323.4 L 157.5 324.9 L 163.8 330.8 L 160.0 341.6 L 166.7 348.1 L 162.1 366.4 L 172.2 375.3 L 174.9 387.5 L 177.7 390.0 L 180.8 393.1 Z"/>

          <!-- Kaffrine -->
          <path class="region" id="reg-kaffrine" data-name="Kaffrine"
            d="M 262.9 263.6 L 238.0 280.4 L 238.5 282.7 L 233.4 283.5 L 233.6 302.4 L 218.1 309.8 L 212.5 329.0 L 212.8 332.5 L 220.7 337.0 L 224.8 347.7 L 233.4 358.0 L 235.7 367.3 L 240.6 372.3 L 244.6 367.9 L 247.6 365.1 L 255.2 369.0 L 263.0 369.0 L 272.5 373.6 L 286.0 371.4 L 306.6 368.1 L 323.5 368.7 L 335.2 369.3 L 344.2 372.1 L 347.8 367.5 L 364.3 357.2 L 370.6 353.0 L 373.9 351.1 L 374.8 332.1 L 370.5 276.4 L 319.5 265.7 L 262.9 263.6 Z"/>

          <!-- Tambacounda -->
          <path class="region" id="reg-tambacounda" data-name="Tambacounda"
            d="M 344.1 373.0 L 410.2 412.7 L 469.6 405.9 L 483.9 418.2 L 493.5 435.8 L 501.1 448.9 L 505.7 460.2 L 512.4 467.7 L 517.6 482.9 L 520.1 499.0 L 537.4 514.5 L 562.8 517.2 L 562.4 489.8 L 551.3 470.0 L 561.0 463.9 L 582.7 461.4 L 599.6 469.5 L 611.5 463.6 L 622.7 449.5 L 640.2 446.9 L 655.3 435.5 L 677.4 415.2 L 706.0 423.6 L 727.1 415.6 L 700.1 379.3 L 710.8 347.3 L 706.5 307.4 L 696.4 302.5 L 693.7 296.6 L 682.3 276.9 L 679.8 249.5 L 628.1 204.1 L 429.3 274.3 L 371.4 276.2 L 344.1 373.0 Z"/>

          <!-- Kédougou -->
          <path class="region" id="reg-kedougou" data-name="Kédougou"
            d="M 564.7 516.6 L 573.6 528.5 L 587.7 531.1 L 600.3 534.4 L 634.2 547.1 L 661.4 554.7 L 689.8 550.6 L 713.1 546.4 L 740.6 549.0 L 778.7 541.8 L 793.4 538.9 L 785.5 531.7 L 780.9 513.2 L 787.1 499.7 L 788.3 482.3 L 786.1 473.0 L 776.4 456.5 L 768.0 434.0 L 744.6 418.0 L 723.0 422.4 L 705.6 425.6 L 684.3 415.1 L 677.2 430.7 L 652.7 437.3 L 641.9 446.9 L 627.6 446.5 L 619.4 458.3 L 609.7 466.3 L 599.6 469.5 L 587.7 461.5 L 574.0 462.7 L 557.4 463.5 L 553.1 470.3 L 558.6 487.2 L 565.5 500.8 Z"/>

          <!-- Ziguinchor -->
          <path class="region" id="reg-ziguinchor" data-name="Ziguinchor"
            d="M 207.1 449.5 L 104.2 449.7 L 103.0 451.5 L 102.0 453.6 L 99.8 456.1 L 98.3 457.5 L 97.0 462.3 L 95.9 480.2 L 92.4 502.6 L 93.4 511.9 L 93.6 516.9 L 95.2 525.7 L 92.3 541.9 L 96.9 549.6 L 104.6 552.5 L 131.0 552.6 L 158.7 543.1 L 193.4 539.8 L 204.6 538.6 L 203.3 532.2 L 199.4 527.3 L 198.8 522.9 L 194.8 515.1 L 192.2 506.3 L 194.7 498.5 L 196.3 490.3 L 195.7 484.0 L 195.2 480.3 L 198.3 474.3 L 205.7 462.3 L 204.6 458.6 L 203.0 454.3 Z"/>

          <!-- Sédhiou -->
          <path class="region" id="reg-sedhiou" data-name="Sédhiou"
            d="M 278.8 425.1 L 258.8 420.6 L 247.4 426.3 L 233.9 424.2 L 218.7 436.5 L 203.0 454.3 L 204.1 459.0 L 206.6 460.0 L 200.8 472.7 L 197.2 477.2 L 194.5 481.4 L 196.9 484.2 L 194.8 491.9 L 194.7 498.5 L 191.1 505.3 L 191.4 514.4 L 198.4 521.4 L 198.4 525.9 L 199.6 529.3 L 203.7 533.9 L 205.1 538.1 L 234.7 544.0 L 279.0 520.1 L 306.8 510.9 L 304.9 500.1 L 307.6 494.6 L 302.0 476.7 L 299.2 467.2 L 293.2 464.5 L 290.0 453.2 L 283.8 446.5 L 278.1 443.3 L 278.9 433.4 Z"/>

          <!-- Kolda -->
          <path class="region" id="reg-kolda" data-name="Kolda"
            d="M 469.6 405.9 L 472.3 428.5 L 433.3 442.7 L 414.8 440.4 L 382.9 431.1 L 351.4 418.1 L 311.0 394.5 L 281.3 424.6 L 282.4 446.3 L 293.4 460.7 L 302.2 470.1 L 306.2 496.3 L 306.8 510.9 L 519.3 511.4 L 521.1 504.7 L 520.6 498.4 L 520.4 490.6 L 519.5 486.7 L 515.3 479.8 L 517.0 474.4 L 512.1 470.3 L 510.2 465.5 L 507.8 462.0 L 505.4 460.2 L 502.7 454.5 L 502.5 451.6 L 502.2 446.4 L 501.9 441.3 L 497.7 435.6 L 490.5 428.6 L 491.2 422.1 L 482.9 415.6 L 476.2 410.1 L 473.3 404.2 Z"/>

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
