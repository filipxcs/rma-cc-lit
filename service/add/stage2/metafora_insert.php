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
$rmaid=$_POST['rmaid'];
$online=$_POST['online'];
$new_online=$_POST['new_online'];
$dialogh_status=$_POST['dialogh_status'];


?>
<body bgcolor=<?php print $colour?>>
<?php
 $query="SELECT * FROM rma.rmaservice where online='$new_online'";
 $result=mysql_query($query);
 $num=mysql_numrows($result);
if ($num=='0' || $new_online=='')
   {print "Δεν υπάρχει το νέο Online RMA";}
   else
   {
   $query1="SELECT codcode,sn FROM rmaservice where rmaid='$rmaid'";
   $result1=mysql_query($query1);
   $num1=mysql_numrows($result1);

    for ($i = 0; $i < $num1; $i++ )
	{
	
    $codcode=mysql_result($result1,$i,"codcode");
	$sn=mysql_result($result1,$i,"sn");
    }
	$cmdstr = "select mciid from sti where codcode='$codcode'";
	$parsed = ociparse($db_conn, $cmdstr);   
	ociexecute($parsed);                                                              
	$nrows = ocifetchstatement($parsed, $results);
	for ($i = 0; $i < $nrows; $i++ )
	{
		$mciid=$results["MCIID"][$i];
	}	
	
	
	$query_mas="SELECT id FROM rma.sort_master where online='$online'";
    $result_mas=mysql_query($query_mas);
    $masterid=mysql_result($result_mas,0,"id");
	$query_mas="SELECT id FROM rma.sort_master where online='$new_online'";
    $result_mas=mysql_query($query_mas);
    $new_masterid=mysql_result($result_mas,0,"id");
	
    
	$query_del="delete from rma.sort_detail where sn='$sn' and masterid='$masterid'";
	$result_del=mysql_query($query_del);
	$query_del="delete from rma.sort_accept where sn='$sn' and masterid='$masterid'";
	$result_del=mysql_query($query_del);
	$query_del="delete from rma.sort_reject where sn='$sn' and masterid='$masterid'";
	$result_del=mysql_query($query_del);
	$query_price="select price from rma.sort_detail where sn='$sn' and masterid='$masterid'";
	$result_price=mysql_query($query_price);
	$price=mysql_result($result_price,0,"price");
	if ($dialogh_status=='1')
	{
		$query_in="insert into rma.sort_accept values('','$new_masterid','$mciid','$codcode','$sn','$price','$rmaid','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$new_masterid','$mciid','$codcode','$sn','$price','','')";
		$result_in=mysql_query($query_in);
	}
	else if ($dialogh_status=='2')
	{
		$query_in="insert into rma.sort_reject values('','$new_masterid','$mciid','$codcode','$sn','Εγγύηση','$rmaid','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$new_masterid','$mciid','$codcode','$sn','Εγγύηση','')";
		$result_in=mysql_query($query_in);
	}
	else if ($dialogh_status=='3')
	{
		$query_in="insert into rma.sort_reject values('','$new_masterid','$mciid','$codcode','$sn','Όροι','$rmaid','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$new_masterid','$mciid','$codcode','$sn','Όροι','')";
		$result_in=mysql_query($query_in);
	}
	#print $codcode." - ".$sn." - ".$mciid." - ".$masterid." - ".$new_masterid."<br>";
	#print $query_del." <br> ".$query_del1."<br>".$query_del2."<br>";
	#print $query_in." <br> ".$query_in1."<br>";
	
	print "Έγινε μεταφορά του ".$codcode." σειριακός αριθμός ".$sn." με rma ".$rmaid." απο την διαλογή ".$masterid." του online RMA ".$online." στην διαλογή ".$new_masterid." με online RMA ".$new_online;
	
	
	
	
   }

?>
</body>
</html>
</BODY>
</html>
