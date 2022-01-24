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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title><?php echo $mainconfig['seitenname']?></title>
</head>
<script language="JavaScript">
if(top.frames.length > 0)
top.location.href=self.location;
</script>
<frameset rows="36,*" border="0">
<frame name="myframe" src="index.php?content=cash/surf" scrolling="no" frameborder="0">
<frame name="werbung" src="" scrolling="auto" frameborder="0">
</frameset>
</body>
</html>
