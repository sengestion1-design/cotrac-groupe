<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Génie Industriel Froid & Climatisation | COTRAC';
$page_desc  = 'COTRAC installe et maintient vos systèmes de froid industriel et de climatisation au Sénégal : chambres froides, groupes froids, split-systems, VRV/VRF, centrales de traitement d\'air et maintenance préventive.';
require_once 'includes/header.php';
?>

<!-- ═══════════════════════════════════════════════════════════
     PAGE HERO
═══════════════════════════════════════════════════════════ -->
<section class="page-hero" style="position:relative;overflow:hidden;min-height:420px;">
  <img src="<?= SITE_URL ?>/assets/images/equipe/cotrac2.png" alt="" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center 5%;z-index:0;">
  <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,30,70,0.85) 50%,rgba(10,30,70,0.65));z-index:1;"></div>
  <div style="position:relative;z-index:2;width:100%;">
  <div class="container grid-2col" style="gap:48px;align-items:center;">
    <div>
      <nav class="breadcrumb">
        <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles"><?= t('nav_poles') ?></a>
        <span class="sep">›</span>
        <span>Génie Industriel Froid & Climatisation</span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        Génie Industriel<br><span style="color:#f7941d;">Froid & Climatisation</span>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        Installation, maintenance et conception de systèmes frigorifiques industriels et de climatisation pour l'industrie agroalimentaire, pharmaceutique, hôtelière et tertiaire au Sénégal.
      </p>
      <div class="animate-fade-up delay-2" style="display:flex;gap:14px;margin-top:28px;flex-wrap:wrap;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary">Demander un devis</a>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-outline" style="border-color:rgba(255,255,255,0.5);color:#fff;">Nos réalisations</a>
      </div>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">-40°C</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Temp. minimale</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">1 T/j</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Capacité froid</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">24/7</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Maintenance</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:1.5rem;font-weight:800;color:#f7941d;line-height:1;">Clé en main</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Installation</div>
      </div>
    </div>
  </div>
  </div><!-- /z-index wrapper -->
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : NOS DOMAINES D'INTERVENTION
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Nos domaines</span>
      <h2 class="section-title">Froid Industriel & Climatisation</h2>
      <p class="section-sub">De la conception à la maintenance, nous couvrons l'ensemble des besoins en génie froid et climatisation pour les secteurs industriel, commercial et tertiaire.</p>
    </div>

    <div class="poles-grid" style="margin-top:40px;">

      <!-- Chambres froides -->
      <div class="pole-card animate-fade-up delay-1">
        <div class="pole-icon">
          <span class="ico ico-industrie"></span>
        </div>
        <h3 class="pole-title">Chambres Froides</h3>
        <p class="pole-desc">Conception et installation de chambres froides positives et négatives pour l'industrie agroalimentaire, pharmaceutique et hôtelière. Panneaux PUR deux faces et panneaux ISOCAB grandes portées.</p>
        <div class="pole-tags">
          <span class="tag">Chambre positive</span>
          <span class="tag">Chambre négative</span>
          <span class="tag">Surgélation</span>
          <span class="tag">HACCP</span>
        </div>
      </div>

      <!-- Groupes froids & Réfrigération -->
      <div class="pole-card animate-fade-up delay-2">
        <div class="pole-icon">
          <span class="ico ico-energie"></span>
        </div>
        <h3 class="pole-title">Groupes Froids & Réfrigération</h3>
        <p class="pole-desc">Installation de groupes froids industriels, évaporateurs, condenseurs et systèmes de réfrigération complets. Fluides frigorigènes R404A, R448A, R134a et gaz naturels (NH3, CO2).</p>
        <div class="pole-tags">
          <span class="tag">Groupe froid</span>
          <span class="tag">Évaporateur</span>
          <span class="tag">Condenseur</span>
          <span class="tag">R404A / R448A</span>
        </div>
      </div>

      <!-- Climatisation & CVC -->
      <div class="pole-card animate-fade-up delay-3">
        <div class="pole-icon">
          <span class="ico ico-routes"></span>
        </div>
        <h3 class="pole-title">Climatisation & CVC</h3>
        <p class="pole-desc">Installation de systèmes split, multi-splits, VRV/VRF et centrales de traitement d'air (CTA) pour bureaux, hôtels, centres commerciaux et unités industrielles.</p>
        <div class="pole-tags">
          <span class="tag">Split System</span>
          <span class="tag">VRV / VRF</span>
          <span class="tag">Centrale CTA</span>
          <span class="tag">Gainable</span>
        </div>
      </div>

      <!-- Maintenance & SAV -->
      <div class="pole-card animate-fade-up delay-4" style="border-top-color:#0891b2;">
        <div class="pole-icon" style="background:rgba(8,145,178,0.1);">
          <span class="ico ico-target"></span>
        </div>
        <h3 class="pole-title">Maintenance & SAV</h3>
        <p class="pole-desc">Contrats de maintenance préventive et curative 24h/24 pour vos installations frigorifiques et de climatisation. Intervention rapide, pièces d'origine, suivi des paramètres par télésurveillance.</p>
        <div class="pole-tags">
          <span class="tag">Maintenance préventive</span>
          <span class="tag">Dépannage 24/7</span>
          <span class="tag">Télésurveillance</span>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : PRESTATIONS DÉTAILLÉES
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Nos prestations</span>
      <h2 class="section-title">Ce que nous réalisons</h2>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;margin-top:40px;">

      <?php
      $prestations = [
        ['icon'=>'zap',   'titre'=>'Installations frigorifiques clé en main',
         'desc'=>'Étude thermique, fourniture matériel, installation, mise en service et formation des techniciens sur site.'],
        ['icon'=>'wrench','titre'=>'Isolation thermique & calorifugeage',
         'desc'=>'Isolation des réseaux de tuyauteries et équipements avec laine de verre, mousse PUR et revêtements aluminium.'],
        ['icon'=>'globe', 'titre'=>'Panneaux isothermes',
         'desc'=>'Panneaux PUR deux faces tôle galvanisée jusqu\'à 4 m de hauteur. Panneaux ISOCAB grandes portées jusqu\'à 12 m sans support intermédiaire.'],
        ['icon'=>'target','titre'=>'Faux plafonds techniques',
         'desc'=>'Faux plafonds isolants PUR 20 mm deux faces aluminium (60×60, 120×120, 200×120 cm) et faux plafonds acoustiques pour zones de production.'],
        ['icon'=>'users', 'titre'=>'Climatisation tertiaire & industrielle',
         'desc'=>'Conception et pose de systèmes CVC pour surfaces commerciales, immeubles de bureaux, hôtels et salles blanches.'],
        ['icon'=>'map-pin','titre'=>'Télésurveillance & contrôle',
         'desc'=>'Tableaux de contrôle automatisés, alarmes de température, enregistreurs de données et supervision à distance pour vos installations froides.'],
      ];
      foreach ($prestations as $p):
      ?>
      <div class="valeur-card animate-fade-up" style="text-align:left;">
        <div class="valeur-icon" style="margin-bottom:14px;"><?= icon($p['icon'],'#0891b2','1.3rem') ?></div>
        <h3 style="font-size:1rem;margin-bottom:8px;"><?= $p['titre'] ?></h3>
        <p style="font-size:.88rem;color:var(--gris);line-height:1.7;"><?= $p['desc'] ?></p>
      </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : SECTEURS CLIENTS
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Secteurs clients</span>
      <h2 class="section-title">Qui nous accompagnons</h2>
      <p class="section-sub">Nos équipes interviennent dans tous les secteurs nécessitant une maîtrise rigoureuse de la température et du confort thermique.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;margin-top:40px;">
      <?php
      $secteurs = [
        ['emoji'=>'🥩', 'nom'=>'Agroalimentaire',     'desc'=>'Abattoirs, poissonneries, laiteries, entrepôts frigorifiques'],
        ['emoji'=>'💊', 'nom'=>'Pharmaceutique',      'desc'=>'Stockage médicaments, laboratoires, chaîne du froid'],
        ['emoji'=>'🏨', 'nom'=>'Hôtellerie',          'desc'=>'Chambres froides cuisine, climatisation chambres & salles'],
        ['emoji'=>'🏢', 'nom'=>'Tertiaire',            'desc'=>'Bureaux, centres commerciaux, salles de réunion'],
        ['emoji'=>'🏭', 'nom'=>'Industrie',            'desc'=>'Unités de production, entrepôts logistiques, salles blanches'],
        ['emoji'=>'⚗️',  'nom'=>'Recherche & Santé',  'desc'=>'Hôpitaux, cliniques, centres de recherche'],
      ];
      foreach ($secteurs as $s):
      ?>
      <div style="background:#fff;border:1px solid var(--border);border-radius:14px;padding:24px 20px;text-align:center;transition:var(--transition);"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 36px rgba(8,145,178,0.12)'"
           onmouseout="this.style.transform='';this.style.boxShadow=''">
        <div style="font-size:2.2rem;margin-bottom:10px;"><?= $s['emoji'] ?></div>
        <h3 style="font-size:.95rem;font-weight:700;color:var(--texte);margin-bottom:6px;"><?= $s['nom'] ?></h3>
        <p style="font-size:.78rem;color:var(--gris);line-height:1.5;"><?= $s['desc'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     CTA CONTACT
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
  <div class="container cta-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:56px;align-items:center;">

    <div class="animate-fade-up delay-1">
      <span class="section-tag orange">Devis gratuit</span>
      <h2 class="section-title light" style="margin-top:10px;">Un projet froid ou climatisation ?</h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        Notre bureau d'études analyse votre besoin et vous propose une solution adaptée — chambre froide, groupe froid, climatisation ou maintenance — en forfait ou en régie.
      </p>
      <div style="display:flex;flex-direction:column;gap:14px;">
        <a href="tel:+221338279639" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('phone','','.95rem') ?></span>
          +221 33 827 96 39<br>+221 77 630 16 46
        </a>
        <a href="mailto:cotracsenegal@gmail.com" style="display:flex;align-items:center;gap:14px;color:#fff;text-decoration:none;font-weight:500;">
          <span style="background:#f7941d;border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('mail','','.95rem') ?></span>
          cotracsenegal@gmail.com
        </a>
      </div>
    </div>

    <div class="animate-fade-up delay-2" style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:20px;padding:36px 32px;backdrop-filter:blur(6px);text-align:center;">
      <div style="background:#0891b2;border-radius:14px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;"><?= icon('zap','#fff','1.4rem') ?></div>
      <h3 style="color:#fff;font-size:1.2rem;font-weight:700;margin-bottom:10px;">Étude technique gratuite</h3>
      <p style="color:rgba(255,255,255,0.75);font-size:.92rem;line-height:1.7;margin-bottom:24px;">
        Dimensionnement thermique, choix des équipements, chiffrage — notre équipe vous répond sous 48h.
      </p>
      <div style="display:flex;flex-direction:column;gap:12px;">
        <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> Demander un devis
        </a>
        <a href="<?= SITE_URL ?>/realisations.php" class="btn btn-outline" style="width:100%;justify-content:center;border-color:rgba(255,255,255,0.4);color:#fff;">
          <?= icon('target','','.9rem') ?> Voir nos réalisations
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">48h</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Réponse</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">Gratuit</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Étude</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">24/7</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">SAV</div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
