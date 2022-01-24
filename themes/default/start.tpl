<%extends file="index.tpl"%>
<%block name="content" prepend%>


<h1>Willkommen bei <%$seitenname%></h1>

<br>
<h1>Unsere News...</h1>
<%section name=x loop=$news_out%>
<%$news_out[x].titel%>
<b><%$news_out[x].titel%> vom <%$news_out[x].zeit%></b><br>
<%$news_out[x].news%><br>
<%/section%>
<?=load_textlink(3);?>
<h1>Verdienst auf ganzer Line</h1>

<%include file="showralley.tpl"%>

<br>
<%/block%>