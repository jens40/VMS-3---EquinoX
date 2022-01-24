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
* Datei: include/crons/refzahlung.php
*******************************************************************************/
$re_anzahl =0;
/* Refanzahl auslesen */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET refanzahl = 0");
$werberlesen = $db->query("SELECT werber_id FROM equinox_".$pageconfig['install_nr']."_user WHERE werber_id >= 1");
while ($werberlesen_out = $db->fetch($werberlesen)) {
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET refanzahl = refanzahl + 1 WHERE uid = '".sanitize($werberlesen_out['werber_id'])."'");
}

/* Refebenen auslesen */

$re_array = explode("|",$mainconfig['refebenen']);
foreach ($re_array as $re_output) {
$re_anzahl ++;
$re_prozent[$re_anzahl] = $re_output;
}

function referral($werber,$start) {
global $pageconfig,$db,$mainconfig,$re_anzahl,$re_prozent,$refverdienst;
$start++;
$refuser = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE werber_id = '".sanitize($werber)."'");
	while ($refuser_output = $db->fetch($refuser)) {
		$refverdienst = $refverdienst + ($refuser_output['werberverdienst_aktuell'] / 100 * $re_prozent[$start]);
		if ($start < $re_anzahl) {
		referral($refuser_output['uid'],$start);
		}
	}
return $refverdienst;
}

$ruser = $db->query("SELECT uid,nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE refanzahl != 0");
while ($ruser_output = $db->fetch($ruser)) {
referral($ruser_output['uid'],0);
if ($refverdienst >= 0.01) {
kontoauszug('Intern',$ruser_output['nickname'],$refverdienst,'Refvergütung alle Ebenen');
kontobuchung($ruser_output['nickname'],'+',$refverdienst,0,0,0,0,0);
}
$refverdienst = 0;
}
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET werberverdienst_gesamt = werberverdienst_gesamt + werberverdienst_aktuell, werberverdienst_aktuell = 0");
?>