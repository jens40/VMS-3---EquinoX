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
* Datei: content/user/refcenter.php
*******************************************************************************/
/* Seite sichern */
access();
$saverefback = Request::post('saverefback');
$user = Request::get('user');
/* Neues Refback speichern */
if (isset ($saverefback)) {
	$saverefback = (int)$saverefback;
	if ($saverefback < 0) $saverefback = 0;
	if ($saverefback > 100) $saverefback = 100;
	$db->query ('UPDATE equinox_'.$pageconfig['install_nr'].'_user SET werber_refback = '.sanitize($saverefback).' WHERE nickname = "'.sanitize($user).'"');
}

/* Refebenen auslesen */
$re_anzahl = 0;
$re_array = explode("|",$mainconfig['refebenen']);

foreach ($re_array as $re_output) {
$re_anzahl ++;
$re_prozent[$re_anzahl] = $re_output;
}

$refs = array ();
/* Funktion zum laden der Ref's */
function referral($werber, $start='0') {
global $pageconfig,$db,$mainconfig,$re_anzahl,$re_prozent,$day,$all,$refs;
$day_outs = array();

$start++;
$refuser = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE werber_id = '".sanitize($werber)."'");
	while ($refuser_output = $db->fetch($refuser)) {
	    //$refs['ebene_'.$start]++;
		if ($start == 1) {$pfeil = '';$free = 0;} else {$pfeil = '&raquo;';$free = ($start * 2) * 10;}
		if ($refuser_output['status'] != 1) {$us='<font color="#cc0000">';} else {$us='';}       
        $day = $day + ($refuser_output['werberverdienst_aktuell'] / 100 * $re_prozent[$start]);
		$all = $all + ($refuser_output['werberverdienst_gesamt'] / 100 * $re_prozent[$start]);
        if ($start < $re_anzahl) {
		referral($refuser_output['uid'],$start);
		}
     $refback = ($start == 1) ? '<a href="index.php?content=user/refcenter&setrefback='.$refuser_output['nickname'].'&aktuell='.$refuser_output['werber_refback'].'">'.$refuser_output['werber_refback'].'%</a>' : '';
   
     $day_out = array(
      'start' => number_format($re_prozent[$start],2,",","."),
      'nickname' => $us.$refuser_output['nickname'],
      'pfeil' => $pfeil,
      'refback' => $refback,
      'free' => $free,
      'aktivpunkte' => number_format($refuser_output['aktivpunkte'],0,",","."),
      'werberverdienst_aktuell' => number_format($refuser_output['werberverdienst_aktuell'] / 100 * $re_prozent[$start],2,",","."),
      'werberverdienst_gesamt' => number_format($refuser_output['werberverdienst_gesamt'] / 100 * $re_prozent[$start],2,",",".")
    );	
 
 $day_outs[] = $day_out;
}

return array($day_outs,$day,$all,$refs); 
}

$aktuell = Request::get('aktuell');
$smarty->assign('aktuell',$aktuell);
$setrefback = Request::get('setrefback');
$smarty->assign('setrefback',$setrefback);
$referral = referral($_SESSION['uid'],0);
$smarty->assign('referral',$referral[0]);
$smarty->assign('day',$referral[1]);
$smarty->assign('all',$referral[2]);
$smarty->display('refcenter.tpl');


?>