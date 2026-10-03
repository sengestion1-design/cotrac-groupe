<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Génie Industriel, Construction Métallique & Isolation Thermique | COTRAC';
$page_desc  = 'COTRAC réalise vos installations industrielles au Sénégal : construction mécanique, charpente métallique, calorifugeage, VMC, gaines P3 P.U.R., faux plafonds, tuyauterie HP soudure et travaux sur cuves.';
cms_load('industrie');
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
═══════════════════════════════════════════════════════════ -->
<?php $_industrie_hero_bg = cms_bg_url(cms('industrie','hero','bg_image','')); ?>
<section class="page-hero" style="position:relative;overflow:hidden;min-height:420px;<?= $_industrie_hero_bg ? 'background-image:url(\''.e($_industrie_hero_bg).'\');background-size:cover;background-position:center;' : '' ?>">
  <?php if (!$_industrie_hero_bg): ?>
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac2.jpg" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 5%;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,30,70,0.85) 50%,rgba(10,30,70,0.65));z-index:1;"></div>
  <?php endif; ?>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container grid-2col" style="gap:48px;align-items:center;">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php">Accueil</a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles">Nos pôles</a>
        <span class="sep">›</span>
        <span>Génie Industriel</span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        <?= cms('industrie','hero','title', 'Construction Mécanique &amp; Industrielle') ?>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        <?= cms('industrie','hero','subtitle', 'Installation mécanique, construction métallique, calorifugeage, VMC, gaines P3 P.U.R. et faux plafonds techniques — solutions industrielles clé en main au Sénégal.') ?>
      </p>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">10+</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Ans d'expérience</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">1T/j</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Capacité VMC</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">12</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Postes à souder</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:1.5rem;font-weight:800;color:#f7941d;line-height:1;">Clé en main</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Réalisation complète</div>
      </div>
    </div>
  </div>
  </div><!-- /z-index wrapper -->
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : DOMAINES INDUSTRIELS
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Nos domaines d'intervention</span>
      <h2 class="section-title">Construction Industrielle &amp; Métallique</h2>
      <p class="section-sub">
        De l'installation mécanique à la charpente métallique, en passant par le calorifugeage et les faux plafonds, COTRAC intervient sur l'ensemble de la chaîne industrielle au Sénégal et en Afrique de l'Ouest.
      </p>
    </div>

    <ul class="services-list">

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><span class="ico ico-industrie"><!--industrie--></span></div>
        <div class="service-body">
          <h3>Installation Mécanique</h3>
          <p>Transporteur, élévateur, doseur, vis — installation et mise en service d'équipements mécaniques industriels sur tous types de sites de production.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('wrench','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Maintenance Industrielle</h3>
          <p>Entretien et réparation de moteurs, réducteurs et pompes. Interventions planifiées ou correctives pour garantir la continuité de votre production.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('zap','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Suivi Périodique</h3>
          <p>Programmes de maintenance préventive hebdomadaire, mensuelle et annuelle — pour prolonger la durée de vie de vos équipements et réduire les pannes imprévues.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('shield','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Charpente Métallique</h3>
          <p>Conception, fabrication et pose de structures en charpente métallique pour bâtiments industriels, hangars et ouvrages métalliques sur mesure.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('globe','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Chaudronnerie</h3>
          <p>Fabrication et assemblage de pièces chaudronnées en acier, inox et aluminium — réservoirs, viroles, cônes, trappes et éléments sur plan.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('star','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Tuyauterie Soudure HP</h3>
          <p>Installation et soudure haute pression pour réseaux de vapeur, d'eau et de process industriel. Qualification TIG, MIG et électrode enrobée.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('check','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Installations d'Unités Industrielles</h3>
          <p>Montage complet d'unités de production : levage, assemblage mécanique, raccordements fluides et mise en service — prestation clé en main.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><span class="ico ico-btp"><!--btp--></span></div>
        <div class="service-body">
          <h3>Bâtiment &amp; Génie Civil</h3>
          <p>Travaux de génie civil associés aux projets industriels : fondations, dallages techniques, maçonneries spéciales et ouvrages d'infrastructure.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('target','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Calorifugeage — Isolation Thermique</h3>
          <p>Isolation par laine de roche grillagée sur lignes de vapeur, échappements de bateaux et groupes électrogènes. Lignes d'eau chaude en mousse polyuréthanne injectée dans jaquette tôle galvanisée, inox ou aluminium.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-1">
        <div class="service-icon"><?= icon('briefcase','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Gaines en Panneau "P3" P.U.R. — NOUVEAU</h3>
          <p>Représentant exclusif pour l'Afrique de l'Ouest de la marque PITRE. Panneau P3 en mousse P.U.R., deux faces aluminium naturel verni, épaisseur 20 mm. Permet de réaliser des réseaux de gaines en apparent. Référence : Aéroport de Dakar — gaine 3 voies, 2 soufflages latéraux + reprise centrale, 4 m × 0,6 m × 45 m. Poids posé : 2,2 kg/m².</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-2">
        <div class="service-icon"><?= icon('users','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Faux Plafonds Techniques</h3>
          <p>Fabrication de profilés à froid en tôle galvanisée 6, 8 et 10/10e (porteur plâtre, cornière de rive, "I" primaire, porteur industriel). Faux plafonds isolants en plaques P.U.R. 20 mm, deux faces aluminium — résistance humidité 100%. Faux plafonds acoustiques en dalles minérales 60×60 cm à fort coefficient d'absorption phonique pour bureaux et salles de réunion.</p>
        </div>
      </li>

      <li class="service-item animate-fade-up delay-3">
        <div class="service-icon"><?= icon('map-pin','','1.4rem') ?></div>
        <div class="service-body">
          <h3>Travaux Inox &amp; Travaux sur Cuves</h3>
          <p>Soudage sous argon (TIG) : éléments de cuisine collectivités, tables d'éviscération, de triage, de pesée, d'emballage, étagères et chariots inox. Nettoyage, entretien, réparation, dégazage, neutralisation et découpe de cuves industrielles.</p>
        </div>
      </li>

    </ul>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : ÉQUIPEMENTS INDUSTRIELS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Moyens &amp; Équipements</span>
      <h2 class="section-title">Un parc outillage complet pour intervenir partout</h2>
      <p class="section-sub">
        COTRAC dispose d'un atelier machines-outils et d'équipements de soudage, de levage et de montage pour assurer toutes les prestations industrielles sur site ou en atelier.
      </p>
    </div>

    <style>
    .indus-equip-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:24px; }
    @media (max-width:900px) { .indus-equip-grid { grid-template-columns:repeat(2,1fr); } }
    @media (max-width:560px) { .indus-equip-grid { grid-template-columns:1fr; } }
    </style>
    <div class="indus-equip-grid">

      <?php
      $equipements = [
          [
              'icon'  => '<span class="ico ico-energie"><!--energie--></span>',
              'titre' => 'Soudage &amp; Découpe',
              'items' => [
                  '12 postes à souder',
                  '4 jeux de chalumeaux complets',
                  'Soudage TIG sous argon (inox)',
                  'Électrode enrobée, MIG/MAG',
              ],
          ],
          [
              'icon'  => icon('briefcase','','1.6rem'),
              'titre' => 'Caisses à Outils',
              'items' => [
                  '3 caisses mécaniciens',
                  '3 caisses chaudronnerie',
                  '3 caisses soudeurs',
                  'Outillage de précision calibré',
              ],
          ],
          [
              'icon'  => '<span class="ico ico-poste"><!--poste--></span>',
              'titre' => 'Meulage &amp; Abrasifs',
              'items' => [
                  '2 meuleuses grand modèle',
                  '2 meuleuses petit modèle',
                  'Disques de tronçonnage HP',
                  'Matériels d\'ébavurage et finition',
              ],
          ],
          [
              'icon'  => '<span class="ico ico-btp"><!--btp--></span>',
              'titre' => 'Atelier Machines-Outils',
              'items' => [
                  'Tour parallèle',
                  'Fraiseuse universelle',
                  'Perceuse à colonne',
                  'Équipements d\'ajustage',
              ],
          ],
          [
              'icon'  => icon('zap','','1.6rem'),
              'titre' => 'Levage &amp; Manutention',
              'items' => [
                  'Palans électriques et manuels',
                  'Tir-fort et sangles de levage',
                  'Élingues certifiées',
                  'Échelles et nacelles',
              ],
          ],
          [
              'icon'  => icon('target','','1.6rem'),
              'titre' => 'Montage Industriel',
              'items' => [
                  'Équipements de montage clé en main',
                  'Matériel de mesure et contrôle',
                  'Outillage de serrage et assemblage',
                  'Instrumentation sur site',
              ],
          ],
      ];
      foreach ($equipements as $i => $eq):
        $delay = ($i % 3) + 1;
      ?>
      <div class="valeur-card animate-fade-up delay-<?= $delay ?>" style="padding:28px 24px;">
        <div style="font-size:2rem;margin-bottom:14px;"><?= $eq['icon'] ?></div>
        <h4 style="color:#1a6bb5;font-weight:700;font-size:1.05rem;margin-bottom:14px;"><?= $eq['titre'] ?></h4>
        <ul style="list-style:none;padding:0;margin:0;">
          <?php foreach ($eq['items'] as $item): ?>
          <li style="color:var(--gris);font-size:0.91rem;line-height:1.65;padding:4px 0;border-bottom:1px solid #f0f0f0;display:flex;gap:8px;align-items:baseline;">
            <span style="color:#f7941d;font-weight:700;flex-shrink:0;">›</span>
            <?= e($item) ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : STATS INDUSTRIE
═══════════════════════════════════════════════════════════ -->
<section class="stats-section">
  <div class="container">
    <div class="stats-grid">

      <div class="stat-item animate-fade-up delay-1">
        <span class="number">10<span class="plus">+</span></span>
        <span class="stat-label">Ans d'expérience industrielle</span>
      </div>

      <div class="stat-item animate-fade-up delay-2">
        <span class="number">1T<span class="plus">/j</span></span>
        <span class="stat-label">Capacité de traitement VMC</span>
      </div>

      <div class="stat-item animate-fade-up delay-3">
        <span class="number">12</span>
        <span class="stat-label">Postes à souder disponibles</span>
      </div>

      <div class="stat-item animate-fade-up delay-4">
        <span class="number" style="font-size:1.8rem;">Clé en main</span>
        <span class="stat-label">De la conception à la mise en service</span>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : PHOTO CHANTIER INDUSTRIEL
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="grid-2col" style="gap:40px;align-items:center;">
      <div class="animate-fade-up delay-1">
        <span class="section-tag">Expertise terrain</span>
        <h2 class="section-title" style="font-size:1.8rem;">Représentant exclusif PITRE pour l'Afrique de l'Ouest</h2>
        <p style="color:var(--gris);line-height:1.8;margin-bottom:20px;">
          COTRAC est le représentant exclusif de la marque PITRE pour l'Afrique de l'Ouest, spécialisée dans les panneaux P3 P.U.R. à deux faces aluminium. Ce nouveau matériau permet de réaliser des réseaux de gaines en apparent avec une performance thermique et acoustique inégalée — comme à la salle d'enregistrement de l'Aéroport de Dakar.
        </p>
        <ul style="list-style:none;padding:0;display:flex;flex-direction:column;gap:10px;">
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> Isolation laine de roche sur lignes de vapeur &amp; groupes électrogènes
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> Gaines P3 P.U.R. 20 mm — résistance humidité 100%
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> Travaux inox soudage TIG sous argon pour cuisines collectivités &amp; industries
          </li>
          <li style="display:flex;align-items:center;gap:10px;color:#333;font-weight:500;">
            <span class="text-bleu" style="font-size:1.1rem;font-weight:700;">✓</span> Dégazage, neutralisation et découpe de cuves industrielles
          </li>
        </ul>
      </div>
      <div class="animate-fade-up delay-2">
        <?php $_ind_main = cms_img_url(cms('industrie','services_cards','card1_icon','assets/images/industrie/genie-industriel-chantier.jpg')); ?>
        <img src="<?= e($_ind_main) ?>"
             alt="Chantier génie industriel COTRAC"
             loading="lazy"
             style="width:100%;border-radius:16px;box-shadow:0 12px 48px rgba(0,0,0,0.18);object-fit:cover;max-height:420px;">
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : CALORIFUGEAGE — INTERVENTION SOCOCIM
═══════════════════════════════════════════════════════════ -->
<style>
.calo-galerie-grid { display:grid;grid-template-columns:repeat(2,1fr);gap:24px;margin-top:32px;max-width:900px;margin-left:auto;margin-right:auto; }
@media (max-width:640px) { .calo-galerie-grid { grid-template-columns:1fr; } }
.calo-galerie-grid .galerie-item {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  cursor: pointer;
  aspect-ratio: 3/4;
  background: var(--gris-clair);
  border: 2px solid rgba(255,255,255,.9);
  box-shadow: 0 4px 18px rgba(0,0,0,.12);
  transition: box-shadow .3s, transform .3s;
}
.calo-galerie-grid .galerie-item:hover { box-shadow: 0 8px 32px rgba(26,107,181,.25); transform: translateY(-2px); }
.calo-galerie-grid .galerie-item img { width:100%; height:100%; object-fit:contain; display:block; transition: transform .4s ease; }
.calo-galerie-grid .galerie-item:hover img { transform: scale(1.06); }
.calo-galerie-grid .galerie-item-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(10,22,40,.75) 0%, transparent 55%);
  opacity: 0; transition: opacity .3s;
  display: flex; align-items: flex-end; padding: 14px;
}
.calo-galerie-grid .galerie-item:hover .galerie-item-overlay { opacity: 1; }
.calo-galerie-grid .calo-galerie-caption { color:#fff; font-size:.78rem; font-weight:600; text-shadow:0 1px 4px rgba(0,0,0,.6); letter-spacing:.02em; }
.energie-video-wrap {
  position: relative;
  margin: 0 auto;
  max-width: 100%;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0,0,0,.3);
  border: 1px solid rgba(255,255,255,.1);
}
.energie-video-wrap .energie-video-header {
  display: flex; align-items: center; gap: 8px;
  min-height: 46px;
  padding: 11px 16px; background: #1c2a3e;
  border-bottom: 1px solid rgba(0,0,0,.3);
}
.energie-video-wrap .energie-video-dot { width: 11px; height: 11px; border-radius: 50%; flex-shrink: 0; }
.energie-video-wrap .energie-video-step {
  background:#febc2e; color:#1c2a3e; font-weight:700; font-size:.68rem;
  width:18px; height:18px; border-radius:50%; flex-shrink:0;
  display:flex; align-items:center; justify-content:center; margin-left:4px;
}
.energie-video-wrap .energie-video-title {
  color: rgba(255,255,255,.85); font-size: .78rem; font-weight: 600; letter-spacing: .02em;
  overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.energie-video-wrap video {
  display: block;
  width: 100%;
  height: auto;
  max-height: 520px;
  object-fit: cover;
  background: #000;
}
.energie-video-duration-badge {
  position: absolute; right: 10px; bottom: 10px;
  background: rgba(0,0,0,.75); color: #fff;
  font-size: .72rem; font-weight: 600;
  padding: 2px 8px; border-radius: 4px; z-index: 2;
  pointer-events: none;
}
.energie-video-play-overlay {
  position: absolute; inset: 0; top: 46px;
  display: flex; align-items: center; justify-content: center;
  background: rgba(0,0,0,.12); pointer-events: none; z-index: 1;
  transition: opacity .2s;
}
.energie-video-play-overlay svg { filter: drop-shadow(0 2px 10px rgba(0,0,0,.6)); }
.energie-video-wrap.playing .energie-video-play-overlay,
.energie-video-wrap.playing .energie-video-duration-badge { display: none; }
.calo-video-row {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 32px;
  max-width: 1400px;
  margin-left: auto;
  margin-right: auto;
}
@media (max-width: 900px) {
  .calo-video-row { grid-template-columns: repeat(3, 1fr); gap: 10px; }
  .energie-video-wrap .energie-video-title { font-size: .68rem; }
  .energie-video-wrap .energie-video-header { padding: 8px 10px; min-height: 38px; }
}
</style>
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Calorifugeage industriel — Intervention SOCOCIM</h2>
      <p class="section-sub">
        COTRAC est intervenu sur le site de la cimenterie SOCOCIM pour l'isolation thermique de conduits et structures industrielles en hauteur : façonnage sur mesure des jaquettes en tôle, pose sécurisée avec harnais sur passerelles techniques, et finitions étanches à l'humidité. Une prestation clé en main, de la découpe en atelier jusqu'à la mise en service sur site.
      </p>
    </div>

    <div class="calo-galerie-grid">
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/calo-atelier-decoupe.jpg" alt="Découpe et traçage des tôles en atelier COTRAC" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Atelier — Traçage et découpe des tôles</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/calo-facconnage-jaquette.jpg" alt="Façonnage d'une jaquette de calorifugeage sur cintreuse" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Façonnage de la jaquette sur cintreuse</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/calo-pose-hauteur-4.jpg" alt="Équipe COTRAC en intervention sur passerelle technique SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Intervention sur passerelle technique</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/calo-pose-hauteur-5.jpg" alt="Maintien et fixation de la jaquette métallique" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Maintien et fixation de la jaquette</span></div>
      </div>
    </div>

    <!-- Vidéos player style macOS encadré -->
    <div class="calo-video-row">
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">1</span>
          <span class="energie-video-title">Pose en hauteur</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <span class="energie-video-duration-badge">0:39</span>
        <video
          src="<?= SITE_URL ?>/assets/videos/calo-sococim.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/calo-sococim-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">2</span>
          <span class="energie-video-title">Ajustement jaquette</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <span class="energie-video-duration-badge">0:13</span>
        <video
          src="<?= SITE_URL ?>/assets/videos/calo-sococim-2.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/calo-sococim-2-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">3</span>
          <span class="energie-video-title">Fixation finale</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <span class="energie-video-duration-badge">0:18</span>
        <video
          src="<?= SITE_URL ?>/assets/videos/calo-sococim-3.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/calo-sococim-3-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : GÉNIE INDUSTRIEL — INTERVENTION ICS
═══════════════════════════════════════════════════════════ -->
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Génie industriel &amp; tuyauterie — Intervention ICS</h2>
      <p class="section-sub">
        COTRAC est intervenu sur le site des Industries Chimiques du Sénégal (ICS) pour des travaux de tuyauterie industrielle : soudage de coudes et raccords, montage de canalisations sur structures métalliques, travaux en hauteur sur passerelles techniques et interventions en intérieur d'usine. Une prestation complète mobilisant soudeurs qualifiés et équipements certifiés.
      </p>
    </div>

    <div class="calo-galerie-grid" style="grid-template-columns:repeat(3,1fr);max-width:1200px;">
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-tuyauterie-1.jpg" alt="Soudage de tuyauterie sur structure métallique ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Soudage sur structure métallique</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-coude-1.jpg" alt="Soudage d'un coude de tuyauterie industrielle" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Soudage d'un coude de tuyauterie</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-arc.jpg" alt="Arc de soudure sur raccord de tuyauterie ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Soudure à l'arc — raccord bridé</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-equipe-soudage.jpg" alt="Équipe COTRAC en intervention de soudage ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Équipe COTRAC sur site ICS</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-marquage-tuyau.jpg" alt="Marquage et découpe de tuyauterie industrielle" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Marquage et découpe des tubes</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-interieur-usine-silo.jpg" alt="Intervention en intérieur d'usine ICS près d'un silo de process" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Intervention en intérieur d'usine</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-travail-hauteur-echelle.jpg" alt="Travail en hauteur sur échelle en intérieur d'usine ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Travail en hauteur sur échelle</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-mesure-passerelle.jpg" alt="Mesure et contrôle sur passerelle technique ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Mesure et contrôle sur passerelle</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-coude-2.jpg" alt="Soudage d'un raccord coudé sur tuyauterie ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Finition d'un raccord coudé</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-coude-3.jpg" alt="Soudage de tuyauterie avec poste inverter ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Soudage avec poste inverter</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-tuyauterie-2.jpg" alt="Équipe COTRAC assemblant une tuyauterie sur structure ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Assemblage sur structure métallique</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/gi-soudage-coude-4.jpg" alt="Vue d'ensemble d'un raccord de tuyauterie bridé ICS" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Raccord bridé — vue d'ensemble</span></div>
      </div>
    </div>

    <!-- Vidéos player style macOS encadré -->
    <div style="display:flex;justify-content:center;align-items:flex-start;gap:32px;margin-top:32px;flex-wrap:wrap;">
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">1</span>
          <span class="energie-video-title">Meulage sur site ICS</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <span class="energie-video-duration-badge">0:22</span>
        <video
          src="<?= SITE_URL ?>/assets/videos/gi-ics-1.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/gi-ics-1-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
      <div class="energie-video-wrap animate-fade-up" style="margin-top:0;width:480px;max-width:100%;flex:0 1 480px;">
        <div class="energie-video-header">
          <span class="energie-video-dot" style="background:#ff5f57;"></span>
          <span class="energie-video-dot" style="background:#febc2e;"></span>
          <span class="energie-video-dot" style="background:#28c840;"></span>
          <span class="energie-video-step">2</span>
          <span class="energie-video-title">Soudage TIG — Raccord</span>
        </div>
        <div class="energie-video-play-overlay">
          <svg width="52" height="52" viewBox="0 0 52 52" fill="none"><circle cx="26" cy="26" r="26" fill="rgba(255,255,255,.85)"/><path d="M21 16l16 10-16 10V16z" fill="#1c2a3e"/></svg>
        </div>
        <span class="energie-video-duration-badge">0:17</span>
        <video
          src="<?= SITE_URL ?>/assets/videos/gi-ics-2.mp4"
          controls
          preload="metadata"
          poster="<?= SITE_URL ?>/assets/videos/gi-ics-2-poster.jpg"
          onplay="this.closest('.energie-video-wrap').classList.add('playing')">
          Votre navigateur ne supporte pas la lecture vidéo.
        </video>
      </div>
    </div>
  </div>
</section>

<!-- ═══ Sur le terrain — chantier industriel agroalimentaire ═══ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Sur le terrain</span>
      <h2 class="section-title" style="font-size:1.8rem;">Chantier industriel en milieu agroalimentaire</h2>
      <p class="section-sub">
        Intervention COTRAC dans une unité de production agroalimentaire : ossature métallique, panneaux isothermes,
        réseaux de ventilation. Sur ce type de site, nos équipes appliquent les exigences d'hygiène (charlottes, masques,
        tenues dédiées) et de sécurité (balisage des zones de travail, EPI), en coordination quotidienne avec les équipes du client.
      </p>
    </div>

    <div class="calo-galerie-grid">
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/terrain/chantier-industriel-05.jpg" alt="Zone de chantier balisée : ossature métallique et gaines de ventilation, équipe COTRAC en casque et gilet" loading="lazy" style="object-fit:cover;">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Zone balisée — structure métallique &amp; ventilation</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/terrain/chantier-industriel-04.jpg" alt="Superviseurs COTRAC contrôlant la pose de panneaux derrière le balisage de sécurité" loading="lazy" style="object-fit:cover;">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Supervision de la pose des panneaux</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/terrain/chantier-industriel-01.jpg" alt="Réunion de coordination COTRAC avec l'équipe du client en tenue agroalimentaire" loading="lazy" style="object-fit:cover;">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Coordination sur site avec le client</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/terrain/chantier-industriel-03.jpg" alt="Échanges techniques entre COTRAC et le client sur un chantier industriel agroalimentaire" loading="lazy" style="object-fit:cover;">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Échanges techniques avec le client</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/terrain/transport-cuve-industrielle.jpg" alt="Transport et levage d'une cuve industrielle sur site agroalimentaire" loading="lazy" style="object-fit:cover;">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Transport et levage d'une cuve industrielle</span></div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : MÉCANIQUE INDUSTRIELLE — INTERVENTION SOCOCIM
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Référence chantier</span>
      <h2 class="section-title" style="font-size:1.8rem;">Mécanique industrielle — Intervention SOCOCIM</h2>
      <p class="section-sub">
        COTRAC est intervenu sur le site de la cimenterie SOCOCIM pour la maintenance mécanique d'équipements de manutention et de transport de matières : remplacement de moteurs, manchettes et gaines d'alimentation, remise en état de vis d'extraction et de trémies de process, en environnement de production confiné et poussiéreux.
      </p>
    </div>

    <div class="calo-galerie-grid" style="grid-template-columns:repeat(4,1fr);max-width:1200px;">
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-equipe-intervention-1.jpg" alt="Équipe COTRAC en intervention mécanique sur équipement SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Équipe COTRAC en intervention</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-moteur-manchette.jpg" alt="Remplacement d'un moteur et d'une manchette d'alimentation" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Moteur et manchette d'alimentation</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-intervention-vis.jpg" alt="Intervention sur vis d'extraction industrielle SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Intervention sur vis d'extraction</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-vue-ensemble-1.jpg" alt="Vue d'ensemble de l'intervention mécanique sur équipement de process" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Vue d'ensemble de l'équipement</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-equipe-intervention-2.jpg" alt="Équipe COTRAC démontant un équipement mécanique poussiéreux" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Démontage de l'équipement</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-3" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-gaine-neuve.jpg" alt="Gaine métallique neuve installée sur trémie de process SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Gaine neuve installée</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-1" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-equipe-intervention-3.jpg" alt="Équipe COTRAC au travail sur trémie d'alimentation SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Travail sur trémie d'alimentation</span></div>
      </div>
      <div class="galerie-item animate-fade-up delay-2" onclick="iLbOpen(this.querySelector('img').src, this.querySelector('img').alt)">
        <img src="<?= SITE_URL ?>/assets/images/industrie/meca-equipe-intervention-4.jpg" alt="Équipe COTRAC finalisant l'intervention mécanique SOCOCIM" loading="lazy">
        <div class="galerie-item-overlay"><span class="calo-galerie-caption">Finalisation de l'intervention</span></div>
      </div>
    </div>
  </div>
</section>

<!-- Lightbox dédié aux galeries calorifugeage / ICS / mécanique -->
<div id="iLightbox" class="i-lightbox" onclick="iLbClose(event)">
  <button class="i-lightbox-close" onclick="iLbClose(null, true)">&times;</button>
  <img id="iLightboxImg" src="" alt="">
</div>
<style>
.i-lightbox {
  display: none; position: fixed; inset: 0; z-index: 99999;
  background: rgba(10,22,40,.92);
  align-items: center; justify-content: center;
  backdrop-filter: blur(6px);
  animation: iLbFade .2s ease;
}
.i-lightbox.open { display: flex; }
.i-lightbox img {
  max-width: 97vw; max-height: 96vh; object-fit: contain;
  border-radius: 10px; box-shadow: 0 20px 60px rgba(0,0,0,.5);
  animation: iLbZoom .25s cubic-bezier(0.22,1,0.36,1);
}
.i-lightbox-close {
  position: absolute; top: 20px; right: 24px;
  background: rgba(255,255,255,.12); border: none; color: #fff;
  width: 44px; height: 44px; border-radius: 50%; font-size: 1.6rem; line-height: 1;
  cursor: pointer; transition: background .2s;
}
.i-lightbox-close:hover { background: rgba(255,255,255,.25); }
@keyframes iLbFade { from { opacity: 0; } to { opacity: 1; } }
@keyframes iLbZoom { from { opacity: 0; transform: scale(.9); } to { opacity: 1; transform: scale(1); } }
</style>
<script>
function iLbOpen(src, alt) {
  const lb = document.getElementById('iLightbox');
  document.getElementById('iLightboxImg').src = src;
  document.getElementById('iLightboxImg').alt = alt || '';
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function iLbClose(e, force) {
  if (force || !e || e.target.id === 'iLightbox') {
    document.getElementById('iLightbox').classList.remove('open');
    document.body.style.overflow = '';
  }
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') iLbClose(null, true);
});
</script>


<!-- ═══ Levage & transport d'équipements industriels ═══ -->
<section class="section" style="background:#fff;">
  <div class="container">
    <div class="grid-2col" style="gap:40px;align-items:center;">
      <div class="animate-fade-up delay-1">
        <span class="section-tag">Sur le terrain</span>
        <h2 class="section-title" style="font-size:1.8rem;">Levage &amp; Transport d'Équipements Industriels</h2>
        <p style="color:var(--gris);line-height:1.8;">
          Manutention et transport de cuves et équipements de grand gabarit vers site industriel : grue mobile, remorque surbaissée et équipe qualifiée pour sécuriser chaque étape du levage jusqu'à la mise en place.
        </p>
      </div>
      <div class="animate-fade-up delay-2">
        <img src="<?= SITE_URL ?>/assets/images/industrie/levage-cuve-site-industriel.jpg"
             alt="Levage et transport d'une cuve industrielle par grue mobile sur site"
             loading="lazy"
             style="width:100%;border-radius:16px;box-shadow:0 12px 48px rgba(0,0,0,0.18);object-fit:cover;max-height:420px;cursor:pointer;"
             onclick="iLbOpen(this.src, this.alt)">
      </div>
    </div>
  </div>
</section>

<!-- Galerie « Nos réalisations industrielles » retirée le 2026-09-17 (voir industrie.php.avant-suppression-galerie) -->

<!-- ═══════════════════════════════════════════════════════════
     SECTION : CTA
═══════════════════════════════════════════════════════════ -->
<style>
@media(max-width:768px){
  .cta-section-inner{min-height:auto!important;}
  .cta-grid{grid-template-columns:1fr!important;gap:32px!important;}
}
</style>
<section class="cta-section-inner" style="position:relative;overflow:hidden;min-height:420px;display:flex;align-items:center;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cta-fond.jpg" alt="Chantier COTRAC"
       style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center top;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,35,80,0.88) 55%,rgba(10,35,80,0.55));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container cta-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:32px;align-items:center;">

    <!-- Gauche : contact info -->
    <div class="animate-fade-up delay-1">
      <span class="section-tag orange">Devis gratuit</span>
      <h2 class="section-title light" style="margin-top:10px;">Un projet industriel ? Parlons-en.</h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        Construction mécanique, calorifugeage, charpente métallique, gaines P3 ou travaux sur cuves — nos équipes étudient votre projet et vous proposent une solution clé en main adaptée à vos contraintes.
      </p>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <a href="tel:+221338279639" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','.95rem') ?></span>
          +221 33 827 96 39
        </a>
        <a href="mailto:cotracsenegal@gmail.com" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','.95rem') ?></span>
          cotracsenegal@gmail.com
        </a>
        <div style="display:flex;align-items:center;gap:14px;color:rgba(255,255,255,0.72);font-weight:500;">
          <span style="background:rgba(255,255,255,0.12);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('map-pin','','.95rem') ?></span>
          Dakar, Sénégal — Zone industrielle
        </div>
      </div>
    </div>

    <!-- Droite : carte action -->
    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#f7941d;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('briefcase','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;">Demandez votre étude technique</h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        Nos ingénieurs analysent vos besoins et vous remettent une offre détaillée sous 48 h — installation, maintenance ou fourniture d'équipements.
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> Demander un devis
        </a>
        <a href="<?= SITE_URL ?>/realisations.php?pole=industrie" class="btn btn-outline" style="width:100%;justify-content:center;">
          <?= icon('briefcase','','.9rem') ?> Voir nos réalisations
        </a>
        <a href="<?= SITE_URL ?>/assets/docs/plaquette-industrie.pdf" download
           style="width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px;border-radius:10px;background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.85);text-decoration:none;font-size:.88rem;font-weight:600;">
          <?= icon('file','','.9rem') ?> Télécharger la plaquette PDF
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">48h</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Délai de réponse</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">Gratuit</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Étude &amp; devis</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">10+</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Ans d'expertise</div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>


<?php require_once 'includes/footer.php'; ?>
