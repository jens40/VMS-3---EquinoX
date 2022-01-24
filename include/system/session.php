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
* Datei: include/system/session.php
*******************************************************************************/
@session_start();
$login = Request::post('login');
$username = Request::post('username');
$passwort = Request::post('passwort');
$login_laenge = Request::post('login_laenge');
$logout = Request::get('logout');
/* User einloggen */

if ($login == 'Einloggen' && $username && $passwort && $_SESSION['login'] != "true") {

$row = $db->first("SELECT `salt` FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".$username."'");
$entered_pass = hash('sha512', $passwort . $row->salt);
$logindaten = "SELECT `uid`,`nickname`,`passwort`,`status`,`admin` FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".$username."' AND passwort = '".$entered_pass."'";

	if (!$db->numrows($db->query($logindaten))) {
	Filter::$msgs['error'] = 'Benutzername / Passwort nicht gefunden!';
	} else {
	$logindaten = $db->first($logindaten,$type = true);

		/* Wenn User noch nicht aktiviert ist */
		if ($logindaten['status'] == 0) {
		Filter::$msgs['error'] = 'User noch nicht aktiviert ist';
		}

		/* Wenn alle Daten stimmen */
		if ($logindaten['status'] == 1) {
		$_SESSION['uid']		= $logindaten['uid'];
		$_SESSION['nickname']	= $logindaten['nickname'];
		$_SESSION['passwort']	= $logindaten['passwort'];
		$_SESSION['login']		= "true";
			/* Cookies setzen */
			if ($login_laenge >= 1) {
			$cookiedaten = array($logindaten['uid'],$logindaten['nickname'],$logindaten['passwort']);
			$cookiedaten = implode("||",$cookiedaten);
			setCookie('vms3',$cookiedaten,time()+(60*60*$login_laenge));
			if ($logindaten['admin'] == '1') setCookie('vms3_admin','true',time()+(3600*24*360));
			}
		header("location:".$mainconfig['seitenurl']);
		die();
		}

		/* Wenn User gesperrt wurde */
		if ($logindaten['status'] == 2) {
		Filter::$msgs['error'] = 'User gesperrt wurde';
		}

	}
}

/* User ausloggen */
if ($logout == "true") {
session_destroy();
setCookie('vms3',"",0);
setCookie('vms3_admin',"",0);
header("location:".$mainconfig['seitenurl']);
die();
}

/* Cookiedaten in Session übertragen */
if (!empty($_COOKIE['vms3']) && !empty($_SESSION['login']) && $_SESSION['login'] != 'true'){
$cookiedaten = array();
$cookiedaten = explode("||",$_COOKIE['vms3']);
	foreach ($cookiedaten as $cookiedaten_output) {
	$zaehler ++;
	$cookieinhalt[$zaehler] = $cookiedaten_output;
	}
$_SESSION['uid']		= $cookieinhalt[1];
$_SESSION['nickname']	= $cookieinhalt[2];
$_SESSION['passwort']	= $cookieinhalt[3];
$_SESSION['login']		= "true";
}

/* Userstatus prüfen */
if (!empty($_SESSION['login']) && $_SESSION['login'] == 'true') {
$usercheck = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE uid = '".sanitize($_SESSION['uid'])."' AND nickname = '".sanitize($_SESSION['nickname'])."' AND passwort = '".sanitize($_SESSION['passwort'])."' AND status = '1'");
	if (!$db->numrows($usercheck)) {
	session_destroy();
	setCookie('vms3',"",0);
	setCookie('vms3_admin',"",0);
	header("location:".$mainconfig['seitenurl']);
	die();
	} else {
	$userdaten = $db->fetch($usercheck);
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET aktivzeit = '".time()."' WHERE uid = '".sanitize($_SESSION['uid'])."'");
	}
}

/* Funktion um Seiten zu sperren wenn User nicht eingeloggt ist */
function access () {
global $_SESSION,$pageconfig,$parsestart,$mainconfig;
	if ($_SESSION['login'] != 'true') {
	header("location:".$mainconfig['seitenurl']);
	die();
	}
}


?>