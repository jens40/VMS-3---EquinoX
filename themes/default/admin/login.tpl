<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//DE">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
	<title>Adminbereich</title>
	<link href="./themes/default/admin/css/style.css" rel="stylesheet">
</head>
<body bgcolor="#f0f0f0">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td width="100%" height="100%" align="center" valign="middle">

<table cellpadding="0" cellspacing="1" border="0" bgcolor="#000000" width="400">
<tr bgcolor="#c0c0c0">
<form action="admin.php" method="post">
<td align="center" valign="middle">
<br>
<b>Adminbereich von <%$seitenname%></b><br>
<br>
<img src="./themes/default/admin/images/key.gif" width="131" height="155" border="0" alt="" align="left">
<br><br><br>
Adminlogin <input type="Text" name="a_login" value="" style="background-color:#f0f0f0;border-color:#000000;"><br>
<br>
Adminpass <input type="Password" name="a_passwort" value="" style="background-color:#f0f0f0;border-color:#000000;"><br>
<br>
<input type="Submit" name="adminlogin" value="Als Administrator einloggen" style="background-color:#f0f0f0;border-color:#000000;"><br>
<br><div align="center"><%$message%></div><br><br>
</td>
</form>
</tr>
</table>

</td>
</tr>
</table>