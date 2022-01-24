<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//DE">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title><%$seitenname%></title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<link href="./themes/default/css/style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./themes/default/css/jquery-eu-cookie-law-popup.css"/>
<script src="./themes/default/js/jquery-eu-cookie-law-popup.js"></script>
</head>
<body bgcolor="#ffffff" class="eupopup eupopup-bottom">

<div align="center">
<table cellspacing="0" cellpadding="0" border="0" width="940">
<tr>
<td colspan="3" class="head" height="82">
<table cellspacing="0" cellpadding="0" border="0" width="940">
<tr>
<td><img src="./themes/default/images/headleft.gif" alt="" width="313" height="82" border="0"></td>
<td align="right">
<%$load_fullbanner_1%>
</td>
</tr>
</table>
</td>
</tr>


<tr>
<td class="tm2" colspan="3" align="center" valign="middle" bgcolor="#000000">
<a href="index.php" target="_self">Startseite</a>
<a href="index.php?content=site/faq" target="_self" class="menue">FAQ's</a>
<a href="index.php?content=site/agb" target="_self" class="menue">AGB's</a>
<a href="index.php?content=site/impressum" target="_self" class="menue">Impressum</a>
<a href="index.php?content=site/mediadaten" target="_self" class="menue">Mediadaten</a>
<a href="index.php?content=site/top10" target="_self" class="menue">Top10</a>
</td>
</tr>
<tr>
<td colspan="3" align="center" valign="middle" bgcolor="#000000" id="ticker"><marquee scrolldelay="50" scrollamount="2">
           <font color="#FFFFFF"><b> <?php echo $string; ?></b></font></marquee></td>
          </tr>

<tr>
<td colspan="3" class="tm" align="center" valign="middle">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<%if !empty($smarty.session.login) && $smarty.session.login == 'true'%>
<td width="22%" align="left" valign="middle">&nbsp;<font color="#f0f0f0"><b>Angemeldet:</b> <%$smarty.session.nickname%></font></td>
<td width="30%" align="left" valign="middle"><font color="#f0f0f0"><b>Guthaben:</b> <%$guthaben%> <%$waehrungsname%></font></td>
<td width="30%" align="left" valign="middle"><font color="#f0f0f0"><b>Tresor:</b> <%$tresorguthaben%> <%$waehrungsname%></font></td>
<td width="18%" align="right" valign="middle"><a href="index.php?logout=true" target="_self" class="menue"><b>Ausloggen!!!</b></a></td>
<%else%>
<td width="22%" align="left" valign="middle"><a href="index.php?content=site/login" target="_self" class="menue"><b>Login</b></a></td>
<td width="30%" align="left" valign="middle"><a href="index.php?content=site/anmelden" target="_self" class="menue"><b>Registrieren</b></a></td>
<td width="30%" align="left" valign="middle"></td>
<td width="18%" align="right" valign="middle"></td>
<%/if%>
</tr>
</table>
</td>
</tr>