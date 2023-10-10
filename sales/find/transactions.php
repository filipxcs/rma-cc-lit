<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
  return false;
}
//-->
</script>
<title>Untitled Document</title>
</head>
<?php 
require("../../params.php");
require("../../mysql.php");
?>
<body bgcolor=<?php print $colour?>>
<?php 
$query="SELECT transid,date_format(date,'%d-%c-%Y')AS 'trans_date',kind FROM transactions_s where rmaid=$rmaid order by rmaid,transid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	$transid=mysql_result($result,$i,"transid");
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");

print $trans_date." - "."<a href=\"javascript:;\" 
onclick=\"MM_openBrWindow('transactions_view.php?rmaid=$rmaid&transid=$transid','','scroll=no, top=200, left=0, width=800, height=280')\">$kind</a>";
print "<br>";	
	
}
?>

</body>
</html>
