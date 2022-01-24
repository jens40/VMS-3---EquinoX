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
* Datei: include/admin/kamp_uebersicht.php
*******************************************************************************/
$ka['forcedbanner'] = 0;
$ka['bannerklicks'] = 0;
$ka['bannerviews'] = 0;
$ka['buttonklicks'] = 0;
$ka['buttonviews'] = 0;
$ka['surfbarklicks'] = 0;
$ka['surfbarviews'] = 0;
$ka['textlinkklicks'] = 0;
$ka['textlinkviews'] = 0;
$ka['paidmails'] = 0;
	$kampagne = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE userid = '0'");
	while ($kampagne_output = $db->fetch($kampagne)) {
	$ka[$kampagne_output['format']]++;
	}
	$user_output['uid'] = 0;
	if($ka['forcedbanner'] != 0) $ka['forcedbanner'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=forcedbanner" target="_self"><b>'.$ka['forcedbanner'].'</b></a>';
	if($ka['bannerklicks'] != 0) $ka['bannerklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=bannerklicks" target="_self"><b>'.$ka['bannerklicks'].'</b></a>';
	if($ka['bannerviews'] != 0) $ka['bannerviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=bannerviews" target="_self"><b>'.$ka['bannerviews'].'</b></a>';
	if($ka['buttonklicks'] != 0) $ka['buttonklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=buttonklicks" target="_self"><b>'.$ka['buttonklicks'].'</b></a>';
	if($ka['buttonviews'] != 0) $ka['buttonviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=buttonviews" target="_self"><b>'.$ka['buttonviews'].'</b></a>';
	if($ka['surfbarklicks'] != 0) $ka['surfbarklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=surfbarklicks" target="_self"><b>'.$ka['surfbarklicks'].'</b></a>';
	if($ka['surfbarviews'] != 0) $ka['surfbarviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=surfbarviews" target="_self"><b>'.$ka['surfbarviews'].'</b></a>';
	if($ka['textlinkklicks'] != 0) $ka['textlinkklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=textlinkklicks" target="_self"><b>'.$ka['textlinkklicks'].'</b></a>';
	if($ka['textlinkviews'] != 0) $ka['textlinkviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=textlinkviews" target="_self"><b>'.$ka['textlinkviews'].'</b></a>';
	if($ka['paidmails'] != 0) $ka['paidmails'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=paidmails" target="_self"><b>'.$ka['paidmails'].'</b></a>';

$smarty->assign('forcedbanner',$ka['forcedbanner']); 
$smarty->assign('bannerklicks',$ka['bannerklicks']); 
$smarty->assign('bannerviews',$ka['bannerviews']); 
$smarty->assign('buttonklicks',$ka['buttonklicks']); 
$smarty->assign('buttonviews',$ka['buttonviews']); 
$smarty->assign('surfbarklicks',$ka['surfbarklicks']); 
$smarty->assign('surfbarviews',$ka['surfbarviews']); 
$smarty->assign('textlinkklicks',$ka['textlinkklicks']); 
$smarty->assign('textlinkviews',$ka['textlinkviews']);
$smarty->assign('paidmails',$ka['paidmails']); 

$user = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user ORDER BY nickname");
$linecolor = '';
$kampagne_outputs = array();
while ($user_output = $db->fetch($user)) {
$ka['forcedbanner'] = 0;
$ka['bannerklicks'] = 0;
$ka['bannerviews'] = 0;
$ka['buttonklicks'] = 0;
$ka['buttonviews'] = 0;
$ka['surfbarklicks'] = 0;
$ka['surfbarviews'] = 0;
$ka['textlinkklicks'] = 0;
$ka['textlinkviews'] = 0;
$ka['paidmails'] = 0;
	$kampagne1 = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE userid = '".$user_output['uid']."'");
	while ($kampagne_output = $db->fetch($kampagne1)) {
	$ka[$kampagne_output['format']]++;
	}

	if($ka['forcedbanner'] != 0) $ka['forcedbanner'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=forcedbanner" target="_self"><b>'.$ka['forcedbanner'].'</b></a>';
	if($ka['bannerklicks'] != 0) $ka['bannerklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=bannerklicks" target="_self"><b>'.$ka['bannerklicks'].'</b></a>';
	if($ka['bannerviews'] != 0) $ka['bannerviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=bannerviews" target="_self"><b>'.$ka['bannerviews'].'</b></a>';
	if($ka['buttonklicks'] != 0) $ka['buttonklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=buttonklicks" target="_self"><b>'.$ka['buttonklicks'].'</b></a>';
	if($ka['buttonviews'] != 0) $ka['buttonviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=buttonviews" target="_self"><b>'.$ka['buttonviews'].'</b></a>';
	if($ka['surfbarklicks'] != 0) $ka['surfbarklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=surfbarklicks" target="_self"><b>'.$ka['surfbarklicks'].'</b></a>';
	if($ka['surfbarviews'] != 0) $ka['surfbarviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=surfbarviews" target="_self"><b>'.$ka['surfbarviews'].'</b></a>';
	if($ka['textlinkklicks'] != 0) $ka['textlinkklicks'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=textlinkklicks" target="_self"><b>'.$ka['textlinkklicks'].'</b></a>';
	if($ka['textlinkviews'] != 0) $ka['textlinkviews'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=textlinkviews" target="_self"><b>'.$ka['textlinkviews'].'</b></a>';
	if($ka['paidmails'] != 0) $ka['paidmails'] = '<a href="admin.php?admincontent=kamp_list&uid='.$user_output['uid'].'&wf=paidmails" target="_self"><b>'.$ka['paidmails'].'</b></a>';

	if ($db->numrows($kampagne1) >= 1) {
		if ($linecolor == '#FDF5E7') {
		$linecolor = '#FCEED5';
		} else {
		$linecolor = '#FDF5E7';
		}

     $kampagne_out = array(
      'linecolor' => $linecolor,
      'forcedbanner' => $ka['forcedbanner'],
      'bannerklicks' => $ka['bannerklicks'],
      'bannerviews' => $ka['bannerviews'],
      'buttonklicks' => $ka['buttonklicks'],
      'buttonviews' => $ka['buttonviews'],
      'surfbarklicks' => $ka['surfbarklicks'],
      'surfbarviews' => $ka['surfbarviews'],
      'textlinkklicks' => $ka['textlinkklicks'],
      'textlinkviews' => $ka['textlinkviews'],
      'paidmails' => $ka['paidmails'],
      'nickname' => $user_output['nickname']
    );
$kampagne_outputs[] = $kampagne_out;
	}
}

$smarty->assign('kampagne',$kampagne_outputs); 

$smarty->display('admin/kamp_uebersicht.tpl');
?>