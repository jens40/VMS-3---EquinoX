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
* Datei: content/cash/surf.php
*******************************************************************************/
/* Seite sichern */
access();
$percode	= "4123fas13412c31231";
$hinweis	= $mainconfig['seitenname']." ist für den Inhalt der gezeigten Seiten nicht verantwortlich!";
$referer = $mainconfig['seitenurl']."/index.php?content=cash/surf4";
if($_SERVER['HTTP_REFERER']=="" OR $_SERVER['HTTP_REFERER']!=$referer)
{

	?>
	<html>
	<head>
	</head>
	<BODY TOPMARGIN='0' LEFTMARGIN='0' MARGINWIDTH='0' MARGINHEIGHT='0'>
	<center><font color='#CC0000'><b>Ungültiger Aufruf!!!</b></font></center>
	</body>
	</html>
	<?php
	die();
}
$ip = $_SERVER['REMOTE_ADDR'];
// Variabeln definieren
if (!isset($headmsg))			$headmsg				= "";
if (!isset($puk))				$puk					= "";
if (!isset($force_error))		$force_error			= "";
if (!isset($wartezeit))			$wartezeit			= "";
if (!isset($_SESSION['uid']))		$_SESSION['uid']		= "";
if (!isset($forced['aufendhalt']))	$forced['aufendhalt']	= "";
// Werbedaten auslesen
$forcedA = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_traffic WHERE tan='".sanitize($_SESSION['tan'])."'");
$forced=$db->fetch($forcedA);
// Reloadprüfen
if ($forcedA)
{
	// userreloadsperre eingefügt
	$reloads = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_traffic_reload WHERE (uid='".sanitize($_SESSION['uid'])."' or ip='".sanitize($ip)."') and tan='".sanitize($forced['tan'])."' and reload_bis > ".sanitize(time())."");
	if (!$db->numrows($reloads))
	{
		$wartezeit = $forced['aufendhalt'];
		$headmsg = 'Vergütung in '.$forced['aufendhalt'].' Sek.!';
		$puk = md5($_SESSION['uid'].''.$forced['aufendhalt'].''.date("H",time()).''.$percode);
	}
	else
	{
		$headmsg = 'Traffic noch im Reload!';
		$force_error = 'true';
	}
}
else
{
	$headmsg = 'Werbetan nicht bekannt!';
	$force_error = 'true';
}

// User bezahlen und Reload schreiben
if($_SESSION['auszahlen']=='true' && $force_error!='true' AND time()>=$_SESSION['vgt'])
{
	if ($_SESSION['uid'] >= 1)
	{
		$new_reload = time()+$forced['reloadsperre'];
		$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_traffic_reload (ip,uid,tan,reload_bis) VALUES ('".sanitize($ip)."','".sanitize($_SESSION['uid'])."','".sanitize($forced['tan'])."','".sanitize($new_reload)."')");
		$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user  SET trafficseiten=trafficseiten+1, trafficsumme=trafficsumme+".sanitize($forced['verguetung'])." WHERE uid = '".sanitize($_SESSION['uid'])."'");
		kontobuchung($_SESSION['nickname'],'+',$forced['verguetung'],$forced['verguetung'],$forced['verguetung'],0,0,$forced['verguetung']);
		$_SESSION['tan'] = "";
		$_SESSION['puk'] = "";
		$_SESSION['auszahlen'] = "";
	}
	else
	{
		$headmsg = 'Leider bist Du nicht eingeloggt!';
	}
}
else
{
	if ($_SESSION['auszahlen'] == 'true' && $force_error != 'true') $headmsg = 'Pin abgelaufen!';
}


###########
# ausgabe #
###########
# traffic suchen
$trafficseite = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_traffic WHERE status='1' and sponsor!='".sanitize($_SESSION['uid'])."' ORDER BY verguetung DESC");
$numT=$db->numrows($trafficseite);
$numR = 0;
$surf4=0;
$kampagne=0;
while($t_seite=$db->fetch($trafficseite))
{
	$int_reload = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_traffic_reload WHERE tan='".sanitize($t_seite['tan'])."' and  uid='".sanitize($_SESSION['uid'])."' or tan='".sanitize($t_seite['tan'])."' and ip='".sanitize($ip)."'");
	if(!$db->numrows($int_reload) AND !$kampagne)
	{
		$kampagne=1;
		$surf4=1;
		$vg="<font color='#008000'>".$t_seite['verguetung']."</font> ".$mainconfig['waehrungsname'];
		$wartezeit=$t_seite['aufendhalt'];
		$_SESSION['tan'] = $t_seite['tan'];
		$_SESSION['vgt'] = time()+$t_seite['aufendhalt'];
		$_SESSION['puk'] = md5($_SESSION['uid'].''.$t_seite['aufendhalt'].''.date("H",time()).''.$percode);
		$_SESSION['auszahlen'] = "true";
		$weiterleitung = "index.php?content=cash/surf";
		$tseite=$t_seite['link'];
	}
	elseif($db->numrows($int_reload))
	{
		$numR++;
	}
}
$seitenanzahl	= "<font color='#CC0000'>".$numR."</font> von <font color='#009900'>".$numT."</font> im Reload";

$smarty->assign('seitenanzahl',$seitenanzahl);
$smarty->assign('surf4',$surf4);
$smarty->assign('vg',$vg);
$smarty->assign('hinweis',$hinweis);
$smarty->assign('wartezeit',$wartezeit);
$smarty->assign('weiterleitung',$weiterleitung);
$smarty->assign('tseite',$tseite);
$smarty->display('surf.tpl');
?>
