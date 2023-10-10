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
$today=date("Y-m-d");
$userid=$_SESSION["userid"];
$masterid=$_POST['masterid'];
$docid=$_POST['docid'];
$docdetails=$_POST['docdetails'];
$outgoing_choice=$_POST['outgoing_choice'];
?>
<body bgcolor=<?php print $colour?>>
<?php
$query="SELECT openflag FROM rma.sort_master where id='$masterid'";
$result=mysql_query($query);
$openflag=mysql_result($result,0,"openflag");
	

	

if ($outgoing_choice=="accept")
{	
#-------------------- Πίστωση ----------------------------------
			
	$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rmaid=mysql_result($resulta,$i,"rmaid");

	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rmaid\",\"$today\",\"Αποστολή\",\"$userid\",\"Auto\",\"$docid\",\"$docdetails\",\"Ειδική διαχείριση\")";
	$result=mysql_query($query);
	$query = " update rma.rmaservice set stageid='8' where rmaid='$rmaid'";
	$result=mysql_query($query);
		
	if ($openflag=="2")
	{
	$query = " update rma.sort_master set openflag='3' where id='$masterid'";
	$result=mysql_query($query);
	}
	else if ($openflag=="4")
	{
	$query = " update rma.sort_master set openflag='5' where id='$masterid'";
	$result=mysql_query($query);
	}
	#print $query."<br>";
	#------------------------------------------------------------------------
	
	#print "rmaid :    ".$rmaid."  query : ".$query."<br>";
	}
#------------------------------------------------------------------------
}
else if ($outgoing_choice=="reject")
{
#-------------------- Επιστροφή ----------------------------------
			
	$querya="SELECT * FROM rma.sort_reject where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$qty=$numa;
	if ($qty>'0')
	{
	for ($i = 0; $i < $numa; $i++ )
	{
	$rmaid=mysql_result($resulta,$i,"rmaid");
	#-------------------- Create RmaID ----------------------------------
	
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rmaid\",\"$today\",\"Αποστολή\",\"$userid\",\"Auto\",\"$docid\",\"$docdetails\",\"Ειδική διαχείριση\")";
	$result=mysql_query($query);
	$query = " update rma.rmaservice set stageid='8' where rmaid='$rmaid'";
	$result=mysql_query($query);
			
	if ($openflag=="2")
	{
	$query = " update rma.sort_master set openflag='4' where id='$masterid'";
	$result=mysql_query($query);
	}
	else if ($openflag=="3")
	{
	$query = " update rma.sort_master set openflag='5' where id='$masterid'";
	$result=mysql_query($query);
	}
	#------------------------------------------------------------------------
	#print "rmaid :    ".$rmaid."  query : ".$query."<br>";
	
	}
	}
	else
	{
	if ($openflag=="2")
	{
	$query = " update rma.sort_master set openflag='4' where id='$masterid'";
	$result=mysql_query($query);
	}
	else if ($openflag=="3")
	{
	$query = " update rma.sort_master set openflag='5' where id='$masterid'";
	$result=mysql_query($query);
	}
	}
	
}	
	
	print "Εγινε αποστολή για ".$qty." RMA";
	
#------------------------------------------------------------------------
?>
</body>
</html>
</BODY>
</html>
