<?php
/**
 * Baskonfiguration f�r WordPress.
 *
 * Denna fil inneh�ller f�ljande konfigurationer: Inst�llningar f�r MySQL,
 * Tabellprefix, S�kerhetsnycklar, WordPress-spr�k, och ABSPATH.
 * Mer information p� {@link http://codex.wordpress.org/Editing_wp-config.php 
 * Editing wp-config.php}. MySQL-uppgifter f�r du fr�n ditt webbhotell.
 *
 * Denna fil anv�nds av wp-config.php-genereringsskript under installationen.
 * Du beh�ver inte anv�nda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i v�rdena.
 *
 * @package WordPress
 */

// ** MySQL-inst�llningar - MySQL-uppgifter f�r du fr�n ditt webbhotell ** //
/** Namnet p� databasen du vill anv�nda f�r WordPress */
define('DB_NAME', 'albashowchorus_');

/** MySQL-databasens anv�ndarnamn */
define('DB_USER', 'albashowchorus_');

/** MySQL-databasens l�senord */
define('DB_PASSWORD', 'SGtSiugx');

/** MySQL-server */
define('DB_HOST', 'albashowchorus.se.mysql');

/** Teckenkodning f�r tabellerna i databasen. */
define('DB_CHARSET', 'utf8');

/** Kollationeringstyp f�r databasen. �ndra inte om du �r os�ker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * �ndra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan n�r som helst �ndra dessa nycklar f�r att g�ra aktiva cookies obrukbara, vilket tvingar alla anv�ndare att logga in p� nytt.
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
 * Tabellprefix f�r WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokst�ver och understreck!
 */
$table_prefix  = 'wp_';

/**
 * WordPress-spr�k, f�rinst�llt f�r svenska.
 *
 * Du kan �ndra detta f�r att �ndra spr�k f�r WordPress.  En motsvarande .mo-fil
 * f�r det valda spr�ket m�ste finnas i wp-content/languages. Exempel, l�gg till
 * sv_SE.mo i wp-content/languages och ange WPLANG till 'sv_SE' f�r att f� sidan
 * p� svenska.
 */
define('WPLANG', 'sv_SE');

/** 
 * F�r utvecklare: WordPress fels�kningsl�ge. 
 * 
 * �ndra detta till true f�r att aktivera meddelanden under utveckling. 
 * Det �r rekommderat att man som till�ggsskapare och temaskapare anv�nder WP_DEBUG 
 * i sin utvecklingsmilj�. 
 */ 
define('WP_DEBUG', false);

/* Det var allt, sluta redigera h�r! Blogga p�. */

/** Absoluta s�kv�g till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-v�rden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');