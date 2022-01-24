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
* Datei: include/crons/zinszahlungen.php
*******************************************************************************/
/*                                            
   Formel zur Berechnung der Zinsen           
                                              
      Guthaben X Zinssatz X Tage              
      --------------------------= Zinsertrag  
             (100 X 360)                      
                                            */

/* Zinsdaten holen */
$x = 0;
$zinssaetze = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_zinssaetze ORDER BY zinspunkte_von ASC");
while ($zinssaetze_output = $db->fetch($zinssaetze)) {
$x++;
$zs[$x]['zp'] = $zinssaetze_output['zinspunkte_von'];
$zs[$x]['zs'] = $zinssaetze_output['zinssatz'];
$zs[$x]['mg'] = $zinssaetze_output['max_verzinsen'];
}

/* Kontomessung zur Sicherheit durchführen */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET knt_messungen = knt_messungen + 1 , knt_guthaben = knt_guthaben + (guthaben + tresorguthaben)");

/* User auslesen */
$zinsuser = $db->query("SELECT uid,nickname,knt_guthaben,knt_messungen,zinspunkte,guthaben,tresorguthaben FROM equinox_".$pageconfig['install_nr']."_user WHERE zinspunkte > 0");
$y = 1;
while ($zinsuser_output = $db->fetch($zinsuser)) {
$zinsuser_output['knt_guthaben'] = ($zinsuser_output['knt_guthaben'] / $zinsuser_output['knt_messungen']);

	for ($y;$y<=$x;$y++) {
		if ($zinsuser_output['zinspunkte'] >= $zs[$y]['zp']) {
		$zinssatz = $zs[$y]['zs'];
		$maxchash = $zs[$y]['mg'];
		}
	}

	if (($zinsuser_output['guthaben'] + $zinsuser_output['tresorguthaben']) < $zinsuser_output['knt_guthaben']) {
		if (($zinsuser_output['guthaben'] + $zinsuser_output['tresorguthaben']) <= $maxchash) {
		$zinsgutgaben = ($zinsuser_output['guthaben'] + $zinsuser_output['tresorguthaben']);
		} else {
		$zinsgutgaben = $maxchash;
		}
	} else {
		if (($zinsuser_output['guthaben'] + $zinsuser_output['tresorguthaben']) <= $maxchash) {
		$zinsgutgaben = $zinsuser_output['knt_guthaben'];
		} else {
		$zinsgutgaben = $maxchash;
		}
	}
/* Zinsenberechnen */
$zinsertrag = ($zinsgutgaben * $zinssatz * 1) / (100 * 360);

	/* User die Zinsen gutschreiben */
	if ($zinsertrag >= 0.001) {
	kontoauszug('Intern',$zinsuser_output['nickname'],$zinsertrag,'Zinsen ('.number_format($zinssatz,3,",",".").'% auf '.number_format($zinsgutgaben,2,",",".").')');
	kontobuchung($zinsuser_output['nickname'],'+',$zinsertrag,0,0,0,0,0);
	}

/* Variabeln nullen */
$zinsertrag = 0;
$y = 1;
$maxchash = 0;
$zinsgutgaben = 0;
$zinssatz = 0;
}

/* Kontomessungen zurücksetzen und Zinspunkte nullen */
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET zinspunkte = 0, knt_guthaben = 0, knt_messungen = 0")

?>