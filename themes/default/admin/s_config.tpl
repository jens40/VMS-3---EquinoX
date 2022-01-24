<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Schnittstellenkonfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="s_config1">
			 <tr>
			  <td width="300">Schnittstelle auswählen:</td>
			  <td>
			  <select name="schnittstelle" size="1" onchange="this.form.submit()">
			  <option value="fucoex" <%if $schnittstelleconfig_schnittstelle == 'fucoex'%>selected<%/if%>>FuCoEx (Funcoins)
			  <option value="klamm" <%if $schnittstelleconfig_schnittstelle == 'klamm'%>selected<%/if%>>ExportForce (Klammlose)
			  <option value="nickeyforce" <%if $schnittstelleconfig_schnittstelle == 'nickeyforce'%>selected<%/if%>>FuCoEx (Nickeys)
			  </select>
			  </td>
			  </form>
			 </tr>
			 <tr>
			 <form action="" method="post" name="s_config2">
			 <input type="Hidden" name="schnittstelle" value="<%$schnittstelle%>">
			  <td>Betreiberid:</td>
			  <td><input type="text" name="betreiber_id" size="40" value="<%$schnittstelleconfig_betreiber_id%>"></td>
			 </tr>
			 <tr>
			  <td>Betreiberpasswort:</td>
			  <td><input type="text" name="betreiber_passwort" size="40" value="<%$schnittstelleconfig_betreiber_passwort%>"></td>
			 </tr>
			 <tr>
			  <td>Betreiberkennung:</td>
			  <td><input type="text" name="betreiber_kennung" size="40" value="<%$schnittstelleconfig_betreiber_kennung%>"></td>
			 </tr>
			 <tr>
			  <td>Buchungstext (Einzahlung)<sup>1</sup>:</td>
			  <td><input type="text" name="einzahltext" size="40" value="<%$schnittstelleconfig_einzahltext%>"></td>
			 </tr>
			 <tr>
			  <td>Buchungstext (Auszahlung)<sup>2</sup>:</td>
			  <td><input type="text" name="auszahltext" size="40" value="<%$schnittstelleconfig_auszahltext%>"></td>
			 </tr>
			 <tr>
			  <td>Mindestmenge beim Einzahlen<sup>3</sup>:</td>
			  <td><input type="text" name="einzahlsumme" size="40" value="<%$schnittstelleconfig_einzahlsumme%>"></td>
			 </tr>
			 <tr>
			  <td>Mindestmenge beim Auszahlen<sup>4</sup>:</td>
			  <td><input type="text" name="auszahlsumme" size="40" value="<%$schnittstelleconfig_auszahlsumme%>"></td>
			 </tr>
			 <tr>
			  <td>Freianfragen pro Tag (nur Auszahlungen)<sup>5</sup>:</td>
			  <td><input type="text" name="anfragen_tag" size="40" value="<%$schnittstelleconfig_anfragen_tag%>"></td>
			 </tr>
			 <tr>
			  <td>Gebühren bei Mehranfragen (nur Auszahlungen)<sup>6</sup>:</td>
			  <td><input type="text" name="anfragen_geb" size="40" value="<%$schnittstelleconfig_anfragen_geb%>"></td>
			 </tr>
			</table>
<br>
<div align="center">
<input type="hidden" name="do" value="speichern_sconfig">
<input type="Submit" name="speichern_sconfig" value="Speichern">
</div>
</form>
<h1>Schnittstelleninformationen</h1>
1 & 2) Dieser Text wird bei bei dem Schnittstellenanbieter eingetragen<br>
<br>
3) Wieviel muss ein User mindestens einzahlen, bitte auch beim Betreiber schauen!<br>
<br>
4) Wieviel muss ein User mindestens auszahlen, bitte auch beim Betreiber schauen!<br>
<br>
5) Anzahl der Freianfragen pro User, wenn eine 0 (Null) eingetragen ist besteht kein Limit<br>
<br>
6) Gebühren pro <b>Mehranfrage</b> ausser wenn bei Punkt 5 ein 0 (Null) gesetzt wurde, ausgehend von der Währung des Schnittstellenanbieter!<br>
<%/block%>