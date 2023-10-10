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
{$action_comments="Επανέγκριση";}
if($action==2)
{$action_comments="Απόρριψη";}
$query = " INSERT INTO rma.transactions_s VALUES (\"\",\"$rmaid\",\"$date\",\"$action_comments\",\"$userid\",\"\",\"\",\"\",\"$comments\")";
$result=mysql_query($query);
$query = "update rma.rmasales set stageid='2' where rmaid='$rmaid'";
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

