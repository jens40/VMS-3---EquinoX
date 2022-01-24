<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Dein Tresor bei uns</h1>
<%if !empty($tresor_msg)%>
<div align="center"><b><%$tresor_msg%></b></div><br>
<%/if%>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td align="left" valign="top" colspan="2">
<b>Aktuelles Guthaben:</b> <%$guthaben%> <%$waehrungsname%><br>
<b>Aktuelles Tresorguthaben:</b> <%$tresorguthaben%> <%$waehrungsname%><br>
<hr size="1" color="#bebebe" width="100%">
</td>
</tr>
<form id="ukonto" action="" method="post" name="tresor">
<tr>
<td><b><%$waehrungsname%>:</b></td>
<td><input type="text" name="transsumme" maxlength="100" size="30" value="" style="width:160px;"> <font color="#990000">(min. <%$ueberweisungssumme%> <%$waehrungsname%>)</font></td>
</tr>
<tr>
<td><b>Tresorrichtung:</b></td>
<td><select name="richtung" size="1">
		<option value="1" SELECTED>Einzahlen (Tresorpasswort wird nicht gebraucht!)</option>
		<option value="0">Auszahlen (Nur mit Tresorpasswort möglich!)</option>
</select></td>
</tr>
<tr>
<td><b>Tresorpasswort:</b></td>
<td><input type="password" name="transpasswort" maxlength="100" size="30" value="" style="width:160px;"></td>
</tr>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="ueberweisen">
<input type="Submit" name="ueberweisen" value="Tresorbuchung durchführen!"></td>
</tr>
</form>
<tr><td colspan="2"><hr size="1" color="#bebebe" width="100%"></td></tr>
<tr><td colspan="2">
<div align="center"><b><u>Die Letzten 10 Tresorbuchungen</u></b></div><br>

<table width="100%" border="0" cellpadding="1" cellspacing="1">
<tr>
<td align="center" width="130"><b>Buchungstag</b></td>
<td align="center" width="100"><b><%$waehrungsname%></b></td>
<td align="center" width="100"><b>An / Von</b></td>
<td align="center"><b>V.-Zweck</b>&nbsp;</td>
</tr>
<%section name=x loop=$auszug%>
<tr>
<td align="left">&nbsp;<%$auszug[x].zeit%></td>
<td align="right"><%$auszug[x].summe%>&nbsp;</td>
<td align="left">&nbsp;<%$auszug[x].an_von%></td>
<td align="left" valign="top" >&nbsp;<%$auszug[x].vzweck%></td>
</tr>
<%/section%>
</table>

</td></tr>
</table>

<%/block%>