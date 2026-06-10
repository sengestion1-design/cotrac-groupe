<?php
/**
 * Système de traduction COTRAC
 * Charge la langue active et expose la fonction t()
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Langues supportées
define('LANG_SUPPORTED', ['fr', 'en']);
define('LANG_DEFAULT',   'fr');

// 1. Détection depuis GET → sauvegarde en session
if (isset($_GET['lang']) && in_array($_GET['lang'], LANG_SUPPORTED, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}

// 2. Lecture depuis la session (ou défaut)
$current_lang = (isset($_SESSION['lang']) && in_array($_SESSION['lang'], LANG_SUPPORTED, true))
    ? $_SESSION['lang']
    : LANG_DEFAULT;

// Expose la langue courante en variable globale
define('CURRENT_LANG', $current_lang);

// 3. Chargement du fichier de traductions
$_translations = require __DIR__ . '/' . $current_lang . '.php';

/**
 * Retourne la traduction d'une clé.
 * Retombe sur la clé elle-même si absente.
 */
function t(string $key): string
{
    global $_translations;
    return $_translations[$key] ?? $key;
}

/**
 * Construit l'URL du switcher de langue en préservant l'URL courante.
 * Remplace ou ajoute le paramètre ?lang=XX.
 */
function lang_url(string $lang): string
{
    $uri    = $_SERVER['REQUEST_URI'] ?? '/';
    $parts  = parse_url($uri);
    $path   = $parts['path'] ?? '/';

    parse_str($parts['query'] ?? '', $params);
    $params['lang'] = $lang;

    return $path . '?' . http_build_query($params);
}
