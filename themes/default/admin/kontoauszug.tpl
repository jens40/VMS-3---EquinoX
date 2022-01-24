<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Kontoauszüge durchsuchen</h1>
<br>
<table width="100%" cellspacing=2 cellpadding=2 border="0" align="center">
<tr>
<form action="" method="post">
<td align="center">
Suche nach:
<input type="text" name="search_word">
&nbsp;&nbsp;
<input type="submit" name="search_start" value="Suchen!">
&nbsp;&nbsp;
<input type="submit" name="view_all" value="Alle anzeigen!"> 
</td>
</tr>
</form>
</table>
<h1>Kontoauszüge von <%$bl_user%></h1>
<br>
<div align="center">&raquo;&raquo;&raquo; <a href="admin.php?admincontent=kontoauszug&bl_user=<%$bl_user%>&anzeigen=<%$anzeigen-$limit%>"><b>Eine Seite vor</b></a> &laquo;&laquo;&laquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo; <a href="admin.php?admincontent=kontoauszug&bl_user=<%$bl_user%>&anzeigen=<%$anzeigen+$limit%>"><b>Eine Seite zurück</b></a> &laquo;&laquo;&laquo;</div>
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
<%/section%>
</table>

<%/block%>