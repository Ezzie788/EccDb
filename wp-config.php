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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define('FS_METHOD','direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'EoKwek' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ZhdD2CxpjWs6FvA2' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^_=h-N&6_|Tb@N,F}&Eg<iW^vQf2sg`&g?=+K9U7t=2J^~W(C6r+E]T#@}=i+l}B' );
define( 'SECURE_AUTH_KEY',  'lnCvyP<M,$?l^c*=^{8BoRW:Lq>ke/!sBFJ[xopLL?#hzG#EB52 S@$LZRK[qhlf' );
define( 'LOGGED_IN_KEY',    '[sq-3r>7mJqr8wMogW>[v;mrvUoW0~7.u8p_l*4=&Vl.= W9V F+ki>PnJ-2cn|P' );
define( 'NONCE_KEY',        'Q|,[*ru;r94E7NCttn~iV_yKm:~1F3L#t@%cO/+/v:`;7xZUf{H#v&JJ>.NN8!Eb' );
define( 'AUTH_SALT',        '_xO/gYGnG/Y0,laYTyh`4._hf+7fxP~jR%3lHljJj;j1Jf+ {}Af.h_&:6/sJ8g1' );
define( 'SECURE_AUTH_SALT', 'H%%thDBLsx/HQ(@o[:/5*(*)(+tU.+T#56{}R;~MCHsFH[8r:WFmDR+KEBL*u1L4' );
define( 'LOGGED_IN_SALT',   '$;#^j2A}&H+&d3v0p1hk&!95`9&?=c]V]^(//(W9XEfRt*mPe|Fgem-):S3@8*EE' );
define( 'NONCE_SALT',       '<d&?4t]JG~Aom3tq.&JL>z2W.,Ob:`ZoAd,|pNpEs2k:Dn,{//S2;jjC5_h3IQIb' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
