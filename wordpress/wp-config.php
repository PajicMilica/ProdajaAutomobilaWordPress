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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpresssajt' );

/** MySQL database username */
define( 'DB_USER', 'admin3' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wordpressdomaci' );

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
define( 'AUTH_KEY',         'n*Eo8Y{ZtJGK71:h*pV-tD(!-(bT=j$d3bQ)|^7{9c)wdpCKqf!(qtJd<H]D~f=@' );
define( 'SECURE_AUTH_KEY',  'c>k)w]ENQJ|l80Bo]$IU]~@.T^^,h0{uwj+WVr,X?4YX]{5VQaeA`;>B,%m tT>>' );
define( 'LOGGED_IN_KEY',    'ts)8=xICAoSHqG_[{<B`cbXRYuq|{A02ni2g7z=H=v.`;S|{}!IE7dpH}k_P9A[1' );
define( 'NONCE_KEY',        '%=:`_?DSAQdtS=aPEzb6&C#Ke*aGzx+zGamO=7_g:^|O-R4= ?=[>`Zu{#DsOvDV' );
define( 'AUTH_SALT',        'uSPILg6{WN6%BC8MYQIB{2fei4f<[R|%BMo8W<^+HOPG } 3Z=y,:fUO!N3Z0Z%u' );
define( 'SECURE_AUTH_SALT', 'IoSZB?AS8,qci8]UImvQ;h.|S/VOE9LGwYwFcN*~+w|DnD4xjg@Zwq3@I;MDJ2bL' );
define( 'LOGGED_IN_SALT',   '>0-Xay}iuBZPXK)oY@;F1OUTcei7;J!G3%Nq.KjvB,J.v6)kYu|>!rYu86J)_A8~' );
define( 'NONCE_SALT',       'EY[nttOU(i]ACA4}0xt0%2y|*I:7Ok[~Ei]3cOwyk%p@ Xm6_err%-t&7Z/}O)6`' );

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
