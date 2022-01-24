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
* Datei: include/admin/accountinformationen.php
*******************************************************************************/
$gleiches_passwort = $db->query("SELECT count(distinct(uid)) AS uid,regip FROM equinox_".$pageconfig['install_nr']."_user group by regip");
$linecolor = '';
while ($gp = $db->fetch($gleiches_passwort)) {
if ($gp['uid'] >= 2) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $gp_out = array(
      'linecolor' => $linecolor,
      'regip' => $gp['regip'],
      'uid' => $gp['uid'],
    );
$gp_outs[] = $gp_out; 
 
 }
}

$smarty->assign('gp',$gp_outs);  
$smarty->display('admin/accountinformationen.tpl');
?>