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
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");

$query="SELECT * from rmasales where rmaid='$_POST[rmaid]%' order by rmaid";
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
    $warranty=mysql_result($result,$i,"inwar");
	$logos_epistrofhs=mysql_result($result,$i,"reason");
	
}
$query="SELECT * from rma.zonlinerma_s where online='$online' order by online";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	$user=mysql_result($result,$i,"user");
	}

$query="SELECT date_format(date,'%d-%c-%Y')AS 'trans_date',kind,details FROM transactions_s where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");
    $parathrhseis=mysql_result($result,$i,"details");
	
}




if ($doa == "1" )
{$doa1="Ναι";}
else if ($doa == "2" )
{$doa1="Οχι";}

if ($warranty == "1" )
{$warranty1="SELECTED";}
else 
{$warranty2="SELECTED";}


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
{$noreason1="checked";}
else
{$noreason1="";}
if ($userblame == "1" )
{$userblame1="checked";}
else
{$userblame1="";}


?>
  <body bgcolor="<?php print $colour?>"">
    <FORM name="drop_list" action="insert.php" method="post">
    


      <table border="0">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php  print $online;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php  print $trans_date;?></td>
      <td colspan="3" rowspan="6" width="250" valign="top"><iframe src ="transactions.php?rmaid=<?php  print $rmaid; ?>"
width="100%" height="98%" frameborder="1">
</iframe></td>
    </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός πελάτη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php  print $kodikos_pelath; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php  print $kodikos_eidous;?></td>
   </tr>      
    <tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php  print $pelaths; ?></td>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php  print $perigrafh_eidous ;?></td>
    </tr>
    <tr>
      <td colspan="3"><br></td>
</tr>
       <tr>
       <td colspan="4"></td>
       <td width="135"><font color="<?php print $colour1?>">Serial</font></td>	
       <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php  print $serial_number; ?></td>
		</tr>
	 <tr>
      <td colspan="3"><br></td>
</tr>
<tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Online χρήστης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php  print $user; ?></td>
      </tr>
    <tr>
      <td colspan="7"><br></td>
</tr>

 <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφής </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="2" width="125"><?php  print $logos_epistrofhs; ?></td>
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
      <td width="135"></td>
      <td width="10"></td>
     <td width="250"><select name="action">
    <option value="1">Αποστολή</option>
    <option value="2">Πίστωση</option>
	<option value="3">Επανεκχώρηση</option>
	</select></td>
	</tr>    
    
     
<?php 


?>

<tr>
      <td width="20"></td>
      <td width="135" valign=top><font color="<?php print $colour1?>">Σχόλια</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="4" width="125"><textarea name="comments" cols="50" rows="4"></textarea> </td>
      </tr>
 
    <tr>
      <td colspan="4" width="*"></td>
      <td width="125" align="right"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()">
      <input name="rmaid" type="hidden" value="<?php  print $rmaid; ?>">
      <input name="stageid" type="hidden" value="<?php  print $stageid; ?>">
      <input name="docid" type="hidden" value="<?php  print $docid; ?>">
      <input name="docdetails" type="hidden" value="<?php  print $docdetails; ?>"></td>
      <td colspan="5" width="*"></td>
    </tr>
   
   </tbody>
</table>
</FORM>
</body>
</html>

