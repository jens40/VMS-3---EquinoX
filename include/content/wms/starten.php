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
* Datei: include/wms/starten.php
*******************************************************************************/

/* Pruefen, ob User eingeloggt */
access ();


/* Preiskonfiguration laden */
require_once('include/system/werbepreise.php');
$get_werbeart = Request::get('get_werbeart');
if (isset($get_werbeart)) {
$k_werbeform = Request::post('k_werbeform');
$send_kampstart = Request::post('send_kampstart');    
$k_aufendhalt = Request::post('k_aufendhalt');
$k_reloadzeit = Request::post('k_reloadzeit');
$kamp_start = '';
$s_kampagne = Request::post('s_kampagne');
$k_name = Request::post('k_name');
$k_tl = Request::post('k_tl');
$k_info = Request::post('k_info');
$k_ziel = Request::post('k_ziel');
$k_werbemittel = Request::post('k_werbemittel');
$k_menge = Request::post('k_menge');
$k_verguetung = Request::post('k_verguetung');

/* Variabeln vordefinieren */
if (!isset($get_werbeart)) $get_werbeart = "forcedbanner";
if (!isset($k_werbeform)) $k_werbeform = $get_werbeart;
if (!isset($k_fehler)) $k_fehler = "";
if (!isset($format)) $format = "";
if (!isset($bannerpixel)) $bannerpixel = 1;
if (!isset($werbename)) $werbename = substr_replace($k_werbeform,substr_replace(strtoupper($k_werbeform),'',1,30),0,1);
if (!isset($send_kampstart)) $send_kampstart = "";
if (!isset($s_kampagne)) $s_kampagne = "";
if (!isset($k_aufendhalt)) $k_aufendhalt = "";
if (!isset($k_reloadzeit)) $k_reloadzeit = "";
if (!isset($k_name)) $k_name = "";
if (!isset($k_tl)) $k_tl = "";
if (!isset($k_info)) $k_info = "";
if (!isset($k_ziel)) $k_ziel = "";
if (!isset($k_werbemittel)) $k_werbemittel = "";
if (!isset($k_menge)) $k_menge = @floor($minbuchung/$grundpreis[$k_werbeform]);
if (!isset($k_verguetung)) $k_verguetung = $grundpreis[$k_werbeform];
if (Filter::$do == 'send_kampstart') {
	/* Eingabe auf Fehler prüfen */
	if (!$k_name or !$k_info or !$k_ziel or !$k_werbemittel or !$k_menge or !$k_verguetung) {
	Filter::$msgs['error'] = "Bitte alle Felder ausfüllen!";
	}
       
	if ($k_verguetung < $grundpreis[$k_werbeform]) {
	Filter::$msgs['error'] = "Grundvergütung '".number_format($grundpreis[$k_werbeform],2,',','.')."'!";
	}    

	if ( $k_menge < (($minbuchung / $k_verguetung) * 0.99) ) {
	Filter::$msgs['error'] = "Mindesbuchung '".floor($minbuchung / $k_verguetung)."'!";
	}

  if(preg_match("/[^0-9A-z ]/",$k_name) or strlen($k_name) < 5)
  {
   Filter::$msgs['error'] = "Kampagnenname nur Buchstaben und Zahlen (min. 5 / max. 50 Stellen)!";
  }
  if(preg_match("/[^0-9A-z ]/",$k_info) or strlen($k_info) < 5)
  {
   Filter::$msgs['error'] = "Zusatzinformationen nur Buchstaben und Zahlen (min. 5 / max. 50 Stellen)!";
  }

	if ($k_werbeform == 'buttonklicks' or $k_werbeform == 'buttonviews' or $k_werbeform == 'forcedbanner' or $k_werbeform == 'bannerviews' or $k_werbeform == 'bannerklicks' or $k_werbeform == 'surfbarviews' or $k_werbeform == 'surfbarklicks') {
	/* Bannergrösse berechnen */
	$bannergroesse = @getimagesize($k_werbemittel);
	$bannerpixel = $bannergroesse[0] * $bannergroesse[1];
		if ($k_werbeform == 'buttonklicks' or $k_werbeform == 'buttonviews') {
			if ($bannergroesse[0] != 88 or $bannergroesse[1] != 31) {
			Filter::$msgs['error'] = 'Falsches Bannerformat (nur 88*31)';
			}
		} else {
			if ($bannergroesse[0] != 468 or $bannergroesse[1] != 60) {
			Filter::$msgs['error'] = 'Falsches Bannerformat (nur 468*60)';
			}
		}
	} 

		/* Kampgnen Endpreis berechnen */
		if ($k_werbeform == 'paidmails') {
		$zwischensumme = ((($k_verguetung * $aufendhaltspreis[$k_aufendhalt]) * $k_menge) * 1);
		} else if ($k_werbeform == 'forcedbanner') {
			$zwischensumme = ((($k_verguetung * $aufendhaltspreis[$k_aufendhalt]) * $k_menge) * $reloadpreis[$k_reloadzeit]);
		} else  {
			$zwischensumme = ((($k_verguetung * 1) * $k_menge) * $reloadpreis[$k_reloadzeit]);
		}

		/* Guthaben des User prüfen */
		if (($zwischensumme * $gebuehr['betreiber']) > $userdaten['guthaben']) {
		Filter::$msgs['error'] = 'Werbekonto weißt ungenügent Guthaben auf!!';
		}

	/* Berechnung des Preises und Guthabenprüfung */
	if(empty(Filter::$msgs)){
	   
		/* Kampagne eintragen, starten und Userkonto belasten */
		if (empty(Filter::$msgs) and Filter::$do == 'send_kampstart' and $s_kampagne) {
			/* Eingaben filtern */
			if ($k_werbeform == 'buttonklicks' or $k_werbeform == 'forcedbanner' or $k_werbeform == 'bannerklicks' or $k_werbeform == 'paidmails' or $k_werbeform == 'surfbarklicks' or $k_werbeform == 'textlinkklicks') {
			$in_klicks = $k_menge;
			$in_views = 0;
			} else {
			$in_klicks = 0;
			$in_views = $k_menge;
			}
			if ($k_werbeform == 'paidmails') {
			$text_link = '';
			$text_mail = $k_werbemittel;
			$banner_url = '';
			} else if ($k_werbeform == 'textlinkklicks' or $k_werbeform == 'textlinkviews') {
			$text_link = $k_werbemittel;
			$text_mail = '';
			$banner_url = '';
			} else {
			$text_link = '';
			$text_mail = '';
			$banner_url = $k_werbemittel;
			}
			if ($k_werbeform == 'forcedbanner' or $k_werbeform == 'paidmails') {
			$payout = $k_verguetung;
			} else {
			$payout = 0;
			}

		/* Kampagne eintragen, starten und Konto belasten */
		$nb = $zwischensumme / $k_menge;
		$endpreis = $zwischensumme * $gebuehr['betreiber'];
		    $data = array(
			'userid' => sanitize($_SESSION['uid']),
			'format' => sanitize($k_werbeform),
            'in_views' => sanitize($in_views),
            'in_clicks' => sanitize($in_klicks),
            'reload' => sanitize(($k_reloadzeit*3600)),
            'url_banner' => sanitize($banner_url),
			'url_ziel' => sanitize($k_ziel),
			'text_link' => sanitize($text_link),
            'text_mail' => sanitize($text_mail),
            'name' => sanitize($k_name),
            'bemerkung' => sanitize($k_info),
            'payout' => sanitize($payout),   
            'aufendhalt' => sanitize($k_aufendhalt),
            'status' => sanitize('1'),
            'nb' => sanitize($nb)  
            );
        $kamp_start = $db->insert("equinox_".$pageconfig['install_nr']."_kampagnen", $data); 	
		if ($kamp_start) {
		kontoauszug($_SESSION['nickname'],'Intern',$endpreis,'Kampagnenstart ('.$werbename.')');
		kontobuchung($_SESSION['nickname'],'-',$endpreis,$endpreis,$endpreis,0,0,$endpreis);
		$smarty->assign('endpreis',number_format($endpreis,2,',','.'));
        }    
    
    }       
       
/* Kontrollausgabe vor dem Kampagnenstart */
if (Filter::$do == 'send_kampstart' and empty(Filter::$msgs)) {
$smarty->assign('bannerpixel',$bannerpixel);    
$smarty->assign('kamp_start',$kamp_start);
$smarty->assign('k_werbemittel',str_replace("\\","",$k_werbemittel));
$smarty->assign('k_ziel',str_replace("\\","",$k_ziel));
$smarty->assign('gebuehr',$gebuehr);
$smarty->assign('zwischensumme',$zwischensumme);
$smarty->assign('k_menge',$k_menge);
$smarty->assign('k_reloadzeit',$k_reloadzeit);
$smarty->assign('aufendhaltspreis',$aufendhaltspreis);
$smarty->assign('k_aufendhalt',$k_aufendhalt);
$smarty->assign('k_verguetung',$k_verguetung);
$smarty->assign('k_info',str_replace("\\","",$k_info));
$smarty->assign('k_name',str_replace("\\","",$k_name));
$smarty->assign('werbename',$werbename); 
$smarty->assign('k_werbeform',$k_werbeform);    
$smarty->display('wms/starten_details.tpl');
exit();
}       
       
	}else{Filter::msgStatus();}
}    

/* Zeichen filtern, ersetzen und runden */
$k_verguetung = str_replace(",",".",$k_verguetung);
$k_verguetung = round($k_verguetung , 2);
$k_menge = str_replace(",",".",$k_menge);
$k_menge = floor($k_menge);
$k_name = str_replace("|","",$k_name);
$k_info = str_replace("|","",$k_info);
$k_werbemittel = str_replace("|","",$k_werbemittel);
$k_ziel = str_replace("|","",$k_ziel);

$smarty->assign('aufendhaltsk_aufendhalt',$aufendhaltspreis[$k_aufendhalt]);
$smarty->assign('grundpreis_k_reloadzeit',$reloadpreis[$k_reloadzeit]);    
$smarty->assign('betreiber',$gebuehr['betreiber']);
$smarty->assign('grundpreis_k_werbeform',$grundpreis[$k_werbeform]);
$smarty->assign('k_werbeform',$k_werbeform);
$smarty->assign('minbuchung',$minbuchung);
$smarty->assign('send_kampstart',$send_kampstart);    
$smarty->assign('werbename',$werbename);
$smarty->assign('k_name',str_replace("\\","",$k_name));
$smarty->assign('k_info',str_replace("\\","",$k_info));
$smarty->assign('k_verguetung',$k_verguetung);
$smarty->assign('k_menge',$k_menge);
$smarty->assign('k_ziel',str_replace("\\","",$k_ziel));
$smarty->assign('k_werbemittel',str_replace("\\","",$k_werbemittel));
$smarty->assign('k_aufendhalt',$k_aufendhalt);
$smarty->assign('k_reloadzeit',$k_reloadzeit);
$smarty->assign('aufendhaltspreis_0',$aufendhaltspreis[0]);
$smarty->assign('aufendhaltspreis_verguetung_0',number_format((($aufendhaltspreis[0]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_5',$aufendhaltspreis[5]);
$smarty->assign('aufendhaltspreis_verguetung_5',number_format((($aufendhaltspreis[5]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_10',$aufendhaltspreis[10]);
$smarty->assign('aufendhaltspreis_verguetung_10',number_format((($aufendhaltspreis[10]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_15',$aufendhaltspreis[15]);
$smarty->assign('aufendhaltspreis_verguetung_15',number_format((($aufendhaltspreis[15]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_20',$aufendhaltspreis[20]);
$smarty->assign('aufendhaltspreis_verguetung_20',number_format((($aufendhaltspreis[20]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_25',$aufendhaltspreis[25]);
$smarty->assign('aufendhaltspreis_verguetung_25',number_format((($aufendhaltspreis[25]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_30',$aufendhaltspreis[30]);
$smarty->assign('aufendhaltspreis_verguetung_30',number_format((($aufendhaltspreis[30]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_45',$aufendhaltspreis[45]);
$smarty->assign('aufendhaltspreis_verguetung_45',number_format((($aufendhaltspreis[45]-1)*100),2,',','.'));
$smarty->assign('aufendhaltspreis_60',$aufendhaltspreis[60]);
$smarty->assign('aufendhaltspreis_verguetung_60',number_format((($aufendhaltspreis[60]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_1',$reloadpreis[1]);
$smarty->assign('reloadpreis_verguetung_1',number_format((($reloadpreis[1]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_2',$reloadpreis[2]);
$smarty->assign('reloadpreis_verguetung_2',number_format((($reloadpreis[2]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_4',$reloadpreis[4]);
$smarty->assign('reloadpreis_verguetung_4',number_format((($reloadpreis[4]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_8',$reloadpreis[8]);
$smarty->assign('reloadpreis_verguetung_8',number_format((($reloadpreis[8]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_12',$reloadpreis[12]);
$smarty->assign('reloadpreis_verguetung_12',number_format((($reloadpreis[12]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_16',$reloadpreis[16]);
$smarty->assign('reloadpreis_verguetung_16',number_format((($reloadpreis[16]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_20',$reloadpreis[20]);
$smarty->assign('reloadpreis_verguetung_20',number_format((($reloadpreis[20]-1)*100),2,',','.'));
$smarty->assign('reloadpreis_24',$reloadpreis[24]);
$smarty->assign('reloadpreis_verguetung_24',number_format((($reloadpreis[24]-1)*100),2,',','.'));
$smarty->assign('message',Filter::$showMsg);
$smarty->display('wms/starten_werbeart.tpl');    
}else{



$smarty->assign('forcedbanner_minbuchung',number_format(floor($minbuchung/$grundpreis['forcedbanner']),0,',','.'));
$smarty->assign('forcedbanner_preis',number_format($grundpreis['forcedbanner'],2,',','.'));
$smarty->assign('bannerviews_minbuchung',number_format(floor($minbuchung/$grundpreis['bannerviews']),0,',','.'));
$smarty->assign('bannerviews_preis',number_format($grundpreis['bannerviews'],2,',','.'));
$smarty->assign('bannerklicks_minbuchung',number_format(floor($minbuchung/$grundpreis['bannerklicks']),0,',','.'));
$smarty->assign('bannerklicks_preis',number_format($grundpreis['bannerklicks'],2,',','.'));
$smarty->assign('buttonviews_minbuchung',number_format(floor($minbuchung/$grundpreis['buttonviews']),0,',','.'));
$smarty->assign('buttonviews_preis',number_format($grundpreis['buttonviews'],2,',','.'));
$smarty->assign('buttonklicks_minbuchung',number_format(floor($minbuchung/$grundpreis['buttonklicks']),0,',','.'));
$smarty->assign('buttonklicks_preis',number_format($grundpreis['buttonklicks'],2,',','.'));
$smarty->assign('surfbarviews_minbuchung',number_format(floor($minbuchung/$grundpreis['surfbarviews']),0,',','.'));
$smarty->assign('surfbarviews_preis',number_format($grundpreis['surfbarviews'],2,',','.'));
$smarty->assign('surfbarklicks_minbuchung',number_format(floor($minbuchung/$grundpreis['surfbarklicks']),0,',','.'));
$smarty->assign('surfbarklicks_preis',number_format($grundpreis['surfbarklicks'],2,',','.'));
$smarty->assign('textlinkviews_minbuchung',number_format(floor($minbuchung/$grundpreis['textlinkviews']),0,',','.'));
$smarty->assign('textlinkviews_preis',number_format($grundpreis['textlinkviews'],2,',','.'));
$smarty->assign('textlinkklicks_minbuchung',number_format(floor($minbuchung/$grundpreis['textlinkklicks']),0,',','.'));
$smarty->assign('textlinkklicks_preis',number_format($grundpreis['textlinkklicks'],2,',','.'));
$smarty->assign('paidmails_minbuchung',number_format(floor($minbuchung/$grundpreis['paidmails']),0,',','.'));
$smarty->assign('paidmails_preis',number_format($grundpreis['paidmails'],2,',','.'));
$smarty->display('wms/starten.tpl');
}