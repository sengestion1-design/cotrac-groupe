<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../lang/lang.php';
require_once __DIR__ . '/icons.php';
security_headers();
$page_title = $page_title ?? 'COTRAC - Compagnie des Travaux et Constructions';
$page_desc  = $page_desc  ?? 'COTRAC, entreprise sénégalaise spécialisée en BTP, réseaux électriques, construction de routes et génie industrielle depuis 2015.';
?>
<!DOCTYPE html>
<html lang="<?= CURRENT_LANG ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= e($page_desc) ?>">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="<?= e($page_title) ?>">
  <meta property="og:description" content="<?= e($page_desc) ?>">
  <meta property="og:type" content="website">
  <title><?= e($page_title) ?></title>
  <link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css?v=<?= filemtime(__DIR__.'/../assets/css/style.css') ?>">
  <link rel="icon" type="image/png" href="<?= SITE_URL ?>/assets/images/favicon.png">
  <style>
    /* ── Sous-menu dropdown ── */
    .dropdown-sub-item { position: relative; }
    .dropdown-sub-trigger { justify-content: space-between !important; }
    .sub-arrow { margin-left: auto; font-size: .8rem; color: var(--gris); transition: transform .2s; }
    .dropdown-sub {
      position: absolute;
      left: 100%;
      top: 0;
      background: var(--blanc);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      box-shadow: var(--shadow-lg);
      min-width: 240px;
      padding: 8px;
      opacity: 0;
      visibility: hidden;
      transform: translateX(-6px);
      transition: var(--transition);
    }
    .dropdown-sub-item:hover .dropdown-sub {
      opacity: 1;
      visibility: visible;
      transform: translateX(0);
    }
    .dropdown-sub-item:hover .sub-arrow { transform: rotate(90deg); }
    @media (max-width: 900px) {
      .dropdown-sub {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        border: none;
        padding: 0 0 0 20px;
        min-width: unset;
        width: 100%;
      }
      .dropdown-sub-trigger {
        justify-content: flex-start !important;
        gap: 8px;
      }
      .dropdown-sub-trigger .sub-arrow { display: none; }
      .dropdown-sub-item { width: 100%; }
    }
    /* ── Switcher de langue ── */
    .lang-switcher {
      display: flex;
      align-items: center;
      gap: 6px;
      font-family: 'Poppins', sans-serif;
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.04em;
      margin-left: auto;
      order: 3;
      background: #f0f4fa;
      border-radius: 30px;
      padding: 4px 6px;
      border: 1px solid #dce6f5;
    }
    .lang-btn {
      display: flex;
      align-items: center;
      gap: 5px;
      padding: 5px 11px;
      border-radius: 20px;
      text-decoration: none;
      color: #666;
      font-size: 0.75rem;
      font-weight: 600;
      transition: all .2s ease;
      white-space: nowrap;
      letter-spacing: 0.05em;
    }
    .lang-btn:hover {
      color: #1a6bb5;
      background: #fff;
      box-shadow: 0 2px 8px rgba(26,107,181,0.15);
    }
    .lang-btn.lang-active {
      color: #fff;
      background: #1a6bb5;
      box-shadow: 0 2px 10px rgba(26,107,181,0.35);
      font-weight: 700;
    }
    .lang-sep { display: none; }
    @media (max-width: 768px) {
      .lang-switcher { margin-left: auto; margin-right: 10px; padding: 3px 5px; }
      .lang-btn { padding: 4px 8px; }
      .lang-btn span { display: none; }
    }
  </style>
</head>
<body>

<header class="header" id="header">
  <div class="container">
    <div class="header-inner">

      <!-- Logo -->
      <a href="<?= SITE_URL ?>/index.php" class="logo">
        <img src="<?= SITE_URL ?>/assets/images/logo-cotrac.png" alt="Logo COTRAC" style="height:52px;">
        <div class="logo-text">
          <span class="name">C<span>O</span>TRAC</span>
          <span class="tagline">Compagnie des Travaux et Constructions</span>
        </div>
      </a>

      <!-- Switcher de langue -->
      <div class="lang-switcher">
        <a href="<?= lang_url('fr') ?>" class="lang-btn <?= CURRENT_LANG === 'fr' ? 'lang-active' : '' ?>" title="<?= t('lang_fr') ?>">
          🇫🇷 <span>FR</span>
        </a>
        <span class="lang-sep">|</span>
        <a href="<?= lang_url('en') ?>" class="lang-btn <?= CURRENT_LANG === 'en' ? 'lang-active' : '' ?>" title="<?= t('lang_en') ?>">
          🇬🇧 <span>EN</span>
        </a>
      </div>

      <!-- Navigation -->
      <nav class="nav" id="nav">
        <a href="<?= SITE_URL ?>/index.php" class="nav-link"><?= t('nav_accueil') ?></a>
        <a href="<?= SITE_URL ?>/a-propos.php" class="nav-link"><?= t('nav_a_propos') ?></a>

        <div class="nav-item">
          <a href="#" class="nav-link"><?= t('nav_poles') ?> ▾</a>
          <div class="dropdown">
            <a href="<?= SITE_URL ?>/btp.php"><span class="dot" style="background:#f7941d"></span> <?= t('nav_poles_btp') ?></a>
            <div class="dropdown-sub-item">
              <a href="<?= SITE_URL ?>/energie.php" class="dropdown-sub-trigger"><span class="dot" style="background:#27ae60"></span> <?= t('nav_poles_energie_label') ?> <span class="sub-arrow">›</span></a>
              <div class="dropdown-sub">
                <a href="<?= SITE_URL ?>/energie.php"><span class="dot" style="background:#27ae60"></span> <?= t('nav_poles_energie') ?></a>
              </div>
            </div>
            <a href="<?= SITE_URL ?>/routes.php"><span class="dot" style="background:#1a6bb5"></span> <?= t('nav_poles_routes') ?></a>
            <a href="<?= SITE_URL ?>/industrie.php"><span class="dot" style="background:#8e44ad"></span> <?= t('nav_poles_industrie') ?></a>
            <a href="<?= SITE_URL ?>/froid-clim.php"><span class="dot" style="background:#0891b2"></span> <?= t('nav_poles_froid_clim') ?></a>
          </div>
        </div>

<a href="<?= SITE_URL ?>/realisations.php" class="nav-link"><?= t('nav_realisations') ?></a>
        <a href="<?= SITE_URL ?>/nos-ressources.php" class="nav-link"><?= t('nav_ressources') ?></a>
        <a href="<?= SITE_URL ?>/actualites.php" class="nav-link"><?= t('nav_actualites') ?></a>
        <a href="<?= SITE_URL ?>/contact.php" class="nav-link nav-cta">
          <span class="btn btn-primary btn-sm"><?= t('nav_contact') ?></span>
        </a>
      </nav>

      <!-- Hamburger -->
      <button class="hamburger" id="hamburger" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>

    </div>
  </div>
</header>
