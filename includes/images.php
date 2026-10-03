<?php
// Vignettes responsives : genere a la volee (GD) des variantes redimensionnees d'une image du site,
// mises en cache dans assets/cache/thumbs/. Repli silencieux sur l'original si GD/ecriture indisponibles.
function cotrac_thumb(string $rel, int $w): string {
    $rel = ltrim(preg_replace('/\?.*$/', '', $rel), '/');
    $src = __DIR__ . '/../' . $rel;
    $url = SITE_URL . '/' . $rel;
    if (!is_file($src) || !function_exists('imagecreatetruecolor')) return $url;
    $cacheDir = __DIR__ . '/../assets/cache/thumbs';
    if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0755, true)) return $url;
    $out = $cacheDir . '/' . substr(md5($rel), 0, 12) . '_' . $w . '.jpg';
    $outUrl = SITE_URL . '/assets/cache/thumbs/' . basename($out);
    if (is_file($out) && filemtime($out) >= filemtime($src)) return $outUrl;
    $info = @getimagesize($src); if (!$info) return $url;
    [$sw, $sh, $type] = $info;
    if ($sw <= $w) return $url; // deja assez petite
    $im = match ($type) { IMAGETYPE_JPEG => @imagecreatefromjpeg($src), IMAGETYPE_PNG => @imagecreatefrompng($src), IMAGETYPE_WEBP => @imagecreatefromwebp($src), default => null };
    if (!$im) return $url;
    $h = (int) round($sh * $w / $sw);
    $dst = imagecreatetruecolor($w, $h);
    $white = imagecolorallocate($dst, 255, 255, 255); imagefill($dst, 0, 0, $white); // PNG transparents -> fond blanc
    imagecopyresampled($dst, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
    $ok = @imagejpeg($dst, $out, 80); imagedestroy($dst); imagedestroy($im);
    return $ok ? $outUrl : $url;
}
/** Attributs srcset/sizes prets a inserer dans une balise <img>. $sizes : regle CSS sizes. */
function cotrac_srcset(string $rel, string $sizes = '(max-width: 600px) 100vw, 33vw'): string {
    $u480 = cotrac_thumb($rel, 480); $u960 = cotrac_thumb($rel, 960);
    if ($u480 === $u960) return ''; // pas de variante possible
    return ' srcset="' . htmlspecialchars($u480, ENT_QUOTES) . ' 480w, ' . htmlspecialchars($u960, ENT_QUOTES) . ' 960w" sizes="' . $sizes . '"';
}
