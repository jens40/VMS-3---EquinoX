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
* Datei: include/site/start.php
*******************************************************************************/
    $news = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_news ORDER BY news_id DESC LIMIT 1");
	$news_outs = array();
    while ($nz = mysqli_fetch_array($news)) {          
     $news_out = array(
      'titel' => $nz['titel'],
      'zeit' => date("d.m.Y - H:i:s",$nz['zeit']),
      'news' => nl2br($nz['news']),
    );
    $news_outs[] = $news_out;
    }
$smarty->assign('news_out',$news_outs);
$smarty->display('start.tpl');

?>