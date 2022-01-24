<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Senden von Paidmails</h1>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td align="center"><b>KID</b></td>
<td align="center"><b>Titel</b></td>
<td align="center"><b>Vergütung</b></td>
<td align="center"><b>Aufenthalt</b></td>
<td align="center"><b>Mails</b></td>
<td align="center"><b>Sende</b></td>
</tr>
<%section name=x loop=$ausgabe%>
<tr bgcolor="<%$ausgabe[x].linecolor%>">
<td align="center"><%$ausgabe[x].kampagnen_id%></td>
<td align="center"><%$ausgabe[x].name%></td>
<td align="center"><%$ausgabe[x].payout%></td>
<td align="center"><%$ausgabe[x].aufendhalt%> Sek.</td>
<td align="center"><%$ausgabe[x].do_clicks%></td>
<td align="center"><%$ausgabe[x].senden%></td>
</tr>
<%/section%>


</table>
<%/block%>