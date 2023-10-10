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
$query="SELECT id,date_format(rma_date,'%d-%c-%Y')AS 'rma_date',users,pelaths,kodikos_eidous,posotita,timologio_agoras,date_format(dc,'%d-%c-%Y')AS 'dc',logos_epistrofis,kathari_aksia_pistosis,aksia_polisis,user_egrisi_2,date_format(date_egrisi_2,'%d-%c-%Y')AS 'date_egrisi_2' FROM sales_stage1 where  id='$_POST[id]%' AND part='1' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
print "nikos";
for ($i = 0; $i < $num; $i++ )
	{
	
        $id=mysql_result($result,$i,"id");
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
	$user_egrisi_2=mysql_result($result,$i,"user_egrisi_2");
	$date_egrisi_2=mysql_result($result,$i,"date_egrisi_2");
}
$date=date("d/m/Y");
$needle="-";
$domain1 = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$domain1a = substr("$_POST[ppp]",strlen($domain1)+1,strlen($_POST[ppp]));
$domain2 = substr("$domain1a",0,strpos($domain1a,$needle));
$domain2a = substr("$domain1a",strlen($domain2)+1,strlen($domain1a));

$deltio_paralavis=$domain2."-".$domain2a;

$query="select technam from users where techid='$users'";
$result=mysql_query($query);
$xrhsths_kataxorisis=mysql_result($result,0,"technam");
$query="select technam from users where techid='$user_egrisi_2'";
$result=mysql_query($query);
$user_egrisi=mysql_result($result,0,"technam");
mysql_close();

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
      <td width="180"><font color="<?php print $colour1?>">Χρήστης Καταχώρησης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $xrhsths_kataxorisis;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημ/νια Καταχώρησης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $rma_date;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Χρήστης Έγκρισης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $user_egrisi;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνια Έγκρισης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $date_egrisi_2;?></td>
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
      <td width="*"><?php print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $dc; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Ποσότητα</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $posotita; ?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?php print $colour1?>">Αξία πώλησης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php print $aksia_polisis; ?></td>
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
      <td width="370"><?php print $logos_epistrofis ?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
  </tbody>
</table>
</table>
      <table border="0">
        <tbody>
<tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?php print $colour1?>">Κατάσταση προϊόντος</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" valign="top">Καλή;</td>
      <td width="320">ΝΑΙ<INPUT type="radio" name="katastasi_proiontos" value="0" checked>&nbsp;&nbsp;ΟΧΙ<INPUT type="radio" name="katastasi_proiontos" value="1"><br><textarea name="katastasi_proiontos_logos" cols="25" rows="2"></textarea> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?php print $colour1?>">Κατάσταση συσκευασίας</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" valign="top">Πλήρης;&nbsp;&nbsp;</td>
      <td width="320">ΝΑΙ<INPUT type="radio" name="katastasi_siskeuasias" value="0" checked>&nbsp;&nbsp;ΟΧΙ<INPUT type="radio" name="katastasi_siskeuasias" value="1"><br><textarea name="katastasi_siskeuasias_logos" cols="25" rows="2"></textarea> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?php print $colour1?>">Εγκρίνεται</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*">ΝΑΙ<INPUT type="radio" name="egrisi" value="1" checked>&nbsp;&nbsp;ΟΧΙ<INPUT type="radio" name="egrisi" value="0"></td>
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
</body>
</html>

