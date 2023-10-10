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
$userid=$_SESSION["userid"];
$date_paralavh=date("Y-m-d");
$this_day=date("d/m/Y");
$docdetails=$_POST['docdetails'];
$docid=$_POST['docid'];
$masterid=$_POST['masterid'];
$docdetails=$_POST['docdetails'];
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
	$bcodcode = substr($value,0,strpos($value,$needle));
	
	
	#$check_code=substr($bcodcode,7,30);
	$pos = strpos($bcodcode, $needle1);
	if ($pos === false) {
     $check_code=$bcodcode;
} else {
$check_code=substr($bcodcode,0,strpos($bcodcode,$needle1));
  
}

	
	$second_part = substr($value,strpos($value,$needle)+1,500);
	$bserial = substr($second_part,0,strpos($second_part,$needle));
	$third_part=substr($second_part,strpos($second_part,$needle)+1,500);
	$bproblem = substr($third_part,0,strpos($third_part,$needle));
	$in_price = substr($third_part,strpos($third_part,$needle)+1,500);
	
	# Βγάζω το δολλάριο.
	
	$price_usd=substr($in_price,0, 50);
	
	
	$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3) in ('WDC','NEC','SNO','ASR') and substr(codcode,8,30)='$check_code'";
$parsed = ociparse($db_conn, $cmdstr);   
ociexecute($parsed);                                                              
$nrows = ocifetchstatement($parsed, $results);
for ($i = 0; $i < $nrows; $i++ )
	{
		$mciid=$results["MCIID"][$i];
		$codcode=$results["CODCODE"][$i];
	}	
$post_code=$codcode;

$cmdstr1 = "select * from eqv where eqvdate='$this_day' and curid='500'";
$parsed1 = ociparse($db_conn, $cmdstr1);   
ociexecute($parsed1);                                                              
$nrows1 = ocifetchstatement($parsed1, $results1);
for ($i = 0; $i < $nrows1; $i++ )
	{
		$fixing=$results1["EQVFIXING"][$i];
		
	}
	$fixing = preg_replace('/\,/', '.', $fixing);		

$price_change=bcmul($price_usd, $fixing, 2);
$price=bcsub($price_change,1,2);

	#print $value."+".$check_code." and ".$bserial."--".$error_lines."<br>";
	#print $bcodcode." and ".$bserial." and ".$bproblem." and ".$nrows."<br>";
	$queryt="SELECT * FROM rma.sort_detail where sn='$bserial' and masterid='$masterid'";
	$resultt=mysql_query($queryt);
	$numt=mysql_numrows($resultt);
	if ($numt!="0")
	{
	$insert="0";
	$ins_problem="Αυτός ο σειριακός αριθμός έχει καταχωρηθεί ξανά.";
	$problem_line=$line;
	}			
	if ($bserial=="")
	{
	$insert="0";
	$ins_problem="Κενός Σειριακός";
	$problem_line=$line;
	}
	if ($nrows=="")
	{
	$insert="0";
	$ins_problem="Δεν βρέθηκε ο κωδικός του είδους";
	$problem_line=$line;
	}
	if ($bproblem!="accept" && $bproblem!="Εγγύηση" && $bproblem!="Όροι")
	{
	$insert="0";
	$ins_problem="Λάθος περιγραφή.";
	$problem_line=$line;
	}
	if ($insert=="1")
	{
	if ($bproblem=="accept")
	{
		$query_in="insert into rma.sort_accept values('','$masterid','$mciid','$post_code','$bserial','$price','','','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$bserial','$price','','','','')";
		$result_in=mysql_query($query_in);
	}
	else if ($bproblem=="Εγγύηση")
	{
		$query_in="insert into rma.sort_reject values('','$masterid','$mciid','$post_code','$bserial','Εγγύηση','','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$bserial','Εγγύηση','','','')";
		$result_in=mysql_query($query_in);
	}
	else if ($bproblem=="Όροι")
	{
		$query_in="insert into rma.sort_reject values('','$masterid','$mciid','$post_code','$bserial','Όροι','','')";
		$result_in=mysql_query($query_in);
		$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$bserial','Όροι','','','')";
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

