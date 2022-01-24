<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Interfacekonfiguration</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="admin.php?admincontent=i_config&reload=true" method="post" name="i_config1">
			 <tr>
			  <td width="300">Interface auswählen:</td>
			  <td>
			  <select name="interface" size="1" onchange="this.form.submit()">
			  <option value="adcocktail" <%if $interfaceconfig_interface == 'adcocktail'%>selected<%/if%>>Adcocktail Forcedbanner
              <option value="adcocktail_m" <%if $interfaceconfig_interface == 'adcocktail_m'%>selected<%/if%>>Adcocktail Paidmails
			  </select>
			  </td>
			  </form>
			 </tr>
			 <tr>
			 <form action="" method="post" name="i_config2">
			 <input type="Hidden" name="interface" value="<%$interface%>">
			  <td>Betreiber:</td>
			  <td><input type="text" name="betreiber" size="40" value="<%$interfaceconfig_betreiber%>"></td>
			 </tr>
			 <tr>
			  <td>Seiten-ID:</td>
			  <td><input type="text" name="seite" size="40" value="<%$interfaceconfig_seite%>"></td>
			 </tr>
			 <tr>
			  <td>Interfacepasswort<sup>1</sup>:</td>
			  <td><input type="text" name="pass" size="40" value="<%$interfaceconfig_pass%>"></td>
			 </tr>
			 <tr>
			  <td>Eigenverdienst (in Prozent)<sup>2</sup>:</td>
			  <td><input type="text" name="eigenverdienst" size="40" value="<%$interfaceconfig_eigenverdienst%>"></td>
			 </tr>
			 <tr>
			  <td>Mindestvergütung beim Sponsor<sup>3</sup>:</td>
			  <td><input type="text" name="mindestverguetung" size="40" value="<%$interfaceconfig_mindestverguetung%>"></td>
			 </tr>
			 <tr>
			  <td>Min. Restklicks beim Sponsor<sup>4</sup>:</td>
			  <td><input type="text" name="restklicks" size="40" value="<%$interfaceconfig_restklicks%>"></td>
			 </tr>
			 <tr>
			  <td>Umrechnungskurs zur internen Währung<sup>5</sup>:</td>
			  <td><input type="text" name="umrechnung" size="40" value="<%$interfaceconfig_umrechnung%>"></td>
			 </tr>
			 <tr>
			  <td>Aufendhalt bis zur Vergütung<sup>6</sup>:</td>
			  <td><input type="text" name="aufendhalt" size="40" value="<%$interfaceconfig_aufendhalt%>"></td>
			 </tr>
			 <tr>
			  <td>Abgelaufene Kampagnen löschen:</td>
			  <td>
			  <select name="loeschen" size="1">
			  <option value="1" <%if $interfaceconfig_loeschen == 1%>selected<%/if%>>Ja, löschen
			  <option value="0" <%if $interfaceconfig_loeschen == 0%>selected<%/if%>>Nein, nicht löschen
			  </select>		  
			  </td>
			 </tr>
			</table>
<br>
<div align="center">
<input type="hidden" name="do" value="speichern_iconfig">
<input type="Submit" name="speichern_iconfig" value="Speichern">
</div>
</form>
<h1>Interfaceinformationen</h1>
1) Wird nur bei einigen Sponsorennetzwerken gebraucht<br>
<br>
2) Hier bitte deinen Verdienst in Prozent angeben, bitte berücksichtige auch Refverdienste<br>
<br>
3) Wie hoch soll die Kampagne beim Anbieter vergütet sein!<br>
<br>
4) Wieviel Restklicks muss eine Kampagne noch haben!<br>
<br>
5) Umrechnungskurs Sponsor zu Intern<br>
<br>
6) Wielange muss der User warten bis er vergütet wird?<br>
<%/block%>