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
* Datei: include/admin/kontoauszug.php
*******************************************************************************/
$bl_user = Request::get('bl_user');
$anzeigen = Request::get('anzeigen');
$search_start = Request::post('search_start');
$search_word = Request::post('search_word');
$suchen = '';

if (!isset($anzeigen) or $anzeigen <= 0) (int)$anzeigen = 0;
$anzeigen = (int)$anzeigen;
$limit = 25;


if ($bl_user) {
$suchen = "WHERE user = '".$bl_user."'";
}
if ($search_start) {
$suchen = "WHERE `bid` LIKE '%".$search_word."%'
OR `buchungs_id` LIKE '%".$search_word."%'
OR `user` LIKE '%".$search_word."%'
OR `sender` LIKE '%".$search_word."%'
OR `empfaenger` LIKE '%".$search_word."%'
OR `summe` LIKE '%".$search_word."%'
OR `vzweck` LIKE '%".$search_word."%'
OR `zeit` LIKE '%".$search_word."%'";
}


$kontauszug = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kontoauszug ".$suchen." ORDER BY zeit DESC LIMIT ".sanitize($anzeigen).",".$limit."");
$linecolor = '';
$auszug_outs = array();
while ($auszug = $db->fetch($kontauszug)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

 	if ($auszug['sender'] == $bl_user OR $auszug['sender'] != 'Intern') {
	$auszug['summe'] = '<font color="#990000">-'.number_format($auszug['summe'],$mainconfig['nach_koma'],",",".").'</font>';
	} else {
	$auszug['summe'] = '<font color="#009900">+'.number_format($auszug['summe'],$mainconfig['nach_koma'],",",".").'</font>';
	} 

     $auszug_out = array(
      'linecolor' => $linecolor,
      'summe' => $auszug['summe'],
      'empfaenger' => $auszug['empfaenger'],
      'sender' => $auszug['sender'],
      'vzweck' => $auszug['vzweck'],
      'zeit' => date("d.m.Y-H:i:s",$auszug['zeit']),
      'buchungs_id' => $auszug['buchungs_id'],
    );
$auszug_outs[] = $auszug_out;

}
$smarty->assign('bl_user',$bl_user);
$smarty->assign('anzeigen',$anzeigen);
$smarty->assign('limit',$limit);
$smarty->assign('auszug',$auszug_outs); 
$smarty->display('admin/kontoauszug.tpl');
?>