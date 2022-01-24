<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Grundkonfiguration</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post" name="preise">
<tr>
<td width="300"><b>Betreibergebühr:</b></td>
<td><input type="text" name="gebuehr_betreiber" maxlength="30" size="30" value="<%$wp_output_gebuehr_betreiber%>"></td>
</tr>
<tr>
<td><b>Stornogebühr:</b></td>
<td><input type="text" name="gebuehr_storne" maxlength="30" size="30" value="<%$wp_output_gebuehr_storne%>"></td>
</tr>
<tr>
<td><b>Min. Einbuchung:</b></td>
<td><input type="text" name="minbuchung" maxlength="30" size="30" value="<%$wp_output_minbuchung%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 0:</b></td>
<td><input type="text" name="rabatt_0" maxlength="30" size="30" value="<%$wp_output_rabatt_0%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 1:</b></td>
<td><input type="text" name="rabatt_1" maxlength="30" size="30" value="<%$wp_output_rabatt_1%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 2:</b></td>
<td><input type="text" name="rabatt_2" maxlength="30" size="30" value="<%$wp_output_rabatt_2%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 3:</b></td>
<td><input type="text" name="rabatt_3" maxlength="30" size="30" value="<%$wp_output_rabatt_3%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 4:</b></td>
<td><input type="text" name="rabatt_4" maxlength="30" size="30" value="<%$wp_output_rabatt_4%>"></td>
</tr>
<tr>
<td><b>Rabatt Stufe 5:</b></td>
<td><input type="text" name="rabatt_5" maxlength="30" size="30" value="<%$wp_output_rabatt_5%>"></td>
</tr>
</table>
<br>
<h1>Grundpreise der Kampagnen</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="300"><b>Forcedklicks:</b></td>
<td><input type="text" name="grundpreis_forcedbanner" maxlength="30" size="30" value="<%$wp_output_grundpreis_forcedbanner%>"></td>
</tr>
<tr>
<td><b>Bannerviews:</b></td>
<td><input type="text" name="grundpreis_bannerviews" maxlength="30" size="30" value="<%$wp_output_grundpreis_bannerviews%>"></td>
</tr>
<tr>
<td><b>Bannerklicks:</b></td>
<td><input type="text" name="grundpreis_bannerklicks" maxlength="30" size="30" value="<%$wp_output_grundpreis_bannerklicks%>"></td>
</tr>
<tr>
<td><b>Buttonviews:</b></td>
<td><input type="text" name="grundpreis_buttonviews" maxlength="30" size="30" value="<%$wp_output_grundpreis_buttonviews%>"></td>
</tr>
<tr>
<td><b>Buttonklicks:</b></td>
<td><input type="text" name="grundpreis_buttonklicks" maxlength="30" size="30" value="<%$wp_output_grundpreis_buttonklicks%>"></td>
</tr>
<tr>
<td><b>Surfbarviews:</b></td>
<td><input type="text" name="grundpreis_surfbarviews" maxlength="30" size="30" value="<%$wp_output_grundpreis_surfbarviews%>"></td>
</tr>
<tr>
<td><b>Surfbarklicks:</b></td>
<td><input type="text" name="grundpreis_surfbarklicks" maxlength="30" size="30" value="<%$wp_output_grundpreis_surfbarklicks%>"></td>
</tr>
<tr>
<td><b>Textlinkviews:</b></td>
<td><input type="text" name="grundpreis_textlinkviews" maxlength="30" size="30" value="<%$wp_output_grundpreis_textlinkviews%>"></td>
</tr>
<tr>
<td><b>Textlinkklicks:</b></td>
<td><input type="text" name="grundpreis_textlinkklicks" maxlength="30" size="30" value="<%$wp_output_grundpreis_textlinkklicks%>"></td>
</tr>
<tr>
<td><b>Paidmails:</b></td>
<td><input type="text" name="grundpreis_paidmails" maxlength="30" size="30" value="<%$wp_output_grundpreis_paidmails%>"></td>
</tr>
</table>
<br>
<h1>Zuschläge in % für Reloadzeit</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="300"><b>Reloadzeit (1 Std.):</b></td>
<td><input type="text" name="reloadpreis_1" maxlength="30" size="30" value="<%$wp_output_reloadpreis_1%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (2 Std.):</b></td>
<td><input type="text" name="reloadpreis_2" maxlength="30" size="30" value="<%$wp_output_reloadpreis_2%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (4 Std.):</b></td>
<td><input type="text" name="reloadpreis_4" maxlength="30" size="30" value="<%$wp_output_reloadpreis_4%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (8 Std.):</b></td>
<td><input type="text" name="reloadpreis_8" maxlength="30" size="30" value="<%$wp_output_reloadpreis_8%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (12 Std.):</b></td>
<td><input type="text" name="reloadpreis_12" maxlength="30" size="30" value="<%$wp_output_reloadpreis_12%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (16 Std.):</b></td>
<td><input type="text" name="reloadpreis_16" maxlength="30" size="30" value="<%$wp_output_reloadpreis_16%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (20 Std.):</b></td>
<td><input type="text" name="reloadpreis_20" maxlength="30" size="30" value="<%$wp_output_reloadpreis_20%>"></td>
</tr>
<tr>
<td><b>Reloadzeit (24 Std.):</b></td>
<td><input type="text" name="reloadpreis_24" maxlength="30" size="30" value="<%$wp_output_reloadpreis_24%>"></td>
</tr>
</table>
<br>
<h1>Zuschläge in % für Aufenthalt</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<tr>
<td width="300"><b>Zuschlag für (0 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_0" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_0%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (5 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_5" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_5%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (10 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_10" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_10%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (15 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_15" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_15%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (20 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_20" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_20%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (25 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_25" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_25%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (30 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_30" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_30%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (45 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_45" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_45%>"></td>
</tr>
<tr>
<td><b>Zuschlag für (60 Sek.):</b></td>
<td><input type="text" name="aufendhaltspreis_60" maxlength="30" size="30" value="<%$wp_output_aufendhaltspreis_60%>"></td>
</tr>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="updaten">
<input type="Submit" name="updaten" value="Daten updaten">
</td>
</tr>
</form>
</table>
<%/block%>