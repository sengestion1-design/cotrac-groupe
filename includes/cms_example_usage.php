<?php
/**
 * COTRAC CMS — Exemple d'integration dans une page publique
 *
 * Copiez ce pattern dans chaque page publique (btp.php, energie.php, etc.)
 * Le CMS retourne NULL pour les champs non remplis => fallback vers le texte statique existant.
 *
 * ETAPE 1 : En haut de la page publique, apres require_once 'config/database.php':
 */

// require_once 'config/database.php';
// require_once 'includes/cms.php';
//
// $cms = cms_get_page('btp'); // slug de la page courante


/**
 * ETAPE 2 : Utilisation dans le HTML avec fallback
 */

// --- HERO ---
// Avant :
//   <h1>Pole BTP</h1>
//   <p>Nos expertises en construction</p>
//
// Apres :
/*
<section class="hero"
  <?php if (!empty($cms['hero']['bg_image'])): ?>
    style="background-image: url('<?= cms_image_url($cms['hero']['bg_image'] ?? '') ?>')"
  <?php endif; ?>
>
  <h1><?= e(cms_field($cms, 'hero', 'title', 'Pole BTP')) ?></h1>
  <p><?= e(cms_field($cms, 'hero', 'subtitle', 'Nos expertises en construction')) ?></p>
  <?php $btn = cms_field($cms, 'hero', 'btn_text', ''); if ($btn): ?>
    <a href="<?= e(cms_field($cms, 'hero', 'btn_url', '#')) ?>" class="btn-cta">
      <?= e($btn) ?>
    </a>
  <?php endif; ?>
</section>
*/


// --- SECTION TEXTE ---
// Avant :
//   <h2>Notre expertise BTP</h2>
//   <p>Texte statique...</p>
//
// Apres :
/*
<section class="intro">
  <h2><?= e(cms_field($cms, 'intro_text', 'title', 'Notre expertise BTP')) ?></h2>
  <?php
    $body = cms_field($cms, 'intro_text', 'body', '');
    if ($body):
  ?>
    <div class="rich-text"><?= $body /* Le HTML est stocke brut, echappe a la saisie */ ?></div>
  <?php else: ?>
    <p>Texte statique de secours...</p>
  <?php endif; ?>
</section>
*/


// --- STATS ---
/*
<section class="stats-section">
  <div class="stats-grid">
    <?php for ($i = 1; $i <= 4; $i++):
      $val = cms_field($cms, 'stats', 'stat'.$i.'_value', '');
      $lbl = cms_field($cms, 'stats', 'stat'.$i.'_label', '');
      if (!$val && !$lbl) continue;
    ?>
    <div class="stat-item">
      <strong><?= e($val) ?></strong>
      <span><?= e($lbl) ?></span>
    </div>
    <?php endfor; ?>
  </div>
</section>
*/


// --- GALERIE ---
/*
<section class="gallery-section">
  <?php $images = cms_gallery($cms, 'gallery'); ?>
  <?php if (!empty($images)): ?>
    <div class="gallery-grid">
      <?php foreach ($images as $img): ?>
        <figure>
          <img src="<?= cms_image_url($img['image_path']) ?>"
               alt="<?= e($img['alt_text'] ?? '') ?>"
               loading="lazy">
          <?php if (!empty($img['caption'])): ?>
            <figcaption><?= e($img['caption']) ?></figcaption>
          <?php endif; ?>
        </figure>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <!-- Galerie statique de secours -->
    <p>Aucune image disponible pour le moment.</p>
  <?php endif; ?>
</section>
*/


// --- SECTION DESACTIVEE (ne pas afficher si l'admin l'a desactivee) ---
/*
<?php if (cms_section_active($cms, 'stats')): ?>
  <section class="stats-section">
    ... contenu stats ...
  </section>
<?php endif; ?>
*/


/**
 * REUTILISATION CROSS-PAGES
 * La fonction cms_get_page() met en cache le resultat pour la requete,
 * donc vous pouvez l'appeler plusieurs fois sans impact sur les performances.
 *
 * EXEMPLE COMPLET pour btp.php :
 */

/*
<?php
session_start();
require_once 'config/database.php';
require_once 'includes/cms.php';

$cms = cms_get_page('btp');
?>
<!DOCTYPE html>
<html lang="fr">
<head> ... </head>
<body>
  <?php require_once 'includes/header.php'; ?>

  <main>
    <section class="hero" style="background-image: url('<?= cms_image_url(cms_field($cms,'hero','bg_image')) ?>');">
      <h1><?= e(cms_field($cms, 'hero', 'title', 'Pole BTP')) ?></h1>
      <p><?= e(cms_field($cms, 'hero', 'subtitle', 'Excellence en construction')) ?></p>
    </section>

    <section class="intro container">
      <h2><?= e(cms_field($cms, 'intro_text', 'title', 'Notre expertise')) ?></h2>
      <div><?= cms_field($cms, 'intro_text', 'body', '<p>Description statique.</p>') ?></div>
    </section>

    <?php if (cms_section_active($cms, 'stats')): ?>
    <section class="stats">
      <?php for ($i=1;$i<=4;$i++): $v=cms_field($cms,'stats','stat'.$i.'_value',''); $l=cms_field($cms,'stats','stat'.$i.'_label',''); if(!$v) continue; ?>
        <div class="stat"><strong><?= e($v) ?></strong><span><?= e($l) ?></span></div>
      <?php endfor; ?>
    </section>
    <?php endif; ?>

  </main>

  <?php require_once 'includes/footer.php'; ?>
</body>
</html>
*/
