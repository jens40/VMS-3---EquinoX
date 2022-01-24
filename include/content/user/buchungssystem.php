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
* Datei: content/user/buchungssystem.php
*******************************************************************************/
/* Seite sichern */
access();
$kontoart = Request::post('kontoart');
$transsumme = Request::post('transsumme');
$transpasswort = Request::post('transpasswort');
$knt = Request::post('knt');
$ueberweisen = Request::post('ueberweisen');
$empfaenger = Request::post('empfaenger');
/* Laden der Kontodaten */
$usercheck = $db->query("SELECT u.*,ud.*,uk.* FROM equinox_".$pageconfig['install_nr']."_user u, equinox_".$pageconfig['install_nr']."_userdaten ud, equinox_".$pageconfig['install_nr']."_userkonten uk WHERE u.uid = '".$_SESSION['uid']."' and ud.nickname = u.nickname and uk.nickname = u.nickname");
$userdaten = $db->fetch($usercheck);
if (Filter::$do == 'ueberweisen') {

$transpasswortnew = hash('sha512', $transpasswort . $userdaten['salt']);    
/* Interne überweisung */
if ($userdaten['passwort'] == $transpasswortnew AND $ueberweisen && $transsumme >= 0 && $empfaenger != $_SESSION['nickname'] && $mainconfig['ueberweisung'] == '1') {
		/* Prüfen ob User genug Guthaben hat und min. Summe eingehalten wird */
		if ($transsumme >= $mainconfig['ueberweisungssumme'] AND $userdaten['guthaben'] >= $transsumme) {
			/* Empfänger prüfen */
			$knt_empf = $db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".$empfaenger."' AND status = '1' LIMIT 1");
			if ($db->numrows($knt_empf)) {
			kontoauszug($_SESSION['nickname'],$empfaenger,$transsumme,'Überweisung');
			kontobuchung($_SESSION['nickname'],'-',$transsumme,0,0,0,0,0);
			kontobuchung($empfaenger,'+',$transsumme,0,0,0,0,0);
			Filter::msgSingleOk('Die Überweisung wurde durchgeführt!');
			} else {
			Filter::$msgs['error'] = 'Empfänger nicht bekannt oder freigeschaltet!';
			}
		} else {
		Filter::$msgs['error'] = 'Zuwenig Guthaben und/oder Mindessumme unterschritten!';
		}
} else {
if ($ueberweisen) Filter::$msgs['error'] = 'Allgemeiner Überweisungsfehler!';
}    

if (!empty(Filter::$msgs)) {
Filter::msgStatus();
}    
$smarty->assign('message1',Filter::$showMsg);    
}

if (Filter::$do == 'buchen') {


	/* Buchen über Klamm */
	if (($kontoart == 'klamm_1' or $kontoart == 'klamm_0') AND $mainconfig['klamm'] != 0) {
	require("include/schnittstellen/klamm.php");
	$internesumme = (int)$transsumme / $mainconfig['kurs_klamm'];
	$interntext = 'Klammlose';
	if ($kontoart == 'klamm_1') $b_richtung = 'einzahlen';
	if ($kontoart == 'klamm_0') $b_richtung = 'auszahlen';
	}

	/* Guthaben einzahlen */
	if ($b_richtung == 'einzahlen') {
		if ($transsumme >= $schnittstelle['einzahlsumme']) {
		@einzahlen ($knt,$transpasswort,$transsumme);
			if (!$error) {
			kontoauszug('Intern',$_SESSION['nickname'],$internesumme,'Einzahlung von '.$interntext.' ('.number_format($transsumme,0,",",".").')');
			kontobuchung($_SESSION['nickname'],'+',$internesumme,0,0,0,0,0);
			}
		} else {
		Filter::$msgs['error'] = 'Du musst mindestens '.$schnittstelle['einzahlsumme'].' einzahlen!';
		}
	}

	/* Guthaben auszahlen */
	if ($b_richtung == 'auszahlen') {
		if ($transsumme >= $schnittstelle['auszahlsumme']) {
			if ($internesumme <= $userdaten['guthaben']) {
			@auszahlen($knt,$transpasswort,$transsumme);
				if (!$error) {
				kontoauszug($_SESSION['nickname'],'Intern',$internesumme,'Auszahlung zu '.$interntext.' ('.number_format($transsumme,0,",",".").')');
				kontobuchung($_SESSION['nickname'],'-',$internesumme,0,0,0,0,0);
				}
			} else {
			$error = 'true';
			Filter::$msgs['error'] = 'Soviel Guthaben hast Du nicht!';
			}
		} else {
		$error = 'true';
		Filter::$msgs['error'] = 'Du musst mindestens '.$schnittstelle['auszahlsumme'].' auszahlen';
		}
	}

if (!empty(Filter::$msgs)) {
Filter::msgStatus();
} 
$smarty->assign('message',Filter::$showMsg);
}


 foreach ($userdaten AS $key=>$value) {
	$smarty->assign('userdaten_'.$key,$value);
 }

$smarty->display('buchungssystem.tpl');


?>