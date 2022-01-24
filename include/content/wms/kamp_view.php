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
* Datei: include/wms/kamp_view.php
*******************************************************************************/

/* Pruefen, ob User eingeloggt */
access ();
$linecolor = '';
$bid = Request::get('bid');
$status = Request::get('status');
$kampagne_outputs = array();
if ($bid AND $status == "change") {
$chance = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE kampagnen_id = '".sanitize($bid)."' AND userid = '".sanitize($_SESSION['uid'])."'");
$bannerchange = $db->fetch($chance);
if ($bannerchange['status'] == 2) {$newstatus = 1;} else {$newstatus = 2;}
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET status = '".$newstatus."' WHERE kampagnen_id = '".sanitize($bid)."' AND userid = '".sanitize($_SESSION['uid'])."'");
} 

$kampagne = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE userid = '".sanitize($_SESSION['uid'])."'");

while ($kampagne_output = $db->fetch($kampagne)) {
$gfx_status[2] = '<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0">';
$gfx_status[1] = '<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0">';
$gfx_status[0] = '<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0">';
	if ($linecolor == '#88B1DA') {
	$linecolor = '#B6D2F9';
	} else {
	$linecolor = '#88B1DA';
	}
	
if ($kampagne_output['format'] == 'forcedbanner') {
$klickrate	= 'N/A';
$views		= 'N/A';
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Forcedklicks";
}

if ($kampagne_output['format'] == 'paidmails') {
$klickrate    = 'N/A';
$views        = 'N/A';
$klicks        = $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format        = "Paidmails";
} 

if ($kampagne_output['format'] == 'bannerviews') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'].' / '.$kampagne_output['in_views'];
$klicks		= $kampagne_output['do_clicks'];
$format		= "Bannerviews";
}

if ($kampagne_output['format'] == 'bannerklicks') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'];
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Bannerklicks";
}

if ($kampagne_output['format'] == 'buttonviews') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'].' / '.$kampagne_output['in_views'];
$klicks		= $kampagne_output['do_clicks'];
$format		= "Buttonviews";
}

if ($kampagne_output['format'] == 'buttonklicks') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'];
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Buttonklicks";
}

if ($kampagne_output['format'] == 'textlinkviews') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'].' / '.$kampagne_output['in_views'];
$klicks		= $kampagne_output['do_clicks'];
$format		= "Textlinkviews";
}

if ($kampagne_output['format'] == 'textlinkklicks') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'];
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Textlinkklicks";
}

if ($kampagne_output['format'] == 'surfbarkviews') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'].' / '.$kampagne_output['in_views'];
$klicks		= $kampagne_output['do_clicks'];
$format		= "Surfbarviews";
}

if ($kampagne_output['format'] == 'surfbarklicks') {
$klickrate	= @number_format(($kampagne_output['do_clicks']*100)/$kampagne_output['do_views'],2,",",".").'%';
$views		= $kampagne_output['do_views'];
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Surfbarklicks";
}


    $kampagne_output = array(
      'linecolor' => $linecolor,
      'views' => $views,
      'klicks' => $klicks,
      'klickrate' => $klickrate,
      'kampagnen_id' => $kampagne_output['kampagnen_id'],
      'name' => $kampagne_output['name'],
      'status' => $gfx_status[$kampagne_output['status']],
      'format' => $kampagne_output['format']
    );
$kampagne_outputs[] = $kampagne_output;

}
$smarty->assign('nickname',$username['nickname']);
$smarty->assign('kampagne_output',$kampagne_outputs); 
$smarty->display('wms/kamp_view.tpl');
