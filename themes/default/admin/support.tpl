<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<div style="text-align: center;">
<a href="admin.php?admincontent=support">Offenstehende Tickets</a> <b>&middot;</b> 
<a href="admin.php?admincontent=support&status=1">Erledigte Tickets</a> <b>&middot;</b> 
<a href="admin.php?admincontent=support&status=2">Geschlossene Tickets</a> <b>&middot;</b> 
<a href="admin.php?admincontent=support&clear">Ticketsystem bereinigen</a>
</div>
<br />
<%if isset($clear)%>
	<%if isset($erfolg)%><h1><%$erfolg%></h1><%/if%>
<%/if%>

<%if isset($replyticket)%>
	<%if !empty($fehler)%><h1>Fehler</h1><%$fehler%><%/if%>    
	<%if !empty($erfolg)%><h1>Anfrage erstellt</h1><%$erfolg%><%/if%>
	<%if empty($erfolg)%>    
<h1>Antwort erstellen</h1>
<form action="admin.php?admincontent=support&replyticket=<%$replyticket%>" method="POST">
<table border=0 collspacing=2 cellpadding=2 width="500" align="center">
	<tr>
		<td width=120><b>Betreff:</b>&nbsp;</td>
		<td><input type="text" name="betreff" value="<%$betreff%>" style="width: 100%;" /></td>
	</tr>
	<tr>
		<td colspan=2><b>Deine Nachricht:</b><br /><textarea name="nachricht" rows=10 cols=30 style="width: 100%;"><%$nachricht%></textarea></td>
	</tr>
	<tr>
		<td colspan=2 align="center"><input type="submit" name="submit" value="Antwort senden" /> <input type="reset" name="reset" value="Eingaben l&ouml;schen" /></td>
	</tr>
</table>
</form>

    <%/if%>
<%/if%>

<%if isset($ticketid)%>
	<%if $anzahl1 == '0'%>
    <h1>Fehler</h1>
		<center><font color="#ff0000"><b>Ticket nicht vorhanden oder ung&uuml;ltig!</b></font></center>
    <%else%>    
		<h1><%$betreff1%></h1>
		<%$nachricht1%><hr size=1 color="#4a4a4a" /><div align="right">Von <%$user%> am <%$erstellt%></div>    
    <%/if%>

<%section name=x loop=$tickets%>
			<h1><%$tickets[x].betreff%></h1>
            <%if $tickets[x].i == $tickets[x].anzahl%><a name="s_newest"></a><%/if%>
			<%$tickets[x].nachricht%><hr size=1 color="#4a4a4a" /><div align="right">Von <%$tickets[x].user%> am <%$tickets[x].erstellt%></div>
<%/section%>
		<%if $i == 1%>
			<h1>Keine Antworten</h1>
			<center><font color="#ff0000"><b>Noch keine Antworten vorhanden!</b></font></center>
		<%/if%>

		<%if $status != 2%>
<h1>Antwort erstellen</h1>
<form action="admin.php?admincontent=support&replyticket=<%$id%>" method="POST">
<table border=0 collspacing=2 cellpadding=2 width="500" align="center">
	<tr>
		<td width=120><b>Betreff:</b>&nbsp;</td>
		<td><input type="text" name="betreff" value="<%$betreff%>" style="width: 100%;" /></td>
	</tr>
	<tr>
		<td colspan=2><b>Deine Nachricht:</b><br /><textarea name="nachricht" rows=10 cols=30 style="width: 100%;"><%$nachricht%></textarea></td>
	</tr>
	<tr>
		<td colspan=2 align="center"><input type="submit" name="submit" value="Antwort senden" /> <input type="reset" name="reset" value="Eingaben l&ouml;schen" /></td>
	</tr>
</table>
</form>
<%else%>
			<h1>Ticket geschlossen</h1>
			<center><font color="#ff0000"><b>Antworten nicht m&ouml;glich, Ticket geschlossen!</b></font></center>
<%/if%>

<%/if%>

<%if !isset($ticketid) && !isset($newticket) && !isset($replyticket) && !isset($clear)%>
<table border=0 cellspacing=1 cellpadding=2 border=0 bgcolor="#4a4a4a" width="100%">
  <tr bgcolor="#c0c0c0" height=20 style="font-weight: bold;">
   <td width=15>&nbsp;</td>
   <td width=120 align="center">User</td>
   <td align="center">Betreff</td>
   <td align="center" width=105>Ticket erstellt</td>
   <td align="center" width=105>Letze Aktion</td>
  </tr>
<%if $anzahl == '0'%>
<tr><td colspan=5 bgcolor="#ffffff" align="center"><b>Keine Tickets vorhanden!</b></td></tr>
<%else%>
<%section name=x loop=$tickets%>
  <tr bgcolor="<%$tickets[x].linecolor%>">
   <td><img src="./themes/default/images/admin/<%$tickets[x].image%>" border=0 /></td>
   <td><%$tickets[x].user%></td>
   <td><a href="admin.php?admincontent=support&ticketid=<%$tickets[x].id%>#s_newest"><%$tickets[x].betreff%></a></td>
   <td align="center"><%$tickets[x].erstellt%></td>
   <td align="center"><%$tickets[x].zuletzt%></td>
  </tr>
<%/section%>
<%/if%>
</table>
<%/if%>

<%/block%>