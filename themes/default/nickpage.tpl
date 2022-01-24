<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Einrichten der Nickpage</h1>
Hier können Sie sich ihre Nickpage einrichten, nach dem Speichern wird das Formular neugeladen und die aktuellen Daten in
die Formularfelder eingetragen.<br>
<br>
<h1>Formular zur Nickpage:</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="nickpage">
			 <tr>
			  <td>Benutzername:</td>
			  <td><textarea cols="40" rows="1" name="benutzername" readonly><%$smarty.session.nickname%></textarea></td>
			 </tr>
			 <tr>
			  <td>Werber:</td>
			  <td><textarea cols="40" rows="1" name="werber" readonly><%if !empty($nickpagedaten_werber_nick)%><%$nickpagedaten_werber_nick%><%/if%></textarea></td>
			 </tr>
			 <tr>
			  <td valign="top">Benutzertext:<br><i>Maximal 400 Zeichen (kein HTML-Code)</i></td>
			  <td><textarea cols="40" rows="10" name="benutzertext"><%if !empty($nickpagedaten_benutzertext)%><%$nickpagedaten_benutzertext%><%/if%></textarea></td>
			 </tr>			
			 <tr>
			  <td>URL zum Avatar:</td>
			  <td><input type="text" name="avatar" size="40" value="<%if !empty($nickpagedaten_avatar)%><%$nickpagedaten_avatar%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>KlammID:</td>
			  <td><input type="text" name="klamm" size="40" value="<%if !empty($nickpagedaten_klamm_id)%><%$nickpagedaten_klamm_id%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>FuncoinID:</td>
			  <td><input type="text" name="funcoins" size="40" value="<%if !empty($nickpagedaten_fuco_id)%><%$nickpagedaten_fuco_id%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>Nickeys-ID:</td>
			  <td><input type="text" name="nickey" size="40" value="<%if !empty($nickpagedaten_nickey_id)%><%$nickpagedaten_nickey_id%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>ICQ#:</td>
			  <td><input type="text" name="icq" size="40" value="<%if !empty($nickpagedaten_icq)%><%$nickpagedaten_icq%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>Skype:</td>
			  <td><input type="text" name="skype" size="40" value="<%if !empty($nickpagedaten_skype)%><%$nickpagedaten_skype%><%/if%>"></td>
			 </tr>
			 <tr>
		 	  <td>MSN:</td>
			  <td><input type="text" name="msn" size="40" value="<%if !empty($nickpagedaten_msn)%><%$nickpagedaten_msn%><%/if%>"></td>
			 </tr>
		 	 <tr>
			  <td>E-Mailadresse:</td>
			  <td><input type="text" name="email" size="40" value="<%if !empty($nickpagedaten_email)%><%$nickpagedaten_email%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 1 (mit http://):</td>
		 	  <td><input type="text" name="url_1" size="40" value="<%if !empty($nickpagedaten_url_1)%><%$nickpagedaten_url_1%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_1" maxlength="255" size="40" value="<%if !empty($nickpagedaten_beschreibung_1)%><%$nickpagedaten_beschreibung_1%><%/if%>"></td>
			 </tr>			 
			 <tr>
			  <td>Webseite 2 (mit http://):</td>
		 	  <td><input type="text" name="url_2" size="40" value="<%if !empty($nickpagedaten_url_2)%><%$nickpagedaten_url_2%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_2" maxlength="255" size="40" value="<%if !empty($nickpagedaten_beschreibung_2)%><%$nickpagedaten_beschreibung_2%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 3 (mit http://):</td>
		 	  <td><input type="text" name="url_3" size="40" value="<%if !empty($nickpagedaten_url_3)%><%$nickpagedaten_url_3%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_3" maxlength="255" size="40" value="<%if !empty($nickpagedaten_beschreibung_3)%><%$nickpagedaten_beschreibung_3%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td>Webseite 4 (mit http://):</td>
		 	  <td><input type="text" name="url_4" size="40" value="<%if !empty($nickpagedaten_url_4)%><%$nickpagedaten_url_4%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_4" maxlength="255" size="40" value="<%if !empty($nickpagedaten_beschreibung_4)%><%$nickpagedaten_beschreibung_4%><%/if%>"></td>
			 </tr>
			  <tr>
			  <td>Webseite 5 (mit http://):</td>
		 	  <td><input type="text" name="url_5" size="40" value="<%if !empty($nickpagedaten_url_5)%><%$nickpagedaten_url_5%><%/if%>"></td>
			 </tr>
			 <tr>
			  <td><i>Kurzbeschreibung (max. 255 Zeichen)</i>:</td>
		 	  <td><input type="text" name="beschreibung_url_5" maxlength="255" size="40" value="<%if !empty($nickpagedaten_beschreibung_5)%><%$nickpagedaten_beschreibung_5%><%/if%>"></td>
			 </tr>
			 <tr>
		 	  <td colspan="2" align="center">
               <input type="hidden" name="do" value="create_nickpage">
               <input type="Submit" name="create_nickpage" value="Nickpage erstellen"></td>
			 </tr>
			 </form>
			</table>
<%/block%>