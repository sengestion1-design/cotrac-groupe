<!-- ══════════════════════════════════════════════════════════════
   COTRAC - Organigramme Anime - Page A Propos
   Include via : require_once includes/organigramme-anime.php
   Noeuds : fade+scale cascade, connecteurs CSS, hover elevation
══════════════════════════════════════════════════════════════ -->

<section class="orga-section" id="section-orga">
  <div class="container" style="text-align:center;">
    <span class="section-tag" style="border-color:#f7941d;color:#f7941d;">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:4px;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
      Organisation
    </span>
    <h2 class="section-title" style="margin-top:12px;">Notre <span style="color:var(--orange,#f7941d);">Structure</span></h2>
    <p class="section-sub" style="max-width:560px;margin:0 auto 56px;">
      Une organisation agile et structurée pour garantir l'excellence sur chaque projet,
      de la conception à la livraison.
    </p>

    <!-- ══ ORGANIGRAMME ANIMÉ ══ -->
    <div class="orga-tree" id="orga-tree">

      <!-- NIVEAU 0 — DG -->
      <div class="orga-level orga-level--0">
        <div class="orga-node orga-node--ceo orga-animate" data-delay="0">
          <div class="orga-node-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 3.9 2.4-7.4L2 9.4h7.6z"/></svg>
          </div>
          <div class="orga-node-title">Directeur Général</div>
          <div class="orga-node-sub">CEO &amp; Fondateur</div>
          <div class="orga-node-badge">Direction</div>
        </div>
      </div>

      <!-- Connecteur V0→N1 -->
      <div class="orga-connector orga-connector--v orga-animate" data-delay="150" style="height:32px;"></div>

      <!-- Ligne H niveau 1 -->
      <div class="orga-connector orga-connector--h orga-animate" data-delay="220" style="width:72%;margin:0 auto;"></div>

      <!-- NIVEAU 1 — DGA + Dir Admin + Dir Commercial + Dir Technique -->
      <div class="orga-level orga-level--1">

        <!-- Branche DGA / Dir Technique -->
        <div class="orga-branch">
          <!-- Connecteur V -->
          <div class="orga-connector orga-connector--v orga-animate" data-delay="300" style="height:24px;"></div>
          <!-- DGA -->
          <div class="orga-node orga-node--n1 orga-animate" data-delay="380">
            <div class="orga-node-icon orga-node-icon--sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            </div>
            <div class="orga-node-title">Dir. Général Adjoint</div>
            <div class="orga-node-sub">DGA</div>
          </div>
          <!-- Connecteur V -->
          <div class="orga-connector orga-connector--v orga-animate" data-delay="460" style="height:20px;"></div>
          <!-- Dir Technique -->
          <div class="orga-node orga-node--n1 orga-node--tech orga-animate" data-delay="540">
            <div class="orga-node-icon orga-node-icon--sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
            </div>
            <div class="orga-node-title">Direction Technique</div>
            <div class="orga-node-sub">DTO</div>
          </div>
          <!-- Connecteur V + H + Services Technique -->
          <div class="orga-connector orga-connector--v orga-animate" data-delay="620" style="height:20px;"></div>
          <div class="orga-connector orga-connector--h orga-animate" data-delay="680" style="width:90%;margin:0 auto;"></div>
          <div class="orga-level orga-level--services">
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="740" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="800">
                <span class="orga-dot" style="background:#1a6bb5;"></span>
                <div class="orga-node-title">Ingénierie Élec.</div>
                <div class="orga-node-sub">HTA · MT · BT</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="780" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="840">
                <span class="orga-dot" style="background:#1a6bb5;"></span>
                <div class="orga-node-title">Gestion Projets</div>
                <div class="orga-node-sub">Réseaux & Travaux</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="820" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="880">
                <span class="orga-dot" style="background:#1a6bb5;"></span>
                <div class="orga-node-title">Supply Chain</div>
                <div class="orga-node-sub">Logistique</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="860" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="920">
                <span class="orga-dot" style="background:#1a6bb5;"></span>
                <div class="orga-node-title">Sécurité &amp; Qualité</div>
                <div class="orga-node-sub">HSE</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Branche Dir Administrative -->
        <div class="orga-branch">
          <div class="orga-connector orga-connector--v orga-animate" data-delay="300" style="height:24px;"></div>
          <div class="orga-node orga-node--n1 orga-animate" data-delay="400">
            <div class="orga-node-icon orga-node-icon--sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <div class="orga-node-title">Dir. Administrative</div>
            <div class="orga-node-sub">DAF</div>
          </div>
          <div class="orga-connector orga-connector--v orga-animate" data-delay="480" style="height:20px;"></div>
          <div class="orga-connector orga-connector--h orga-animate" data-delay="540" style="width:80%;margin:0 auto;"></div>
          <div class="orga-level orga-level--services">
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="600" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="660">
                <span class="orga-dot" style="background:#27ae60;"></span>
                <div class="orga-node-title">Finance</div>
                <div class="orga-node-sub">Comptabilité</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="640" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="700">
                <span class="orga-dot" style="background:#27ae60;"></span>
                <div class="orga-node-title">Ressources Hum.</div>
                <div class="orga-node-sub">RH</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="680" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="740">
                <span class="orga-dot" style="background:#27ae60;"></span>
                <div class="orga-node-title">Juridique</div>
                <div class="orga-node-sub">Affaires légales</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Branche Dir Commerciale -->
        <div class="orga-branch">
          <div class="orga-connector orga-connector--v orga-animate" data-delay="300" style="height:24px;"></div>
          <div class="orga-node orga-node--n1 orga-animate" data-delay="420">
            <div class="orga-node-icon orga-node-icon--sm">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
            </div>
            <div class="orga-node-title">Dir. Commerciale</div>
            <div class="orga-node-sub">DCM</div>
          </div>
          <div class="orga-connector orga-connector--v orga-animate" data-delay="500" style="height:20px;"></div>
          <div class="orga-connector orga-connector--h orga-animate" data-delay="560" style="width:70%;margin:0 auto;"></div>
          <div class="orga-level orga-level--services">
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="620" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="680">
                <span class="orga-dot" style="background:#f7941d;"></span>
                <div class="orga-node-title">Marketing</div>
                <div class="orga-node-sub">Communication</div>
              </div>
            </div>
            <div class="orga-branch">
              <div class="orga-connector orga-connector--v orga-animate" data-delay="660" style="height:16px;"></div>
              <div class="orga-node orga-node--service orga-animate" data-delay="720">
                <span class="orga-dot" style="background:#f7941d;"></span>
                <div class="orga-node-title">Ventes</div>
                <div class="orga-node-sub">Dév. Commercial</div>
              </div>
            </div>
          </div>
        </div>

      </div><!-- /.orga-level--1 -->
    </div><!-- /#orga-tree -->
  </div>
</section>

<!-- ══ STYLES ══ -->
<style>
/* ─── Section ─── */
.orga-section {
  padding: 5rem 0;
  background: #fff;
}

/* ─── Arbre ─── */
.orga-tree {
  max-width: 1100px;
  margin: 0 auto;
  font-family: 'Poppins', sans-serif;
  overflow-x: auto;
  padding: 0 8px 24px;
}

/* ─── Niveaux ─── */
.orga-level {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 12px;
}
.orga-level--services {
  gap: 8px;
  justify-content: center;
  flex-wrap: wrap;
}

/* ─── Branches ─── */
.orga-branch {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
  min-width: 0;
}

/* ─── Connecteurs CSS ─── */
.orga-connector--v {
  width: 2px;
  background: linear-gradient(to bottom, #1a6bb5, #c3d9f0);
  flex-shrink: 0;
  /* animation draw */
  transform-origin: top center;
  transform: scaleY(0);
  opacity: 0;
}
.orga-connector--h {
  height: 2px;
  background: linear-gradient(to right, transparent, #1a6bb5 20%, #1a6bb5 80%, transparent);
  align-self: stretch;
  /* animation draw */
  transform-origin: center left;
  transform: scaleX(0);
  opacity: 0;
}
.orga-connector--v.line-drawn {
  animation: drawV 0.35s ease forwards;
}
.orga-connector--h.line-drawn {
  animation: drawH 0.35s ease forwards;
}
@keyframes drawV {
  to { transform: scaleY(1); opacity: 1; }
}
@keyframes drawH {
  to { transform: scaleX(1); opacity: 1; }
}

/* ─── Nœuds — état initial ─── */
.orga-animate {
  opacity: 0;
  transform: scale(0.82) translateY(8px);
}
.orga-animate.node-revealed {
  animation: nodeIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}
@keyframes nodeIn {
  to { opacity: 1; transform: scale(1) translateY(0); }
}

/* ─── Nœuds ─── */
.orga-node {
  background: #fff;
  border: 1.5px solid #dbeaf8;
  border-radius: 14px;
  padding: 18px 16px 14px;
  text-align: center;
  width: 100%;
  max-width: 190px;
  box-shadow: 0 3px 16px rgba(26,107,181,0.09);
  cursor: default;
  transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
  position: relative;
  box-sizing: border-box;
}
.orga-node:hover {
  transform: translateY(-5px) scale(1.03);
  box-shadow: 0 12px 36px rgba(26,107,181,0.18);
  border-color: #1a6bb5;
}

/* CEO */
.orga-node--ceo {
  background: linear-gradient(135deg, #f7941d 0%, #e07b0f 100%);
  border-color: transparent;
  color: #fff;
  max-width: 230px;
  padding: 22px 24px 18px;
  box-shadow: 0 8px 32px rgba(247,148,29,0.35);
  border-radius: 18px;
}
.orga-node--ceo:hover {
  box-shadow: 0 16px 48px rgba(247,148,29,0.48);
  border-color: transparent;
}
.orga-node--ceo .orga-node-title { color: #fff; font-size: 1rem; }
.orga-node--ceo .orga-node-sub   { color: rgba(255,255,255,.78); }

/* N1 — Directions */
.orga-node--n1 {
  background: linear-gradient(135deg, #1a3a5c 0%, #1a6bb5 100%);
  border-color: transparent;
  color: #fff;
  box-shadow: 0 5px 22px rgba(26,58,92,0.22);
}
.orga-node--n1:hover {
  box-shadow: 0 14px 40px rgba(26,58,92,0.35);
  border-color: transparent;
}
.orga-node--n1 .orga-node-title { color: #fff; font-size: .82rem; }
.orga-node--n1 .orga-node-sub   { color: rgba(255,255,255,.7); }

/* Technique — nuance différente */
.orga-node--tech {
  background: linear-gradient(135deg, #0f5c96 0%, #1a8cc8 100%);
}

/* Services */
.orga-node--service {
  max-width: 148px;
  padding: 12px 10px 10px;
  background: #f6faff;
  border-color: #d5e8f7;
  border-radius: 10px;
}
.orga-node--service:hover {
  background: #fff;
  border-color: #1a6bb5;
}

/* Icônes */
.orga-node-icon {
  width: 48px; height: 48px;
  background: rgba(255,255,255,0.2);
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 12px;
}
.orga-node-icon svg { width: 22px; height: 22px; stroke: #fff; }
.orga-node-icon--sm { width: 36px; height: 36px; margin-bottom: 10px; }
.orga-node-icon--sm svg { width: 18px; height: 18px; }

/* Typographie */
.orga-node-title {
  font-size: .82rem;
  font-weight: 700;
  color: #1a3a5c;
  line-height: 1.3;
  margin-bottom: 3px;
}
.orga-node-sub {
  font-size: .7rem;
  color: #8a9bb0;
  font-weight: 500;
}
.orga-node--n1 .orga-node-title,
.orga-node--tech .orga-node-title { color: #fff; }
.orga-node--n1 .orga-node-sub,
.orga-node--tech .orga-node-sub   { color: rgba(255,255,255,.65); }

/* Badge CEO */
.orga-node-badge {
  display: inline-block;
  background: rgba(255,255,255,0.28);
  color: #fff;
  font-size: .62rem;
  font-weight: 700;
  letter-spacing: .08em;
  text-transform: uppercase;
  padding: 3px 10px;
  border-radius: 50px;
  margin-top: 10px;
}

/* Point coloré */
.orga-dot {
  display: block;
  width: 10px; height: 10px;
  border-radius: 50%;
  margin: 0 auto 8px;
}

/* ─── Responsive ─── */
@media (max-width: 1100px) {
  .orga-node--n1  { max-width: 165px; }
  .orga-node--service { max-width: 125px; }
  .orga-node-title { font-size: .76rem; }
  .orga-node-sub   { font-size: .66rem; }
}
@media (max-width: 860px) {
  .orga-level--1 {
    flex-direction: column;
    align-items: center;
    gap: 0;
  }
  .orga-branch {
    width: 100%;
    max-width: 440px;
  }
  .orga-connector--h { display: none !important; }
  .orga-node { max-width: 340px; }
  .orga-node--service { max-width: 160px; }
  .orga-node-title { font-size: .82rem; }
  .orga-node-sub   { font-size: .72rem; }
}
@media (max-width: 480px) {
  .orga-node { max-width: 100%; }
  .orga-node--service { max-width: 145px; }
  .orga-level--services { gap: 6px; }
}
</style>

<!-- ══ JAVASCRIPT ══ -->
<script>
(function() {
  var section    = document.getElementById('section-orga');
  var animItems  = section ? section.querySelectorAll('.orga-animate') : [];
  var triggered  = false;

  function revealAll() {
    if (triggered) return;
    triggered = true;

    animItems.forEach(function(el) {
      var delay = parseInt(el.getAttribute('data-delay') || '0', 10);
      setTimeout(function() {
        /* Connecteurs : classes différentes pour l'animation draw */
        if (el.classList.contains('orga-connector--v')) {
          el.classList.add('line-drawn');
        } else if (el.classList.contains('orga-connector--h')) {
          el.classList.add('line-drawn');
        } else {
          el.classList.add('node-revealed');
        }
      }, delay);
    });
  }

  if (!section) return;

  if ('IntersectionObserver' in window) {
    var obs = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          revealAll();
          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    obs.observe(section);
  } else {
    revealAll();
  }
})();
</script>
