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
* Datei: content/user/buchungssystem.php
*******************************************************************************/
$_SESSION['AdminID'] = "Dein User-Nickname";

/* Seite sichern */
access();

if($_GET['gonachricht']=="eingang")
{
	?>
	<h1>Nachrichten: Eingang</h1>
	<div align="center">&raquo;<a href="?content=/user/nachrichten&gonachricht=einsgang&anzeigen=<?=$_GET['anzeigen']-25;?>"><b><font color='#009900'>Eine Seite zurück</font></b></a>&laquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;<a href="?content=/user/nachrichten&gonachricht=eingang&anzeigen=<?=$_GET['anzeigen']+25;?>"><b><font color='#009900'>Eine Seite vor</font></b></a>&laquo;</div>
	<br>
	<table class="tI" width="480" cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td align="center" width="40">Status</td>
		<td align="center" width="100">Von</td>
		<td align="center" width="230">Betreff</td>
		<td align="center" width="60">Datum</td>
		<td align="center" width="40">Löschen</td>
	</tr>
	<?php
	if(!addslashes($_GET['anzeigen'])) $anzahl="0";
	else $anzahl=addslashes($_GET['anzeigen']);
	$nachrichten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_nachrichten WHERE an='".$_SESSION['nickname']."' ORDER BY zeit DESC LIMIT ".$anzahl.",25");
	while($auszug = mysql_fetch_array($nachrichten))
	{
		if ($linecolor == $wf1) $linecolor = $wf2;
		else $linecolor = $wf1;
		if(!$auszug['status']) $status = '<img src="images/ungelesen.gif" border="0" alt="Ungelesen">';
		else $status = '<img src="images/gelesen.gif" border="0" alt="Gelesen">';
		echo '
		<tr bgcolor="'.$linecolor.'">
		<td align="center" width="40">'.$status.'</td>
		<td align="center" width="100"><a href="?content=user/nickpage&shownick='.$auszug['von'].'">'.$auszug['von'].'</a></td>
		<td align="center" width="230"><a href="?content=user/nachrichten&gonachricht=lesen&id='.$auszug['id'].'">'.$auszug['betreff'].'</a></td>
		<td align="center" width="60">'.date("d.m.Y",$auszug['zeit']).'<br>'.date("H:i:s",$auszug['zeit']).'</td>
		<td align="center" width="40"><a href="?content=user/nachrichten&gonachricht=del&id='.$auszug['id'].'"><img src="images/del.gif" border="0" alt="Löschen"></a></td>
		</tr>
		';
	}
	echo "</table>";
}
elseif($_GET['gonachricht'] == "ausgang")
{
	?>
	<h1>Nachrichten: Ausgang</h1>
	<div align="center">&raquo;<a href="?content=/user/nachrichten&gonachricht=ausgang&anzeigen=<?=$_GET['anzeigen']-25;?>"><b><font color='#009900'>Eine Seite zurück</font></b></a>&laquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;<a href="?content=/user/nachrichten&gonachricht=ausgang&anzeigen=<?=$_GET['anzeigen']+25;?>"><b><font color='#009900'>Eine Seite vor</font></b></a>&laquo;</div>
	<br>
	<table class="tI" width="480" cellpadding="1" cellspacing="1" border="0" align="center">
	<tr>
		<td align="center" width="40">Status</td>
		<td align="center" width="100">An</td>
		<td align="center" width="270">Betreff</td>
		<td align="center" width="60">Datum</td>
	</tr>
	<?php
	if(!addslashes($_GET['anzeigen'])) $anzahl="0";
	else $anzahl=addslashes($_GET['anzeigen']);
	$nachrichten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_nachrichten WHERE von='".$_SESSION['nickname']."' ORDER BY zeit DESC LIMIT ".$anzahl.",25");
	while($auszug = mysql_fetch_array($nachrichten))
	{
		if ($linecolor == $wf1) $linecolor = $wf2;
		else $linecolor = $wf1;
		if(!$auszug['status']) $status = '<img src="images/ungelesen.gif" border="0" alt="Ungelesen">';
		else $status = '<img src="images/gelesen.gif" border="0" alt="Gelesen">';
		echo '
		<tr bgcolor="'.$linecolor.'">
		<td align="center" width="40">'.$status.'</td>
		<td align="center" width="100"><a href="?content=user/nickpage&shownick='.$auszug['an'].'">'.$auszug['an'].'</a></td>
		<td align="center" width="270">'.$auszug['betreff'].'</td>
		<td align="center" width="60">'.date("d.m.Y",$auszug['zeit']).'<br>'.date("H:i:s",$auszug['zeit']).'</td>
		</tr>
		';
	}
	echo "</table>";
}
elseif($_POST['gonachricht'] == "Senden")
{
	if($_POST['betreff'] AND $_POST['inhalt'] AND $_POST['an'])
	{
		# check ob user vorhanden ist
		$db_nickname = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname='".$_POST['an']."'");
		if(!mysql_num_rows($db_nickname))
		{
			$meldung0 = "<font color='#CC0000'>Nickname (<font color='#000000'>".$_POST['an']."</font>) führen wir nich in der Datenbank!</font><br>";
		}
		else
		{
			$meldung0 = "<font color='#009900'>Deine nachricht wurde versand...</font>";
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_nachrichten (an,von,betreff,inhalt,zeit) VALUES ('".$_POST['an']."','".$_SESSION['nickname']."','".$_POST['betreff']."','".$_POST['inhalt']."','".time()."')");
		}
		if($_POST['an']=="*" AND $_SESSION['nickname']==$_SESSION['AdminID'])
		{
			$kontodaten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user");
			while ($ausgabe = mysql_fetch_array($kontodaten))
			{
				$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_nachrichten (an,von,betreff,inhalt,zeit) VALUES ('".$ausgabe['nickname']."','".$_SESSION['nickname']."','".$_POST['betreff']."','".$_POST['inhalt']."','".time()."')");
			}
			$meldung0 = "<font color='#009900'>Deine nachricht wurde versand...</font>";
		}
	}
	else
	{
		if(!$_POST['betreff'])	$meldung1 = "<font color='#CC0000'>kein Betreff angegeben!</font><br>";
		else					$meldung1 = "";
		if(!$_POST['inhalt'])	$meldung2 = "<font color='#CC0000'>kein Inhalt eingetragen!</font><br>";
		else					$meldung2 = "";
		if(!$_POST['an'])		$meldung3 = "<font color='#CC0000'>kein Nickname angegeben!</font><br>";
		else					$meldung3 = "";
	}
	echo "
	<h1>Nachrichten: Senden</h1>
	<center>
	";
	echo $meldung0;
	echo $meldung1;
	echo $meldung2;
	echo $meldung3;
	echo "</center>";
	echo "
	<br>
	&laquo;&nbsp;<a href='?content=user/nachrichten&gonachricht=eingang' target='_self' class='menue'>Zurück</a><br>
	<meta http-equiv='refresh' content='1;url=?content=user/nachrichten&gonachricht=eingang'>";
}
elseif($_GET['gonachricht'] == "lesen")
{
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_nachrichten SET status=1 WHERE an='".$_SESSION['nickname']."' AND id='".$_GET['id']."'");
	$_GET['gonachricht']="";
	$nachrichten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_nachrichten WHERE an='".$_SESSION['nickname']."' AND id='".$_GET['id']."' ORDER BY zeit DESC");
	$auszug = mysql_fetch_array($nachrichten);
	$nachrichteninhalt = '<textarea cols="74" rows="9" name="oinhalt" readonly wrap="hard" style="scrollbar:0;">'.$auszug['inhalt'].'</textarea>';
	echo "<h1>Von: ".$auszug['von']." - Betreff: ".$auszug['betreff'];
	echo $nachrichteninhalt;

	echo '
	<h1>'.$auszug['von'].' eine Antwort schreiben</h1>
	<form action="" method="post" style="display:inline">
	<input type="hidden" name="id" value="'.$auszug['id'].'">
	<input type="hidden" name="an" value="'.$auszug['von'].'">
	Betreff: <input type="text" name="betreff" value="re: '.$auszug['betreff'].'">
	<center>
	<textarea cols="74" rows="9" name="inhalt" style="scrollbar:0;"></textarea>
	<input type="Submit" name="gonachricht" value="Senden">
	</center>
	</form>
	';
}
elseif($_GET['gonachricht'] == "schreiben")
{
$smarty->assign('message',Filter::$showMsg);
$smarty->display('nachricht_schreiben.tpl');
}
elseif($_GET['gonachricht'] == "del")
{
	if($db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_nachrichten WHERE  id='".$_GET['id']."' AND an='".$_SESSION['nickname']."'"))
	{
		$meldung = "
		<center><font color='#009900'>Nachricht wurde gelöscht!</font></center>
		";
	}
	else
	{
		$meldung = "
		<center><font color='#CC0000'>Du hast keine Berechtigung um diese Nachricht zu löschen!</font></center>
		<br>
		&laquo;&nbsp;<a href='?content=user/nachrichten&gonachricht=eingang' target='_self' class='menue'>Zurück</a><br>
		";
	}
	echo "<h1>Nachrichten: Löschen</h1>";
	echo $meldung;
	echo "
	<br>
	&laquo;&nbsp;<a href='?content=user/nachrichten&gonachricht=eingang' target='_self' class='menue'>Zurück</a><br>
	<meta http-equiv='refresh' content='0;url=?content=user/nachrichten&gonachricht=eingang'>";
}