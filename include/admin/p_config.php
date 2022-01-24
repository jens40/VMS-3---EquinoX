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
* Datei: include/admin/p_config.php
*******************************************************************************/
if (Filter::$do == 'speichern_pconfig') {
$ocs = Request::post('ocs');
$bettel_min = Request::post('bettel_min'); 
$bettel_max = Request::post('bettel_max');
$bettel_reload = Request::post('bettel_reload');     
$ueberweisung = Request::post('ueberweisung');
$ueberweisungssumme = Request::post('ueberweisungssumme');
$refebenen = Request::post('refebenen');
$lizenzkey = Request::post('lizenzkey');
$seitenname = Request::post('seitenname');
$seitenurl = Request::post('seitenurl');
$cronpasswort = Request::post('cronpasswort');
$bank = Request::post('bank');
$paypal = Request::post('paypal');
$moneybookers = Request::post('moneybookers');
$klamm = Request::post('klamm');
$funcoins = Request::post('funcoins');
$nickey = Request::post('nickey');
$kurs_euro = Request::post('kurs_euro');
$kurs_klamm = Request::post('kurs_klamm');
$kurs_funcoins = Request::post('kurs_funcoins');
$kurs_nickey = Request::post('kurs_nickey');
$betreibermail = Request::post('betreibermail');
$waehrungsname = Request::post('waehrungsname');
$smtp_host = Request::post('smtp_host');
$smtp_username = Request::post('smtp_username');
$smtp_passwort = Request::post('smtp_passwort');
$smtp_port = Request::post('smtp_port');
$nach_koma = Request::post('nach_koma');


    $data = array(
			'ocs' => sanitize($ocs),
            'bettel_min' => sanitize($bettel_min),
			'bettel_max' => sanitize($bettel_max),
			'bettel_reload' => sanitize($bettel_reload),            
 			'ueberweisung' => sanitize($ueberweisung),
            'ueberweisungssumme' => sanitize($ueberweisungssumme),
			'refebenen' => sanitize($refebenen),
			'lizenzkey' => sanitize($lizenzkey),
            'seitenname' => sanitize($seitenname),
            'seitenurl' => sanitize($seitenurl),
            'betreibermail' => sanitize($betreibermail),
            'cronpasswort' => sanitize($cronpasswort),
            'waehrungsname' => sanitize($waehrungsname),
            'bank' => sanitize($bank),
            'paypal' => sanitize($paypal),
            'moneybookers' => sanitize($moneybookers),
            'klamm' => sanitize($klamm),
            'funcoins' => sanitize($funcoins),
            'nickey' => sanitize($nickey),
            'kurs_euro' => sanitize($kurs_euro),
            'kurs_klamm' => sanitize($kurs_klamm),
            'kurs_funcoins' => sanitize($kurs_funcoins),
            'kurs_nickey' => sanitize($kurs_nickey),            
            'smtp_host' => sanitize($smtp_host ),
            'smtp_username' => sanitize($smtp_username),
            'smtp_passwort' => sanitize($smtp_passwort),
            'smtp_port' => sanitize($smtp_port),
            'nach_koma' => sanitize($nach_koma)
            
            );
$db->update("equinox_".$pageconfig['install_nr']."_config", $data, "config_id='" . $pageconfig['install_nr'] . "'");
	
header("Location: admin.php?admincontent=p_config");
}

$smarty->display('admin/p_config.tpl');
?>