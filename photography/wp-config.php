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
define('DB_NAME', 'anniepen_wor2');

/** MySQL database username */
define('DB_USER', 'anniepen_wor2');

/** MySQL database password */
define('DB_PASSWORD', '2z4GWpth');

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
define('AUTH_KEY',         'sLcx}}B)Q+Fp+dI((_3OSeU5~:Zz)<$+Au1dVvX4%/hUj,7@!ll}NsF$AWi^vsoH');
define('SECURE_AUTH_KEY',  'kqTp QmUPKhyhsF4),uS8Dx%N28>`B|6O.-$TvBP~OU3qv<7k<e_}[wa72+G$#,+');
define('LOGGED_IN_KEY',    'PeZ1aAe[2A#KI!}Prm~Vx~NH: xdVf-1(wR K@*J4. 7#n5Xp9b-s)VOQPdSu/y=');
define('NONCE_KEY',        'F5NVe(Ha;adJklv.C}HRiik)mWztAy-n18^ZnM^5BYY&^|7~Ix?sN=r:*w[KSiF{');
define('AUTH_SALT',        '9IH#-^mYjys+fTJSe-:X]PJm<zdSm$=tY~ZmYe-lVW{KIjS~o^-#A mLpeVl!BzJ');
define('SECURE_AUTH_SALT', 'sB>.X$L7p0^Mlx7=8H!+O=<T0dNnN3ay]kX_bQ*b-7%r[pK?Og0z{:z:PiZvsis?');
define('LOGGED_IN_SALT',   '1 >Qmx![~PUG@fA^IK>1>PpF!SV%o2q4+%>V+_lAzuED[in7ce%Ck{<U<G8<=6[B');
define('NONCE_SALT',       'EI=skNoksTQSc!>g1-E*]8{dqqwtfjzjm.{tKbv-K-]4+h.7>eD}B.qe~0qa+%Zq');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'dgh_';

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
