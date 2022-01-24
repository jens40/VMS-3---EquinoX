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
$sponsordaten = "";

/* Konfiguration laden */
$interfacedaten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_interface WHERE interface = 'adcocktail' AND werbeart = 'forcedbanner'");
$interfacedaten = $db->fetch($interfacedaten);

/* Einlesen der Kampagnen */
$get = @_file("www.adcocktail.com",80,"sc/kas/kas_tt.php?u_id=".$interfacedaten['betreiber']."&verguetung=".$interfacedaten['mindestverguetung']."&uebrig=".$interfacedaten['restklicks']."&u_mode=on&k_pass=".$interfacedaten['pass']);


/* Trafic von Adcocktail deaktivieren */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_traffic SET status = '0' WHERE sponsor = 'adcocktailT'");


//RETURNCODE|kid1|kname1|kreload1|wid1|krest1|kvergütung1|kid2|kname2|...
	$data = explode("|",$get);
	for($i=0;$i<(count($data)/6);$i++) { 
$int_ziel = "http://tt.adcocktail.com/tt.php?uid=".$interfacedaten['betreiber']."&wid=".$data[($i*6)+3]."&wsid=".$interfacedaten['seite']."";    
$int_menge	= round($data[($i*6)+4]);
$int_kid		= $data[($i*6)+0];
$int_reload	= $data[($i*6)+2]*3600;
$int_verdienst	= ($data[($i*6)+5]*$interfacedaten['umrechnung']) - (($data[($i*6)+5]*$interfacedaten['umrechnung']) / 100 * $interfacedaten['eigenverdienst']);
$ext_verguetung= $data[($i*6)+5];
$int_tan		= substr(md5(microtime()),0,32);
	/* Kampagnen ändern oder eintragen */
	$int_menge = @round($int_menge/$interfacedaten['restklicks']);
	if ($ext_verguetung >= $interfacedaten['mindestverguetung'] and $int_menge > 1) {
		$forcedbanner_check = $db->query("SELECT status FROM equinox_".$pageconfig['install_nr']."_traffic WHERE sponsor = 'adcocktailT' and kid='".$int_kid."'");
			if (!$db->numrows($forcedbanner_check)) {
			$db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_traffic (tan,kid,link,verguetung,aufendhalt,gebucht,reloadsperre,sponsor) VALUES ('".$int_tan."','".$int_kid."','".$int_ziel."','".$int_verdienst."','".$interfacedaten['aufendhalt']."','10000','".$int_reload."','adcocktailT')");
			} else {
			$db->query("UPDATE equinox_".$pageconfig['install_nr']."_traffic SET status='1' , gebucht='".$int_menge."' , verguetung='".$int_verdienst."' , aufendhalt='".$interfacedaten['aufendhalt']."' WHERE sponsor='adcocktailT' and kid='".$int_kid."' and status='0'");
			}
	}
}
// Abgelaufene löschen
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_traffic WHERE sponsor = 'adcocktailT' and status = '0'");
?>
