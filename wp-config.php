<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'learnonc_sweetgarden');
/** MySQL database username */
// define('DB_USER', 'learnonc_sweetga');
define('DB_USER', 'root');
/** MySQL database password */
// define('DB_PASSWORD', 'try@123');
define('DB_PASSWORD', '');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');
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
define('AUTH_KEY',         'jSoZ:lMx/K8DMuJOasTRl{CvfSt| Wzp55xzdq&s!vh ivU;D<A0`1EYo{pyOi!O');
define('SECURE_AUTH_KEY',  'bQ90f57F9G}}R+~?OJmdjD)Gr> Cckay8?kO: H@}rR~6@mWbN6Z+O.ENE]4xXUp');
define('LOGGED_IN_KEY',    'kDUdlZk;oGqasalm]|eJ9?2,uw+;(gHAoHBPJM3Se8ux)]9e:6US|7(c-&G5xJF7');
define('NONCE_KEY',        ';T.{q9/n(B9XPEhEc/.|AJM]<xkOG;xnMUKyQfT0s@0Jm-<b&ErW`ubxFzY9[8AC');
define('AUTH_SALT',        '<gcF8bzn`0l^H%N6|S_g9*-E9j0}L3T{f]S 1sX^_L&zq/)&Xp[BXr?{Z7=u)lp*');
define('SECURE_AUTH_SALT', '|(I5Z~Q6P^a4$r>57XkRTFDL{sH>OQYZ;]Spw!>6q?aD{;J l!H<<z.aV!h qXd$');
define('LOGGED_IN_SALT',   'KTkhnNh{b l_.JvH.k0<P,$)+MbEqoabGp<8DK^O5e*oD#<LHdl9]gn!@,3NblX;');
define('NONCE_SALT',       '.mBqAD)/YCNrLl!%Vq=K4xKp5LOnwpGEkDDs] ESWNiai#h&&uw8K&CmL~^+>`E+');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
ssss