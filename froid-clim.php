<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';
$page_title = 'Génie Industriel Froid & Climatisation | COTRAC';
$page_desc  = 'COTRAC réalise l\'isolation cryogénique et frigorifique, la fabrication de chambres froides, de gaines VMC et de portes de chambres froides au Sénégal. Expertise nautique, industrielle et agroalimentaire.';
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
        <a href="<?= SITE_URL ?>/index.php">Accueil</a>
        <span class="sep">›</span>
        <a href="<?= SITE_URL ?>/index.php#poles">Pôles</a>
        <span class="sep">›</span>
        <span>Froid &amp; Climatisation</span>
      </nav>
      <h1 class="page-hero-title animate-fade-up">
        Froid &amp; Climatisation<br><span style="color:#f7941d;">Génie Industriel</span>
      </h1>
      <p class="page-hero-desc animate-fade-up delay-1">
        Isolation cryogénique et frigorifique, chambres froides, gaines VMC et portes isothermes — COTRAC intervient de l'industrie navale aux entrepôts agroalimentaires, clé en main.
      </p>
      <div class="animate-fade-up delay-2" style="display:flex;gap:14px;margin-top:28px;flex-wrap:wrap;">
        <a href="<?= SITE_URL ?>/contact" class="btn btn-primary">Demander un devis</a>
        <a href="<?= SITE_URL ?>/realisations" class="btn btn-outline" style="border-color:rgba(255,255,255,0.5);color:#fff;">Nos réalisations</a>
      </div>
    </div>
    <div class="animate-fade-up delay-2" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:16px;">
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">-40°C</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Tunnels congélation</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">-18°C</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Cales conservation</div>
      </div>
      <div style="background:rgba(255,255,255,0.09);border:1px solid rgba(255,255,255,0.15);border-radius:14px;padding:22px 18px;text-align:center;backdrop-filter:blur(6px);">
        <div style="font-size:2.2rem;font-weight:800;color:#f7941d;line-height:1;">1 T/j</div>
        <div style="font-size:.74rem;color:rgba(255,255,255,0.72);margin-top:5px;text-transform:uppercase;letter-spacing:.08em;">Capacité VMC</div>
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
      <h2 class="section-title">Froid Industriel &amp; Climatisation</h2>
      <p class="section-sub">De l'isolation cryogénique à la fabrication de gaines VMC, nous couvrons l'ensemble des besoins en génie froid pour l'industrie navale, agroalimentaire et le tertiaire.</p>
    </div>

    <div class="poles-grid" style="margin-top:40px;">

      <!-- Isolation cryogénique & frigorifique -->
      <div class="pole-card animate-fade-up delay-1" style="border-top-color:#0891b2;">
        <div class="pole-icon" style="background:rgba(8,145,178,0.1);">
          <span class="ico ico-industrie"></span>
        </div>
        <h3 class="pole-title">Isolation Cryogénique &amp; Frigorifique</h3>
        <p class="pole-desc">Injection de mousse P.U.R dans une jaquette en tôle galva aluminium ou inox. Interventions sur l'ICS MBAO, les sphères de stockage et les lignes d'ammoniac, ainsi que les installations ARMEMENT SOPASEN (lignes Fréon/Ammoniac à bord des chalutiers-congélateurs et chambres froides de stockage).</p>
        <div class="pole-tags">
          <span class="tag">Mousse P.U.R</span>
          <span class="tag">Tôle galva / inox</span>
          <span class="tag">Ammoniac</span>
          <span class="tag">ICS MBAO</span>
        </div>
      </div>

      <!-- Isolation anti-condensation navale -->
      <div class="pole-card animate-fade-up delay-2">
        <div class="pole-icon">
          <span class="ico ico-energie"></span>
        </div>
        <h3 class="pole-title">Isolation Navale Anti-Condensation</h3>
        <p class="pole-desc">Injection de mousse P.U.R dans les doubles parois des tunnels de congélation (-40°C) et des cales de conservation (-18°C/-20°C) à bord des chalutiers. Traitement complet des lignes de Fréon ou d'Ammoniac pour les chalutiers-congélateurs.</p>
        <div class="pole-tags">
          <span class="tag">-40°C tunnels</span>
          <span class="tag">-18°C / -20°C cales</span>
          <span class="tag">Chalutiers-congélateurs</span>
          <span class="tag">Fréon / Ammoniac</span>
        </div>
      </div>

      <!-- Climatisation / VMC / Extraction de cuisines -->
      <div class="pole-card animate-fade-up delay-3">
        <div class="pole-icon">
          <span class="ico ico-routes"></span>
        </div>
        <h3 class="pole-title">Climatisation / VMC / Extraction de Cuisines</h3>
        <p class="pole-desc">Fabrication de gaine métallique en tôle galvanisée de 6 à 15/10ème, assemblage cadre METU ou similaire. Capacité de production : 1 T/jour. Fabrication de gaine cylindrique agrafée en tronçons de 1 à 6 m et toutes pièces de transformation : coudes, réductions, piqûages.</p>
        <div class="pole-tags">
          <span class="tag">Gaine tôle galvanisée</span>
          <span class="tag">Cadre METU</span>
          <span class="tag">Gaine cylindrique</span>
          <span class="tag">Coudes / Réductions</span>
        </div>
      </div>

      <!-- Chambres froides -->
      <div class="pole-card animate-fade-up delay-4">
        <div class="pole-icon">
          <span class="ico ico-target"></span>
        </div>
        <h3 class="pole-title">Chambres Froides Négatives &amp; Positives</h3>
        <p class="pole-desc">Petites unités : fabrication de panneaux P.U.R deux faces tôle galvanisée 6/10ème nervurées, type industriel, longueur max 4 m, épaisseur max 200 mm. Grandes unités : importation panneaux ISOCAB jusqu'à 12 m — réhabilitation de chambre froide.</p>
        <div class="pole-tags">
          <span class="tag">Panneaux P.U.R</span>
          <span class="tag">ISOCAB 12 m</span>
          <span class="tag">Chambre positive</span>
          <span class="tag">Chambre négative</span>
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
        ['icon'=>'zap',    'titre'=>'Injection mousse P.U.R — Jaquette galva / inox',
         'desc'=>'Isolation cryogénique et frigorifique par injection de mousse polyuréthane rigide (P.U.R) dans une jaquette en tôle galva aluminium ou inox. Résultat : isolation continue sans pont thermique.'],
        ['icon'=>'globe',  'titre'=>'Lignes ammoniac &amp; Fréon — SOPASEN',
         'desc'=>'Installation et isolation des lignes de Fréon ou d\'Ammoniac à bord des chalutiers-congélateurs et sur les chambres froides de stockage ARMEMENT SOPASEN.'],
        ['icon'=>'wrench', 'titre'=>'Tunnels de congélation (-40°C)',
         'desc'=>'Injection P.U.R dans les doubles parois des tunnels de congélation atteignant -40°C à bord des chalutiers. Étanchéité thermique garantissant la qualité des produits de la mer.'],
        ['icon'=>'map-pin','titre'=>'Cales de conservation (-18°C / -20°C)',
         'desc'=>'Isolation des cales de conservation maintenues entre -18°C et -20°C : injection P.U.R en double paroi à bord des navires chalutiers.'],
        ['icon'=>'target', 'titre'=>'Fabrication de gaines VMC &amp; extraction',
         'desc'=>'Gaines métalliques en tôle galvanisée 6 à 15/10ème, cadres METU — capacité 1 T/jour. Gaines cylindriques agrafées, tronçons 1 à 6 m, coudes, réductions, piqûages.'],
        ['icon'=>'users',  'titre'=>'Portes de chambres froides &amp; rideaux lanières',
         'desc'=>'Portes positives pivotantes (80 à 120 mm, passage 1,90 m × 0,90 m), bâti à sceller, faces inox, fermeture FERMOD, joint double lèvre 19 mm. Portes négatives avec résistance chauffante dans le seuil.'],
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
     SECTION : PORTES DE CHAMBRES FROIDES — DÉTAIL TECHNIQUE
═══════════════════════════════════════════════════════════ -->
<section class="section">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Portes isothermes</span>
      <h2 class="section-title">Portes de Chambres Froides &amp; Rideaux à Lanières</h2>
      <p class="section-sub">Fabrication et pose de portes positives et négatives sur mesure, conformes aux exigences des installations agroalimentaires et industrielles.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:32px;margin-top:44px;align-items:start;">

      <!-- Portes positives -->
      <div style="background:#fff;border:1px solid var(--border);border-radius:18px;padding:32px 28px;">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
          <div style="background:rgba(26,107,181,0.1);border-radius:12px;width:48px;height:48px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('zap','#1a6bb5','1.2rem') ?></div>
          <h3 style="font-size:1.05rem;font-weight:700;color:var(--texte);margin:0;">Portes Positives Pivotantes</h3>
        </div>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
          <?php
          $specs_pos = [
            'Épaisseur standard : 80 mm à 120 mm',
            'Passage : 1,90 m × 0,90 m',
            'Bâti à sceller',
            'Habillage inox sur les 2 faces vues',
            '2 faces tôles pré-laquées avec chant inox',
            '2 charnières avec ou sans rampe (selon poids)',
            'Fermeture 1 point à clé FERMOD',
            'Joint double lèvre épaisseur 19 mm',
          ];
          foreach ($specs_pos as $spec):
          ?>
          <li style="display:flex;align-items:flex-start;gap:10px;font-size:.88rem;color:var(--gris);">
            <span style="color:#1a6bb5;font-size:1rem;flex-shrink:0;margin-top:1px;">✓</span>
            <?= $spec ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Portes négatives -->
      <div style="background:#fff;border:1px solid var(--border);border-radius:18px;padding:32px 28px;">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:20px;">
          <div style="background:rgba(8,145,178,0.1);border-radius:12px;width:48px;height:48px;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><?= icon('zap','#0891b2','1.2rem') ?></div>
          <h3 style="font-size:1.05rem;font-weight:700;color:var(--texte);margin:0;">Portes Négatives &amp; Rideaux à Lanières</h3>
        </div>
        <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:12px;">
          <?php
          $specs_neg = [
            'Résistance chauffante intégrée dans le seuil à sceller',
            'Résistance chauffante dans le cadre de porte',
            'Empêche le givrage du joint et du seuil',
            'Rideaux à lanières PVC transparentes',
            'Isolation thermique renforcée pour températures négatives',
            'Versions sur mesure disponibles',
          ];
          foreach ($specs_neg as $spec):
          ?>
          <li style="display:flex;align-items:flex-start;gap:10px;font-size:.88rem;color:var(--gris);">
            <span style="color:#0891b2;font-size:1rem;flex-shrink:0;margin-top:1px;">✓</span>
            <?= $spec ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════════════════
     SECTION : SECTEURS CLIENTS
═══════════════════════════════════════════════════════════ -->
<section class="section bg-gris">
  <div class="container">
    <div class="text-center">
      <span class="section-tag">Secteurs clients</span>
      <h2 class="section-title">Qui nous accompagnons</h2>
      <p class="section-sub">De la pêche industrielle aux entrepôts frigorifiques, nos équipes interviennent partout où la maîtrise du froid est critique.</p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:20px;margin-top:40px;">
      <?php
      $secteurs = [
        ['emoji'=>'🚢', 'nom'=>'Pêche industrielle',    'desc'=>'Chalutiers-congélateurs, cales de conservation, lignes Fréon / Ammoniac embarquées'],
        ['emoji'=>'🥩', 'nom'=>'Agroalimentaire',        'desc'=>'Chambres froides, tunnels de congélation, entrepôts frigorifiques'],
        ['emoji'=>'🏭', 'nom'=>'Industrie',              'desc'=>'Sphères de stockage, lignes ammoniac, ICS MBAO'],
        ['emoji'=>'🏢', 'nom'=>'Tertiaire / VMC',        'desc'=>'Fabrication de gaines, extraction de cuisines, ventilation mécanique contrôlée'],
        ['emoji'=>'❄️', 'nom'=>'Stockage froid',         'desc'=>'Réhabilitation de chambres froides, panneaux ISOCAB grandes portées'],
        ['emoji'=>'🔧', 'nom'=>'Naval / Armement',       'desc'=>'ARMEMENT SOPASEN, lignes de réfrigération à bord, isolation anti-condensation'],
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
  <div class="container cta-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:32px;align-items:center;">

    <div class="animate-fade-up delay-1">
      <span class="section-tag orange">Devis gratuit</span>
      <h2 class="section-title light" style="margin-top:10px;">Un projet froid ou climatisation ?</h2>
      <p style="color:rgba(255,255,255,0.82);line-height:1.8;margin-bottom:28px;">
        Notre équipe analyse votre besoin — isolation cryogénique, chambre froide, gaine VMC ou portes isothermes — et vous propose une solution clé en main adaptée à votre secteur.
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
        <a href="<?= SITE_URL ?>/contact" class="btn btn-primary" style="width:100%;justify-content:center;">
          <?= icon('mail','','.9rem') ?> Demander un devis
        </a>
        <a href="<?= SITE_URL ?>/realisations" class="btn btn-outline" style="width:100%;justify-content:center;border-color:rgba(255,255,255,0.4);color:#fff;">
          <?= icon('target','','.9rem') ?> Voir nos réalisations
        </a>
      </div>
      <div style="display:flex;justify-content:space-around;margin-top:22px;padding-top:18px;border-top:1px solid rgba(255,255,255,0.12);">
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">-40°C</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Congélation</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">1 T/j</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Capacité VMC</div>
        </div>
        <div style="text-align:center;">
          <div style="font-size:1.2rem;font-weight:800;color:#f7941d;">Clé en main</div>
          <div style="font-size:.72rem;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:.07em;">Installation</div>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
