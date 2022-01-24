<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Kampagne von <%$nickname%></h1>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#000000">
<form action="" method="post">
<tr bgcolor="#F7BF63">
<td colspan="2" align="center"><b><%$format%>: <%$kampagnen_output_name%> [KID:<%$kampagnen_output_kampagnen_id%>]</td>
</tr>
<tr>
<td align="left" valign="top" bgcolor="#FDF5E7">
Aufenthalt: <input type="Text" name="aufendhalt" value="<%$kampagnen_output_aufendhalt%>" style="width:30px;"> Sek.<br>
Payout: <input type="Text" name="payout" value="<%$kampagnen_output_payout%>" style="width:50px;"><br>
Reload: <input type="Text" name="reload" value="<%$kampagnen_output_reload%> / 3600;?>" style="width:50px;"> Std.<br>
<%if $kampagnen_output_format == 'bannerviews' or $kampagnen_output_format == 'buttonviews' or $kampagnen_output_format == 'textlinkviews' or $kampagnen_output_format == 'surfbarkviews'%>
Views: <input type="Text" name="in_views" value="<%$kampagnen_output_in_views%>" style="width:80px;"><br>
<%else%>
Klicks: <input type="Text" name="in_clicks" value="<%$kampagnen_output_in_clicks%>" style="width:80px;"><br>
<%/if%>
</td>
<td align="left" valign="top" bgcolor="#FDF5E7" width="470">
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
<tr bgcolor="#FCEED5">
<td colspan="2" align="center"><input type="checkbox" name="loeschen" value="1"> Löschen&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="updaten" value="<%$kampagnen_output_kampagnen_id%>"> Updaten&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" name="send" value="Durchführen"></td>
</tr>
</form>
</table>
<%/block%>