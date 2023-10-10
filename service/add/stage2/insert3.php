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
require("../../../oracle.php");
require("../../../session_check.php");
require("../../date.php");
$userid=$_SESSION["userid"];
$masterid=$_POST['masterid'];
$docid=$_POST['docid'];
$docdetails=$_POST['docdetails'];
$today=date("Y-m-d");

?>
<body bgcolor=<?php print $colour?>>
<?php

	
	
#-------------------- Πίστωση ----------------------------------
	$queryt="SELECT * FROM rma.sort_master where id='$masterid'";
	$resultt=mysql_query($queryt);
	$numt=mysql_numrows($resultt);
	for ($i = 0; $i < $numt; $i++ )
	{
	$traid=mysql_result($resultt,$i,"traid");
	}

	$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$accept_id=mysql_result($resulta,$i,"id");
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	$rrmaid=mysql_result($resulta,$i,"rmaid");
		
			#-------------------- Create Transaction ----------------------------------
	
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rrmaid\",\"$today\",\"Παραλαβή\",\"$userid\",\"Auto\",\"$docid\",\"$docdetails\",\"Ειδική διαχείριση\")";
	$result=mysql_query($query);
	print $query."<br>";
	if($traid==2292)
	{
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rrmaid\",\"$today\",\"Τερματισμός\",\"$userid\",\"Auto\",\"\",\"\",\"Να γίνει πίστωση του προϊόντος\")";
	$result=mysql_query($query);
	print $query."<br>";
	}
	
	#print $query."<br>";
	#------------------------------------------------------------------------
	
	#print "time :    ".$timestamp."code :    ".$rcodcode." itm :    ".$itmname."<br><br>";
	}
#------------------------------------------------------------------------

#-------------------- Επιστροφή ----------------------------------
			
	$querya="SELECT * FROM rma.sort_reject where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$reject_id=mysql_result($resulta,$i,"id");
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$reject_reason=mysql_result($resulta,$i,"reason");
	$rsn=mysql_result($resulta,$i,"sn");
	$rrmaid=mysql_result($resulta,$i,"rmaid");
		
			#-------------------- Create transactions ----------------------------------
	
	
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rrmaid\",\"$today\",\"Παραλαβή\",\"$userid\",\"Auto\",\"$docid\",\"$docdetails\",\"Ειδική διαχείριση\")";
	$result=mysql_query($query);
	print $query."<br>";
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rrmaid\",\"$today\",\"Τερματισμός\",\"$userid\",\"Auto\",\"\",\"\",\"Να επιστραφεί στον πελάτη. Λόγος επιστροφής $reject_reason\")";
	$result=mysql_query($query);
	print $query."<br>";
	
	#------------------------------------------------------------------------
	
	#print "time :    ".$timestamp."code :    ".$rcodcode." itm :    ".$itmname."<br><br>";
	}
	
	
	$query = " update rma.sort_master set openflag='2' where id='$masterid'";
	$result=mysql_query($query);
	
	
#------------------------------------------------------------------------
?>
</body>
</html>
</BODY>
</html>
