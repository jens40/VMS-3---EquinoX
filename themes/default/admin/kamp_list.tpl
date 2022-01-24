<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Übersicht aller Kampagnen von <%$nickname%></h1>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td width="*" align="center"><b>Titel</b></td>
<td width="135" align="center"><b>Views</b></td>
<td width="135" align="center"><b>Klicks</b></td>
<td width="80" align="center"><b>Klickrate</b></td>
</tr>
<%section name=x loop=$kampagne_output%>	
<tr bgcolor="<%$kampagne_output[x].linecolor%>">
<td align="center"><a href="admin.php?admincontent=kamp_edit&kid=<%$kampagne_output[x].kampagnen_id%>" target="_self"><%$kampagne_output[x].name%></a></td>
<td align="center"><%$kampagne_output[x].views%></td>
<td align="center"><%$kampagne_output[x].klicks%></td>
<td align="center"><%$kampagne_output[x].klickrate%></td>
</tr>
<%/section%>
</table>
<%/block%>