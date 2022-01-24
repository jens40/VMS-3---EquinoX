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
* Datei: include/admin/npbearbeiten.php
*******************************************************************************/
$npuser = Request::get('npuser');
$npdel = Request::post('npdel');
$benutzername = Request::post('benutzername');
$werbernick = Request::post('werber');
$benutzertext = Request::post('benutzertext');
$avatar = Request::post('avatar');
$klamm_id = Request::post('klamm');
$fuco_id = Request::post('funcoins');
$nickey_id = Request::post('nickey');
$icq = Request::post('icq');
$msn = Request::post('msn');
$email = Request::postemail('email');
$skype = Request::post('skype');
$url_1 = Request::post('url_1');
$beschreibung_1 = Request::post('beschreibung_url_1');
$url_2 = Request::post('url_2');
$beschreibung_2 = Request::post('beschreibung_url_2');
$url_3 = Request::post('url_3');
$beschreibung_3 = Request::post('beschreibung_url_3');
$url_4 = Request::post('url_4');
$beschreibung_4 = Request::post('beschreibung_url_4');
$url_5 = Request::post('url_5');
$beschreibung_5 = Request::post('beschreibung_url_5');
/* Nickpage eintragen und Cachen */
if (Filter::$do == 'create_nickpage'){
$benutzertext = substr($benutzertext, 0, 400);
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_nickpage WHERE nickname = '".sanitize($benutzername)."'");
if (!$npdel){

    $data = array(
			'nickname' => sanitize($benutzername),
            'werbernick' => sanitize($werbernick),
            'benutzertext' => sanitize($benutzertext),
            'avatar' => sanitize($avatar),
            'klamm_id' => sanitize($klamm_id),
            'fuco_id' => sanitize($fuco_id),
            'nickey_id' => sanitize($nickey_id),
            'icq' => sanitize($icq),
            'msn' => sanitize($msn),            
            'skype' => sanitize($skype),            
            'email' => sanitize($email),
            'url_1' => sanitize($url_1),
            'beschreibung_1' => sanitize($beschreibung_1),
            'url_2' => sanitize($url_2),
            'beschreibung_2' => sanitize($beschreibung_2),
            'url_3' => sanitize($url_3),
            'beschreibung_3' => sanitize($beschreibung_3),
            'url_4' => sanitize($url_4),
            'beschreibung_4' => sanitize($beschreibung_4),
            'url_5' => sanitize($url_5),
            'beschreibung_5' => sanitize($beschreibung_5)
            );

$db->insert("equinox_".$pageconfig['install_nr']."_nickpage", $data);  
}
}

/* Nickpagedaten laden */
$nickpage_daten = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_nickpage WHERE nickname = '".sanitize($npuser)."'");
if ($db->numrows($nickpage_daten)) $nickpage_daten = $db->fetch($nickpage_daten);

 foreach ($nickpage_daten AS $key=>$value) {
	$smarty->assign('nickpage_daten_'.$key,$value);
 }
 
$smarty->display('admin/npbearbeiten.tpl');
?>