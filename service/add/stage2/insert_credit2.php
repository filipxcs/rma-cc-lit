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
$dialoges=$_POST['dialoges'];


?>
<body bgcolor=<?php print $colour?>>
<?php
#----------Update order_master to close the order--------------------------------------------------------------

	$query = " update rma.credit_master set openflag='21',dialoges='$dialoges' where id='$masterid'";
	$result=mysql_query($query);
	

#------------------------------------------------------------------------
?>
</body>
</html>
</BODY>
</html>
