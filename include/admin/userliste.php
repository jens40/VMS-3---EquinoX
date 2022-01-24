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
* Datei: include/admin/userliste.php
*******************************************************************************/
$where = Request::get('where');
$spalte = Request::get('spalte');
$search = Request::get('search');
$anzeigen = Request::get('anzeigen');
$search_start = Request::post('search_start');
$search_art = Request::post('search_art');
$search_word = Request::post('search_word');
$view_all = Request::post('view_all');
$suchen = '';
/* GFX Variabeln */
$gfx_status[0] = '<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Nicht freigeschaltet">';
$gfx_status[1] = '<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="O.K.">';
$gfx_status[2] = '<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Gesperrt">';

if ($where == 'true') $suchen = "WHERE ".$spalte." = '".$search."'";
if ($search_start) {
	if ($search_art == 'groesser') $search_art = '>';
	if ($search_art == 'kleiner') $search_art = '<';
	$suchen = "WHERE ".$spalte." ".$search_art." '".$search_word."'";
	if ($view_all) $suchen = '';
}
if (!isset($anzeigen) or $anzeigen <= 0) (int)$anzeigen = 0;
$anzeigen = (int)$anzeigen;
$limit = 50;
$user = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user ".$suchen." ORDER BY nickname ASC LIMIT ".sanitize($anzeigen).",".$limit."");
$linecolor = '';
$ausgabe_outs = array();
while ($ausgabe = $db->fetch($user)) {
	if ($linecolor == '#88B1DA') {
	$linecolor = '#B6D2F9';
	} else {
	$linecolor = '#88B1DA';
	}
$sql = $db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_nickpage WHERE nickname = '".sanitize($ausgabe['nickname'])."' LIMIT 1");
$np = $db->numrows($sql);
     $ausgabe_out = array(
      'np' => $np,
      'linecolor' => $linecolor,
      'status' => $gfx_status[$ausgabe['status']],
      'uid' => $ausgabe['uid'],
      'nickname' => $ausgabe['nickname'],
      'guthaben' => number_format($ausgabe['guthaben'],2,",","."),
      'tresorguthaben' => number_format($ausgabe['tresorguthaben'],2,",","."),
      'email' => $ausgabe['email'],
      'anmeldezeit' => date("d.m.y - H:i",$ausgabe['anmeldezeit'])
    );
$ausgabe_outs[] = $ausgabe_out;


}
$smarty->assign('anzeigen',$anzeigen);
$smarty->assign('limit',$limit);
$smarty->assign('ausgabe',$ausgabe_outs); 
$smarty->display('admin/userliste.tpl');
?>