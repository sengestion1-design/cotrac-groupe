<?php
/**
 * Bibliothèque d'icônes SVG COTRAC
 * Usage : <?= icon('btp') ?>
 * Toutes les icônes sont en SVG inline, taille 1em par défaut, couleur currentColor.
 */
function icon(string $name, string $class = '', string $size = '1em'): string {
    $cls = $class ? " class=\"{$class}\"" : '';
    $icons = [

        /* ── Pôles ──────────────────────────────────────────────────────── */
        'btp' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 22 21 22 21 8 12 2 3 8"/><rect x="9" y="13" width="6" height="9"/><line x1="3" y1="22" x2="3" y2="8"/><line x1="21" y1="22" x2="21" y2="8"/></svg>',

        'energie' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>',

        'routes' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l4-10 5 4 5-8 4 14"/><line x1="3" y1="21" x2="21" y2="21"/></svg>',

        'industrie' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="4" height="14"/><path d="M6 7l5-5v18H6"/><path d="M11 7l6 4V7l5-5v18H11"/></svg>',

        /* ── Services énergie ───────────────────────────────────────────── */
        'hta' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>',

        'poste' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M9 9h1v6H9M14 9h1m-1 3h1m-1 3h1"/><line x1="3" y1="9" x2="21" y2="9"/></svg>',

        'bt' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>',

        'eclairage' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a7 7 0 0 1 7 7c0 2.6-1.4 4.9-3.5 6.2L15 17H9l-.5-1.8A7 7 0 0 1 12 2z"/></svg>',

        'solaire' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="10" width="18" height="7" rx="1"/><path d="M7 10V7m4 3V5m4 5V7M5 17l-2 4m16-4 2 4M3 10h18"/></svg>',

        'signalisation' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><line x1="12" y1="22" x2="12" y2="12"/><path d="M2 17l10 5 10-5"/></svg>',

        'maintenance' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',

        /* ── Services BTP / routes / industrie ─────────────────────────── */
        'gros-oeuvre' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="14" width="20" height="7" rx="1"/><path d="M6 14V8m4 6V4m4 10V8m4 6V5"/></svg>',

        'terrassement' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20h20"/><path d="M5 20V8l7-6 7 6v12"/><path d="M9 20v-6h6v6"/></svg>',

        'route' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 21 L12 3 L19 21"/><line x1="8.5" y1="13" x2="15.5" y2="13"/><line x1="12" y1="3" x2="12" y2="21" stroke-dasharray="2 3"/></svg>',

        'pont' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 14a8 8 0 0 1 16 0"/><line x1="2" y1="14" x2="22" y2="14"/><line x1="6" y1="14" x2="6" y2="20"/><line x1="18" y1="14" x2="18" y2="20"/><line x1="2" y1="20" x2="22" y2="20"/></svg>',

        'vrd' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="2"/><path d="M16.24 7.76a6 6 0 0 1 0 8.49"/><path d="M7.76 7.76a6 6 0 0 0 0 8.49"/><path d="M20.49 3.51a12 12 0 0 1 0 16.97"/><path d="M3.51 3.51a12 12 0 0 0 0 16.97"/></svg>',

        'mecanique' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a9.93 9.93 0 0 0-14.14 0"/><path d="M4.93 19.07a9.93 9.93 0 0 0 14.14 0"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>',

        'vmc' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v6m0 8v6M4.93 4.93l4.24 4.24m5.66 5.66 4.24 4.24M2 12h6m8 0h6M4.93 19.07l4.24-4.24m5.66-5.66 4.24-4.24"/><circle cx="12" cy="12" r="2"/></svg>',

        'froid' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="22"/><path d="m4.93 6 14.14 12M4.93 18 19.07 6"/><circle cx="12" cy="12" r="2"/><path d="M12 2 9 5m3-3 3 3M12 22l-3-3m3 3 3-3M2 12l3-3m-3 3 3 3M22 12l-3-3m3 3-3 3"/></svg>',

        'chaudronnerie' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12a10 10 0 0 1 20 0"/><path d="M5 12a7 7 0 0 1 14 0"/><path d="M8 12a4 4 0 0 1 8 0"/><line x1="12" y1="12" x2="12" y2="22"/></svg>',

        /* ── Contact / info ─────────────────────────────────────────────── */
        'location' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',

        'phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.92 12 19.79 19.79 0 0 1 1.88 3.4 2 2 0 0 1 3.86 1.21h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',

        'mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>',

        'user' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',

        'users' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',

        'message' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',

        /* ── Valeurs / qualité ──────────────────────────────────────────── */
        'target' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>',

        'handshake' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11L12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>',

        'globe' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>',

        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>',

        'zap' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>',

        'map-pin' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>',

        'briefcase' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>',

        'award' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>',

        'wrench' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',

        'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>',

        'check' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',

        /* ── Admin / dashboard ──────────────────────────────────────────── */
        'chart' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><line x1="2" y1="20" x2="22" y2="20"/></svg>',

        'file' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>',

        'lock' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',

        'logout' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>',

        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>',

        'star' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="currentColor" stroke="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',

        /* ── Normes ─────────────────────────────────────────────────────── */
        'certificate' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/><path d="M9 8l2 2 4-4"/></svg>',

        'senegal' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><line x1="9" y1="4" x2="9" y2="20"/><line x1="15" y1="4" x2="15" y2="20"/><polygon points="12 8 13.5 11 12 10 10.5 11" fill="currentColor" stroke="none"/></svg>',

        'building' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/><path d="M7 6h.01"/><path d="M12 6h.01"/><path d="M17 6h.01"/><path d="M12 13h.01"/><path d="M17 13h.01"/><path d="M12 17h.01"/><path d="M17 17h.01"/></svg>',

        'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" width="'.$size.'" height="'.$size.'"'.$cls.' viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>',

    ];

    return $icons[$name] ?? '';
}

/**
 * Balise image optimisée : WebP si disponible, lazy loading, dimensions explicites.
 * Usage : <?= img_webp('assets/images/hero/hero-bg.jpg', 'Description', 'ma-classe', 1200, 675) ?>
 *
 * @param string $src     Chemin relatif depuis la racine du site (sans SITE_URL)
 * @param string $alt     Texte alternatif
 * @param string $class   Classes CSS
 * @param int    $width   Largeur en px (0 = omis)
 * @param int    $height  Hauteur en px (0 = omis)
 * @param bool   $eager   true = chargement immédiat (above-the-fold)
 * @param string $style   Styles inline supplémentaires
 */
function img_webp(string $src, string $alt = '', string $class = '', int $width = 0, int $height = 0, bool $eager = false, string $style = ''): string {
    $root     = __DIR__ . '/../';
    $webpSrc  = preg_replace('/\.(jpe?g|png)$/i', '.webp', $src);
    $hasWebp  = file_exists($root . $webpSrc);
    $loading  = $eager ? 'eager' : 'lazy';
    $decoding = $eager ? 'sync'  : 'async';

    $wAttr = $width  ? " width=\"{$width}\""  : '';
    $hAttr = $height ? " height=\"{$height}\"" : '';
    $cls   = $class  ? " class=\"" . htmlspecialchars($class, ENT_QUOTES) . "\"" : '';
    $sty   = $style  ? " style=\"" . htmlspecialchars($style, ENT_QUOTES) . "\"" : '';
    $altA  = " alt=\"" . htmlspecialchars($alt, ENT_QUOTES) . "\"";

    if (!defined('SITE_URL')) define('SITE_URL', '');

    $srcFull    = SITE_URL . '/' . ltrim($src, '/');
    $webpFull   = SITE_URL . '/' . ltrim($webpSrc, '/');

    if ($hasWebp) {
        return "<picture>"
             . "<source srcset=\"{$webpFull}\" type=\"image/webp\">"
             . "<img src=\"{$srcFull}\"{$altA}{$cls}{$sty}{$wAttr}{$hAttr} loading=\"{$loading}\" decoding=\"{$decoding}\">"
             . "</picture>";
    }

    return "<img src=\"{$srcFull}\"{$altA}{$cls}{$sty}{$wAttr}{$hAttr} loading=\"{$loading}\" decoding=\"{$decoding}\">";
}
