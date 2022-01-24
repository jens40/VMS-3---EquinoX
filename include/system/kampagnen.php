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
* Datei: include/system/kampagnen.php
*******************************************************************************/

function load_fullbanner($menge) {
global $pageconfig,$db,$_SESSION,$userdaten,$mainconfig;
$kampmenge = 0;
$ausgabe = false;
	$kampange = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE status = '1' AND ((format = 'bannerklicks' and do_clicks < in_clicks) or (format = 'bannerviews' and do_views < in_views)) ORDER BY RAND()");
	while ($kampange_output = $db->fetch($kampange)) {
	$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
    $reloads = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE (ip = '".$_SERVER['REMOTE_ADDR']."' or uid = '".$uid."') and kampagnen_id = '".$kampange_output['kampagnen_id']."' and reload_bis > '".time()."'");
		if (!$db->numrows($reloads)) {
		$ausgabe = 'true';
		$kampmenge++;
		$banner = '<a href="goto.php?bid='.$kampange_output['kampagnen_id'].'" target="_blank"><img src="'.$kampange_output['url_banner'].'" width="468" height="60" border="0" alt="'.$kampange_output['name'].'"></a>';
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_views = do_views + 1 WHERE kampagnen_id = '".$kampange_output['kampagnen_id']."'");
			if ($kampange_output['format'] == 'bannerviews') {
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,ip,reload_bis) VALUES ('".$kampange_output['kampagnen_id']."','".$_SERVER['REMOTE_ADDR']."','".(time()+$kampange_output['reload'])."')");
			}
			if ($kampmenge >= $menge) break;
		}
	}
	if ($ausgabe != 'true') {
	$banner = 'Kein Banner gefunden!';
	}
 return $banner;
}

function load_button($menge) {
global $pageconfig,$db,$_SESSION,$userdaten,$mainconfig;
$kampmenge = 0;
$ausgabe = false;
	$kampange = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE status = '1' AND ((format = 'buttonklicks' and do_clicks < in_clicks) or (format = 'buttonviews' and do_views < in_views)) ORDER BY RAND()");
	while ($kampange_output = $db->fetch($kampange)) {
	$reloads = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE (ip = '".$_SERVER['REMOTE_ADDR']."' or uid = '".$_SESSION['uid']."') and kampagnen_id = '".$kampange_output['kampagnen_id']."' and reload_bis > '".time()."'");
		if (!$db->numrows($reloads)) {
		$ausgabe = 'true';
		$kampmenge++;
		echo '<a href="goto.php?bid='.$kampange_output['kampagnen_id'].'" target="_blank"><img src="'.$kampange_output['url_banner'].'" width="88" height="31" border="0" alt="'.$kampange_output['name'].'"></a><br>';
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_views = do_views + 1 WHERE kampagnen_id = '".$kampange_output['kampagnen_id']."'");
			if ($kampange_output['format'] == 'buttonviews') {
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,ip,reload_bis) VALUES ('".$kampange_output['kampagnen_id']."','".$_SERVER['REMOTE_ADDR']."','".(time()+$kampange_output['reload'])."')");
			}
			if ($kampmenge >= $menge) break;
		}
	}
	if ($ausgabe != 'true') {
	$banner = 'Kein Banner gefunden!';
	}
  return $banner;
}

function load_surfbar($menge) {
global $pageconfig,$db,$_SESSION,$userdaten,$mainconfig;
$kampmenge = 0;
	$kampange = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE status = '1' AND ((format = 'surfbarklicks' and do_clicks < in_clicks) or (format = 'surfbarviews' and do_views < in_views)) ORDER BY RAND()");
	while ($kampange_output = $db->fetch($kampange)) {
	$reloads = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE (ip = '".$_SERVER['REMOTE_ADDR']."' or uid = '".$_SESSION['uid']."') and kampagnen_id = '".$kampange_output['kampagnen_id']."' and reload_bis > '".time()."'");
		if (!$db->numrows($reloads)) {
		$ausgabe = 'true';
		$kampmenge++;
		echo '<a href="goto.php?bid='.$kampange_output['kampagnen_id'].'" target="_blank"><img src="'.$kampange_output['url_banner'].'" width="468" height="60" border="0" alt="'.$kampange_output['name'].'"></a><br>';
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_views = do_views + 1 WHERE kampagnen_id = '".$kampange_output['kampagnen_id']."'");
			if ($kampange_output['format'] == 'surfbarviews') {
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,ip,reload_bis) VALUES ('".$kampange_output['kampagnen_id']."','".$_SERVER['REMOTE_ADDR']."','".(time()+$kampange_output['reload'])."')");
			}
			if ($kampmenge >= $menge) break;
		}
	}
	if ($ausgabe != 'true') {
	echo 'Kein Banner gefunden!';
	}
}

function load_textlink($menge) {
global $pageconfig,$db,$_SESSION,$userdaten,$mainconfig;
$kampmenge = 0;
	$kampange = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE status = '1' AND ((format = 'textlinkklicks' and do_clicks < in_clicks) or (format = 'textlinkviews' and do_views < in_views)) ORDER BY RAND()");
	while ($kampange_output = $db->fetch($kampange)) {
	$reloads = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_reloads WHERE (ip = '".$_SERVER['REMOTE_ADDR']."' or uid = '".$_SESSION['uid']."') and kampagnen_id = '".$kampange_output['kampagnen_id']."' and reload_bis > '".time()."'");
		if (!$db->numrows($reloads)) {
		$ausgabe = 'true';
		$kampmenge++;
		echo '<a href="goto.php?bid='.$kampange_output['kampagnen_id'].'" target="_blank">'.$kampange_output['text_link'].'</a><br>';
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_views = do_views + 1 WHERE kampagnen_id = '".$kampange_output['kampagnen_id']."'");
			if ($kampange_output['format'] == 'textlinkviews') {
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,ip,reload_bis) VALUES ('".$kampange_output['kampagnen_id']."','".$_SERVER['REMOTE_ADDR']."','".(time()+$kampange_output['reload'])."')");
			}
			if ($kampmenge >= $menge) break;
		}
	}
	if ($ausgabe != 'true') {
	echo 'Keine Kampagne gefunden!';
	}
}
?>