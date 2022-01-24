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
* Datei: include/admin/newsletter.php
*******************************************************************************/
$versendet = 0;
$versendet2 = 0;
$mq = '';
$news = Request::post('news');
$nt = Request::post('nt');
if (Filter::$do == 'versenden'){
$mailadressen = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE status = '1'");

	while ($em = $db->fetch($mailadressen)) {
       $versendet++;
       $versendet2++;
	   if ($versendet2 >= 2) {
         $mq2 = ',';
       } else {
         $mq2 = '';
       }
	   $mq .= $mq2."('0','".sanitize($em['uid'])."','".sanitize($em['email'])."','".sanitize($nt)." (".date("d.m.Y").")','".sanitize($news)."','0','1')";
       if ( $versendet%100 == 0 ) {
          $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_mailquery (kid,uid,email,mailtitel,mailtext,gueltig,status) VALUES ".$mq."");
          $mq = "";
          $versendet2 = 0;
       }
	}
if ( !empty($mq) ) {
    $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_mailquery (kid,uid,email,mailtitel,mailtext,gueltig,status) VALUES ".$mq."");
}
} 
$smarty->assign('versendet',$versendet); 
$smarty->assign('do',Filter::$do); 
$smarty->display('admin/newsletter.tpl');