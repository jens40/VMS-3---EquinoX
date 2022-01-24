<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Seitenkonfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="admin.php?admincontent=p_config" method="post" name="p_config">
			 <tr>
			  <td width="300">Dein Lizenzschlüssel:</td>
			  <td><input type="text" name="lizenzkey" size="40" value="<%$lizenzkey%>"></td>
			 </tr>
			 <tr>
			  <td>Name dieser Seite:</td>
			  <td><input type="text" name="seitenname" size="40" value="<%$seitenname%>"></td>
			 </tr>
			 <tr>
			  <td>URL dieser Webseite:</td>
			  <td><input type="text" name="seitenurl" size="40" value="<%$seitenurl%>"></td>
			 </tr>
			 <tr>
			  <td>Betreibermailaddy:</td>
			  <td><input type="text" name="betreibermail" size="40" value="<%$betreibermail%>"></td>
			 </tr>
			 <tr>
			  <td>Passwort für Crons:</td>
			  <td><input type="text" name="cronpasswort" size="40" value="<%$cronpasswort%>"></td>
			 </tr>
			 <tr>
			  <td>Name der Währung (intern):</td>
			  <td><input type="text" name="waehrungsname" size="40" value="<%$waehrungsname%>"></td>
			 </tr>
			 <tr>
			  <td>Anzahl Stellen nach dem Komma:</td>
			  <td><input type="text" name="nach_koma" size="40" value="<%$nach_koma%>"></td>
			 </tr>
			 <tr>
			  <td>Refebenen:</td>
			  <td><textarea name="refebenen" style="width:255px; height:40px;"><%$refebenen%></textarea></td>
			 </tr>
			 <tr>
			  <td width="300">Wartungsmodus:</td>
			  <td>
			  <select name="wartungsmodus" size="1">
			  <option value="ja" <?if ($_POST['wartungsmodus'] == 'ja') {echo 'selected';} else {echo '';}?>>Aktiviert
			  <option value="nein" <?if ($_POST['wartungsmodus'] == 'nein') {echo 'selected';} else {echo '';}?>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			</table>
<br>
<h1>Guthabenkonfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   	 <tr>
			  <td>Interne Überweisung:</td>
			  <td>
			  <select name="ueberweisung" size="1">
			  <option value="1" <%if $ueberweisung == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $ueberweisung == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td width="300">Min. Summe bei interner Überweisung:</td>
			  <td><input type="text" name="ueberweisungssumme" size="10" value="<%$ueberweisungssumme%>"></td>
			 </tr>
			 <tr>
			  <td width="300">Auszahlung per Bank:</td>
			  <td>
			  <select name="bank" size="1">
			  <option value="1" <%if $bank == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $bank == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Auszahlung per PayPal:</td>
			  <td>
			  <select name="paypal" size="1">
			  <option value="1" <%if $paypal == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $paypal == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Auszahlung per Moneybookers:</td>
			  <td>
			  <select name="moneybookers" size="1">
			  <option value="1" <%if $moneybookers == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $moneybookers == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Ein / Auszahlen mit Klammlosen:</td>
			  <td>
			  <select name="klamm" size="1">
			  <option value="1" <%if $klamm == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $klamm == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Ein / Auszahlen mit Funcoins:</td>
			  <td>
			  <select name="funcoins" size="1">
			  <option value="1" <%if $funcoins == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $funcoins == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Ein / Auszahlen mit Nickeys:</td>
			  <td>
			  <select name="nickey" size="1">
			  <option value="1" <%if $nickey == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $nickey == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 <tr>
			  <td>Ein / Auszahlen mit Downies:</td>
			  <td>
			  <select name="downies" size="1">
			  <option value="1" <%if $downies == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $downies == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			</table>
<br>
<h1>Kurskonfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
			 <tr>
			  <td width="300">Kurs Intern -> Euro (1 zu ...):</td>
			  <td><input type="text" name="kurs_euro" size="40" value="<%$kurs_euro%>"></td>
			 </tr>
			 <tr>
			  <td>Kurs Intern -> Klammlose (1 zu ...):</td>
			  <td><input type="text" name="kurs_klamm" size="40" value="<%$kurs_klamm%>"></td>
			 </tr>
			 <tr>
			  <td>Kurs Intern -> Funcoins (1 zu ...):</td>
			  <td><input type="text" name="kurs_funcoins" size="40" value="<%$kurs_funcoins%>"></td>
			 </tr>
			 <tr>
			  <td>Kurs Intern -> Nickey (1 zu ...):</td>
			  <td><input type="text" name="kurs_nickey" size="40" value="<%$kurs_nickey%>"></td>
			 </tr>
			</table>
<br>
<h1>Bettellink Konfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
			 <tr>
			  <td width="300">Min. Vergütung:</td>
			  <td><input type="text" name="bettel_min" size="40" value="<%$bettel_min%>"></td>
			 </tr>
			 <tr>
			  <td>Max. Vergütung:</td>
			  <td><input type="text" name="bettel_max" size="40" value="<%$bettel_max%>"></td>
			 </tr>
			 <tr>
			  <td>Bettellink Reload in Minuten*:</td>
			  <td><input type="text" name="bettel_reload" size="40" value="<%$bettel_reload%>"></td>
			 </tr>
			</table><br>
			* 0 (Null) wenn Betteln deaktiviert sein soll<br>
<br>
<h1>Smtp Host Einstellungen</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
			 <tr>
			  <td width="300">Smtp Host:</td>
			  <td><input type="text" name="smtp_host" size="40" value="<%$smtp_host%>"></td>
			 </tr>
			 <tr>
			  <td width="300">Smtp Username:</td>
			  <td><input type="text" name="smtp_username" size="40" value="<%$smtp_username%>"></td>
			 </tr>
			 <tr>
			  <td width="300">Smtp Passwort:</td>
			  <td><input type="text" name="smtp_passwort" size="40" value="<%$smtp_passwort%>"></td>
			 </tr>   			 
			 <tr>
			  <td width="300">Smtp Port:</td>
			  <td><input type="text" name="smtp_port" size="40" value="<%$smtp_port%>"></td>
			 </tr>   
             </table>          
<h1>Sondereinstellungen</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
			 <tr>
			  <td>Einzelklicks by Forcedklick:</td>
			  <td>
			  <select name="ocs" size="1">
			  <option value="1" <%if $ocs == 1%>selected<%/if%>>Aktiviert
			  <option value="0" <%if $ocs == 0%>selected<%/if%>>Deaktiviert
			  </select>
			  </td>
			 </tr>
			 </table>
<div align="center">
<input type="hidden" name="do" value="speichern_pconfig">
<input type="Submit" name="speichern_pconfig" value="Speichern">
</div>
</form>
<%/block%>