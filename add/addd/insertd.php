<html>
<head>
<title>adda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<body bgcolor="#666666">
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
if ($_POST[slins]>="1")
{
$query = "UPDATE adda SET part=\"4\" WHERE id=$_POST[bid]";
$query1 = "UPDATE addd SET ddatcour=\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",d1datcour=\"$_POST[datcourY1]-$_POST[datcourM1]-$_POST[datcourD1] \",minchrg=\"$_POST[minchrg]\",wrkchrg=\"$_POST[wrkchrg]\",partchrg=\"$_POST[partchrg]\",dtechs=\"$_POST[dtechs]\",da=\"$_POST[da]\",dspecs=\"$_POST[dspecs]\"  WHERE id=$_POST[bid]";
$result=mysql_query($query);
$result1=mysql_query($query1);
}
else 
{
if ($_POST[da]=="")
{
$query = "UPDATE adda SET part=\"35\" WHERE id=$_POST[bid]";
}
else
{
$query = "UPDATE adda SET part=\"4\" WHERE id=$_POST[bid]";
}
$query1 = "INSERT INTO addd VALUES(\"\",\"$_POST[bid]\",\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",\"$_POST[datcourY1]-$_POST[datcourM1]-$_POST[datcourD1] \",\"$_POST[minchrg]\",\"$_POST[wrkchrg]\",\"$_POST[partchrg]\",\"$_POST[dtechs]\",\"$_POST[da]\",\"$_POST[dspecs]\")";
$result=mysql_query($query);
$result1=mysql_query($query1);
}

mysql_close();

?>


<font size="5"><Center>
  Έγινε καταχώρηση
</Center></font>
</body>
</html>
