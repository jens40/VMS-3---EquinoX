<%if $surf4%>
<html>
<head>
<title><%$seitenname%> - Surfbar</title>
<script type='text/javascript'>
	function Weiterleitung()
	{
	   location.href='<%$weiterleitung%>';
	}
	window.setTimeout('Weiterleitung()', 1000*<%$wartezeit%>);
</script>
</head>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="./themes/default/style.css">
<BODY bgcolor='#DBE7E8' TOPMARGIN='0' LEFTMARGIN='0' MARGINWIDTH='0' MARGINHEIGHT='0'>
	<table class="tI" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td width='100%' class='texte' align='left' TOPMARGIN='0' LEFTMARGIN='0' MARGINWIDTH='0' MARGINHEIGHT='0'>
				<span style="position:absolute; top:9; left:5px;">
				<img src="./themes/default/images/progressbar.gif" border="0">
				</span>
				<span style="position:absolute; top:2; left:75px;">
				[&raquo;<%$vg%> in <font color='#008000'><%$wartezeit%></font> Sekunden&laquo;]&nbsp;
				[&raquo;<%$seitenanzahl%>&laquo;]&nbsp;[&raquo;<a href="<%$tseite%>" target="_blank">Aktuelle Seite in neuem Fenster öffnen</a>&laquo;]
				</span>
				<span style="position:absolute; top:18; left:75px;">
				[&raquo;<font color='#CC0000'><%$hinweis%></font>&laquo;]
				</span>
			</td>
		</tr>
	</table>
	<SCRIPT LANGUAGE='JavaScript'>
		parent.werbung.location.href = "<%$tseite%>";
	</script>
</BODY>
</html>
<%else%>
<html>
<head>
<title><%$seitenname%> - Surfbar</title>
<meta http-equiv="refresh" content="900;url=index.php?content=cash/surf">
</head>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="./themes/default/style.css">
<BODY bgcolor='#DBE7E8' TOPMARGIN='0' LEFTMARGIN='0' MARGINWIDTH='0' MARGINHEIGHT='0'>
	<table class="tI" width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td width='100%' class='texte' align='left' TOPMARGIN='0' LEFTMARGIN='0' MARGINWIDTH='0' MARGINHEIGHT='0'>
				<span style="position:absolute; top:9; left:5px;">
				<img src="./themes/default/images/progressbar.gif" border="0">
				</span>
				<span style="position:absolute; top:2; left:75px;">
				[&raquo;Neustart in 15 Minuten&laquo;]&nbsp;
				[&raquo;<font color='#CC0000'>Surfbar beendet!</font>&laquo;]
				</span>
				<span style="position:absolute; top:18; left:75px;">
				[&raquo;<font color='#CC0000'><%$hinweis%></font>&laquo;]
				</span>
			</td>
		</tr>
	</table>
	<SCRIPT LANGUAGE='JavaScript'>
		parent.werbung.location.href = "<%$ende%>";
	</script>
</BODY>
</html>
<%/if%>