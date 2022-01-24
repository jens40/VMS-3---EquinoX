<%extends file="index.tpl"%>
<%block name="content" prepend%>
<h1>Betteln auf <?=$mainconfig['seitenname'];?></h1>
<br>
<%if $b_text%>
<div align="center"><%$b_text%></div><br>
<%/if%>

<%/block%>