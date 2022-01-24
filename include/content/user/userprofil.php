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
* Datei: include/content/user/userprofil.php
*******************************************************************************/
/* Seite sichern */
access();

/* Bankdaten, PP & MB updaten */
if (Filter::$do == 'knt_updaten') {
$knt_bank = Request::post('knt_bank');
$knt_inhaber = Request::post('knt_inhaber'); 
$knt_nummer = Request::post('knt_nummer');
$knt_blz = Request::post('knt_blz');     
$knt_iban = Request::post('knt_iban');
$knt_bic = Request::post('knt_bic');
$paypal = Request::post('paypal');
$moneybookers = Request::post('moneybookers');

    $data = array(
			'kreditinstitut' => sanitize($knt_bank),
            'kontoinhaber' => sanitize($knt_inhaber),
			'kontonummer' => sanitize($knt_nummer),
			'bankleitzahl' => sanitize($knt_blz),            
 			'iban' => sanitize($knt_iban),
            'bic' => sanitize($knt_bic),
			'paypal' => sanitize($paypal),
			'moneybookers' => sanitize($moneybookers),
            );
$db->update("equinox_".$pageconfig['install_nr']."_userkonten", $data, "nickname='" . $_SESSION['nickname'] . "'");
}

if (Filter::$do == 'updaten') {
$passwort = Request::post('passwort');
$passwort2 = Request::post('passwort2'); 
$tresorpasswort = Request::post('tresorpasswort');
$tresorpasswort2 = Request::post('tresorpasswort2');     
$banneranzeigen = Request::post('banneranzeigen');
$max_pmail = Request::post('max_pmail');
$firma = Request::post('firma');
$vorname = Request::post('vorname');
$nachname = Request::post('nachname');
$strasse = Request::post('strasse');
$plz = Request::post('plz');
$ort = Request::post('ort');
$email = Request::postemail('email');
$telefon = Request::post('telefon');
$mobil = Request::post('mobil');
$fax = Request::post('fax');
$land = Request::post('land');
$geschlecht = Request::post('geschlecht');
$geburtsdatum = Request::post('geburtsdatum');
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
$tresorpasswortnew = hash('sha512', $tresorpasswort . $userdaten['salt']);
$passwortnew = hash('sha512', $passwort . $userdaten['salt']);


	/* Passwortprüfen */
if ($passwort && $passwort2) {
  if(!preg_match("/^[0-9a-z]{6,50}$/",$passwort))
  {
   Filter::$msgs['error'] = "Passwort ungültige Zeichen oder min.6 bis 50 Zeichen";
   $fehler['farbe']['passwort'] = 'style="border-color: #ff0000;"';
  }
  if($passwort2 != $passwort)
  {
   Filter::$msgs['error'] = "Passwörter stimmen nicht überein";
   $fehler['farbe']['passwort2'] = 'style="border-color: #ff0000;"';
  }
}    
    
		/* Tresorpasswort eintragen */
	if ($tresorpasswort && $userdaten['tresorpasswort'] == '') {
		if (!preg_match("/^[0-9a-z]{6,50}$/",$tresorpasswort)) {
		Filter::$msgs['error'] = "Tresorpasswort zwischen 6-50 Zeichen, Zahlen und Buchstaben";  
		$eingabefehler = 'true';
		} else {
		$new_tp = sanitize($tresorpasswortnew);
		}
	} elseif($tresorpasswort) {
		if ($tresorpasswortnew == $userdaten['tresorpasswort']) {
			if (!preg_match("/^[0-9a-z]{6,50}$/",$tresorpasswort2)) {
            Filter::$msgs['error'] = "Tresorpasswort zwischen 6-50 Zeichen, Zahlen und Buchstaben";
			$eingabefehler = 'true';
			} else {
			$new_tp = sanitize($tresorpasswortnew);
			}
		} else {
		Filter::$msgs['error'] = "altes Tresorpasswort stimmt nicht!";
		$eingabefehler = 'true';
		}
	}    
    
  if(!$strasse)
  {
   Filter::$msgs['error'] = "Strasse wurde nicht eingetragen !";
   $fehler['farbe']['strasse'] = 'style="border-color: #ff0000;"';
  }
  if(!$plz)
  {
   Filter::$msgs['error'] = "PLZ wurde nicht eingetragen !";
   $fehler['farbe']['plz'] = 'style="border-color: #ff0000;"';
  }
  if(!$ort)
  {
   Filter::$msgs['error'] = "Ort wurde nicht eingetragen !";
   $fehler['farbe']['ort'] = 'style="border-color: #ff0000;"';
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   Filter::$msgs['error'] = "Ort wurde nicht eingetragen !";
   $fehler['farbe']['email'] = 'style="border-color: #ff0000;"';
  }
if(empty(Filter::$msgs)){
    if ($passwort && $passwort2) {
	 $new_passwort = sanitize($passwortnew);
	  } else {
	 $new_passwort = $_SESSION['passwort'];
	}
    $data = array(
			'passwort' => sanitize($new_passwort),
            'email' => sanitize($email),
			'max_banner' => sanitize($banneranzeigen),
			'max_pmail' => sanitize($max_pmail),
            );        
    if(!empty($new_tp)){
     $data['tresorpasswort'] = $new_tp;    
    }    
$db->update("equinox_".$pageconfig['install_nr']."_user", $data, "uid='" . $_SESSION['uid'] . "'");

    $data1 = array(
			'vorname' => sanitize($vorname),
			'nachname' => sanitize($nachname),
            'strasse' => sanitize($strasse),
            'ort' => sanitize($ort),
            'plz' => sanitize($plz),
            'land' => sanitize($land),
			'firma' => sanitize($firma),
			'telefon' => sanitize($telefon),
            'mobil' => sanitize($mobil),
            'fax' => sanitize($fax),
            'geschlecht' => sanitize($geschlecht),
            'geburtsdatum' => sanitize($geburtsdatum) 
            );         
 $db->update("equinox_".$pageconfig['install_nr']."_userdaten", $data1, "nickname='" . sanitize($_SESSION['nickname']) . "'");       
		
        if ($passwort && $passwort2) {
		$_SESSION['passwort']	= $new_passwort;
		$cookiedaten = array($_SESSION['uid'],$_SESSION['nickname'],$new_passwort);
		$cookiedaten = implode("||",$cookiedaten);
		setCookie('vms3',$cookiedaten,time()+(60*60*7));
		Filter::$msgs['error'] = "Passwort wurde geändert!";
        Filter::msgStatus();
		}    
}else{Filter::msgStatus();}   
  
  
  

}


/* Aktuelle Userdaten auslesen */
$usercheck = $db->query("SELECT u.*,ud.*,uk.* FROM equinox_".$pageconfig['install_nr']."_user u, equinox_".$pageconfig['install_nr']."_userdaten ud, equinox_".$pageconfig['install_nr']."_userkonten uk WHERE u.uid = '".$_SESSION['uid']."' and ud.nickname = u.nickname and uk.nickname = u.nickname");
$userdaten = $db->fetch($usercheck);

 foreach ($userdaten AS $key=>$value) {
	$smarty->assign('userdaten_'.$key,$value);
 }
$aLand['Deutschland'] = "Deutschland";
$aLand['Österreich'] = "Österreich";
$aLand['Schweiz'] = "Schweiz";
$smarty->assign('land',$userdaten['land']);
$smarty->assign('aLand',$aLand); 
$smarty->assign('message',Filter::$showMsg);
$smarty->display('userprofil.tpl');
?>