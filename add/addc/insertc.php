<html>
<head>
<title>adda</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<body bgcolor="#666666">
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");
if ($_POST[partc]=="")
{$partc="0";}
else 
{$partc="1";}
if ($_POST[part]=="2")
{
$query = "UPDATE adda SET part=\"3\",partc=\"$partc\" WHERE id=$_POST[bid]";
$query1 = "INSERT INTO addc VALUES(\"\",\"$_POST[bid]\",\"$_POST[malfun]\",\"$_POST[chact]\",\"$_POST[partact]\",\"$_POST[minchrg]\",\"$_POST[wrkchrg]\",\"$_POST[partchrg]\",\"$_POST[ctechs]\",\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",\"$_POST[fback]\",\"$_POST[tspecs]\")"; 
$result=mysql_query($query);
$result1=mysql_query($query1);
}
else
{
$query = "UPDATE adda SET partc=\"$partc\" WHERE id=$_POST[bid]";
$query1 = "UPDATE addc SET malfun=\"$_POST[malfun]\",chact=\"$_POST[chact]\",partact=\"$_POST[partact]\",minchrg=\"$_POST[minchrg]\",wrkchrg=\"$_POST[wrkchrg]\",partchrg=\"$_POST[partchrg]\",ctechs=\"$_POST[ctechs]\",cdatcour=\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",fback=\"$_POST[fback]\",tspecs=\"$_POST[tspecs]\" WHERE id=$_POST[bid]";
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
