<%extends file="../index.tpl"%>
<%block name="content" prepend%>
<h1>Kampagne von <%$nickname%></h1>

<table width="98%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#ffffff">
<form action="" method="post">
<tr bgcolor="#88B1DA">
<td colspan="2" align="center"><b><%$format%>: <%$kampagnen_output_name%> [KID:<%$kampagnen_output_kampagnen_id%>]</td>
</tr>
<tr>
<td align="left" valign="top" bgcolor="#B6D2F9" width="100%">
<%if $kampagnen_output_format == 'textlinkklicks' or $kampagnen_output_format == 'textlinkviews'%>
<textarea rows="1" name="text_link" style="width:100%;"><%$text_link%></textarea><br>
<%elseif $kampagnen_output_format == 'paidmails'%>
<textarea rows="8" name="text_mail" style="width:100%;"><%$text_mail%></textarea><br>
<%else%>
<img src="<%$kampagnen_output_url_banner%>" border="0" alt=""><br>
Banner: <input type="Text" name="url_banner" value="<%$kampagnen_output_url_banner%>" style="width:350px;"><br>
<%/if%>
URL: <input type="Text" name="url_ziel" value="<%$kampagnen_output_url_ziel%>" style="width:350px;">&nbsp;&nbsp;<a href="<%$kampagnen_output_url_ziel%>" target="_blank">Klick</a>
</td>
</tr>
<tr bgcolor="#B6D2F9">
<td colspan="2" align="center"><input type="checkbox" name="loeschen" value="1"> Löschen&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="updaten" value="<%$kampagnen_output_kampagnen_id%>"> Updaten&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" name="send" value="Durchführen"></td>
</tr>
</form>
</table>
<%/block%>