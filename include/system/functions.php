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
* Datei: include/system/function.php
*******************************************************************************/

/* Berechnen der Parsezeit */
function parsetime($parestart) {
$parsestart = explode(" ", $parestart);
$parseende = explode(" ", microtime());
$parsetime = number_format($parseende[1] - $parsestart[1] + $parseende[0] - $parsestart[0],5,",",".");
return $parsetime;
}

/* Funktion zum sichern alles Variabeln */
function save_array($array) {
	reset($array);
	foreach($array as $key => $val){
		if (is_string($val)) $array[$key] = stripslashes(addslashes(strip_tags($val)));
		elseif (is_array($val)) $array[$key] = save_array($val);
	}
	return $array;
}

function create_code($code_laenge) {
srand((double)microtime()*1000000);
$created_code = '';
$zeichen="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890#*+&";
for ($i=0;$i<$code_laenge;$i++) {
$n=rand() % strlen($zeichen);
$created_code .=substr($zeichen, $n, 1);
}
return $created_code;
}

/* Funktion um E-Mails zu senden */
function sendmail($mailtext,$empfaenger,$titel) {
global $mainconfig;
require_once './include/system/phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer(true);
$mail->SetLanguage("de", './include/system/phpmailer/language/');
$pattern = '#(^|[^\"=]{1})(http://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm';
$mailtext = preg_replace($pattern,"\\1<a href=\"\\2\\3\"><u>\\2\\3</u></a>\\4",$mailtext);
$mailtext = nl2br($mailtext);

/* Header von Sendmail */
$header  = "From:".$mainconfig['seitenname']."<".$mainconfig['betreibermail'].">\n";
$header .= "Reply-To: ".$mainconfig['betreibermail']."\n"; 
$header .= "X-Mailer: PHP/" . phpversion(). "\n";          
$header .= "X-Sender-IP: $REMOTE_ADDR\n"; 
$header .= "Content-Type: text/html";

/* Header der eMails */
$email_kopf = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" href="'.$mainconfig['seitenurl'].'/style.css" type="text/css">
</head>
<body>
<p>
';

/* Footer der eMails */
$email_fuss = '
<br>
<hr size="1" align="left">
<sub>Du erhälst diese eMail weil Du Mitglied bei <a href="'.$mainconfig['seitenurl'].'" target="_blank"><b>'.$mainconfig['seitenname'].'</b></a> bist.</sub>
</p>
</body>
</html>';

$emailtext = $email_kopf.$mailtext.$email_fuss;
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP(true);                                      // Set mailer to use SMTP
    $mail->Host = $mainconfig['smtp_host'];  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $mainconfig['smtp_username'];                 // SMTP username
    $mail->Password = $mainconfig['smtp_passwort'];                           // SMTP password
    $mail->SMTPSecure = false;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $mainconfig['smtp_port'];                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($mainconfig['betreibermail'], $mainconfig['seitenname']);
    $mail->addAddress($empfaenger);  
    $mail->addReplyTo($mainconfig['betreibermail'], $mainconfig['seitenname']);

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $titel;
    $mail->Body    = encodeToIso($emailtext);
    $mail->AltBody = encodeToIso($emailtext);
    $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}

function encodeToIso($string) {
     return mb_convert_encoding($string, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
}
/* Schreiben des Kontoauszuges */
function kontoauszug($sender,$empfaenger,$summe,$vzweck) {
$bid = create_code(18);
global $pageconfig,$db,$_SERVER;
if ($sender != 'Intern') $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_kontoauszug (buchungs_id,user,sender,empfaenger,summe,vzweck,zeit,transip) VALUES ('".$bid."','".$sender."','".$sender."','".$empfaenger."','".$summe."','".$vzweck."','".time()."','".$_SERVER['REMOTE_ADDR']."')");
if ($empfaenger != 'Intern') $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_kontoauszug (buchungs_id,user,sender,empfaenger,summe,vzweck,zeit,transip) VALUES ('".$bid."','".$empfaenger."','".$sender."','".$empfaenger."','".$summe."','".$vzweck."','".time()."','".$_SERVER['REMOTE_ADDR']."')");
}

/* Kontobuchungen */
function kontobuchung($user,$richtung,$summe,$refsumme,$zinspunkte,$k_rallay,$b_rally,$a_rally) {
global $pageconfig,$db,$_SESSION,$userdaten,$mainconfig;
if ($mainconfig['skr_start'] <= time() && $mainconfig['skr_ende'] >= time()) {$rally_skr = $k_rallay;} else {$rally_skr = '0';}
if ($mainconfig['dkr_start'] <= time() && $mainconfig['dkr_ende'] >= time()) {$rally_dkr = $k_rallay;$dkr_db = $mainconfig['dkr_zuwachs'];} else {$rally_dkr = '0';$dkr_db = '0';}
if ($mainconfig['sbr_start'] <= time() && $mainconfig['sbr_ende'] >= time()) {$rally_sbr = $b_rally;} else {$rally_sbr = '0';}
if ($mainconfig['dbr_start'] <= time() && $mainconfig['dbr_ende'] >= time()) {$rally_dbr = $b_rally;$dbr_db = $mainconfig['dbr_zuwachs'];} else {$rally_dbr = '0';$dbr_db = '0';}
if ($mainconfig['sar_start'] <= time() && $mainconfig['sar_ende'] >= time()) {$rally_sar = $a_rally;} else {$rally_sar = '0';}
if ($mainconfig['dar_start'] <= time() && $mainconfig['dar_ende'] >= time()) {$rally_dar = $a_rally;$dar_db = $mainconfig['dar_zuwachs'];} else {$rally_dar = '0';$dar_db = '0';}
$db->query("UPDATE equinox_".$pageconfig['install_nr']."_user SET aktivpunkte = aktivpunkte +  ".$a_rally.", guthaben = guthaben ".$richtung."".$summe.", werberverdienst_aktuell = werberverdienst_aktuell + ".$refsumme.", zinspunkte = zinspunkte + ".round($zinspunkte).", aktivzeit = '".time()."', skr = skr + ".$rally_skr.", dkr = dkr + ".$rally_dkr.", sbr = sbr + ".$rally_sbr.", dbr = dbr + ".$rally_dbr.", sar = sar + ".$rally_sar.", dar = dar + ".$rally_dar." WHERE nickname = '".$user."'");
	if (($mainconfig['dkr_start'] <= time() && $mainconfig['dkr_ende'] >= time()) or ($mainconfig['dbr_start'] <= time() && $mainconfig['dbr_ende'] >= time()) or ($mainconfig['dar_start'] <= time() && $mainconfig['dar_ende'] >= time())) {
	$db->query("UPDATE equinox_".$pageconfig['install_nr']."_config SET dkr_startpot = dkr_startpot + '".$dkr_db."', dbr_startpot = dbr_startpot + '".$dbr_db."', dar_startpot = dar_startpot + '".$dar_db."' WHERE config_id = '".$pageconfig['install_nr']."'");
	}
}

function bilanz ($einnahmen,$ausgaben) {
global $pageconfig, $db;
$heute = $db->query("SELECT * FROM equinox_".$pageconfig['install_nr']."_bilanzen WHERE jahr='".date("Y")."' and monat='".date("m")."' and tag='".date("d")."'");
        if ($db->fetch($heute)) {
        $db->query("UPDATE equinox_".$pageconfig['install_nr']."_bilanzen SET einnahmen = einnahmen+".$einnahmen." , ausgaben = ausgaben +".$ausgaben." WHERE jahr='".date("Y")."' and monat='".date("m")."' and tag='".date("d")."'");
        } else {
        $db->query("INSERT INTO equinox_".$pageconfig['install_nr']."_bilanzen (tag,monat,jahr,wtag,einnahmen,ausgaben) VALUES ('".date("d")."','".date("m")."','".date("Y")."','".date("w")."','".$einnahmen."','".$ausgaben."')");
        }
}

function _file($server, $port="", $file="") {

	if($port == "") {
		if(preg_match("/:\/\/(.*):(.*)\/(.*)/",$server,$submatch)) {
			$server = $submatch[1];
			$port = $submatch[2];
			$file = $submatch[3];
		}
		else if(preg_match("/:\/\/([^\/]*)\/(.*)/",$server,$submatch)) {
			$server = $submatch[1];
			$port = 80;
			$file = $submatch[2];
		}
	}
	
	$cont = "";
	$ip = gethostbyname($server);
	$fp = fsockopen($ip, $port);
	if (!$fp)
	{
		return "Unknown";
	}
	else
	{
		$com = "GET /".$file." HTTP/1.0\r\nHost: ".$server."\r\nConnection: Close\r\n\r\n";
		fputs($fp, $com);

		while (!feof($fp))
		{
			$cont .= fread($fp, 4096);
		}
		fclose($fp);
		$return = trim(substr($cont, strpos($cont, "\r\n\r\n")));

		return $return;
	}
}

function ShowPagination($table, $limit, $target, $where = "",$anzahl = "")
{
	global $db;
    if($anzahl==''){
    $main_sql = "SELECT COUNT(*) AS total FROM ".$table." ".$where;
	$total_pages = $db->first($main_sql);
	$total_pages = $total_pages->total;
    }else{
    $total_pages = $anzahl;
    }
	$adjacents = "3";
	$site =  Request::get('site');
	
	if ($site)
		$start = ($site - 1) * $limit;
	else
		$start = 0;
	 
	if ($site == 0) $site = 1;
	$prev = $site - 1;
	$next = $site + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;

      $pagination = "<nav aria-label=\"Page navigation example\">";
      $pagination .= "<ul class=\"pagination justify-content-center\">";
      
	if($lastpage > 1)
	{  
		if ($site > 1)
			$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$prev'>&#139; Previous</a></li>";
		else
			$pagination.= "<li class=\"page-item disabled\"><span class=\"page-link\">&#139; Previous</span></li>";  
	 
		if ($lastpage < 7 + ($adjacents * 2))
		{  
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $site)
				$pagination.= "<li class=\"page-item active\"><span class=\"page-link\">$counter</span></li>";
				else
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$counter'>$counter</a></li>";                  
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($site < 1 + ($adjacents * 2))      
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $site)
						$pagination.= "<li class=\"page-item active\"><span class=\"page-link\">$counter</span></li>";
					else
						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$counter'>$counter</a></li>";                  
				}
				$pagination.= "...";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$lpm1'>$lpm1</a></li>";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$lastpage'>$lastpage</a></li>";      
			}
			elseif($lastpage - ($adjacents * 2) > $site && $site > ($adjacents * 2))
			{
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=1'>1</a></li>";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=2'>2</a></li>";
				$pagination.= "...";
				
				for ($counter = $site - $adjacents; $counter <= $site + $adjacents; $counter++)
				{
					if ($counter == $site)
						$pagination.= "<li class=\"page-item active\"><span class=\"page-link\">$counter</span></li>";
					else
						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$counter'>$counter</a></li>";                  
				}
				
				$pagination.= "..";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$lpm1'>$lpm1</a></li>";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$lastpage'>$lastpage</a></li>";      
			}
			else
			{
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=1'>1</a></li>";
				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=2'>2</a></li>";
				$pagination.= "..";
				
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $site)
						$pagination.= "<li class=\"page-item active\"><span class=\"page-link\">$counter</span></li>";
					else
						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$counter'>$counter</a></li>";                  
				}
			}
	}
	 
	if ($site < $counter - 1)
		$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href='".$target."site=$next'>Next &#155;</a>";
	else
		$pagination.= "<li class=\"page-item disabled\"><span class=\"page-link\">Next &#155;</span></li>";
		$pagination.= "</ul>\n";
        $pagination.= "</nav>\n";        
	}

		return $pagination;
	}

/* Diesen Code nicht ändern oder löschen */
/*    Don't remove or edit this Code     */
function dsn_copyright($lizenzkey) {
echo '
<br>
<div align="center">
<table cellpadding="3" cellspacing="1" border="0" bgcolor="#000000">
<tr>
<td bgcolor="#f0f0f0" align="center">
<font face="Verdana,Geneva,Arial,Helvetica,sans-serif" color="#000000" style="font-size:10px;">&nbsp;&nbsp;VMS 3 - EquinoX&sup3; &copy; by <a href="http://www.com-dat.de" target="_blank" style="text-decoration:none;color: #0000cc;">Com-Dat.De</a>&nbsp;&nbsp;<br>
&nbsp;&nbsp;[Lizenzkey: '.$lizenzkey.']&nbsp;&nbsp;</font>
</td>
</tr>
</table>
</div>';
}
?>
