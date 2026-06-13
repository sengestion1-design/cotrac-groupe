<?php
session_start();
require_once '../config/database.php';
security_headers();
if (!isset($_SESSION['admin_logged'])) { header('Location: login.php'); exit; }

$db = getDB();
$nb_messages = (int)$db->query("SELECT COUNT(*) FROM messages WHERE lu=0")->fetchColumn();

$pages = [
    'index'       => ['label' => 'Accueil',       'file' => 'index.php',       'icon' => 'home'],
    'btp'         => ['label' => 'Pole BTP',       'file' => 'btp.php',         'icon' => 'hard-hat'],
    'energie'     => ['label' => 'Pole Energie',   'file' => 'energie.php',     'icon' => 'zap'],
    'routes'      => ['label' => 'Pole Routes',    'file' => 'routes.php',      'icon' => 'map'],
    'industrie'   => ['label' => 'Pole Industrie', 'file' => 'industrie.php',   'icon' => 'settings'],
    'a-propos'    => ['label' => 'A propos',        'file' => 'a-propos.php',    'icon' => 'info'],
    'realisations'  => ['label' => 'Realisations',    'file' => 'realisations.php',  'icon' => 'award'],
    'nos-ressources'=> ['label' => 'Nos Ressources', 'file' => 'nos-ressources.php','icon' => 'tool'],
    'actualites'    => ['label' => 'Actualites',      'file' => 'actualites.php',    'icon' => 'file-text'],
    'contact'     => ['label' => 'Contact',          'file' => 'contact.php',     'icon' => 'phone'],
];

$section_type_meta = [
    'hero'    => ['label'=>'Hero',    'color'=>'#1a3c6e'],
    'text'    => ['label'=>'Texte',   'color'=>'#2d6a4f'],
    'image'   => ['label'=>'Image',   'color'=>'#7b2d8b'],
    'gallery' => ['label'=>'Galerie', 'color'=>'#9b59b6'],
    'stats'   => ['label'=>'Stats',   'color'=>'#d62828'],
    'cards'   => ['label'=>'Cartes',  'color'=>'#f7941d'],
    'media'   => ['label'=>'Vidéo',   'color'=>'#e53e3e'],
];

$active_slug = $_GET['page'] ?? 'index';
if (!array_key_exists($active_slug, $pages)) $active_slug = 'index';

$sections_stmt = $db->prepare(
    "SELECT id, section_key, section_type, label, sort_order, active
     FROM page_sections WHERE page_slug = ? ORDER BY sort_order ASC"
);
$sections_stmt->execute([$active_slug]);
$sections = $sections_stmt->fetchAll();

$fields_by_sec = [];
$images_by_sec = [];

if (!empty($sections)) {
    $ids = array_column($sections, 'id');
    $ph  = implode(',', array_fill(0, count($ids), '?'));

    $fstmt = $db->prepare(
        "SELECT section_id, id as field_id, field_key, field_type, field_label, field_value, sort_order
         FROM page_section_fields WHERE section_id IN ($ph) ORDER BY section_id, sort_order"
    );
    $fstmt->execute($ids);
    foreach ($fstmt->fetchAll() as $f) $fields_by_sec[$f['section_id']][] = $f;

    $gstmt = $db->prepare(
        "SELECT id, section_id, image_path, alt_text, caption, sort_order
         FROM page_section_images WHERE section_id IN ($ph) ORDER BY section_id, sort_order"
    );
    $gstmt->execute($ids);
    foreach ($gstmt->fetchAll() as $img) $images_by_sec[$img['section_id']][] = $img;
}

$current_page = 'parametres-pages';
$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parametres des pages — Admin COTRAC</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/cms.css">
</head>
<body>
<div class="admin-layout">

  <?php require_once 'includes/sidebar.php'; ?>

  <main class="admin-main">
    <div class="admin-topbar">
      <h1>Parametres des pages</h1>
      <div class="admin-topbar-actions">
        <span class="cms-save-indicator" id="globalSaveStatus">Pret</span>
        <a href="<?= SITE_URL ?>" target="_blank" class="btn-site">Voir le site</a>
      </div>
    </div>

    <div class="admin-content">

      <!-- ONGLETS PAGES -->
      <div class="cms-page-tabs">
        <?php foreach ($pages as $slug => $info): ?>
          <a href="?page=<?= urlencode($slug) ?>"
             class="cms-page-tab <?= $slug === $active_slug ? 'active' : '' ?>">
            <?= e($info['label']) ?>
          </a>
        <?php endforeach; ?>
      </div>

      <!-- TOOLBAR -->
      <div class="cms-toolbar">
        <div class="cms-toolbar-left">
          <div>
            <div class="cms-toolbar-title"><?= e($pages[$active_slug]['label']) ?></div>
            <div class="cms-toolbar-subtitle"><?= count($sections) ?> section(s) configurables</div>
          </div>
          <a href="<?= SITE_URL ?>/<?= e($pages[$active_slug]['file']) ?>"
             target="_blank" class="cms-page-url">Voir la page</a>
        </div>
        <button class="btn-save-all" id="btnSaveAll" onclick="saveAllSections()">
          Enregistrer tout
        </button>
      </div>

      <!-- BLOC PROJETS (onglet realisations uniquement) -->
      <?php if ($active_slug === 'realisations'):
        try { $db->exec("ALTER TABLE projets ADD COLUMN IF NOT EXISTS video_url VARCHAR(500) DEFAULT NULL"); } catch(Exception $e){}
        $projets_all = $db->query("SELECT id, titre, pole, image, video_url, statut, client, nature_travaux, actif FROM projets ORDER BY ordre ASC, id DESC")->fetchAll();
        $poles_lbl = ['btp'=>'BTP','energie'=>'Énergie','routes'=>'Routes','industrie'=>'Industrie'];
        $poles_col = ['btp'=>'#f7941d','energie'=>'#27ae60','routes'=>'#1a6bb5','industrie'=>'#8e44ad'];
      ?>
      <div class="admin-card" style="margin-bottom:28px;">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
          <div>
            <h3 style="margin:0;font-size:1.1rem;font-weight:700;color:#1a202c;">Projets — Photos &amp; infos</h3>
            <p style="margin:4px 0 0;font-size:.82rem;color:#718096;">Modifiez la photo et les infos de chaque projet. Pour ajouter/supprimer : <a href="projets.php" target="_blank" style="color:#1a6bb5;">Gestion des projets →</a></p>
          </div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;" id="projetsList">
        <?php foreach ($projets_all as $proj):
          $img_url = '';
          if ($proj['image']) {
            $img_url = str_starts_with($proj['image'], 'http') ? $proj['image'] : SITE_URL . '/uploads/projets/' . $proj['image'];
          }
          $pole_color = $poles_col[$proj['pole']] ?? '#888';
          $pole_label = $poles_lbl[$proj['pole']] ?? $proj['pole'];
        ?>
        <div class="projet-edit-card" data-id="<?= $proj['id'] ?>" style="border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;background:#fff;opacity:<?= $proj['actif'] ? '1' : '.55' ?>;">
          <!-- Photo -->
          <div style="position:relative;height:160px;background:#f0f4f8;overflow:hidden;">
            <?php if ($img_url): ?>
              <img src="<?= e($img_url) ?>" alt="" id="proj-img-<?= $proj['id'] ?>"
                   style="width:100%;height:100%;object-fit:cover;">
            <?php else: ?>
              <div id="proj-img-<?= $proj['id'] ?>" style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#a0aec0;font-size:.8rem;">Pas de photo</div>
            <?php endif; ?>
            <!-- Bouton changer photo -->
            <label style="position:absolute;bottom:8px;right:8px;background:rgba(0,0,0,.65);color:#fff;border-radius:8px;padding:5px 10px;font-size:.75rem;cursor:pointer;display:flex;align-items:center;gap:5px;">
              <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
              Photo
              <input type="file" accept="image/*" style="display:none;"
                     onchange="uploadProjetImage(this, <?= $proj['id'] ?>)">
            </label>
            <!-- Indicateur vidéo -->
            <?php if (!empty($proj['video_url'])): ?>
            <span id="vid-badge-<?= $proj['id'] ?>" style="position:absolute;top:8px;right:8px;background:rgba(240,128,20,.9);color:#fff;border-radius:6px;padding:3px 8px;font-size:.7rem;font-weight:700;display:flex;align-items:center;gap:4px;">
              <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg> Vidéo
            </span>
            <?php else: ?>
            <span id="vid-badge-<?= $proj['id'] ?>" style="display:none;position:absolute;top:8px;right:8px;background:rgba(240,128,20,.9);color:#fff;border-radius:6px;padding:3px 8px;font-size:.7rem;font-weight:700;align-items:center;gap:4px;">
              <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"/></svg> Vidéo
            </span>
            <?php endif; ?>
            <!-- Badge pôle -->
            <span style="position:absolute;top:8px;left:8px;background:<?= e($pole_color) ?>;color:#fff;border-radius:6px;padding:3px 8px;font-size:.7rem;font-weight:700;"><?= e($pole_label) ?></span>
          </div>
          <!-- Infos -->
          <div style="padding:12px;">
            <input type="text" value="<?= e($proj['titre']) ?>" placeholder="Titre"
                   style="width:100%;border:1px solid #e2e8f0;border-radius:6px;padding:6px 8px;font-size:.85rem;margin-bottom:6px;box-sizing:border-box;"
                   onchange="updateProjet(<?= $proj['id'] ?>, 'titre', this.value)">
            <input type="text" value="<?= e($proj['client'] ?? '') ?>" placeholder="Client"
                   style="width:100%;border:1px solid #e2e8f0;border-radius:6px;padding:6px 8px;font-size:.82rem;margin-bottom:6px;box-sizing:border-box;"
                   onchange="updateProjet(<?= $proj['id'] ?>, 'client', this.value)">
            <input type="text" value="<?= e($proj['nature_travaux'] ?? '') ?>" placeholder="Nature des travaux"
                   style="width:100%;border:1px solid #e2e8f0;border-radius:6px;padding:6px 8px;font-size:.82rem;margin-bottom:6px;box-sizing:border-box;"
                   onchange="updateProjet(<?= $proj['id'] ?>, 'nature_travaux', this.value)">
            <!-- Vidéo -->
            <div style="margin-bottom:8px;">
              <label style="display:flex;align-items:center;gap:6px;background:#fff7ed;border:1.5px dashed #f7941d;border-radius:8px;padding:7px 10px;font-size:.78rem;color:#c05621;cursor:pointer;font-weight:600;" title="Formats acceptés : MP4, MOV (max 200 Mo)">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                <span id="vid-label-<?= $proj['id'] ?>"><?= !empty($proj['video_url']) ? 'Changer la vidéo' : 'Ajouter une vidéo (MP4/MOV)' ?></span>
                <input type="file" accept="video/mp4,video/quicktime,.mov,.mp4" style="display:none;"
                       onchange="uploadProjetVideo(this, <?= $proj['id'] ?>)">
              </label>
              <?php if (!empty($proj['video_url'])): ?>
              <div style="margin-top:4px;display:flex;align-items:center;gap:8px;" id="vid-info-<?= $proj['id'] ?>">
                <span style="font-size:.72rem;color:#718096;"><?= e($proj['video_url']) ?></span>
                <button onclick="supprimerVideo(<?= $proj['id'] ?>)" style="background:none;border:none;color:#e53e3e;font-size:.72rem;cursor:pointer;padding:0;">✕ Supprimer</button>
              </div>
              <?php else: ?>
              <div style="margin-top:4px;display:none;" id="vid-info-<?= $proj['id'] ?>"></div>
              <?php endif; ?>
            </div>
            <div style="display:flex;gap:8px;align-items:center;">
              <select onchange="updateProjet(<?= $proj['id'] ?>, 'statut', this.value)"
                      style="flex:1;border:1px solid #e2e8f0;border-radius:6px;padding:5px 8px;font-size:.8rem;">
                <option value="termine" <?= $proj['statut']==='termine'?'selected':'' ?>>Terminé</option>
                <option value="en_cours" <?= $proj['statut']==='en_cours'?'selected':'' ?>>En cours</option>
              </select>
              <select onchange="updateProjet(<?= $proj['id'] ?>, 'pole', this.value)"
                      style="flex:1;border:1px solid #e2e8f0;border-radius:6px;padding:5px 8px;font-size:.8rem;">
                <?php foreach ($poles_lbl as $pk => $pl): ?>
                <option value="<?= $pk ?>" <?= $proj['pole']===$pk?'selected':'' ?>><?= $pl ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        </div>
      </div>
      <?php endif; ?>

      <!-- SECTIONS -->
      <?php if (empty($sections)): ?>
        <div class="admin-card" style="text-align:center;padding:60px 20px;color:#a0aec0;">
          <p style="font-size:3rem;margin-bottom:12px;">📄</p>
          <p>Aucune section. Executez <code>sql/cms_pages.sql</code> d abord.</p>
        </div>
      <?php else: ?>
      <div class="cms-sections-list" id="cmsSectionsList">
        <?php foreach ($sections as $sec):
          $sid   = $sec['id'];
          $skey  = $sec['section_key'];
          $stype = $sec['section_type'];
          $act   = (bool)$sec['active'];
          $tmeta = $section_type_meta[$stype] ?? ['label'=>$stype,'color'=>'#888'];
          $fields = $fields_by_sec[$sid] ?? [];
          $images = $images_by_sec[$sid] ?? [];
        ?>
        <div class="cms-section-card <?= !$act ? 'inactive' : '' ?>"
             data-section-id="<?= $sid ?>">

          <!-- HEADER -->
          <div class="cms-section-header" onclick="toggleSection(<?= $sid ?>)">
            <div class="cms-drag-handle"
                 onmousedown="event.stopPropagation()"
                 onclick="event.stopPropagation()">
              <span></span><span></span><span></span>
            </div>
            <span class="cms-section-type-badge"
                  style="background:<?= e($tmeta['color']) ?>">
              <?= e($tmeta['label']) ?>
            </span>
            <div class="cms-section-meta">
              <div class="cms-section-label"><?= e($sec['label']) ?></div>
              <div class="cms-section-key"><?= e($skey) ?></div>
            </div>
            <div class="cms-section-actions" onclick="event.stopPropagation()">
              <label class="cms-toggle" title="Activer/desactiver">
                <input type="checkbox"
                       <?= $act ? 'checked' : '' ?>
                       onchange="toggleSectionActive(<?= $sid ?>, this.checked)">
                <span class="cms-toggle-slider"></span>
              </label>
              <button class="btn-toggle-section" id="toggleBtn<?= $sid ?>">
                Modifier
              </button>
            </div>
          </div>

          <!-- BODY -->
          <div class="cms-section-body" id="sectionBody<?= $sid ?>">
            <form class="cms-section-form" data-section-id="<?= $sid ?>" onsubmit="return false">
              <input type="hidden" name="csrf_token" value="<?= e($csrf) ?>">
              <input type="hidden" name="section_id" value="<?= $sid ?>">

              <?php if (!empty($fields)): ?>
              <div class="cms-fields-grid">
                <?php foreach ($fields as $field):
                  $fkey = $field['field_key'];
                  $ftype = $field['field_type'];
                  $flabel = $field['field_label'];
                  $fval = $field['field_value'] ?? '';
                  $fid = 'f_' . $sid . '_' . $fkey;
                ?>

                <?php if ($ftype === 'image'): ?>
                <div class="cms-field">
                  <label class="cms-field-label">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">image</span>
                  </label>
                  <div class="cms-image-field">
                    <?php
                      // Déterminer l'URL d'aperçu : assets/* ou uploads/cms/*
                      $img_url = '';
                      if ($fval) {
                          if (str_starts_with($fval, 'assets/') || str_starts_with($fval, 'uploads/')) {
                              $img_url = SITE_URL . '/' . $fval;
                          } else {
                              $img_url = SITE_URL . '/uploads/cms/' . $fval;
                          }
                      }
                    ?>
                    <div class="cms-image-preview" id="prev_<?= $sid ?>_<?= $fkey ?>">
                      <?php if ($img_url): ?>
                        <img src="<?= e($img_url) ?>" alt="Apercu">
                      <?php else: ?>
                        <span style="font-size:2rem;opacity:.3;">img</span>
                      <?php endif; ?>
                    </div>
                    <div class="cms-image-meta">
                      <label class="cms-image-upload-btn">
                        Choisir une image
                        <input type="file"
                               accept="image/jpeg,image/png,image/webp,image/gif"
                               onchange="uploadImage(this,<?= $sid ?>,'<?= e($fkey) ?>')">
                      </label>
                      <div class="cms-upload-progress" id="prog_<?= $sid ?>_<?= $fkey ?>">
                        <div class="cms-upload-progress-bar" id="progBar_<?= $sid ?>_<?= $fkey ?>"></div>
                      </div>
                      <div class="cms-image-filename" id="fname_<?= $sid ?>_<?= $fkey ?>">
                        <?= $fval ? e($fval) : 'Aucune image' ?>
                      </div>
                    </div>
                  </div>
                </div>

                <?php elseif ($ftype === 'url' && $fkey === 'video_src'): ?>
                <div class="cms-field">
                  <label class="cms-field-label">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">vidéo</span>
                  </label>
                  <?php
                    $vid_preview_url = '';
                    if ($fval) {
                        $vid_preview_url = (str_starts_with($fval,'assets/') || str_starts_with($fval,'uploads/'))
                            ? SITE_URL . '/' . $fval
                            : SITE_URL . '/uploads/cms/' . $fval;
                    }
                  ?>
                  <div style="display:flex;flex-direction:column;gap:10px;">
                    <?php if ($vid_preview_url): ?>
                    <video controls style="width:100%;max-height:180px;border-radius:8px;background:#000;">
                      <source src="<?= e($vid_preview_url) ?>" type="video/mp4">
                    </video>
                    <?php endif; ?>
                    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
                      <label style="background:#1a6bb5;color:#fff;border-radius:8px;padding:7px 14px;font-size:.8rem;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        Uploader une vidéo MP4
                        <input type="file" accept="video/mp4,video/webm" style="display:none;"
                               onchange="uploadVideo(this,<?= $sid ?>,'<?= e($fkey) ?>')">
                      </label>
                      <span style="color:#a0aec0;font-size:.75rem;" id="vidname_<?= $sid ?>_<?= $fkey ?>"><?= $fval ? e(basename($fval)) : 'Aucune vidéo' ?></span>
                    </div>
                    <div style="display:flex;align-items:center;gap:6px;">
                      <span style="font-size:.75rem;color:#718096;">Ou URL :</span>
                      <input type="url" value="<?= e($fval) ?>" placeholder="assets/videos/..."
                             style="flex:1;border:1px solid #e2e8f0;border-radius:6px;padding:5px 8px;font-size:.8rem;"
                             data-sid="<?= $sid ?>" data-fkey="<?= $fkey ?>"
                             onchange="queueSave(<?= $sid ?>,'<?= e($fkey) ?>',this.value)">
                    </div>
                  </div>
                </div>

                <?php elseif ($ftype === 'html'): ?>
                <div class="cms-field">
                  <label class="cms-field-label">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">html</span>
                  </label>
                  <div class="cms-html-editor">
                    <div class="cms-html-toolbar">
                      <button type="button" class="cms-html-btn" onclick="htmlWrap(<?= $sid ?>,'<?= e($fkey) ?>','b')">B</button>
                      <button type="button" class="cms-html-btn" onclick="htmlWrap(<?= $sid ?>,'<?= e($fkey) ?>','i')"><em>I</em></button>
                      <button type="button" class="cms-html-btn" onclick="htmlWrap(<?= $sid ?>,'<?= e($fkey) ?>','u')"><u>U</u></button>
                      <button type="button" class="cms-html-btn" onclick="htmlWrapTag(<?= $sid ?>,'<?= e($fkey) ?>','h2')">H2</button>
                      <button type="button" class="cms-html-btn" onclick="htmlWrapTag(<?= $sid ?>,'<?= e($fkey) ?>','h3')">H3</button>
                      <button type="button" class="cms-html-btn" onclick="htmlWrapTag(<?= $sid ?>,'<?= e($fkey) ?>','p')">P</button>
                    </div>
                    <textarea class="cms-html-body"
                              name="fields[<?= e($fkey) ?>]"
                              id="<?= $fid ?>"><?= e($fval) ?></textarea>
                  </div>
                </div>

                <?php elseif ($ftype === 'textarea'): ?>
                <div class="cms-field">
                  <label class="cms-field-label" for="<?= $fid ?>">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">textarea</span>
                  </label>
                  <textarea name="fields[<?= e($fkey) ?>]" id="<?= $fid ?>" rows="4"><?= e($fval) ?></textarea>
                </div>

                <?php elseif ($ftype === 'url'): ?>
                <div class="cms-field">
                  <label class="cms-field-label" for="<?= $fid ?>">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">url</span>
                  </label>
                  <input type="url" name="fields[<?= e($fkey) ?>]" id="<?= $fid ?>"
                         value="<?= e($fval) ?>" placeholder="https://...">
                </div>

                <?php elseif ($ftype === 'number'): ?>
                <div class="cms-field">
                  <label class="cms-field-label" for="<?= $fid ?>">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">nombre</span>
                  </label>
                  <input type="number" name="fields[<?= e($fkey) ?>]" id="<?= $fid ?>"
                         value="<?= e($fval) ?>">
                </div>

                <?php else: /* text */ ?>
                <div class="cms-field">
                  <label class="cms-field-label" for="<?= $fid ?>">
                    <?= e($flabel) ?> <span class="cms-field-type-tag">texte</span>
                  </label>
                  <input type="text" name="fields[<?= e($fkey) ?>]" id="<?= $fid ?>"
                         value="<?= e($fval) ?>" placeholder="<?= e($flabel) ?>...">
                </div>
                <?php endif; ?>

                <?php endforeach; ?>
              </div><!-- /cms-fields-grid -->
              <?php endif; ?>

              <!-- GALERIE -->
              <?php if ($stype === 'gallery'): ?>
              <div class="cms-gallery-section" style="margin-top:<?= empty($fields)?'0':'20px' ?>;">
                <div class="cms-gallery-header">
                  Images de la galerie (<?= count($images) ?>)
                </div>
                <div class="cms-gallery-grid" id="gallery_<?= $sid ?>">
                  <?php foreach ($images as $img): ?>
                  <div class="cms-gallery-item" id="gitem_<?= $img['id'] ?>">
                    <?php
                      $gimg_path = $img['image_path'];
                      if (str_starts_with($gimg_path, 'http')) {
                          $gimg_url = $gimg_path;
                      } elseif (str_starts_with($gimg_path, 'assets/') || str_starts_with($gimg_path, 'uploads/') || str_starts_with($gimg_path, 'ressources/')) {
                          $gimg_url = SITE_URL . '/' . $gimg_path;
                      } else {
                          $gimg_url = SITE_URL . '/uploads/cms/' . $gimg_path;
                      }
                    ?>
                    <img src="<?= e($gimg_url) ?>"
                         alt="<?= e($img['alt_text'] ?? '') ?>" loading="lazy">
                    <div class="cms-gallery-overlay">
                      <button class="cms-gallery-edit"
                              onclick="editGalleryImage(<?= $img['id'] ?>, <?= e(json_encode($img['alt_text'] ?? '')) ?>, <?= e(json_encode($img['caption'] ?? '')) ?>)">
                        ✏️ Modifier
                      </button>
                      <button class="cms-gallery-delete"
                              onclick="deleteGalleryImage(<?= $img['id'] ?>)">
                        Supprimer
                      </button>
                    </div>
                  </div>
                  <?php endforeach; ?>
                  <label class="cms-gallery-add">
                    <span class="cms-gallery-add-icon">+</span>
                    <span>Ajouter</span>
                    <input type="file" accept="image/jpeg,image/png,image/webp,image/gif"
                           multiple onchange="uploadGallery(this,<?= $sid ?>)">
                  </label>
                </div>
              </div>
              <?php endif; ?>

              <?php if (!empty($fields)): ?>
              <div class="cms-form-footer">
                <span class="cms-save-indicator" id="status_<?= $sid ?>">Pret</span>
                <button type="button" class="btn-save-section" onclick="saveSection(<?= $sid ?>)">
                  Enregistrer cette section
                </button>
              </div>
              <?php endif; ?>

            </form>
          </div><!-- /body -->
        </div><!-- /card -->
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

    </div>
  </main>
</div>

<div class="cms-toast-container" id="toastContainer"></div>

<script>
var CSRF_TOKEN = <?= json_encode($csrf) ?>;
var SITE_URL   = <?= json_encode(SITE_URL) ?>;

/* ---------- Accordeon ---------- */
function toggleSection(id) {
  var card = document.querySelector('[data-section-id="' + id + '"]');
  var btn  = document.getElementById('toggleBtn' + id);
  card.classList.toggle('open');
  btn.textContent = card.classList.contains('open') ? 'Fermer' : 'Modifier';
}

/* ---------- Helper POST fiable (URLSearchParams, pas de 301) ---------- */
function postJSON(url, params) {
  var body = new URLSearchParams();
  body.append('csrf_token', CSRF_TOKEN);
  for (var k in params) { if (params.hasOwnProperty(k)) body.append(k, String(params[k])); }
  return fetch(url, {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: body.toString()
  }).then(function(r){ return r.json(); });
}

/* ---------- Collecter les champs d'une section ---------- */
function collectFields(sectionId) {
  var form = document.querySelector('.cms-section-form[data-section-id="' + sectionId + '"]');
  var out = {};
  if (!form) return out;
  form.querySelectorAll('input[name], textarea[name], select[name]').forEach(function(el) {
    var name = el.getAttribute('name');
    if (!name || name === 'csrf_token' || name === 'section_id' || el.type === 'file') return;
    out[name] = el.value;
  });
  return out;
}

/* ---------- Toggle actif ---------- */
function toggleSectionActive(sectionId, isActive) {
  postJSON('ajax/save-section.php', {section_id: sectionId, active: isActive ? '1' : '0'})
    .then(function(data) {
      if (data.ok) {
        var card = document.querySelector('[data-section-id="' + sectionId + '"]');
        if (isActive) card.classList.remove('inactive');
        else card.classList.add('inactive');
        showToast(isActive ? 'Section activee' : 'Section desactivee', isActive ? 'success' : 'info');
      } else { showToast('Erreur: ' + data.error, 'error'); }
    }).catch(function(){ showToast('Erreur reseau', 'error'); });
}

/* ---------- Sauvegarder une section ---------- */
function saveSection(sectionId) {
  var status = document.getElementById('status_' + sectionId);
  setStatus(status, 'saving', 'Sauvegarde...');
  var params = Object.assign({section_id: sectionId}, collectFields(sectionId));
  postJSON('ajax/save-section.php', params)
    .then(function(data) {
      if (data.ok) {
        setStatus(status, 'saved', 'Sauvegarde !');
        showToast('Section sauvegardee', 'success');
        setTimeout(function(){ setStatus(status, '', 'Pret'); }, 3000);
      } else {
        setStatus(status, '', 'Pret');
        showToast('Erreur: ' + data.error, 'error');
      }
    }).catch(function(){ setStatus(status,'','Pret'); showToast('Erreur reseau','error'); });
}

/* ---------- Sauvegarder toutes les sections ouvertes ---------- */
function saveAllSections() {
  var btn    = document.getElementById('btnSaveAll');
  var global = document.getElementById('globalSaveStatus');
  var forms  = document.querySelectorAll('.cms-section-card.open .cms-section-form');
  if (!forms.length) { showToast('Ouvrez au moins une section d abord.', 'info'); return; }

  btn.disabled = true;
  btn.textContent = 'Sauvegarde...';
  setStatus(global, 'saving', 'En cours...');

  var promises = Array.from(forms).map(function(form) {
    var sid = form.dataset.sectionId;
    var params = Object.assign({section_id: sid}, collectFields(parseInt(sid)));
    return postJSON('ajax/save-section.php', params)
      .then(function(data) { return {sid:sid, ok:data.ok, error:data.error}; })
      .catch(function() { return {sid:sid, ok:false, error:'Erreur reseau'}; });
  });

  Promise.all(promises).then(function(results) {
    var ok = results.filter(function(r){ return r.ok; }).length;
    var err = results.length - ok;
    btn.disabled = false;
    btn.textContent = 'Enregistrer tout';
    if (err === 0) {
      setStatus(global, 'saved', ok + ' section(s) sauvegardee(s)');
      showToast(ok + ' section(s) sauvegardee(s) !', 'success');
    } else {
      setStatus(global, '', ok + ' ok, ' + err + ' erreur(s)');
      showToast(err + ' erreur(s) — ' + ok + ' reussi(s)', 'error');
    }
    setTimeout(function(){ setStatus(global, '', 'Pret'); }, 4000);
  });
}

/* ---------- Upload image simple ---------- */
function uploadImage(input, sectionId, fieldKey) {
  if (!input.files || !input.files[0]) return;
  var file     = input.files[0];
  var prevEl   = document.getElementById('prev_' + sectionId + '_' + fieldKey);
  var progEl   = document.getElementById('prog_' + sectionId + '_' + fieldKey);
  var barEl    = document.getElementById('progBar_' + sectionId + '_' + fieldKey);
  var fnameEl  = document.getElementById('fname_' + sectionId + '_' + fieldKey);

  /* Apercu local */
  var reader = new FileReader();
  reader.onload = function(e) {
    /* Safe: e.target.result is a data: URL from the local file (FileReader) */
    var img = document.createElement('img');
    img.src = e.target.result;
    img.alt = 'Apercu';
    img.style.cssText = 'width:100%;height:100%;object-fit:cover;border-radius:8px;';
    while (prevEl.firstChild) prevEl.removeChild(prevEl.firstChild);
    prevEl.appendChild(img);
  };
  reader.readAsDataURL(file);

  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('section_id', sectionId);
  fd.append('field_key', fieldKey);
  fd.append('mode', 'field');
  fd.append('image', file);

  var xhr = new XMLHttpRequest();
  if (progEl) progEl.style.display = 'block';

  xhr.upload.addEventListener('progress', function(e) {
    if (e.lengthComputable && barEl) barEl.style.width = Math.round(e.loaded/e.total*100)+'%';
  });

  xhr.addEventListener('load', function() {
    if (progEl) progEl.style.display = 'none';
    if (barEl)  barEl.style.width = '0%';
    try {
      var data = JSON.parse(xhr.responseText);
      if (data.ok) {
        if (fnameEl) fnameEl.textContent = data.filename;
        showToast('Image mise a jour', 'success');
      } else {
        showToast('Erreur: ' + data.error, 'error');
      }
    } catch(ex) { showToast('Erreur serveur', 'error'); }
  });

  xhr.addEventListener('error', function(){ showToast('Erreur reseau upload', 'error'); });
  xhr.open('POST', 'ajax/upload-image.php');
  xhr.send(fd);
}

/* ---------- Upload galerie ---------- */
function uploadGallery(input, sectionId) {
  if (!input.files || !input.files.length) return;
  var gallery = document.getElementById('gallery_' + sectionId);
  var addBtn  = gallery.querySelector('.cms-gallery-add');
  var files   = Array.from(input.files);
  showToast('Upload de ' + files.length + ' image(s)...', 'info');

  function uploadNext(i) {
    if (i >= files.length) { showToast('Images ajoutees a la galerie !', 'success'); input.value=''; return; }
    var fd = new FormData();
    fd.append('csrf_token', CSRF_TOKEN);
    fd.append('section_id', sectionId);
    fd.append('mode', 'gallery');
    fd.append('image', files[i]);
    fetch('ajax/upload-image.php', {method:'POST', body:fd, headers:{'X-CSRF-Token':CSRF_TOKEN}})
      .then(function(r){ return r.json(); })
      .then(function(data) {
        if (data.ok) {
          /* Build gallery item with safe DOM methods */
          var item = document.createElement('div');
          item.className = 'cms-gallery-item';
          item.id = 'gitem_' + data.image_id;

          var img = document.createElement('img');
          img.src = data.url;   /* server-returned URL from upload-image.php */
          img.alt = '';
          img.loading = 'lazy';

          var overlay = document.createElement('div');
          overlay.className = 'cms-gallery-overlay';

          var editbtn = document.createElement('button');
          editbtn.className = 'cms-gallery-edit';
          editbtn.textContent = '✏️ Modifier';
          var capturedId = data.image_id;
          editbtn.onclick = function(){ editGalleryImage(capturedId, '', ''); };

          var delbtn = document.createElement('button');
          delbtn.className = 'cms-gallery-delete';
          delbtn.textContent = 'Supprimer';
          delbtn.onclick = function(){ deleteGalleryImage(capturedId); };

          overlay.appendChild(editbtn);
          overlay.appendChild(delbtn);
          item.appendChild(img);
          item.appendChild(overlay);
          gallery.insertBefore(item, addBtn);
        } else { showToast('Erreur: ' + data.error, 'error'); }
        uploadNext(i + 1);
      }).catch(function(){ showToast('Erreur reseau', 'error'); uploadNext(i+1); });
  }
  uploadNext(0);
}

/* ---------- Supprimer image galerie ---------- */
function deleteGalleryImage(imageId) {
  if (!confirm('Supprimer cette image ?')) return;
  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('image_id', imageId);
  fetch('ajax/delete-gallery-image.php', {method:'POST', body:fd, headers:{'X-CSRF-Token':CSRF_TOKEN}})
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) {
        var el = document.getElementById('gitem_' + imageId);
        if (el) el.parentNode.removeChild(el);
        showToast('Image supprimee', 'success');
      } else { showToast('Erreur: ' + data.error, 'error'); }
    }).catch(function(){ showToast('Erreur reseau', 'error'); });
}

/* ---------- Editeur HTML simple ---------- */
function getHtmlTextarea(sectionId, fieldKey) {
  return document.getElementById('f_' + sectionId + '_' + fieldKey);
}
function htmlWrap(sid, fkey, tag) {
  var ta = getHtmlTextarea(sid, fkey);
  if (!ta) return;
  var s = ta.selectionStart, e = ta.selectionEnd;
  var selected = ta.value.substring(s, e);
  var replacement = '<' + tag + '>' + selected + '</' + tag + '>';
  ta.setRangeText(replacement, s, e, 'end');
}
function htmlWrapTag(sid, fkey, tag) { htmlWrap(sid, fkey, tag); }

/* ---------- Drag & drop reordonnancement ---------- */
(function() {
  var list = document.getElementById('cmsSectionsList');
  if (!list) return;
  var dragCard = null;

  list.querySelectorAll('.cms-drag-handle').forEach(function(handle) {
    var card = handle.closest('.cms-section-card');

    handle.addEventListener('mousedown', function() {
      card.setAttribute('draggable', 'true');
    });

    card.addEventListener('dragstart', function(e) {
      dragCard = card;
      card.classList.add('dragging');
      e.dataTransfer.effectAllowed = 'move';
    });

    card.addEventListener('dragend', function() {
      card.classList.remove('dragging');
      card.removeAttribute('draggable');
      list.querySelectorAll('.cms-section-card').forEach(function(c){ c.classList.remove('drag-over'); });
      saveOrder();
    });

    card.addEventListener('dragover', function(e) {
      e.preventDefault();
      if (dragCard && dragCard !== card) {
        card.classList.add('drag-over');
        var cards = Array.from(list.querySelectorAll('.cms-section-card'));
        var di = cards.indexOf(dragCard), ti = cards.indexOf(card);
        if (di < ti) list.insertBefore(dragCard, card.nextSibling);
        else list.insertBefore(dragCard, card);
      }
    });

    card.addEventListener('dragleave', function() { card.classList.remove('drag-over'); });
  });

  function saveOrder() {
    var ids = Array.from(list.querySelectorAll('.cms-section-card[data-section-id]'))
              .map(function(c){ return c.dataset.sectionId; });
    var body = new URLSearchParams();
    body.append('csrf_token', CSRF_TOKEN);
    ids.forEach(function(id){ body.append('order[]', id); });
    fetch('ajax/reorder-sections.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: body.toString()
    }).then(function(r){ return r.json(); })
      .then(function(data){ if (data.ok) showToast('Ordre sauvegarde', 'success'); })
      .catch(function(){});
  }
})();

/* ---------- UI Helpers ---------- */
function setStatus(el, cls, text) {
  if (!el) return;
  el.className = 'cms-save-indicator' + (cls ? ' ' + cls : '');
  el.textContent = text;
}

function showToast(msg, type) {
  type = type || 'info';
  var container = document.getElementById('toastContainer');
  var toast = document.createElement('div');
  toast.className = 'cms-toast ' + type;
  var icon = document.createElement('span');
  icon.textContent = type === 'success' ? '✓' : (type === 'error' ? '✗' : 'i');
  var text = document.createElement('span');
  text.textContent = msg;
  toast.appendChild(icon);
  toast.appendChild(text);
  container.appendChild(toast);
  setTimeout(function(){ if (toast.parentNode) toast.parentNode.removeChild(toast); }, 4000);
}

// ---- Upload vidéo ----
function uploadVideo(input, sectionId, fieldKey) {
  if (!input.files || !input.files[0]) return;
  var file = input.files[0];
  if (file.size > 50 * 1024 * 1024) { showToast('Vidéo trop lourde (max 50 Mo)', 'error'); return; }
  var label = input.closest('label');
  if (label) label.style.opacity = '0.6';
  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('section_id', sectionId);
  fd.append('field_key', fieldKey);
  fd.append('video', file);
  fetch('ajax/upload-video.php', { method:'POST', body:fd, headers:{'X-CSRF-Token':CSRF_TOKEN} })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (label) label.style.opacity = '1';
      if (data.ok) {
        // Mettre à jour l'aperçu vidéo
        var container = input.closest('.cms-field').querySelector('video');
        if (container) {
          container.querySelector('source').src = data.url;
          container.load();
        } else {
          var vid = document.createElement('video');
          vid.controls = true;
          vid.style.cssText = 'width:100%;max-height:180px;border-radius:8px;background:#000;';
          var src = document.createElement('source');
          src.src = data.url; src.type = 'video/mp4';
          vid.appendChild(src);
          input.closest('.cms-field').querySelector('div').prepend(vid);
        }
        var nm = document.getElementById('vidname_' + sectionId + '_' + fieldKey);
        if (nm) nm.textContent = data.filename;
        showToast('Vidéo uploadée !', 'success');
      } else {
        showToast('Erreur : ' + (data.error || ''), 'error');
      }
    })
    .catch(function(){ if(label) label.style.opacity='1'; showToast('Erreur réseau', 'error'); });
}

// ---- Projets : upload photo ----
function uploadProjetImage(input, projetId) {
  if (!input.files || !input.files[0]) return;
  var file = input.files[0];
  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('projet_id', projetId);
  fd.append('image', file);
  fetch('ajax/upload-projet-image.php', { method:'POST', body: fd })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) {
        var el = document.getElementById('proj-img-' + projetId);
        if (el) {
          if (el.tagName === 'IMG') {
            el.src = data.url + '?t=' + Date.now();
          } else {
            var img = document.createElement('img');
            img.id = 'proj-img-' + projetId;
            img.src = data.url;
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            el.parentNode.replaceChild(img, el);
          }
        }
        showToast('Photo mise à jour !', 'success');
      } else {
        showToast('Erreur : ' + (data.error || 'inconnue'), 'error');
      }
    })
    .catch(function(){ showToast('Erreur réseau', 'error'); });
}

// ---- Projets : modifier champ texte ----
var _projetUpdateTimers = {};
function updateProjet(projetId, field, value) {
  clearTimeout(_projetUpdateTimers[projetId + '_' + field]);
  _projetUpdateTimers[projetId + '_' + field] = setTimeout(function() {
    var body = new URLSearchParams();
    body.append('csrf_token', CSRF_TOKEN);
    body.append('projet_id', projetId);
    body.append('field', field);
    body.append('value', value);
    fetch('ajax/update-projet.php', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: body.toString()
    })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) showToast('Projet mis à jour', 'success');
      else showToast('Erreur : ' + (data.error || ''), 'error');
    })
    .catch(function(){ showToast('Erreur réseau', 'error'); });
  }, 600);
}

// ---- Projets : upload vidéo ----
function uploadProjetVideo(input, projetId) {
  if (!input.files || !input.files[0]) return;
  var file = input.files[0];
  var label = document.getElementById('vid-label-' + projetId);
  if (label) label.textContent = 'Upload en cours...';
  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('projet_id', projetId);
  fd.append('video', file);
  fetch('ajax/upload-projet-video.php', { method:'POST', body: fd })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) {
        if (label) label.textContent = 'Changer la vidéo';
        var badge = document.getElementById('vid-badge-' + projetId);
        if (badge) { badge.style.display = 'flex'; }
        var info = document.getElementById('vid-info-' + projetId);
        if (info) {
          info.style.display = 'flex';
          info.innerHTML = '<span style="font-size:.72rem;color:#718096;">' + data.filename + '</span>'
            + '<button onclick="supprimerVideo(' + projetId + ')" style="background:none;border:none;color:#e53e3e;font-size:.72rem;cursor:pointer;padding:0;">✕ Supprimer</button>';
        }
        showToast('Vidéo uploadée !', 'success');
      } else {
        if (label) label.textContent = 'Ajouter une vidéo (MP4/MOV)';
        showToast('Erreur : ' + (data.error || 'inconnue'), 'error');
      }
    })
    .catch(function(){ if(label) label.textContent='Ajouter une vidéo (MP4/MOV)'; showToast('Erreur réseau', 'error'); });
}

// ---- Projets : supprimer vidéo ----
function supprimerVideo(projetId) {
  if (!confirm('Supprimer la vidéo de ce projet ?')) return;
  var body = new URLSearchParams();
  body.append('csrf_token', CSRF_TOKEN);
  body.append('projet_id', projetId);
  body.append('field', 'video_url');
  body.append('value', '');
  fetch('ajax/update-projet.php', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body: body.toString() })
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) {
        var badge = document.getElementById('vid-badge-' + projetId);
        if (badge) badge.style.display = 'none';
        var info = document.getElementById('vid-info-' + projetId);
        if (info) { info.style.display = 'none'; info.innerHTML = ''; }
        var label = document.getElementById('vid-label-' + projetId);
        if (label) label.textContent = 'Ajouter une vidéo (MP4/MOV)';
        showToast('Vidéo supprimée', 'success');
      } else { showToast('Erreur : ' + (data.error || ''), 'error'); }
    });
}

/* ---------- Modifier image galerie ---------- */
var _editImgId = null;
function editGalleryImage(imageId, altText, caption) {
  _editImgId = imageId;
  document.getElementById('gedit-alt').value     = altText  || '';
  document.getElementById('gedit-caption').value = caption  || '';
  document.getElementById('galleryEditModal').classList.add('open');
}
function closeGalleryEditModal() {
  document.getElementById('galleryEditModal').classList.remove('open');
  _editImgId = null;
}
function saveGalleryEdit() {
  if (!_editImgId) return;
  var fd = new FormData();
  fd.append('csrf_token', CSRF_TOKEN);
  fd.append('image_id', _editImgId);
  fd.append('alt_text', document.getElementById('gedit-alt').value);
  fd.append('caption',  document.getElementById('gedit-caption').value);
  fetch('ajax/update-gallery-image.php', {method:'POST', body:fd, headers:{'X-CSRF-Token':CSRF_TOKEN}})
    .then(function(r){ return r.json(); })
    .then(function(data) {
      if (data.ok) { showToast('Image mise à jour', 'success'); closeGalleryEditModal(); }
      else showToast('Erreur : ' + (data.error || ''), 'error');
    }).catch(function(){ showToast('Erreur réseau', 'error'); });
}
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') closeGalleryEditModal();
});
</script>

<!-- Modal édition image galerie -->
<div class="gallery-edit-modal" id="galleryEditModal" onclick="if(event.target===this)closeGalleryEditModal()">
  <div class="gallery-edit-modal-box">
    <h3>Modifier l'image</h3>
    <label>Texte alternatif (alt)</label>
    <input type="text" id="gedit-alt" placeholder="Description de l'image…">
    <label>Légende (caption)</label>
    <textarea id="gedit-caption" rows="3" placeholder="Légende affichée sous l'image…"></textarea>
    <div class="gallery-edit-modal-actions">
      <button class="btn-cancel" onclick="closeGalleryEditModal()">Annuler</button>
      <button class="btn-save" onclick="saveGalleryEdit()">Enregistrer</button>
    </div>
  </div>
</div>

</body>
</html>
