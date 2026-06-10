<?php
define('DB_HOST', getenv('DB_HOST') ?: 'db5020666806.hosting-data.io');
define('DB_NAME', getenv('DB_NAME') ?: 'dbs15776005');
define('DB_USER', getenv('DB_USER') ?: 'dbu2431230');
define('DB_PASS', getenv('DB_PASS') ?: 'Senegal202061986');
define('DB_CHARSET', 'utf8mb4');
define('SITE_URL', 'https://cotracgroup.com');
define('SITE_NAME', 'COTRAC - Compagnie des Travaux et Constructions');
define('UPLOAD_DIR', __DIR__ . '/../uploads/projets/');
define('UPLOAD_URL', SITE_URL . '/uploads/projets/');

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=3306";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('DB Error: ' . $e->getMessage());
            die('Erreur de connexion à la base de données.');
        }
    }
    return $pdo;
}

// Sécurité : échapper les sorties HTML
function e(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Générer un token CSRF
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Vérifier le token CSRF (POST body ou header X-CSRF-Token)
function csrf_verify(): bool {
    if (!isset($_SESSION['csrf_token'])) return false;

    // 1. Priorité : body POST (FormData fetch)
    if (!empty($_POST['csrf_token'])) {
        return hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
    }

    // 2. Header HTTP X-CSRF-Token (fetch avec headers:{...})
    //    getallheaders() est dispo sur Apache/XAMPP Mac.
    //    Fallback $_SERVER pour les configs sans getallheaders().
    $headers = function_exists('getallheaders') ? getallheaders() : [];
    $token = $headers['X-CSRF-Token']
        ?? $headers['x-csrf-token']          // certains serveurs lowercase
        ?? $_SERVER['HTTP_X_CSRF_TOKEN']      // fallback $_SERVER (tirets → underscores)
        ?? null;

    return $token !== null && hash_equals($_SESSION['csrf_token'], $token);
}

// Charger toutes les sections CMS d'une page en cache mémoire
function cms_load(string $page_slug): void {
    static $loaded = [];
    if (isset($loaded[$page_slug])) return;
    $loaded[$page_slug] = true;
    try {
        $db = getDB();
        // Stocker l'état active de chaque section
        $secs = $db->prepare("SELECT section_key, active FROM page_sections WHERE page_slug = ?");
        $secs->execute([$page_slug]);
        foreach ($secs->fetchAll() as $s) {
            $GLOBALS['_CMS_ACTIVE'][$page_slug . '_' . $s['section_key']] = (bool)$s['active'];
        }
        // Charger les champs uniquement des sections actives
        $stmt = $db->prepare(
            "SELECT ps.section_key, psf.field_key, psf.field_value
             FROM page_sections ps
             JOIN page_section_fields psf ON psf.section_id = ps.id
             WHERE ps.page_slug = ? AND ps.active = 1 AND psf.field_value IS NOT NULL AND psf.field_value != ''"
        );
        $stmt->execute([$page_slug]);
        foreach ($stmt->fetchAll() as $row) {
            $key = 'cms_' . $page_slug . '_' . $row['section_key'] . '_' . $row['field_key'];
            $GLOBALS['_CMS_CACHE'][$key] = $row['field_value'];
        }
    } catch (Exception $e) {
        error_log('[CMS] cms_load error: ' . $e->getMessage());
    }
}

// Vérifier si une section CMS est active
function cms_active(string $page_slug, string $section_key): bool {
    cms_load($page_slug);
    return $GLOBALS['_CMS_ACTIVE'][$page_slug . '_' . $section_key] ?? true;
}

// Lire une valeur CMS — fallback sur $default si non définie
function cms(string $page_slug, string $section_key, string $field_key, string $default = ''): string {
    cms_load($page_slug);
    $key = 'cms_' . $page_slug . '_' . $section_key . '_' . $field_key;
    return $GLOBALS['_CMS_CACHE'][$key] ?? $default;
}

// Retourner l'URL complète d'une image CMS (assets/ ou uploads/cms/)
function cms_img_url(string $path): string {
    if ($path === '') return '';
    if (str_starts_with($path, 'assets/') || str_starts_with($path, 'uploads/')) {
        return SITE_URL . '/' . $path;
    }
    return SITE_URL . '/uploads/cms/' . $path;
}

// Retourner l'URL uniquement si c'est une vraie image uploadée (uploads/cms/)
// Retourne '' si c'est une image assets/ par défaut — utile pour les hero backgrounds
function cms_bg_url(string $path): string {
    if ($path === '' || str_starts_with($path, 'assets/')) return '';
    if (str_starts_with($path, 'uploads/')) {
        return SITE_URL . '/' . $path;
    }
    return SITE_URL . '/uploads/cms/' . $path;
}

// Headers de sécurité
function security_headers(): void {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://fonts.googleapis.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://fonts.gstatic.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:;");
}
