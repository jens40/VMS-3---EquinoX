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
* Datei: include/crons/sendmail.php
*******************************************************************************/

$db->query("TRUNCATE TABLE equinox_".$pageconfig['install_nr']."_mailcounter");
$ms = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE status = '1' ORDER BY RAND() LIMIT 100");
while ($ms_output =  $db->fetch($ms)) {
sendmail($ms_output['mailtext'],$ms_output['email'],$ms_output['mailtitel']);
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_mailquery SET status = '0' WHERE mid = '".sanitize($ms_output['mid'])."'");
}
?>