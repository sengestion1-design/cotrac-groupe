<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';

$db = getDB();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { header('Location: realisations.php'); exit; }

$stmt = $db->prepare("SELECT * FROM projets WHERE id=? AND actif=1");
$stmt->execute([$id]);
$projet = $stmt->fetch();
if (!$projet) { header('Location: realisations.php'); exit; }

$poles_labels = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie'];
$poles_colors = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad'];
$pole        = $projet['pole'] ?? 'btp';
$label_pole  = $poles_labels[$pole] ?? strtoupper($pole);
$color_pole  = $poles_colors[$pole] ?? '#f7941d';
$est_termine = ($projet['statut'] === 'termine');

// Projets similaires (même pôle)
$similaires = $db->prepare("SELECT id, titre, image, pole, lieu FROM projets WHERE actif=1 AND pole=? AND id!=? ORDER BY id DESC LIMIT 3");
$similaires->execute([$pole, $id]);
$similaires = $similaires->fetchAll();

$page_title = e($projet['titre']) . ' | COTRAC Réalisations';
$page_desc  = !empty($projet['description']) ? mb_strimwidth($projet['description'], 0, 160, '...') : $page_title;

require_once 'includes/header.php';
?>

<style>
.projet-detail-hero {
  position: relative;
  height: 420px;
  background: #0b1d3a;
  overflow: hidden;
}
.projet-detail-hero img {
  width: 100%; height: 100%; object-fit: cover;
  opacity: .75;
}
.projet-detail-hero-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(5,15,40,.85) 0%, rgba(5,15,40,.3) 60%, transparent 100%);
  display: flex; align-items: flex-end;
  padding: 40px;
}
.projet-detail-hero-content { max-width: 800px; }
.projet-detail-pole {
  display: inline-flex; align-items: center; gap: 6px;
  background: <?= $color_pole ?>; color: #fff;
  font-size: .72rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .12em; padding: 4px 12px; border-radius: 20px;
  margin-bottom: 12px;
}
.projet-detail-titre {
  font-size: 2rem; font-weight: 800; color: #fff;
  line-height: 1.2; margin: 0 0 8px;
  text-shadow: 0 2px 12px rgba(0,0,0,.4);
}
.projet-detail-badge {
  display: inline-block;
  font-size: .72rem; font-weight: 700; padding: 3px 12px;
  border-radius: 20px;
  background: <?= $est_termine ? '#27ae6022' : '#f7941d22' ?>;
  color: <?= $est_termine ? '#27ae60' : '#f7941d' ?>;
  border: 1px solid <?= $est_termine ? '#27ae6055' : '#f7941d55' ?>;
}
@media (max-width: 600px) {
  .projet-detail-hero { height: 280px; }
  .projet-detail-hero-overlay { padding: 20px; }
  .projet-detail-titre { font-size: 1.35rem; }
}

/* Corps */
.projet-detail-body { background: #f8fafd; padding: 48px 0; }
.projet-detail-layout {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 36px;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 24px;
}
@media (max-width: 860px) { .projet-detail-layout { grid-template-columns: 1fr; } }

/* Bloc principal */
.projet-main-card {
  background: #fff; border-radius: 16px;
  box-shadow: 0 4px 24px rgba(0,0,0,.07);
  padding: 36px;
}
.projet-section-title {
  font-size: 1rem; font-weight: 700; color: #1a202c;
  margin: 0 0 16px; padding-bottom: 10px;
  border-bottom: 2px solid <?= $color_pole ?>;
  display: inline-block;
}
.projet-description {
  font-size: .95rem; color: #4a5568; line-height: 1.8;
  white-space: pre-line;
}
.projet-meta-grid {
  display: grid; grid-template-columns: 1fr 1fr; gap: 14px;
  margin-top: 28px;
}
@media (max-width: 500px) { .projet-meta-grid { grid-template-columns: 1fr; } }
.projet-meta-item {
  background: #f8fafd; border-radius: 12px;
  padding: 14px 16px; border: 1px solid #e2e8f0;
}
.projet-meta-label {
  font-size: .7rem; font-weight: 700; text-transform: uppercase;
  letter-spacing: .08em; color: #a0aec0; margin-bottom: 4px;
}
.projet-meta-value {
  font-size: .92rem; font-weight: 700; color: #1a202c;
}

/* Sidebar */
.projet-sidebar { display: flex; flex-direction: column; gap: 20px; }
.sidebar-card {
  background: #fff; border-radius: 14px;
  box-shadow: 0 4px 18px rgba(0,0,0,.06);
  padding: 22px 20px;
}
.sidebar-card-title {
  font-size: .82rem; font-weight: 700; color: #718096;
  text-transform: uppercase; letter-spacing: .08em;
  margin: 0 0 14px;
}

/* Vidéo embed */
.projet-video-wrap {
  position: relative; background: #000;
  border-radius: 12px; overflow: hidden;
  aspect-ratio: 16/9; margin-top: 24px;
}
.projet-video-wrap video { width: 100%; height: 100%; display: block; }
.projet-video-ov {
  position: absolute; inset: 0;
  display: flex; align-items: center; justify-content: center;
  background: rgba(0,0,0,.35); cursor: pointer;
  transition: background .2s;
}
.projet-video-ov:hover { background: rgba(0,0,0,.2); }
.projet-video-btn {
  width: 68px; height: 68px; border-radius: 50%;
  background: rgba(26,107,181,.9); border: 3px solid rgba(255,255,255,.6);
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 8px 28px rgba(26,107,181,.5);
}

/* Similaires */
.sim-card {
  display: flex; gap: 12px; align-items: center;
  text-decoration: none; color: inherit;
  padding: 10px 0; border-bottom: 1px solid #f0f0f0;
  transition: opacity .2s;
}
.sim-card:last-child { border-bottom: none; padding-bottom: 0; }
.sim-card:hover { opacity: .75; }
.sim-card-img {
  width: 60px; height: 44px; border-radius: 8px;
  overflow: hidden; flex-shrink: 0; background: #e2e8f0;
}
.sim-card-img img { width: 100%; height: 100%; object-fit: cover; }
.sim-card-title { font-size: .82rem; font-weight: 600; color: #1a202c; line-height: 1.3; }
.sim-card-lieu { font-size: .72rem; color: #a0aec0; margin-top: 2px; }

/* Breadcrumb */
.breadcrumb {
  font-size: .8rem; color: #a0aec0; padding: 16px 0 0;
  display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
}
.breadcrumb a { color: #1a6bb5; text-decoration: none; }
.breadcrumb a:hover { text-decoration: underline; }
</style>

<!-- Breadcrumb -->
<div class="container">
  <nav class="breadcrumb">
    <a href="<?= SITE_URL ?>/index">Accueil</a>
    <span>›</span>
    <a href="<?= SITE_URL ?>/realisations">Réalisations</a>
    <span>›</span>
    <span style="color:#4a5568;"><?= e($projet['titre']) ?></span>
  </nav>
</div>

<!-- Hero -->
<div class="projet-detail-hero">
  <?php if (!empty($projet['image'])): ?>
  <img src="<?= SITE_URL ?>/uploads/projets/<?= e($projet['image']) ?>" alt="<?= e($projet['titre']) ?>">
  <?php else: ?>
  <div style="width:100%;height:100%;background:linear-gradient(135deg,<?= $color_pole ?>44,<?= $color_pole ?>99);"></div>
  <?php endif; ?>
  <div class="projet-detail-hero-overlay">
    <div class="projet-detail-hero-content">
      <div class="projet-detail-pole"><?= e($label_pole) ?></div>
      <h1 class="projet-detail-titre"><?= e($projet['titre']) ?></h1>
      <span class="projet-detail-badge"><?= $est_termine ? 'Projet terminé' : 'En cours' ?></span>
    </div>
  </div>
</div>

<!-- Corps -->
<div class="projet-detail-body">
  <div class="projet-detail-layout">

    <!-- Colonne principale -->
    <div>
      <div class="projet-main-card">
        <span class="projet-section-title">Description du projet</span>
        <?php if (!empty($projet['description'])): ?>
        <p class="projet-description"><?= nl2br(e($projet['description'])) ?></p>
        <?php else: ?>
        <p class="projet-description" style="color:#a0aec0;font-style:italic;">Aucune description disponible pour ce projet.</p>
        <?php endif; ?>

        <!-- Métadonnées -->
        <?php $has_meta = !empty($projet['client']) || !empty($projet['lieu']) || !empty($projet['annee']) || !empty($projet['nature_travaux']); ?>
        <?php if ($has_meta): ?>
        <div class="projet-meta-grid" style="margin-top:28px;">
          <?php if (!empty($projet['client'])): ?>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Client</div>
            <div class="projet-meta-value"><?= e($projet['client']) ?></div>
          </div>
          <?php endif; ?>
          <?php if (!empty($projet['lieu'])): ?>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Lieu</div>
            <div class="projet-meta-value"><?= e($projet['lieu']) ?></div>
          </div>
          <?php endif; ?>
          <?php if (!empty($projet['annee'])): ?>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Année</div>
            <div class="projet-meta-value"><?= e($projet['annee']) ?></div>
          </div>
          <?php endif; ?>
          <?php if (!empty($projet['nature_travaux'])): ?>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Nature des travaux</div>
            <div class="projet-meta-value" style="font-size:.82rem;font-weight:600;"><?= e($projet['nature_travaux']) ?></div>
          </div>
          <?php endif; ?>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Pôle</div>
            <div class="projet-meta-value" style="color:<?= $color_pole ?>;"><?= e($label_pole) ?></div>
          </div>
          <div class="projet-meta-item">
            <div class="projet-meta-label">Statut</div>
            <div class="projet-meta-value" style="color:<?= $est_termine ? '#27ae60' : '#f7941d' ?>;">
              <?= $est_termine ? 'Terminé' : 'En cours' ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Vidéo si disponible -->
        <?php if (!empty($projet['video_url'])): ?>
        <?php $vid_src = SITE_URL . '/uploads/projets/' . basename($projet['video_url']); ?>
        <div style="margin-top:28px;">
          <span class="projet-section-title">Vidéo du chantier</span>
          <div class="projet-video-wrap">
            <video preload="metadata" playsinline id="proj-video">
              <source src="<?= e($vid_src) ?>" type="video/mp4">
            </video>
            <div class="projet-video-ov" id="proj-video-ov">
              <div class="projet-video-btn">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="#fff"><polygon points="5,3 19,12 5,21"/></svg>
              </div>
            </div>
          </div>
        </div>
        <script>
        document.getElementById('proj-video-ov').addEventListener('click', function() {
          var v = document.getElementById('proj-video');
          this.style.display = 'none';
          v.controls = true; v.play();
        });
        </script>
        <?php endif; ?>
      </div>

      <!-- Bouton retour -->
      <div style="margin-top:20px;">
        <a href="<?= SITE_URL ?>/realisations" class="btn btn-outline" style="font-size:.85rem;">
          ← Retour aux réalisations
        </a>
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="projet-sidebar">

      <!-- Infos rapides -->
      <div class="sidebar-card" style="border-top:4px solid <?= $color_pole ?>;">
        <p class="sidebar-card-title">Infos projet</p>
        <div style="display:flex;flex-direction:column;gap:12px;">
          <?php if (!empty($projet['client'])): ?>
          <div>
            <div style="font-size:.7rem;color:#a0aec0;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Client</div>
            <div style="font-size:.9rem;font-weight:700;color:#1a202c;"><?= e($projet['client']) ?></div>
          </div>
          <?php endif; ?>
          <?php if (!empty($projet['lieu'])): ?>
          <div>
            <div style="font-size:.7rem;color:#a0aec0;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Localisation</div>
            <div style="font-size:.9rem;font-weight:700;color:#1a202c;">📍 <?= e($projet['lieu']) ?></div>
          </div>
          <?php endif; ?>
          <?php if (!empty($projet['annee'])): ?>
          <div>
            <div style="font-size:.7rem;color:#a0aec0;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Année</div>
            <div style="font-size:.9rem;font-weight:700;color:#1a202c;"><?= e($projet['annee']) ?></div>
          </div>
          <?php endif; ?>
          <div>
            <div style="font-size:.7rem;color:#a0aec0;font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:2px;">Secteur</div>
            <div style="font-size:.9rem;font-weight:700;color:<?= $color_pole ?>;"><?= e($label_pole) ?></div>
          </div>
        </div>
      </div>

      <!-- Projets similaires -->
      <?php if (!empty($similaires)): ?>
      <div class="sidebar-card">
        <p class="sidebar-card-title">Projets similaires</p>
        <?php foreach ($similaires as $sim):
          $sim_src = !empty($sim['image']) ? SITE_URL.'/uploads/projets/'.e($sim['image']) : '';
        ?>
        <a href="<?= SITE_URL ?>/projet?id=<?= $sim['id'] ?>" class="sim-card">
          <div class="sim-card-img">
            <?php if ($sim_src): ?>
            <img src="<?= $sim_src ?>" alt="<?= e($sim['titre']) ?>" loading="lazy">
            <?php else: ?>
            <div style="width:100%;height:100%;background:<?= $color_pole ?>33;"></div>
            <?php endif; ?>
          </div>
          <div>
            <div class="sim-card-title"><?= e($sim['titre']) ?></div>
            <?php if ($sim['lieu']): ?><div class="sim-card-lieu">📍 <?= e($sim['lieu']) ?></div><?php endif; ?>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <!-- CTA contact -->
      <div class="sidebar-card" style="background:<?= $color_pole ?>;border-radius:14px;text-align:center;">
        <p style="color:#fff;font-weight:700;font-size:.95rem;margin:0 0 8px;">Un projet similaire ?</p>
        <p style="color:rgba(255,255,255,.8);font-size:.8rem;margin:0 0 16px;">Contactez-nous pour un devis gratuit</p>
        <a href="<?= SITE_URL ?>/contact" class="btn" style="background:#fff;color:<?= $color_pole ?>;font-weight:700;font-size:.85rem;padding:8px 20px;border-radius:30px;text-decoration:none;display:inline-block;">
          Nous contacter
        </a>
      </div>

    </aside>
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>
