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
$userid=$_SESSION["userid"];
$masterid=$_POST['masterid'];
$paralavi=$_POST['paralavi'];


?>
<body bgcolor=<?php print $colour?>>
<?php 
#----------Update order_master to close the order--------------------------------------------------------------

	$query = " update rma.order_master set openflag='21',flag1='$paralavi' where id='$masterid'";
	$result=mysql_query($query);
	

#------------------------------------------------------------------------
?>
</body>
</html>
</BODY>
</html>
