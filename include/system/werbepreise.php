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
* Datei: include/system/werbepreise.php
*******************************************************************************/

/* Laden der Werbepreise aus der Datenbank */
$wp = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_werbepreise WHERE id = '".$pageconfig['install_nr']."' LIMIT 1");
$wp_output = $db->fetch($wp);

/* Gebühren und Rabatte */
$gebuehr['betreiber']				=   $wp_output['gebuehr_betreiber'];
$gebuehr['storno']					=   $wp_output['gebuehr_storne'];
$rabatt[0]							=   $wp_output['rabatt_0'];
$rabatt[1]							=   $wp_output['rabatt_1'];
$rabatt[2]							=   $wp_output['rabatt_2'];
$rabatt[3]							=   $wp_output['rabatt_3'];
$rabatt[4]							=   $wp_output['rabatt_4'];
$rabatt[5]							=   $wp_output['rabatt_5'];
$minbuchung							=   $wp_output['minbuchung'];

/* Grundpreise */
$grundpreis['forcedbanner']			=   $wp_output['grundpreis_forcedbanner'];
$grundpreis['bannerviews']			=   $wp_output['grundpreis_bannerviews'];
$grundpreis['bannerklicks']			=   $wp_output['grundpreis_bannerklicks'];
$grundpreis['buttonviews']			=   $wp_output['grundpreis_buttonviews'];
$grundpreis['buttonklicks']			=   $wp_output['grundpreis_buttonklicks'];
$grundpreis['surfbarviews']			=   $wp_output['grundpreis_surfbarviews'];
$grundpreis['surfbarklicks']		=   $wp_output['grundpreis_surfbarklicks'];
$grundpreis['textlinkviews']		=   $wp_output['grundpreis_textlinkviews'];
$grundpreis['textlinkklicks']		=   $wp_output['grundpreis_textlinkklicks'];
$grundpreis['paidmails']			=   $wp_output['grundpreis_paidmails'];

/* Zuschläge */
$reloadpreis[1]						=   $wp_output['reloadpreis_1'];
$reloadpreis[2]						=   $wp_output['reloadpreis_2'];
$reloadpreis[4]						=   $wp_output['reloadpreis_4'];
$reloadpreis[8]						=   $wp_output['reloadpreis_8'];
$reloadpreis[12]					=   $wp_output['reloadpreis_12'];
$reloadpreis[16]					=   $wp_output['reloadpreis_16'];
$reloadpreis[20]					=   $wp_output['reloadpreis_20'];
$reloadpreis[24]					=   $wp_output['reloadpreis_24'];

/* Aufendhaltszuschläge */
$aufendhaltspreis[0]				=   $wp_output['aufendhaltspreis_0'];
$aufendhaltspreis[5]				=   $wp_output['aufendhaltspreis_5'];
$aufendhaltspreis[10]				=   $wp_output['aufendhaltspreis_10'];
$aufendhaltspreis[15]				=   $wp_output['aufendhaltspreis_15'];
$aufendhaltspreis[20]				=   $wp_output['aufendhaltspreis_20'];
$aufendhaltspreis[25]				=   $wp_output['aufendhaltspreis_25'];
$aufendhaltspreis[30]				=   $wp_output['aufendhaltspreis_30'];
$aufendhaltspreis[45]				=   $wp_output['aufendhaltspreis_45'];
$aufendhaltspreis[60]				=   $wp_output['aufendhaltspreis_60'];
?>