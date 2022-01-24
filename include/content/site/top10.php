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
* Datei: include/site/top10.php
*******************************************************************************/
 
$anmelde = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user ORDER BY anmeldezeit DESC LIMIT 10"); 
while ($query=$db->fetch($anmelde)) { 
     $anmelde_out = array(
      'uid' => $query['uid'],
      'nickname' => $query['nickname'],
      'anmeldezeit' => date("d.m.Y  H:i",$query['anmeldezeit']),

    );
$anmelde_outs[] = $anmelde_out;
} 

$smarty->assign('anmelde',$anmelde_outs); 
$rang = 1;
$guthabenrang = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 ORDER BY guthaben DESC LIMIT 10"); 
while ($guthabenliste=$db->fetch($guthabenrang)) { 
$userdaten = $db->fetch($db->query("select nickname from equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 and uid = ".$guthabenliste['uid'].""));
     $guthabenrang_out = array(
      'rang' => $rang++,
      'nickname' => $userdaten['nickname'],
      'guthaben' => number_format($guthabenliste['guthaben'],0,",","."),

    );
$guthabenrang_outs[] = $guthabenrang_out;
} 

$smarty->assign('guthabenrang',$guthabenrang_outs);
$rang = 1;
$aktivpunkterang = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 ORDER BY aktivpunkte DESC LIMIT 10"); 
while ($aktivpunkteliste=$db->fetch($aktivpunkterang)) { 
$userdaten = $db->fetch($db->query("select nickname from equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 and uid = ".$aktivpunkteliste['uid'].""));
     $aktivpunkteliste_out = array(
      'rang' => $rang++,
      'nickname' => $userdaten['nickname'],
      'aktivpunkte' => number_format($aktivpunkteliste['aktivpunkte'],0,",","."),

    );
$aktivpunkteliste_outs[] = $aktivpunkteliste_out;
} 

$smarty->assign('aktivpunkteliste',$aktivpunkteliste_outs);
$rang = 1;
$refanzahlrang = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 ORDER BY refanzahl DESC LIMIT 10"); 
while ($refanzahlliste=$db->fetch($refanzahlrang)) { 
$userdaten = $db->fetch($db->query("select nickname from equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 and uid = ".$refanzahlliste['uid'].""));
     $refanzahlliste_out = array(
      'rang' => $rang++,
      'nickname' => $userdaten['nickname'],
      'refanzahl' => $refanzahlliste['refanzahl'],

    );
$refanzahlliste_outs[] = $refanzahlliste_out;
} 

$smarty->assign('refanzahlliste',$refanzahlliste_outs);

$rang = 1;
$klicksrang = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 ORDER BY forcedklicks DESC LIMIT 10"); 
while ($klickliste=$db->fetch($klicksrang)) { 

$userdaten = $db->fetch($db->query("select nickname from equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 and uid = ".$klickliste['uid'].""));
     $klickliste_out = array(
      'rang' => $rang++,
      'nickname' => $userdaten['nickname'],
      'forcedklicks' => number_format($klickliste['forcedklicks'],0,",","."),

    );
$klickliste_outs[] = $klickliste_out;
} 

$smarty->assign('klickliste',$klickliste_outs);

$rang = 1;
$bettelrang = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 ORDER BY bettelklicks DESC LIMIT 10"); 
while ($bettelliste=$db->fetch($bettelrang)) { 

$userdaten = $db->fetch($db->query("select nickname from equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 and uid = ".$bettelliste['uid'].""));
     $bettelliste_out = array(
      'rang' => $rang++,
      'nickname' => $userdaten['nickname'],
      'bettelklicks' => number_format($bettelliste['bettelklicks'],0,",","."),
      'bettelsumme' => number_format($bettelliste['bettelsumme'],2,",","."),

    );
$bettelliste_outs[] = $bettelliste_out;
} 

$smarty->assign('bettelliste',$bettelliste_outs);

$smarty->display('top10.tpl');

?>