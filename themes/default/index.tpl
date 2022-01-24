<%include file="header.tpl"%>
<tr>
<td valign="top" class="menu" width="150">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td class="menue" width="150">
<%include file="menue.tpl"%>
</td>
</tr>
</table>
<img src="images/pixel.gif" alt="" width="150" height="1" border="0"><br>
</td>

<td align="center" valign="top" class="content" width="640">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td width="630" valign="top" class="in" align="left">

<%block name="content"%><%/block%>

</center>
</td>
</tr>
</table>
</td>

<td valign="top" class="menu" width="150">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td class="menue" width="150">
<%include file="menue2.tpl"%>
</td>
</tr>
</table>
<img src="images/pixel.gif" alt="" width="150" height="1" border="0"><br>
</td>
</tr>

<%include file="footer.tpl"%>