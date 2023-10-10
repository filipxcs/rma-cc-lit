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
$userid=$_SESSION["userid"];
$cancel_date=date("Y-m-d");
?>
<body bgcolor=<?php print $colour?>>
<?php

print "<font size=\"5\"><Center>
  <p>Έγινε ακύρωση του RMA :".$_POST[rmaid]."</p>
</Center>";

$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$cancel_date\",\"Ακύρωση\",\"$userid\",\"\",\"\",\"\",\"\")";
$result=mysql_query($query);

$query = " UPDATE rmaservice set stageid=9 where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);

mysql_close();
?>
</body>
</html>
</BODY>
</html>

