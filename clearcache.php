<?php
if (!isset($_GET['token']) || !hash_equals('cotrac_clear_2026', $_GET['token'])) {
    http_response_code(403);
    exit('Accès refusé');
}
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo 'OPcache vidé';
} else {
    echo 'OPcache non actif';
}
