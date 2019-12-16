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
define( 'DB_NAME', 'todoticket' );

/** MySQL database username */
define( 'DB_USER', 'userdb' );

/** MySQL database password */
define( 'DB_PASSWORD', '1ax_asdFG' );

/** MySQL hostname */
define( 'DB_HOST', '138.197.102.237' );

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
define( 'AUTH_KEY',         '$<-2,uAna#Qon|zn5 (D@elV<STszv^yY<*PZKRikp<U/E`/.UKt%=(S<z90_v% ' );
define( 'SECURE_AUTH_KEY',  '!NI(v?<e:hZP +]v#mISOIsBkqvCS(NA$y5]c]/8^b^AkZB_xZ]Q9Hu @rlR|:L#' );
define( 'LOGGED_IN_KEY',    '7|yYUb*iKV#OOMoTpX&5+m6eB$LNla&e4#OrOdfUqdgr(q[km}%hNgs]^KC-0=do' );
define( 'NONCE_KEY',        'mVp 859|$uC63D0+6WMrc}h=dbOR|ty!J9~ssJL$_6&I[+)[cvFiHa>QH;#|Vw%c' );
define( 'AUTH_SALT',        'Z}bl0R )i_0-OInvmF=*KZHc;r4A%q#PNvM*V-Vw1EHPeMVRF&MM,e?l;B(OM7:C' );
define( 'SECURE_AUTH_SALT', '2z6S*v~q_SmJ)q;WjxVw~&U]!UE~dUUQ&]ogBy5jt;VXuj(+:|T4%8.r^.J2d8;B' );
define( 'LOGGED_IN_SALT',   'fv{>vlp6S6(X6V=,ALZO@]@%=Xwrj=)-(cPUu}5GueUBO37>SLpo*D;mA&dpLDH7' );
define( 'NONCE_SALT',       'tQ~DsO8O~@0q.y3)g67K+9-hU{|O;L19{n;hI(94H|{%,PjFfS~-$g Z09alvde2' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
