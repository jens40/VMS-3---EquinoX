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
* Datei: content/user/mailhistory.php
*******************************************************************************/
/* Seite sichern */
access();
$mid = Request::get('mid');
if (Filter::$do == 'delete') {
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE mid = '".sanitize($mid)."' AND uid = '".sanitize($_SESSION['uid'])."'");    
}
if (Filter::$do == 'send') {
$anforderung = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE mid = '".sanitize($mid)."' AND uid = '".sanitize($_SESSION['uid'])."' LIMIT 1");
$anforderung = $db->fetch($anforderung);
sendmail($anforderung['mailtext'],$anforderung['email'],$anforderung['mailtitel']);
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_mailquery SET status = '0' WHERE mid = '".sanitize($mid)."' AND uid = '".sanitize($_SESSION['uid'])."'");   
}
/* GFX Variabeln */
$gfx_status[0] = '<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="e-Mail versendet">';
$gfx_status[1] = '<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="e-Mail im Query">';
$gfx_status[2] = '<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Paidmail bestätigt">';

$emails = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE uid = '".sanitize($_SESSION['uid'])."' ORDER BY mid DESC");
$linecolor = '';
$emails_outs = array();
while ($emails_output = $db->fetch($emails)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}
	
    if ($emails_output['kid'] >=1) {$mailart = 'Paidmail';$gueltig = date("d.m.Y - H:i:s",$emails_output['gueltig']);} else {$mailart = '<i>Newsletter</i>';$gueltig = '------';}
	if ($emails_output['kid'] >=1 AND $emails_output['bestaedigt'] >= 1) {$emails_output['status'] = '2';}
     
     $emails_out = array(
      'linecolor' => $linecolor,
      'mailart' => $mailart,
      'mailtitel' => $emails_output['mailtitel'],
      'mid' => $emails_output['mid'],
      'status' => $gfx_status[$emails_output['status']],
      'gueltig' => $gueltig
    );
$emails_outs[] = $emails_out; 
 
}

$smarty->assign('emails_output',$emails_outs); 
$smarty->assign('ueberweisungssumme',number_format($mainconfig['ueberweisungssumme'], 2,",","."));
$smarty->assign('guthaben',number_format($userdaten['guthaben'], 2,",","."));
$smarty->assign('tresorguthaben',number_format($userdaten['tresorguthaben'], 2,",","."));
$smarty->display('mailhistory.tpl');


?>