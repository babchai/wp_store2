<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wpStore');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'afQ_(y!T-7B+|m$T]]My-N~^e*2>_A&o2mrl}7e0nap:%ugBF<I9;/4f4I&]8/yr');
define('SECURE_AUTH_KEY',  'F1`ln8mw!>NcA).,H?;@2$Uin0zy>msexQ;_@IKiU5/ vqA^^ZkZ 8Ja5[oDyC6z');
define('LOGGED_IN_KEY',    't]+ShBRZL%JCI(p(rnB:Fw#9/Y1h86{NC=~%Sc/p( )q3-|3:XyQAV54Zg~}:j}+');
define('NONCE_KEY',        'UVbPDtDTm{X~&nsn!m*{Ppo;F`jhn[G?OQMz]_fgg#tf@ID]%yuw[r+]~GxpMl+9');
define('AUTH_SALT',        '&~7Q8M-(uqDA`Zx)_!Vu(+*<!|.{h|qXCxMp/l!In%2H$D026MZYuea!:uMa^uL|');
define('SECURE_AUTH_SALT', 'nqCX2XQK+S?bw-%.=1|9vUM*WN(z[_l]??osuN%<hF,$X+O,-b|io8#$wcKW]Bu1');
define('LOGGED_IN_SALT',   '|/|q=9[#j[Q-_x>xKV-GW3{0JxnGOWvT%&|4^Cac]{#~GwRcfB=ch{_ch!I x-)e');
define('NONCE_SALT',       'Ii8Trhz$PpYmhD)DtM=L2<~)ar5r9Xn2V@m}7NdW%jjs-w!K]Ay)BU*j<?r4=h-:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
