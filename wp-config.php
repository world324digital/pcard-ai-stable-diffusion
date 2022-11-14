<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'aicarddev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'Cs6#lQ[1f5Cri~2[$uwD;s[h/0/O$p**Ixx^mIHVcLZDbU)e_aI%=vj9hJ9-Ukg=' );
define( 'SECURE_AUTH_KEY',  ')=GXs[O{#N5g%EpPBS},;E$[`R8`&&iZfV1z9toNZ`Nf)wb``/Y}4(Y^$4AmQ^{k' );
define( 'LOGGED_IN_KEY',    'DKHU?#1:_trMPt&MydATqIu+$S58KUh^J!e:{?n*w=MEt /#9gj{y)9 <Z{j9i-g' );
define( 'NONCE_KEY',        '>wz8J^6/M_-j`%N&I>P]{[4kc(kXbj/?4Q9z/:Xojr)Zre!x5D}:eGz6.,PX5e[U' );
define( 'AUTH_SALT',        '~S%mD8$pS6AIJRv?!_5U]V|&$;u9IbwDDt65X,WhgHo,)h`X(X$W[}>OC``^%iPp' );
define( 'SECURE_AUTH_SALT', '*kma-xALc4C_V4~L::5+_umK9Wk]S:LJ[,pn6JjIuIa3jy ZD]m;o%rqfob0$Ycd' );
define( 'LOGGED_IN_SALT',   '[P26{NVIZ8]fz2|jdfBTf/Gd2[G^B2Y7IlLw2&7*a8 MZq/DRVG|{igvv(/{{:Na' );
define( 'NONCE_SALT',       'mFn@7<6t#X:IUo: zC;uQRG?p=8k ouw?IM@[_pL~2mLd@ApX`Ivd.S =G3bO@.~' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
