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
* Datei: include/admin/w_crons.php
*******************************************************************************/
$cron = Request::get('cron');
if ($cron) {
require('include/crons/'.$cron.'.php');
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_crons SET laufzeit ='".time()."' WHERE crondatei = '".sanitize($cron)."'");
}

$crons = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_crons ORDER BY cronname ASC");
$linecolor = '';
while ($crontabelle = $db->fetch($crons)) {
	if ($crontabelle['crondatei'] == 'sendmail') {
	$mm = $db->fetch($db->query("SELECT COUNT(mid) AS mid FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE status = '1'"));
	$hinweis = '( <i>Noch '.number_format($mm['mid'],0,",",".").' Mails im Query</i> )';
	} else {
	$hinweis = '';
	}
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}
     $crontabelle_out = array(
      'linecolor' => $linecolor,
      'hinweis' => $hinweis,
      'laufzeit' => date("d.m.Y - H:i:s",$crontabelle['laufzeit']),
      'cronname' => $crontabelle['cronname'],
      'crondatei' => $crontabelle['crondatei']
    );
$crontabelle_outs[] = $crontabelle_out;


}
$smarty->assign('crontabelle',$crontabelle_outs); 
$smarty->display('admin/w_crons.tpl');
?>