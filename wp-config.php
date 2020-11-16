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

define('FS_METHOD', 'direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'marketplace' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'P-tU`pfnDt(V^Zo)_vuwPMLo$/HQHgK}IHYfdF0!2&Y{+U33n1:NhOkL$IPYT=Y)' );
define( 'SECURE_AUTH_KEY',  'pt={rj{q*zXoZ^!-$`zq=Va~^p/N1H*Y9i cFLVd+Cje|Wbb^y2xGexnj?cW>o[i' );
define( 'LOGGED_IN_KEY',    'w@Oza(2k:-WArs6F#D/]le-F+f9xn-fG`1bkFOuj%k/`#+%a>~;F#.F2Sp2uOz_`' );
define( 'NONCE_KEY',        '#1]+ThS%./a>=b6yL4~lLMxDLJtTh.o=Ri39)>Jw&fp_~Vj,5}H jd$C{rI0b%%{' );
define( 'AUTH_SALT',        'y%&Dw_%{%Dr. )a>^RHYF31Uo`,#kZP9>7~3;.[%u*(UX5f1QUTr[_C-/P~TxgKW' );
define( 'SECURE_AUTH_SALT', 'cW6gOAHsY:1fetRV)E(h~<xVU?$RGXQ5T<M&E6C8md]nSE6:xSrVUha6M8A322bo' );
define( 'LOGGED_IN_SALT',   '<32(SVM_Y~wEZeS4)CDw3bPe-Dddk8.%6Q[D_2(GAN6c5A^`|/3,uT#w([GRG9-h' );
define( 'NONCE_SALT',       'o%X.90<3&c1YzR/JE`&qV{Sd5oSEatQKHz}Ef1wn~|Sr(-?SUTDF%G$_I3|<mu-|' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'marketplace_';

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
