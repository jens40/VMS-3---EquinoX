<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Übersicht aller e-Mails</h1>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td align="center"><b>Mailart</b></td>
<td align="center"><b>Titel</b></td>
<td align="center"><b>Status</b></td>
<td align="center"><b>Gültig bis</b></td>
<td align="center"><b>Anfordern</b></td>
</tr>
<%section name=x loop=$emails_output%>
<tr bgcolor="<%$emails_output[x].linecolor%>">
<td align="left">&nbsp;<%$emails_output[x].mailart%></td>
<td align="left">&nbsp;<%$emails_output[x].mailtitel%></td>
<td align="center"><a href="index.php?content=user/mailhistory&mid=<%$emails_output[x].mid%>&do=delete" target="_self"><%$emails_output[x].status%></a></td>
<td align="center"><%$emails_output[x].gueltig%></td>
<td align="center"><a href="index.php?content=user/mailhistory&mid=<%$emails_output[x].mid%>&do=send" target="_self">Senden</a></td>
</tr>
<%/section%>
</table>
<%/block%>