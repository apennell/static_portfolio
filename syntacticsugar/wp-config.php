<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'anniepen_wordpressd79');

/** MySQL database username */
define('DB_USER', 'anniepen_wordd79');

/** MySQL database password */
define('DB_PASSWORD', 'Pq5PFf1cwQph');

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
define('AUTH_KEY', 'M-jz*OM_X$s(R;Jb/XbBvxhX?RwEuAVcBtZf$]d;ZHd}_[mCl/>[U|wrmPwzsP&VH}e^LO+C=HA]>!XBIgk@eRjJV+?[JUpnIucYeEjiS}K*h!%Mq;h?rUzl;qAJhlQ&');
define('SECURE_AUTH_KEY', 'Pp;BJj]wA<wj/$I//v]}MesYzREBph_uqy%TTmRU[)huQtOzgxG%Y/zQBwf/FJoG[dd<HSdUq=!$Fgo]r&ZmX?-PZ}?U![z/%K*GJK(qeDVBvSQQ%_cRK}tbgA}coRbk');
define('LOGGED_IN_KEY', 'A;S?=EYyqS+*u){QVBnuIWskowmSGL)+%[pNvS$GjAOX_bmp=W{v/ds-mZF)cAs$RoD-kSYLN_Yv}s{_/kx(zJ!^!TBal]%zfwUm;{|L>OTa>?sghHWbvh;ZH*AarJEG');
define('NONCE_KEY', 'A;H^N^R&&%Vz*&f*lWX*NRr-MeoXybgo!am|_K^[*tB>OhKn|ahxOzdAh(;eXgjZtyW(AgfSL]-OoFrw&LeeNeJD-WK!]K;+cNyZtiPszq_;DlIeBeGu|gk(SjP+_q+I');
define('AUTH_SALT', 'e+$yvR[<vVj$(*ElcU;Ml{]PhKAGjO[sJ/MUr/siSQpc+WL)$%uf+-=Vf?d*?biGacEls-*X%@u+WB*KUA_oo}JZz@T*kNQsYOS?tV!L@Z=mgujY{NWiSiu^Df}n/hd%');
define('SECURE_AUTH_SALT', '^wm%ZJMqV_Ea&(;wslJ}TmWB@e=<>jR$g_{KqwN$ynL}^/>v]RKX?@RL+qplfpqOnQpbH$ro{k*lvC(_GFOsh@naQMF!f(pylx!or{yr<w==NC/!rgsF=>qPu*ULXa?E');
define('LOGGED_IN_SALT', 'f^eEf&|GOLqjSIUu}RO[Uq]GN(d;_dKuBh)=jT@CoLxKYM^<Fr?rhujv^x!rHL++bjo!_Lhd_pxO!!QBMCk=$?$GVhRj)T/ZRdatPV*P@?NBqkt/n|z%ShtT@_[iCREi');
define('NONCE_SALT', 'G!)^$Izb@*-@w^()R;cqN<%ZGm!EHoOzFOc+f>eZz}!+G?qiYsj$dkCxD!b[iZ-o[x%L%+Eh?TA;u)=Xe|oo*vk-BSoLoGt>d_H+mb)YYzb!s@WOmA$JFB-kaE*$>Cs^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_mnmq_';

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

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
