<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Newsletter schreiben / versende</h1>
<div align="center">
<%if $do == 'versenden'%>
<br><b>Es wurden <%$versendet%> E-Mails in den Mailquery gelegt!</b><br><br>
<%/if%>
<form action="" method="post">
<b>Newslettertitel</b><br>
<input type="Text" name="nt" style="width:600px;"><br>
<br>
<b>Newslettertext</b><br>
<textarea name="news" style="width:600px; height:350px;"></textarea><br>
<br>
<input type="hidden" name="do" value="versenden">
<input type="Submit" name="versenden" value="Versenden">
</form>
</div>

<%/block%>