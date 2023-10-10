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
require("../../../session_check.php");
if ($_POST[ppp]!="")
{
$needle="@@@";
$docid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$docdetails = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,200);


$query="SELECT rmaid,tracode,leename,codcode,itmname,sn,online,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname FROM rmaservice where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$kodikos_pelath=mysql_result($result,$i,"tracode");
	$pelaths=mysql_result($result,$i,"leename");
    $kodikos_eidous=mysql_result($result,$i,"codcode");
	$perigrafh_eidous=mysql_result($result,$i,"itmname");
	$serial_number=mysql_result($result,$i,"sn");
    $doa=mysql_result($result,$i,"doa");
    $warranty=mysql_result($result,$i,"inwar");
	$bumerang=mysql_result($result,$i,"bumerang");
	$logos_epistrofhs=mysql_result($result,$i,"malfunction");
	$hmeromhnia_agoras=mysql_result($result,$i,"purchdate");
    $timologio_agoras=mysql_result($result,$i,"purchdoc");
	$metafora=mysql_result($result,$i,"transport");
	$metafora_parathrhseis=mysql_result($result,$i,"transportcomments");
	$me_poion_milame=mysql_result($result,$i,"contactname");
	
}

$query="SELECT date_format(date,'%d-%c-%Y')AS 'trans_date',kind,details FROM transactions where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");
    $parathrhseis=mysql_result($result,$i,"details");
	
}

$query="SELECT date_format(date,'%d-%c-%Y')AS 'charge_date',value,comment FROM charges where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $charge_date=mysql_result($result,$i,"charge_date");
	$xreosi=mysql_result($result,$i,"value");
    $logos_xreosis=mysql_result($result,$i,"comment");
	
}

$query="SELECT package,included,comments FROM package where rmaid='$_POST[rmaid]' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $package=mysql_result($result,$i,"package");
	$included=mysql_result($result,$i,"included");
    $package_comments=mysql_result($result,$i,"comments");
	
}
if ($package == "1" )
{$package1="Ναι";}
else if ($package == "2" )
{$package1="Οχι";}

if ($included == "1" )
{$included1="Ναι";}
else if ($included == "2" )
{$included1="Οχι";}


if ($doa == "1" )
{$doa1="Ναι";}
else if ($doa == "2" )
{$doa1="Οχι";}

if ($warranty == "1" )
{$warranty1="Ναι";}
else if ($inwar == "2" )
{$warranty1="Οχι";}

if ($bumerang == "1" )
{$bumerang1="Ναι";}
else if ($bumerang == "2" )
{$bumerang1="Οχι";}

if ($metafora == "1" )
{$metafora1="ΜΕΣΑ ΔΙΚΑ ΜΑΣ";}
else if ($metafora == "2" )
{$metafora1="ΜΕΣΑ ΤΟΥ ΠΕΛΑΤΗ";}
else if ($metafora == "3" )
{$metafora1="ΜΕΤΑΦΟΡΙΚΗ";}


?>
  <body bgcolor=<?php print $colour?>>
    <FORM name="form" action="insert.php" method="post">
      <table border="0" width="100%">
  <tbody>
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220" colspan="7"><?php  print $rmaid; ?></td>
      </tr>
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Online RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $online; ?><input name="kodikos_pelath" type="hidden" value="<?php  print $online; ?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $_POST[kodikos_eidous];?><input name="kodikos_eidous" type="hidden" value="<?php  print $_POST[kodikos_eidous];?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $hmeromhnia_agoras; ?><input name="hmeromhnia_agoras" type="hidden" value="<?php  print $hmeromhnia_agoras;?>"></td>
    </tr>
    
    <tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $pelaths; ?><input name="pelaths" type="hidden" value="<?php  print $pelaths ;?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $perigrafh_eidous ;?><input name="perigrafh_eidous" type="hidden" value="<?php  print $perigrafh_eidous ;?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $timologio_agoras; ?><input name="timologio_agoras" type="hidden" value="<?php  print $timologio_agoras;?>"></td>
    </tr>
 
    <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="220"><?php  print $trans_date;?></td>
    </tr>
<tr>
      <td colspan="10"><br></td>
</tr>
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Με ποιόν μιλάμε;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $me_poion_milame; ?><input name="me_poion_milame" type="hidden" value="<?php  print $me_poion_milame; ?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Σειριακός Αριθμός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $serial_number; ?><input name="serial_number" type="hidden" value="<?php  print $serial_number; ?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Χρέωση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><?php  print $xreosi; ?><input name="xreosi" type="hidden" value="<?php  print $xreosi; ?>"></td>
    </tr>
    <tr>
      <td colspan="7" width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Λόγος χρέωσης </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td rowspan="2" width="130"><?php  print $logos_xreosis; ?><input name="logos_xreosis" type="hidden" value="<?php  print $logos_xreosis; ?>"></td>
      </tr>
      <tr>
      <td>&nbsp;</td>
      </tr>
    
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Dead on arrival</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $doa1; ?><input name="doa" type="hidden" value="<?php  print $doa1; ?>"></td>
      
      <td width="135"><font color="<?php print $colour1?>">Έχει εγγύηση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $warranty1; ?><input name="warranty" type="hidden" value="<?php  print $warranty1; ?>"></td>
      
      <td width="135"><font color="<?php print $colour1?>">Έχει ξανάρθει;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $bumerang1; ?><input name="bumerang" type="hidden" value="<?php  print $bumerang1; ?>"></td>
    </tr>
    
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφής </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><?php  print $logos_epistrofhs; ?><input name="logos_epistrofhs" type="hidden" value="<?php  print $logos_epistrofhs; ?>"></td>
    </tr>
    
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις RMA</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><?php  print $parathrhseis; ?><input name="parathrhseis" type="hidden" value="<?php  print $parathrhseis; ?>"></td>
    </tr>
    <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Μεταφορά</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $metafora1; ?><input name="metafora" type="hidden" value="<?php  print $metafora1; ?>"></td>
     
      <td rowspan="3" width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις Μεταφοράς</font></td>
      <td rowspan="3" width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td rowspan="3" colspan="4" width="125"><?php  print $metafora_parathrhseis; ?><input name="metafora_parathrhseis" type="hidden" value="<?php  print $metafora_parathrhseis; ?>"></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Συσκευασία</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $package1; ?></td>
      
      <td width="135"><font color="<?php print $colour1?>">Παρελκυόμενα</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $included1; ?></td>
     </tr>
     <tr> 
     <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Λείπουν</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220" rowspan="2" valign="top"><?php  print $package_comments; ?></td>
    </tr>
      <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις Αποστολής</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><textarea name="parathrhseis_apostolis" cols="50" rows="3"></textarea> </td>
    </tr>
    <tr>
      <td colspan="4" width="*"></td>
      <td width="125" align="right"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()">
      <input name="rmaid" type="hidden" value="<?php  print $rmaid; ?>">
      <input name="online" type="hidden" value="<?php  print $online; ?>">
      <input name="docid" type="hidden" value="<?php  print $docid; ?>">
      <input name="docdetails" type="hidden" value="<?php  print $docdetails; ?>"></td>
      <td colspan="5" width="*"></td>
    </tr>
   
   </tbody>
</table>
</FORM>
<?php 
}
else {
?>
<body bgcolor=" <?php  print $colour ?> " onload="changeFrames()">
</body>
<?php  } ?>
</html>
