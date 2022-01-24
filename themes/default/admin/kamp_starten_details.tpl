<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
		<%if $kamp_start%>
		<h1>Neues Programm gestartet</h1>
		Dein neues Programm wurde eingebucht und gestartet.<br>
		<br>
		<%/if%>			
            <h1>Neues Programm starten - Details</h1>
			<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center">
			<form action="" method="post">
			<input type="Hidden" name="k_werbeform" value="<%$k_werbeform%>">
			<input type="Hidden" name="k_name" value="<%$k_name%>">
			<input type="Hidden" name="k_info" value="<%$k_info%>">
			<input type="Hidden" name="k_verguetung" value="<%$k_verguetung%>">
			<input type="Hidden" name="k_aufendhalt" value="<%$k_aufendhalt%>">
			<input type="Hidden" name="k_menge" value="<%$k_menge%>">
			<input type="Hidden" name="k_reloadzeit" value="<%$k_reloadzeit%>">
			<input type="Hidden" name="k_ziel" value="<%$k_ziel%>">
			<input type="Hidden" name="k_werbemittel" value="<%$k_werbemittel%>">
			<input type="Hidden" name="do" value="send_kampstart">
			<tr><td width="20%" align="left" valign="top"><b>Werbeart:</b></td><td width="80%" align="left" valign="top"><%$werbename%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Kampagnenname:</b></td><td width="80%" align="left" valign="top"><%$k_name%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Kampagneninfo:</b></td><td width="80%" align="left" valign="top"><%$k_info%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Vergütung:</b></td><td width="80%" align="left" valign="top"><%$k_verguetung * $aufendhaltspreis[$k_aufendhalt]|number_format:2%> <%$waehrungsname%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Aufendhalt:</b></td><td width="80%" align="left" valign="top"><%$k_aufendhalt%> Sekunden</td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Reloadzeit:</b></td><td width="80%" align="left" valign="top"><%$k_reloadzeit%> Stunden</td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Menge:</b></td><td width="80%" align="left" valign="top"><%$k_menge|number_format:0%> <%$werbename%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Gesamtkosten:</b></td><td width="80%" align="left" valign="top"><%$zwischensumme * $gebuehr['betreiber']|number_format:2%> <%$waehrungsname%></td></tr>
			<tr><td width="20%" align="left" valign="top"><b>Zieladresse:</b></td><td width="80%" align="left" valign="top"><%$k_ziel%></td></tr>
			<%if $k_werbeform == "paidmails"%>
			<tr><td width="20%" align="left" valign="top"><b>Mailtext:</b></td><td width="80%" align="left" valign="top"><textarea rows="16" style="width:80%;" readonly><%$k_werbemittel%></textarea></td></tr></table>
			<%else%>
			<%if $k_werbeform == 'textlinkviews' or $k_werbeform == 'textlinkklicks'%>
			<tr><td width="20%" align="left" valign="top"><b>Werbetext:</b></td><td width="80%" align="left" valign="top"><%$k_werbemittel%></td></tr></table>
			<%else%>
			<%if $bannerpixel != 28080 and $bannerpixel != 2728%>
			<tr><td width="20%" align="left" valign="top"><b>Banner:</b></td><td width="80%" align="left" valign="top"><b><i>Ungültiges Bannerformat</i></b></td></tr></table>
			<%else%>
			<tr><td width="20%" align="left" valign="top"><b>Banner:</b></td><td width="80%" align="left" valign="top"><img src="<%$k_werbemittel%>" border="0" alt="Ihr Werbebanner"></td></tr></table>
					<%/if%>
				<%/if%>
			<%/if%>
				<%if !$kamp_start%>
				<br>
				<div align="center">
				<font color="#cc0000"><b>Mit dem starten der Kampagne versichere ich,<br>das die beworbene Webseite KEIN Framebrecher hat!</b></font>
				<br>
				<br>
				<input type="Submit" name="s_kampagne" value="Kampagne starten!"><br><br><b>Nur einmal klicken!</b>
				</div>
				</form>
            <%/if%>
<%/block%>