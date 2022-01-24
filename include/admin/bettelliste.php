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
* Datei: include/admin/bettelliste.php
*******************************************************************************/
$url_id = Request::get('url_id');
if (!empty($url_id)){
$blog_change = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_url_log WHERE url_id = '".sanitize($url_id)."'"));
	if ($blog_change['sperre'] == 1) {
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_url_log SET sperre = '0' WHERE url_id = '".sanitize($url_id)."'");
	} else {
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_url_log SET sperre = '1' WHERE url_id = '".sanitize($url_id)."'");
	}
}
/* GFX Variabeln */
$gfx_status[2] = '<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="">';
$gfx_status[0] = '<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Domain freigeschaltet!">';
$gfx_status[1] = '<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Domain gesperrt!">';

$blog = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_url_log WHERE durch = 'bettellink' ORDER BY aufrufe DESC");
$linecolor = '';
$ausgabe_outs = array();
while ($ausgabe = $db->fetch($blog)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $ausgabe_out = array(
      'linecolor' => $linecolor,
      'url' => $ausgabe['url'],
      'aufrufe' => number_format($ausgabe['aufrufe'],0,",","."),
      'url_id' => $ausgabe['url_id'],
      'sperre' => $gfx_status[$ausgabe['sperre']],
    );
$ausgabe_outs[] = $ausgabe_out; 
 
 
}

$smarty->assign('ausgabe',$ausgabe_outs);  
$smarty->display('admin/bettelliste.tpl');
?>