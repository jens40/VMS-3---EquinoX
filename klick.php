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
* Datei: klick.php
*******************************************************************************/

define("_VALID_PHP", true);
/* Laden der globalen Funktionen */
require('./include/global.php');
$bid = Request::get('bid');
$tos = Request::get('tos');
/* Top-Frameset für Paid4 */
function checkframe($msg,$warten) {
global $mainconfig,$kampagne_output;
$bid = Request::get('bid');
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
';

echo '
<head>
<link rel="stylesheet" href="./themes/default/css/style.css" type="text/css">
<style type="text/css">
body {
margin-top:0;
margin-bottom:0;
margin-left:5;
margin-right:5;
}
</style>
';
if ($warten == 1) echo '<meta http-equiv="refresh" content="'.($kampagne_output['aufendhalt']+1).';url=klick.php?bid='.$bid.'&do=yes&gun='.md5(time()).''.$kampagne_output['aufendhalt'].''.md5($kampagne_output['url_ziel']).'">';
echo'
</head>
<body topmargin="0" leftmargin="0">
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="left">
<tr>
<td align="left" width="50%" height="20" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;<b>'.$mainconfig['seitenname'].' ist für den Inhalt nicht verantwortlich.</b></td>
<td align="right" width="50%" height="20" valign="middle"><b>'.$msg.'</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
</body>
</html>
';
}

/* Bannerladen und Werbeform feststellen */
$kampagne = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE kampagnen_id = '".sanitize($bid)."' AND format = 'forcedbanner' AND status = '1' LIMIT 1");

	/* Script abbrechen wenn Kampagne nicht gefunden wurde */
	if (!$db->numrows($kampagne)) {
	$msg = 'Kampagne nicht gefunden!';
	checkframe($msg,0);
	die();
	} else {
	$kampagne_output = $db->fetch($kampagne);
	}

/* Set-TOS-Code */
if (Filter::$do == 'make_tos') {
$_SESSION['fk_'.$bid] = $tos;
header("location:".$kampagne_output['url_ziel']);
die();
}

	/* Ausgabe der Forcedkampagnen */
	$reload_check = $db->query("SELECT uid FROM equinox_".$pageconfig['install_nr']."_reloads WHERE kampagnen_id = '".sanitize($kampagne_output['kampagnen_id'])."' AND uid='".sanitize($_SESSION['uid'])."' AND reload_bis >= '".time()."'");
	if ($db->numrows($reload_check)) {
	$msg = 'Kampagne noch im Reload!';
	checkframe($msg,0);
	die();
	}


/* Timersetzen */
if (Filter::$do == 'no') {
$msg = 'Bitte warte '.$kampagne_output['aufendhalt'].' Sekunden';
checkframe($msg,1);
die();
}

/* Klickprüfen und User vergüten */
if (Filter::$do == 'yes') {
	if ($_SESSION['fk_'.$bid] != md5($kampagne_output['url_ziel'])) {
	$msg = 'Ungültiger Aufruf!';
	checkframe($msg,0);
	die();
	}
	unset($_SESSION['fk_'.$bid]);
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_reloads (kampagnen_id,uid,ip,reload_bis) VALUES ('".sanitize($bid)."','".sanitize($_SESSION['uid'])."','".sanitize($_SERVER['REMOTE_ADDR'])."','".sanitize((time()+$kampagne_output['reload']))."')");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET forcedklicks = forcedklicks + 1, rangklicks = rangklicks + 1, forcedsumme = forcedsumme + '".sanitize($kampagne_output['payout'])."' WHERE nickname = '".sanitize($_SESSION['nickname'])."'");
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET do_clicks = do_clicks + 1 WHERE kampagnen_id = '".sanitize($bid)."'");
	kontoauszug('Intern',$_SESSION['nickname'],$kampagne_output['payout'],'Forceklick auf KID:'.$kampagne_output['kampagnen_id']);
	bilanz($kampagne_output['preis'],$kampagne_output['payout']);
    kontobuchung($_SESSION['nickname'],'+',$kampagne_output['payout'],$kampagne_output['payout'],$kampagne_output['payout'],1,0,$kampagne_output['payout']);
	$msg = 'Dir wurden '.number_format($kampagne_output['payout'],$mainconfig['nach_koma'],",",".").' '.$mainconfig['waehrungsname'].' gutgeschrieben!';
	checkframe($msg,0);
	die();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Forcedklick by <?php echo $mainconfig['seitenname'];?></title>
<script type="text/javascript">
if (top != self)
top.location = self.location;
</script>
</head>
<frameset rows="20,*" border="0">
<frame name="check" src="klick.php?bid=<?php echo $bid?>&do=no" scrolling="no" frameborder="0">
<frame name="<?php echo md5(time()+$bid);?>" src="klick.php?bid=<?php echo $bid;?>&do=make_tos&tos=<?php echo md5($kampagne_output['url_ziel']);?>" scrolling="auto" frameborder="0">
</frameset>
<body>
</body>
</html>
