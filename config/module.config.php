<?php
/**
 * Autoload module configuration files
 * in the autoload/ directory.
 *
 * File inclusion priority:
 * - *.php
 * - *.local.php
 * - *.APP_ENV.php (defined in application.config.php)
 * - *.global.php
 */
$config = [];
$pattern = sprintf(
    __DIR__ . '/autoload/*{,.local,%s,.global}.php',
    ( defined('APP_ENV') ? APP_ENV : '' )
);
$configFiles = array_reverse(array_unique(array_reverse(glob($pattern, GLOB_BRACE))));

foreach( $configFiles as $configFile ) {
    $config = array_merge_recursive($config, include_once $configFile);
}

return $config;