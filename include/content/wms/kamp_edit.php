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
* Datei: include/wms/kamp_edit.php
*******************************************************************************/

/* Pruefen, ob User eingeloggt */
access ();
$bid = Request::get('bid');
$updaten = Request::post('updaten');
$send = Request::post('send');
$loeschen = Request::post('loeschen');
$reload = Request::post('reload');
$text_mail = Request::post('text_mail');
$text_link = Request::post('text_link');
$url_ziel = Request::post('url_ziel');
$url_banner = Request::post('url_banner');
$payout = Request::post('payout');
$aufendhalt = Request::post('aufendhalt');
$in_views = Request::post('in_views');
$in_clicks = Request::post('in_clicks');

if ($send && $updaten) {
	if ($loeschen == '1') {
	$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE kampagnen_id = '".sanitize($updaten)."' AND userid = '".sanitize($_SESSION['uid'])."'");
	header("Location: index.php?content=wms/kamp_view");
    } else {
	$nr = (int)$reload * 3600 ;
	
    $data1 = array(
			'text_mail' => sanitize($text_mail),
			'text_link' => sanitize($text_link),
            'url_ziel' => sanitize($url_ziel),
            'url_banner' => sanitize($url_banner),
            'payout' => sanitize($payout),
            'aufendhalt' => sanitize($aufendhalt),
            'in_views' => sanitize($in_views),
			'in_clicks' => sanitize($in_clicks),
			'reload' => sanitize($reload)
            );         
    $db->update("equinox_".$pageconfig['install_nr']."_kampagnen", $data1, "kampagnen_id='" . sanitize($updaten) . "' AND userid = '".sanitize($_SESSION['uid'])."'");    
 }
}

$kampagnen_output = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE kampagnen_id = '".$bid."' AND userid = '".sanitize($_SESSION['uid'])."' LIMIT 1"));
$username = $db->fetch($db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE uid = '".sanitize($_SESSION['uid'])."' LIMIT 1"));
if ($kampagnen_output['format'] == 'forcedbanner') $format = "Forcedklicks";
if ($kampagnen_output['format'] == 'bannerviews') $format = "Bannerviews";
if ($kampagnen_output['format'] == 'bannerklicks') $format = "Bannerklicks";
if ($kampagnen_output['format'] == 'buttonviews') $format = "Buttonviews";
if ($kampagnen_output['format'] == 'buttonklicks') $format = "Buttonklicks";
if ($kampagnen_output['format'] == 'textlinkviews') $format = "Textlinkviews";
if ($kampagnen_output['format'] == 'textlinkklicks') $format = "Textlinkklicks";
if ($kampagnen_output['format'] == 'surfbarkviews') $format = "Surfbarviews";
if ($kampagnen_output['format'] == 'surfbarklicks') $format = "Surfbarklicks";
if ($kampagnen_output['format'] == 'paidmails') $format = "Paidmail";



 foreach ($kampagnen_output AS $key=>$value) {
	$smarty->assign('kampagnen_output_'.$key,$value);
 }
$smarty->assign('text_link',str_replace("\\","",$kampagnen_output['text_link'])); 
$smarty->assign('text_mail',str_replace("\\","",$kampagnen_output['text_mail'])); 
$smarty->assign('format',$format);  
$smarty->assign('nickname',$userdaten['nickname']);
$smarty->display('wms/kamp_edit.tpl');
