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
* Datei: goto.php
*******************************************************************************/
define("_VALID_PHP", true);
/* Laden der globalen Funktionen */
require('./include/global.php');
/* Seite über den internen Puffer senden */
check_obstart();

/* Top-Frameset für Paid4 */
function checkframe($msg,$warten) {
global $mainconfig, $kampagne_output;
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
<style type="text/css">
body {
margin-top:0;
margin-bottom:0;
margin-left:5;
margin-right:5;
}
</style>
';
$uid = Request::get('uid');
$hash = Request::get('hash');
if ($kampagne_output['format'] == 'paidmails') $hz = '&uid='.$uid.'&hash='.$hash.'';
if ($warten == 1) echo '<meta http-equiv="refresh" content="'.($kampagne_output['aufendhalt']+1).';url=goto.php?bid='.$kampagne_output['kampagnen_id'].'&do=yes&uid='.$uid.'&hash='.$hash.''.$hz.'">';
echo'</head>
<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">
<tr>
<td align="left" width="50%" height="20" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$mainconfig['seitenname'].' ist für den Inhalt nicht verantwortlich.</b></td>
<td align="right" width="50%" height="20" valign="middle"><b>'.$msg.'</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</body>
</html>
';
}
$bid = Request::get('bid');
$uid = Request::get('uid');
$do = Request::get('do');
$tos = Request::get('tos');
$hash = Request::get('hash');
/* Bannerladen und Werbeform feststellen */
$kampagne = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE kampagnen_id = '".sanitize($bid)."' AND status = '1' LIMIT 1");

/* Script abbrechen wenn Kampagne nicht gefunden wurde */
if (!$db->numrows($kampagne)) {
echo '<div align="center"><b><h2>Kampagne nicht gefunden!</h2></b></div>';
die();
}

/* Kampagne in den Array legen */
$kampagne_output = $db->fetch($kampagne);

/* Ausgabe der View-Kampagnen */
if ($kampagne_output['format'] == 'bannerviews' or $kampagne_output['format'] == 'buttonviews' or $kampagne_output['format'] == 'surfbarviews' or $kampagne_output['format'] == 'textlinkviews') {
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_clicks = do_clicks + 1 WHERE kampagnen_id = '".sanitize($bid)."'");
header ("location: ".$kampagne_output['url_ziel']);
die();
}

/* Ausgabe der Klick-Kampagnen */
if ($kampagne_output['format'] == 'bannerklicks' or $kampagne_output['format'] == 'buttonklicks' or $kampagne_output['format'] == 'surfbarklicks' or $kampagne_output['format'] == 'textlinkklicks') {
	/* Klickreload prüfen */
	$klickreload = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE ip = '".sanitize($_SERVER['REMOTE_ADDR'])."' and kampagnen_id = '".sanitize($bid)."' and reload_bis > '".time()."'");
	if (!$db->numrows($klickreload)) {
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,ip,reload_bis) VALUES ('".sanitize($bid)."','".$_SERVER['REMOTE_ADDR']."','".(time()+$kampagne_output['reload'])."')");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_clicks = do_clicks + 1 WHERE kampagnen_id = '".sanitize($bid)."'");
	}
header ("location: ".$kampagne_output['url_ziel']);
die();
}

/* Ausgabe der Forcedkampagnen */
if ($kampagne_output['format'] == 'forcedbanner1') {

$reload_check = $db->query("SELECT uid FROM equinox_".$pageconfig['install_nr']."_reloads WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid='".sanitize($_SESSION['uid'])."' AND reload_bis >= '".time()."'");
if ($db->numrows($reload_check)) {
$msg = 'Kampagne noch im Reload!';
	if (!$tos) checkframe($msg,0);
	die();
}

/* Timersetzen */
if ($do == 'no') {
$msg = 'Bitte warte '.$kampagne_output['aufendhalt'].' Sekunden';
checkframe($msg,1);
die();
}

/* Klickprüfen und User vergüten */
if ($do == 'yes') {
$timer = $db->query("SELECT tid FROM equinox_".$pageconfig['install_nr']."_timer WHERE kampagnen_id = '".$kampagne_output['kampagnen_id']."' AND uid = '".sanitize($_SESSION['uid'])."' AND timer_bis <= '".time()."' AND tos != ''");
	if ($db->numrows($timer)) {
	$timer = $db->fetch($timer);
	$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_timer WHERE timer_bis <= '".(time()-10)."'");
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,uid,ip,reload_bis) VALUES ('".sanitize($kampagne_output['kampagnen_id'])."','".sanitize($_SESSION['uid'])."','".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+$kampagne_output['reload']))."')");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET forcedklicks = forcedklicks + 1, forcedsumme = forcedsumme + '".sanitize($kampagne_output['payout'])."' WHERE nickname = '".$_SESSION['nickname']."'");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_clicks = do_clicks + 1 WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."'");
	//kontoauszug('Intern',$_SESSION['nickname'],$kampagne_output['payout'],'Forceklick auf KID:'.$kampagne_output['kampagnen_id']);
	kontobuchung($_SESSION['nickname'],'+',$kampagne_output['payout'],$kampagne_output['payout'],$kampagne_output['payout'],1,0,$kampagne_output['payout']);
	setCookie('vms3_k4_'.$kampagne_output['kampagnen_id'],'true',time()+($kampagne_output['reload']+5));
	$msg = 'Dir wurden '.number_format($kampagne_output['payout'],2,",",".").' '.$mainconfig['waehrungsname'].' gutgeschrieben!';
	checkframe($msg,0);
	die();
	} else {
	$msg = 'Ungültiger Aufruf!';
	checkframe($msg,0);
	die();
	}
}

/* Set-Timer */
if (!$do) {
if ($mainconfig['ocs'] == '1') $db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_timer WHERE uid = '".sanitize($_SESSION['uid'])."'");
$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_timer (kampagnen_id,uid,ip,timer_bis) VALUES ('".sanitize($kampagne_output['kampagnen_id'])."','".sanitize($_SESSION['uid'])."','".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+$kampagne_output['aufendhalt']))."')");
}

/* Set-TOS-Code */
if ($tos && $do == 'make_tos') {
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_timer SET tos = '".$tos."' WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid = '".sanitize($_SESSION['uid'])."' AND ip = '".sanitize($_SERVER['REMOTE_ADDR'])."'");
header ("location: ".$kampagne_output['url_ziel']);
die();
}

/* Ausgabe des Framesets */
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Forcedklick by '.$mainconfig['seitenname'].'</title>
</head>
<frameset rows="20,*" border="0">
<frame name="check" src="goto.php?bid='.$kampagne_output['kampagnen_id'].'&do=no" scrolling="no" frameborder="0">
<frame name="'.md5(time().'-'.$kampagne['url_ziel']).'" src="goto.php?bid='.$kampagne_output['kampagnen_id'].'&tos='.md5($kampagne_output['url_ziel'].'-'.time()).'&do=make_tos" scrolling="auto" frameborder="0">
</frameset>
</body>
</html>
';
}

/* Ausgabe der Paidmails */
if ($kampagne_output['format'] == 'paidmails') {

$p_check = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE kid = '".sanitize($bid)."' AND uid = '".sanitize($uid)."' AND gueltig > '".time()."' AND bestaedigt = '0' AND hash = '".sanitize($hash)."'");
if (!$db->numrows($p_check)) {
$msg = 'Diese Mail ist schon bestädigt od. nicht für Dich!';
	if (!$tos) checkframe($msg,0);
	die();
}

$reload_check = $db->query("SELECT uid FROM equinox_".$pageconfig['install_nr']."_reloads WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid='".sanitize($uid)."' AND reload_bis >= '".time()."'");
if ($db->numrows($reload_check)) {
$msg = 'Kampagne noch im Reload!';
	if (!$tos) checkframe($msg,0);
	die();
}

/* Timersetzen */
if ($do == 'no') {
$msg = 'Bitte warte '.$kampagne_output['aufendhalt'].' Sekunden';
checkframe($msg,1);
die();
}

/* Klickprüfen und User vergüten */
if ($do == 'yes') {
$timer = $db->query("SELECT tid FROM equinox_".$pageconfig['install_nr']."_timer WHERE kampagnen_id = '".$kampagne_output['kampagnen_id']."' AND uid = '".sanitize($uid)."' AND timer_bis <= '".time()."' AND tos != ''");
	if ($db->numrows($timer)) {
	$timer = $db->fetch($timer);
	$nick = $db->fetch($db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE uid = '".sanitize($uid)."'"));
	$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_timer WHERE timer_bis <= '".(time()-10)."'");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_mailquery SET bestaedigt = '".time()."' WHERE kid = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid = '".sanitize($uid)."'");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_clicks = do_clicks + 1 WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."'");
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,uid,ip,reload_bis) VALUES ('".sanitize($kampagne_output['kampagnen_id'])."','".sanitize($uid)."','".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+$kampagne_output['reload']))."')");
	kontoauszug('Intern',$nick['nickname'],$kampagne_output['payout'],'Paidmail auf KID:'.$kampagne_output['kampagnen_id']);
	kontobuchung($nick['nickname'],'+',$kampagne_output['payout'],$kampagne_output['payout'],$kampagne_output['payout'],0,0,sanitize($kampagne_output['payout']));
	$msg = ' Dir wurden '.number_format($kampagne_output['payout'],$mainconfig['nach_komma'],",",".").' '.$mainconfig['waehrungsname'].' gutgeschrieben!';
	checkframe($msg,0);
	die();
	} else {
	$msg = 'Ungültiger Aufruf!';
	checkframe($msg,0);
	die();
	}
}

/* Set-Timer */
if (!$do) {
$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_timer (kampagnen_id,uid,ip,timer_bis) VALUES ('".sanitize($kampagne_output['kampagnen_id'])."','".sanitize($uid)."','".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+$kampagne_output['aufendhalt']))."')");
}

/* Set-TOS-Code */
if ($tos && $do == 'make_tos') {
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_timer SET tos = '".sanitize($tos)."' WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid = '".sanitize($uid)."' AND ip = '".sanitize($_SERVER['REMOTE_ADDR'])."'");
header ("location: ".$kampagne_output['url_ziel']);
die();
}

/* Ausgabe des Framesets */
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Paidmail by '.$mainconfig['seitenname'].'</title>
</head>
<frameset rows="20,*" border="0">
<frame name="check" src="goto.php?bid='.$kampagne_output['kampagnen_id'].'&do=no&uid='.$uid.'&hash='.$hash.'" scrolling="no" frameborder="0">
<frame name="'.md5(time().'-'.$kampagne_output['url_ziel']).'" src="goto.php?bid='.$kampagne_output['kampagnen_id'].'&tos='.md5($kampagne_output['url_ziel'].'-'.time()).'&do=make_tos&uid='.$uid.'&hash='.$hash.'" scrolling="auto" frameborder="0">
</frameset>
</body>
</html>
';
}


ob_end_flush();
?>