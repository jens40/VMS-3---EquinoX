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
* Datei: include/admin/kamp_starten.php
*******************************************************************************/
$get_werbeart = Request::get('get_werbeart');
$k_name = Request::post('k_name');
$k_info = Request::post('k_info');
$k_werbeform = Request::post('k_werbeform');
$k_verguetung = Request::post('k_verguetung');
$k_menge = Request::post('k_menge');
$k_ziel = Request::post('k_ziel');
$k_werbemittel = Request::post('k_werbemittel');
$k_aufendhalt = Request::post('k_aufendhalt');
$k_reloadzeit = Request::post('k_reloadzeit');
$send_kampstart = Request::post('send_kampstart');
$s_kampagne = Request::post('s_kampagne');
$k_tl = Request::post('k_tl');
$kamp_start = '';
/* Preiskonfiguration laden */
require_once('include/system/werbepreise.php');

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

/* Zeichen filtern, ersetzen und runden */
$k_verguetung = str_replace(",",".",$k_verguetung);
$k_verguetung = round($k_verguetung , 2);
$k_menge = str_replace(",",".",$k_menge);
$k_menge = floor($k_menge);
$k_name = str_replace("|","",$k_name);
$k_info = str_replace("|","",$k_info);
$k_werbemittel = str_replace("|","",$k_werbemittel);
$k_ziel = str_replace("|","",$k_ziel);

if (Filter::$do == 'send_kampstart') {
  if(!$k_name or !$k_info or !$k_ziel or !$k_werbemittel or !$k_menge or !$k_verguetung)
  {
   Filter::$msgs['error'] = "Bitte alle Felder ausfüllen!";
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
	$bannergroesse = getimagesize($k_werbemittel);
	$bannerpixel = $bannergroesse[0] * $bannergroesse[1];
		if ($k_werbeform == 'buttonklicks' or $k_werbeform == 'buttonviews') {
			if ($bannergroesse[0] != 88 or $bannergroesse[1] != 31) {
			Filter::$msgs['error'] = 'Falsches Bannerformat (nur 88*31)\n\n';
			}
		} else {
			if ($bannergroesse[0] != 468 or $bannergroesse[1] != 60) {
			Filter::$msgs['error'] = 'Falsches Bannerformat (nur 468*60)\n\n';
			}
		}
	}

	/* Berechnung des Preises und Guthabenprüfung */
	if(empty(Filter::$msgs)){
		/* Kampgnen Endpreis berechnen */
		if ($k_werbeform == 'paidmails') {
		$zwischensumme = ((($k_verguetung * $aufendhaltspreis[$k_aufendhalt]) * $k_menge) * 1);
		} else if ($k_werbeform == 'forcedbanner') {
			$zwischensumme = ((($k_verguetung * $aufendhaltspreis[$k_aufendhalt]) * $k_menge) * $reloadpreis[$k_reloadzeit]);
		} else  {
			$zwischensumme = ((($k_verguetung * 1) * $k_menge) * $reloadpreis[$k_reloadzeit]);
		}

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
			'userid' => sanitize('0'),
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
$smarty->display('admin/kamp_starten_details.tpl');
exit();
}
}else{Filter::msgStatus();} 


}

$smarty->assign('message',Filter::$showMsg);
$smarty->assign('k_reloadzeit',$k_reloadzeit);
$smarty->assign('k_aufendhalt',$k_aufendhalt);
$smarty->assign('k_werbemittel',str_replace("\\","",$k_werbemittel));
$smarty->assign('k_ziel',str_replace("\\","",$k_ziel));
$smarty->assign('k_menge',$k_menge);
$smarty->assign('k_verguetung',$k_verguetung);
$smarty->assign('k_werbeform',$k_werbeform);
$smarty->assign('k_info',str_replace("\\","",$k_info));
$smarty->assign('k_name',str_replace("\\","",$k_name)); 
$smarty->assign('werbename',$werbename); 
$smarty->display('admin/kamp_starten.tpl');
?>