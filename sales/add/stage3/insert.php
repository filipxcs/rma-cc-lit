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
$date=date("Y-m-d");
$userid=$_SESSION["userid"];
?>
<body bgcolor=<?php print $colour?>>
<?php 
$rmaid=$_POST[rmaid];
$comments=$_POST[comments];
$action=$_POST['action'];
if($action==1)
{$action_comments="Αποστολή";}
if($action==2)
{$action_comments="Πίστωση";}
if($action==3)
{$action_comments="Επανεκχώρηση";}


	//ayto gia na moy bazei svsto xrhsth sto trans
	$query10="select login from rma.user where userid=$userid";
	$result10=mysql_query($query10);	
	$username=mysql_result($result10,0,"login");
	//______________
	
$query = " INSERT INTO rma.transactions_s VALUES (\"\",\"$rmaid\",\"$date\",\"$action_comments\",\"$userid\",\"$username\",\"\",\"\",\"$comments\")";
$result=mysql_query($query);
if($action=="3")
{$query = "update rma.rmasales set stageid='6' where rmaid='$rmaid'";}
else
{$query = "update rma.rmasales set stageid='3' where rmaid='$rmaid'";}

$result=mysql_query($query);
	
print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center></font>";


mysql_close();
?>
</body>
</html>
</BODY>
</html>

