<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Übersicht aller Kampagnen</h1>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td align="center"><b>User</b></td>
<td align="center"><b>FoKl</b></td>
<td align="center"><b>BaKl</b></td>
<td align="center"><b>BaVi</b></td>
<td align="center"><b>BuKl</b></td>
<td align="center"><b>BuVi</b></td>
<td align="center"><b>SuKl</b></td>
<td align="center"><b>SuVi</b></td>
<td align="center"><b>TeKl</b></td>
<td align="center"><b>TeVi</b></td>
<td align="center"><b>PaMa</b></td>
</tr>
	<tr bgcolor="#c9c9c9">
	<td align="center">System</td>
	<td align="center"><%$forcedbanner%></td>
	<td align="center"><%$bannerklicks%></td>
	<td align="center"><%$bannerviews%></td>
	<td align="center"><%$buttonklicks%></td>
	<td align="center"><%$buttonviews%></td>
	<td align="center"><%$surfbarklicks%></td>
	<td align="center"><%$surfbarviews%></td>
	<td align="center"><%$textlinkklicks%></td>
	<td align="center"><%$textlinkviews%></td>
	<td align="center"><%$paidmails%></td>
	</tr>
<%section name=x loop=$kampagne%>	
<tr bgcolor="<%$kampagne[x].linecolor%>">
	<tr bgcolor="#c9c9c9">
	<td align="center"><%$kampagne[x].nickname%></td>
	<td align="center"><%$kampagne[x].forcedbanner%></td>
	<td align="center"><%$kampagne[x].bannerklicks%></td>
	<td align="center"><%$kampagne[x].bannerviews%></td>
	<td align="center"><%$kampagne[x].buttonklicks%></td>
	<td align="center"><%$kampagne[x].buttonviews%></td>
	<td align="center"><%$kampagne[x].surfbarklicks%></td>
	<td align="center"><%$kampagne[x].surfbarviews%></td>
	<td align="center"><%$kampagne[x].textlinkklicks%></td>
	<td align="center"><%$kampagne[x].textlinkviews%></td>
	<td align="center"><%$kampagne[x].paidmails%></td>
	</tr>
<%/section%>
</table>
<%/block%>