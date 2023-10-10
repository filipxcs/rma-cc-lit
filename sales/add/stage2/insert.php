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
$query10="select login from rma.user where userid=$userid";
$result10=mysql_query($query10);	
$username=mysql_result($result10,0,"login");
$comments=$_POST[comments];
$query = " INSERT INTO rma.transactions_s VALUES (\"\",\"$rmaid\",\"$date\",\"Παραλαβή\",\"$userid\",\"$username\",\"$_POST[docid]\",\"$_POST[docdetails]\",\"$comments\")";
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

