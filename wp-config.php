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
define('DB_NAME', 'wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '(8]r0hvjpHG]p6D#, 9s .N3>0y]=xLU%*l2LC]rKAf#m6?Wo{C43,K(]]i;7PQG');
define('SECURE_AUTH_KEY',  '+>[rK GZ;jzrtrP!es|bT4F*  ZNIHzKfd:y-9MaCH%!j4$YsS|uPaka|EKjpwNy');
define('LOGGED_IN_KEY',    'd!,j8FivYF`7zZ;f^z{8fp1xXsF1yB$s1Go|ZlkC T^9wdod&kWn#;FTs_Z>d^6T');
define('NONCE_KEY',        'Fm.%zyA%Q]4A@7o3Y=(8H@J.s6uCgqLkAvo?q;A@2t3BP:/h_Rb<}Qt9Hfu&A*[q');
define('AUTH_SALT',        '!3-EexXEn`xgZBTFY`aZ]o%o R`~v~8.NO_ixq@>$<XUfJ(sGpB>H>DtPEaEWGN)');
define('SECURE_AUTH_SALT', '!kQTEl^qN{ko5:6:bu4ZDQN7|g4=i^gj1gJYV3%CbP:WF*NLw6jq;qGD%9,G,3WS');
define('LOGGED_IN_SALT',   '>0hq-6`j?h?lMVYZ[F/#NM?a&$P5e(R$O$qE Z5$%q u[z&;8{W/$kfX[Y38UF9<');
define('NONCE_SALT',       '0f}R!&yx@By1{gqZzL2y/%4scG o_HuA#`-@ &oZ;3,jTBr$%:3hY2$hw?#Rc)*.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
