<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Liste aller Bettelaufrufe </h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#F7BF63">
<td align="center"><b>URL / Domain</b></td>
<td align="center"><b>Aufrufe</b></td>
<td align="center"><b>Status</b></td>
</tr>
<%section name=x loop=$ausgabe%>
<tr bgcolor="<%$ausgabe[x].linecolor%>">
<td align="left"><%$ausgabe[x].url%></td>
<td align="right"><%$ausgabe[x].aufrufe%>&nbsp;</td>
<td align="center"><a href="admin.php?admincontent=bettelliste&url_id=<%$ausgabe[x].url_id%>" target="_self"><%$ausgabe[x].sperre%></a></td>
</tr>
<%/section%>
</table>
<%/block%>