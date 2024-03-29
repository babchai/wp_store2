<?php
/**
 * Installs WordPress for running the tests and loads WordPress and the test libraries
 */

error_reporting( E_ALL & ~E_DEPRECATED & ~E_STRICT );

require_once 'PHPUnit/Autoload.php';

$config_file_path = dirname( __FILE__ ) . '/unittests-config.php';

$_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
$_SERVER['HTTP_HOST'] = 'example.org';
$PHP_SELF = $GLOBALS['PHP_SELF'] = $_SERVER['PHP_SELF'] = '/index.php';

system( 'php '.escapeshellarg( dirname( __FILE__ ) . '/bin/install.php' ) . ' ' . escapeshellarg( $config_file_path ) );

require_once $config_file_path;

/*
Globalize some WordPress variables, because PHPUnit loads this file inside a function
See: https://github.com/sebastianbergmann/phpunit/issues/325

These are not needed for WordPress 3.3+, only for older versions
*/
global $wp_embed, $wp_locale, $_wp_deprecated_widgets_callbacks, $wp_widget_factory;

require_once ABSPATH . '/wp-settings.php';
require dirname( __FILE__ ) . '/lib/testcase.php';
require dirname( __FILE__ ) . '/lib/exceptions.php';