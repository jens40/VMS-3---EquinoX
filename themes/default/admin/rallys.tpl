<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Auswahl der Rally's</h1>
<table width="100%" cellpadding="2" cellspacing="1" border="0" align="center" bgcolor="#F7BF63">
<tr bgcolor="#FDF5E7">
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=skr" target="_self">Statische Klickralley</a></td>
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=dkr" target="_self">Dynamische Klickralley</a></td>
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=sar" target="_self">Statische Aktivralley</a></td>
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=dar" target="_self">Dynamische Aktivralley</a></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=sbr" target="_self">Statische Bettelralley</a></td>
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=dbr" target="_self">Dynamische Bettelralley</a></td>
<td width="25%"><a href="admin.php?admincontent=rallys&r_art=srr" target="_self">statische Refralley</a></td>
<td width="25%"></td>
</tr>
</table>
<br>
<h1>Übersicht der <%$rallytitel%></h1>
<%if $r_art_start == 0 && $r_art_ende == 0%>
<br><div align="center"><b>Diese Rally ist zur Zeit nicht aktiv!</b></div>
<%else%>
<table cellpadding="2" cellspacing="1" border="0" align="center" bgcolor="#F7BF63">
<tr bgcolor="#F7BF63"><td colspan="4" width="100%" align="left">&nbsp;<b>Rallyhinweise</b></td></tr>
<tr bgcolor="#FDF5E7">
<td colspan="4" width="100%" align="left">
<font color="#cc0000">
<%if $r_art == 'skr' or $r_art == 'sar' or $r_art == 'sbr' or $r_art == 'srr'%>
Dieses ist unsere <b><%$rallytitel%></b>, diese Rally läuft von <b><%$start_zeit%></b><br>
bis <b><%$ende_zeit%></b>. Für diese Rally sind <b><%$ausgelobt%> <%$waehrungsname%></b> ausgelobt<br>
und werden auf <b><%$zaehler%> Plätze</b> aufgeteil (siehe unten stehe Tabelle).<br>
<%/if%>

<%if $r_art == 'dkr' or $r_art == 'dar' or $r_art == 'dbr'%>
Dieses ist unsere <b><%$rallytitel%></b>, diese Rally läuft von <b><%$start_zeit%></b><br>
bis <b><%$ende_zeit%></b>. Bei diese Rally sind z.Zt <b><%$startpot%> <%$waehrungsname%></b> im Jackpot<br>
der Zuwachs des Jackpots beträgt <b><%$zuwachs%> <%$waehrungsname%></b>.<br>
Der Jackpot wird auf <b><%$zaehler%> Plätze</b> aufgeteil (siehe unten stehe Tabelle).<br>
<%/if%>
</font>
</td>
</tr>
<tr bgcolor="#F7BF63">
<td width="60" align="center"><b>Platz</b></td>
<td width="200" align="center"><b>Nickname</b></td>
<td width="170" align="center"><b>Klicks / Punkte</b></td>
<td width="170" align="center"><b>möglicher Gewinn</b></td>
</tr>
<%section name=x loop=$rallyuser%>
<tr bgcolor="<%$rallyuser[x].linecolor%>">
<td align="center"><b><%$rallyuser[x].platz%></b></td>
<td align="left">&nbsp;<b><%$rallyuser[x].nickname%></b></td>
<td align="right"><%$rallyuser[x].klicks_punkte%>&nbsp;</td>
<td align="right"><b><%$rallyuser[x].gewinn%></b>&nbsp;</td>
</tr>
<%/section%>
<tr bgcolor="#F7BF63">
<td colspan="4" width="100%" align="center"><b>
<%if $r_art_start <= time() && $r_art_ende >= time()%>
Diese Rally läuft noch...
<%/if%>
<%if $r_art_start != 0 && $r_art_ende != 0%>
Diese Rally ist beendet und wird ausgewertet...
<%/if%>
</b></td>
</tr>
</table>
<%/if%>

<%/block%>