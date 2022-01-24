<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Usersuche</h1>
<br>
<table width="100%" cellspacing=2 cellpadding=2 border="0" align="center">
<tr>
<form action="" method="post">
<td align="center">
Suche nach: <select size=1 name="spalte">
<option value="uid">ID</option>
<option value="nickname">Nickname</option>
<option value="email">Emailadresse</option>
<option value="guthaben">Guthaben</option>
<option value="sparbuch">Sparbuch</option>
<option value="werber_id">Werber ID</option>
<option value="werber_nick">Werbernick</option>
<option value="vorname">Vorname</option>
<option value="nachname">Nachname</option>
<option value="land">Land</option>
<option value="plz">Postleitzahl</option>
</select>
&nbsp;&nbsp;
<select size=1 name="search_art">
<option value="LIKE">gleich</option>
<option value="NOT LIKE">nicht gleich</option>
<option value="groesser">grösser als</option>
<option value="kleiner">kleiner als</option></select>
&nbsp;&nbsp;
<input type="text" name="search_word">
</td>
</tr>
<tr>
<td align="center">
<input type="submit" name="search_start" value="Suchen!"> 
<input type="submit" name="view_all" value="Alle anzeigen!"> 
</td>
</tr>
</form>
</table>
<br>
<h1>Userliste und Suchergebnisse</h1>
<br>
<div align="center">&raquo;&raquo;&raquo; <a href="admin.php?admincontent=userliste&anzeigen=<%$anzeigen-$limit%>"><b>Eine Seite vor</b></a> &laquo;&laquo;&laquo;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;&raquo; <a href="admin.php?admincontent=userliste&anzeigen=<%$anzeigen+$limit%>"><b>Eine Seite zurück</b></a> &laquo;&laquo;&laquo;</div>
<br>
<table width="98%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#557FB8">
<td align="center"></td>
<td align="center"><b>User</b></td>
<td align="center"><b>Kontostand</b></td>
<td align="center"><b>Tresor</b></td>
<td align="center"><b>Email</b></td>
<td align="center"><b>Angemeldet</b></td>
</tr>
<%section name=x loop=$ausgabe%>
<tr bgcolor="<%$ausgabe[x].linecolor%>">
<td align="center"><a href="admin.php?admincontent=userbearbeiten&uid=<%$ausgabe[x].uid%>" target="_self"><%$ausgabe[x].status%></a></td>
<%if !$ausgabe[x].np%>
<td align="left"><%$ausgabe[x].nickname%></td>
<%else%>
<td align="left"><a href="admin.php?admincontent=npbearbeiten&npuser=<%$ausgabe[x].nickname%>" target="_self"><%$ausgabe[x].nickname%></a></td>
<%/if%>
<td align="right"><a href="admin.php?admincontent=kontoauszug&bl_user=<%$ausgabe[x].nickname%>" target="_self"><%$ausgabe[x].guthaben%></a>&nbsp;</td>
<td align="right"><%$ausgabe[x].tresorguthaben%>&nbsp;</td>
<td align="center"><a href="mailto:<%$ausgabe[x].email%>" target="_blank">Anschreiben</a></td>
<td align="center"><%$ausgabe[x].anmeldezeit%></td>
</tr>
<%/section%>
</table>

<%/block%>