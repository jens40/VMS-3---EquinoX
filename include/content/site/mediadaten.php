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
* Datei: include/content/site/mediadaten.php
*******************************************************************************/
$md = $db->fetch($db->query("SELECT SUM(tresorguthaben) AS tresorguthaben, SUM(bettelklicks) AS bk, SUM(bettelsumme) AS bs, COUNT(uid) AS user, SUM(guthaben) AS guthaben, SUM(forcedklicks) AS fk, SUM(forcedsumme) AS fs, SUM(leads_offen) AS kd_leads_offen, SUM(leads_verguetet) AS kd_leads_verguetet, SUM(leads_abgelehnt) AS kd_leads_abgelehnt, SUM(leads_verdienst) AS kd_leads_verdienst FROM equinox_".$pageconfig['install_nr']."_user WHERE status = '1'"));
$kamp = array();
$ak = 0;
$kampagnen = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE status = '1'");
while ($kampagnen_output = $db->fetch($kampagnen)) {
$ak++;
$kamp[$kampagnen_output['format']]++;
}
$heute			= strtotime("".date("m")."/".date("d")."/".date("Y").""); // Format mm.tt.yyyy
$seitenstart	= strtotime("01/01/2018"); // Format mm.tt.yyyy
$tage			= ($heute - $seitenstart) / 86400;
if ($tage <= 1) $tage = 1;

 foreach ($kamp AS $key=>$value) {
	$smarty->assign('kamp_'.$key,$value);
 }
$smarty->assign('ak',number_format($ak,0,",","."));
//$smarty->assign('bs_bk',number_format($md['bs']/$md['bk'],2,",","."));
$smarty->assign('bk',number_format($md['bk'],0,",","."));
$smarty->assign('bs',number_format($md['bs'],2,",","."));   
$smarty->assign('fs_fk',number_format($md['fs']/$md['fk'],2,",","."));
$smarty->assign('fk',number_format($md['fk'],0,",","."));
$smarty->assign('fs',number_format($md['fs'],2,",","."));
$smarty->assign('verfuegbare_aktionen',number_format($leads['id'],0,",","."));
$smarty->assign('kd_leads_verguetet',number_format($md['kd_leads_verguetet'],0,",","."));
$smarty->assign('kd_leads_offen',number_format($md['kd_leads_offen'],0,",","."));
$smarty->assign('kd_leads_abgelehnt',number_format($md['kd_leads_abgelehnt'],0,",","."));
$smarty->assign('kd_leads_verdienst',number_format($md['kd_leads_verdienst'],2,",","."));
$smarty->assign('tresorguthaben_user',number_format($md['tresorguthaben'] / $md['user'],2,",","."));
$smarty->assign('tresorguthaben',number_format($md['tresorguthaben'],2,",","."));
$smarty->assign('guthaben_user',number_format($md['guthaben'] / $md['user'],2,",","."));
$smarty->assign('guthaben',number_format($md['guthaben'],2,",","."));
$smarty->assign('user_tage',number_format($md['user'] / $tage,2,",",".")); 
$smarty->assign('user',number_format($md['user'],0,",","."));
$smarty->assign('seitenstart',date("d.m.Y",$seitenstart));
$smarty->display('mediadaten.tpl');
?>