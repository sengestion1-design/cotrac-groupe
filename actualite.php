<?php
require_once __DIR__ . '/lang/lang.php';
require_once __DIR__ . '/config/database.php';

$db = getDB();

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) { header('Location: actualites.php'); exit; }

$stmt = $db->prepare("SELECT * FROM actualites WHERE id=? AND actif=1");
$stmt->execute([$id]);
$actu = $stmt->fetch();
if (!$actu) { header('Location: actualites.php'); exit; }

// Articles récents pour sidebar
$recents = $db->prepare("SELECT id, titre, created_at FROM actualites WHERE actif=1 AND id != ? ORDER BY created_at DESC LIMIT 4");
$recents->execute([$id]);
$recents = $recents->fetchAll();

$page_title = e($actu['titre']) . ' | COTRAC';
$page_desc  = mb_strimwidth(strip_tags($actu['contenu']), 0, 155, '…');

$mois_fr = ['January'=>'janvier','February'=>'février','March'=>'mars','April'=>'avril',
            'May'=>'mai','June'=>'juin','July'=>'juillet','August'=>'août',
            'September'=>'septembre','October'=>'octobre','November'=>'novembre','December'=>'décembre'];
$date_fmt = strtr(date('d F Y', strtotime($actu['created_at'])), $mois_fr);

$has_img = !empty($actu['image']) && file_exists(__DIR__ . '/uploads/actualites/' . $actu['image']);

// Formatage contenu : \n\n → paragraphes, titres de section en gras
function format_actu(string $txt): string {
    $txt = htmlspecialchars($txt, ENT_QUOTES, 'UTF-8');
    $paragraphs = preg_split('/\n{2,}/', trim($txt));
    $html = '';
    foreach ($paragraphs as $p) {
        $p = trim($p);
        if ($p === '') continue;
        // Ligne seule courte sans ponctuation finale = titre de section
        if (mb_strlen($p) <= 80 && !preg_match('/[.,:;!?]$/', $p)) {
            $html .= '<h2 class="actu-section-title">' . $p . '</h2>';
        } else {
            $html .= '<p>' . nl2br($p) . '</p>';
        }
    }
    return $html;
}

cms_load('actualites');
require_once 'includes/header.php';
?>

<!-- ── HERO ARTICLE ── -->
<section class="page-hero" style="padding:40px 0 48px;">
  <div class="container">
    <nav class="breadcrumb" aria-label="Fil d'Ariane" style="margin-bottom:20px;">
      <a href="<?= SITE_URL ?>/index.php"><?= t('nav_accueil') ?></a>
      <span class="sep">›</span>
      <a href="<?= SITE_URL ?>/actualites.php">Actualités</a>
      <span class="sep">›</span>
      <span><?= e(mb_strimwidth($actu['titre'], 0, 50, '…')) ?></span>
    </nav>
    <div style="max-width:760px;">
      <span style="display:inline-flex;align-items:center;gap:6px;font-size:.78rem;color:rgba(255,255,255,.7);margin-bottom:14px;">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <?= e($date_fmt) ?> &nbsp;·&nbsp; COTRAC
      </span>
      <h1 style="font-size:clamp(1.5rem,4vw,2.4rem);font-weight:800;color:#fff;line-height:1.25;margin:0;">
        <?= e($actu['titre']) ?>
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
        <?php if ($has_img): ?>
        <div style="border-radius:16px;overflow:hidden;margin-bottom:32px;box-shadow:0 4px 24px rgba(0,0,0,.1);">
          <img src="<?= SITE_URL ?>/uploads/actualites/<?= e($actu['image']) ?>"
               alt="<?= e($actu['titre']) ?>"
               style="width:100%;max-height:420px;object-fit:cover;display:block;">
        </div>
        <?php endif; ?>

        <div class="actu-body">
          <?= format_actu($actu['contenu']) ?>
        </div>

        <div style="margin-top:40px;padding-top:24px;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
          <a href="<?= SITE_URL ?>/actualites.php" style="display:inline-flex;align-items:center;gap:8px;color:var(--bleu);font-weight:600;font-size:.9rem;text-decoration:none;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
            Retour aux actualités
          </a>
          <a href="<?= SITE_URL ?>/contact.php" class="btn btn-primary" style="font-size:.88rem;padding:10px 22px;">
            Nous contacter
          </a>
        </div>
      </article>

      <!-- Sidebar -->
      <aside>
        <!-- Info article -->
        <div style="background:#fff;border-radius:14px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-bottom:24px;">
          <div style="font-size:.72rem;font-weight:700;color:var(--bleu);text-transform:uppercase;letter-spacing:.08em;margin-bottom:14px;">À propos</div>
          <div style="display:flex;flex-direction:column;gap:10px;font-size:.85rem;color:var(--gris);">
            <div style="display:flex;gap:10px;align-items:center;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
              <span>Publié le <strong style="color:var(--texte);"><?= e($date_fmt) ?></strong></span>
            </div>
            <div style="display:flex;gap:10px;align-items:center;">
              <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--orange)" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              <span>Par <strong style="color:var(--texte);">COTRAC</strong></span>
            </div>
          </div>
        </div>

        <!-- Articles récents -->
        <?php if ($recents): ?>
        <div style="background:#fff;border-radius:14px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);">
          <div style="font-size:.72rem;font-weight:700;color:var(--bleu);text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px;">Autres actualités</div>
          <div style="display:flex;flex-direction:column;gap:14px;">
            <?php foreach ($recents as $r):
              $rd = strtr(date('d F Y', strtotime($r['created_at'])), $mois_fr);
            ?>
            <a href="<?= SITE_URL ?>/actualite.php?id=<?= $r['id'] ?>"
               style="text-decoration:none;display:flex;flex-direction:column;gap:3px;padding-bottom:14px;border-bottom:1px solid var(--border);">
              <span style="font-size:.84rem;font-weight:600;color:var(--texte);line-height:1.35;"><?= e($r['titre']) ?></span>
              <span style="font-size:.72rem;color:var(--gris);"><?= e($rd) ?></span>
            </a>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
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
