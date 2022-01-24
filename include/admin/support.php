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
* Datei: include/admin/support.php
*******************************************************************************/
$ticketid = Request::get('ticketid');
$newticket = Request::get('newticket');
$replyticket = Request::get('replyticket');
$clear = Request::get('clear');
$betreff = Request::post('betreff');
$nachricht = Request::post('nachricht');
$submit = Request::post('submit');

/* Sonderzeichen absichern */
if (isset ($nachricht)) $nachricht = htmlentities ($nachricht);
if (isset ($betreff)) $betreff = htmlentities ($betreff);

if (isset ($clear)) {
	$db->query ('UPDATE equinox_'.$pageconfig['install_nr'].'_support SET status = 2 WHERE status = 1 AND zuletzt <= '.(time()-(86400*7)));
	$db->query ('DELETE FROM equinox_'.$pageconfig['install_nr'].'_support WHERE status = 2 AND zuletzt <= '.(time()-(86400*90)));
	$erfolg ='<h1>Ticketsystem bereinigen</h1>Die Ticketsystem-Datenbank wurde erfolgreich bereinigt!';

$smarty->assign('erfolg',$erfolg);
$smarty->assign('clear',$clear);
$smarty->display('admin/support.tpl');
exit();
}

/* Auf Ticket antworten */
if (isset ($replyticket)) {
	$replyticket = (int)$replyticket;

	$ticket = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE parentid = 0 AND id = '.sanitize($replyticket));
	$anzahl2 = $db->numrows($ticket);
$erfolg = false;
$fehler = false;
    if ($anzahl2 == 0) {
		$fehler = 'Es wurde keine g&uuml;ltige ID &uuml;bergeben / Ticket nicht gefunden!';
		$erfolg = false;
	} else {
		$one = $db->fetch($ticket);
		if ($one['status'] == 2) {
			$erfolg = 'Das Ticket ist bereits geschlossen, das Antworten auf das Ticket ist nicht mehr m&ouml;glich!';
		}
	}

	$betreff = trim($betreff);
	if (isset ($submit)) {
		if (!empty ($nachricht)) {
            if (strlen ($nachricht) >= 10) {
			    
				$db->query ('INSERT INTO `equinox_'.$pageconfig['install_nr'].'_support` (`parentid`, `user`, `erstellt`, `betreff`, `nachricht`) VALUES ('.sanitize($replyticket).', "'.sanitize($_SESSION['adminlogin']).'", '.time().', "'.sanitize($betreff).'", "'.sanitize($nachricht).'")');
				$db->query ('UPDATE `equinox_'.$pageconfig['install_nr'].'_support` SET status = 1, zuletzt = '.time().' WHERE id = '.sanitize($replyticket));
				$erfolg = 'Deine Antwort wurde erfolgreich abgeschickt!';
			} else $fehler = 'Alle Felder müssen mind. 10 Zeichen haben!';
		} else $fehler = 'Bitte alle Felder ausf&uuml;llen!';
	}

$smarty->assign('fehler',$fehler);
$smarty->assign('erfolg',$erfolg);
$smarty->assign('replyticket',$replyticket);
$smarty->assign('betreff',$betreff); 
$smarty->assign('nachricht',$nachricht); 
$smarty->display('admin/support.tpl');

}

/* Einzelnes Ticket anzeigen */
if (isset ($ticketid)) {
	$ticketid = (int)$ticketid;
    $tickets_outs1 =array();
	$ticket = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE parentid = 0 AND id = '.sanitize($ticketid));
    $anzahl1 = $db->numrows($ticket);

   if ($anzahl1 > 0) {
		$one = $db->fetch($ticket);
        $smarty->assign('betreff1',$one['betreff']);     
        $smarty->assign('nachricht1',nl2br ($one['nachricht'])); 
        $smarty->assign('user',$one['user']); 
        $smarty->assign('erstellt',date ('d.m.Y H:i', $one['erstellt'])); 
        
		$tickets = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE parentid = '.sanitize($ticketid).' ORDER BY erstellt ASC');
		$anzahl = $db->numrows($tickets);
		$i = 1;
		while ($ticket = $db->fetch($tickets)) {
			if (empty ($ticket['betreff'])) $ticket['betreff'] = 'Kein Betreff';    
             $tickets_out1 = array(
      'nachricht' => nl2br ($ticket['nachricht']),
      'id' => $ticket['id'],
      'betreff' => $ticket['betreff'],
      'erstellt' => date('d.m.Y H:i', $ticket['erstellt']),
      'user' => $ticket['user'],
      'i' => $i,
      'anzahl' => $anzahl
    );
        $tickets_outs1[] = $tickets_out1;	
        $i++;
        }
      
$smarty->assign('anzahl1',$anzahl1);
$smarty->assign('i',$i);        
$smarty->assign('tickets',$tickets_outs1);    
    }
$smarty->assign('anzahl',$anzahl);
$smarty->assign('betreff',$betreff); 
$smarty->assign('nachricht',$nachricht);    
$smarty->assign('id',$one['id']);    
$smarty->assign('status',$one['status']);    
$smarty->assign('ticketid',$ticketid);    
$smarty->display('admin/support.tpl');

}

if( !isset($ticketid) && !isset($newticket) && !isset($replyticket)){
$status = Request::get('status');
$tickets_outs = array();
	/* Aktuelle Tickets anzeigen */
if (!isset ($status)) $status = 0; else $status = (int)$status;
$tickets = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE status = '.sanitize($status).' AND parentid = 0 ORDER BY zuletzt ASC, erstellt DESC');
	$linecolor = '';
	$anzahl = $db->numrows($tickets);
    if ($anzahl > 0) {
		while ($ticket =$db->fetch($tickets)) {
			$image = ($ticket['status'] == 1) ? 'gruen.gif' : 'gelb.gif';
			$image = ($ticket['status'] == 2) ? 'rot.gif' : $image;
			$linecolor = ($linecolor == '#ffffff') ? '#ededed' : '#ffffff';
			$zuletzt = ($ticket['zuletzt'] != 0) ? date('d.m.Y H:i', $ticket['zuletzt']) : '---';
     
     $tickets_out = array(
      'linecolor' => $linecolor,
      'image' => $image,
      'zuletzt' => $zuletzt,
      'id' => $ticket['id'],
      'betreff' => $ticket['betreff'],
      'user' => $ticket['user'],
      'erstellt' => date('d.m.Y H:i', $ticket['erstellt'])
    );
$tickets_outs[] = $tickets_out;         
        }
     }
$smarty->assign('anzahl',$anzahl);     
$smarty->assign('tickets',$tickets_outs); 
$smarty->assign('ticketid',$ticketid); 
$smarty->assign('newticket',$newticket); 
$smarty->assign('replyticket',$replyticket); 
$smarty->display('admin/support.tpl');

}