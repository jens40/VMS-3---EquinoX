<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Deine wichtigsten Links</h1>
<b>Dein Reflink zum werben neuer User:</b><br>
<a href="<%$seitenurl%>/index.php?werber=<%$smarty.session.nickname%>" target="_blank"><%$seitenurl%>/index.php?werber=<%$smarty.session.nickname%></a><br>
<br>
<b>Dein Bettellink inkl. Reflink:</b> (<%if $bettel_reload >= 1%> Reload <%$bettel_reload%> min. [Verg. von <%$bettel_min|number_format:2%> bis <%$bettel_max|number_format:2%><%else%>Bettellink deaktiviert<%/if%>)<br>
<a href="<%$seitenurl%>/index.php?content=site/betteln&bettelnick=<%$smarty.session.nickname%>&werber=<%$smarty.session.nickname%>" target="_blank"><%$seitenurl%>/index.php?content=site/betteln&bettelnick=<%$smarty.session.nickname%>&werber=<%$smarty.session.nickname%></a><br>
<br>
<b>Link zu deiner Nickpage inkl. Reflink:</b><br>
<a href="<%$seitenurl%>/index.php?content=user/nickpage&shownick=<%$smarty.session.nickname%>&werber=<%$smarty.session.nickname%>" target="_blank"><%$seitenurl%>/index.php?content=user/nickpage&shownick=<%$smarty.session.nickname%>&werber=<%$smarty.session.nickname%></a><br>
<br>
<h1>Dein Userprofil</h1>
<%$message%>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="anmelden">
			 <tr>
			  <td width="250"><b>Benutzername (Userid):</b></td>
			  <td><%$smarty.session.nickname%> (<%$userdaten_uid%>)</td>
			 </tr>
			 <tr>
			  <td><i>Ihr Werber (Userid):</i></td>
			  <td><%$userdaten_werber_nick%> (<%$userdaten_werber_id%>)</td>
			 </tr>
			 <tr>
			  <td><b>neues Passwort:</b></td>
			  <td><input type="password" name="passwort" maxlength="25" size="25" value=""></td>
			 </tr>
			 <tr>
			  <td><b>neues Passwort (Wdh):</b></td>
			  <td><input type="password" name="passwort2" maxlength="25" size="25"  value=""></td>
		 	 </tr>
			 <tr>
			  <td>Firma:</td>
			  <td><input name="firma" maxlength="50" size="30" value="<%$userdaten_firma%>"></td>
			 </tr>
			 <tr>
			  <td><b>Geschlecht:</b></td>
			  <td><select name="geschlecht" size="1" style="width:150px;">
<option value="männlich" <%if $userdaten_geschlecht == 'männlich'%> selected<%/if%>>Männlich
<option value="weiblich" <%if $userdaten_geschlecht == 'weiblich'%> selected<%/if%>>Weiblich
</select></td>
			 </tr>
			 <tr>
			  <td><b>Vor-, Nachname:</b></td>
			  <td><%$userdaten_vorname%> <%$userdaten_nachname%></td>
			 </tr>
			 <tr>
		 	  <td><b>Strasse:</b></td>
			  <td><input type="text" name="strasse" maxlength="100" size="30" value="<%$userdaten_strasse%>"></td>
			 </tr>
			 <tr>
	 		  <td><b>PLZ / Ort:</b></td>
			  <td><input type="text" name="plz" maxlength="10" size="5" value="<%$userdaten_plz%>"> <input type="text" name="ort" maxlength="50" size="25" value="<%$userdaten_ort%>"></td>
			 </tr>
			 <tr>
			  <td><b>Land:</b></td>
			  <td>
			  <select name="land" size="1">
			  <option value="Deutschland" <%if $userdaten_land=='Deutschland'%>selected<%/if%>>Deutschland
			  <option value="Österreich" <%if $userdaten_land=='Österreich'%>selected<%/if%>>Österreich
			  <option value="Schweiz" <%if $userdaten_land=='Schweiz'%>selected<%/if%>>Schweiz
			  </select>
			  </td>
			 </tr>
			 <tr>
	 		  <td><b>Geburtsdatum:</b></td>
			  <td><input type="Text" name="geburtsdatum" maxlength="50" size="30" value="<%$userdaten_geburtsdatum%>"> (TT.MM.JJJJ)</td>
			 </tr>
			 <tr>
			  <td><b>E-Mail:</b></td>
			  <td><input type="text" name="email" maxlength="50" size="30" value="<%$userdaten_email%>"></td>
			 </tr>
		 	 <tr>
			  <td>Telefon:</td>
			  <td><input type="text" name="telefon" maxlength="50" size="30" value="<%$userdaten_telefon%>"></td>
			 </tr>
		 	 <tr>
			  <td>Mobiltelefon:</td>
			  <td><input type="text" name="mobil" maxlength="50" size="30" value="<%$userdaten_mobil%>"></td>
			 </tr>
			 <tr>
			  <td>Fax:</td>
		 	  <td><input type="text" name="fax" maxlength="50" size="30" value="<%$userdaten_fax%>"></td>
			 </tr>
			 </table>
			 <br>
<h1>Weitere Einstellungen</h1>
			 <table border="0" cellpadding="1" cellspacing="1" width="100%">
			 <tr>
			  <td width="250"><b>Max. Banneranzeige:</b></td>
			  <td align="left">
			  <select name="banneranzeigen" size="1">
			  <option value="10" <%if $userdaten_max_banner == 10%> selected<%/if%>>10 Forcedbanner
			  <option value="25" <%if $userdaten_max_banner == 25%> selected<%/if%>>25 Forcedbanner
			  <option value="50" <%if $userdaten_max_banner == 50%> selected<%/if%>>50 Forcedbanner
			  <option value="100" <%if $userdaten_max_banner == 100%> selected<%/if%>>100 Forcedbanner
			  <option value="250" <%if $userdaten_max_banner == 250%> selected<%/if%>>250 Forcedbanner
			  <option value="500" <%if $userdaten_max_banner == 500%> selected<%/if%>>500 Forcedbanner
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td width="250"><b>Max. Paidmails pro Tag:</b></td>
			  <td align="left">
			  <select name="max_pmail" size="1">
			  <option value="0" <%if $userdaten_max_pmail == 0%> selected<%/if%>>0 (kein Empfang)
			  <option value="5" <%if $userdaten_max_pmail == 5%> selected<%/if%>>5 (pro Tag)
			  <option value="10" <%if $userdaten_max_pmail == 10%> selected<%/if%>>10 (pro Tag)
			  <option value="25" <%if $userdaten_max_pmail == 25%> selected<%/if%>>25 (pro Tag)
			  <option value="50" <%if $userdaten_max_pmail == 50%> selected<%/if%>>50 (pro Tag)
			  <option value="999" <%if $userdaten_max_pmail == 999%> selected<%/if%>>ohne Limits
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td><b>Tresorpasswort (6-50 Zeichen a-Z & 0-9):</b></td>
			  <td><input type="Password" name="tresorpasswort" maxlength="50" value="" style="width:260px;"></td>
			 </tr>
			 <tr>
             <%if $userdaten_tresorpasswort != ''%>			 
			  <td><b>neues Passwort (Wdh):</b></td>
			  <td><input type="Password" name="tresorpasswort" maxlength="50" value="" style="width:260px;"></td>		 	 
		 	 <%else%>
             <td><b><font color="#990000">Ersteingabe des Tresorpasswortes!</font><br></td>
            <%/if%>
            </tr>
			 <tr>
			  <td colspan="2" align="center"><br>
              <input type="hidden" name="do" value="updaten">
              <input type="Submit" name="updaten" value="Daten updaten">
              </td>
			 </tr>
			 </form>
			</table>
	
<%if $bank == 1%>
<br>
<h1>Kontoeinstellungen</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post" name="bank">
<tr>
<td width="250"><b>Kreditinstitut:</b></td>
<td><input type="text" name="knt_bank" maxlength="100" size="30" value="<%$userdaten_kreditinstitut%>"></td>
</tr>
<tr>
<td><b>Kontoinhaber:</b></td>
<td><input type="text" name="knt_inhaber" maxlength="100" size="30" value="<%$userdaten_kontoinhaber%>"></td>
</tr>
<tr>
<td><b>Kontonummer:</b></td>
<td><input type="text" name="knt_nummer" maxlength="100" size="30" value="<%$userdaten_kontonummer%>"></td>
</tr>
<tr>
<td><b>Bankleitzahl:</b></td>
<td><input type="text" name="knt_blz" maxlength="100" size="30" value="<%$userdaten_bankleitzahl%>"></td>
</tr>
<tr>
<td>IBAN*:</td>
<td><input type="text" name="knt_iban" maxlength="100" size="30" value="<%$userdaten_iban%>"></td>
</tr>
<tr>
<td>BIC*:</td>
<td><input type="text" name="knt_bic" maxlength="100" size="30" value="<%$userdaten_bic%>"></td>
</tr>
<%if $paypal == 1%>
<tr>
<td><i>Paypal:</i></td>
<td><input type="text" name="paypal" maxlength="100" size="30" value="<%$userdaten_paypal%>"></td>
</tr>
<%/if%>
<%if $moneybookers == 1%>
<tr>
<td><i>Moneybookers:</i></td>
<td><input type="text" name="moneybookers" maxlength="100" size="30" value="<%$userdaten_moneybookers%>"></td>
</tr>
<%/if%>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="knt_updaten">
<input type="Submit" name="knt_updaten" value="Konten updaten"></td>
</tr>
</form>
</table>
<br>
<%/if%>

<%if $klamm == 1%>
<br>
<h1>Klammkonto verifizieren</h1>
<%if $userdaten_klamm_id != 0%>
<br><div align="center">Klammid: <b><%$userdaten_klamm_id%></b> verifiziert</div>
<%else%>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post" name="klamm">
<tr>
<td width="250"><b>Klammid:</b></td>
<td><input type="text" name="klammid" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td><b>Losepasswort*:</b></td>
<td><input type="password" name="losepasswort" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td colspan="2" align="center"><br><input type="Submit" name="klamm_ver" value="Klammkonto aktivieren"></td>
</tr>
</form>
</table>
<br>
* Das Losepasswort wird nicht gespeichert!<br>
<%/if%>
<%/if%>

<%if $funcoins == 1%>
<br>
<h1>Funcoinskonto verifizieren</h1>
<%if $userdaten_fuco_id != 0%>
<br><div align="center">Funcoins-ID: <b><%$userdaten_fuco_id%></b> verifiziert</div>
<%else%>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post" name="funcoins">
<tr>
<td width="250"><b>Funcoins-ID:</b></td>
<td><input type="text" name="fucoid" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td><b>FuCopasswort*:</b></td>
<td><input type="password" name="fucopasswort" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td colspan="2" align="center"><br><input type="Submit" name="fuco_ver" value="Funcoinskonto aktivieren"></td>
</tr>
</form>
</table>
<br>
* Das Funcoinspasswort wird nicht gespeichert!<br>
<%/if%>
<%if $nickey == 1%>>
<br>
<h1>Nickeykonto verifizieren</h1>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form action="" method="post" name="nickeys">
<tr>
<td width="250"><b>Nickeys-ID:</b></td>
<td><input type="text" name="nickeyid" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td><b>Nickeypasswort*:</b></td>
<td><input type="password" name="nickeypasswort" maxlength="100" size="30" value=""></td>
</tr>
<tr>
<td colspan="2" align="center"><br><input type="Submit" name="nickey_ver" value="Nickeykonto aktivieren"></td>
</tr>
</form>
</table>
<br>
* Das Nickeypasswort wird nicht gespeichert!<br>
<%/if%>
<%/if%>
<%/block%>