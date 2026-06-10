<?php
/**
 * COTRAC CMS — Fonctions d'accès aux contenus de pages
 * Utilisé à la fois par les pages publiques ET l'admin.
 */

/**
 * Charge toutes les sections d'une page avec leurs champs.
 * Retourne un tableau indexé par section_key.
 *
 * @param  string $page_slug  ex: 'index', 'btp', 'energie'
 * @return array  ['hero' => ['title'=>'...', 'subtitle'=>'...', 'bg_image'=>'...'], ...]
 */
function cms_get_page(string $page_slug): array {
    static $cache = [];
    if (isset($cache[$page_slug])) return $cache[$page_slug];

    try {
        $db = getDB();

        // Récupérer les sections actives
        $stmt = $db->prepare(
            "SELECT s.id, s.section_key, s.section_type, s.label, s.sort_order, s.active
             FROM page_sections s
             WHERE s.page_slug = :slug
             ORDER BY s.sort_order ASC"
        );
        $stmt->execute([':slug' => $page_slug]);
        $sections_raw = $stmt->fetchAll();

        if (empty($sections_raw)) {
            $cache[$page_slug] = [];
            return [];
        }

        // IDs des sections
        $ids = array_column($sections_raw, 'id');
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        // Récupérer tous les champs d'un coup
        $fstmt = $db->prepare(
            "SELECT section_id, field_key, field_type, field_label, field_value, sort_order
             FROM page_section_fields
             WHERE section_id IN ($placeholders)
             ORDER BY section_id, sort_order ASC"
        );
        $fstmt->execute($ids);
        $fields_raw = $fstmt->fetchAll();

        // Indexer les champs par section_id
        $fields_by_section = [];
        foreach ($fields_raw as $f) {
            $fields_by_section[$f['section_id']][$f['field_key']] = [
                'value'      => $f['field_value'],
                'type'       => $f['field_type'],
                'label'      => $f['field_label'],
                'sort_order' => $f['sort_order'],
            ];
        }

        // Récupérer les images de galerie
        $gstmt = $db->prepare(
            "SELECT section_id, id, image_path, alt_text, caption, sort_order
             FROM page_section_images
             WHERE section_id IN ($placeholders)
             ORDER BY section_id, sort_order ASC"
        );
        $gstmt->execute($ids);
        $images_by_section = [];
        foreach ($gstmt->fetchAll() as $img) {
            $images_by_section[$img['section_id']][] = $img;
        }

        // Construire le tableau final indexé par section_key
        $result = [];
        foreach ($sections_raw as $sec) {
            $key = $sec['section_key'];
            $sid = $sec['id'];
            $fields = $fields_by_section[$sid] ?? [];

            // Raccourcis : valeur brute par field_key
            $values = [];
            foreach ($fields as $fkey => $fdata) {
                $values[$fkey] = $fdata['value'];
            }

            $result[$key] = [
                '_id'      => $sid,
                '_type'    => $sec['section_type'],
                '_label'   => $sec['label'],
                '_active'  => (bool)$sec['active'],
                '_order'   => (int)$sec['sort_order'],
                '_fields'  => $fields,          // données complètes pour l'admin
                '_images'  => $images_by_section[$sid] ?? [],
            ] + $values;  // valeurs directement accessibles par $section['title'], etc.
        }

        $cache[$page_slug] = $result;
        return $result;

    } catch (Exception $e) {
        error_log('[CMS] Erreur cms_get_page(' . $page_slug . '): ' . $e->getMessage());
        return [];
    }
}

/**
 * Raccourci : récupère une valeur de champ avec fallback.
 *
 * Usage : cms_field($sections, 'hero', 'title', 'Titre par défaut')
 */
function cms_field(array $sections, string $section_key, string $field_key, string $fallback = ''): string {
    $val = $sections[$section_key][$field_key] ?? null;
    return ($val !== null && $val !== '') ? $val : $fallback;
}

/**
 * Renvoie l'URL complète d'une image CMS, ou l'image fallback si vide.
 * Les images CMS sont stockées dans /uploads/cms/
 */
function cms_image_url(string $path, string $fallback = ''): string {
    if (empty($path)) return $fallback;
    // Si déjà une URL absolue
    if (str_starts_with($path, 'http')) return $path;
    return SITE_URL . '/uploads/cms/' . ltrim($path, '/');
}

/**
 * Retourne vrai si la section existe et est active
 */
function cms_section_active(array $sections, string $section_key): bool {
    return isset($sections[$section_key]) && ($sections[$section_key]['_active'] ?? false);
}

/**
 * Retourne les images de galerie d'une section
 */
function cms_gallery(array $sections, string $section_key): array {
    return $sections[$section_key]['_images'] ?? [];
}
