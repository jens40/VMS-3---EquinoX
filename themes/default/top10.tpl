<%extends file="index.tpl"%>
<%block name="content" prepend%>
<br>
<h1>Top 10 Statistiken</h1>
<center><br><b>Hier nun ein paar "Top 10"-Statistiken zu unserer Seite. Diese werden ständig erweitert, damit jeder einen kleinen Überblick hat, wo er steht.<br><br>
<br>
<h1>Neuste Mitglieder</h1> 
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88"> 
<tr bgcolor="#bddefd"> 
<td align="center"><b>Konto</b></td> 
<td align="center"><b>User</b></td> 
<td align="center"><b>angemeldet am</b></td> 
</tr> 
<%section name=x loop=$anmelde%>
<tr bgcolor="#d9e8f6"> 
<td align="center"><%$anmelde[x].uid%></td> 
<td align="center"><%$anmelde[x].nickname%></td> 
<td align="center"><%$anmelde[x].anmeldezeit%></td> 
</tr> 
<%/section%>  
</table>
<br>
<h1>Top 10  - Rangliste ( Nach Loseguthaben )</h1>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88">
<tr bgcolor="#bddefd">
<td align="center"><b>Rang</b></td>
<td align="center"><b>Nickname</b></td>
<td align="center"><b>Lose</b></td>
</tr>
<%section name=x loop=$guthabenrang%>
<tr bgcolor="#d9e8f6">
<td align="center"><%$guthabenrang[x].rang%></td>
<td align="center"><%$guthabenrang[x].nickname%></td>
<td align="center"><%$guthabenrang[x].guthaben%></td>
</tr>
<%/section%>
</table>
<br>
<h1>Top 10  - Rangliste ( Nach Aktivpunkte )</h1>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88">
<tr bgcolor="#bddefd">
<td align="center"><b>Rang</b></td>
<td align="center"><b>Nickname</b></td>
<td align="center"><b>Aktivpunkte</b></td>
</tr>
<%section name=x loop=$aktivpunkteliste%>
<tr bgcolor="#d9e8f6">
<td align="center"><%$aktivpunkteliste[x].rang%></td>
<td align="center"><%$aktivpunkteliste[x].nickname%></td>
<td align="center"><%$aktivpunkteliste[x].aktivpunkte%></td>
</tr>
<%/section%>
</table>
<br>
<h1>Top 10  - Rangliste ( Nach Werber )</h1>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88">
<tr bgcolor="#bddefd">
<td align="center"><b>Rang</b></td>
<td align="center"><b>Nickname</b></td>
<td align="center"><b>Ref´s</b></td>
</tr>
<%section name=x loop=$refanzahlliste%>
<tr bgcolor="#d9e8f6">
<td align="center"><%$refanzahlliste[x].rang%></td>
<td align="center"><%$refanzahlliste[x].nickname%></td>
<td align="center"><%$refanzahlliste[x].refanzahl%></td>
</tr>
<%/section%>
</table>
<br>

<h1>Top 10 - Rangliste ( Nach Klicks )</h1>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88">
<tr bgcolor="#bddefd">
<td align="center"><b>Rang</b></td>
<td align="center"><b>Nickname</b></td>
<td align="center"><b>Klicks</b></td>
</tr>
<%section name=x loop=$klickliste%>
<tr bgcolor="#d9e8f6">
<td align="center"><%$klickliste[x].rang%></td>
<td align="center"><%$klickliste[x].nickname%></td>
<td align="center"><%$klickliste[x].forcedklicks%></td>
</tr>
<%/section%>
</table>
<br>
<h1>Top 10 - Rangliste (Bettelaufrufe)</h1> 
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="#485C88"> 
<tr bgcolor="#bddefd"> 
<td align="center"><b>Rang</b></td> 
<td align="center"><b>Nickname</b></td> 
<td align="center"><b>Aufrufe</b></td> 
<td align="center"><b>Erbettelte <?=$waehrung;?></b></td> 
</tr> 
<%section name=x loop=$bettelliste%>
<tr bgcolor="#d9e8f6">
<td align="center"><%$bettelliste[x].rang%></td>
<td align="center"><%$bettelliste[x].nickname%></td>
<td align="center"><%$bettelliste[x].bettelklicks%></td>
<td align="center"><%$bettelliste[x].bettelsumme%></td>
</tr>
<%/section%>
</table>
<br>
<%/block%>