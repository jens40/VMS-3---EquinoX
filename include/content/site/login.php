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
* Datei: include/site/login.php
*******************************************************************************/
$username = Request::post('username');
$passwort = Request::post('passwort');
//nl2br(print_r($_SESSION,true));
if (!empty(Filter::$msgs)){
Filter::msgStatus();    
}

$smarty->assign('message',Filter::$showMsg);
$smarty->assign('username',$username);
$smarty->display('login.tpl');

?>