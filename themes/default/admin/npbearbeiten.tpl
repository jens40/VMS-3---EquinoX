<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Bearbeiten der Nickpage von <%$nickpage_daten_nickname%></h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="nickpage">
			 <tr>
			  <td>Benutzername:</td>
			  <td><textarea cols="40" rows="1" name="benutzername" readonly><%$nickpage_daten_nickname%></textarea></td>
			 </tr>
			 <tr>
			  <td>Werber:</td>
			  <td><textarea cols="40" rows="1" name="werber" readonly><%$nickpage_daten_werbernick%></textarea></td>
			 </tr>
			 <tr>
			  <td valign="top">Benutzertext:<br><i>Maximal 400 Zeichen (kein HTML-Code)</i></td>
			  <td><textarea cols="40" rows="10" name="benutzertext"><%$nickpage_daten_benutzertext%></textarea></td>
			 </tr>			
			 <tr>
			  <td>URL zum Avatar:</td>
			  <td><input type="text" name="avatar" size="40" value="<%$nickpage_daten_avatar%>"></td>
			 </tr>
			 <tr>
			  <td>KlammID:</td>
			  <td><input type="text" name="klamm" size="40" value="<%$nickpage_daten_klamm_id%>"></td>
			 </tr>
			 <tr>
			  <td>FuncoinID:</td>
			  <td><input type="text" name="funcoins" size="40" value="<%$nickpage_daten_fuco_id%>"></td>
			 </tr>
			 <tr>
			  <td>Nickeys-ID:</td>
			  <td><input type="text" name="nickey" size="40" value="<%$nickpage_daten_nickey_id%>"></td>
			 </tr>
			 <tr>
			  <td>ICQ#:</td>
			  <td><input type="text" name="icq" size="40" value="<%$nickpage_daten_icq%>"></td>
			 </tr>
			 <tr>
			  <td>Skype:</td>
			  <td><input type="text" name="skype" size="40" value="<%$nickpage_daten_skype%>"></td>
			 </tr>
			 <tr>
		 	  <td>MSN:</td>
			  <td><input type="text" name="msn" size="40" value="<%$nickpage_daten_msn%>"></td>
			 </tr>
		 	 <tr>
			  <td>E-Mailadresse:</td>
			  <td><input type="text" name="email" size="40" value="<%$nickpage_daten_email%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 1 (mit http://):</td>
		 	  <td><input type="text" name="url_1" size="40" value="<%$nickpage_daten_url_1%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_1" maxlength="255" size="40" value="<%$nickpage_daten_beschreibung_1%>"></td>
			 </tr>			 
			 <tr>
			  <td>Webseite 2 (mit http://):</td>
		 	  <td><input type="text" name="url_2" size="40" value="<%$nickpage_daten_url_2%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_2" maxlength="255" size="40" value="<%$nickpage_daten_beschreibung_2%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 3 (mit http://):</td>
		 	  <td><input type="text" name="url_3" size="40" value="<%$nickpage_daten_url_3%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_3" maxlength="255" size="40" value="<%$nickpage_daten_beschreibung_3%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 4 (mit http://):</td>
		 	  <td><input type="text" name="url_4" size="40" value="<%$nickpage_daten_url_4%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_4" maxlength="255" size="40" value="<%$nickpage_daten_beschreibung_4%>"></td>
			 </tr>
			  <tr>
			  <td>Webseite 5 (mit http://):</td>
		 	  <td><input type="text" name="url_5" size="40" value="<%$nickpage_daten_url_5%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_5" maxlength="255" size="40" value="<%$nickpage_daten_beschreibung_5%>"></td>
			 </tr>
			 <tr>
		 	  <td colspan="2" align="center">
               <input type="hidden" name="do" value="create_nickpage">
               <input type="Checkbox" name="npdel" value="npdel"> Nickpage löschen&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" name="create_nickpage" value="Updaten"></td>
			 </tr>
			 </form>
			</table>

<%/block%>