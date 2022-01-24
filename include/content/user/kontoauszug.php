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
* Datei: content/user/kontoauszug.php
*******************************************************************************/
/* Seite sichern */
access();
$anzeigen = Request::get('anzeigen');
if (!isset($anzeigen) or $anzeigen <= 0) (int)$anzeigen = 0;
$anzeigen = (int)$anzeigen;
$limit = 25;
$auszug_outs = array();
$kontauszug = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kontoauszug WHERE user = '".$_SESSION['nickname']."' ORDER BY zeit DESC LIMIT ".sanitize($anzeigen).",".$limit.""); 
while ($auszug=$db->fetch($kontauszug)) { 
	if (isset($linecolor) && $linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

	if ($auszug['sender'] == $_SESSION['nickname']) {
	$auszug['summe'] = '<font color="#990000">-'.number_format($auszug['summe'],$mainconfig['nach_koma'],",",".").'</font>';
	} else {
	$auszug['summe'] = '<font color="#009900">+'.number_format($auszug['summe'],$mainconfig['nach_koma'],",",".").'</font>';
	}
    
     $auszug_out = array(
      'zeit' => date("d.m.Y-H:i:s",$auszug['zeit']),
      'buchungs_id' => $auszug['buchungs_id'],
      'vzweck' => $auszug['vzweck'],
      'sender' => $auszug['sender'],
      'empfaenger' => $auszug['empfaenger'],
      'summe' => $auszug['summe'],
      'linecolor' => $linecolor
    );
$auszug_outs[] = $auszug_out;
} 
$smarty->assign('anzeigen',$anzeigen);
$smarty->assign('limit',$limit);
$smarty->assign('auszug',$auszug_outs);
$smarty->display('kontoauszug.tpl');
?>