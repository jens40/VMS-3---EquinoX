<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Manuelles Ausführen von Crons</h1>
<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#F7BF63">
<td align="center"><b>Cronname</b></td>
<td align="center"><b>Laufzeit</b></td>
<td align="center">Starten</td>
</tr>
<%section name=x loop=$crontabelle%>	
<tr bgcolor="<%$crontabelle[x].linecolor%>">
<td>
<b><%$crontabelle[x].cronname%></b> <%$crontabelle[x].hinweis%>
</td>
<td align="center" valign="middle">
<font color="#990000"><%$crontabelle[x].laufzeit%></font>
</td>
<td align="center" valign="middle"><a href="admin.php?admincontent=w_crons&cron=<%$crontabelle[x].crondatei%>" target="_self"><img src="./themes/default/images/admin/gruen.gif" width="15" height="15" border="0" alt="Ausführen"></a>
</tr>
<%/section%>
</table>
<%/block%>