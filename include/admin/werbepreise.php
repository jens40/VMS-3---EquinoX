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
* Datei: include/admin/werbepreise.php
*******************************************************************************/
/* Laden der Werbepreise aus der Datenbank */
$wp = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_werbepreise WHERE id = '".$pageconfig['install_nr']."' LIMIT 1");
$wp_output = $db->fetch($wp);

/* Preise updaten */
if (Filter::$do == 'updaten') {
$gebuehr_betreiber = Request::post('gebuehr_betreiber');
$gebuehr_storne = Request::post('gebuehr_storne');
$minbuchung = Request::post('minbuchung');
$rabatt_0 = Request::post('rabatt_0');
$rabatt_1 = Request::post('rabatt_1');
$rabatt_2 = Request::post('rabatt_2');
$rabatt_3 = Request::post('rabatt_3');
$rabatt_4 = Request::post('rabatt_4');
$rabatt_5 = Request::post('rabatt_5');
$grundpreis_forcedbanner = Request::post('grundpreis_forcedbanner');
$grundpreis_bannerviews = Request::post('grundpreis_bannerviews');
$grundpreis_bannerklicks = Request::post('grundpreis_bannerklicks');
$grundpreis_buttonviews = Request::post('grundpreis_buttonviews');
$grundpreis_buttonklicks = Request::post('grundpreis_buttonklicks');
$grundpreis_surfbarviews = Request::post('grundpreis_surfbarviews');
$grundpreis_surfbarklicks = Request::post('grundpreis_surfbarklicks');
$grundpreis_textlinkviews = Request::post('grundpreis_textlinkviews');
$grundpreis_textlinkklicks = Request::post('grundpreis_textlinkklicks');
$grundpreis_paidmails = Request::post('grundpreis_paidmails');
$reloadpreis_1 = Request::post('reloadpreis_1');
$reloadpreis_2 = Request::post('reloadpreis_2');
$reloadpreis_4 = Request::post('reloadpreis_4');
$reloadpreis_8 = Request::post('reloadpreis_8');
$reloadpreis_12 = Request::post('reloadpreis_12');
$reloadpreis_16 = Request::post('reloadpreis_16');
$reloadpreis_20 = Request::post('reloadpreis_20');
$reloadpreis_24 = Request::post('reloadpreis_24');
$aufendhaltspreis_0 = Request::post('aufendhaltspreis_0');
$aufendhaltspreis_5 = Request::post('aufendhaltspreis_5');
$aufendhaltspreis_10 = Request::post('aufendhaltspreis_10');
$aufendhaltspreis_15 = Request::post('aufendhaltspreis_15');
$aufendhaltspreis_20 = Request::post('aufendhaltspreis_20');
$aufendhaltspreis_25 = Request::post('aufendhaltspreis_25');
$aufendhaltspreis_30 = Request::post('aufendhaltspreis_30');
$aufendhaltspreis_45 = Request::post('aufendhaltspreis_45');
$aufendhaltspreis_60 = Request::post('aufendhaltspreis_60');

    $data = array(
			'gebuehr_betreiber' => sanitize($gebuehr_betreiber),
            'gebuehr_storne' => sanitize($gebuehr_storne),
			'minbuchung' => sanitize($minbuchung),
			'rabatt_0' => sanitize($rabatt_0),            
 			'rabatt_1' => sanitize($rabatt_1),
            'rabatt_2' => sanitize($rabatt_2),
			'rabatt_3' => sanitize($rabatt_3),
			'rabatt_4' => sanitize($rabatt_4),
            'rabatt_5' => sanitize($rabatt_5),
            'grundpreis_forcedbanner' => sanitize($grundpreis_forcedbanner),
            'grundpreis_bannerviews' => sanitize($grundpreis_bannerviews),
            'grundpreis_bannerklicks' => sanitize($grundpreis_bannerklicks),
            'grundpreis_buttonviews' => sanitize($grundpreis_buttonviews),
            'grundpreis_buttonklicks' => sanitize($grundpreis_buttonklicks),
            'grundpreis_surfbarviews' => sanitize($grundpreis_surfbarviews),
            'grundpreis_surfbarklicks' => sanitize($grundpreis_surfbarklicks),
            'grundpreis_textlinkviews' => sanitize($grundpreis_textlinkviews),
            'grundpreis_textlinkklicks' => sanitize($grundpreis_textlinkklicks),
            'grundpreis_paidmails' => sanitize($grundpreis_paidmails),
            'reloadpreis_1' => sanitize($reloadpreis_1),
            'reloadpreis_2' => sanitize($reloadpreis_2),
            'reloadpreis_4' => sanitize($reloadpreis_4),
            'reloadpreis_8' => sanitize($reloadpreis_8),
            'reloadpreis_12' => sanitize($reloadpreis_12),
            'reloadpreis_16' => sanitize($reloadpreis_16),
            'reloadpreis_20' => sanitize($reloadpreis_20),
            'reloadpreis_24' => sanitize($reloadpreis_24),  
            'aufendhaltspreis_0' => sanitize($aufendhaltspreis_0),
            'aufendhaltspreis_5' => sanitize($aufendhaltspreis_5),  
            'aufendhaltspreis_10' => sanitize($aufendhaltspreis_10),
            'aufendhaltspreis_15' => sanitize($aufendhaltspreis_15),
            'aufendhaltspreis_20' => sanitize($aufendhaltspreis_20),
            'aufendhaltspreis_25' => sanitize($aufendhaltspreis_25),
            'aufendhaltspreis_30' => sanitize($aufendhaltspreis_30),
            'aufendhaltspreis_45' => sanitize($aufendhaltspreis_45),
            'aufendhaltspreis_60' => sanitize($aufendhaltspreis_60),         
            );
$db->update("equinox_".$pageconfig['install_nr']."_werbepreise", $data, "id='" . $pageconfig['install_nr'] . "'");
header("Location: admin.php?admincontent=werbepreise");
}

 foreach ($wp_output AS $key=>$value) {
	$smarty->assign('wp_output_'.$key,$value);
 }
 
$smarty->display('admin/werbepreise.tpl');
?>