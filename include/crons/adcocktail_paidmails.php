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
* Datei: include/crons/adcocktail_paidmails.php
*******************************************************************************/
/* Sponsorendaten löschen */
$file = "";

/* Konfiguration laden */
$interfacedaten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_interface WHERE interface = 'adcocktail_m' AND werbeart = 'paidmails'");
$interfacedaten = $db->fetch($interfacedaten);

/* Paidmails von Adcocktail deaktivieren */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_kampagnen SET status = '0' WHERE format = 'paidmails' AND bemerkung LIKE 'adcocktail_%'");

/* Einlesen der Kampagnen */
$fp=@fopen("https://www.adcocktail.com/sc/kas/kas_pm.php?u_id=".$interfacedaten['betreiber']."&k_pass=".$interfacedaten['pass']."&k_v=".$interfacedaten['mindestverguetung']."&k_rest=".$interfacedaten['restklicks']."&k_mamax=99","r");

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

for ($i=0; $i < $count-7; $i=$i+8) {

$wid = $code[$i+3];
//$aufenthalt = $code[$i+7]+$ifdaten[paidbanner_aufenthaltplus];
    
$int_ziel		 = "https://pm.adcocktail.com/pm.php?uid=".$interfacedaten['betreiber']."&wid=$wid&wsid=".$interfacedaten['seite']."";
$int_menge		= round($code[$i+5]);
$int_kid		= $code[$i];
$int_reload		= $code[$i+2]*3600;
$int_verdienst	= ($code[$i+6]*$interfacedaten['umrechnung']) - (($code[$i+6]*$interfacedaten['umrechnung']) / 100 * $interfacedaten['eigenverdienst']);
$int_preis		= $code[$i+6]*$interfacedaten['umrechnung'];
$int_aufendhalt	= $code[$i+7]+$interfacedaten['aufendhalt'];
$int_name		= $code[$i+1];
$int_text		= $code[$i+4];
$ext_verguetung	= $code[$i+6];

$int_text 		= stripslashes($int_text);
//$int_text		= str_replace("/","",$int_text);
$int_text		= str_replace('"','',$int_text);
$int_text		= str_replace("'","",$int_text);
$int_text		= ltrim($int_text);
$int_text		= rtrim($int_text);
$int_name 		= stripslashes($int_name);
$int_name 		= str_replace("/","",$int_name);
$int_name 		= str_replace('"','',$int_name);
$int_name 		= str_replace("'","",$int_name);
$int_name 		= ltrim($int_name);
$int_name 		= rtrim($int_name);

 /* Kampagnen eintragen */
 if ($ext_verguetung >= $interfacedaten['mindestverguetung']) {
  $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_kampagnen (userid,format,do_views,do_clicks,in_views,in_clicks,reload,url_ziel,text_mail,name,bemerkung,payout,aufendhalt,status,preis) VALUES ('0','paidmails','0','0','0','".sanitize($int_menge)."','".sanitize($int_reload)."','".sanitize($int_ziel)."','".sanitize($int_text)."','".sanitize($int_name)."','adcocktail_keine','".sanitize($int_verdienst)."','".sanitize($int_aufendhalt)."','1','".sanitize($int_preis)."')");
 }

}
}
/* Abgelaufene Kampagnen löschen wenn gewünscht */
if ($interfacedaten['loeschen'] == 1) {
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE format = 'paidmails' AND bemerkung LIKE 'adcocktail_%' AND status = '0'");
}
?>