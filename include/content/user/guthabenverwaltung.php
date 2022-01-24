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
* Datei: include/content/user/guthabenverwaltung.php
*******************************************************************************/
/* Seite sichern */
access();
 foreach ($userdaten AS $key=>$value) {
	$smarty->assign('userdaten_'.$key,$value);
 }

/* Zinsdaten holen */
$x = 0;
$zs = array();
$zinssaetze = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_zinssaetze ORDER BY zinspunkte_von ASC");
while ($zinssaetze_output = $db->fetch($zinssaetze)) {
$x++;
$zs[$x]['zp'] = $zinssaetze_output['zinspunkte_von'];
$zs[$x]['zs'] = $zinssaetze_output['zinssatz'];
$zs[$x]['mg'] = $zinssaetze_output['max_verzinsen'];
}

for ($y=0;$y<=$x;$y++) {
	if ($userdaten['zinspunkte'] >= @$zs[$y]['zp']) {
	$zinssatz = @$zs[$y]['zs'];
	$maxchash = @$zs[$y]['mg'];
	}
}
if ($userdaten['guthaben'] + $userdaten['tresorguthaben'] < $userdaten['knt_guthaben']) {
	if ($userdaten['guthaben'] + $userdaten['tresorguthaben'] <= $maxchash) {
	$zinsgutgaben = $userdaten['guthaben'] + $userdaten['tresorguthaben'];
	} else {
	$zinsgutgaben = $maxchash;
	}
} else {
	if ($userdaten['knt_guthaben'] <= $maxchash) {
	$zinsgutgaben = $userdaten['knt_guthaben'];
	} else {
	$zinsgutgaben = $maxchash;
	}
}

$zinsen = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_zinssaetze ORDER BY zinspunkte_von ASC");
$linecolor = '';
$zinsen_outs = array();
while ($zinsen_output = $db->fetch($zinsen)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $zinsen_out = array(
      'linecolor' => $linecolor,
      'zinspunkte_von' => number_format($zinsen_output['zinspunkte_von'],0,",","."),
      'zinssatz' => number_format($zinsen_output['zinssatz'],3,",","."),
      'max_verzinsen' => number_format($zinsen_output['max_verzinsen'],0,",",".")
    );
$zinsen_outs[] = $zinsen_out; 
 
 
}

$offen = $db->fetch($db->query("SELECT SUM(verguetung) as g_verg FROM equinox_".$pageconfig['install_nr']."_bonusaktionen_teilnehmer WHERE status = 1 AND uid = '".sanitize($_SESSION['uid'])."'"));
$smarty->assign('g_verg',number_format($offen['g_verg'],2,',','.'));
$smarty->assign('leads_offen',$userdaten['leads_offen']);
$smarty->assign('leads_verguetet',$userdaten['leads_verguetet']);
$smarty->assign('leads_abgelehnt',$userdaten['leads_abgelehnt']);

//$smarty->assign('tgl_guthaben',@number_format($userdaten['knt_guthaben'] / $userdaten['knt_messungen'],2,',','.'));
$smarty->assign('zinsen_output',$zinsen_outs); 
$zinsertrag = ($zinsgutgaben * $zinssatz * 1) / (100 * 360); 
$smarty->assign('zinsertrag',number_format($zinsertrag,2,',','.'));
$smarty->assign('zinsgutgaben',number_format($zinsgutgaben,2,',','.'));
$smarty->assign('zinssatz',number_format($zinssatz,3,',','.')); 
$smarty->display('guthabenverwaltung.tpl');
?>