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
* Datei: include/content/site/anmelden.php
*******************************************************************************/
$username = Request::post('username');
$passwort = Request::post('passwort');
$passwort2 = Request::post('passwort2');
$firma = Request::post('firma');
$vorname = Request::post('vorname');
$nachname = Request::post('nachname');
$strasse = Request::post('strasse');
$plz = Request::post('plz');
$ort = Request::post('ort');
$geburtsdatum = Request::post('geburtsdatum');
$email = Request::postemail('email');
$telefon = Request::post('telefon');
$mobil = Request::post('mobil');
$fax = Request::post('fax');
$land = Request::post('land');
$aktivierungscode = Request::get('aktivierungscode');
$geschlecht = Request::post('geschlecht');
$fehler['farbe'] = array();
$secret='';
$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
$passwordnew = hash('sha512', $passwort . $random_salt);
$ok=false;

if (!empty($aktivierungscode)) {
$db_ak = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_useraktivierung WHERE aktivierungskey = '".sanitize($aktivierungscode)."'");
if (mysqli_num_rows($db_ak)) {
$akz = mysqli_fetch_array($db_ak);
$db->update("equinox_".$pageconfig['install_nr']."_user", array('status' => 1), "nickname='" . sanitize($akz['nickname']) . "'");
/* Abfrage wenn Refralley aktiv ist */
if ($mainconfig['srr_start'] <= time() && $mainconfig['srr_ende'] >= time()) {
$werber = mysqli_fetch_array($db->query("SELECT werber_nick FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($akz['nickname'])."'"));
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET srr = srr + 1 WHERE nickname = '".sanitize($werber['werber_nick'])."'");
}
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_useraktivierung WHERE aktivierungskey = '".sanitize($aktivierungscode)."'");
$ausgabe = '
Die Aktivierung Ihres Accounts bei '.$mainconfig['seitenname'].' war erfolgreich,
Sie können sich nun bei uns einloggen und unser Angebot in vollem Umfang nutzen.<br>
<br>
Solltest Sie Fehler auf unserer Webseite finden dann senden Sie uns bitte eine Email
an <a href="mailto:'.$mainconfig['betreibermail'].'" target="_blank">'.$mainconfig['betreibermail'].'</a><br>
<br>
Wir wünschen Dir nun viel Spaß und viele viele Funcoins!<br>
<br>
Mit freundlichen Grüßen<br>
Das '.$mainconfig['seitenname'].' Team<br>
';
} else {
$ausgabe = '
Die Aktivierung Ihres Accounts bei '.$mainconfig['seitenname'].' ist fehlgeschlagen,
entweder haben Sie ihren Account bereits aktiviert oder ihr Account wurde wieder gelöscht.<br>
<br>
Bitte versuchen Sie es erneut den Aktivierungslink zu betätigen, sollte dieses wieder fehlschlagen
wenden Sie sich bitte an <a href="mailto:'.$mainconfig['betreibermail'].'" target="_blank">'.$mainconfig['betreibermail'].'</a><br>
<br>
Mit freundlichen Grüßen<br>
Das '.$mainconfig['seitenname'].' Team<br>
';
}    
$smarty->assign('ausgabe',$ausgabe);
$smarty->display('aktivierung.tpl');    
exit();  
}

if (Filter::$do == 'checkData') {
  if(!preg_match("/^[0-9a-z]{3,20}$/",$username))
  {
   Filter::$msgs['error'] = "Username ungültige Zeichen oder min.3 bis 20 Zeichen";
   $fehler['farbe']['username'] = 'style="border-color: #ff0000;"';
  }  

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
  if(!$vorname)
  {
   Filter::$msgs['error'] = "Vorname wurde nicht eingetragen !";
   $fehler['farbe']['vorname'] = 'style="border-color: #ff0000;"';
  }
  
  if(!$nachname)
  {
   Filter::$msgs['error'] = "Nachname wurde nicht eingetragen !";
   $fehler['farbe']['nachname'] = 'style="border-color: #ff0000;"';
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
   Filter::$msgs['error'] = "Bitte geben Sie eine korrekte E-Mail-Adresse an !";
   $fehler['farbe']['email'] = 'style="border-color: #ff0000;"';
  }
  $db_nickname = $db->query("SELECT 'nickname' FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($username)."'");
  if($db->numrows($db_nickname))
  {   
   Filter::$msgs['error'] = "Der Benutzername: ".$username." ist bereits vergeben!";
   $fehler['farbe']['username'] = 'style="border-color: #ff0000;"';
  }
  $db_email = $db->query("SELECT 'email' FROM equinox_".$pageconfig['install_nr']."_user WHERE email = '".sanitize($email)."'");
  if($db->numrows($db_email))
  {   
   Filter::$msgs['error'] = "Die E-Mailadresse:".$email." wird bereits verwendet!";
   $fehler['farbe']['username'] = 'style="border-color: #ff0000;"';
  }	

    if($secret !=''){
     $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
     $responseData = json_decode($verifyResponse);
       
    if(!$responseData->success)
    {
     Filter::$msgs['error'] = BAUM_ANMELDUNGERROR11;
    }
    }

if(empty(Filter::$msgs)){

	$aktivierungscode = md5($email.'-'.$username.'-'.$vorname.'-'.time());
	$email_message = 'Hallo,
	Sie haben sich soeben erfolgreich bei '.$mainconfig['seitenname'].' angemeldet.

	Bitte aktivieren Sie jetzt ihren Account, klicke sie dazu bitte auf den
	Aktivierungslink: '.$mainconfig['seitenurl'].'/index.php?content=site/anmelden&aktivierungscode='.$aktivierungscode.'

	----------------------------------------------------------
	Benutzername: '.$username.'
	Passwort: '.$passwort.'
	----------------------------------------------------------

	Nach der Aktivierung können Sie sich sofort einloggen und bei
	uns teilnehmen.

	Mit freundlichen Grüßen
	Das '.$mainconfig['seitenname'].' Team
	';
	/* Werber prüfen */
	if ($username != $_COOKIE['werber']) {
		$werber = $db->query("SELECT `uid`,`nickname` FROM equinox_".$pageconfig['install_nr']."_user WHERE nickname = '".sanitize($_COOKIE['werber'])."' LIMIT 1");
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
    
    $data = array(
			'nickname' => sanitize($username),
			'passwort' => sanitize($passwordnew),
            'salt' => sanitize($random_salt),            
            'werber_id' => sanitize($ref['uid']),
            'werber_nick' => sanitize($ref['nick']),
            'email' => sanitize($email),
			'guthaben' => sanitize('0'),
			'status' => sanitize('0'),
			'anmeldezeit' => sanitize(time()),
            'regip' => sanitize($_SERVER['REMOTE_ADDR'])
            );	
    $data1 = array(
			'nickname' => sanitize($username),
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
   
    $db->insert("equinox_".$pageconfig['install_nr']."_user", $data);
    $db->insert("equinox_".$pageconfig['install_nr']."_userdaten", $data1);
    $db->insert("equinox_".$pageconfig['install_nr']."_useraktivierung", array('nickname' => sanitize($username),'aktivierungskey' => sanitize($aktivierungscode),'zeit' => sanitize(time())));
    $db->insert("equinox_".$pageconfig['install_nr']."_userkonten", array('nickname' => sanitize($username)));
	//print_r($email_message);
    sendmail($email_message,$email,'Anmeldung / Aktivierungslink');
    $ok=true;
}else{Filter::msgStatus();}    
    
}

$aLand['Deutschland'] = "Deutschland";
$aLand['Österreich'] = "Österreich";
$aLand['Schweiz'] = "Schweiz";
$smarty->assign('land',$land);
$smarty->assign('aLand',$aLand);
$smarty->assign('fehler',$fehler);
$smarty->assign('telefon',$telefon);
$smarty->assign('mobil',$mobil);
$smarty->assign('fax',$fax);
$smarty->assign('email',$email);
$smarty->assign('geburtsdatum',$geburtsdatum);
$smarty->assign('ort',$ort);
$smarty->assign('plz',$plz);
$smarty->assign('strasse',$strasse);
$smarty->assign('vorname',$vorname);
$smarty->assign('nachname',$nachname);
$smarty->assign('firma',$firma);
$smarty->assign('passwort',$passwort);
$smarty->assign('passwort2',$passwort2);
$smarty->assign('werber',$_COOKIE['werber']);
$smarty->assign('username',$username);
$smarty->assign('message',Filter::$showMsg);
$smarty->assign('sitekey', $secret);
$smarty->assign('ok',$ok);
$smarty->display('anmelden.tpl');
?>