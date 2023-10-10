<html>
<head>
<title>adda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<body bgcolor="#666666">
<?
$fdate=date("Y-m-d");
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
$query = "UPDATE adda SET part=\"2\" WHERE id=$_POST[bid]";
$query1 = "INSERT INTO addb VALUES(\"\",\"$_POST[bid]\",\"$_POST[bDOA]\",\"$_POST[bguar]\",\"$_POST[bypx]\",\"$_POST[btechs]\",\"$_POST[dp]\",\"$_POST[pack]\",\"$_POST[extra]\",\"$_POST[extrams]\",\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",\"$_POST[minchrg]\",\"$_POST[wrkchrg]\",\"$_POST[partchrg]\",\"$_POST[bspecs]\")"; 
$result=mysql_query($query);
$result1=mysql_query($query1);
mysql_close();
?>


<font size="5"><Center>
  Έγινε καταχώρηση
</Center></font>
</body>
</html>
