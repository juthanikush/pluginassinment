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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'pluginassignment' );

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
define( 'AUTH_KEY',         'V|<78KPEyXf+/xYFcfxEzh+D,Pa<H1NeZ*^/.X|md3i#y!/vowYlQZ.pVvH]1->M' );
define( 'SECURE_AUTH_KEY',  'g5Q=_[V)LYUTT@GNdt2$@I`G>SnFFLy4)~=t0MPiOg&uu_*E5d3~+CO9xIR:_$Ai' );
define( 'LOGGED_IN_KEY',    '~P>(H+hZ<Kx7oZb?KPRu3)g+9X7n43A&4W[<@p$e#}[<u2wiATmE5d[>Ofuq5MnL' );
define( 'NONCE_KEY',        '5Cf=5TO8b*^:Wk6H^f:{?w+vM`,Ul; Y<nU=}D2Q<Qr?Ad8%A9az5G<PdTLD$##,' );
define( 'AUTH_SALT',        'Dw]*n9~>x^_7nWwB5flB-_au~iKG8#-;R4CV7K1?!]{}6+.$PLGDbTE2t5v,Y,:*' );
define( 'SECURE_AUTH_SALT', '9*z+fs8C`B`>R%6bM )`JAwQ1b:!WuS!4~T}M?{oqt$6g@k,h W1/NX*K*fo(Ey]' );
define( 'LOGGED_IN_SALT',   '-:79_XM/TNP@#Alze5AOc!PEmC3|qp1Rm7Dxf)p=~p!OQ(- S1z2/ >1EKCF_zr0' );
define( 'NONCE_SALT',       'E7>T1+,Y9}<`%Ays_aO`!g6t!MRH(;c<G}TzoAb$FDCn3x;1!r{zUWoI!YY|#g6%' );

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
