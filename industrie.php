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
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac2.png" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 5%;z-index:0;">
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

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px;">

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


<?php
$galerie_titre  = 'Nos réalisations industrielles';
$galerie_photos = [
  ['src'=>'assets/images/industrie/genie-industriel-chantier.jpg', 'alt'=>'Chantier génie industriel',      'caption'=>'Génie industriel — tuyauterie HP'],
  ['src'=>'assets/images/energie/support-mesure.jpg',              'alt'=>'Mesures et contrôle technique',  'caption'=>'Contrôle &amp; mesure sur site'],
  ['src'=>'assets/images/energie/raccordement-cable.jpg',          'alt'=>'Raccordement technique',         'caption'=>'Raccordement électrique industriel'],
  ['src'=>'assets/images/energie/tetes-cable-hta.jpg',            'alt'=>'Têtes de câble HTA',             'caption'=>'Installation têtes de câble'],
  ['src'=>'assets/images/equipe/ingenieure-plans.jpg',             'alt'=>'Ingénieure sur plans industriels','caption'=>'Conception et étude technique'],
  ['src'=>'assets/images/energie/pose-poteau-mesure.jpg',         'alt'=>'Mesure sur pylône',              'caption'=>'Instrumentation et mesure'],
];
require 'includes/galerie.php';
?>

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
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac-chantier.jpg" alt="Chantier COTRAC"
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
