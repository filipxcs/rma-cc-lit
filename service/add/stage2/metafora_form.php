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

$rmaid =$_POST['ppp'];



$query="SELECT rmaid,tracode,leename,codcode,itmname,sn,online,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname FROM rmaservice where rmaid='$rmaid'";
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












?>
  <body bgcolor=<?php print $colour?>>
    <FORM name="form" action="metafora_insert.php" method="post">
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
      <td width="220"><?php  print $kodikos_eidous;?><input name="kodikos_eidous" type="hidden" value="<?php  print $_POST[kodikos_eidous];?>"></td>
    </tr>    
    <tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $pelaths; ?><input name="pelaths" type="hidden" value="<?php  print $pelaths ;?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $perigrafh_eidous ;?><input name="perigrafh_eidous" type="hidden" value="<?php  print $perigrafh_eidous ;?>"></td>
     </tr>
 
    
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Με ποιόν μιλάμε;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $me_poion_milame; ?><input name="me_poion_milame" type="hidden" value="<?php  print $me_poion_milame; ?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Σειριακός Αριθμός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $serial_number; ?><input name="serial_number" type="hidden" value="<?php  print $serial_number; ?>"></td>
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
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    
     
    <tr>
    <td>&nbsp;</td>
    </tr>    
        
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Νέο Online RMA</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><input name="new_online" type="text" value=""> </td>
    </tr>
     <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Κατάσταση διαλόγής</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><select name="dialogh_status" >
      				<option value="1">Accept</option>
      				<option value="2">Reject - Εγγύηση</option>
                    <option value="2">Reject - Όροι</option>
                    </select></td>
    </tr>
    <tr>
      <td colspan="4" width="*"></td>
      <td width="125" align="right"><input name="submit" type="submit" value="καταχώρηση"">
      <input name="rmaid" type="hidden" value="<?php  print $rmaid; ?>">
      <input name="online" type="hidden" value="<?php  print $online; ?>">
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

