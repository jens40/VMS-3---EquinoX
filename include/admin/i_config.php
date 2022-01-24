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
* Datei: include/admin/i_conig.php
*******************************************************************************/

$interface = Request::post('interface');

if (Filter::$do == 'speichern_iconfig') {
$betreiber = Request::post('betreiber');
$seite = Request::post('seite'); 
$pass = Request::post('pass');
$eigenverdienst = Request::post('eigenverdienst');     
$mindestverguetung = Request::post('mindestverguetung');
$restklicks = Request::post('restklicks');
$umrechnung = Request::post('umrechnung');
$aufendhalt = Request::post('aufendhalt');
$loeschen = Request::post('loeschen');

    $data = array(
			'betreiber' => sanitize($betreiber),
            'seite' => sanitize($seite),
			'pass' => sanitize($pass),
			'eigenverdienst' => sanitize($eigenverdienst),            
 			'mindestverguetung' => sanitize($mindestverguetung),
            'restklicks' => sanitize($restklicks),
			'umrechnung' => sanitize($umrechnung),
			'aufendhalt' => sanitize($aufendhalt),
            'loeschen' => sanitize($loeschen)            
            );

$db->update("equinox_".$pageconfig['install_nr']."_interface", $data, "interface='" . $interface . "'");

}

if (!$interface) $interface = 'adcocktail';
$interfaceconfig = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_interface WHERE interface = '".sanitize($interface)."'"));
 foreach ($interfaceconfig AS $key=>$value) {
	$smarty->assign('interfaceconfig_'.$key,$value);
 }
$smarty->assign('interface',$interface); 
$smarty->display('admin/i_config.tpl');
?>