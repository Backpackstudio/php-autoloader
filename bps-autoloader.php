<?php
/**
 * BPS Autoloader.
 * @version 1.0.0
 */
// Prevent direct execution, use as include only.
if (count(get_included_files()) === 1) {
    http_response_code(403);
    die();
}

// Prevent including this file more than once.
if (function_exists('register_path_for_autoload')) {
    return true;
}

/**
 * Registers given path as root path for autoloader.
 * @param string $dir_path Root directory from where autoload should automatically load classes/structures.
 * @return bool True if given path were registered as autoload location.
 */
function register_path_for_autoload(string $dir_path): bool
{
    static $paths;
    if (is_null($paths)) {
        $paths = [];
    }
    $dir_path = rtrim($dir_path, '/\\') . '/';
    if (in_array(crc32($dir_path), $paths, true)) {
        return true;
    }
    if (!is_dir($dir_path)) {
        return false;
    }
    $res = spl_autoload_register(static function (string $class) use ($dir_path) {
        $cls_file = sprintf('%s%s.php', $dir_path, str_replace('\\', '/', $class));
        if (is_file($cls_file)) {
            require $cls_file;
        }
    }, false, true);
    if ($res === true) {
        $paths[] = crc32($dir_path);
    }
    return $res;
}

