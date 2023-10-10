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
$userid=$_SESSION["userid"];
$date_paralavh=date("Y-m-d");
$docdetails=$_POST['docdetails'];
$docid=$_POST['docid'];
$error="0";
$qtya_counter="1";
?>
<body bgcolor=<?php print $colour?>>

<?php





 	$selections=$_POST['selections'];
	if ($selections){
	 foreach ($selections as $t)
	 {
	 $needle="@";
	 $docnumber = substr($t,0,strpos($t,$needle));
	 $part2 = substr($t,strpos($t,$needle)+1,500);
	 $qtya = substr($part2,0,strpos($part2,$needle));
	 $rmaid = substr($part2,strpos($part2,$needle)+1,500);
	 if ($docnumber==$comp_docnumber)
	 {$qtya_counter++;
	 if ($qtya_counter<=$qtya)
	 {}
	 else
	 {$error="1";}
	 
	 }
	 else
	 {
	 $comp_docnumber=$docnumber;
	 $qtya_counter="1";
	 }
	 print $docnumber." : ".$comp_docnumber." : ".$qtya_counter."<br>";
	 }
	}
	




  if ($error=="0")
  {
	if ($selections){
	 foreach ($selections as $t)
	 {
	 $needle="@";
	 $docnumber = substr($t,0,strpos($t,$needle));
	 $part2 = substr($t,strpos($t,$needle)+1,500);
	 $qtya = substr($part2,0,strpos($part2,$needle));
	 $query = "INSERT INTO transactions VALUES (\"\",\"$rmaid\",\"$date_paralavh\",\"Αποστολή\",\"$userid\",\"\",\"$docid\",\"$docdetails\",\"\")";
	 $result=mysql_query($query);
	 print $query."<br>";
	 $query = " UPDATE rmaservice set stageid=8 where rmaid = '$rmaid'";
	 $result=mysql_query($query);
	 }
	}

print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>";
}
else
{
print "<font size=\"5\"><Center>
  <p>Λάθος</p>";
}  
mysql_close();
?>
</body>
</html>
</BODY>
</html>

