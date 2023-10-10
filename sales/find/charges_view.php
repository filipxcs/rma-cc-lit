<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
require("../../params.php");
require("../../mysql.php");
?>
<body onBlur="window.close()" bgcolor=<?php print $colour?>>
<?php 
$query="SELECT rmaid,stageid,tracode,leename,codcode,itmname,sn,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname FROM rmaservice where rmaid='$_POST[rmaid]%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
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
	
}

$query="SELECT date_format(date,'%d-%c-%Y')AS 'charge_date',value,comment,userid FROM charges where rmaid='$rmaid' and chargeid='$chargeid' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $charge_date=mysql_result($result,$i,"charge_date");
	$value=mysql_result($result,$i,"value");
	$comment=mysql_result($result,$i,"comment");
	$userid=mysql_result($result,$i,"userid");
	}


$query="SELECT username FROM user WHERE userid='$userid'";
$result=mysql_query($query);
$username=mysql_result($result,0,"username");
?>
<center><b><i><font size="5"><?php  print $kind; ?></font></b></i></center>
<hr>

     <table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $charge_date;?></td>
      </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $username; ?></td>
      </tr>      
     <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Χρέωση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $value; ?></td>
</tr>
 <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="2" width="105"><?php  print $comment; ?></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
   
   </tbody>
</table>

<hr>
</body>
</html>
