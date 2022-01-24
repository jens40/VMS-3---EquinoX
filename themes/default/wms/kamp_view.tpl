<%extends file="../index.tpl"%>
<%block name="content" prepend%>
<h1>Kampagnenübersicht</h1>
<br>
<table width="98%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#ffffff">
<tr bgcolor="#557FB8">
<td width="*" align="center"><b>Titel</b></td>
<td width="100" align="center"><b>Format</b></td>
<td width="135" align="center"><b>Views</b></td>
<td width="135" align="center"><b>Klicks</b></td>
<td width="80" align="center"><b>Klickrate</b></td>
<td width="90" align="center"><b>Status</b></td>
</tr>
<%section name=x loop=$kampagne_output%>
<tr bgcolor="<%$kampagne_output[x].linecolor%>">
<td align="center"><a href="index.php?content=wms/kamp_edit&bid=<%$kampagne_output[x].kampagnen_id%>" target="_self"><%$kampagne_output[x].name%></a></td>
<td align="center"><%$kampagne_output[x].format%></td>
<td align="center"><%$kampagne_output[x].views%></td>
<td align="center"><%$kampagne_output[x].klicks%></td>
<td align="center"><%$kampagne_output[x].klickrate%></td>
<td align="center"><a href="index.php?content=wms/kamp_view&bid=<%$kampagne_output[x].kampagnen_id%>&status=change" target="_self"><%$kampagne_output[x].status%></a></td>
</tr>
<%/section%>
</table>


<%/block%>