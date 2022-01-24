<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Allgemeine Kontoinformationen von <%$userdaten_nickname%></h1>
<br>
<table width="100%" cellpadding="1" cellspacing="3" border="0" style="border-color : #F7BF63;	border-left-width : 1px;border-style : solid;border-width : 1px;">
<tr><td colspan="2" align="left"><b><u>Kontoinformationen...</u></b></td></tr>
<tr><td align="left"><b>Kontonummer:</b></td><td align="right"><%$userdaten_uid%></td></tr>
<tr><td align="left"><b>Nickname:</b></td><td align="right"><%$userdaten_nickname%></td></tr>
<tr><td align="left"><b>Name des Werbers (Refback %):</b></td><td align="right">
<%if $userdaten_werber_nick%>
<a href="<%$seitenurl%>/index.php?content=user/nickpage&shownick=<%$userdaten_werber_nick%>" target="_blank"><%$userdaten_werber_nick%> (<%$userdaten_werber_refback%> %)</a>
<%else%>
<i>Du hast keinen Werber</i>
<%/if%>
</td></tr>
</table>
<br>
<table width="100%" cellpadding="1" cellspacing="3" border="0" style="border-color : #F7BF63;	border-left-width : 1px;border-style : solid;border-width : 1px;">
<tr><td colspan="2" align="left"><b><u>Guthabeninformationen...</u></b></td></tr>
<tr><td align="left"><font style="padding : 0px 5px 0px 5px;border-style : solid;border-width : 1px;font-weight : bold;">info</font>&nbsp;<b>Guthaben:</b></td><td align="right"><%$userdaten_guthaben|number_format:2%></td></tr>
<tr><td align="left"><font style="padding : 0px 5px 0px 5px;border-style : solid;border-width : 1px;font-weight : bold;">info</font>&nbsp;<b>Tresorguthaben:</b></td><td align="right"><%$userdaten_tresorguthaben|number_format:2%></td></tr>
<%if $kurs_klamm > 0%><tr><td align="left"><font style="padding : 0px 5px 0px 5px;border-style : solid;border-width : 1px;font-weight : bold;">info</font>&nbsp;<b>Klammlose:</b></td><td align="right"><%($userdaten_tresorguthaben+$userdaten_guthaben)*$kurs_klamm|number_format:2%></td></tr><%/if%>
<%if $kurs_euro > 0%><tr><td align="left"><font style="padding : 0px 5px 0px 5px;border-style : solid;border-width : 1px;font-weight : bold;">info</font>&nbsp;<b>&euro;uros:</b></td><td align="right"><%($userdaten_tresorguthaben+$userdaten_guthaben)*$kurs_euro|number_format:4%></td></tr><%/if%>
</table>
<br>
<table width="100%" cellpadding="1" cellspacing="3" border="0" style="border-color : #F7BF63;	border-left-width : 1px;border-style : solid;border-width : 1px;">
<tr><td colspan="2" align="left"><b><u>Zinsinformationen...</u></b></td></tr>
<tr><td align="left"><b>Zinspunkte:</b></td><td align="right"><%$userdaten_zinspunkte|number_format:2%></td></tr>
<tr><td align="left"><b>Tgl. &Oslash; Guthaben:</b></td><td align="right"><%$tgl_guthaben%></td></tr>
<tr><td align="left"><b>Dein Zinssatz:</b></td><td align="right"><%$zinssatz%>%</td></tr>
<tr><td align="left"><b>Verzinst werden:</b></td><td align="right"><%$zinsgutgaben%></td></tr>
<tr><td align="left"><b>Zinsertrag:</b></td><td align="right"><%$zinsertrag%></td></tr>
</table>
<br>
<h1>Übersicht der aktuellen Zinssätze</h1>
<br>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="center" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td align="center" width="33%"><b>nötige Zinspunkte</b></td>
<td align="center" width="34%"><b>Zinssatz in % p.J.</b></td>
<td align="center" width="33%"><b>maximal verzinst werden</b></td>
</tr>
<%section name=x loop=$zinsen_output%>
<tr bgcolor="<%$zinsen_output[x].linecolor%>">
<td align="center"><%$zinsen_output[x].zinspunkte_von%></td>
<td align="center"><%$zinsen_output[x].zinssatz%> %</td>
<td align="center"><%$zinsen_output[x].max_verzinsen%></td>
</tr>
<%/section%>
</table>
<%/block%>