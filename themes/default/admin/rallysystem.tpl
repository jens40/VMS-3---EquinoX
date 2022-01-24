<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Auswahl der Rally</h1>
<div align="center">
<form action="admin.php?admincontent=rallysystem" method="post">
<b>Bitte wählen die Rally aus</b><br>
<select name="rallyart" size="1" onchange="this.form.submit()">
<option value="skr" <%if $rallyart == 'skr'%>selected<%/if%>>statische Klickralley
<option value="dkr" <%if $rallyart == 'dkr'%>selected<%/if%>>dynamische Klickralley
<option value="sar" <%if $rallyart == 'sar'%>selected<%/if%>>statische Aktivralley
<option value="dar" <%if $rallyart == 'dar'%>selected<%/if%>>dynamische Aktivralley
<option value="sbr" <%if $rallyart == 'sbr'%>selected<%/if%>>statische Bettelralley
<option value="dbr" <%if $rallyart == 'dbr'%>selected<%/if%>>dynamische Bettelralley
<option value="srr" <%if $rallyart == 'srr'%>selected<%/if%>>statische Refralley
</select></div><br>
<h1>[<font color="#cc0000"><b><%$rallytitel%></b></font>] Terminierung der Rally</h1>
<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" style="border-color : #F7BF63; border-left-width : 1px;border-style : solid;border-width : 1px;">
<tr>
<td align="left" valign="middle"><b>Start der Ralley</b> (<i>HH:MM - TT.MM.JJJJ</i>)</td>
<td align="left" valign="middle">
<input type="Text" name="start_stunde" value="<%$start_stunde%>" size="2" maxlength="2"> : <input type="Text" name="start_minute" value="<%$start_minute%>" size="2" maxlength="2">
&nbsp;-&nbsp;
<input type="Text" name="start_tag" value="<%$start_tag%>" size="2" maxlength="2"> . <input type="Text" name="start_monat" value="<%$start_monat%>" size="2" maxlength="2"> . <input type="Text" name="start_jahr" value="<%$start_jahr%>" size="4" maxlength="4">
</td>
</tr>
<tr>
<td align="left" valign="middle"><b>Ende der Ralley</b> (<i>HH:MM - TT.MM.JJJJ</i>)</td>
<td align="left" valign="middle">
<input type="Text" name="ende_stunde" value="<%$ende_stunde%>" size="2" maxlength="2"> : <input type="Text" name="ende_minute" value="<%$ende_minute%>" size="2" maxlength="2">
&nbsp;-&nbsp;
<input type="Text" name="ende_tag" value="<%$ende_tag%>" size="2" maxlength="2"> . <input type="Text" name="ende_monat" value="<%$ende_monat%>" size="2" maxlength="2"> . <input type="Text" name="ende_jahr" value="<%$ende_jahr%>" size="4" maxlength="4"></td>
</tr>
<%if $rallyart == 'dkr' or $rallyart == 'dar' or $rallyart == 'dbr'%>
<tr>
<td align="center" valign="middle" colspan="2" style="border-color : #cc0000; border-left-width : 1px;border-style : solid;border-width : 1px;">
<b>Startpot:</b>&nbsp;<input type="Text" name="startpot" value="<%$startpot%>" style="width:150px;">
&nbsp;&nbsp;&nbsp;&nbsp;
<b>Zuwachs:</b>&nbsp;<input type="Text" name="zuwachs" value="<%$zuwachs%>" style="width:150px;"><br>
<font color="#cc0000"><b>Nur nötig bei dynamischen Ralley's</b></font>
</td>
</tr>
<%/if%>
</table>
<br>
<h1>[<font color="#cc0000"><b><%$rallytitel%></b></font>] Platzierungen der Rally</h1>
<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" style="border-color : #F7BF63; border-left-width : 1px;border-style : solid;border-width : 1px;">
<tr>
<td align="left" valign="middle">
<textarea name="plaetze" style="width:100%; height:80px;"><%$plaetze%></textarea><br>
</td>
</tr>
</table>
<br>
<div align="center">
<input type="hidden" name="do" value="rally_speichern">
<input type="Submit" name="rally_speichern" value="Rally speichern"></div>
</form>

<%/block%>