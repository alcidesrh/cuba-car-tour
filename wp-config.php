<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
//define('DB_NAME', 'cuba-car-tour');
define('DB_NAME', 'db753680406');

/** Tu nombre de usuario de MySQL */
//define('DB_USER', 'root');
define('DB_USER', 'dbo753680406');

/** Tu contraseña de MySQL */
//define('DB_PASSWORD', '');
define('DB_PASSWORD', 'Rooflees.2018');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
//define('DB_HOST', 'localhost');
define('DB_HOST', 'db753680406.db.1and1.com');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'RL~86gEma1G&|<}ybS1#.,izV_`<nID{niY@<B29h?eY)A)QSHha6dSkpj|W: U`');
define('SECURE_AUTH_KEY', '$;vgOvcv e?[KxHU7!Ce=>$#2}oteH+Mg0$R2Cu|<d}t(|pL))ZaE72x:eUtpTxQ');
define('LOGGED_IN_KEY', '98;~b_us5y}tioTD3P<Z<kq9_y0o2-Bc6hC=0X DGQD!(~DFk]|2ke,l.RhGuJ%N');
define('NONCE_KEY', 'wZU]^+:I?9uswX5la0ZW!:#p6`NI?Kf],b56p}D(x)_!LD=-C_rvn6Fyz$*u&>lE');
define('AUTH_SALT', 'zgGp~Q6i~%mv!AKD&Gp1Grv,MPO=$Qa[61V|ah5rcz#v?Rt6 OC>_>?)^%H?PohV');
define('SECURE_AUTH_SALT', '.F!ZDMntsBOv5f_feZ2NFv:j:^v%bt{%qM7IE;|^a>FaU|/(:K^Gbltj|bca?ihX');
define('LOGGED_IN_SALT', 'lymFGXjIyf?%,3|yQUyujq,1FQ?a05LeTo=<|6PA@FQl <L:nAr($?|vgT)L>mnJ');
define('NONCE_SALT', ':^ODXSuLmhWQ nNTY9#}H+]:pl#x^l6eVsb5[(I>0*X+?1-aR-0ii[f:p0M$${o?');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


define( 'SMTP_HOST', 'smtp.1and1.com' );  // A2 Hosting server name. For example, "a2ss10.a2hosting.com"
//define( 'SMTP_AUTH', true );
define( 'SMTP_PORT', '587' );
//define( 'SMTP_SECURE', 'ssl' );
define( 'SMTP_USERNAME', 'info@rooflesscompany.com' );  // Username for SMTP authentication
define( 'SMTP_PASSWORD', 'Roofless@123' );          // Password for SMTP authentication
//define( 'SMTP_FROM',     'user@example.com' );  // SMTP From address
//define( 'SMTP_FROMNAME', 'Kelly Koe' );

