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
* Datei: include/cash/klick4.php
*******************************************************************************/

/* Pruefen, ob User eingeloggt */
access ();
$f_banner_outs = array();
/* Anzeige-Statistik */
$StatGesamt = $db->fetch($db->query('SELECT COUNT(tk.kampagnen_id) AS anzahl, SUM(tk.payout) AS payout, SUM(tk.aufendhalt) AS zeit FROM equinox_'.$pageconfig['install_nr'].'_kampagnen tk WHERE tk.format = "forcedbanner" AND tk.status = 1'));
$StatNotReload = $db->fetch($db->query('SELECT COUNT(tk.kampagnen_id) AS anzahl, SUM(tk.payout) AS payout, SUM(tk.aufendhalt) AS zeit FROM equinox_'.$pageconfig['install_nr'].'_kampagnen AS tk LEFT OUTER JOIN equinox_'.$pageconfig['install_nr'].'_reloads AS tr ON (tr.kampagnen_id = tk.kampagnen_id AND tr.uid = '.$_SESSION['uid'].' AND tr.reload_bis >= '.time().') WHERE tr.kampagnen_id IS NULL AND tk.format = "forcedbanner" AND tk.status = 1'));
if (empty($StatGesamt['anzahl'])) {
    $StatGesamt['anzahl'] = 0.01;
}
$forcedbanner = $db->query('SELECT tk.kampagnen_id, tk.url_banner, tk.reload, tk.payout, tk.aufendhalt FROM equinox_'.$pageconfig['install_nr'].'_kampagnen AS tk LEFT OUTER JOIN equinox_'.$pageconfig['install_nr'].'_reloads AS tr ON (tr.kampagnen_id = tk.kampagnen_id AND tr.uid = '.$_SESSION['uid'].' AND tr.reload_bis >= '.time().') WHERE tr.kampagnen_id IS NULL AND tk.format = "forcedbanner" AND tk.status = 1 AND tk.userid != "'.$_SESSION['uid'].'" LIMIT '.$userdaten['max_banner']);
	while ($f_banner = $db->fetch($forcedbanner)) {

     $f_banner_out = array(
      'kampagnen_id' => $f_banner['kampagnen_id'],
      'url_banner' => $f_banner['url_banner'],
      'reload' => round (($f_banner['reload']/3600), 0),
      'payout' => number_format ($f_banner['payout'], $mainconfig['nach_koma'], ',', '.'),
      'aufendhalt' => $f_banner['aufendhalt']
    );	
 $f_banner_outs[] = $f_banner_out;
}
$smarty->assign('forcedbanner',$db->numrows ($forcedbanner));
$smarty->assign('gesamt_payout',number_format ($StatGesamt['payout'], $mainconfig['nach_koma'], ',', '.'));
$smarty->assign('f_banner',$f_banner_outs);
$smarty->assign('payout',number_format ($StatNotReload['payout'], $mainconfig['nach_koma'], ',', '.'));
$smarty->assign('durchschnitt_verguetung',number_format (($StatGesamt['payout']/$StatGesamt['anzahl']), $mainconfig['nach_koma'], ',', '.'));
$smarty->assign('banner_reload',number_format (($StatGesamt['anzahl']-$StatNotReload['anzahl']), 0, '', ''));
$smarty->assign('zeit_anzahl',number_format (($StatGesamt['zeit']/$StatGesamt['anzahl']), 2, ',', '.'));
$smarty->assign('StatNotReload_anzahl',$StatNotReload['anzahl']);
$smarty->display('klick4.tpl');