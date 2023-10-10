<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
$date_paralavh=date("Y-m-d");
$userid=$_SESSION["userid"];
?>
<body bgcolor=<?php print $colour?>>
<?php
$needle="@@@";
$codcode = substr("$_POST[kodikos]",0,strpos($_POST[kodikos],$needle));
$itmname = substr("$_POST[kodikos]",strpos($_POST[kodikos],$needle)+3,200);
print "<font size=\"5\"><Center>
  <p>Έγινε αλλαγή</p>
</Center>";
$query = " UPDATE rmaservice set codcode='$codcode',itmname='$itmname' where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);

mysql_close();
?>
</body>
</html>
</BODY>
</html>

 