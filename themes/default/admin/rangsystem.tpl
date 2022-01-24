<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Rangsystem konfigurieren</h1>
<table border="0" width="80%">
<form action="" method="post">
<input type="hidden" name="do" value="change">
 <tr>
  <td width="30%">Rangsystem ist</td>
  <td width="70%"><select name="status" size="1" style="padding: 6px; width: 100px;">
		<option value="1"  <%$aktis[1]%>> Aktiviert</option>
		<option value="0"  <%$aktis[0]%>> Deaktiviert</option>
      </select></td>
 </tr>
 <tr>
  <td>Anzahl Ränge</td>
  <td><select name="anzahl" size="1" style="padding: 6px; width: 100px;">
		<option value="10"  <%$rangs[10]%>> 10 Ränge</option>
		<option value="11"  <%$rangs[11]%>> 11 Ränge</option>
		<option value="12"  <%$rangs[12]%>> 12 Ränge</option>
		<option value="13"  <%$rangs[13]%>> 13 Ränge</option>
		<option value="14"  <%$rangs[14]%>> 14 Ränge</option>
		<option value="15"  <%$rangs[15]%>> 15 Ränge</option>
		<option value="16"  <%$rangs[16]%>> 16 Ränge</option>
		<option value="17"  <%$rangs[17]%>> 17 Ränge</option>
		<option value="18"  <%$rangs[18]%>> 18 Ränge</option>
		<option value="19"  <%$rangs[19]%>> 19 Ränge</option>
		<option value="20"  <%$rangs[20]%>> 20 Ränge</option>
      </select></td>
 </tr>
 <tr>
  <td colspan="2"><br></td>
 </tr>
 <tr>
  <td colspan="2"><input type="submit" value="Ändern"></td>
 </tr>
</form>
</table>

<table border="0" width="100%">
<form action="" method="post">
<input type="hidden" name="do" value="set">
<input type="hidden" name="abgeschickt" value="<%$einstellung%>">
 <tr>
  <td width="10%" align="center">Nummer</td>
  <td width="20%">Name</td>
  <td width="15%">Grenze</td>
  <td width="15%">Bonus</td>
 </tr>
 <tr>
  <td align="center">Anfang</td>
  <td><input type="text" name="anfang" value="<%$name%>"></td>
  <td>keine Grenze</td>
  <td>kein Bonus</td>
 </tr>
<%section name=x loop=$ausgabe%>
    <tr>
     <td align="center"><%$ausgabe[x].count%></td>
     <td><input type="text" name="rang<%$ausgabe[x].count%>" value="<%$ausgabe[x].name%>"></td>
     <td><input type="text" name="grenz<%$ausgabe[x].count%>"style="width: 100px;" value="<%$ausgabe[x].grenzwert%>"></td>
     <td><input type="text" name="bonus<%$ausgabe[x].count%>"style="width: 100px;" value="<%$ausgabe[x].bonus%>"></td>
    </tr>
<%/section%>
<tr>
 <td colspan="2"><br></td>
</tr>
<tr>
 <td colspan="2"><input type="submit" value="Daten ändern"></td>
</tr>
</table>

<%/block%>