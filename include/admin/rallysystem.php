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
* Datei: include/admin/rallysystem.php
*******************************************************************************/
$rallyart = Request::post('rallyart');

$startpot = Request::post('startpot');
$zuwachs = Request::post('zuwachs');
$start_monat = Request::post('start_monat');
$start_tag = Request::post('start_tag');
$start_jahr = Request::post('start_jahr');
$start_stunde = Request::post('start_stunde');
$start_minute = Request::post('start_minute');
$ende_monat = Request::post('ende_monat');
$ende_tag = Request::post('ende_tag');
$ende_jahr = Request::post('ende_jahr');
$ende_stunde = Request::post('ende_stunde');
$ende_minute = Request::post('ende_minute');
$plaetze = Request::post('plaetze');
$rally_speichern = Request::post('rally_speichern');
if (!$rallyart) $rallyart = 'skr';
if ($rallyart == 'skr') $rallytitel = 'statische Klickralley';
if ($rallyart == 'dkr') $rallytitel = 'dynamische Klickralley';
if ($rallyart == 'sar') $rallytitel = 'statische Aktivralley';
if ($rallyart == 'dar') $rallytitel = 'dynamische Aktivralley';
if ($rallyart == 'sbr') $rallytitel = 'statische Bettelralley';
if ($rallyart == 'dbr') $rallytitel = 'dynamische Bettelralley';
if ($rallyart == 'srr') $rallytitel = 'statische Refralley';

if (Filter::$do == 'rally_speichern' && $rally_speichern == 'Rally speichern') {
$rally_zusatz = '';
if ($rallyart == 'dkr' or $rallyart == 'dar' or $rallyart == 'dbr') $rally_zusatz = ','.$rallyart.'_startpot = '.$startpot.','.$rallyart.'_zuwachs = '.$zuwachs.'';
$ralleystart	= strtotime("".$start_monat."/".$start_tag."/".$start_jahr." ".$start_stunde." hours ".$start_minute." minutes 0 seconds");
$ralleyende		= strtotime("".$ende_monat."/".$ende_tag."/".$ende_jahr." ".$ende_stunde." hours ".$ende_minute." minutes 0 seconds");
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_config SET ".sanitize($rallyart)."_start = '".sanitize($ralleystart)."', ".$rallyart."_ende = '".sanitize($ralleyende)."', ".$rallyart."_plaetze = '".sanitize($plaetze)."' ".sanitize($rally_zusatz)." WHERE config_id = '".sanitize($pageconfig['install_nr'])."'");
$mainconfig = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_config WHERE config_id = '".sanitize($pageconfig['install_nr'])."'"));
}

$smarty->assign('start_stunde',date("H",$mainconfig[$rallyart.'_start']));
$smarty->assign('start_tag',date("d",$mainconfig[$rallyart.'_start']));
$smarty->assign('start_tag',date("d",$mainconfig[$rallyart.'_start']));
$smarty->assign('start_minute',date("i",$mainconfig[$rallyart.'_start']));
$smarty->assign('start_monat',date("m",$mainconfig[$rallyart.'_start']));
$smarty->assign('start_jahr',date("Y",$mainconfig[$rallyart.'_start']));

$smarty->assign('ende_stunde',date("H",$mainconfig[$rallyart.'_ende']));
$smarty->assign('ende_tag',date("d",$mainconfig[$rallyart.'_ende']));
$smarty->assign('ende_tag',date("d",$mainconfig[$rallyart.'_ende']));
$smarty->assign('ende_minute',date("i",$mainconfig[$rallyart.'_ende']));
$smarty->assign('ende_monat',date("m",$mainconfig[$rallyart.'_ende']));
$smarty->assign('ende_jahr',date("Y",$mainconfig[$rallyart.'_ende']));

if ($rallyart == 'dkr' or $rallyart == 'dar' or $rallyart == 'dbr'){$smarty->assign('startpot',$mainconfig[$rallyart.'_startpot']);$smarty->assign('zuwachs',$mainconfig[$rallyart.'_zuwachs']);}
$smarty->assign('plaetze',$mainconfig[$rallyart.'_plaetze']);
$smarty->assign('rallyart',$rallyart);
$smarty->assign('rallytitel',$rallytitel);
$smarty->display('admin/rallysystem.tpl');
?>