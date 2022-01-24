<%extends file="index.tpl"%>
<%block name="content" prepend%>
<div align="center">
<table width="600" cellpadding="2" cellspacing="2" border="0">
<tr><td>
<%if $nickpage_daten_avatar%>
<img src="<%$nickpage_avatar%>" align="right" vspace="20" hspace="50" border="0" alt="Avatar von <%$nickpage_daten_nickname%>">
<%/if%>
<b>Nickname:</b> <a href="<%$seitenurl%>/index.php?content=/user/nickpage&shownick=<%$nickpage_daten_nickname%>" target="_self"><%$nickpage_daten_nickname%></a><br>
<i>Dabei seit: <%$anmeldezeit%> Uhr</i><br>
<%if $nickpage_daten_werber_nick%>
<br>
<b>Geworben von:</b> <a href="<%$seitenurl%>/index.php?content=user/nickpage&shownick=<%$nickpage_daten_werber_nick%>" target="_blank"><%$nickpage_daten_werber_nick%></a><br>
<%/if%>
<%if $nickpage_daten_benutzertext%>
<br>
<b>Benutzertext:</b><br>
<textarea cols="70" rows="9" name="btext" readonly wrap="hard" style="scrollbar:0;"><%$nickpage_daten_benutzertext%></textarea>
<%/if%>
</td></tr>

<tr><td><hr size="1" width="90%" color="#B7793D" align="left"></td></tr>

<tr><td>
<b>Referers:</b> <%$nickpage_daten_refanzahl|number_format:0%> Ref in der ersten Ebene<br>
<b>Bettelaufrufe:</b> <%$nickpage_daten_bettelklicks|number_format:0%> (<%$nickpage_daten_bettelsumme|number_format:2%> <%$waehrungsname%>)<br>
<b>Forcedklicks:</b> <%$nickpage_daten_forcedklicks|number_format:0%> (<%$nickpage_daten_forcedsumme|number_format:2%> <%$waehrungsname%>)<br>
</td></tr>

<tr><td><hr size="1" width="90%" color="#B7793D" align="left"></td></tr>
<%if $nickpage_daten_klamm_id%>
<tr><td>
<b>KlammID:</b> <a href="http://www.klamm.de/partner/unter_nickpage.php?directsearch=<%$nickpage_daten_klamm_id%>" target="_blank"><%$nickpage_daten_klamm_id%></a><br>
</td></tr>
<%/if%>
<%if $nickpage_daten_fuco_id%>
<tr><td>
<b>FunCoinsID:</b> <a href="http://funcoins.de/nickpage.php?nid=<%$nickpage_daten_fuco_id%>" target="_blank"><%$nickpage_daten_fuco_id%></a><br>
</td></tr>
<%/if%>
<%if $nickpage_daten_nickey_id%>
<tr><td>
<b>NickeyID:</b> <a href="http://www.nickeybank.de/?seite=nickeypage&id=<%$nickpage_daten_nickey_id%>" target="_blank"><%$nickpage_daten_nickey_id%></a><br>
</td></tr>
<%/if%>

<tr><td><hr size="1" width="90%" color="#B7793D" align="left"></td></tr>
<%if $nickpage_daten_icq%>
<tr><td>
<b>ICQ#:</b> <%$nickpage_daten_icq%> <img src="http://status.icq.com/online.gif?icq=<%$nickpage_daten_icq%>&img=26" border="0" alt=""><br>
</td></tr>
<%/if%>
<%if $nickpage_daten_skype%>
<tr><td>
<b>Skype:</b> <%$nickpage_daten_skype%><br>
</td></tr>
<%/if%>
<%if $nickpage_daten_msn%>
<tr><td>
<b>MSN:</b> <%$nickpage_daten_msn%><br>
</td></tr>
<%/if%>
<tr><td>
<b>E-Mailadresse:</b> <a href="mailto:<%$nickpage_daten_email%>" target="_blank"><%$nickpage_daten_email%></a><br>
</td></tr>

<tr><td><hr size="1" width="90%" color="#B7793D" align="left"></td></tr>
<%if $nickpage_daten_url_1%>
<tr><td>
<b>Webseite <?=$wp++;?>:</b> <a href="<%$nickpage_daten_url_1%>" target="_blank"><%$nickpage_daten_url_1%></a><br>
<i><%$nickpage_daten_beschreibung_1%></i>
</td></tr>
<%/if%>
<%if $nickpage_daten_url_2%>
<tr><td>
<b>Webseite <?=$wp++;?>:</b> <a href="<%$nickpage_daten_url_2%>" target="_blank"><%$nickpage_daten_url_2%></a><br>
<i><%$nickpage_daten_beschreibung_2%></i>
</td></tr>
<%/if%>
<%if $nickpage_daten_url_3%>
<tr><td>
<b>Webseite <?=$wp++;?>:</b> <a href="<%$nickpage_daten_url_3%>" target="_blank"><%$nickpage_daten_url_3%></a><br>
<i><%$nickpage_daten_beschreibung_3%></i>
</td></tr>
<%/if%>
<%if $nickpage_daten_url_4%>
<tr><td>
<b>Webseite <?=$wp++;?>:</b> <a href="<%$nickpage_daten_url_4%>" target="_blank"><%$nickpage_daten_url_4%></a><br>
<i><%$nickpage_daten_beschreibung_4%></i>
</td></tr>
<%/if%>
<%if $nickpage_daten_url_5%>
<tr><td>
<b>Webseite <?=$wp++;?>:</b> <a href="<%$nickpage_daten_url_5%>" target="_blank"><%$nickpage_daten_url_5%></a><br>
<i><%$nickpage_daten_beschreibung_5%></i>
</td></tr>
<%/if%>
</table>
</div>
<%/block%>