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
* Datei: include/admin/zinssystem.php
*******************************************************************************/
$zid = Request::get('zid');
if ($zid) {
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_zinssaetze WHERE zinsid = '".sanitize($zid)."'");
}

if (Filter::$do == 'anlegen') {
$vp = Request::post('vp');
$mv = Request::post('mv');
$zs = Request::post('zs');

    $data = array(
			'zinspunkte_von' => sanitize($vp),
            'max_verzinsen' => sanitize($mv),
			'zinssatz' => sanitize($zs)
            );
            
$db->insert("equinox_".$pageconfig['install_nr']."_zinssaetze", $data);
    
}

$cron = Request::get('cron');
if ($cron) {
require('include/crons/'.$cron.'.php');
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_crons SET laufzeit ='".time()."' WHERE crondatei = '".sanitize($cron)."'");
}

$zinsen = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_zinssaetze ORDER BY zinspunkte_von ASC");
$linecolor = '';
$zinsen_outputs = array();
while ($zinsen_output = $db->fetch($zinsen)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}
     $zinsen_out = array(
      'linecolor' => $linecolor,
      'zinsid' => $zinsen_output['zinsid'],
      'zinspunkte_von' => number_format($zinsen_output['zinspunkte_von'],0,",","."),
      'zinssatz' => number_format($zinsen_output['zinssatz'],3,",","."),
      'max_verzinsen' => number_format($zinsen_output['max_verzinsen'],0,",",".")
    );
$zinsen_outputs[] = $zinsen_out;


}
$smarty->assign('zinsen_output',$zinsen_outputs); 
$smarty->display('admin/zinssystem.tpl');
?>