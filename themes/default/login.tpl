<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Userlogin</h1>
           <table border="0" cellpadding="1" cellspacing="1" width="100%">
		   <form action="" method="post" name="login">
			 <tr>
			  <td><b>Benutzername (Login):</b></td>
			  <td><input type="text" name="username" maxlength="25" size="25" value="<%$username%>"></td>
			 </tr>
			 <tr>
			  <td><b>Passwort (Login):</b></td>
			  <td><input type="password" name="passwort" maxlength="25" size="25" value=""></td>
			 </tr>
			<tr>
			  <td><b>Länge der Loginzeit?</b></td>
			  <td>
			  <select name="login_laenge" size="1">
			  <option value="0">Nur während dieser Sitzung
			  <option value="1">60 Minuten eingeloggt bleiben
			  <option value="24">24 Stunden eingeloggt bleiben
			  <option value="168">7-Tage eingeloggt bleiben
			  <option value="672" selected>28-Tage eingeloggt bleiben
			  </select>
			  </td>
			 </tr>
			  <tr>
			  <td colspan="2" align="center"><br><input type="Submit" name="login" value="Einloggen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Reset" value="Formulardaten löschen"></td>
			 </tr>
			 </form>
			</table>

<br>
<h1>Datenanfordern</h1>
Sollten Sie ihre Logindaten vergessen haben oder den Aktivierungslink nicht erhalten haben, dann tragen Sie hier ihre E-Mailadresse ein.<br>
<br>
Wir werden dann ihre Logindaten per E-Mail an sie senden, wenn Sie ihren Account noch nicht freigeschaltet haben sollten,
dann senden wir ihnen den Aktivierungslink erneut zu.<br>
<br><div align="center">
<%$message%>
<form action="" method="post" name="daten">
E-Mail: <input type="Text" name="email" value="" style="width:250px;">
<input type="Submit" name="datena" value="Datenanfordern">
</form></div>
<i>Bitte überprüfen Sie auch den Spamordner bei ihrem E-Mailaccount!</i>
<%/block%>