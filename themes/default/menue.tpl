<div class="card border-secondary">
<%if !empty($smarty.session.login) && $smarty.session.login == 'true'%>
<span>Usermenü</span>
<a href="index.php?content=user/userprofil" target="_self" class="menue">Userprofil</a>
<a href="index.php?content=user/nickpage" target="_self" class="menue">Nickpage</a> 
<a href="index.php?content=user/guthabenverwaltung" target="_self" class="menue">Guthaben</a>
<a href="index.php?content=user/buchungssystem" target="_self" class="menue">Buchungssystem</a>
<a href="index.php?content=user/kontoauszug" target="_self" class="menue">Kontoauszug</a>
<a href="index.php?content=user/refcenter" target="_self" class="menue">Refcenter</a>
<a href="index.php?content=user/tresor" target="_self" class="menue">Tresor</a>

<span>Nachrichten</span>
<a href="index.php?content=user/support" target="_self" class="menue">Ticketsystem</a>
<a href="index.php?content=/user/nachrichten&gonachricht=schreiben" target="_self" class="menue">Schreiben</a>
<a href="index.php?content=/user/nachrichten&gonachricht=eingang" target="_self" class="menue"><%$neue%></a>
<a href="index.php?content=/user/nachrichten&gonachricht=ausgang" target="_self" class="menue">Ausgang</a>
<span>Verdienen</span>
<a href="index.php?content=cash/klick4" target="_self" class="menue">Forcedklicks</a>
<a href="index.php?content=cash/surf4" target="_blank" class="menue">Surfbar</a>
<a href="index.php?content=user/mailhistory" target="_self" class="menue">Mailhistory</a>
<a href="index.php?content=site/rallys" target="_self" class="menue">Unsere Rally's</a>
<span>Classic-Games</span>

<span>WMS</span>
<a href="index.php?content=wms/kamp_view" target="_self" class="menue">Übersicht</a>
<a href="index.php?content=wms/starten" target="_self" class="menue">Neubuchen</a>
<%else%>
<span>Hauptmenü</span>
<a href="index.php?content=site/anmelden" target="_self" class="menue"><b>Registrieren</b></a>
<a href="index.php?content=site/login" target="_self" class="menue"><b>Login</b></a>
<%/if%>
<span>Empfehlungen</span>
<table>
<tr>
<td>
<%$load_button_3%>
</td>
</tr>
</table>
</div>