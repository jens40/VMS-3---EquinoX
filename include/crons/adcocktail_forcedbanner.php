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
* Datei: include/crons/adcocktail_forcedbanner.php
*******************************************************************************/
/* Sponsorendaten löschen */
$file = "";

/* Konfiguration laden */
$interfacedaten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_interface WHERE interface = 'adcocktail' AND werbeart = 'forcedbanner'");
$interfacedaten = $db->fetch($interfacedaten);

/* Forcedbanner von Werbekrise deaktivieren */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET status = '0' WHERE format = 'forcedbanner' AND bemerkung LIKE 'adcocktail_%'");

/* Einlesen der Kampagnen */
$fp=@fopen("http://www.adcocktail.com/sc/kas/kas_fk.php?u_id=".$interfacedaten['betreiber']."&k_pass=".$interfacedaten['pass']."&k_v=".$interfacedaten['mindestverguetung']."&k_rest=".$interfacedaten['restklicks']."","r");
if($fp){
   while($line=fgets($fp,1000)){
   $file.=$line;
   }
   fclose($fp);
}

$errorcode = substr($file,0,4);

if($errorcode == '9000'){
$file = substr($file,5);
$code = explode("|", $file);
$count = count($code);
$nr= 0;

for ($i=0; $i < $count-6; $i=$i+7) {
$wid = $code[$i+3];    
$int_banner = "https://fk.adcocktail.com/fk_v.php?uid=".$interfacedaten['betreiber']."&wid=".$wid."&wsid=".$interfacedaten['seite']."";
$int_ziel = "https://fk.adcocktail.com/fk_k.php?uid=".$interfacedaten['betreiber']."&wid=".$wid."&wsid=".$interfacedaten['seite']."";
$int_menge       = round($code[$i+4]);
$int_kid		= $code[$i];
$int_reload		= $code[$i+2]*3600;
$int_verdienst	= ($code[$i+5]*$interfacedaten['umrechnung']) - (($code[$i+5]*$interfacedaten['umrechnung']) / 100 * $interfacedaten['eigenverdienst']);
$int_preis		= $code[$i+5]*$interfacedaten['umrechnung'];
$ext_verguetung	= $code[$i+5];
$int_dauer		= $code[$i+6]+$interfacedaten['aufendhalt'];
$tab_name = substr($int_ziel,35,999);
$aufenthalt = $code[$i+6]+$interfacedaten['aufendhalt'];
$nr++;

$forcedbanner_check = $db->query("SELECT status FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE format = 'forcedbanner' AND bemerkung = 'adcocktail_".sanitize($int_kid)."'");
if (!$db->numrows($forcedbanner_check)) {
	$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_kampagnen (userid,format,do_views,do_clicks,in_views,in_clicks,reload,url_banner,url_ziel,name,bemerkung,payout,aufendhalt,status,preis) VALUES ('0','forcedbanner','0','0','0','".sanitize($int_menge)."','".sanitize($int_reload)."','".sanitize($int_banner)."','".sanitize($int_ziel)."','Ext. Kampagnen','adcocktail_".sanitize($int_kid)."','".sanitize($int_verdienst)."','".sanitize($aufenthalt)."','1','".sanitize($int_preis)."')");
	} else {
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET aufendhalt = '".sanitize($aufenthalt)."', reload = '".sanitize($int_reload)."', do_views = '0', do_clicks = '0', in_views = '0', in_clicks = '".sanitize($int_menge)."', payout = '".sanitize($int_verdienst)."', status = '1', preis ='".sanitize($int_preis)."' WHERE format = 'forcedbanner' AND bemerkung = 'adcocktail_".sanitize($int_kid)."'");
}
}
}
?>