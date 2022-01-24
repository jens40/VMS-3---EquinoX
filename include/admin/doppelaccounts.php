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
* Datei: include/admin/doppelaccounts.php
*******************************************************************************/
$d_del = Request::get('d_del');
if (!empty($d_del)){
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_doppelaccounts WHERE did = '".sanitize($d_del)."'");
}

$doppelaccount = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_doppelaccounts ORDER BY did DESC");
$linecolor = '';
$doppelaccounts_outs = array();
while ($doppelaccounts_output = $db->fetch($doppelaccount)) {

	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $doppelaccounts_out = array(
      'linecolor' => $linecolor,
      'zeit' => date("d.m.Y - H:i:s",$doppelaccounts_output['zeit']),
      'von' => $doppelaccounts_output['von'],
      'zu' => $doppelaccounts_output['zu'],
      'did' => $doppelaccounts_output['did'],
    );
$doppelaccounts_outs[] = $doppelaccounts_out; 
 
 
}

$smarty->assign('doppelaccounts',$doppelaccounts_outs);  
$smarty->display('admin/doppelaccounts.tpl');
?>