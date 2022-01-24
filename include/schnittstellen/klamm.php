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
* Datei: include/schnittstellen/klamm.php
*******************************************************************************/

// Klamm ExportForce² Fehlercodes
$trans_error[1001]		= "Alles OK";
$trans_error[1002]		= "EF Account existiert nicht";
$trans_error[1003]		= "EF Passwort falsch";
$trans_error[1004]		= "Nicht genug freie EF Anfragen";
$trans_error[1005]		= "EF Kennung existiert nicht";
$trans_error[1006]		= "klammUser existiert nicht";
$trans_error[1007]		= "klammUser ist gesperrt";
$trans_error[1008]		= "klammUser hat zu wenig Lose";
$trans_error[1009]		= "Lose Passwort falsch";
$trans_error[1010]		= "Zu wenig Lose auf EF Account";
$trans_error[1011]		= "Anzahl nicht zulässig";
$trans_error[1012]		= "Betreff nicht zulässig";
$trans_error[1013]		= "Inout Parameter nicht zulässig";
$trans_error[1014]		= "Limit Parameter nicht zulässig";
$trans_error[1015]		= "ab_tid Parameter nicht zulässig";
$trans_error[1016]		= "ab_time Parameter nicht zulässig";
$trans_error[1017]		= "type Parameter nicht zulässig";
$trans_error[1018]		= "Statistik Passwort falsch";
$trans_error[1019]		= "Tresor Parameter nicht zulässig";
$trans_error[1020]		= "Empfänger EF existiert nicht";
$trans_error[1021]		= "Empfänger EF noch nicht akiviert";
$trans_error[1022]		= "Überweisung an eigenen EF nicht möglich";
$trans_error[1023]		= "target Parameter nicht zulässig";
$trans_error[1098]		= "EF Account ist gesperrt";
$trans_error[1099]		= "Unbekannter Fehler";

/* Laden der Schnittstellendaten */
$schnittstelle = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_schnittstelle WHERE schnittstelle = 'klamm'"));
$transfercode = create_code(12);

// ExportForce² -> Klamm.de
function auszahlen ($kunden_id,$kunden_pw,$trans_menge) {
global $schnittstelle,$transfercode,$trans_error,$error,$trans_ausgabe;

$returned='';
$ret=@file("https://www.klamm.de/engine/lose/send.php?ef_id=".urlencode($schnittstelle['betreiber_id'])."&ef_pw=".urlencode($schnittstelle['betreiber_passwort'])."&k_id=".urlencode($kunden_id)."&s=".urlencode($schnittstelle['auszahltext'])."&n=".urlencode($trans_menge)."&k=".urlencode($schnittstelle['betreiber_kennung'])."&l_pw=".urlencode($kunden_pw)."&code=".urlencode($transfercode)."");
for($i=0;$i<count($ret);$i++) {
  $returned.=$ret[$i];
}
$trans_check = explode("[|]",$returned,7);
if ($trans_check[0] != "1001") {
$trans_ausgabe = $trans_error[$trans_check[0]];
if ($trans_ausgabe == "") $trans_ausgabe = $trans_error[1099];
$error = "true";
}
return $error;
return $trans_ausgabe;
}

// Klamm.de -> ExportForce²
function einzahlen ($kunden_id,$kunden_pw,$trans_menge){
global $schnittstelle,$transfercode,$trans_error,$error,$trans_ausgabe;

$returned='';
$ret=@file("https://www.klamm.de/engine/lose/get.php?ef_id=".urlencode($schnittstelle['betreiber_id'])."&ef_pw=".urlencode($schnittstelle['betreiber_passwort'])."&k_id=".urlencode($kunden_id)."&s=".urlencode($schnittstelle['auszahltext'])."&n=".urlencode($trans_menge)."&k=".urlencode($schnittstelle['betreiber_kennung'])."&l_pw=".urlencode($kunden_pw)."&code=".urlencode($transfercode)."");
for($i=0;$i<count($ret);$i++) {
  $returned.=$ret[$i];
}
$trans_check = explode("[|]",$returned,7);
if ($trans_check[0] != "1001") {
$trans_ausgabe = $trans_error[$trans_check[0]];
if ($trans_ausgabe == "") $trans_ausgabe = $trans_error[1099];
$error = "true";
}
return $error;
return $trans_ausgabe;
}

// Klammlose-Kontostand
function usercheck ($kunden_id,$kunden_pw){
global $schnittstelle,$transfercode,$trans_error,$error,$trans_ausgabe,$user_saldo;

$returned='';
$ret=@file("https://www.klamm.de/engine/lose/saldo.php?ef_id=".urlencode($schnittstelle['betreiber_id'])."&ef_pw=".urlencode($schnittstelle['betreiber_passwort'])."&k_id=".urlencode($kunden_id)."&l_pw=".urlencode($kunden_pw)."");
for($i=0;$i<count($ret);$i++){
  $returned.=$ret[$i];
}
$trans_check = explode("[|]",$returned,7);
if ($trans_check[0] != "1001") {
$trans_ausgabe = $trans_error[$trans_check[0]];
if ($trans_ausgabe == "") $trans_ausgabe = $trans_error[1099];
$error = "true";
}
if ($error != "true") $user_saldo = $trans_check[1];
return $error;
return $trans_ausgabe;
return $user_saldo;
}

// Usercheck
function uservalidate ($kunden_id,$kunden_pw){
global $schnittstelle,$transfercode,$trans_error,$error,$trans_ausgabe;

$returned='';
$ret=@file("https://www.klamm.de/engine/lose/validate.php?ef_id=".urlencode($schnittstelle['betreiber_id'])."&ef_pw=".urlencode($schnittstelle['betreiber_passwort'])."&k_id=".urlencode($kunden_id)."&l_pw=".urlencode($kunden_pw)."");
for($i=0;$i<count($ret);$i++){
  $returned.=$ret[$i];
}
$trans_check = explode("[|]",$returned,7);
if ($trans_check[0] != "1001") {
$trans_ausgabe = $trans_error[$trans_check[0]];
if ($trans_ausgabe == "") $trans_ausgabe = $trans_error[1099];
$error = "true";
}

return $error;
return $trans_ausgabe;
}
?>