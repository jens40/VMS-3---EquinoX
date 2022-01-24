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
* Datei: include/admin/s_conig.php
*******************************************************************************/

$schnittstelle = Request::post('schnittstelle');

if (Filter::$do == 'speichern_sconfig') {
$betreiber_id = Request::post('betreiber_id');
$betreiber_passwort = Request::post('betreiber_passwort'); 
$betreiber_kennung = Request::post('betreiber_kennung');
$einzahltext = Request::post('einzahltext');     
$auszahltext = Request::post('auszahltext');
$einzahlsumme = Request::post('einzahlsumme');
$auszahlsumme = Request::post('auszahlsumme');
$anfragen_tag = Request::post('anfragen_tag');
$anfragen_geb = Request::post('anfragen_geb');

    $data = array(
			'betreiber_id' => sanitize($betreiber_id),
            'betreiber_passwort' => sanitize($betreiber_passwort),
			'betreiber_kennung' => sanitize($betreiber_kennung),
			'einzahltext' => sanitize($einzahltext),            
 			'auszahltext' => sanitize($auszahltext),
            'einzahlsumme' => sanitize($einzahlsumme),
			'auszahlsumme' => sanitize($auszahlsumme),
			'anfragen_tag' => sanitize($anfragen_tag),
            'anfragen_geb' => sanitize($anfragen_geb)            
            );

$db->update("equinox_".$pageconfig['install_nr']."_schnittstelle", $data, "schnittstelle='" . $schnittstelle . "'");

}

if (!$schnittstelle) $schnittstelle = 'klamm';
$schnittstelleconfig = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_schnittstelle WHERE schnittstelle = '".sanitize($schnittstelle)."'"));
 foreach ($schnittstelleconfig AS $key=>$value) {
	$smarty->assign('schnittstelleconfig_'.$key,$value);
 }
$smarty->assign('schnittstelle',$schnittstelle); 
$smarty->display('admin/s_config.tpl');
?>