<?php
/**
 * BPS autoloader registration script.
 * @version 1.0.0
 */
// Prevent direct execution, use as include only.
if (count(get_included_files()) === 1) {
    http_response_code(403);
    die();
}
// Prevent including this file more than once.
if (defined('BPS_AUTOLOAD_' . crc32(__DIR__))) {
    return true;
}
define('BPS_AUTOLOAD_' . crc32(__DIR__), __DIR__);

//Register directory of current file as root path from where automatically load classes/structures.
spl_autoload_register(static function (string $class) {
    $cls_file = sprintf('%s%s.php', __DIR__ . '/', str_replace('\\', '/', $class));
    if (is_file($cls_file)) {
        require $cls_file;
    }
}, false, true);
