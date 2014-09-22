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
define('DB_NAME', 'romeofm_webfin');

/** MySQL database username */
define('DB_USER', 'romeofm_webfin');

/** MySQL database password */
define('DB_PASSWORD', 'vk7v8mks');

/** MySQL hostname */
define('DB_HOST', 'romeofm.mysql.ukraine.com.ua');

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
define('AUTH_KEY',         'jN-E?BiVMyn,jX[*{+#/g6`jk$?@TkEX60BbXUZpaf)D7;;,-WaQd47D#)xd|mZ!');
define('SECURE_AUTH_KEY',  '&U+^|XkqB1{){k6B)JO!yV:3MLprpFOr9`10FnTN1UX@-U:}`hv:gbxfTZolNk*h');
define('LOGGED_IN_KEY',    '=JPh5fVXq+lu+c&Pe%Y@K$BC2Yu0(wg &wMdId,Q+PO1SVNPS]c/(1&eDyGj(@9+');
define('NONCE_KEY',        'J-2-%?y9iZj47K9G1pZ2:o]19RJDAC/IGJ87&5&(rv%.1,O-g_O2t6Z@{rDzV#6I');
define('AUTH_SALT',        'S[GV/L*A=EyPqaik}=ls!&M_gqmC!uPhsK;W`4S+BKX<>2BS7(}RTc=:>?K!f{Ec');
define('SECURE_AUTH_SALT', '9w>m8>KxDVHebe<svHrcg+r:[p:Nd@6s/mOISx;t,Y_OB?-(u-W}{T m[m&l;>xO');
define('LOGGED_IN_SALT',   'DhpNeD>CB>5fasD+sE9-k`;Ep0q{({K@b0d*aTz|Pw@ojC_`*($=!1GnR=hc?sp#');
define('NONCE_SALT',       '5<{|W;aJ?*vT7?-5Mtnt5N{)79d-O7]];dIvNr-![5>}+d<RtLeHL{Mn$o},hR@Y');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wt_';

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
