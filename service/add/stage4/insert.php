<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
</head>
<?php
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");
$date_apostolh=date("Y-m-d");
$userid=$_SESSION["userid"];
$online=$_POST['online'];
?>
<body bgcolor=<?php print $colour?>>
<?php

print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center>";

$query = "INSERT INTO transactions VALUES (\"\",\"$_POST[rmaid]\",\"$date_apostolh\",\"Αποστολή\",\"$userid\",\"\",\"$_POST[docid]\",\"$_POST[docdetails]\",\"$_POST[parathrhseis_apostolis]\")";
$result=mysql_query($query);

$query = " UPDATE rmaservice set stageid=8 where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);


mysql_close();
?>
</body>
</html>
</BODY>
</html>

