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
* Datei: include/admin/bilanz.php
*******************************************************************************/
$bilanz_outs = array();
$bilanzabfrage = $db->query("SELECT tag, monat, jahr, einnahmen, ausgaben FROM equinox_".$pageconfig['install_nr']."_bilanzen ORDER BY jahr DESC, monat DESC, tag DESC LIMIT 10"); 
while ($bilanzdaten = $db->fetch($bilanzabfrage)) { 
  $bilanz_old = $bilanzdaten['einnahmen']- $bilanzdaten['ausgaben'];
  $bilanz = number_format($bilanz_old,2,",",".");

  if ($bilanz >= number_format(0,2,",",".")){
     $bilanz = '<font color="#006600">'.$bilanz.'</font>';
  }else{
     $bilanz = '<font color="#FF0000">'.$bilanz.'</font>';
  };
    
     $bilanz_out = array(
      'tag' => $bilanzdaten['tag'],
      'monat' => $bilanzdaten['monat'],
      'jahr' => $bilanzdaten['jahr'],
      'einnahmen' => number_format($bilanzdaten['einnahmen'],2,",","."),
      'ausgaben' => number_format($bilanzdaten['ausgaben'],2,",","."),
      'bilanz' => $bilanz
    );
$bilanz_outs[] = $bilanz_out;
}

$bilanz1_outs = array();
$bilanzabfrage1 = $db->query("SELECT jahr, monat, SUM(einnahmen) as rein, SUM(ausgaben) as raus FROM equinox_".$pageconfig['install_nr']."_bilanzen GROUP BY jahr,monat ORDER BY jahr DESC, monat DESC"); 
while ($bilanzdaten1 = $db->fetch($bilanzabfrage1)) { 
 $bilanz_old = $bilanzdaten1['rein']- $bilanzdaten1['raus'];
    $bilanz = number_format($bilanz_old,2,",",".");
  if ($bilanz >= number_format(0,2,",",".")){
     $bilanz = '<font color="#006600">'.$bilanz.'</font>';
  }else{
     $bilanz = '<font color="#FF0000">'.$bilanz.'</font>';
  };
    
     $bilanz1_out = array(
      'monat' => $bilanzdaten1['monat'],
      'jahr' => $bilanzdaten1['jahr'],
      'rein' => number_format($bilanzdaten1['rein'],2,",","."),
      'raus' => number_format($bilanzdaten1['raus'],2,",","."),
      'bilanz' => $bilanz
    );
$bilanz1_outs[] = $bilanz1_out;
}

$bilanz2_outs = array();
$bilanzabfrage2 = $db->query("SELECT jahr, monat, SUM(einnahmen) as rein, SUM(ausgaben) as raus FROM equinox_".$pageconfig['install_nr']."_bilanzen GROUP BY jahr ORDER BY jahr DESC, monat DESC"); 
while ($bilanzdaten2 = $db->fetch($bilanzabfrage2)) { 
  $bilanz_old = $bilanzdaten2['rein']- $bilanzdaten2['raus'];
    $bilanz = number_format($bilanz_old,2,",",".");
  if ($bilanz >= number_format(0,2,",",".")){
     $bilanz = '<font color="#006600">'.$bilanz.'</font>';
  }else{
     $bilanz = '<font color="#FF0000">'.$bilanz.'</font>';
  };
    
     $bilanz2_out = array(
      'jahr' => $bilanzdaten2['jahr'],
      'rein' => number_format($bilanzdaten2['rein'],2,",","."),
      'raus' => number_format($bilanzdaten2['raus'],2,",","."),
      'bilanz' => $bilanz
    );
$bilanz2_outs[] = $bilanz2_out;
}

$bilanz3_outs = array();
$bilanzabfrage3 = $db->query("SELECT wtag, SUM(einnahmen) as rein, SUM(ausgaben) as raus FROM equinox_".$pageconfig['install_nr']."_bilanzen GROUP BY wtag ORDER BY wtag ASC"); 
$wochentage = array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
while ($bilanzdaten3 = $db->fetch($bilanzabfrage3)) { 
  $bilanz_old = $bilanzdaten3['rein']- $bilanzdaten3['raus'];
    $bilanz = number_format($bilanz_old,2,",",".");
  if ($bilanz >= number_format(0,2,",",".")){
     $bilanz = '<font color="#006600">'.$bilanz.'</font>';
  }else{
     $bilanz = '<font color="#FF0000">'.$bilanz.'</font>';
  };

$wtag = $bilanzdaten3['wtag'];
    
     $bilanz3_out = array(
      'wtag' => $wochentage["$wtag"],
      'rein' => number_format($bilanzdaten3['rein'],2,",","."),
      'raus' => number_format($bilanzdaten3['raus'],2,",","."),
      'bilanz' => $bilanz
    );
$bilanz3_outs[] = $bilanz3_out;
}

$smarty->assign('bilanz3_outs',$bilanz3_outs);
$smarty->assign('bilanz2_outs',$bilanz2_outs);
$smarty->assign('bilanz1_outs',$bilanz1_outs);
$smarty->assign('bilanz_outs',$bilanz_outs);
$smarty->display('admin/bilanz.tpl');
?>