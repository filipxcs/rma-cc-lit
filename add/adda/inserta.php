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
$query = "INSERT INTO adda VALUES(\"\",\"$fdate\",\"$_POST[techs]\",\"$_POST[eppl]\",\"$_POST[whopl]\",\"$_POST[codeeid]\",\"$_POST[pereid1]\",\"$_POST[snnb]\",\"$_POST[failr]\",\"$_POST[failrtext]\",\"$_POST[minchrg]\",\"$_POST[wrkchrg]\",\"$_POST[partchrg]\",\"$_POST[DOA]\",\"$_POST[guar]\",\"$_POST[ypx]\",\"$_POST[dothl]\",\"$_POST[datcourY]-$_POST[datcourM]-$_POST[datcourD] \",\"$_POST[cour]\",\"$_POST[specs]\",\"1\",\"0\")"; 
$result=mysql_query($query);
//$query0="SELECT count(id) FROM  adda";
$query1="SELECT id,eppl,codeeid FROM adda order by id desc";
//$result0=mysql_query($query0);
$result1=mysql_query($query1);
$num1=mysql_numrows($result1);
for ($i = 0; $i < 5; $i++ )
	{
    $id=mysql_result($result1,$i,"id");
	$eppl=mysql_result($result1,$i,"eppl");
	$codeeid=mysql_result($result1,$i,"codeeid");
	$display_block.="<OPTION value=\"$id\">($id) --- ($eppl) --- ($codeeid)</OPTION>";
	}

//$count=mysql_result($result0,0,"count(id)")-1;
//$id=mysql_result($result1,$count,"id"); 
mysql_close();
?>


<font size="5"><Center>
  <p>Έγινε καταχώρηση </p>
  <select name="express" size="5">
  <? print $display_block; ?> 
 </select>
</Center></font>
</body>
</html>
