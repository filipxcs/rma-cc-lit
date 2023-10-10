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
print "<font size=\"5\"><Center>
  <p>Έγινε αλλαγή</p>
</Center>";
$query = "UPDATE transactions set details='$_POST[details]' where transid='$_POST[transid]'";
$result=mysql_query($query);
$query = "UPDATE checks set checktype='$_POST[new_check]' where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);


mysql_close();
?>
</body>
</html>
</BODY>
</html>

