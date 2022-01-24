<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Mediadaten - <%$seitenname%></h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50%">Start dieser Seite</td>
<td width="50%"><%$seitenstart%></td>
</tr>
<tr>
<td width="50%">Angemeldete User</td>
<td width="50%"><%$user%></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> &Oslash; Anmeldungen pro Tag</td>
<td width="50%"><%$user_tage%></td>
</tr>
<tr>
<td width="50%">Guthaben aller User</td>
<td width="50%"><%$guthaben%> <%$waehrungsname%></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> &Oslash; Guthaben pro User</td>
<td width="50%"><%$guthaben_user%> <%$waehrungsname%></td>
</tr>
<tr>
<td width="50%">Tresorguthaben aller User</td>
<td width="50%"><%$tresorguthaben%> <%$waehrungsname%></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> &Oslash; Tresorguthaben pro User</td>
<td width="50%"><%$tresorguthaben_user%> <%$waehrungsname%></td>
</tr>
</table>
<br>
<h1>Mediadaten - Diverses</h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50%">Forcedklicks aller User</td>
<td width="50%"><%$fk%> Klicks</td>
</tr>
<tr>
<td width="50%">Verdienst bei allen Forcedklicks</td>
<td width="50%"><%$fs%> <%$waehrungsname%></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> &Oslash; Verdienst pro Klick</td>
<td width="50%"><%$fs_fk%> <%$waehrungsname%></td>
</tr>
</table>
<hr width="100%" size="1" color="#800000">
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50%">Bettelaufrufe alle User</td>
<td width="50%"><%$bk%> Aufrufe</td>
</tr>
<tr>
<td width="50%">Verdienst bei allen Bettelaufrufen</td>
<td width="50%"><%$bs%> <%$waehrungsname%></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> &Oslash; Verdienst pro Aufruf</td>
<td width="50%"><%$bs_bk%> <%$waehrungsname%></td>
</tr>
</table>
<br>
<h1>Mediadaten - Werbung</h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td width="50%"><b>Kampagnen im System (aktiv)</b></td>
<td width="50%"><b><%$ak%> Kampagne(n)</b></td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Forcedklicks</td>
<td width="50%">
<%$kamp_forcedbanner|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Bannerklicks</td>
<td width="50%"><%$kamp_bannerklicks|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Bannerviews</td>
<td width="50%"><%$kamp_bannerviews|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Buttonklicks</td>
<td width="50%"><%$kamp_buttonklicks|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Buttonviews</td>
<td width="50%"><%$kamp_buttonviews|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Surfbarklicks</td>
<td width="50%"><%$kamp_surfbarklicks|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Surfbarviews</td>
<td width="50%"><%$kamp_surfbarviews|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Textlinkklicks</td>
<td width="50%"><%$kamp_textlinkklicks|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Textlinkviews</td>
<td width="50%"><%$kamp_textlinkviews|number_format:0%> Kampagne(n)</td>
</tr>
<tr>
<td width="50%"><img src="./themes/default/images/sub.gif" width="10" height="10" border="0" alt="" align="absmiddle"> davon Paidmails</td>
<td width="50%"><%$kamp_paidmails|number_format:0%> Kampagne(n)</td>
</tr>
</table>
<hr width="100%" size="1" color="#800000">

<%/block%>