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
$date_paralavh=date("Y-m-d");
$userid=$_SESSION["userid"];
?>
<body bgcolor=<?php print $colour?>>
<?php
$query1="select rmaid from rmaservice where tracode='$_POST[tracode]' and stageid=2";
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);

for ($i = 0; $i < $num1; $i++ )
	{
	
    $rmaid=mysql_result($result1,$i,"rmaid");

	$query = " INSERT INTO transactions VALUES (\"\",\"$rmaid\",\"$date\",\"Δίαγνωση\",\"$userid\",\"\",\"\",\"\",\"Η βλάβη που ανέφερε ο πελάτης γίνεται αποδεκτή με επιφύλαξη.\")";
	$result=mysql_query($query);
	print $query."</br>";
	$query = "INSERT INTO transactions VALUES (\"\",\"$rmaid\",\"$date\",\"Τερματισμός\",\"$userid\",\"\",\"\",\"\",\"Αντικατάσταση ή πίστωση.\")";
	$result=mysql_query($query);
	print $query."</br>";
	$query = " UPDATE rmaservice set stageid='6' where rmaid = '$rmaid'";
	print $query."</br>";
	$result=mysql_query($query);
	}
	
print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center>";

mysql_close();
?>
</body>
</html>
</BODY>
</html>

