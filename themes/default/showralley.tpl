<br>
<h1>Übersicht unserer Rally's</h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#F7BF63">
<td width="50" align="center"><b>Status</b></td><td align="center"><b>Rallyart</b></td><td width="170" align="center"><b>Start</b></td><td width="170" align="center"><b>Ende</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="center">
<%if $skr_start <= $smarty.now && $skr_ende >= $smarty.now%>
<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Rally läuft">
<%elseif $skr_start != 0 && $skr_ende != 0%>
<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Rally wird ausgewertet">
<%else%>
<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Rally läuft nicht">
<%/if%>
</td><td>Statische Klickrally</td><td align="center"><%if $skr_start > 0%> <%$skr_start|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td><td align="center"><%if $skr_ende > 0%><%$skr_ende|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td>
</tr>

<tr bgcolor="#FDF5E7">
<td align="center">
<%if $dkr_start <= $smarty.now && $dkr_ende >= $smarty.now%>
<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Rally läuft">
<%elseif $dkr_start != 0 && $dkr_ende != 0%>
<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Rally wird ausgewertet">
<%else%>
<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Rally läuft nicht">
<%/if%>
</td><td>Dynamische Klickrally</td><td align="center"><%if $dkr_start > 0%> <%$dkr_start|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td><td align="center"><%if $dkr_ende > 0%><%$dkr_ende|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td>
</tr>

<tr bgcolor="#FDF5E7">
<td align="center">
<%if $sar_start <= $smarty.now && $sar_ende >= $smarty.now%>
<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Rally läuft">
<%elseif $sar_start != 0 && $sar_ende != 0%>
<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Rally wird ausgewertet">
<%else%>
<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Rally läuft nicht">
<%/if%>
</td><td>Statische Aktivrally</td><td align="center"><%if $sar_start > 0%> <%$sar_start|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td><td align="center"><%if $sar_ende > 0%><%$sar_ende|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td>
</tr>

<tr bgcolor="#FDF5E7">
<td align="center">
<%if $sbr_start <= $smarty.now && $sbr_ende >= $smarty.now%>
<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Rally läuft">
<%elseif $sbr_start != 0 && $sbr_ende != 0%>
<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Rally wird ausgewertet">
<%else%>
<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Rally läuft nicht">
<%/if%>
</td><td>Dynamische Aktivrally</td><td align="center"><%if $sbr_start > 0%> <%$sbr_start|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td><td align="center"><%if $sbr_ende > 0%><%$sbr_ende|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td>
</tr>

<tr bgcolor="#FDF5E7">
<td align="center">
<%if $dbr_start <= $smarty.now && $dbr_ende >= $smarty.now%>
<img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Rally läuft">
<%elseif $dbr_start != 0 && $dbr_ende != 0%>
<img src="./themes/default/images/admin/gelb.gif" width="15" height="15" border="0" alt="Rally wird ausgewertet">
<%else%>
<img src="./themes/default/images/admin/rot.gif" width="15" height="15" border="0" alt="Rally läuft nicht">
<%/if%>
</td><td>Dynamische Bettelrally</td><td align="center"><%if $dbr_start > 0%> <%$dbr_start|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td><td align="center"><%if $dbr_ende > 0%><%$dbr_ende|date_format:'%d.%m.%Y - %H:%M'%> Uhr<%else%>-+-+-+-+-+-+-<%/if%></td>
</tr>

</table>