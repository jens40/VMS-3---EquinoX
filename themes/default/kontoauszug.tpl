<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Kontoauszüge</h1>
<br>
<div align="center">&raquo;&raquo;&raquo; <a href="?content=/user/kontoauszug&anzeigen=<%$anzeigen-$limit%>"><b>Eine Seite vor</b></a> &laquo;&laquo;&laquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo; <a href="?content=/user/kontoauszug&anzeigen=<%$anzeigen+$limit%>"><b>Eine Seite zurück</b></a> &laquo;&laquo;&laquo;</div>
<br>
<table width="100%" cellpadding="3" cellspacing="0" border="0" align="center">
<tr bgcolor="#F7BF63">
<td align="left" width="130">&nbsp;<b>Buchungstag</b></td>
<td align="left" width="*"><b>Verwendungszweck</b></td>
<td align="right" width="130"><b>Wert</b>&nbsp;</td>
</tr>
<tr><td colspan="3" width="100%" height="1" bgcolor="#000000"></td></tr>
<%section name=x loop=$auszug%>	
<tr bgcolor="<%$auszug[x].linecolor%>">
<td align="left">&nbsp;<%$auszug[x].zeit%><br>&nbsp;<b>BID:</b>&nbsp;<%$auszug[x].buchungs_id%></td>
<td align="left"><%$auszug[x].vzweck%><br><%$auszug[x].sender%> -> <%$auszug[x].empfaenger%></td>
<td align="right" valign="top"><%$auszug[x].summe%>&nbsp;</td>
</tr>
<tr><td colspan="3" width="100%" height="1" bgcolor="#A97848"></td></tr>
<%/section%>
</table>
<%/block%>