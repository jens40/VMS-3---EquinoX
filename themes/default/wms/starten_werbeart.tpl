<%extends file="../index.tpl"%>
<%block name="content" prepend%>
<h1>Neues Programm starten - <%$werbename%></h1>
<script type="text/javascript">
function Endpreis() {
betreiber			= <%$betreiber%>;
grundpreis			= <%$grundpreis_k_werbeform%>;
minsumme			= <%$minbuchung%>;
verguetung			= Math.floor(document.starten.k_verguetung.value.replace(",",".")* 100) / 100;
menge				= Math.floor(document.starten.k_menge.value);
if (verguetung < grundpreis) {
verguetung			= grundpreis;
}
aufendanzeige		= Math.floor((verguetung * aufendhalt - verguetung)* 100) / 100;
zwischensumme1		= Math.floor((verguetung * aufendhalt * menge)* 100) / 100;
zwischensumme2		= Math.floor((zwischensumme1 * reloadzeit)* 100) / 100;
reloadpreis			= Math.floor((zwischensumme1 * reloadzeit - zwischensumme1)* 100) / 100;
betreibergebuehr	= Math.floor((zwischensumme2 * betreiber - zwischensumme2)* 100) / 100;
endpreis			= Math.floor((zwischensumme2 * betreiber)* 100) / 100;
anzahl				= Math.floor(minsumme / verguetung);
// Ausgabe
document.getElementById("k_menge").innerHTML = menge;
document.getElementById("k_verguetung").innerHTML = verguetung.toFixed(2).replace(".",",");
document.getElementById("k_aufendhalt").innerHTML = aufendanzeige.toFixed(2).replace(".",",");
document.getElementById("k_reloadzeit").innerHTML = reloadpreis.toFixed(2).replace(".",",");
document.getElementById("k_betreibergebuehr").innerHTML = betreibergebuehr.toFixed(2).replace(".",",");
document.getElementById("k_zwischensumme1").innerHTML = zwischensumme1.toFixed(2).replace(".",",");
document.getElementById("k_zwischensumme2").innerHTML = zwischensumme2.toFixed(2).replace(".",",");
document.getElementById("k_endpreis").innerHTML = endpreis.toFixed(2).replace(".",",");
document.getElementById("k_grundpreis").innerHTML = grundpreis.toFixed(2).replace(".",",");
document.getElementById("k_anzahl").innerHTML = anzahl;
}

function base_a(wert_a) {
aufendhalt = wert_a;
Endpreis();
}

function base_r(wert_r) {
reloadzeit = wert_r;
Endpreis();
}

function base_start() {
<%if !$send_kampstart%>
aufendhalt = 1;
reloadzeit = 1;
Endpreis();
<%else%>
aufendhalt = <%$aufendhaltsk_aufendhalt%>;
reloadzeit = <%$grundpreis_k_reloadzeit%>;
Endpreis();
<%/if%>
}
</script>
<form action="" method="post" name="starten">
<input type="Hidden" name="k_werbeform" value="<%$k_werbeform%>">
<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center" bgcolor="#000000">
<%$message%>
<tr bgcolor="#F7BF63">
<td width="100%" align="left" valign="top" colspan="2"><b>Aktuelle Rechnung</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top">

<table cellpadding="1" cellspacing="1" border="0" align="left">
<tr>
<td align="left">Grundvergütung</td><td align="right"><font id="k_verguetung"></font></td><td align="left"><%$waehrungsname%></td>
</tr>
<tr>
<td align="left">zzgl. Aufenthalt</td><td align="right"><font id="k_aufendhalt"></font></td><td align="left"><%$waehrungsname%></td>
</tr>
<tr>
<td align="left">mal Menge</td><td align="right"><font id="k_menge"></font></td><td align="left"></td>
</tr>
<tr>
<td align="left" colspan="3" bgcolor="#000000"></td>
</tr>
<tr>
<td align="left">Zwischensumme I</td><td align="right"><font id="k_zwischensumme1"></font></td><td align="left"><%$waehrungsname%></td>
</tr>

<tr>
<td align="left">zzgl. Reloadzeit</td><td align="right"><font id="k_reloadzeit"></font></td><td align="left"><%$waehrungsname%></td>
</tr>

<tr>
<td align="left" colspan="3" bgcolor="#000000"></td>
</tr>
<tr>
<td align="left">Zwischensumme II</td><td align="right"><font id="k_zwischensumme2"></font></td><td align="left"><%$waehrungsname%></td>
</tr>
<tr>
<td align="left">zzgl. Betreibergebühr&nbsp;&nbsp;&nbsp;</td><td align="right"><font id="k_betreibergebuehr"></font></td><td align="left"><%$waehrungsname%></td>
</tr>
<tr>
<td align="left" colspan="3" bgcolor="#000000"></td>
</tr>
<tr>
<td align="left" colspan="3" bgcolor="#000000"></td>
</tr>
<tr>
<td align="left">Endpreis (gerundet)</td><td align="right"><font id="k_endpreis"></font></td><td align="left"><%$waehrungsname%></td>
</tr>
</table>

</td>

<td width="50%" align="left" valign="top">
Die nebenstehende Berechnung kann vom Endpreis abweichen, alle Werte werden auf 2-Stellen nach dem Komma gerundet.
Dadurch ist es möglich das es eine Diverenz von +/- 2 <%$waehrungsname%> ergeben kann.<br>
<br>
<div align="center"><b>Immer alle Felder ausfüllen!</b></div><br>
<br>
<div align="center">
<input type="Hidden" name="do" value="send_kampstart">
<input type="Submit" name="send_kampstart" value="Weiter zur Prüfung!">
</div>
</td>

</tr>
</table>
<br>
<table width="100%" cellpadding="1" cellspacing="1" border="0" align="center" bgcolor="#000000">
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>Kampagnenname (max. 50 Zeichen)</b></td>
<td width="50%" align="left" valign="top"><b>Zusatzinformationen (max. 50 Zeichen)</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_name" style="width:80%;overflow : hidden;" wrap=virtual><%$k_name%></textarea></td>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_info" style="width:80%;overflow : hidden;" wrap=virtual><%$k_info%></textarea></td>
</tr>
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
Vergütung
<%else%>
Festpreis
<%/if%>
</b></td>
<td width="50%" align="left" valign="top"><b>Menge</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top">
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
<input type="Text" name="k_verguetung" value="<%$k_verguetung%>" style="width:35%" onChange="Endpreis()"> (min. <font id="k_grundpreis"></font>&nbsp;<%$waehrungsname%>)
<%else%>
<input type="Text" name="k_verguetung" value="<%$k_verguetung%>" style="width:35%" readonly> Festpreis <font id="k_grundpreis"></font>&nbsp;<%$waehrungsname%>
<%/if%>
</td>
<td width="50%" align="left" valign="top"><input type="Text" name="k_menge" value="<%$k_menge%>" style="width:35%" onChange="Endpreis()"> (min. <font id="k_anzahl"></font>)</td>
</tr>
<tr bgcolor="#F7BF63">
<%if $k_werbeform == 'paidmails'%>
<td width="50%" align="left" valign="top" colspan="2"><b>Ziel-URL</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Ziel-URL</b></td>
<%if $k_werbeform == 'textlinkviews' or $k_werbeform == 'textlinkklicks'%>
<td width="50%" align="left" valign="top"><b>Werbetext</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Banner-URL</b></td>
<%/if%>
<%/if%>
</tr>
<tr bgcolor="#FDF5E7">
<%if $k_werbeform == 'paidmails'%>
<td width="100%" align="left" valign="top" colspan="2"><textarea rows="1" name="k_ziel" style="width:40%;overflow : hidden;" wrap=virtual><%$k_ziel%></textarea></td>
<%else%>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_ziel" style="width:80%;overflow : hidden;" wrap=virtual><%$k_ziel%></textarea></td>
<td width="50%" align="left" valign="top"><textarea rows="1" name="k_werbemittel" style="width:80%;overflow : hidden;" wrap=virtual><%$k_werbemittel%></textarea></td>
<%/if%>
</tr>
<tr bgcolor="#F7BF63">
<td width="50%" align="left" valign="top"><b>Bitte wähle die Aufenthaltszeit</b></td>
<%if $k_werbeform != 'paidmails'%>
<td width="50%" align="left" valign="top"><b>Bitte wähle die Reloadzeit</b></td>
<%else%>
<td width="50%" align="left" valign="top"><b>Bitte Mailtext eingeben!</b></td>
<%/if%>
</tr>
<tr bgcolor="#FDF5E7">
<td width="50%" align="left" valign="top">
<%if $k_werbeform == 'paidmails' or $k_werbeform == 'forcedbanner'%>
<table cellpadding="1" cellspacing="1" border="0" align="left">
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="0" <%if $k_aufendhalt == 0 or $k_aufendhalt == ''%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_0%>')">&nbsp;&nbsp;</td><td align="right">0 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+/-<%$aufendhaltspreis_verguetung_0%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="5" <%if $k_aufendhalt == 5%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_5%>')">&nbsp;&nbsp;</td><td align="right">5 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_5%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="10" <%if $k_aufendhalt == 10%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_10%>')">&nbsp;&nbsp;</td><td align="right">10 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_10%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="15" <%if $k_aufendhalt == 15%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_15%>')">&nbsp;&nbsp;</td><td align="right">15 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_15%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="20" <%if $k_aufendhalt == 20%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_20%>')">&nbsp;&nbsp;</td><td align="right">20 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_20%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="25" <%if $k_aufendhalt == 25%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_25%>')">&nbsp;&nbsp;</td><td align="right">25 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_25%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="30" <%if $k_aufendhalt == 30%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_30%>')">&nbsp;&nbsp;</td><td align="right">30 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_30%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="45" <%if $k_aufendhalt == 45%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_45%>')">&nbsp;&nbsp;</td><td align="right">45 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_45%>% Vergütung</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_aufendhalt" value="60" <%if $k_aufendhalt == 60%>checked<%/if%> onClick="base_a('<%$aufendhaltspreis_60%>')">&nbsp;&nbsp;</td><td align="right">60 Sekunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$aufendhaltspreis_verguetung_60%>% Vergütung</td>
</tr>
</table>
<%else%>
<div align="center"><b>Bei dieser Werbeform ('.$werbename.') kein Aufendhalt möglich!</b></div>
<input type="Hidden" name="k_aufendhalt" value="0">
<%/if%>
<td width="50%" align="left" valign="top">
<%if $k_werbeform != 'paidmails'%>
<table cellpadding="1" cellspacing="1" border="0" align="left">
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="1" <%if $k_reloadzeit == 1%>checked<%/if%> onClick="base_r('<%$reloadpreis_1%>')">&nbsp;&nbsp;</td><td align="right">1 Stunde&nbsp;&nbsp;</td><td align="right">&nbsp;&nbsp;&nbsp;<%$reloadpreis_verguetung_1%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="2" <%if $k_reloadzeit == 2%>checked<%/if%> onClick="base_r('<%$reloadpreis_2%>')">&nbsp;&nbsp;</td><td align="right">2 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;<%$reloadpreis_verguetung_2%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="4" <%if $k_reloadzeit == 4 or $k_reloadzeit == ''%>checked<%/if%> onClick="base_r('<%$reloadpreis_4%>')">&nbsp;&nbsp;</td><td align="right">4 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+/-<%$reloadpreis_verguetung_4%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="8" <%if $k_reloadzeit == 8%>checked<%/if%> onClick="base_r('<%$reloadpreis_8%>')">&nbsp;&nbsp;</td><td align="right">8 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$reloadpreis_verguetung_8%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="12" <%if $k_reloadzeit == 12%>checked<%/if%> onClick="base_r('<%$reloadpreis_12%>')">&nbsp;&nbsp;</td><td align="right">12 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$reloadpreis_verguetung_12%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="16" <%if $k_reloadzeit == 16%>checked<%/if%> onClick="base_r('<%$reloadpreis_16%>')">&nbsp;&nbsp;</td><td align="right">16 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$reloadpreis_verguetung_16%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="20" <%if $k_reloadzeit == 20%>checked<%/if%> onClick="base_r('<%$reloadpreis_20%>')">&nbsp;&nbsp;</td><td align="right">20 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$reloadpreis_verguetung_20%>% Zwischensumme</td>
</tr>
<tr>
<td align="left"><input type="radio" name="k_reloadzeit" value="24" <%if $k_reloadzeit == 24%>checked<%/if%> onClick="base_r('<%$reloadpreis_24%>')">&nbsp;&nbsp;</td><td align="right">24 Stunden</td><td align="right">&nbsp;&nbsp;&nbsp;+<%$reloadpreis_verguetung_24%>% Zwischensumme</td>
</tr>
</table>
<%else%>
<textarea rows="16" name="k_werbemittel" style="width:100%;"><%$k_werbemittel%></textarea>
<input type="Hidden" name="k_reloadzeit" value="24">
<div align="center"><b>Paidmails, 24 Stunden Reloadzeit!</b></div>
<%/if%>
</td>
</tr>
</table>
</form>
<script type="text/javascript">base_start();</script>
<%/block%>