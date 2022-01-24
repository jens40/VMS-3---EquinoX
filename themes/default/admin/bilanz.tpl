<%extends file="admin/index.tpl"%>
<%block name="content" prepend%>
<h1>Bilanz (letzte 10 Tage)</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c0c0c0">
 <tr bgcolor="#f0f0f0">
  <td align="center"><b>Datum</b></td>
  <td align="center"><b>Einnahmen</b></td>
  <td align="center"><b>Ausgaben</b></td>
  <td align="center"><b>Bilanz</b></td>
 </tr>
<%section name=x loop=$bilanz_outs%>	
 <tr bgcolor="#f5f5f5">
  <td align="center"><%$bilanz_outs[x].tag%>.<%$bilanz_outs[x].monat%>.<%$bilanz_outs[x].jahr%>&nbsp;</td>
  <td align="right"><font color="#0000FF"><%$bilanz_outs[x].einnahmen%></font>&nbsp;</td>
  <td align="right"><font color="#FF0000"><%$bilanz_outs[x].ausgaben%></font>&nbsp;</td>
  <td align="right"><%$bilanz_outs[x].bilanz%>&nbsp;</td>
 </tr>
<%/section%>
</table>


<h1>Bilanz (Monate)</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c0c0c0">
 <tr bgcolor="#f0f0f0">
  <td align="center"><b>Zeitraum</b></td>
  <td align="center"><b>Einnahmen</b></td>
  <td align="center"><b>Ausgaben</b></td>
  <td align="center"><b>Bilanz</b></td>
 </tr>
<%section name=x loop=$bilanz1_outs%>	
 <tr bgcolor="#f5f5f5">
  <td align="center"><%$bilanz1_outs[x].jahr%>.<%$bilanz1_outs[x].monat%>&nbsp;</td>
  <td align="right"><font color="#0000FF"><%$bilanz1_outs[x].rein%></font>&nbsp;</td>
  <td align="right"><font color="#FF0000"><%$bilanz1_outs[x].raus%></font>&nbsp;</td>
  <td align="right"><%$bilanz1_outs[x].bilanz%>&nbsp;</td>
 </tr>
<%/section%>
</table>


<h1>Bilanz (Jahre)</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c0c0c0">
 <tr bgcolor="#f0f0f0">
  <td align="center"><b>Zeitraum</b></td>
  <td align="center"><b>Einnahmen</b></td>
  <td align="center"><b>Ausgaben</b></td>
  <td align="center"><b>Bilanz</b></td>
 </tr>
<%section name=x loop=$bilanz2_outs%>	
 <tr bgcolor="#f5f5f5">
  <td align="center"><%$bilanz2_outs[x].jahr%>&nbsp;</td>
  <td align="right"><font color="#0000FF"><%$bilanz2_outs[x].rein%></font>&nbsp;</td>
  <td align="right"><font color="#FF0000"><%$bilanz2_outs[x].raus%></font>&nbsp;</td>
  <td align="right"><%$bilanz2_outs[x].bilanz%>&nbsp;</td>
 </tr>
<%/section%>
</table>

<h1>Bilanz (Wochentage)</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#c0c0c0">
 <tr bgcolor="#f0f0f0">
  <td align="center"><b>Wochentag</b></td>
  <td align="center"><b>Einnahmen</b></td>
  <td align="center"><b>Ausgaben</b></td>
  <td align="center"><b>Bilanz</b></td>
 </tr>
<%section name=x loop=$bilanz3_outs%>	
 <tr bgcolor="#f5f5f5">
  <td align="center"><%$bilanz3_outs[x].wtag%>&nbsp;</td>
  <td align="right"><font color="#0000FF"><%$bilanz3_outs[x].rein%></font>&nbsp;</td>
  <td align="right"><font color="#FF0000"><%$bilanz3_outs[x].raus%></font>&nbsp;</td>
  <td align="right"><%$bilanz3_outs[x].bilanz%>&nbsp;</td>
 </tr>
<%/section%>
</table>
<%/block%>