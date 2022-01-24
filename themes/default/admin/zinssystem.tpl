<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Übersicht der aktuellen Zinssätze</h1>
<table cellpadding="3" cellspacing="1" border="0" align="center" style="border-color : #F7BF63; border-left-width : 1px; border-style : solid;border-width : 1px;">
<tr bgcolor="#F7BF63">
<td align="center" width="80">Zins ID</td>
<td align="center" width="150">Zinspunkte ab</td>
<td align="center" width="150">Zinssatz %</td>
<td align="center" width="150">Max verzinsbar</td>
</tr>
<%section name=x loop=$zinsen_output%>	
<tr bgcolor="<%$zinsen_output[x].linecolor%>">
<td align="center"><a href="admin.php?admincontent=zinssystem&zid=<%$zinsen_output[x].zinsid%>" target="_self"><%$zinsen_output[x].zinsid%></a></td>
<td align="center"><%$zinsen_output[x].zinspunkte_von%></td>
<td align="center"><%$zinsen_output[x].zinssatz%> %</td>
<td align="center"><%$zinsen_output[x].max_verzinsen%></td>
</tr>
<%/section%>
</table>
<br>
<h1>Anlegen neuer Zinssätze</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post">
<tr>
<td width="200"><b>Von Punkte:</b></td>
<td><input type="Text" name="vp" value=""></td>
</tr>
<tr>
<td width="200"><b>Zinssatz:</b></td>
<td><input type="Text" name="zs" value=""></td>
</tr>
<tr>
<td width="200"><b>Max. Verzinsen:</b></td>
<td><input type="Text" name="mv" value=""></td>
</tr>
</table>
<br>
<div align="center">
<input type="hidden" name="do" value="anlegen">
<input type="submit" name="anlegen" value="Anlegen"></div>
</form>
<%/block%>