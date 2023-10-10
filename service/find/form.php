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
<script language="javascript" src="list.js"></script>
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
$query="SELECT rmaid,stageid,tracode,leename,codcode,itmname,sn,online,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname,noreason,userblame FROM rmaservice where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$stageid=mysql_result($result,$i,"stageid");
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
	$noreason=mysql_result($result,$i,"noreason");
	$userblame=mysql_result($result,$i,"userblame");
	
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
$teliki_xreosi=$teliki_xreosi+$xreosi;
	
}



if ($doa == "1" )
{$doa1="Ναι";}
else if ($doa == "2" )
{$doa1="Οχι";}

if ($warranty == "1" )
{$warranty1="ΝΑΙ";}
else 
{$warranty1="ΟΧΙ";}


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

if ($noreason == "1" )
{$noreason1="NAI";}
else
{$noreason1="OXI";}
if ($userblame == "1" )
{$userblame1="NAI";}
else
{$userblame1="OXI";}


?>
  <body bgcolor="<?php print $colour?>" onLoad="fillCategory();">
    <FORM name="drop_list" action="insert.php" method="post">
    


      <table border="0">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $trans_date;?></td>
      <td colspan="3" rowspan="6" width="250" valign="top"><iframe src ="transactions.php?rmaid=<?php print $rmaid; ?>"
width="100%" height="98%" frameborder="1">
</iframe></td>
    </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Online RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $online; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $kodikos_eidous;?></td>
   </tr>      
    <tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php print $pelaths; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php print $perigrafh_eidous ;?></td>
    </tr>
    <tr>
      <td colspan="3"><br></td>
</tr>
    <tr>
      <td colspan="7"><br></td>
</tr>
 <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφής </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="2" width="125"><?php print $logos_epistrofhs; ?></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
      
   </tbody>
</table>
     <table border="0">
  <tbody>
    <tr>
    <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Με ποιόν μιλήσαμε;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $me_poion_milame; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Σειριακός Αριθμός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $serial_number; ?></td>
      <td colspan="3" rowspan="6" width="250" valign="top"><iframe src ="charges.php?rmaid=<?php print $rmaid; ?>"
width="100%" height="47%" frameborder="1">
</iframe></td>
      </tr>
       
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Dead on arrival</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $doa1; ?></td>
      
      <td width="135"><font color="<?php print $colour1?>">Έχει εγγύηση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $warranty1; ?></td>
</tr>
<tr>    
      <td width="20"></td>  
      <td width="135"><font color="<?php print $colour1?>">Έχει ξανάρθει;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $bumerang1; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Χρέωση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><?php print $teliki_xreosi; ?></td>
    </tr>    

    
      <tr>
    <td>&nbsp;</td>
    </tr>
      <tr>
    <td>&nbsp;</td>
    </tr>
      <tr>
    <td colspan="7">&nbsp;</td>
    </tr>
  
<tr>    
      <td width="20"></td>  
      <td width="135"><font color="<?php print $colour1?>">Αναίτια Επιστροφή</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $noreason1; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Υπαιτιότητα Χρήστη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><?php print $userblame1; ?></td>
    </tr>     
        

  
    

   
   </tbody>
</table>
</FORM>
</body>
</html>

