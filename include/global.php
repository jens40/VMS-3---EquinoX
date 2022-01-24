<?php
/*******************************************************************************
* VMS 3 - EquinoX²
********************************************************************************
* Copyright (c) 2018
* Webseite      http://www.com-dat.de
* Support       http://www.com-dat.de
* Lizenz        http://www.com-dat.de/equinox.php
* Lizenzart     Einzelplatzlizenz (E-Lizenz [EL] / EP-Lizenz [EPL])
********************************************************************************
* VMS 3 - EquinoX² ist keine Freeware
* Alle Rechte liegen bei:
* Jens Baum
* Bertolt-Brecht_Str.16
* D-03226 Vetschau
* E-Mail: info@com-dat.de
********************************************************************************
* Datei: global.php
*******************************************************************************/
define("ROOTPATH", dirname(__DIR__) . "/");
/* Nur einfache Laufzeitfehler melden */
error_reporting(-1);
$app = '';
/* Wartungsmodus prüfen */
if (file_exists('wartung.php') && $app != 'admin.php') {
	$wartung_msg = 'true';
	if ($_COOKIE['vms3_admin'] != 'true') {
	header ("location:wartung.php");
	die();
	}
}
 require_once './include/system/smarty/Smarty.class.php';
 $smarty = new Smarty; 
 $smarty->compile_dir = 'cache/';
 $smarty->template_dir = 'themes/default/'; 
 $smarty->plugins_dir = array(
                       './include/system/smarty/plugins',
                       './plugins/'
                       );
 $smarty->force_compile = true;
 $smarty->left_delimiter = '<%';
 $smarty->right_delimiter = '%>';
 
require_once './include/system/request.class.php';
require_once './include/system/filter.class.php';
$request = new Filter();
/* Setzen der Parse-Startzeit */
$parsestart = microtime();

/* Einlesen der PHP-Version */
$phpversion = phpversion();

/* Einlesen des Referers */
if(isset($_POST['referer'])) {
  $referer = trim($_POST['referer']);
} elseif (isset($_SERVER['HTTP_REFERER'])) {
  $referer = parse_url($_SERVER['HTTP_REFERER']);
} else {
  $referer = "";
}

/* Laden der Konfiguration */
require('include/system/config.php');

/* Prüfen ob Client gzip unterstützt */
function check_obstart() {
	ob_start();	
}

/* Laden der Funktionen */
require('include/system/functions.php');

/* Laden der Kampagnenfunktionen */
require('include/system/kampagnen.php');

/* Funktionsaufruf zum sichern alles Variabeln */
if (isset($app) != 'admin.php') {
if (count($_REQUEST)) $_REQUEST = save_array($_REQUEST);
if (count($_POST)) $_POST = save_array($_POST);
if (count($_GET)) $_GET = save_array($_GET);
if (count($_COOKIE)) $_COOKIE = save_array($_COOKIE);
if (count($_SERVER)) $_SERVER = save_array($_SERVER);
if (!empty($_SESSION)) $_SESSION = save_array($_SESSION);
}

/* Sichern des Werbers */
if (!empty($_GET['werber'])) $_GET['werber'] = $_GET['werber'];
if (!empty($_GET['werber']) AND !$_COOKIE['werber']) setcookie ("werber", $_GET['werber'], time()+(3600*24*365));

/* Verbindung zu Datenbank aufbauen */
require('include/system/class_datenbank.php');
$db = new db($pageconfig);

/* Kampagnen pausieren wenn verbraucht */
//$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET status = '2' WHERE do_views >= in_views AND do_clicks >= in_clicks");

/* Konfiguration laden */
$mainconfig = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_config WHERE config_id = '".$pageconfig['install_nr']."'"));
foreach ($mainconfig AS $key=>$value) {
  $smarty->assign($key,$value);
}
/* Laden der session.php */
if ($app != 'admin.php') require('include/system/session.php');

  function sanitize($string, $trim = false, $int = false, $str = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array(
          '‘',
          '’',
          '“',
          '”'), array(
          "'",
          "'",
          '"',
          '"'), $string);

      if ($trim)
          $string = substr($string, 0, $trim);
      if ($int)
          $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
          $string = preg_replace("/[^a-zA-Z\s]/", "", $string);

      return $string;
  }

?>
