<%extends file="index.tpl"%>
<%block name="content" prepend%>
<%if isset($setrefback)%>
<h1>Refback &auml;ndern</h1>
<form action="index.php?content=user/refcenter&user=<%$setrefback%>" method="POST">
Refback für den User <i><%$setrefback%></i>: <input type="text" name="saverefback" value="<%$aktuell%>" /> <input type="submit"  class="btn btn-primary" name="submit" value="Setzen" /> 
</form>
<%/if%>
<h1>Verdienst durch Referrals</h1>
<table width="98%" border="0" cellpadding="1" cellspacing="1">
<tr bgcolor="#B6D2F9">
<td align="center" width="70">Prozent</td>
<td align="center">Ref-Name</td>
   <td align="center" width="120">Refback</td>
<td align="center">AP´s</td>
<td align="center" width="120">Heute</td>
<td align="center" width="120">Gesamt</td>
</tr>
<%section name=x loop=$referral%>
		<tr>
		<td align="right" bgcolor="#88B1DA"><%$referral[x].start%>%&nbsp;</td>
		<td align="left" bgcolor="#B6D2F9"><div style="margin-left: <%$referral[x].free%>px;"><%$referral[x].pfeil%><%$referral[x].nickname%></div></td>
        <td align="right" bgcolor="#B6D2F9"><%$referral[x].refback%>&nbsp;</td>
		<td align="right" bgcolor="#B6D2F9"><%$referral[x].aktivpunkte%>&nbsp;</td>
		<td align="right" bgcolor="#B6D2F9"><%$referral[x].werberverdienst_aktuell%>&nbsp;</td>
		<td align="right" bgcolor="#88B1DA"><%$referral[x].werberverdienst_gesamt%>&nbsp;</td>
		</tr>
<%/section%>
<tr bgcolor="#B6D2F9">
<td align="right" colspan="3">Gesamt:&nbsp;</td>
<td align="right" width="120"><%$day|number_format:2%>&nbsp;</td>
<td align="right" width="120"><%$all|number_format:2%>&nbsp;</td>
</tr>
</table>
<%/block%>