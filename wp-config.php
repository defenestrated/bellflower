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
define('DB_NAME', 'bellflowerWP');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '_R{)#X;R<z[.&b>m<;D !*x<KAER-xh4q2#(;IF~f2yQ~ix4%TBX)1Tvgq&hnV-O');
define('SECURE_AUTH_KEY',  '6t`G*N6)W5%R^4 ;b3GuK5yx^5aqSB-Y0DV+Pa>LD?&9 DJiL$2} oO<wnT{k}f5');
define('LOGGED_IN_KEY',    'Vgq]im} M%rWd]>f:d.%org=YGx,H^s~nww}ITr.0S6sMV`~ W~+1SINg>vsdelj');
define('NONCE_KEY',        '(DG1`:?n qZR~e{hCdI)#NUm~B|56Fg/+:M))49qc:}UuOFA.3P2K)Z1TIl:Zb:_');
define('AUTH_SALT',        'vi3oO^z*Gf)}J_9aXM4-*O!yK:em{iD=F;8Oyc,W7m 6q?hV,pnQ(G *%,J,j0V@');
define('SECURE_AUTH_SALT', 'QQ~$c`6D8:8>zZ8SySol[k^yCC2d#>x10[pDVqbn02~a?c)(~Y;F?g`wu>vzml{L');
define('LOGGED_IN_SALT',   'lk#x}.c`1peG+F_-Ni <AWA|sQA(K9:y2i|Ro:.#-6=j3VvE|6mKiT<#u^pN1dXT');
define('NONCE_SALT',       '7iq?{O7:&!chlW#|Wh,gR}%I._/i^Q/0Z7q~~;t%a6C<R<.wQ=AoNYM$XKAK/1I3');

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
