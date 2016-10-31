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
define('DB_NAME', 'wp_woo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'm@BCxXK-+khq~D=oQK|FvJ315;)END@c9_2dA]G&Z@Kd,T <_K.w!(B- ]q]3)]+');
define('SECURE_AUTH_KEY',  'aBK}>:||n(VeB#4| SPsYibi:.g-DcMoV!bDsle~i#=&AgpS3WXTW#J4 9JgF$P?');
define('LOGGED_IN_KEY',    '?Us07b1gYp-,|EPcY~c*:/h3%li|`@%_Es;otUlxC^OBvaY1J1f%<4Ei x:_:FUT');
define('NONCE_KEY',        '7SZvfbh%Wo,=IBZJ9e?vo}5EV}[_!HP,^76<{@N2vL*!0js6KH+Ro{X2%Wk0H1mK');
define('AUTH_SALT',        'R[<Mz N1<0z7lyOfm:t]il7%x2sK^3u[M*#,6Czo!Z!8/FQd)skVWZPA|?S{Y3)S');
define('SECURE_AUTH_SALT', '=/Np7kit]Ga,zp&/TkE,yu`AQ/S4A~]>fl4]vK zowZJ}ee160$F6:}#-S.w-l;0');
define('LOGGED_IN_SALT',   'N<Z]R1T&N*@703[7Z/mj=T7~pggH/^3Aq^yx(x5;.|.ssJ71]Wa8%apC4MG@U!U1');
define('NONCE_SALT',       '(x1u@@ylFro!)Wd4O7:MEDL~(~qY}GJ;G=%~}Obui=h9;_9~A+ohv>$?/Nb%7w`:');

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
