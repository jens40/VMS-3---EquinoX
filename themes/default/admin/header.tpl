<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//DE">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Adminbereich</title>
	<link href="./themes/default/admin/css/style.css" rel="stylesheet">
</head>
<body bgcolor="#f0f0f0">
<style type="text/css">
/* Rahmen um das Image */
  div#Rahmen {
    padding: 0px;
    align:center;
    width:100%;
    font-size:10px;
    color: #ffff00;
  }
  * html div#Rahmen {  /* Korrektur fuer IE 5.x */

  }
  div#Rahmen div {
     clear: left;
  }
   /* Rahmen um das Image */
  ul#Navigation {
    margin: 0; padding: 0;
    text-align: center;
  }

  ul#Navigation li {
    list-style: none;
    float: left;  /* ohne width - nach CSS 2.1 erlaubt */
    position: relative;
    margin: 0px; padding: 0px;
  }
  * html ul#Navigation li {  /* Korrektur fuer den IE */
    margin-bottom: 0.0em;
  }
  
/* Unternavigation */
  ul#Navigation li ul {
    margin: 0; padding: 0;
    position: absolute;
    top: 1.6em; left: -0.0em;
    display: none;  /* Unternavigation ausblenden */
  }
  * html ul#Navigation li ul {  /* Korrektur fuer IE 5.x */
    left: -0.0em;
    lef\t: -0.0em;
  }
  ul#Navigation li:hover ul {
    display: block;  /* Unternavigation in modernen Browsern einblenden */
  }
  ul#Navigation li ul li {
    float: none;
    display: block;
    margin-bottom: 0.0em;
  }
  
/* Button */
  ul#Navigation a, ul#Navigation span {
    margin-left: 0px;
    margin-right: 0px;
    display: block;
    padding: 0.0em 0em;
    padding-left:0px;
    padding-right:0px;
    text-decoration: none; font-weight: normal;
    border: 1px solid #550000;
    color: white; background-color: #aa0000;
    font: Verdana;
  }
  * html ul#Navigation a, * html ul#Navigation span {
    width: 100px;   /* Breite nach altem MS-Boxmodell für IE 5.x */
    w\idth: 100px;  /* korrekte Breite fuer den IE 6 im standardkompatiblen Modus */
  }
  ul#Navigation a:hover, ul#Navigation span {
    border: 1px solid black;
    color: white; 
	background-color: #cc0000;
  }

</style>
<script type="text/javascript">
if(window.navigator.systemLanguage && !window.navigator.language) {
  function hoverIE() {
    var LI = document.getElementById("Navigation").firstChild;
    do {
      if (sucheUL(LI.firstChild)) {
        LI.onmouseover=einblenden; LI.onmouseout=ausblenden;
      }
      LI = LI.nextSibling;
    }
    while(LI);
  }

  function sucheUL(UL) {
    do {
      if(UL) UL = UL.nextSibling;
      if(UL && UL.nodeName == "UL") return UL;
    }
    while(UL);
    return false;
  }

  function einblenden() {
    var UL = sucheUL(this.firstChild);
    UL.style.display = "block";
    UL.style.visibility = "visible";
  }
  function ausblenden() {
    sucheUL(this.firstChild).style.display = "none";
  }

  window.onload=hoverIE;
}
</script>


<div align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td colspan="2" class="head" height="82">
<table cellspacing="0" cellpadding="0" border="0" width="99%">
<tr>
<td><img src="images/admin/headleft.gif" alt="" width="313" height="82" border="0"></td>
<td align="center"><h3>ADMINBEREICH</h3></td>
</tr>
</table>
</td>
</tr>
<tr>
<td colspan="2" class="tm" align="left" valign="middle">
 <div id="Rahmen"><ul id="Navigation">
    <li><a href="#">Classic-Games</a>
      <ul>
        <li><a href="admin.php?admincontent=zechesystem&mode=einzelzeche">Einzelzeche</a></li>
        <li><a href="admin.php?admincontent=zechesystem&mode=multizeche">Multizeche</a></li>
        <li><a href="admin.php?admincontent=zechesystem&mode=multiplayzeche">Multiplayzeche</a></li>
		<li><a href="admin.php?admincontent=zechesystem&mode=rotazeche">Rotazeche</a></li>
		<li><a href="admin.php?admincontent=/spiele/gametor">Gametor</a></li>
      </ul>
    </li>
	<li><a href="#">Währungen</a>
      <ul>
		<li><a href="http://www.klamm.de" target="_blank">Klamm</a></li>
		<li><a href="http://www.paypal.de" target="_blank">PayPal</a></li>
      </ul>
    </li>
	<li><a href="#">EquinoX²</a>
      <ul>
      </ul>
    </li>
  </ul><div>
</td>
</tr>
<tr>
<td valign="top" class="menu" width="150" height="300">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td class="menue" width="150">
<!-- Menü -->
<span>Allgemeines</span>
<a href="admin.php?admincontent=start" target="_self" class="menue">Adminstart</a>
<a href="admin.php?admincontent=news" target="_self" class="menue">Newsschreiben</a>
<a href="admin.php?admincontent=newsletter" target="_self" class="menue">Newsletter senden</a>
<span>Usersystem</span>
<a href="admin.php?admincontent=support" target="_self" class="menue">Ticketsystem</a>
<a href="admin.php?admincontent=userliste" target="_self" class="menue">Userliste</a>
<a href="admin.php?admincontent=kontoauszug" target="_self" class="menue">Kontoauszüge</a>
<a href="admin.php?admincontent=accountinformationen" target="_self" class="menue">Accountinfos</a>
<a href="admin.php?admincontent=doppelaccounts" target="_self" class="menue">Doppelaccounts</a>
<a href="admin.php?admincontent=rangsystem" target="_self" class="menue">Rangsystem</a><br>
<span>WMS</span>
<a href="admin.php?admincontent=kamp_uebersicht" target="_self" class="menue">Übersicht</a>
<a href="admin.php?admincontent=paidmailsenden" target="_self" class="menue">Paidmailssenden</a>
<a href="admin.php?admincontent=kamp_starten" target="_self" class="menue">Kampagnestarten</a>
<a href="admin.php?admincontent=werbepreise" target="_self" class="menue">Werbepreise</a>
<span>Ralleysystem</span>
<a href="admin.php?admincontent=rallysystem" target="_self" class="menue">Ralley bearbeiten</a>
<a href="admin.php?admincontent=rallys" target="_self" class="menue">Ralley übersicht</a>
<a href="admin.php?admincontent=cash_rallys" target="_self" class="menue">Ralley auswerten</a>
<span>LOG-System</span>
<a href="admin.php?admincontent=bettelliste" target="_self" class="menue">Bettellog</a>
<span>System</span>
<a href="admin.php?admincontent=p_config" target="_self" class="menue">Haupteinstellungen</a>
<a href="admin.php?admincontent=s_config" target="_self" class="menue">Schnittstellen</a> 
<a href="admin.php?admincontent=i_config" target="_self" class="menue">Interface</a>
<a href="admin.php?admincontent=w_crons" target="_self" class="menue">Crons ausführen</a>
<a href="admin.php?admincontent=zinssystem" target="_self" class="menue">Zinssystem</a>
<a href="admin.php?admincontent=k_texte" target="_self" class="menue">Texte bearbeiten</a>
<a href="admin.php?admincontent=bilanz" target="_self" class="menue">Bilanzen</a>
<span>Games</span>
<a href="admin.php?admincontent=biberalarm/index" target="_self" class="menue">Biberalarm</a>
<a href="admin.php?admincontent=/spiele/gametor">Gametor</a>
</td>
</tr>
</table>
<img src="images/admin/pixel.gif" alt="" width="150" height="1" border="0"><br>
</td>
<td align="right" valign="top" class="content" width="640">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="630" valign="top" class="in" align="left">