<%if !empty($smarty.session.login) && $smarty.session.login == 'true'%>
<span>Neuester User
<%section name=x loop=$anmelde_out%>
<table border="0">
<tr>
<td><b>Nick:</b>
<td><b><%$anmelde_out[x].nickname%></b>
<tr>
<td><b>Id:</b>
<td><b><%$anmelde_out[x].uid%></b>
<tr>
<td><b>Seit:</b>
<td><b><%$anmelde_out[x].anmeldezeit%>
</b></table>
<%/section%>
</span>
<br>
<span>Wer ist Online</span>
<%section name=x loop=$wioIsOnline_out%>
<%$wioIsOnline_out[x].ausgabe%>
<%/section%>
<%/if%>
<span>Anzeige</span>

