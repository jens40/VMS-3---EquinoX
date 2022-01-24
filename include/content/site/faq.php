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
* Datei: include/site/faq.php
*******************************************************************************/
  $z=$db->query("select * from equinox_".$pageconfig['install_nr']."_faq order by number");
  $faq1 = array();
  while ($resz = $db->fetch($z))
  {
   
   $faq1['NUMBER'] = $resz['number'];
   $faq1['QUESTION'] = nl2br($resz['question']);
   $faq1['ANSWER'] = nl2br($resz['answer']);
   $faq[] = $faq1;    
  }
  $smarty->assign('faq', $faq);
  
$smarty->display('faq.tpl');

?>