<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^9Bw-J%YYp=L/uiI2,.`(GR*2u2,j`yG7!%SH(ML:Rem,>Y{4DQ}#ti607uD.FM=' );
define( 'SECURE_AUTH_KEY',  'A_Y|qw.B:mggzn(?CHLBB3fEG+,_lsbG8j{(;(m,f!3irl)-TgNe<z0USy6w3&;^' );
define( 'LOGGED_IN_KEY',    '`W9zPG_&O5`1<baXzPa_!z9evW`69Ve=4%nJ7Qxl.{>vvv[-<lXlNb%%fqGp_EK?' );
define( 'NONCE_KEY',        '>&;NRbNl1^g~Sg-u-vTU0B_k#(#@i3s3[[~z7TwAGa|ThK]6%!,7*F22>tJY`y4r' );
define( 'AUTH_SALT',        'kU&qN;,%t=xZBwGVKiu@^EqNq0~5iS+/YtAv!0ZHTn{T!$a< GnoYzp6$0O:%|T9' );
define( 'SECURE_AUTH_SALT', 'j}xe<_k#C#MHVZ]cFt1rnN,ihl9=.vTa[u~nZgsFn|E!<u[[g+-B,*P-c4zDOfc1' );
define( 'LOGGED_IN_SALT',   'nJUs1QYRJ(:/AA:SI ^,MBI(?z$4J:oHZMn8159#)~Kf6)kj{~O7P#a10x:bJfo~' );
define( 'NONCE_SALT',       'BCBJ55VD41{,K$366OQIJ8tFeXyv%[#q|NXa7|WV9-7@(H@U+6,=ewhuzF92Qmg#' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
