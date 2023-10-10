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
require("../../../oracle1.php");
require("../../../session_check.php");
require("../../date.php");
$userid=$_SESSION["userid"];
$masterid=$_POST['masterid'];
$docid=$_POST['docid'];
$docdetails=$_POST['docdetails'];

?>
<body bgcolor=<?php print $colour?>>
<?php
$query="SELECT traid FROM rma.sort_master where id='$masterid'";
$result=mysql_query($query);
$mtraid=mysql_result($result,0,"traid");
	
$cmdstr = "Select leename,traid from lee,cus where cus.leeid=lee.leeid and traid='$mtraid'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
	}
	
## 	----------   Create Online RMA -------------------

$timestamp=time();
$today=date("Y-m-d");
$query = "insert into rma.zonline values (\"\",\"$timestamp\",\"$mtraid\",\"$today\",\"1\",\"0\",\"cc-lit\")";
$result=mysql_query($query);
$query = "select id from rma.zonline where timestamp='$timestamp' and senid='$mtraid' and type='0'";
$result=mysql_query($query);
$online_id=mysql_result($result,0,"id");

## ------------------------------------------------------	
		
#-------------------- Πίστωση ----------------------------------
			
	$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$accept_id=mysql_result($resulta,$i,"id");
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$price=mysql_result($resulta,$i,"price");
	$rsn=mysql_result($resulta,$i,"sn");
		$cmdstr = "select itmname FROM  STI where  CODCODE='$rcodcode'";
		$parsed = ociparse($db_conn, $cmdstr);
		ociexecute($parsed);
		$nrows = ocifetchstatement($parsed, $results);                                                                   
		for ($ii = 0; $ii < $nrows; $ii++ )
			{
			$itmname=$results["ITMNAME"][$ii];
			}
	#-------------------- Create RmaID ----------------------------------
	
	$timesta=time().$i;
	$query = " INSERT INTO rma.rmamain VALUES (\"\",\"2\",\"$userid\",\"$timesta\")";
	$result=mysql_query($query);
	$query = " SELECT MAX(rmaid) as rmaid FROM rma.rmamain WHERE userid='$userid' AND sessionid='$timesta'";
	$result=mysql_query($query);
	$rmaid=mysql_result($result,0,"rmaid");
	$itemdescription     = preg_replace('/"/', '#', $itmname);
	$query = " INSERT INTO rma.rmaservice VALUES (\"\",\"$rmaid\",\"6\",\"$mtraid\",\"$mtraid\",\"$leename\",\"$rcodcode\",\"$itemdescription\",\"$rsn\",\"$online_id\",\"2\",\"1\",\"2\",\"\",\"\",\"\",\"Bad sectors\",\"\",\"\",\"\",\"\",\"\",\"Δήλωση\",\"cc-lit\")";
	print $query."<br>";
	$result=mysql_query($query);
	$query = " INSERT INTO rma.online VALUES (\"\",\"$online_id\",\"$user\")";
	$result=mysql_query($query);
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rmaid\",\"$today\",\"Δήλωση\",\"$userid\",\"Auto\",\"\",\"\",\"Ειδική διαχείριση\")";
	$result=mysql_query($query);
	if ($mtraid=='18131')
	{
	$query = " INSERT INTO rma.transactions VALUES (\"\",\"$rmaid\",\"$today\",\"Εσωτερικό\",\"$userid\",\"Auto\",\"\",\"\",\"$price Ευρώ.\")";
	$result=mysql_query($query);
	}
	$query = " update rma.sort_accept set rmaid='$rmaid' where id='$accept_id'";
	$result=mysql_query($query);
	#print $query."<br>";
	#------------------------------------------------------------------------
	
	#print "time :    ".$timestamp."code :    ".$rcodcode." itm :    ".$itmname."<br><br>";
	}
#------------------------------------------------------------------------

	$query = " update rma.sort_master set openflag='21',online='$online_id' where id='$masterid'";
	$result=mysql_query($query);
	
	print $online_id."<br>";
#------------------------------------------------------------------------
?>
</body>
</html>
</BODY>
</html>
