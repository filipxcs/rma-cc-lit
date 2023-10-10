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
$year=substr($_POST[date_return],6,4);
$month=substr($_POST[date_return],3,2);
$day=substr($_POST[date_return],0,2);
$date=$year."-".$month."-".$day;
$parastatiko_kleisimatos=$_POST[tipos_parastatikou]."-".$_POST[arithmos_parastatikou];
?>
<body bgcolor=<?php print $colour?>>

<?php 


print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>";
$query = "update sales_stage1 set part='4', egrisi='4', parastatiko_kleisimatos='$parastatiko_kleisimatos',date_return='$date' where id=$_POST[id]"; 
$result=mysql_query($query);

#$num=mysql_numrows($result);

mysql_close();
?>
</body>
</html>
</BODY>
</html>

