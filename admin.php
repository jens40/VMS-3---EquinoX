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
* Datei: admin.php
*******************************************************************************/
define("_VALID_PHP", true);
$app = 'admin.php';

/* Starten einer neuen Session*/
@session_start();

/* Adminvariabel setzen */
if (!empty($_SESSION['adminsession']) && $_SESSION['adminsession'] == 'true') $app = 'admin.php';

/* Laden der globalen Funktionen */
require('./include/global.php');
$adminlogin = Request::post('adminlogin');
$a_login = Request::post('a_login');
$a_passwort = Request::post('a_passwort');
/* Seite über den internen Puffer senden */
check_obstart();
/* Admin einloggen */
if (empty($_SESSION['adminsession']) && $_SESSION['adminsession'] != 'true' && $adminlogin) {
	
    $admincheck = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($a_login)."' LIMIT 1"));
	$a_passwortnew = hash('sha512', $a_passwort . $admincheck['salt']);
    if ($a_login == $admincheck['nickname'] AND $a_passwortnew == $admincheck['passwort'] AND $admincheck['admin'] == '1') {
	$_SESSION['adminsession'] = 'true';
	$_SESSION['adminlogin'] = $admincheck['nickname'];
	$_SESSION['adminpass'] = $a_passwortnew;
	} else {
	Filter::$msgs['error'] = "Login / Passwort nicht korrekt!";
    Filter::msgStatus();
    }
}
$smarty->assign('phpversion',$phpversion);
$smarty->assign('parsetime',parsetime($parsestart));
/* Adminsession prüfen */
if (!empty($_SESSION['adminsession']) && $_SESSION['adminsession'] == 'true') {/* Laden des Contents */
require_once('include/admin/'.Filter::$admincontent.'.php');
} else {
require ('include/admin/login.php');
}

/* Diesen Code nicht ändern oder löschen */
/*    Don't remove or edit this Code     */
dsn_copyright($mainconfig['lizenzkey']);
/* ------------------------------------- */
ob_end_flush();
?>

