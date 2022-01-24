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
* Datei: include/admin/userbearbeiten.php
*******************************************************************************/
$loeschen = Request::post('loeschen');
/* User löschen */

if (Filter::$do == 'updaten' && $loeschen == 1) {
$nickname = Request::post('nickname');
$uid = Request::post('uid');
$werber_nick = Request::post('werber_nick'); 
$werber_id = Request::post('werber_id');
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($nickname)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_userkonten WHERE nickname = '".sanitize($nickname)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_nickpage WHERE nickname = '".sanitize($nickname)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_mailquery WHERE uid = '".sanitize($uid)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_kampagnen WHERE userid = '".sanitize($uid)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_reloads WHERE uid = '".sanitize($uid)."'");
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_kontoauszug WHERE user = '".sanitize($nickname)."'");
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET werber_id = '".sanitize($werber_id)."', werber_nick = '".sanitize($werber_nick)."' WHERE werber_nick = '".sanitize($nickname)."'");
header("Location: admin.php?admincontent=userliste");
}

/* Aktivpunkte des Users reseten (Nullen) */
$reset = Request::get('reset');
if ($reset) {
$uid = Request::get('uid');
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET ".sanitize($reset)." = '0' WHERE uid = '".sanitize($uid)."'");
}

/* User Gutschreiben oder Abziehen */
if (Filter::$do == 'buchen') {
	$nickname = Request::post('nickname');
    $richtung = Request::post('richtung');
    $summe = Request::post('summe');
    $vzweck = Request::post('vzweck');
    if ($richtung == '1') {
	kontoauszug($nickname,'Intern',$summe,$vzweck);
	kontobuchung($nickname,'-',$summe,0,0,0,0,0);
	echo '-';
	} else {
	kontoauszug('Intern',$nickname,$summe,$vzweck);
	kontobuchung($nickname,'+',$summe,0,0,0,0,0);
	echo '+';
	}
}

if (Filter::$do == 'updaten' && $loeschen == 0) {
$werber_nick = Request::post('werber_nick'); 
$nickname = Request::post('nickname');
$passwort = Request::post('passwort');
$oldpasswort = Request::post('oldpasswort');
$tn = Request::post('tn');
$akn = Request::post('akn');     
$uid = Request::post('uid');
$d_acc = Request::post('d_acc');
$status = Request::post('status');
$admin = Request::post('admin');
$banneranzeigen = Request::post('banneranzeigen');
$max_pmail = Request::post('max_pmail');
$firma = Request::post('firma');
$vorname = Request::post('vorname');
$nachname = Request::post('nachname');
$strasse = Request::post('strasse');
$plz = Request::post('plz');
$ort = Request::post('ort');
$land = Request::post('land');
$email = Request::postemail('email');
$telefon = Request::post('telefon');
$mobil = Request::post('mobil');
$fax = Request::post('fax');
$geschlecht = Request::post('geschlecht');
$geburtsdatum = Request::post('geburtsdatum');
$knt_bank = Request::post('knt_bank');
$knt_inhaber = Request::post('knt_inhaber'); 
$knt_nummer = Request::post('knt_nummer');
$knt_blz = Request::post('knt_blz');     
$knt_iban = Request::post('knt_iban');
$knt_bic = Request::post('knt_bic');
$paypal = Request::post('paypal');
$moneybookers = Request::post('moneybookers');
$klamm_id = Request::post('klamm_id');
$fuco_id = Request::post('fuco_id');
$nickey_id = Request::post('nickey_id'); 
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
$passwortnew = hash('sha512', $passwort . $userdaten['salt']);
    
	if ($werber_nick != $nickname) {
		$werber = $db->query("SELECT `uid`,`nickname` FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($werber_nick)."' LIMIT 1");
		if (!$db->numrows($werber)){
		$ref['uid'] = 0;
		$ref['nick'] = '';
		} else {
		$werber = $db->fetch($werber);
			$ref['uid'] = $werber['uid'];
			$ref['nick'] = $werber['nickname'];
		}
	} else {
		$ref['uid'] = 0;
		$ref['nick'] = '';
	}
if ($passwort) {$new_passwort = $passwortnew;} else {$new_passwort = $oldpasswort;}


$akt_werber = $db->fetch($db->query('SELECT werber_nick, werber_refback FROM equinox_'.$pageconfig['install_nr'].'_user WHERE uid = '.sanitize($uid)));
$ref['refback'] = ($akt_werber['werber_nick'] != $ref['nick']) ? '0' : $akt_werber['werber_refback'];
    $data = array(
			'passwort' => sanitize($new_passwort),
            'd_acc' => sanitize($d_acc),
            'email' => sanitize($email),
			'max_banner' => sanitize($banneranzeigen),
			'max_pmail' => sanitize($max_pmail),
            'status' => sanitize($status),
            'admin' => sanitize($admin),
            'werber_nick' => sanitize($ref['nick']),
            'werber_id' => sanitize($ref['uid']),
            'werber_refback' => sanitize($ref['refback']),
            );
            

if ($akn == 1) $data['klick_stop'] = '0';
if ($tn == 1) $data['tresorpasswort'] = '';
$db->update("equinox_".$pageconfig['install_nr']."_user", $data, "uid='" . sanitize($uid) . "'");

    $data1 = array(
			'vorname' => sanitize($vorname),
			'nachname' => sanitize($nachname),
            'strasse' => sanitize($strasse),
            'firma' => sanitize($firma),
            'ort' => sanitize($ort),
            'plz' => sanitize($plz),
            'land' => sanitize($land),			
			'telefon' => sanitize($telefon),
            'mobil' => sanitize($mobil),
            'fax' => sanitize($fax),
            'geschlecht' => sanitize($geschlecht),
            'geburtsdatum' => sanitize($geburtsdatum) 
            );         
 $db->update("equinox_".$pageconfig['install_nr']."_userdaten", $data1, "nickname='" . sanitize($nickname) . "'");
    $data3 = array(
			'kreditinstitut' => sanitize($knt_bank),
            'kontoinhaber' => sanitize($knt_inhaber),
			'kontonummer' => sanitize($knt_nummer),
			'bankleitzahl' => sanitize($knt_blz),            
 			'iban' => sanitize($knt_iban),
            'bic' => sanitize($knt_bic),
			'paypal' => sanitize($paypal),
			'moneybookers' => sanitize($moneybookers),
            
            'klamm_id' => sanitize($klamm_id),
			'fuco_id' => sanitize($fuco_id),
			'nickey_id' => sanitize($nickey_id),
            );
$db->update("equinox_".$pageconfig['install_nr']."_userkonten", $data3, "nickname='" . sanitize($nickname) . "'");
  
header("Location: admin.php?admincontent=userliste");    
}
$uid = Request::get('uid');
/* Aktuelle Userdaten auslesen */
$user_check = $db->query("SELECT u.*,ud.*,uk.* FROM equinox_".$pageconfig['install_nr']."_user u, equinox_".$pageconfig['install_nr']."_userdaten ud, equinox_".$pageconfig['install_nr']."_userkonten uk WHERE u.uid = '".sanitize($uid)."' and ud.nickname = u.nickname and uk.nickname = u.nickname");
$user_fields = $db->fetch($user_check);

 foreach ($user_fields AS $key=>$value) {
	$smarty->assign('user_fields_'.$key,$value);
 } 
$smarty->display('admin/userbearbeiten.tpl');
?>