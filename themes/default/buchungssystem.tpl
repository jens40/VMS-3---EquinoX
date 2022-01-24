<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Ein.- und Auszahlungsfunktionen</h1>
<br>
<script type="text/javascript">
<!--
 function kontoausgabe() {
 	if (document.buchen.kontoart.value == "klamm_1") document.getElementById("knt_art").value = '<%$userdaten_klamm_id%>>';
	if (document.buchen.kontoart.value == "klamm_0") document.getElementById("knt_art").value = '<%$userdaten_klamm_id%>';
	if (document.buchen.kontoart.value == "fuco_1") document.getElementById("knt_art").value = '<%$userdaten_fuco_id%>';
	if (document.buchen.kontoart.value == "fuco_0") document.getElementById("knt_art").value = '<%$userdaten_fuco_id%>';
	if (document.buchen.kontoart.value == "nickey_1") document.getElementById("knt_art").value = '<%$userdaten_nickey_id%>';
	if (document.buchen.kontoart.value == "nickey_0") document.getElementById("knt_art").value = '<%$userdaten_nickey_id%>';
	if (document.buchen.kontoart.value == "downies_1") document.getElementById("knt_art").value = '<%$userdaten_downie_id%>';
	if (document.buchen.kontoart.value == "downies_0") document.getElementById("knt_art").value = '<%$userdaten_downie_id%>';
	if (document.buchen.kontoart.value == "konto_0") document.getElementById("knt_art").value = '<%$userdaten_kreditinstitut%> (<%$userdaten_kontonummer%>)';
	if (document.buchen.kontoart.value == "paypal_0") document.getElementById("knt_art").value = '<%$userdaten_paypal%>';
	if (document.buchen.kontoart.value == "moneybookers_0") document.getElementById("knt_art").value = '<%$userdaten_moneybookers%>';
}
//-->
</script>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form id="konto" action="" method="post" name="buchen">
<tr>
<td width="250"><b>Buchungsart:</b></td>
<td align="left">
<select name="kontoart" size="1" onChange="kontoausgabe()" style="width:250px;">
<option value="">Bitte die Buchungsart wählen!&nbsp;&nbsp;&nbsp;&nbsp;
<option value="">----------------------------
<%if $userdaten_klamm_id != 0 && $klamm == 1 && $kurs_klamm > 0.00%>
<option value="klamm_1">Klammlose (Einzahlen)
<option value="klamm_0">Klammlose (Auszahlen)
<%/if%>

<%if $userdaten_fuco_id != 0 && $funcoins == 1 && $kurs_funcoins > 0.00%>
<option value="fuco_1">Funcoins (Einzahlen)
<option value="fuco_0">Funcoins (Auszahlen)
<%/if%>

<%if $userdaten_nickey_id != 0 && $nickey == 1 && $kurs_nickey > 0.00%>
<option value="nickey_1">Nickeys (Einzahlen)
<option value="nickey_0">Nickeys (Auszahlen)
<%/if%>

<%if $userdaten_kreditinstitut && $bank == 1 && $kurs_euro > 0.00%><option value="konto_0">Bankkonto (Auszahlung anfordern)<%/if%>
<%if $userdaten_paypal && $paypal == 1 && $kurs_euro > 0.00%><option value="paypal_0">Paypal (Auszahlung anfordern)<%/if%>
<%if $userdaten_moneybookers && $moneybookers == 1 && $kurs_euro > 0.00%><option value="moneybookers_0">Moneybookers (Auszahlung anfordern)<%/if%>
</select>
</td>
</tr>
<tr>
<td width="250"><b>Buchungskonto:</b></td>
<td><input name="knt" type="text" id="knt_art" readonly style="width:250px;"></td>
</tr>
<tr>
<td><b>Transfersumme*:</b></td>
<td><input type="text" name="transsumme" id="knt_summe" maxlength="100" size="30" value="" style="width:250px;"></td>
</tr>
<tr>
<td><b>Transfer-Passwort**:</b></td>
<td><input type="password" name="transpasswort" id="knt_pass" maxlength="100" size="30" value="" style="width:250px;"></td>
</tr>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="buchen">
<input type="Submit" name="buchen" value="Buchung durchführen">
</td>
</tr>
</form>
</table>
<br>
<sup>* Die Transfersumme muss nicht bei einer Euroauszahlung angegeben werden, bei Euroauszahlung wird immer das GANZE Guthaben zur Auszahlung bereitgestellt!<br>
<br>
** Das Tranfer-Passwort wird nur benötigt wen eine Einzahlung od. Auszahlung von Klamm.de, FunCoins.de, Nickeys.de od. Downies.de geschehen soll. Dafür wird das jeweilige Passwort des
Anbieter benötigt (Losepasswort, Downiespasswort usw.)</sup>
<br>
<%if $ueberweisung == 1%>
<br>
<h1>Überweisungsfunktion</h1>
<%$message%>
<br>
<table border="0" cellpadding="1" cellspacing="1" width="100%">
<form id="ukonto" action="" method="post" name="ueberweisen">
<tr>
<td><b>Empfängernick:</b></td>
<td><input type="text" name="empfaenger" maxlength="100" size="30" value="" style="width:250px;"></td>
</tr>
<tr>
<td><b>Transfersumme*:</b></td>
<td><input type="text" name="transsumme" maxlength="100" size="30" value="" style="width:250px;"></td>
</tr>
<tr>
<td><b>Transfer-Passwort**:</b></td>
<td><input type="password" name="transpasswort" maxlength="100" size="30" value="" style="width:250px;"></td>
</tr>
<tr>
<td colspan="2" align="center"><br>
<input type="hidden" name="do" value="ueberweisen">
<input type="Submit" name="ueberweisen" value="Überweisung durchführen">
</td>
</tr>
</form>
</table>
<br>
<sup>* <font color="#cc0000">Die Mindesttransfersummer beträgt <%$ueberweisungssumme|number_format:0%> <%$waehrungsname%></font><br>
<br>
** Transfer-Passwort = Loginpasswort</sup>
<br>
<%/if%>
<%/block%>