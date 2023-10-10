<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
require("../../../params.php");
require("../../../mysql.php");
?>
<body onBlur="window.close()" bgcolor=<?php print $colour?>>
<?php 
$query="SELECT * FROM rmasales where rmaid='$rmaid'";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
	#$stageid=mysql_result($result,$i,"stageid");
	#$kodikos_pelath=mysql_result($result,$i,"tracode");
	#$pelaths=mysql_result($result,$i,"leename");
    #$kodikos_eidous=mysql_result($result,$i,"codcode");
	#$perigrafh_eidous=mysql_result($result,$i,"itmname");
	#$serial_number=mysql_result($result,$i,"sn");
    #$doa=mysql_result($result,$i,"doa");
    #$warranty=mysql_result($result,$i,"inwar");
	#$bumerang=mysql_result($result,$i,"bumerang");
	#$logos_epistrofhs=mysql_result($result,$i,"malfunction");
	#$hmeromhnia_agoras=mysql_result($result,$i,"purchdate");
    #$timologio_agoras=mysql_result($result,$i,"purchdoc");
	#$metafora=mysql_result($result,$i,"transport");
	#$metafora_parathrhseis=mysql_result($result,$i,"transportcomments");
	#$me_poion_milame=mysql_result($result,$i,"contactname");
	#$peppercode=mysql_result($result,$i,"peppercode");
	#$noreason=mysql_result($result,$i,"noreason");
	$salesman=mysql_result($result,$i,"salesman");

	
}


$query="SELECT date_format(date,'%d-%c-%Y')AS 'trans_date',kind,userid,tiki_user,docid,docdetails,details FROM transactions_s where rmaid='$rmaid' and transid='$transid' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");
	$userid=mysql_result($result,$i,"userid");
	$tiki_user=mysql_result($result,$i,"tiki_user");
	$docdetails=mysql_result($result,$i,"docdetails");
	$details=mysql_result($result,$i,"details");
}


?>
<center><b><i><font size="5"><?php  print $kind; ?></font></b></i></center>
<hr>
<?php 
if ($kind == "Έγκριση")
{


?>
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $trans_date;?></td>
      </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Πωλητής</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $salesman; ?></td>
      </tr>      
 <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Δελτίο Παραλαβής :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $dotcode."-".$docnumber;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια Έγκρισης :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $docdate;?></td>
      </tr>  
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="3" width="105"><?php  print $details; ?></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
   </tbody>
</table>
<?php 
}
else if ($kind == "Τερματισμός")
{
$query="SELECT date_format(date,'%d-%c-%Y')AS 'check_date',checktype FROM checks where rmaid='$rmaid' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	$check_date=mysql_result($result,$i,"check_date");
	$checktype=mysql_result($result,$i,"checktype");
	}

$query="SELECT * FROM checktypes where checktype='$checktype'";
$result=mysql_query($query);
$check=mysql_result($result,0,"checkdescription");

if ($noreason == "1" )
{$noreason1="Ναί";}
else
{$noreason1="Όχι";}
if ($userblame == "1" )
{$userblame1="Ναί";}
else
{$userblame1="Όχι";}

?>
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $trans_date;?></td>
      </tr>  
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Υπαιτιότητα Χρήστη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $noreason1;?></td>
      <td width="135"><font color="<?php print $colour1?>">Αναίτια Επιστροφή</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $userblame1;?></td>
      </tr>  
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $username; ?></td>
      </tr>      
 <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Κίνηση :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $check;?></td>
      </tr>  
 <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="5" width="105"><?php  print $details; ?></td>
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
    <td>&nbsp;</td>
    </tr>
      
   </tbody>
</table>
<?php 
}
else
{ ?>
     <table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="40"><font color="<?php print $colour1?>">Αριθμός RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $rmaid;?></td>
      <td width="40"><font color="<?php print $colour1?>">Ημερομηνια</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $trans_date;?></td>
      </tr>
     
<?php   if ($peppercode!="")
{ ?>
      
      <tr>
      <td width="20"></td>
      <td width="40"></td>
      <td width="10"></td>
      <td width="50"colspan="5">Το είδος είναι μέρος συστήματος Pepper με κωδικό : <?php  print $peppercode; ?></td>
      </tr>    
    <?php  }
	else
	{}
	?>
  
  <tr>
      <td width="20"></td>
      <td width="40"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $username; ?></td>
      </tr> 
      <tr>
      <td width="20"></td>
      <td width="40"><font color="<?php print $colour1?>">Online Χρήστης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $tiki_user; ?></td>
      </tr>             
     <tr>
      <td colspan="7"><br></td>
</tr>
 <tr>
      <td width="20"></td>
      <td width="40" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="5" width="105"><?php  print $details; ?></td>
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
    <td>&nbsp;</td>
    </tr>
      
   </tbody>
</table>
<?php  } ?>
<hr>
</body>
</html>
