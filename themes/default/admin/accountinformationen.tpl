<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>User mit der gleichen IP-Adresse</h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#F7BF63">
<td align="center" width="120"><b>Useranzahl</b></td>
<td align="center"><b>IP-Adresse</b></td>
</tr>
<%section name=x loop=$gp%>
<tr bgcolor="<%$gp[x].linecolor%>">
<td align="center"><a href="admin.php?admincontent=userliste&where=true&spalte=regip&search=<%$gp[x].regip%>" target="_self"><%$gp[x].uid%></a></td>
<td align="center"><%$gp[x].regip%></td>
</tr>
<%/section%>
</table>
<%/block%>