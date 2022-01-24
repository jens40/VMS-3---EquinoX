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
* Datei: content/user/kontoauszug.php
*******************************************************************************/
$status = Request::post('status');
$anzahl = Request::post('anzahl');
$abgeschickt = Request::post('abgeschickt');
$anfang = Request::post('anfang');

if (Filter::$do == 'change'){
  $db->query("UPDATE equinox_rangsystem_conf SET einstellung='".sanitize($status)."' WHERE art='aktiv'");
  $db->query("UPDATE equinox_rangsystem_conf SET einstellung='".sanitize($anzahl)."' WHERE art='anzahl'");
  $heade1 = "Meldung";
  $teext1 = "Die Daten wurden erfolgreich geändert !";   
}
// Daten Formular ändern
if (Filter::$do == 'set'){
        $count3 = 1;
        while ( $count3 <= $abgeschickt ) {
            $vari1 = "grenz".$count3;
            if (!is_numeric($_POST[$vari1])) {
                global $fehler;
                $fehler = $fehler."Grenzwert in Rang ".$count3." ist nicht numerisch !<br>";
            }
            $count3++;
        }

        $count4 = 2;
        while ( $count4 <= $abgeschickt ) {
            $vorher = $count4 - 1;
            $varia1 = "grenz".$count4;
            $varia2 = "grenz".$vorher;

            if ( $_POST[$varia1] <= $_POST[$varia2] ) {
                global $fehler;
                $fehler = $fehler."Fehler Grenzwert von Rang".$vorher." ist gleich oder größer als der Wert von Rang ".$count4." !<br>";
            }

            $count4++;
        }

        $count5 = 1;
        while ( $count5 <= $abgeschickt ) {
            $vari10 = "bonus".$count5;
            if (!is_numeric($_POST[$vari10])) {
                global $fehler;
                $fehler = $fehler."Losebonus in Rang ".$count5." ist nicht numerisch !<br>";
            }
            $count5++;
        }


        // Alles in DB eintragen
        $count2 = 0;
        while ( $count2 <= $abgeschickt ) {
            if ( $count2 == 0 ) {
                $rangnamen = $anfang;
                $grenzwerte = 0;
                $vonuswert = 0;
                $bonuswert = 0;
            } else {
                $var = "rang".$count2;
                $rangnamen = $_POST[$var];
                $var2 = "grenz".$count2;
                $grenzwerte = $_POST[$var2];
                $var3 = "bonus".$count2;
                $bonuswert = $_POST[$var3];
            }
            $db->query("UPDATE equinox_rangsystem SET name='".sanitize($rangnamen)."', grenzwert='".sanitize($grenzwerte)."', bonus='".sanitize($bonuswert)."' WHERE rang='".sanitize($count2)."'");
            $count2++;
        }
        $db->query("UPDATE equinox_rangsystem SET name='".sanitize($anfang)."' WHERE rang='0'");
}

// N paar DB Abfragen
$anzahldaten = $db->fetch($db->query("SELECT * FROM equinox_rangsystem_conf WHERE art='anzahl' LIMIT 1"));
$aktividaten = $db->fetch($db->query("SELECT * FROM equinox_rangsystem_conf WHERE art='aktiv' LIMIT 1"));
$dbabfrage2 = $db->fetch($db->query("SELECT * FROM equinox_rangsystem WHERE rang='0' LIMIT 1"));
//entsprechende Felder vorselektieren
$rangs[$anzahldaten['einstellung']] = "selected";
$aktis[$aktividaten['einstellung']] = "selected";
$ausgabe_outs = array();
// Je nach Anzahl der Ränge entsprechend viele Anzeigen
$count = 1;
while ($count <= $anzahldaten['einstellung']){
    $dbabfrage = $db->fetch($db->query("SELECT * FROM equinox_rangsystem WHERE rang='".$count."' LIMIT 1"));
     $ausgabe_out = array(
      'name' => $dbabfrage['name'],
      'grenzwert' => $dbabfrage['grenzwert'],
      'bonus' => $dbabfrage['bonus'],
      'count' => $count
    );
$ausgabe_outs[] = $ausgabe_out; 
$count++;  
}

$smarty->assign('einstellung',$anzahldaten['einstellung']); 
$smarty->assign('name',$dbabfrage2['name']); 
$smarty->assign('ausgabe',$ausgabe_outs);
$smarty->assign('aktis',$aktis);
$smarty->assign('rangs',$rangs); 
$smarty->display('admin/rangsystem.tpl');