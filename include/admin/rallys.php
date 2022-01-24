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
* Datei: include/admin/rallys.php
*******************************************************************************/
$r_art = Request::get('r_art');
if (!$r_art) $r_art = 'skr';
if ($r_art == 'skr') {$rallytitel = 'statische Klickralley';$nachkomma = 0;}
if ($r_art == 'dkr') {$rallytitel = 'dynamische Klickralley';$nachkomma = 0;}
if ($r_art == 'sar') {$rallytitel = 'statische Aktivralley';$nachkomma = 2;}
if ($r_art == 'dar') {$rallytitel = 'dynamische Aktivralley';$nachkomma = 2;}
if ($r_art == 'sbr') {$rallytitel = 'statische Bettelralley';$nachkomma = 0;}
if ($r_art == 'dbr') {$rallytitel = 'dynamische Bettelralley';$nachkomma = 0;}
if ($r_art == 'srr') {$rallytitel = 'statische Refralley';$nachkomma = 0;}
$zaehler = 0;
$ausgelobt= 0;
/* Plätze im Array spitten */
$rallydaten = explode("|",$mainconfig[$r_art.'_plaetze']);

	foreach ($rallydaten as $rallydaten_output) {
	$zaehler++;   
	$rallyinhalt[$zaehler] = $rallydaten_output;
	if ($r_art == 'skr' or $r_art == 'sar' or $r_art == 'sbr' or $r_art == 'srr') $ausgelobt = $ausgelobt + $rallyinhalt[$zaehler];	
    }

if ($r_art == 'dkr' or $r_art == 'dar' or $r_art == 'dbr') {
 $smarty->assign('zuwachs',number_format($mainconfig[$r_art.'_zuwachs'],$mainconfig['nach_koma'],",","."));  
 $smarty->assign('startpot',number_format($mainconfig[$r_art.'_startpot'],$mainconfig['nach_koma'],",",".")); 
}

/* Ausgabe der platzierung */
$rallyuser = $db->query("SELECT nickname,".sanitize($r_art)." FROM equinox_".$pageconfig['install_nr']."_user WHERE admin != 1 AND ".sanitize($r_art)." > 0 ORDER BY ".sanitize($r_art)." DESC LIMIT ".sanitize($zaehler)."");
$platz = 1;
$linecolor = '';
for ($platz;$platz <= $zaehler;$platz++) {
$rallyuser_output = $db->fetch($rallyuser);
	if ($linecolor == '#FDF5E7') {
	$linecolor = '#FCEED5';
	} else {
	$linecolor = '#FDF5E7';
	}

     $rallyuser_out = array(
      'linecolor' => $linecolor,
      'platz' => $platz,
      'nickname' => $rallyuser_output['nickname'],
      'klicks_punkte' => number_format($rallyuser_output[$r_art],$nachkomma,",",".")
    );
    if ($r_art == 'dkr' or $r_art == 'dar' or $r_art == 'dbr') {
    $rallyuser_out['gewinn'] = number_format(($mainconfig[$r_art.'_startpot'] / 100 * $rallyinhalt[$platz]),2,",",".");
    }else{
    $rallyuser_out['gewinn'] = number_format($rallyinhalt[$platz],0,",",".");
    }
$rallyuser_outs[] = $rallyuser_out;
}

$smarty->assign('rallyuser',$rallyuser_outs);
$smarty->assign('ausgelobt',number_format($ausgelobt,0,",","."));
$smarty->assign('zaehler',$zaehler);
$smarty->assign('rallytitel',$rallytitel);
$smarty->assign('start_zeit',date("d.m.Y - H:i:s",$mainconfig[$r_art.'_start']));
$smarty->assign('ende_zeit',date("d.m.Y - H:i:s",$mainconfig[$r_art.'_ende']));
$smarty->assign('r_art_start',$mainconfig[$r_art.'_start']);
$smarty->assign('r_art_ende',$mainconfig[$r_art.'_ende']);
$smarty->assign('r_art',$r_art);
$smarty->display('admin/rallys.tpl');
?>