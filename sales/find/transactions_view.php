<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
require("../../params.php");
require("../../mysql.php");
require("../../oracle.php");
?>
<body onBlur="window.close()" bgcolor=<?php print $colour?>>
<?php 
$query="SELECT date_format(date,'%d-%c-%Y')AS date, docid, online, price, salesman FROM rmasales where rmaid='$rmaid'";
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
	$date=mysql_result($result,$i,"date");
	$docid=mysql_result($result,$i,"docid");
	$online=mysql_result($result,$i,"online");
	$price=mysql_result($result,$i,"price");
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
 $cmdstr = "select doscode, docnumber, docekdosisdate from sld where docid=$docid";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		$doscode=$results["DOSCODE"][$i];
		$docnumber=$results["DOCNUMBER"][$i];
		$docekdosisdate=$results["DOCEKDOSISDATE"][$i];		}

?>
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $online;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $date;?></td>
      </tr>  
<tr><td>&nbsp;</td></tr> 
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Πωλητής</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php  print $salesman; ?></td>
      </tr>      
 <tr>
      <td width="20"></td>
      <td width="235" colspan="4"><font color="<?php print $colour1?>">Τιμολόγιο Πώλησης - Σειρά - Αριθμός - Ημερομηνία</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $doscode."-".$docnumber."-".$docekdosisdate;?></td>
      </tr>
<tr><td>&nbsp;</td></tr> 
 <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Tιμή Πίστωσης Μονάδας</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $price;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνία Εγκρισης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $trans_date;?></td>

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
   </tbody>
</table>
<?php 
}
else if ($kind == "Παραλαβή")
{
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
	
	
	$needle="@@@";
	$doscode = substr($docdetails,0,strpos($docdetails,$needle));
	$d1 = substr($docdetails,strpos($docdetails,$needle)+3,500);
	$docnumber = substr("$d1",0,strpos($d1,$needle));
	$docekdosisdate = substr("$d1",strpos($d1,$needle)+3,500);
}


?>
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $online;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $date;?></td>
      </tr>  
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Χρήστης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $tiki_user;?></td>
      </tr>  
      <tr><td>&nbsp;</td></tr> 
	  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Δελτίο Παραλαβής </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php  print $doscode."-".$docnumber;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια Παραλαβής </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $docekdosisdate;?></td>
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
      <td width="50"><?php  print $online;?></td>
      <td width="40"><font color="<?php print $colour1?>">Ημερομηνια</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $date;?></td>
      </tr>
     
  <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="5" width="105"><?php  print $details; ?></td>
    </tr>

      
   </tbody>
</table>
<?php  } ?>
<hr>
</body>
</html>
