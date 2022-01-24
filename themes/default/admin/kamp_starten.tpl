<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Auswahl der Werbeform</h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" align="center" bgcolor="#F7BF63">
<tr bgcolor="#FDF5E7">
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=forcedbanner" target="_self">Forcedklicks</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=bannerklicks" target="_self">Bannerklicks</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=bannerviews" target="_self">Bannerviews</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=buttonklicks" target="_self">Buttonklicks</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=buttonviews" target="_self">Buttonviews</a></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=surfbarklicks" target="_self">Surfbarklicks</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=surfbarviews" target="_self">Surfbarviews</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=textlinkklicks" target="_self">Textlinkklicks</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=textlinkviews" target="_self">Textlinksviews</a></td>
<td width="20%"><a href="admin.php?admincontent=kamp_starten&get_werbeart=paidmails" target="_self">Paidmails</a></td>
</tr>
</table>
<br>
<h1>Neues Programm starten - <%$werbename%></h1>
<%$message%>
<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center" bgcolor="#000000">
<form action="" method="post" name="starten">
<input type="Hidden" name="k_werbeform" value="<%$k_werbeform%>">
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>Kampagnenname (max. 50 Zeichen)</b></td>
<td width="50%" align="left" valign="top"><b>Zusatzinformationen (max. 50 Zeichen)</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_name" style="width:80%;overflow : hidden;" wrap=virtual><%$k_name%></textarea></td>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_info" style="width:80%;overflow : hidden;" wrap=virtual><%$k_info%></textarea></td>
</tr>
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
Vergütung
<%else%>
Festpreis
<%/if%>
</b></td>
<td width="50%" align="left" valign="top"><b>Menge</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top">
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
<input type="Text" name="k_verguetung" value="<%$k_verguetung%>" style="width:35%">
<%else%>
<input type="Text" name="k_verguetung" value="<%$k_verguetung%>" style="width:35%" readonly>
<%/if%>
</td>
<td width="50%" align="left" valign="top"><input type="Text" name="k_menge" value="<%$k_menge%>" style="width:35%"></td>
</tr>
<tr bgcolor="#F7BF63">
<%if $k_werbeform == 'paidmails'%>
<td width="50%" align="left" valign="top" colspan="2"><b>Ziel-URL</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Ziel-URL</b></td>
<%if $k_werbeform == 'textlinkviews' or $k_werbeform == 'textlinkklicks'%>
<td width="50%" align="left" valign="top"><b>Werbetext</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Banner-URL</b></td>
	<%/if%>
<%/if%>
</tr>
<tr bgcolor="#FDF5E7">
<%if $k_werbeform == 'paidmails'%>
<td width="100%" align="left" valign="top" colspan="2"><textarea rows="1" name="k_ziel" style="width:40%;overflow : hidden;" wrap=virtual><%$k_ziel%></textarea></td>
<%else%>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_ziel" style="width:80%;overflow : hidden;" wrap=virtual><%$k_ziel%></textarea></td>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_werbemittel" style="width:80%;overflow : hidden;" wrap=virtual><%$k_werbemittel%></textarea></td>
<%/if%>
</tr>
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>Bitte wähle die Aufenthaltszeit</b></td>
<%if $k_werbeform != 'paidmails'%>
<td width="50%" align="left" valign="top"><b>Bitte wähle die Reloadzeit</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Bitte Mailtext eingeben!</b></td>
<%/if%>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top">
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
<table cellpadding="1" cellspacing="1" border="0" align="left">
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="0" <%if $k_aufendhalt == 0 or $k_aufendhalt == ''%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">0 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="5" <%if $k_aufendhalt == 5%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">5 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="10" <%if $k_aufendhalt == 10%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">10 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="15" <%if $k_aufendhalt == 15%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">15 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="20" <%if $k_aufendhalt == 30%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">20 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="25" <%if $k_aufendhalt == 35%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">25 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="30" <%if $k_aufendhalt == 30%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">30 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="45" <%if $k_aufendhalt == 45%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">45 Sekunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="60" <%if $k_aufendhalt == 60%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">60 Sekunden</td><td align="right"></td>
</tr>
</table>
<%else%>
<div align="center"><b>Bei dieser Werbeform (<%$werbename%>) kein Aufendhalt möglich!</b></div>
<input type="Hidden" name="k_aufendhalt" value="0">
<%/if%>
<td width="50%" align="left" valign="top">
<%if $k_werbeform != 'paidmails'%>
<table cellpadding="1" cellspacing="1" border="0" align="left">
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="1" <%if $k_reloadzeit == 1%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">1 Stunde&nbsp;&nbsp;</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="2" <%if $k_reloadzeit == 2%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">2 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="4" <%if $k_reloadzeit == 4 or $k_reloadzeit == ''%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">4 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="8" <%if $k_reloadzeit == 8%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">8 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="12" <%if $k_reloadzeit == 12%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">12 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="16" <%if $k_reloadzeit == 16%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">16 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="20" <%if $k_reloadzeit == 20%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">20 Stunden</td><td align="right"></td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="24" <%if $k_reloadzeit == 24%>checked<%/if%>>&nbsp;&nbsp;</td><td align="right">24 Stunden</td><td align="right"></td>
</tr>
</table>
<%else%>
<textarea rows="16" name="k_werbemittel" style="width:100%;"><%$k_werbemittel%></textarea>
<input type="Hidden" name="k_reloadzeit" value="24">
<div align="center"><b>Paidmails, 24 Stunden Reloadzeit!</b></div>
<%/if%>
</td>
</tr>
</table>
<br>
<div align="center">
<input type="hidden" name="do" value="send_kampstart">
<input type="Submit" name="send_kampstart" value="Weiter zur Prüfung!"></div>
</form>
<%/block%>