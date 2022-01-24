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
* Datei: content/user/support.php
*******************************************************************************/
/* Seite sichern */
access();
$ticketid = Request::get('ticketid');
$newticket = Request::get('newticket');
$replyticket = Request::get('replyticket');
$betreff = Request::post('betreff');
$nachricht = Request::post('nachricht');
$submit = Request::post('submit');

/* Neues Ticket erstellen */
if (isset ($newticket)) {
	$betreff = trim($betreff);
	if (isset ($submit)) {
		if (!empty ($betreff) && !empty ($nachricht)) {
			if (strlen ($betreff) >= 10 && strlen ($nachricht) >= 10) {
				$db->query ('INSERT INTO `equinox_'.$pageconfig['install_nr'].'_support` (`user`, `erstellt`, `betreff`, `nachricht`) VALUES ("'.sanitize($_SESSION['nickname']).'", '.time().', "'.sanitize($betreff).'", "'.sanitize($nachricht).'")');
				Filter::msgSingleOk('Deine Supportanfrage wurde erfolgreich erstellt!');
                $smarty->assign('erfolg',Filter::$showMsg);
			} else Filter::$msgs['error'] = 'Alle Felder müssen mind. 10 Zeichen haben!';
		} else Filter::$msgs['error'] = 'Bitte alle Felder ausf&uuml;llen!';
	}
    
if (!empty(Filter::$msgs)) {
Filter::msgStatus();
$smarty->assign('message',Filter::$showMsg);
}    

$smarty->assign('betreff',$betreff); 
$smarty->assign('nachricht',$nachricht);
$smarty->assign('newticket',$newticket);
$smarty->display('support.tpl');
}

/* Auf Ticket antworten */
if (isset ($replyticket)) {
	$replyticket = (int)$replyticket;
	$ticket = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE user = "'.sanitize($_SESSION['nickname']).'" AND parentid = 0 AND id = '.sanitize($replyticket));
	
    if ($db->numrows ($ticket) == 0) {
		Filter::$msgs['error'] = 'Es wurde keine g&uuml;ltige ID &uuml;bergeben / Ticket nicht gefunden!';
	} else {
		$one = $db->fetch($ticket);
		if ($one['status'] == 2) {
		 Filter::msgSingleOk('Das Ticket ist bereits geschlossen, das Antworten auf das Ticket ist nicht mehr m&ouml;glich!');
		 $smarty->assign('erfolg',Filter::$showMsg);
        }
	}

	$betreff = trim($betreff);
	if (isset ($submit)) {
		if (!empty ($nachricht)) {
			
            if (strlen ($nachricht) >= 10) {
			    
				$db->query ('INSERT INTO `equinox_'.$pageconfig['install_nr'].'_support` (`parentid`, `user`, `erstellt`, `betreff`, `nachricht`) VALUES ('.sanitize($replyticket).', "'.sanitize($_SESSION['nickname']).'", '.time().', "'.sanitize($betreff).'", "'.sanitize($nachricht).'")');
				$db->query ('UPDATE `equinox_'.$pageconfig['install_nr'].'_support` SET status = 0, zuletzt = '.time().' WHERE id = '.sanitize($replyticket));
				Filter::msgSingleOk('Deine Antwort wurde erfolgreich abgeschickt!');
                $smarty->assign('erfolg',Filter::$showMsg);
			} else Filter::$msgs['error'] = 'Alle Felder müssen mind. 10 Zeichen haben!';
		} else Filter::$msgs['error'] = 'Bitte alle Felder ausf&uuml;llen!';
	}

if (!empty(Filter::$msgs)) {
Filter::msgStatus();
$smarty->assign('message',Filter::$showMsg);
}    
 
$smarty->assign('replyticket',$replyticket);
$smarty->display('support.tpl');
}

/* Einzelnes Ticket anzeigen */
if (isset ($ticketid)) {
	$ticketid = (int)$ticketid;
    $tickets_outs1 =array();
	$ticket = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE user = "'.sanitize($_SESSION['nickname']).'" AND parentid = 0 AND id = '.sanitize($ticketid));
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
$smarty->display('support.tpl');
}

if( !isset($ticketid) && !isset($newticket) && !isset($replyticket)){
$tickets_outs = array();
	/* Aktuelle Tickets anzeigen */
$tickets = $db->query ('SELECT * FROM equinox_'.$pageconfig['install_nr'].'_support WHERE user = "'.sanitize($_SESSION['nickname']).'" AND parentid = 0 ORDER BY erstellt DESC');
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
$smarty->display('support.tpl');
}
?>