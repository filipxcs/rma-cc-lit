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
<h2 align="center">ΚΑΤΑΣΤΑΣΗ RMA <?php print $id; ?></h2>
</head>
<hr>
<?php
require("../params.php");
require("../mysql.php");
$query="SELECT id,date_format(rma_date,'%d-%c-%Y')AS 'rma_date',users,pelaths,kodikos_eidous,posotita,timologio_agoras,date_format(dc,'%d-%c-%Y')AS 'dc',logos_epistrofis,kathari_aksia_pistosis,aksia_polisis,deltio_paralavis,date_format(date_paralavis,'%d-%c-%Y')AS 'date_paralavis',katastasi_proiontos,katastasi_proiontos_logos,katastasi_siskeuasias,katastasi_siskeuasias_logos,egrisi,parastatiko_kleisimatos,date_format(date_return,'%d-%c-%Y')AS 'date_return' FROM sales_stage1 where  id=$id order by id";
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
	$parastatiko_kleisimatos=mysql_result($result,$i,"parastatiko_kleisimatos");
	$date_return=mysql_result($result,$i,"date_return");
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

if ($egrisi == "0" || $egrisi == "1" || $egrisi == "10"){
?>
  <body bgcolor=<?phpprint $colour?>>
      <table border="0">
  <tbody>
    <tr>
      <td width="192"></td>	
      <td width="180"><font color="<?phpprint $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $pelaths;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Είδος</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kodikos_eidous;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $rma_date;?></td>
    </tr>
<tr>
      <td><br> </td>
      <td> </td>
      <td> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $dc; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ποσότητα</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $posotita; ?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Αξία πώλησης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $aksia_polisis; ?></td>
    </tr>

<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Καθαρή αξία πίστωσης </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kathari_aksia_pistosis?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?phpprint $colour1?>">Λόγος Επιστροφης </font></td>
      <td width="10" valign="top"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="370"><?php print $logos_epistrofis ?></td>
    </tr>
  </tbody>
</table>
<?php
}
else if ($egrisi == "2" || $egrisi == "3"){
?>
  <body bgcolor=<?phpprint $colour?>>
      <table border="0">
  <tbody>
    <tr>
      <td width="192"></td>	
      <td width="180"><font color="<?phpprint $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $pelaths;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Είδος</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kodikos_eidous;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $rma_date;?></td>
    </tr>
<tr>
      <td><br> </td>
      <td> </td>
      <td> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $dc; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ποσότητα</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $posotita; ?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Αξία πώλησης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $aksia_polisis; ?></td>
    </tr>

<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Καθαρή αξία πίστωσης </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kathari_aksia_pistosis?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?phpprint $colour1?>">Λόγος Επιστροφης </font></td>
      <td width="10" valign="top"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="370"><?php print $logos_epistrofis ?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Δελτίο Παραλαβής</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $deltio_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Ημερομηνία Παραλαβής</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $date_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Κατάσταση Προϊόντος</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $katastasi_proiontos1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?phpprint $katastasi_proiontos_logos;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Κατάσταση Συσκευασίας</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $katastasi_siskeuasias1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?phpprint $katastasi_siskeuasias_logos;?></td>
    </tr>
  </tbody>
<?php
}
else if ($egrisi == "4"){
?>
  <body bgcolor=<?phpprint $colour?>>
      <table border="0">
  <tbody>
    <tr>
      <td width="192"></td>	
      <td width="180"><font color="<?phpprint $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $pelaths;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Είδος</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kodikos_eidous;?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $rma_date;?></td>
    </tr>
<tr>
      <td><br> </td>
      <td> </td>
      <td> </td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $timologio_agoras; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $dc; ?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Ποσότητα</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $posotita; ?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Αξία πώλησης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?php print $aksia_polisis; ?></td>
    </tr>

<tr>
      <td width="192"></td>
      <td width="180"><font color="<?phpprint $colour1?>">Καθαρή αξία πίστωσης </font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $kathari_aksia_pistosis?></td>
    </tr>
    <tr>
      <td width="192"></td>
      <td width="180" valign="top"><font color="<?phpprint $colour1?>">Λόγος Επιστροφης </font></td>
      <td width="10" valign="top"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="370"><?php print $logos_epistrofis ?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Δελτίο Παραλαβής</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $deltio_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Ημερομηνία Παραλαβής</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $date_paralavis;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Κατάσταση Προϊόντος</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $katastasi_proiontos1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?phpprint $katastasi_proiontos_logos;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Κατάσταση Συσκευασίας</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $katastasi_siskeuasias1;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"></td>
      <td width="10"></td>
      <td width="*"><?phpprint $katastasi_siskeuasias_logos;?></td>
    </tr>
<tr>
      <td width="192"><br></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Δελτίο Πίστωσης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $parastatiko_kleisimatos;?></td>
    </tr>
<tr>
      <td width="192"></td>
      <td width="190"><font color="<?phpprint $colour1?>">Ημερομηνία Πίστωσης</font></td>
      <td width="10"><font color="<?phpprint $colour1?>">:</font></td>
      <td width="*"><?phpprint $date_return;?></td>
    </tr>
  </tbody>
</table>
<?php
}
?>


</body>
</html>

