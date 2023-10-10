<?php 
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php 
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");
require("../../date.php");

?>
<body bgcolor=<?php print $colour?>>
<?php 

$d1 = substr("$_POST[hmeromhnia_agoras]",0,2);
$d2 = substr("$_POST[hmeromhnia_agoras]",3,2);
$d3 = substr("$_POST[hmeromhnia_agoras]",6,2);
$hmeromhnia_agoras="20".$d3."-".$d2."-".$d1;


$userid=$_SESSION["userid"];
$sessionid=$_SESSION["sessionid"];
$kodikos_pelath=$_POST[kodikos_pelath];
$pelaths=$_POST[pelaths];
$kodikos_eidous=$_POST[kodikos_eidous];
$perigrafh_eidous=$_POST[perigrafh_eidous];
$serial_number=$_POST[serial_number];
$DOA=$_POST[DOA];
$warranty=$_POST[warranty];
$bumerang=$_POST[bumerang];
$logos_epistrofis=$_POST[logos_epistrofis];
$timologio_agoras=$_POST[timologio_agoras];
$xreosi=$_POST[xreosi];
$logos_xreosis=$_POST[logos_xreosis];
$parathrhseis=$_POST[parathrhseis];
$metafora=$_POST[metafora];
$metafora_parathrhseis=$_POST[metafora_parathrhseis];
$me_poion_milame=$_POST[me_poion_milame];


$query = " INSERT INTO rmamain VALUES (\"\",\"1\",\"$userid\",\"$sessionid\")";
$result=mysql_query($query);
$query = " SELECT MAX(rmaid) as rmaid FROM rmamain WHERE userid='$userid' AND sessionid='$sessionid'";
$result=mysql_query($query);
$rmaid=mysql_result($result,0,"rmaid");
$query = " INSERT INTO rmaservice VALUES (\"\",\"$rmaid\",\"1\",\"$kodikos_pelath\",\"$pelaths\",\"$kodikos_eidous\",\"$perigrafh_eidous\",\"$serial_number\",\"0\",\"$DOA\",\"$warranty\",\"$bumerang\",\"\",\"\",\"\",\"$logos_epistrofis\",\"$_POST[peppercode]\",\"$hmeromhnia_agoras\",\"$timologio_agoras\",\"$metafora\",\"$metafora_parathrhseis\",\"$me_poion_milame\")";
$result=mysql_query($query);
if ($xreosi == "0")
{
}
else
{
$query = " INSERT INTO charges VALUES (\"\",\"$rmaid\",\"$userid\",\"\",\"$rma_date\",\"$xreosi\",\"$logos_xreosis\",\"0\")";
$result=mysql_query($query);
}
$query = " INSERT INTO transactions VALUES (\"\",\"$rmaid\",\"$rma_date\",\"Δήλωση\",\"$userid\",\"\",\"\",\"\",\"$parathrhseis\")";
$result=mysql_query($query);
mysql_close();
?>
<font size="5"><Center>
  <p>Έγινε Καταχώρηση με Αριθμό RMA : <?php  print $rmaid ?></p>
  </Center></font>
</body>
</html>
</BODY>
</html>

