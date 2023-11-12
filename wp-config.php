<?php
define( 'WP_CACHE', true );
/**
 * A WordPress fő konfigurációs állománya
 *
 * Ebben a fájlban a következő beállításokat lehet megtenni: MySQL beállítások
 * tábla előtagok, titkos kulcsok, a WordPress nyelve, és ABSPATH.
 * További információ a fájl lehetséges opcióiról angolul itt található:
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 *  A MySQL beállításokat a szolgáltatónktól kell kérni.
 *
 * Ebből a fájlból készül el a telepítési folyamat közben a wp-config.php
 * állomány. Nem kötelező a webes telepítés használata, elegendő átnevezni
 * "wp-config.php" névre, és kitölteni az értékeket.
 *
 * @package WordPress
 */

// ** MySQL beállítások - Ezeket a szolgálatótól lehet beszerezni ** //
/** Adatbázis neve */
define( 'DB_NAME', 'martintr_keretalkotocsoport_hu' );

/** MySQL felhasználónév */
define( 'DB_USER', 'martintr_keretalkotocsoport_hu' );

/** MySQL jelszó. */
define( 'DB_PASSWORD', '&3+e&(hZTTTs#vC#80' );

/** MySQL  kiszolgáló neve */
define( 'DB_HOST', 'localhost' );

/** Az adatbázis karakter kódolása */
define( 'DB_CHARSET', 'utf8mb4' );

/** Az adatbázis egybevetése */
define('DB_COLLATE', '');

/**#@+
 * Bejelentkezést tikosító kulcsok
 *
 * Változtassuk meg a lenti konstansok értékét egy-egy tetszóleges mondatra.
 * Generálhatunk is ilyen kulcsokat a {@link http://api.wordpress.org/secret-key/1.1/ WordPress.org titkos kulcs szolgáltatásával}
 * Ezeknek a kulcsoknak a módosításával bármikor kiléptethető az összes bejelentkezett felhasználó az oldalról.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', '4P|m<~34T{.ZvfhcI0P0ns=xp<oTE:F;^Bdp(z-bxOoP> 7xhQnGa8Eev@8RZO8h' );
define( 'SECURE_AUTH_KEY', '|!x]| ;L)~js?VDjzu[<UA*g7.2[tmU.+Q=%4HNNdYn#2)(8,zD+jl.{*TIBT`=D' );
define( 'LOGGED_IN_KEY', 'LXw} 1bV,n1?ywksF7qqsD2zP>utqyHQawV,:>nNYHFk/V2L2ixK`3RQF i7S_$~' );
define( 'NONCE_KEY', 'jFJU}%>P`runBP:I}|[K)`TrJyRo|FD;mgn[)E(_GaE8ic:3!<{+@B.s!*V4wNq|' );
define( 'AUTH_SALT',        's x/$FwDmTv}?YOL_r vPTN-F;YAehpz@Sr{tzS@bJI4?mdO!n;+@G.4BuU*q55t' );
define( 'SECURE_AUTH_SALT', 'SPK|3T>@6S6$$p?BSkL|N`VM[eVPS>nY7mpf (084JO8l=`6NtJm?Kv@5cLDI<gi' );
define( 'LOGGED_IN_SALT',   'Mry<v$DdK=}N-{uR9~KX;&P?TdC/,L `xs!89r7qme+OpVoXI>Hj]O_?-YV_RG :' );
define( 'NONCE_SALT',       'jW9,4E6^DV p&{<bi05^Kq>|OWB09#]d9SprPnWS#6c>hbID)!nI7mFD7?K36Cm|' );

/**#@-*/

/**
 * WordPress-adatbázis tábla előtag.
 *
 * Több blogot is telepíthetünk egy adatbázisba, ha valamennyinek egyedi
 * előtagot adunk. Csak számokat, betűket és alulvonásokat adhatunk meg.
 */
$table_prefix = 'wp_';

/**
 * Fejlesztőknek: WordPress hibakereső mód.
 *
 * Engedélyezzük ezt a megjegyzések megjelenítéséhez a fejlesztés során.
 * Erősen ajánlott, hogy a bővítmény- és sablonfejlesztők használják a WP_DEBUG
 * konstansot.
 */
define('WP_DEBUG', false);

/* Ennyi volt, kellemes blogolást! */

/** A WordPress könyvtár abszolút elérési útja. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Betöltjük a WordPress változókat és szükséges fájlokat. */
require_once(ABSPATH . 'wp-settings.php');
