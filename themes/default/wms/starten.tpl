<%extends file="../index.tpl"%>
<%block name="content" prepend%>
<h1>Neues Programm starten - Werbeart wählen</h1>
<table width="100%" cellpadding="1" cellspacing="1" border="0" bgcolor="<?=$color['rand'];?>" align="center">
<tr bgcolor="#F7BF63">
<td align="center"><b>Werbeart</b></td>
<td align="center"><b>Min. Preis</b></td>
<td align="center"><b>Min. Buchen</b></td>
<td align="center"><b>Aufendhalt</b></td>
<td align="center"><b>Reload</b></td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=forcedbanner" target="_self" class="menue">Forcedklicks</a></td>
<td align="right"><%$forcedbanner_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$forcedbanner_preis%> Klicks&nbsp;</td>
<td align="center">0 - 60 Sekunden</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FCEED5">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=bannerviews" target="_self" class="menue">Bannerviews</a></td>
<td align="right"><%$bannerviews_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$bannerviews_preis%> Views&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=bannerklicks" target="_self" class="menue">Bannerklicks</a></td>
<td align="right"><%$bannerklicks_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$bannerklicks_preis%> Klicks&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FCEED5">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=buttonviews" target="_self" class="menue">Buttonviews</a></td>
<td align="right"><%$buttonviews_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$buttonviews_preis%> Views&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=buttonklicks" target="_self" class="menue">Buttonklicks</a></td>
<td align="right"><%$buttonklicks_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$buttonklicks_preis%> Klicks&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FCEED5">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=surfbarviews" target="_self" class="menue">Surfbarviews</a></td>
<td align="right"><%$surfbarviews_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$surfbarviews_preis%> Views&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=surfbarklicks" target="_self" class="menue">Surfbarklicks</a></td>
<td align="right"><%$surfbarklicks_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$surfbarklicks_preis%> Klicks&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FCEED5">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=textlinkviews" target="_self" class="menue">Textlinkviews</a></td>
<td align="right"><%$textlinkviews_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$textlinkviews_preis%> Views&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>
<tr bgcolor="#FDF5E7">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=textlinkklicks" target="_self" class="menue">Textlinkklicks</a></td>
<td align="right"><%$textlinkklicks_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$textlinkklicks_preis%> Klicks&nbsp;</td>
<td align="center">nicht möglich</td>
<td align="center">1 - 24 Stunden</td>
</tr>

<tr bgcolor="#FCEED5">
<td align="left"><a href="index.php?content=wms/starten&get_werbeart=paidmails" target="_self" class="menue">Paidmails</a></td>
<td align="right"><%$paidmails_minbuchung%> <%$waehrungsname%>&nbsp;</td>
<td align="right"><%$paidmails_preis%> Mails&nbsp;</td>
<td align="center">0 - 60 Sekunden</td>
<td align="center">Standard 24 Std.</td>
</tr>
</table>
<%/block%>