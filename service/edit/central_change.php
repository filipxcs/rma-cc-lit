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
$query = "UPDATE rmaservice set malfunction='$_POST[logos_epistrofis]',contactname='$_POST[me_poion_milame]',sn='$_POST[serial_number]',doa='$_POST[DOA]',inwar='$_POST[warranty]',bumerang='$_POST[bumerang]',noreason='$_POST[noreason]',userblame='$_POST[userblame]' where rmaid = '$_POST[rmaid]'";
$result=mysql_query($query);


mysql_close();
?>
</body>
</html>
</BODY>
</html>

