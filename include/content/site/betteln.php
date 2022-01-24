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
* Datei: include/site/betteln.php
*******************************************************************************/
$bettelnick = Request::get('bettelnick');
if ($mainconfig['bettel_reload'] >= 1) {
if (strtolower($_COOKIE['olduser']) != strtolower($bettelnick)) {
	/* Referer prüfen */
	$blog = str_replace("www.", "", $referer['host']);
	$check_referer = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_url_log WHERE url LIKE '%".sanitize($blog)."%' AND durch = 'bettellink' LIMIT 1");
	if (!$db->numrows($check_referer)) {
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_url_log (url,aufrufe,durch) VALUES ('".sanitize($blog)."','1','bettellink')");
	} else {
	$check_referer = $db->fetch($check_referer);
		if ($check_referer['sperre'] == '0') {
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_url_log SET aufrufe = aufrufe + 1 WHERE url = '".sanitize($blog)."' AND durch = 'bettellink'");
		}
	}

if ($check_referer['sperre'] == '0') {

/* Reloadprüfen */
$b_reload = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE ip = '".sanitize($_SERVER['REMOTE_ADDR'])."' AND zusatz = 'betteln' AND reload_bis >= '".sanitize(time())."'");
	if (!$db->numrows($b_reload)) {
		/* User prüfen */
		srand((double)microtime()*1000000);
		$bsumme	= rand(($mainconfig['bettel_min']*1000000),($mainconfig['bettel_max']*1000000))/1000000;
		$b_user = $db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($bettelnick)."'");
		if ($db->numrows($b_user)) {
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET bettelklicks = bettelklicks + 1, bettelsumme = bettelsumme + '".sanitize($bsumme)."' WHERE nickname = '".sanitize($bettelnick)."'");
		kontobuchung($bettelnick,'+',$bsumme,$bsumme,0,0,1,0);
		$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (ip,reload_bis,zusatz) VALUES ('".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+($mainconfig['bettel_reload']*60)))."','betteln')");
		$b_text = '<b>Du hast für den User '.$bettelnick.' gerade '.number_format($bsumme,2,",",".").' '.$mainconfig['waehrungsname'].' erbettelt!</b>';
		} else {
		$b_text = '<b><font color="#FF0000">Der User '.$bettelnick.' ist dem System nicht bekannt!</font></b>';
		}
	} else {
	$b_text = '<b><font color="#FF0000">Du kannst nur alle '.$mainconfig['bettel_reload'].' Minuten betteln!</font></b>';
	}
} else {
$b_text = '<b><font color="#FF0000">Du kannst dich nicht selber anbetteln!!!</font></b>';
}
} else {
$b_text = '<b><font color="#FF0000">Diese Domain ist fürs Betteln gesperrt!!!</font></b>';
}
} else {
$b_text = '<b><font color="#FF0000">Die Bettelfunktion ist deaktiviert!!!</font></b>';
} 

$smarty->assign('b_text',$b_text);

$smarty->display('betteln.tpl');

?>