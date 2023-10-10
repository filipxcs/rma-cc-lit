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
$query="SELECT chargeid,date_format(date,'%d-%c-%Y')AS 'charge_date',value FROM charges where rmaid=$rmaid order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	$chargeid=mysql_result($result,$i,"chargeid");
    $charge_date=mysql_result($result,$i,"charge_date");
	$value=mysql_result($result,$i,"value");

print $charge_date." - "."<a href=\"javascript:;\" 
onclick=\"MM_openBrWindow('charges_view.php?rmaid=$rmaid&chargeid=$chargeid','','scroll=no, top=200, left=370, width=400, height=150')\">$value</a>";
print "<br>";	
	
}
?>

</body>
</html>
