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
$similaires = $db->prepare("SELECT id, titre, lieu FROM projets WHERE actif=1 AND pole=? AND id!=? ORDER BY id DESC LIMIT 4");
$similaires->execute([$pole, $id]);
$similaires = $similaires->fetchAll();

$page_title = e($projet['titre']) . ' | COTRAC Réalisations';
$page_desc  = !empty($projet['description']) ? mb_strimwidth($projet['description'], 0, 160, '…') : $page_title;

cms_load('realisations');
require_once 'includes/header.php';
?>

<!-- ── HERO ── -->
<section class="page-hero" style="padding:40px 0 48px;">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane" style="margin-bottom:20px;">
      <a href="<?= SITE_URL ?>/index"><?= t('nav_accueil') ?></a>
      <span class="sep">›</span>
      <a href="<?= SITE_URL ?>/realisations">Réalisations</a>
      <span class="sep">›</span>
      <span><?= e(mb_strimwidth($projet['titre'], 0, 50, '…')) ?></span>
    </nav>
    <div style="max-width:760px;">
      <span style="display:inline-flex;align-items:center;gap:8px;margin-bottom:14px;flex-wrap:wrap;">
        <span style="display:inline-block;font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;padding:3px 12px;border-radius:20px;background:<?= $color_pole ?>;color:#fff;">
          <?= e($label_pole) ?>
        </span>
        <span style="font-size:.78rem;color:rgba(255,255,255,.65);">
          <?= $est_termine ? 'Projet terminé' : 'En cours' ?>
        </span>
      </span>
      <h1 style="font-size:clamp(1.5rem,4vw,2.4rem);font-weight:800;color:#fff;line-height:1.25;margin:0;">
        <?= e($projet['titre']) ?>
      </h1>
    </div>
  </div>
</section>

<!-- ── CONTENU ── -->
<section class="section" style="background:var(--gris-clair);padding-top:48px;">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 320px;gap:40px;align-items:start;">

      <!-- Colonne principale -->
      <article>
        <?php if (!empty($projet['image'])): ?>
        <div style="border-radius:16px;overflow:hidden;margin-bottom:32px;box-shadow:0 4px 24px rgba(0,0,0,.1);">
          <img src="<?= SITE_URL ?>/uploads/projets/<?= e($projet['image']) ?>"
               alt="<?= e($projet['titre']) ?>"
               style="width:100%;max-height:420px;object-fit:cover;display:block;">
        </div>
        <?php endif; ?>

        <div class="actu-body">
          <?php if (!empty($projet['description'])): ?>
            <?php
            $desc = htmlspecialchars($projet['description'], ENT_QUOTES, 'UTF-8');
            $paragraphs = preg_split('/\n{2,}/', trim($desc));
            foreach ($paragraphs as $p):
              $p = trim($p);
              if ($p === '') continue;
              if (mb_strlen($p) <= 80 && !preg_match('/[.,:;!?]$/', $p)):
            ?>
              <h2 class="actu-section-title"><?= $p ?></h2>
            <?php else: ?>
              <p><?= nl2br($p) ?></p>
            <?php endif; endforeach; ?>
          <?php else: ?>
            <p style="color:#a0aec0;font-style:italic;">Aucune description disponible pour ce projet.</p>
          <?php endif; ?>

          <!-- Nature des travaux -->
          <?php if (!empty($projet['nature_travaux'])): ?>
          <div style="margin-top:24px;padding:18px 20px;background:#fff;border-radius:12px;border-left:4px solid <?= $color_pole ?>;box-shadow:0 2px 10px rgba(0,0,0,.05);">
            <div style="font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:<?= $color_pole ?>;margin-bottom:6px;">Nature des travaux</div>
            <div style="font-size:.92rem;color:var(--texte);font-weight:500;"><?= e($projet['nature_travaux']) ?></div>
          </div>
          <?php endif; ?>

          <!-- Vidéo si disponible -->
          <?php if (!empty($projet['video_url'])): ?>
          <?php $vid_src = SITE_URL . '/uploads/projets/' . basename($projet['video_url']); ?>
          <div style="margin-top:32px;">
            <h2 class="actu-section-title">Vidéo du chantier</h2>
            <div style="position:relative;background:#000;border-radius:12px;overflow:hidden;aspect-ratio:16/9;">
              <video preload="metadata" playsinline id="proj-video" style="width:100%;height:100%;display:block;">
                <source src="<?= e($vid_src) ?>" type="video/mp4">
              </video>
              <div id="proj-video-ov" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.35);cursor:pointer;transition:background .2s;">
                <div style="width:68px;height:68px;border-radius:50%;background:rgba(26,107,181,.9);border:3px solid rgba(255,255,255,.6);display:flex;align-items:center;justify-content:center;box-shadow:0 8px 28px rgba(26,107,181,.5);">
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

        <div style="margin-top:40px;padding-top:24px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
          <a href="<?= SITE_URL ?>/realisations" style="display:inline-flex;align-items:center;gap:8px;color:var(--bleu);font-weight:600;font-size:.9rem;text-decoration:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Retour aux réalisations
          </a>
          <a href="<?= SITE_URL ?>/contact" class="btn btn-primary" style="font-size:.88rem;padding:10px 22px;">
            Nous contacter
          </a>
        </div>
      </article>

      <!-- Sidebar -->
      <aside>
        <!-- Infos projet -->
        <div style="background:#fff;border-radius:14px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-bottom:24px;border-top:4px solid <?= $color_pole ?>;">
          <div style="font-size:.72rem;font-weight:700;color:var(--bleu);text-transform:uppercase;letter-spacing:.08em;margin-bottom:14px;">Infos projet</div>
          <div style="display:flex;flex-direction:column;gap:12px;font-size:.85rem;color:var(--gris);">
            <?php if (!empty($projet['client'])): ?>
            <div style="display:flex;gap:10px;align-items:flex-start;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <span>Client : <strong style="color:var(--texte);"><?= e($projet['client']) ?></strong></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($projet['lieu'])): ?>
            <div style="display:flex;gap:10px;align-items:flex-start;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              <span>Lieu : <strong style="color:var(--texte);"><?= e($projet['lieu']) ?></strong></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($projet['annee'])): ?>
            <div style="display:flex;gap:10px;align-items:flex-start;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
              <span>Année : <strong style="color:var(--texte);"><?= e($projet['annee']) ?></strong></span>
            </div>
            <?php endif; ?>
            <div style="display:flex;gap:10px;align-items:flex-start;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
              <span>Pôle : <strong style="color:<?= $color_pole ?>;"><?= e($label_pole) ?></strong></span>
            </div>
            <div style="display:flex;gap:10px;align-items:flex-start;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
              <span>Statut : <strong style="color:<?= $est_termine ? '#27ae60' : '#f7941d' ?>;"><?= $est_termine ? 'Terminé' : 'En cours' ?></strong></span>
            </div>
          </div>
        </div>

        <!-- Projets similaires -->
        <?php if (!empty($similaires)): ?>
        <div style="background:#fff;border-radius:14px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-bottom:24px;">
          <div style="font-size:.72rem;font-weight:700;color:var(--bleu);text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px;">Projets similaires</div>
          <div style="display:flex;flex-direction:column;gap:14px;">
            <?php foreach ($similaires as $sim): ?>
            <a href="<?= SITE_URL ?>/projet?id=<?= $sim['id'] ?>"
               style="text-decoration:none;display:flex;flex-direction:column;gap:3px;padding-bottom:14px;border-bottom:1px solid var(--border);">
              <span style="font-size:.84rem;font-weight:600;color:var(--texte);line-height:1.35;"><?= e($sim['titre']) ?></span>
              <?php if (!empty($sim['lieu'])): ?>
              <span style="font-size:.72rem;color:var(--gris);">📍 <?= e($sim['lieu']) ?></span>
              <?php endif; ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <!-- CTA -->
        <div style="background:var(--bleu);border-radius:14px;padding:22px;text-align:center;">
          <div style="font-size:.92rem;font-weight:700;color:#fff;margin-bottom:8px;">Un projet similaire ?</div>
          <div style="font-size:.8rem;color:rgba(255,255,255,.75);margin-bottom:16px;">Contactez-nous pour un devis gratuit</div>
          <a href="<?= SITE_URL ?>/contact" style="display:inline-block;background:#fff;color:var(--bleu);font-weight:700;font-size:.85rem;padding:9px 22px;border-radius:30px;text-decoration:none;">
            Nous contacter
          </a>
        </div>

      </aside>
    </div>
  </div>
</section>

<style>
.actu-body { font-size:.97rem; color:var(--texte); line-height:1.8; }
.actu-body p { margin-bottom:1.3em; }
.actu-body p:last-child { margin-bottom:0; }
.actu-section-title {
  font-size:1.15rem; font-weight:700; color:var(--bleu);
  margin:2em 0 .6em;
  padding-left:14px;
  border-left:3px solid var(--orange);
}
@media(max-width:900px) {
  .container > div[style*="grid-template-columns:1fr 320px"] {
    grid-template-columns: 1fr !important;
  }
  aside { order: -1; }
}
</style>

<?php require_once 'includes/footer.php'; ?>
