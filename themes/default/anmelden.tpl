<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Anmeldung</h1>
<%if !empty($ok)%>

Ihr Anmeldung war erfolgreich, wir haben ihnen eine E-Mail mit einem Aktivierungslink gesendet.<br>
<br>
Bitte schauen sie ihre E-Mails durch nach unserer E-Mail!<br>
<br>
Nach dem bestädigen des Aktivierungslinks können Sie sich auf unserer Weibseite einloggen
und weitere Einstellungen vornehmen.<br>
<br>
Wir wünschen Ihnen viel Spass...<br>

<%else%>

Bitte fülle das folgende Formular wahrheitsgemäß aus. Deine Daten werden in
elektronischer Form gespeichert und externen Dritten nicht zugänglich gemacht. <br>
<br>
<h1>Anmeldeformular</h1>
<strong>Fett</strong> angedruckte Felder müssen ausgefüllt werden, andere sind optional.
Mit Absendung des Formulares erkennst Du unsere Regeln und Bestimmungen ausdrücklich an.<br>
<br>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <%$message%>
           <form action="" method="post" name="anmelden">
			 <tr>
			  <td width="100"><b>Benutzername:</b></td>
			  <td><input type="text" name="username" maxlength="25" size="25" value="<%$username%>" <%if isset($fehler['farbe']['username'])%><%$fehler['farbe']['username']%><%/if%>></td>
			 </tr>
			 <tr>
			  <td><i>Ihr Werber:</i></td>
			  <td><input type="text" maxlength="25" size="25" value="<%$werber%>" readonly></td>
			 </tr>
			 <tr>
			  <td><b>Passwort:</b></td>
			  <td><input type="password" name="passwort" maxlength="25" size="25" value="<%$passwort%>" <%if isset($fehler['farbe']['passwort'])%><%$fehler['farbe']['passwort']%><%/if%>></td>
			 </tr>
			 <tr>
			  <td><b>Passwort (Wdh):</b></td>
			  <td><input type="password" name="passwort2" maxlength="25" size="25"  value="<%$passwort2%>" <%if isset($fehler['farbe']['passwort2'])%><%$fehler['farbe']['passwort2']%><%/if%>></td>
		 	 </tr>
			 <tr>
			  <td>Firma:</td>
			  <td><input type="text" name="firma" maxlength="50" size="30" value="<%$firma%>"></td>
			 </tr>
			 <tr>
			  <td><b>Geschlecht:</b></td>
			  <td><select name="geschlecht" size="1" style="width:140px;">
                    <option value="männlich">Männlich
                    <option value="weiblich">Weiblich
                   </select>
              </td>
			 </tr>
			 <tr>
			  <td><b>Vor-, Nachname:</b></td>
			  <td><input type="text" name="vorname" maxlength="50" size="15" value="<%$vorname%>" <%if isset($fehler['farbe']['vorname'])%><%$fehler['farbe']['vorname']%><%/if%>> <input type="text" name="nachname" maxlength="50" size="15" value="<%$nachname%>" <%if isset($fehler['farbe']['nachname'])%><%$fehler['farbe']['nachname']%><%/if%>></td>
			 </tr>
			 <tr>
		 	  <td><b>Strasse:</b></td>
			  <td><input type="text" name="strasse" maxlength="100" size="30" value="<%$strasse%>" <%if isset($fehler['farbe']['strasse'])%><%$fehler['farbe']['strasse']%><%/if%>></td>
			 </tr>
			 <tr>
	 		  <td><b>PLZ / Ort:</b></td>
			  <td><input type="text" name="plz" maxlength="10" size="5" value="<%$plz%>" <%if isset($fehler['farbe']['plz'])%><%$fehler['farbe']['plz']%><%/if%>> <input type="text" name="ort" maxlength="50" size="25" value="<%$ort%>" <%if isset($fehler['farbe']['ort'])%><%$fehler['farbe']['ort']%><%/if%>></td>
			 </tr>
			 <tr>
			  <td><b>Land:</b></td>
			  <td>
			  <%html_options name=land class="form-control" options=$aLand selected=$land%>
			  </td>
			 </tr>
			 <tr>
	 		  <td><b>Geburtsdatum:</b></td>
			  <td><input type="Text" name="geburtsdatum" maxlength="50" size="30" value=""> (TT.MM.JJJJ)</td>
			 </tr>
			 <tr>
			  <td><b>E-Mail:</b></td>
			  <td><input type="text" name="email" maxlength="50" size="30" value="<%$email%>" <%if isset($fehler['farbe']['email'])%><%$fehler['farbe']['email']%><%/if%>></td>
			 </tr>
		 	 <tr>
			  <td>Telefon:</td>
			  <td><input type="text" name="telefon" maxlength="50" size="30" value="<%$telefon%>"></td>
			 </tr>
		 	 <tr>
			  <td>Mobiltelefon:</td>
			  <td><input type="text" name="mobil" maxlength="50" size="30" value="<%$mobil%>"></td>
			 </tr>
			 <tr>
			  <td>Fax:</td>
		 	  <td><input type="text" name="fax" maxlength="50" size="30" value="<%$fax%>"></td>
			 </tr>
			 <%if $sitekey !=''%>
             <tr>
			  <td>Code:</td>
		 	  <td>                                
              
              <div class="g-recaptcha" data-sitekey="<%$sitekey%>"></div>                                
              </td>
			 </tr>
             <%/if%>
			 <tr>
			  <td colspan="2">Alle weiteren Daten werden im Profil nach der Anmeldung eingetragen und aktuallisiert.</td>
			 </tr>
			  <tr>
			  <td colspan="2">Mit dem absenden der Anmeldung bestädige ich die <a href="index.php?content=site/agb" target="_self">AGB's</a> gelesen und auch verstanden zu haben.</td>
			 </tr>
			  <tr>
			  <input type="hidden" name="do" value="checkData">
              <td colspan="2" align="center"><br><input type="Submit" name="neuanmelden" value="Jetzt anmelden">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Reset" value="Formulardaten löschen"></td>
			 </tr>
			 </form>
			</table>
<%/if%>
<%/block%>