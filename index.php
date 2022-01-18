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
* Datei: index.php
*******************************************************************************/
define("_VALID_PHP", true);
/* Laden der globalen Funktionen */
require('./include/global.php');
/* Seite über den internen Puffer senden */
check_obstart();

// Doppelaccounts aufzeichnen 
if (!empty($userdaten['nickname']) && $userdaten['d_acc'] == 0) {
	if (!empty($_COOKIE['olduser'])) {
		if ($_COOKIE['olduser'] != $userdaten['nickname']) {
		$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_doppelaccounts (zeit,von,zu) VALUES ('".sanitize(time())."','".sanitize($_COOKIE['olduser'])."','".sanitize($userdaten['nickname'])."')");
		setcookie ("olduser", $userdaten['nickname'], time()+3600*24*360);
 		}
	} else { 
	setcookie ("olduser", $userdaten['nickname'], time()+3600*24*360);
	}
}

if (!empty($_SESSION['login']) && $_SESSION['login'] == 'true'){
$neuenachrichten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_nachrichten WHERE an='".sanitize($_SESSION['nickname'])."' AND status='0'");
if($db->numrows($neuenachrichten)) $neue="<font
color='#009900'>Eingang</font>";
else $neue="keine";    
$anmelde = $db->query("SELECT uid, nickname, anmeldezeit FROM equinox_".$pageconfig['install_nr']."_user ORDER BY anmeldezeit DESC LIMIT 1");
while ($row = $db->fetch($anmelde)) {
     $anmelde_out = array(
      'nickname' => $row['nickname'],
      'uid' => $row['uid'],
      'anmeldezeit' => date("d.m.Y",$row['anmeldezeit'])
    );    
} 

$wioTime = 3 * 60;                        // Sekunden seit der letzten Aktivität
// URL, die verlinkt werden soll
$wioNickpage = $mainconfig['seitenurl']."/?content=user/nickpage&shownick=";
$wioOnline = $db->query("SELECT uid,nickname,admin FROM equinox_".$pageconfig['install_nr']."_user WHERE aktivzeit >= ".(time() - $wioTime)." ORDER BY uid");
$wioTotal = 0;
$ausgabe = '';
while ($wioIsOnline = $db->fetch($wioOnline))
{
  if ($wioTotal > 0) $ausgabe .= ', ';
  
  //Nicknamen holen
  $userdaten = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE uid=".$wioIsOnline['uid'].""));
  
  if ($wioIsOnline['admin'] == 1)
  {
    if (!empty ($wioNickpage)) $ausgabe .= '<a style="font-weight:bold;" href="'.$wioNickpage.$wioIsOnline["nickname"].'">';
  }
  else
  {
    if (!empty ($wioNickpage)) $ausgabe .= '<a href="'.$wioNickpage.$wioIsOnline["nickname"].'">';
  }
  if (empty($userdaten["nickname"])) 
  {
	$userdaten["nickname"]=$wioIsOnline["uid"];                     
  }
  $ausgabe .= $userdaten["nickname"];

  if (!empty ($wioNickpage)) $ausgabe .= '</a>';  
  
     $wioIsOnline_out = array(
      'ausgabe' => $ausgabe
    );  
  
 $wioTotal++; 

}
      

$wioIsOnline_outs[] = $wioIsOnline_out;
$smarty->assign('wioIsOnline_out',$wioIsOnline_outs);   
$anmelde_outs[] = $anmelde_out;
$smarty->assign('anmelde_out',$anmelde_outs);    
$smarty->assign('neue',$neue);    
$smarty->assign('guthaben',number_format($userdaten['guthaben'],2,",","."));
$smarty->assign('tresorguthaben',number_format($userdaten['tresorguthaben'],2,",","."));
}


$smarty->assign('load_button_3',load_button(3));
$smarty->assign('load_fullbanner_1',load_fullbanner(1));
$smarty->assign('phpversion',$phpversion);
$smarty->assign('parsetime',parsetime($parsestart));

isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
/* Laden des Contents */
require_once('include/content/'.Filter::$content.'.php');

/* Diesen Code nicht ändern oder löschen */
/*    Don't remove or edit this Code     */
dsn_copyright($mainconfig['lizenzkey']);
/* ------------------------------------- */
ob_end_flush();
?>

