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
* Datei: include/admin/news.php
*******************************************************************************/
$auffuehren = Request::post('auffuehren');
$loadpost = Request::post('load');
$loader = Request::post('loader');
$id = Request::post('id');
$titelpost = Request::post('titel');
$newspost = Request::post('news');

if (!isset($titel))					$titel					= '';
if (!isset($news))					$news					= '';
if (!isset($id))					$id						= '0';
if (!isset($auffuehren))	$auffuehren	= '0';
if (!isset($load))			$load			= '0';
if (!isset($loader))		$loader		= '0';

if ($auffuehren == 'Ausführen') {
if ($id == 0 ) $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_news (zeit,titel,news) VALUES ('".time()."','".sanitize($titelpost)."','".sanitize($newspost)."')");
if ($id >= 1 ) $db->query("UPDATE equinox_".$pageconfig['install_nr']."_news SET titel='".sanitize($titelpost)."',news='".sanitize($newspost)."' WHERE news_id='".sanitize($id)."'");
}

if ($loadpost == 'Editieren') {
$edit = $db->fetch($db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_news WHERE news_id='".sanitize($loader)."'"));
$titel	= $edit['titel'];
$news	= $edit['news'];
$id		= $edit['news_id'];
}

if ($loadpost == 'Löschen') {
$db->query("DELETE FROM equinox_".$pageconfig['install_nr']."_news WHERE news_id='".sanitize($loader)."'");
}

$old_news = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_news ORDER BY news_id DESC");
$load_outs = array();
while ($load = $db->fetch($old_news)) {

     $load_out = array(
      'news_id' => $load['news_id'],
      'titel' => $load['titel'],
      'zeit' => date("d.m.Y - H:i",$load['zeit'])
    );
$load_outs[] = $load_out; 
 
 
}

$smarty->assign('news',$news); 
$smarty->assign('titel',$titel); 
$smarty->assign('id',$id); 
$smarty->assign('load',$load_outs);  
$smarty->display('admin/news.tpl');