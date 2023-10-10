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

?>
<body bgcolor=<?php print $colour?>>
<?php
$query = " update rma.sort_master set openflag='25' where id='$masterid'";
	$result=mysql_query($query);
$querya="(SELECT id,codcode,sn, '' reason FROM rma.sort_accept a where masterid='$masterid') union (SELECT id,codcode,sn,reason FROM rma.sort_reject where masterid='$masterid')";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	for ($i = 0; $i < $numa; $i++ )
	{
	$rreason=mysql_result($resulta,$i,"reason");
	if ($rreason=="")
	{
	
	$check_radio=$_POST['radio'.$i];
	if ($check_radio=="2")
	{
	$check_id=$_POST['id'.$i];
	$query="SELECT * FROM rma.sort_accept where id='$check_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($xi = 0; $xi < $num; $xi++ )
	{
	$rmciid=mysql_result($result,$xi,"mciid");
	$rcodcode=mysql_result($result,$xi,"codcode");
	$rsn=mysql_result($result,$xi,"sn");
	$rrmaid=mysql_result($result,$xi,"rmaid");
	}
	$query_ch="SELECT * FROM rma.sort_reject where rmaid='$rrmaid'";
	$result_ch=mysql_query($query_ch);
	$num_ch=mysql_numrows($result_ch);
	if ($num_ch==0)
	{
	$query_in="insert into rma.sort_reject values('','$masterid','$rmciid','$rcodcode','$rsn','Όροι','$rrmaid','')";
	print $query_in."<br>";
	$result_in=mysql_query($query_in);
	$query_del="delete from rma.sort_accept where id='$check_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	}
	}
	else if ($check_radio=="3")
		{
	$check_id=$_POST['id'.$i];
	$query="SELECT * FROM rma.sort_accept where id='$check_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($xi = 0; $xi < $num; $xi++ )
	{
	$rmciid=mysql_result($result,$xi,"mciid");
	$rcodcode=mysql_result($result,$xi,"codcode");
	$rsn=mysql_result($result,$xi,"sn");
	$rrmaid=mysql_result($result,$xi,"rmaid");
	}
	$query_ch="SELECT * FROM rma.sort_reject where rmaid='$rrmaid'";
	$result_ch=mysql_query($query_ch);
	$num_ch=mysql_numrows($result_ch);
	if ($num_ch==0)
	{
	$query_in="insert into rma.sort_reject values('','$masterid','$rmciid','$rcodcode','$rsn','Εγγύηση','$rrmaid','')";
	$result_in=mysql_query($query_in);
	print $query_in."<br>";
	$query_del="delete from rma.sort_accept where id='$check_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	}
	}
	else
	{}
	}
	else
	{
	
	$check_radio=$_POST['radio'.$i];
	if ($check_radio=="2")
	{
	$check_id=$_POST['id'.$i];
	$query="SELECT * FROM rma.sort_reject where id='$check_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($xi = 0; $xi < $num; $xi++ )
	{
	$rmciid=mysql_result($result,$xi,"mciid");
	$rcodcode=mysql_result($result,$xi,"codcode");
	$rsn=mysql_result($result,$xi,"sn");
	$rrmaid=mysql_result($result,$xi,"rmaid");
	}
	$query_in="update rma.sort_reject set reason='Όροι' where id='$check_id'";
	print $query_in."<br>";
	$result_in=mysql_query($query_in);
	}
	else if ($check_radio=="3")
		{
	$check_id=$_POST['id'.$i];
	$query="SELECT * FROM rma.sort_reject where id='$check_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($xi = 0; $xi < $num; $xi++ )
	{
	$rmciid=mysql_result($result,$xi,"mciid");
	$rcodcode=mysql_result($result,$xi,"codcode");
	$rsn=mysql_result($result,$xi,"sn");
	$rrmaid=mysql_result($result,$xi,"rmaid");
	}
	$query_in="update rma.sort_reject set reason='Εγγύηση' where id='$check_id'";
	$result_in=mysql_query($query_in);
	print $query_in."<br>";
	}
	else if ($check_radio=="1")
		{
	$check_id=$_POST['id'.$i];
	$query="SELECT * FROM rma.sort_reject where id='$check_id'";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($xi = 0; $xi < $num; $xi++ )
	{
	$rmciid=mysql_result($result,$xi,"mciid");
	$rcodcode=mysql_result($result,$xi,"codcode");
	$rsn=mysql_result($result,$xi,"sn");
	$rrmaid=mysql_result($result,$xi,"rmaid");
	}
	$query_in="insert into rma.sort_accept values('','$masterid','$rmciid','$rcodcode','$rsn','','$rrmaid','','')";
	$result_in=mysql_query($query_in);
	print $query_in."<br>";
	$query_del="delete from rma.sort_reject where id='$check_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	}
	else
	{}
	
	 
	}
	
	if ($check_radio=="4")
	{
	$check_radio=$_POST['radio'.$i];
	$check_id=$_POST['id'.$i];
	$del_code=mysql_result($resulta,$i,"codcode");
	$del_sn=mysql_result($resulta,$i,"sn");
	$query_find="SELECT id FROM rma.sort_detail where masterid='$masterid' and codcode='$del_code' and sn='$del_sn'";
	$result_find=mysql_query($query_find);
	$num_find=mysql_numrows($result_find);
	for ($x_find = 0; $x_find < $num_find; $x_find++ )
	{
	$find_detail_id=mysql_result($result_find,$x_find,"id");
	}
	$query_del="delete from rma.sort_detail where id='$find_detail_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	
	$query_find="SELECT id FROM rma.sort_accept where masterid='$masterid' and codcode='$del_code' and sn='$del_sn'";
	$result_find=mysql_query($query_find);
	$num_find=mysql_numrows($result_find);
	for ($x_find = 0; $x_find < $num_find; $x_find++ )
	{
	$find_accept_id=mysql_result($result_find,$x_find,"id");
	}
	if ($find_accept_id=="")
	{}
	else
	{
	$query_del="delete from rma.sort_accept where id='$find_accept_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	}
	
	$query_find="SELECT id FROM rma.sort_reject where masterid='$masterid' and codcode='$del_code' and sn='$del_sn'";
	$result_find=mysql_query($query_find);
	$num_find=mysql_numrows($result_find);
	for ($x_find = 0; $x_find < $num_find; $x_find++ )
	{
	$find_reject_id=mysql_result($result_find,$x_find,"id");
	}
	
	if ($find_reject_id=="")
	{}
	else
	{
	$query_del="delete from rma.sort_reject where id='$find_reject_id'";
	print $query_del."<br>";
	$result_del=mysql_query($query_del);
	}
	
	print $check_id." - ".$del_code." - ".$del_sn." - Detail : ".$find_detail_id." - Accept : ".$find_accept_id." - Reject : ".$find_reject_id."<br>";
	}
	}
?>
</body>
</html>
</BODY>
</html>
