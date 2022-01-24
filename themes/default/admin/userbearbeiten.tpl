<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Userprofil von <%$user_fields_nickname%></h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="change">
		   <input type="Hidden" name="uid" value="<%$user_fields_uid%>">
		   <input type="Hidden" name="nickname" value="<%$user_fields_nickname%>">
		   <input type="Hidden" name="oldpasswort" value="<%$user_fields_passwort%>">
		   <input type="Hidden" name="werber_id" value="<%$user_fields_werber_id%>">
			 <tr>
			  <td width="200"><b>Benutzername (Userid):</b></td>
			  <td><%$user_fields_nickname%> (<%$user_fields_uid%>)</td>
			 </tr>
			 <tr>
			  <td width="200"><b>Register-IP:</b></td>
			  <td><a href="http://www.dnsstuff.com/tools/whois.ch?ip=<%$user_fields_regip%>" target="_blank"><%$user_fields_regip%></a></td>
			 </tr>
			 <tr>
			  <td width="200"><b>Aktivpunkte: (<a href="admin.php?admincontent=userbearbeiten&uid=<%$user_fields_uid%>&reset=aktivpunkte" target="_self">Reset</a>)</b></td>
			  <td><%$user_fields_aktivpunkte|number_format:2%> Punkte</td>
			 </tr>
			 <tr>
			  <td><i>Werber (Userid):</i></td>
			  <td><input type="text" name="werber_nick" maxlength="50" size="30" value="<%$user_fields_werber_nick%>"> <%$user_fields_werber_id%></td>
			 </tr>
			 <tr>
			  <td><b>neues Passwort:</b></td>
			  <td><input type="text" name="passwort" maxlength="50" size="25" value=""></td>
			 </tr>
			 <tr>
			  <td>Firma:</td>
			  <td><input type="text" name="firma" maxlength="50" size="30" value="<%$user_fields_firma%>"></td>
			 </tr>
			 <tr>
			  <td><b>Geschlecht:</b></td>
			  <td><select name="geschlecht" size="1" style="width:150px;">
                <option value="männlich" <%if $user_fields_geschlecht == 'männlich'%> selected<%/if%>>Männlich
                <option value="weiblich" <%if $user_fields_geschlecht == 'weiblich'%> selected<%/if%>>Weiblich
            </select>
            </td>
			 </tr>
			 <tr>
			  <td><b>Vor-, Nachname:</b></td>
			  <td><input type="text" name="vorname" maxlength="50" size="15" value="<%$user_fields_vorname%>">&nbsp;<input type="test" name="nachname" maxlength="50" size="15" value="<%$user_fields_nachname%>"></td>
			 </tr>
			 <tr>
		 	  <td><b>Strasse:</b></td>
			  <td><input type="text" name="strasse" maxlength="100" size="30" value="<%$user_fields_strasse%>"></td>
			 </tr>
			 <tr>
	 		  <td><b>PLZ / Ort:</b></td>
			  <td><input type="text" name="plz" maxlength="10" size="5" value="<%$user_fields_plz%>"> <input type="text" name="ort" maxlength="50" size="25" value="<%$user_fields_ort%>"></td>
			 </tr>
			 <tr>
			  <td><b>Land:</b></td>
			  <td>
			  <select name="land" size="1">
			  <option value="Deutschland" <%if $user_fields_land=='Deutschland'%>selected<%/if%>>Deutschland
			  <option value="Österreich" <%if $user_fields_land=='Österreich'%>selected<%/if%>>Österreich
			  <option value="Schweiz" <%if $user_fields_land=='Schweiz'%>selected<%/if%>>Schweiz
			  </select>
			  </td>
			 </tr>
	 		  <td><b>Geburtsdatum:</b></td>
			  <td><input type="Text" name="geburtsdatum" maxlength="50" size="30" value="<%$user_fields_geburtsdatum%>"> (TT.MM.JJJJ)</td>
			 </tr>             
			 <tr>
			  <td><b>E-Mail:</b></td>
			  <td><input type="text" name="email" maxlength="50" size="30" value="<%$user_fields_email%>"></td>
			 </tr>
		 	 <tr>
			  <td>Telefon:</td>
			  <td><input type="text" name="telefon" maxlength="50" size="30" value="<%$user_fields_telefon%>"></td>
			 </tr>
		 	 <tr>
			  <td>Mobiltelefon:</td>
			  <td><input type="text" name="mobil" maxlength="50" size="30" value="<%$user_fields_mobil%>"></td>
			 </tr>
			 <tr>
			  <td>Fax:</td>
		 	  <td><input type="text" name="fax" maxlength="50" size="30" value="<%$user_fields_fax%>"></td>
			 </tr>
			 <tr>
			  <td><b>Max. Banneranzeige:</b></td>
			  <td align="left">
			  <select name="banneranzeigen" size="1">
			  <option value="10" <%if $user_fields_max_banner == 10%>selected<%/if%>>10 Forcedbanner
			  <option value="25" <%if $user_fields_max_banner == 25%>selected<%/if%>>25 Forcedbanner
			  <option value="50" <%if $user_fields_max_banner == 50%>selected<%/if%>>50 Forcedbanner
			  <option value="100" <%if $user_fields_max_banner == 100%>selected<%/if%>>100 Forcedbanner
			  <option value="250" <%if $user_fields_max_banner == 250%>selected<%/if%>>250 Forcedbanner
			  <option value="500" <%if $user_fields_max_banner == 500%>selected<%/if%>>500 Forcedbanner
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td><b>Max. Paidmails pro Tag:</b></td>
			  <td align="left">
			  <select name="max_pmail" size="1">
			  <option value="0" <%if $user_fields_max_pmail == 0%>selected<%/if%>>0 (kein Empfang)
			  <option value="5" <%if $user_fields_max_pmail == 5%>selected<%/if%>>5 (pro Tag)
			  <option value="10" <%if $user_fields_max_pmail == 10%>selected<%/if%>>10 (pro Tag)
			  <option value="25" <%if $user_fields_max_pmail == 25%>selected<%/if%>>25 (pro Tag)
			  <option value="50" <%if $user_fields_max_pmail == 50%>selected<%/if%>>50 (pro Tag)
			  <option value="999" <%if $user_fields_max_pmail == 999%>selected<%/if%>>ohne Limits
			  </select>
			  </td>
			 </tr>


<tr>
<td><b>Kreditinstitut:</b></td>
<td><input type="text" name="knt_bank" maxlength="100" size="30" value="<%$user_fields_kreditinstitut%>"></td>
</tr>
<tr>
<td><b>Kontoinhaber:</b></td>
<td><input type="text" name="knt_inhaber" maxlength="100" size="30" value="<%$user_fields_kontoinhaber%>"></td>
</tr>
<tr>
<td><b>Kontonummer:</b></td>
<td><input type="text" name="knt_nummer" maxlength="100" size="30" value="<%$user_fields_kontonummer%>"></td>
</tr>
<tr>
<td><b>Bankleitzahl:</b></td>
<td><input type="text" name="knt_blz" maxlength="100" size="30" value="<%$user_fields_bankleitzahl%>"></td>
</tr>
<tr>
<td>IBAN*:</td>
<td><input type="text" name="knt_iban" maxlength="100" size="30" value="<%$user_fields_iban%>"></td>
</tr>
<tr>
<td>BIC*:</td>
<td><input type="text" name="knt_bic" maxlength="100" size="30" value="<%$user_fields_bic%>"></td>
</tr>
<tr>
<td><i>Paypal:</i></td>
<td><input type="text" name="paypal" maxlength="100" size="30" value="<%$user_fields_paypal%>"></td>
</tr>
<tr>
<td><i>Moneybookers:</i></td>
<td><input type="text" name="moneybookers" maxlength="100" size="30" value="<%$user_fields_moneybookers%>"></td>
</tr>
<tr>
<td><b>Klammid:</b></td>
<td><input type="text" name="klamm_id" maxlength="100" size="30" value="<%$user_fields_klamm_id%>"></td>
</tr>
<tr>
<td><b>Funcoins-ID:</b></td>
<td><input type="text" name="fuco_id" maxlength="100" size="30" value="<%$user_fields_fuco_id%>"></td>
</tr>
<tr>
<td><b>Nickeys-ID:</b></td>
<td><input type="text" name="nickey_id" maxlength="100" size="30" value="<%$user_fields_nickey_id%>"></td>
</tr>
<tr>
<td><b>Userstatus:</b></td>
<td align="left">
<select name="status" size="1">
<option value="1" <%if $user_fields_status == 1%>selected<%/if%>>Freigeschaltet
<option value="0" <%if $user_fields_status == 0%>selected<%/if%>>Nicht aktiviert
<option value="2" <%if $user_fields_status == 2%>selected<%/if%>>User gesperrt
</select>
</td>
</tr>
<tr>
<td><b>Doppelaccountüberwachung:</b></td>
<td align="left">
<select name="d_acc" size="1">
<option value="0" <%if $user_fields_d_acc == 0%>selected<%/if%>>aktiviert
<option value="1" <%if $user_fields_d_acc == 1%>selected<%/if%>>Nicht aktiviert
</select>
</td>
</tr>
<tr>
<td><b><font color="#cc0000">Adminstatus:</font></b></td>
<td align="left">
<select name="admin" size="1">
<option value="1" <%if $user_fields_admin == 1%>selected<%/if%>>Administrator
<option value="0" <%if $user_fields_admin == 0%>selected<%/if%>>User
</select>
</td>
</tr>
<tr>
<td><b><font color="#cc0000">Tresor-Passwort:</font></b></td>
<td align="left">
<input type="checkbox" name="tn" value="1"> Zurücksetzen
</td>
</tr>
<tr>
<td><b><font color="#cc0000">Autoklick-Reset:</font></b></td>
<td align="left">
<input type="checkbox" name="akn" value="1"> Zurücksetzen
</td>
</tr>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="updaten">
<input type="checkbox" name="loeschen" value="1"> User löschen&nbsp;&nbsp;&nbsp;<input type="Submit" name="updaten" value="Daten updaten"></td>
</tr>
</form>
</table>
<br>
<h1>Userdirektbuchung</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post">
<input type="Hidden" name="nickname" value="<%$user_fields_nickname%>">
<tr>
<td><b>Richtung</b></td><td><b>Summe</b></td><td><b>V.-Zweck</b></td>
</tr>
<tr>
<td>
<select name="richtung" size="1">
<option value="0">Gutschreiben
<option value="1">Abziehen
</select>
</td>
<td>
<input type="text" name="summe" maxlength="100" size="10" value="">
</td>
<td>
<input type="text" name="vzweck" maxlength="100" size="40" value="">
</td>
</tr>
<tr>
<td colspan="3" align="center"><br>
<input type="hidden" name="do" value="buchen">
<input type="Submit" name="buchen" value="Buchung durchführen!"></td>
</tr>
</form>
</table>

<%/block%>