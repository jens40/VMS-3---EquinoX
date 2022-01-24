<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>News editieren / löschen</h1>
<table>
<form action="" method="post">
<tr>
<td>
<select name="loader" size="1">
<%section name=x loop=$load%>	
<option value="<%$load[x].news_id%>">(<%$load[x].news_id%>) - <%$load[x].titel%> (<%$load[x].zeit%>)</option>
<%/section%>
</select>
</td>
<td><input type="Submit" name="load" value="Editieren"></td>
<td><input type="Submit" name="load" value="Löschen"></td>
</tr>
</form>
</table>
<br>
<h1>News schreiben (html erlaubt!</h1>
<div align="center">
<form action="" method="post">
<b>Newstitel</b><br>
<input type="Text" name="titel" value="<%$titel%>" style="width:500px;"><br>
<br>
<b>News</b><br>
<textarea name="news" style="width:500px; height:250px;"><%$news%></textarea><br>
<br>
<input type="Submit" name="auffuehren" value="Ausführen">
<input type="Hidden" name="id" value="<%$id%>">
</form>
</div>

<%/block%>