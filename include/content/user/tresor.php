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
* Datei: content/user/tresor.php
*******************************************************************************/
/* Seite sichern */
access();
if (Filter::$do == 'ueberweisen') {
   
$transsumme = Request::post('transsumme');
$richtung = Request::post('richtung');
$passwort = Request::post('transpasswort');
$transsumme = (int)$transsumme;	 
	/* In den Tresor einzahlen */
	if ($richtung == 1) {
           
		if ($userdaten['guthaben'] >= $transsumme) {
			if ($transsumme >= $mainconfig['ueberweisungssumme']) {
			$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET guthaben = guthaben - ".sanitize($transsumme).", tresorguthaben = tresorguthaben + ".sanitize($transsumme)." WHERE uid = ".sanitize($_SESSION['uid'])."");
			kontoauszug($_SESSION['nickname'],'Intern',$transsumme,'Tresoreinzahlung');
			Filter::msgSingleOk('Guthaben wurde in den Tresor eingezahlt!');
            $usercheck = $db->query("SELECT u.*,ud.*,uk.* FROM equinox_".$pageconfig['install_nr']."_user u, equinox_".$pageconfig['install_nr']."_userdaten ud, equinox_".$pageconfig['install_nr']."_userkonten uk WHERE u.uid = '".$_SESSION['uid']."' and ud.nickname = u.nickname and uk.nickname = u.nickname");
            $userdaten = $db->fetch($usercheck);
            } else {
			Filter::$msgs['error'] = 'Bitte Mindestbuchung beachten!';
			}
		} else {
		Filter::$msgs['error'] = 'Soviel Guthaben besitzt du nicht!';
		}
	}

	/* In den Tresor auszahlen */
	if ($richtung == 0) {
	   $passwortnew = hash('sha512', $passwort . $userdaten['salt']);
	if ($passwortnew == $userdaten['tresorpasswort']) {
		if ($userdaten['tresorguthaben'] >= $transsumme) {
			if ($transsumme >= $mainconfig['ueberweisungssumme']) {
			$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET guthaben = guthaben + ".sanitize($transsumme).", tresorguthaben = tresorguthaben - ".sanitize($transsumme)." WHERE uid = ".sanitize($_SESSION['uid'])."");
			kontoauszug('Intern',$_SESSION['nickname'],$transsumme,'Tresorauszahlung');
			Filter::msgSingleOk('Guthaben wurde aus dem Tresor ausgezahlt!');
            $usercheck = $db->query("SELECT u.*,ud.*,uk.* FROM equinox_".$pageconfig['install_nr']."_user u, equinox_".$pageconfig['install_nr']."_userdaten ud, equinox_".$pageconfig['install_nr']."_userkonten uk WHERE u.uid = '".$_SESSION['uid']."' and ud.nickname = u.nickname and uk.nickname = u.nickname");
            $userdaten = $db->fetch($usercheck);
            } else {
			Filter::$msgs['error'] = 'Bitte Mindestbuchung beachten!';
			}
		} else {
		Filter::$msgs['error'] = 'Soviel Tresorguthaben besitzt du nicht!';
		}
	} else {
	Filter::$msgs['error'] = 'Das Tresorpasswort ist falsch!';
	}
	}

}

$kontauszug = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kontoauszug WHERE user = '".sanitize($_SESSION['nickname'])."' and vzweck LIKE 'Tresor%' ORDER BY zeit DESC LIMIT 10");
$linecolor = '';
$auszug_outs = array();
while ($auszug = $db->fetch($kontauszug)) {
	if ($auszug['sender'] == $_SESSION['nickname']) {
	$an_von = $auszug['empfaenger'];
	$auszug['summe'] = '<font color="#009900">+'.number_format($auszug['summe'],2,",",".").'</font>';
	} else {
	$an_von = $auszug['sender'];
	$auszug['summe'] = '<font color="#990000">-'.number_format($auszug['summe'],2,",",".").'</font>';
	}

     $auszug_out = array(
      'zeit' => date("d.m.Y-H:i:s",$auszug['zeit']),
      'summe' => $auszug['summe'],
      'an_von' => $an_von,
      'vzweck' => $auszug['vzweck'],
    );
$auszug_outs[] = $auszug_out; 
 
}
if (!empty(Filter::$msgs)) {
Filter::msgStatus();
}   
$smarty->assign('message',Filter::$showMsg);
$smarty->assign('auszug',$auszug_outs); 
$smarty->assign('ueberweisungssumme',number_format($mainconfig['ueberweisungssumme'], 2,",","."));
$smarty->assign('guthaben',number_format($userdaten['guthaben'], 2,",","."));
$smarty->assign('tresorguthaben',number_format($userdaten['tresorguthaben'], 2,",","."));
$smarty->display('tresor.tpl');


?>