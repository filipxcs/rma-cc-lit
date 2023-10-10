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
require("../../../oracle_nc.php");
$userid=$_SESSION["userid"];
$date_paralavh=date("Y-m-d");
$this_day=date("d/m/Y");
$docdetails=$_POST['docdetails'];
$docid=$_POST['docid'];
$masterid=$_POST['masterid'];
$error="0";
$qtya_counter="1";
$insert="1";
$error_report="";

?>
<body bgcolor=<?php print $colour?>>

<?php





	$batch_data="";
	$today=date("Y-m-d");
	$total=$_POST["batch_data"];
	$keyarr=explode("\n",$total);
	$error_lines="";
	$line=0;

foreach($keyarr  as  $key=>$value)
{
   //  becareful to check the value for  empty line 
   
   $value=trim($value);

   $needle=";";
   $needle1="-";
	$bcodcode  = substr($value,0,strpos($value,$needle));
	
	# Κανω check τον Κωδικο για την παυλα (-)	
	$pos = strpos($bcodcode, $needle1);
	if ($pos === false) {
     $check_code=$bcodcode;
} else {
$check_code=substr($bcodcode,0,strpos($bcodcode,$needle1));
}

	#$check_code=substr($bcodcode,7,30);
	

	
	$second_part = substr($value,strpos($value,$needle)+1,500);
	$qty = abs(substr($second_part,0,strpos($second_part,$needle)));
	$third_part=substr($second_part,strpos($second_part,$needle)+1,500);
	$uprice = substr($third_part,0,strpos($third_part,$needle));
	$fourth_part = substr($third_part,strpos($third_part,$needle)+1,500);
	$invoice = substr($fourth_part,0,strpos($fourth_part,$needle));
	$invoice_date = substr($fourth_part,strpos($fourth_part,$needle)+1,500);

	
	
	
	
	
	
	$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3) in ('WDC') and substr(codcode,8,30)='$check_code'";
	
$parsed = ociparse($db_conn, $cmdstr);   
ociexecute($parsed);                                                              
$nrows = ocifetchstatement($parsed, $results);

for ($i = 0; $i < $nrows; $i++ )
	{
		$mciid=$results["MCIID"][$i];
		$codcode=$results["CODCODE"][$i];
	}	
$post_code=$codcode;

	#print $value."+".$check_code." and ".$bserial."--".$error_lines."<br>";
	#print $bcodcode." and ".$bserial." and ".$bproblem." and ".$nrows."<br>";
		
	
	if ($qty=="")
	{
	$insert="0";
	$ins_problem="Δεν δόθηκε ποσότητα";
	$problem_line=$line;
	}
	if ($uprice=="")
	{
	$insert="0";
	$ins_problem="Δεν δόθηκε τιμή";
	$problem_line=$line;
	}
	if ($invoice=="")
	{
	$insert="0";
	$ins_problem="Κενό invoice";
	$problem_line=$line;
	}
	if ($invoice_date=="")
	{
	$insert="0";
	$ins_problem="Κενό invoice_date";
	$problem_line=$line;
	}
	if ($nrows=="")
	{
	$insert="0";
	$ins_problem="Δεν βρέθηκε ο κωδικός του είδους";
	$problem_line=$line;
	}
	if ($insert=="1")
	{
	
	
	for ($ii = 0; $ii < $qty; $ii++ )
	{
		$query_in="insert into rma.credit_detail values('','$masterid','$mciid','$post_code','1','$uprice','$invoice','$invoice_date')";
	 	$result_in=mysql_query($query_in);
	}
	
	print ($line+1)." : OK!<br>";
	}
	else
	{
	print ($line+1)." : ERROR! ".$ins_problem."<br>";
	$error_report .= ($line+1)." : ".$value."<br>";
	}
						
	$line++;
	$insert="1";
}
if ($error_report != "")
{
print "<br><br>";
print "Γραμμές με λάθη.<br>";
print $error_report;
}

print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>";
mysql_close();
?>
</body>
</html>
</BODY>
</html>

