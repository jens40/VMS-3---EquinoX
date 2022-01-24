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
* Datei: include/admin/kamp_list.php
*******************************************************************************/
$uid = Request::get('uid');
$wf = Request::get('wf');

$username = $db->fetch($db->query("SELECT nickname FROM equinox_".$pageconfig['install_nr']."_user WHERE uid = '".sanitize($uid)."'"));
$kampagne = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE userid = '".sanitize($uid)."' AND format = '".sanitize($wf)."'");
$linecolor = '';
$kampagne_outputs = array();
while ($kampagne_output = $db->fetch($kampagne)) {
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

if ($kampagne_output['format'] == 'forcedbanner') {
$klickrate	= 'N/A';
$views		= 'N/A';
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Forcedklicks";
}

if ($kampagne_output['format'] == 'paidmails') {
$klickrate	= 'N/A';
$views		= 'N/A';
$klicks		= $kampagne_output['do_clicks'].' / '.$kampagne_output['in_clicks'];
$format		= "Paidmail";
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
      'name' => $kampagne_output['name']
    );
$kampagne_outputs[] = $kampagne_output;


}
$smarty->assign('nickname',$username['nickname']);
$smarty->assign('kampagne_output',$kampagne_outputs); 
$smarty->display('admin/kamp_list.tpl');
?>