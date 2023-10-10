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

$query="select * from rmaservice where tracode='$_POST[ppp]' and stageid=2";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
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











?>
  <body bgcolor="<?php print $colour?>">
    <FORM name="drop_list" action="insert1.php" method="post">
     <input name="tracode" type="hidden" value="<?php print $_POST['ppp']; ?>">


      <table border="0">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="360" colspan=2><font color="<?php print $colour1?>">Αριθμός RMA που θα τερματιστούν για τον πελάτη <?php print $pelaths ?></font></td>
      <td width="10"><font color="<?php print $colour1?>" size=5>:</font></td>
      <td width="150"><font size=5><?php print $num;?></font></td>
      <td width="135"><font color="<?php print $colour1?>"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()"></font></td>
      
      
    </tr>  
    
  
   
    
    
 
       
     
      
   </tbody>
</table>
     
</FORM>
</body>
</html>

