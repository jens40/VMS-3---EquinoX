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
* Datei: /include/system/config.php
*******************************************************************************/

/* Arrays definieren */
$pageconfig = array();

/* Datenbankserver */
$pageconfig['db_server']		= 'localhost';
/* Name der Datenbank */
$pageconfig['db_datenbank']		= 'vms3';
/* Username der Datenbank */
$pageconfig['db_user']			= 'root';
/* Passwort der Datenbank */
$pageconfig['db_passwort']		= '';
/* Installationsnummer */
$pageconfig['install_nr']		= '1';
/* Forcedklicksperre */
$ak_stoper						= 251;
date_default_timezone_set("Europe/Berlin");
setlocale(LC_TIME, "de_DE");
?>
