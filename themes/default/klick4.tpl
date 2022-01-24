<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Statistiken</h1>
<table border=0 cellspacing=1 cellpadding=1 width="400" align="center">
  <tr>
   <td width="50%">Banner verf&uuml;gbar: <span style='color: #008000; font-weight: bold;'><%$StatNotReload_anzahl%></span></td>
   <td width="50%">&#216; Aufenthalt: <%$zeit_anzahl%> Sekunden</td>
  </tr>
  <tr>
   <td>Banner im Reload: <span style='color: #ff0000; font-weight: bold;'><%$banner_reload%></span></td>
   <td>&#216; Verg&uuml;tung: <%$durchschnitt_verguetung%> <%$waehrungsname%></td>
  </tr>
  <tr>
   <td>Offen: <span style='font-weight: bold;'><%$payout%> <%$waehrungsname%></span></td>
   <td>&#216; Durchlauf: <%$gesamt_payout%> <%$waehrungsname%></td>
  </tr>
</table>
<%section name=x loop=$f_banner%>
  <div id="<%$f_banner[x].kampagnen_id%>" style="text-align: center;"><br />
  <a href="<%$seitenurl%>/klick.php?bid=<%$f_banner[x].kampagnen_id%>" target="_blank">
  <img src="<%$f_banner[x].url_banner%>" border="0" height="60" width="468" alt="ForcedBanner" OnClick="document.getElementById('<%$f_banner[x].kampagnen_id%>').style.display='none';"></a>
  <br /><font size=1>Reload: <%$f_banner[x].reload%> Std. | Verdienst: <%$f_banner[x].payout%> <%$waehrungsname%> | Aufenthalt: <%$f_banner[x].aufendhalt%> Sekunden</font></div>
<%/section%>
<tr bgcolor="#F7BF63">
<td colspan="4" width="100%" align="center"><b>
<%if $forcedbanner == 0%>
Alle Banner im Reload / keine Banner verf&uuml;gbar!
<%else%>
<input type="button" name="more_banners" value="Weitere Banner laden ..." OnClick="javascript:window.location.reload();" />
<%/if%>
</b></td>
</tr>
<%/block%>