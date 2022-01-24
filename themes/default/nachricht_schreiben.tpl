<%extends file="index.tpl"%>
<%block name="content" prepend%>
	<h1>Nachrichten: Schreiben</h1>
<center><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='400' id='AutoNumber1'>
<form method="POST" action="">
    <tr>
      
      <td width='60%' height='25' colspan='4'>
      <p align='center'><font face='Arial' style='font-size: 9pt'><b><?=$anzahl;?> Ungelesene 
      Nachrichten</b></font></td>
      
    </tr>
<hr size="1" width="100%" color="#ffffff">
    <tr>
      <td width='30%' ><font face='Arial' style='font-size: 9pt'><b>
      Datum</b></font></td>
      <td width='40%' ><font face='Arial' style='font-size: 9pt'><b>
      Betreff</b></font></td>
      <td width='20%' ><font face='Arial' style='font-size: 9pt'><b>
      Absender</b></font></td>
       <td width='10%' >&nbsp;</td>
    </tr>
<?
$query	= db_query("SELECT id,absender,betreff,time,text from ".$db_prefix."_nachrichten where empfaenger='".$nick['nickname']."' and gelesen='0' order by time desc limit 0,9999");

while ($bd = mysql_fetch_array($query)){
$datum=date("d. n. Y  H:i", $bd[time]);
$betreff=$bd[betreff];
$absender=$bd[absender];

?>
    <tr>
      <td width='30%'><font face='Arial' style='font-size: 9pt'><?=$datum;?></font></td>
      <td width='40%' > <font face='Arial' style='font-size: 9pt'><a href='?content=/konto/nachrichtungelesen&empfaenger=<?=$nick['nickname'];?>&nid=<?=$bd[id];?>'><?=$betreff;?></a></font></td>
      <td width='20%'><font face='Arial' style='font-size: 9pt'><?=$absender;?></font></td>
      <td align='center' width='10%'><font face='Arial' style='font-size: 9pt'>&nbsp;<input type="checkbox" name="id[]" value="<?=$bd[id];?>"></font></td>
    </tr>
<?

}

?>
    <tr>
      <td width='40%'colspan='2'><a href='?content=/konto/nachrichten&action=deleteall&read=0'><b>Alle Löschen</b></a></td>
      <td width='20%'>&nbsp;</td>
      <td width='20%'><input  type='submit'  value='markierte Löschen' name='delete'></td>
    </tr>
</form>
</table><p><p>

<?
foot();
head("gelesene NACHRICHTEN");
$select = db_query("select * from ".$db_prefix."_nachrichten where empfaenger='".$nick['nickname']."' and gelesen='1'");
$anzahl = mysql_num_rows($select);

?>

 <center> <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='400' id='AutoNumber1'>
<form method="POST" action="">
    <tr>
      
      <td width='60%'colspan='4'>
      <p align='center'><font face='Arial' style='font-size: 9pt'><b><?=$anzahl;?> Gelesene
      Nachrichten</b></font></td>
     
    </tr>
<hr size="1" width="100%" color="#ffffff">
    <tr>
      <td width='30%'><font face='Arial' style='font-size: 9pt'><b>
      Datum</b></font></td>
      <td width='40%'><font face='Arial' style='font-size: 9pt'><b>
      Betreff</b></font></td>
      <td width='20%'><font face='Arial' style='font-size: 9pt'><b>
      Absender</b></font></td>
      <td width='10%'>&nbsp;</td>
    </tr>
<?
$query1	= db_query("SELECT id,absender,betreff,time,text from ".$db_prefix."_nachrichten where empfaenger='".$nick['nickname']."' and gelesen='1' order by time desc limit 0,9999");

while ($bd = mysql_fetch_array($query1)){
$datum=date("d. n. Y  H:i", $bd[time]);
$betreff=$bd[betreff];
$absender=$bd[absender];
?>
 <tr>
      <td width='30%' height='18'><font face='Arial' style='font-size: 9pt'><?=$datum;?></font></td>
      <td width='40%'> <font face='Arial' style='font-size: 9pt'><a href='?content=/konto/nachrichtungelesen&empfaenger=<?=$nick['nickname'];?>&nid=<?=$bd[id];?>'><?=$betreff;?></a></font></td>
      <td width='20%'><font face='Arial' style='font-size: 9pt'><?=$absender;?></font></td>
      <td width='10%' align='center'><font face='Arial' style='font-size: 9pt'>&nbsp;<input type="checkbox" name="id[]" value="<?=$bd[id];?>"></font></td>
    </tr>
<?
}

?>
    <tr>
      <td width='40%' height='25' colspan='2'><a href='?content=/konto/nachrichten&action=deleteall&read=1'><b>Alle Löschen</b></a></td>
      <td width='20%' height='25'>&nbsp;</td>
      <td width='20%' height='25'><input type='submit' value='markierte Löschen' name='delete'></td>
    </tr>
</form>
</table><p><p>

<?
foot();
head("Ueberwachung");
$select = db_query("select * from ".$db_prefix."_nachrichten where absender='".$nick['nickname']."' and gelesen='0'");
$anzahl = mysql_num_rows($select);

?>
<div align='center'>
  <center>
  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='400' id='AutoNumber1'>
<form method="POST" action="">    
<tr>
      <td width='60%'colspan='4'>
      <p align='center'><font face='Arial' style='font-size: 9pt'><b><?= $anzahl;?> Nachrichten werden überwacht</b></font></td>
    </tr>
<hr size="1" width="100%" color="#ffffff">
    <tr>
      <td width='30%'><font face='Arial' style='font-size: 9pt'><b>
      Datum</b></font></td>
      <td width='40%'><font face='Arial' style='font-size: 9pt'><b>
      Betreff</b></font></td>
      <td width='20%'><font face='Arial' style='font-size: 9pt'><b>
       Empfänger</b></font></td>
        <td width='10%'>&nbsp;</td>
    </tr>
<?

$query2	= db_query("SELECT id,absender,empfaenger,betreff,time,text from ".$db_prefix."_nachrichten where absender='".$nick['nickname']."' and gelesen='0' order by time desc limit 0,9999");

while ($bd = mysql_fetch_array($query2)){
$datum=date("d. n. Y  H:i", $bd[time]);
$betreff=$bd[betreff];
$empfaenger=$bd[empfaenger];

?>
  <tr>
      <td width='30%'><font face='Arial' style='font-size: 9pt'><?= $datum;?></font></td>
      <td width='40%'> <font face='Arial' style='font-size: 9pt'><?= $betreff;?></font></td>
      <td width='20%'><font face='Arial' style='font-size: 9pt'><?= $empfaenger;?></font></td>
      <td width='10%' align='center'><font face='Arial' style='font-size: 9pt'>&nbsp;<input type="checkbox" name="id[]" value="<?=$bd[id];?>"></font></td>
   
    </tr>
<?
}
?>
 <tr>
      <td width='40%' height='25' colspan='2'><a href='?content=/konto/nachrichten&action=delete2all&read=0'><b>Alle Löschen</b></a></td>
       <td width='20%' height='25'>&nbsp;</td>
      <td width='20%' height='25'><input type='submit' value='markierte Löschen' name='delete2'></td>
    </tr>
</form>
</table><p>
<br><font face='Arial' style='font-size: 12pt'><b><a class='menuelinks' href='?content=/konto/nachrichtsenden'>Nachricht schreiben</a></b><p>


<%/block%>