<?php
/**
 *****************************
 * For test.sdss.org DR13
 *****************************
 *
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
**/

// Possible values for subdomains and folders. 
$subdomains = array( 'blog' , 'voyages' , 'test.voyages' , 'testng' , 'test' , 'www' , 'sdss' );
$subfolders = array( 'press-releases' , 'dr12' );

$url = $_SERVER['HTTP_HOST'];
$getsubdomain = array_shift( explode( "." , $_SERVER[ 'HTTP_HOST' ] ) );
$getfolder = array_shift( explode("/" , trim( $_SERVER['REQUEST_URI'] , "/" )));

define( 'USEBACKUP' , false );

/** Which WordPress database? */
$database_name = 'sdsswp';
//Add subdomain or folder
if ( stripos( $url , 'voyages' ) !== false ) {
	
	$database_name .= '_voyages';
	
} elseif ( strcasecmp( 'blog' , $getsubdomain ) === 0 ) {
	
	$database_name .= '_blog';
	
}  elseif ( strcasecmp( 'press-releases' , $getfolder ) ===  0 ) {
	
	$database_name .= '_press';
	define( 'LATEST' , true );
	define( 'DATA_RELEASE' , 'Data&nbsp;Release&nbsp;13' );
	
} elseif ( strcasecmp( 'dr12' , $getfolder ) ===  0) {
	
	$database_name .= '_dr12';
	define( 'DATA_RELEASE' , 'Data&nbsp;Release&nbsp;12' );
	
} elseif ( strcasecmp( 'testng' , $getsubdomain ) ===  0) {
	
	$database_name .= '_dr14';
	
	define( 'DATA_RELEASE' , 'Data&nbsp;Release&nbsp;14' );
	
} elseif ( ( strcasecmp( 'www' , $getsubdomain ) === 0 ) || 
			( strcasecmp( 'sdss' , $getsubdomain ) === 0 ) || 
			( strcasecmp( 'test' , $getsubdomain ) === 0 ) ) {

		// This is the latest data release
		define( 'LATEST' , true );
		define( 'DATA_RELEASE' , 'Data&nbsp;Release&nbsp;13' );
		
		//Use the production DB (www.sdss.org)
		$database_name .= '_dr13';

} else {

	die("Domain unknown: ".$_SERVER['HTTP_HOST']);

}

if ( in_array( $getsubdomain , array( 'test' , 'testng' ) ) )  {

	$database_name .= "_test";
	define('WP_DEBUG', true);
	define('WP_ENV', 'development');
	define('FS_METHOD','direct');

} else {

	define('WP_DEBUG', false);
	define('WP_ENV', 'production');

}
		
if ( USEBACKUP ) {
	$database_name .= "_bak";
}

// Connection details
define('DB_NAME', $database_name);
define('DB_USER', 'sdsswp');
define('DB_PASSWORD', 'BTNjnFO2JXQzgj4DsrnBewR85cb');
define('DB_HOST', 'dsa008');

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
define('AUTH_KEY',         '}S6k%mt1o~?`b@>~fA&|Mv4l:v@/>)_(W.;z}gQO%U0:OjM}lA~CPJ+ZON27qJaf');
define('SECURE_AUTH_KEY',  'wKb h&]]7@|ravGDZ{%K/,d_l#jR|Wi@eQ.Z$zRym;,wUh~U< ^x+n?};<NX9B&)');
define('LOGGED_IN_KEY',    'mzCG~D[(2|&]{+kHQAX2:kmJAHpVyS|Iia03Qmll1-~9}D;|-s|(/n4k$e0:}fYZ');
define('NONCE_KEY',        'MJ5]hr$LdCvW-eiKbf$+,YK8#WRaN?Bs(H3p8(xb3cW?j|GZVOC$x*w>!q!a4lZS');
define('AUTH_SALT',        '2A5YGQKw{`LxTdW)<~|:{40QijS&xcjCQ8A4iU4[$P#_|n3JZ$+lVfBVn h+jz@G');
define('SECURE_AUTH_SALT', 'te.c-R<iz3;D3sW;R;(dgAl+:48L,mIjNncz+Xsw6-!)n>eFbPy}Z$XD-4lYf%!+');
define('LOGGED_IN_SALT',   'I7}X&r!#|`?<Z3ki+|&JRTgRGTY8d>7D75VE]z9H$-+FD#(ULDM:~%Wku4pI4s0|');
define('NONCE_SALT',       '0$Xx,+BYQAe|(US5b.J`NA7t:vYpN!)Qee|ehST:d#]XsDBs=e)$q rJ M{Pql@7');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
