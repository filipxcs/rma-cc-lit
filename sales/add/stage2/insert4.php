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
	$pallet_id = substr($value,0,strpos($value,$needle));
	
	
	#$check_code=substr($bcodcode,7,30);
	

	
	$second_part = substr($value,strpos($value,$needle)+1,500);
	$package_id = substr($second_part,0,strpos($second_part,$needle));
	$third_part=substr($second_part,strpos($second_part,$needle)+1,500);
	$bserial = substr($third_part,0,strpos($third_part,$needle));
	$fourth_part = substr($third_part,strpos($third_part,$needle)+1,500);
	$bcodcode = substr($fourth_part,0,strpos($fourth_part,$needle));
# Κανω check τον Κωδικο για την παυλα (-)	
	$pos = strpos($bcodcode, $needle1);
	if ($pos === false) {
     $check_code=$bcodcode;
} else {
$check_code=substr($bcodcode,0,strpos($bcodcode,$needle1));
  
}
	
	$fifth_part = substr($fourth_part,strpos($fourth_part,$needle)+1,500);
	$pickslp = substr($fifth_part,0,strpos($fifth_part,$needle));
	$order_id = substr($fifth_part,strpos($fifth_part,$needle)+1,500);
	
	
	
/**
 * Προσθήκη κωδικού είδους στην εισαγωγή σειριακών στο RMA πωλήσεων-> Εισαγωγή-> Παραλαβή-> Orders.
 */
$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3) in ('WDC','NEC','SNO','ASR','KYE','PLD','VWS','SND','HGS','HKV', 'INN','ACR','DRY') and substr(codcode,8,30)='$check_code'";
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
	$queryt="SELECT * FROM rma.order_detail where sn='$bserial' and masterid='$masterid'";
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
	if ($pallet_id=="")
	{
	$insert="0";
	$ins_problem="Κενό Pallet ID";
	$problem_line=$line;
	}
	if ($package_id=="")
	{
	$insert="0";
	$ins_problem="Κενό Package_ID";
	$problem_line=$line;
	}
	if ($pickslp=="")
	{
	$insert="0";
	$ins_problem="Κενό pickslp";
	$problem_line=$line;
	}
	if ($order_id=="")
	{
	$insert="0";
	$ins_problem="Κενό order_ID";
	$problem_line=$line;
	}
	if ($nrows=="")
	{
	$insert="0";
	$ins_problem="Δεν βρέθηκε ο κωδικός του είδους".$cmdstr;
	$problem_line=$line;
	}
	if ($insert=="1")
	{
	
	
	
		$query_in="insert into rma.order_detail values('','$masterid','$mciid','$post_code','$bserial','','','','$order_id','$pallet_id','$package_id','$pickslp')";
	 	$result_in=mysql_query($query_in);
	
	
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

