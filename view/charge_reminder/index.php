<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>charge reminder</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<?php
require("params.php");
require("mysql.php");

$date=date("Y-m-d");

?>

<body bgcolor=<?php print $colour?>>

<FORM name="form"  action="send.php"  method="post">
<table border="1">
  <tbody>
 
   
<?php
$query="SELECT rmaid,date_format(date,'%d/%c/%Y')AS 'chargedate' FROM `charges` WHERE date<'$date' and status=0 order by date";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	$rmaid=mysql_result($result,$i,"rmaid");
	$query_name="SELECT leename,codcode,tracode,online,company FROM rmaservice where rmaid='$rmaid'";
	$result_name=mysql_query($query_name);
	$leename=mysql_result($result_name,0,"leename");
	$codcode=mysql_result($result_name,0,"codcode");
	$traid=mysql_result($result_name,0,"tracode");
	$online=mysql_result($result_name,0,"online");
	$company=mysql_result($result_name,0,"company");
	
	if ($company=='cc-lit' || $company=='CC-Lit.S.A.')
	{
	$query_item="SELECT email FROM rma.rma_sen_ids where cc_id='$traid';";
	$result_item=mysql_query($query_item);
	$email=mysql_result($result_item,0,"email");
	}
	else
	{
	$query_item="SELECT email FROM rma.rma_sen_ids where cc_net_id='$traid';";
	$result_item=mysql_query($query_item);
	$email=mysql_result($result_item,0,"email");
	}
		
	$date=mysql_result($result,$i,"chargedate");
	print "<tr><td>$online</td><td>$leename</td><td>$codcode</td><td>$email</td><td>$date</td><td>$company</td><td>$query_name</td></tr>";
	
		### ------ Send email

	

	}
?>
    
    </tbody>
</table>


</form>
</body>


</html>

