<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil innehåller följande konfigurationer: Inställningar för MySQL,
 * Tabellprefix, Säkerhetsnycklar, WordPress-språk, och ABSPATH.
 * Mer information på {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter får du från ditt webbhotell.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i värdena.
 *
 * @package WordPress
 */

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'albashowchorus_');

/** MySQL-databasens användarnamn */
define('DB_USER', 'albashowchorus_');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', 'SGtSiugx');

/** MySQL-server */
define('DB_HOST', 'albashowchorus.se.mysql');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         'ua}FAKS=?*4p?c:,BVdXeL-#h$0S[=IN}FL#8w:|FE0cVOBIsT7*^BsJ9mi:~*.-');
define('SECURE_AUTH_KEY',  '>6I_^vI,THBD>DuUJI;:S@I-Fat]gI?f,cZ!NeL`j%hr+C8%jfvkTogAO|4B3-DP');
define('LOGGED_IN_KEY',    's#LxW&FJ4o@N+6b55%-@:@^KThL0y=;/q@zxT$yKBSSYkM?8 mRVo~f3n8ne+%)~');
define('NONCE_KEY',        'z jK%Q)qokY{be4W3||-AwPpc1V{NnPHO$XD!M|v<o!-#=^ci3z-S7}9+xc1PNH_');
define('AUTH_SALT',        '-g ?*hr6]+PhNcUr%ek6Oh7 fE/=vDFw;&(xJf+-*a+X=!`6>ZpQJv|_OXY,FGh_');
define('SECURE_AUTH_SALT', '&hNFa,WGd9$*gh4.bRa9Y.n}>8B,UK-nK:f)YZS9W|>nH rj~}Er<5z++oa]S+u=');
define('LOGGED_IN_SALT',   'R:Vbzr0+:eVDRDo |>iEPMe4zhWCIwg8+;2XJ}i=QaWh6( ==$j`%-9reJNMzd`K');
define('NONCE_SALT',       'd$]NjVkTDu6g%<BydS:Kh:S=H7J#uB~M>qYo=+X5sjdEiR(bCn+7r?:r+`M)+Cx6');

/**#@-*/

/**
 * Tabellprefix för WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-språk, förinställt för svenska.
 *
 * Du kan ändra detta för att ändra språk för WordPress.  En motsvarande .mo-fil
 * för det valda språket måste finnas i wp-content/languages. Exempel, lägg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' för att få sidan
 * på svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det är rekommderat att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera här! Blogga på. */

/** Absoluta sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');