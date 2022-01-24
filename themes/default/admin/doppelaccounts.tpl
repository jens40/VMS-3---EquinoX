<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Liste der Doppelaccounts</h1>
<br>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#F7BF63">
<td align="center"><b>Zeit</b></td>
<td align="center"><b>alter Login</b></td>
<td align="center"><b>neuer Login</b></td>
<td align="center"></td>
</tr>
<%section name=x loop=$doppelaccounts%>
<tr bgcolor="<%$doppelaccounts[x].linecolor%>">
<td align="center"><%$doppelaccounts[x].zeit%></td>
<td align="center"><%$doppelaccounts[x].von%></td>
<td align="center"><%$doppelaccounts[x].zu%></td>
<td align="center"><a href="admin.php?admincontent=doppelaccounts&d_del=<%$doppelaccounts[x].did%>" target="_self">ENTFERNEN</a></td>
</tr>
<%/section%>
</table>
<%/block%>