<?php
/**
 * Sidebar partagée - Admin COTRAC
 * Variables attendues : $current_page (ex: 'index', 'projets', 'messages')
 *                       $nb_messages (non lus)
 */
if (!isset($current_page)) $current_page = '';
if (!isset($nb_messages))  $nb_messages  = 0;
?>
<aside class="admin-sidebar">
  <div class="admin-sidebar-logo">
    <a href="index.php" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
      <img src="<?= defined('SITE_URL') ? SITE_URL : '' ?>/assets/images/logo-cotrac.png"
           alt="Logo COTRAC"
           style="height:48px;width:48px;object-fit:contain;border-radius:8px;background:#fff;padding:4px;flex-shrink:0;">
      <div>
        <div class="brand">C<span>O</span>TRAC</div>
        <small>Back-office</small>
      </div>
    </a>
  </div>

  <nav class="admin-nav">
    <div class="admin-nav-section-label">Navigation</div>

    <a href="index.php" class="admin-nav-link <?= $current_page === 'index' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
      </span>
      <span class="admin-nav-label">Tableau de bord</span>
    </a>

    <a href="projets.php" class="admin-nav-link <?= $current_page === 'projets' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
      </span>
      <span class="admin-nav-label">Projets</span>
    </a>

    <a href="messages.php" class="admin-nav-link <?= $current_page === 'messages' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
      </span>
      <span class="admin-nav-label">Messages</span>
      <?php if ($nb_messages > 0): ?>
        <span class="badge-count"><?= (int)$nb_messages ?></span>
      <?php endif; ?>
    </a>

    <a href="equipements.php" class="admin-nav-link <?= $current_page === 'equipements' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
      </span>
      <span class="admin-nav-label">Équipements</span>
    </a>

    <a href="partenaires.php" class="admin-nav-link <?= $current_page === 'partenaires' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      </span>
      <span class="admin-nav-label">Partenaires</span>
    </a>

    <a href="videos.php" class="admin-nav-link <?= $current_page === 'videos' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
      </span>
      <span class="admin-nav-label">Vidéos</span>
    </a>

    <a href="actualites.php" class="admin-nav-link <?= $current_page === 'actualites' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
      </span>
      <span class="admin-nav-label">Actualités</span>
    </a>

    <a href="parametres-pages.php" class="admin-nav-link <?= $current_page === 'parametres-pages' ? 'active' : '' ?>">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
      </span>
      <span class="admin-nav-label">Contenus des pages</span>
    </a>

    <div class="admin-nav-sep"></div>

    <a href="<?= defined('SITE_URL') ? SITE_URL : '../' ?>" target="_blank" class="admin-nav-link admin-nav-link-ext">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
      </span>
      <span class="admin-nav-label">Voir le site</span>
      <span class="admin-nav-ext-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
      </span>
    </a>

    <a href="logout.php" class="admin-nav-link admin-nav-link-logout" onclick="return confirm('Se déconnecter ?')">
      <span class="admin-nav-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      </span>
      <span class="admin-nav-label">Déconnexion</span>
    </a>
  </nav>
</aside>
