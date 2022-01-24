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
* Datei: include/admin/paidmailsenden.php
*******************************************************************************/
$kid = Request::get('kid');
if (Filter::$do == 'senden' && $kid) {

 $pms = $db->query("SELECT kampagnen_id,in_clicks,do_clicks,name,text_mail FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE format = 'paidmails' AND status = '1' AND kampagnen_id = '".sanitize($kid)."'");

 if ($db->numrows($pms)) {
  $pms = $db->fetch($pms);
  $pme = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE status = '1' AND max_pmail >= 1");
  $gueltig = time() + (3600 * 24 * 3);
 $versendet = 0;
  while ($pme_output = $db->fetch($pme)) {
   $mail_counter = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailcounter WHERE nickname='".sanitize($pme_output['nickname'])."'");
   if (!$db->numrows($mail_counter)) {
    $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_mailcounter (nickname,counter) VALUES ('".sanitize($pme_output['nickname'])."','0')");
   }

   $reload_check = $db->query("SELECT uid FROM equinox_".$pageconfig['install_nr']."_reloads WHERE kampagnen_id = '".sanitize($pms['kampagnen_id'])."' AND uid='".sanitize($pme_output['uid'])."' AND reload_bis >= '".time()."'");
   if (!$db->numrows($reload_check)) {
    $mail_counter = $db->fetch($mail_counter);
    if ($mail_counter['counter'] < $pme_output['max_pmail']) {
     $hash = md5(create_code(32));
     $versendet++;
     if ($versendet >= 2) $mq2 = ',';
     $msg = '
     <b>'.$pms['name'].'</b>

     '.$pms['text_mail'].'
     _______________________________________________________________________
     <i>Diese Paidmail ist gültig bis '.date("d.m.Y - H:i:s",$gueltig).'</i>

     <b>Bestätigungslink:</b>
     '.$mainconfig['seitenurl'].'/goto.php?bid='.$pms['kampagnen_id'].'&uid='.$pme_output['uid'].'&hash='.$hash.'
     ';
     if ($versendet >= ($pms['in_clicks'] - $pms['do_clicks'])) break;
     $db->query("UPDATE equinox_".$pageconfig['install_nr']."_mailcounter SET counter=counter+1 WHERE nickname='".sanitize($pme_output['nickname'])."'");
     if ($mail_counter['counter'] < $pme_output['max_pmail']) {
      $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_mailquery (kid,uid,email,mailtitel,mailtext,gueltig,status,hash) VALUES ('".sanitize($pms['kampagnen_id'])."','".sanitize($pme_output['uid'])."','".sanitize($pme_output['email'])."','Paidmail (".date("d.m.Y")."): ".sanitize($pms['name'])."','".sanitize($msg)."','".sanitize($gueltig)."','1','".sanitize($hash)."')");
     };
    }
   }
  }
 }    
    
    
}

$paidmails = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE format = 'paidmails' AND status = '1'");
$linecolor = '';
$ausgabe_outs = array();
while ($ausgabe = $db->fetch($paidmails)) {
$pr = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE kid = '".$ausgabe['kampagnen_id']."' AND gueltig > '".time()."'");
if (!$db->numrows($pr)) {
$senden = '<a href="admin.php?admincontent=paidmailsenden&do=senden&kid='.$ausgabe['kampagnen_id'].'" target="_self">Senden</a>';
} else {
$senden = 'Reload';
}
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $ausgabe_out = array(
      'linecolor' => $linecolor,
      'kampagnen_id' => $ausgabe['kampagnen_id'],
      'name' => $ausgabe['name'],
      'payout' => number_format($ausgabe['payout'],$mainconfig['nach_koma'],",","."),
      'aufendhalt' => $ausgabe['aufendhalt'],
      'in_clicks' => $ausgabe['in_clicks'],
      'do_clicks' => ($ausgabe['in_clicks'] - $ausgabe['do_clicks']),
      'senden' => $senden
    );
$ausgabe_outs[] = $ausgabe_out; 
 
 
}

$smarty->assign('ausgabe',$ausgabe_outs);  
$smarty->display('admin/paidmailsenden.tpl');
?>