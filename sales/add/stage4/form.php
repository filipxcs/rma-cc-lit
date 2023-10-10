<?php 
session_start();
?>
<html>
  <head>
<title>input</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
function changeFrames(url1) {
    parent._bottom1.location.href = 'input.php';
    parent._bottom2.location.href = '../../menu/blank.php';
    }
</script>
</head>
<?php 
require("../../../params.php");
require("../../../mysql.php");
$query="SELECT id,date_format(rma_date,'%d-%c-%Y')AS 'rma_date',users,pelaths,kodikos_eidous,posotita,timologio_agoras,date_format(dc,'%d-%c-%Y')AS 'dc',logos_epistrofis,kathari_aksia_pistosis,aksia_polisis,deltio_paralavis,date_format(date_paralavis,'%d-%c-%Y')AS 'date_paralavis',katastasi_proiontos,katastasi_proiontos_logos,katastasi_siskeuasias,katastasi_siskeuasias_logos,egrisi FROM sales_stage1 where  id='$_POST[rma]%' AND part='3' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
        $id=mysql_result($result,$i,"id");
	$egrisi=mysql_result($result,$i,"egrisi");
	$rma_date=mysql_result($result,$i,"rma_date");
        $users=mysql_result($result,$i,"users");
	$pelaths=mysql_result($result,$i,"pelaths");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
        $posotita=mysql_result($result,$i,"posotita");
        $timologio_agoras=mysql_result($result,$i,"timologio_agoras");
	$dc=mysql_result($result,$i,"dc");
	$logos_epistrofis=mysql_result($result,$i,"logos_epistrofis");
	$kathari_aksia_pistosis=mysql_result($result,$i,"kathari_aksia_pistosis");
        $aksia_polisis=mysql_result($result,$i,"aksia_polisis");
	$deltio_paralavis=mysql_result($result,$i,"deltio_paralavis");
	$date_paralavis=mysql_result($result,$i,"date_paralavis");
	$katastasi_proiontos=mysql_result($result,$i,"katastasi_proiontos");
	$katastasi_proiontos_logos=mysql_result($result,$i,"katastasi_proiontos_logos");
	$katastasi_siskeuasias=mysql_result($result,$i,"katastasi_siskeuasias");
	$katastasi_siskeuasias_logos=mysql_result($result,$i,"katastasi_siskeuasias_logos");
}
if ($katastasi_proiontos == "1" )
{$katastasi_proiontos1="Δεν είναι καλή.";}
else if ($katastasi_proiontos == "0" )
{$katastasi_proiontos1="Είναι καλή.";}
if ($katastasi_siskeuasias == "1" )
{$katastasi_siskeuasias1="Δεν είναι πλήρης.";}
else if ($katastasi_siskeuasias == "0" )
{$katastasi_siskeuasias1="Είναι πλήρης.";}
if ($egrisi == "2" )
{$katastasi="Ημερομηνία Πίστωσης";}
else if ($egrisi == "3" )
{$katastasi="Ημερομηνία Επιστροφής";}

?>
  <body bgcolor=<?php print $colour?>>
    <FORM name="form" action="insert.php" method="post">
<input name="id" type="hidden" value="<?php print $id?>">
      <table border="0">
  <tbody>
    <tr>
      <td width="192"></td>	
      <td width="180"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $pelaths;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Είδος</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $kodikos_eidous;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $rma_date;?></td>
    </tr>
<tr>
      <td><br> </td>
      <td> </td>
      <td> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $dc; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ποσότητα</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $posotita; ?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Αξία πώλησης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $aksia_polisis; ?></td>
    </tr>

<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Καθαρή αξία πίστωσης </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $kathari_aksia_pistosis?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφης </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td width="370"><?php  print $logos_epistrofis ?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Δελτίο Παραλαβής</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $deltio_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Ημερομηνία Παραλαβής</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $date_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Κατάσταση Προϊόντος</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $katastasi_proiontos1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?php print $katastasi_proiontos_logos;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Κατάσταση Συσκευασίας</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $katastasi_siskeuasias1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?php print $katastasi_siskeuasias_logos;?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Τύπος Παραστατικού</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><input name="tipos_parastatikou" value="" size="11" onKeyPress="return handleEnter(this, event)"></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Αριθμός Παραστατικού</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><input name="arithmos_parastatikou" value="" size="11" onKeyPress="return handleEnter(this, event)"></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>"><?php print $katastasi;?></font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><input name="date_return" value="" size="11" onKeyPress="return handleEnter(this, event)">&nbsp;<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.date_return);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
    </tr>
  </tbody>
</table>
<br>
 </table>
      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"></td>
      <td width="10" valign="top"></td>
      <td width="370" align="right"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()"></td>
    </tr>
        </tbody>
</table>
</FORM>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</body>
</html>

