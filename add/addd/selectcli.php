<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<body bgcolor="#333333">
<FORM action="addd.php"  target="mainFrame" method=post>
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");

if ($_POST[searchitem] == "1")
{
$query="SELECT * FROM adda where  id = '$_POST[item]' AND part in (3,35) order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$eppl=mysql_result($result,$i,"eppl");
	$date=mysql_result($result,$i,"date");
	$eppl=mysql_result($result,$i,"eppl");
	$codeeid=mysql_result($result,$i,"codeeid");
	$pereid=mysql_result($result,$i,"pereid");
	$techs=mysql_result($result,$i,"techs");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	$display_block.="<OPTION value=\"$id\">($id) ---- ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM adda where  eppl  like  '$_POST[item]%' AND part in (3,35) order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$eppl=mysql_result($result,$i,"eppl");
	$date=mysql_result($result,$i,"date");
	$eppl=mysql_result($result,$i,"eppl");
	$codeeid=mysql_result($result,$i,"codeeid");
	$pereid=mysql_result($result,$i,"pereid");
	$techs=mysql_result($result,$i,"techs");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	$display_block.="<OPTION value=\"$id\">($id) ---- ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM adda where  codeeid  like  '%$_POST[item]%' AND part in (3,35) order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$eppl=mysql_result($result,$i,"eppl");
	$date=mysql_result($result,$i,"date");
	$eppl=mysql_result($result,$i,"eppl");
	$codeeid=mysql_result($result,$i,"codeeid");
	$pereid=mysql_result($result,$i,"pereid");
	$techs=mysql_result($result,$i,"techs");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	$display_block.="<OPTION value=\"$id\">($id) ---- ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}	
else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM adda where  part='3' or part='35' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$eppl=mysql_result($result,$i,"eppl");
	$date=mysql_result($result,$i,"date");
	$eppl=mysql_result($result,$i,"eppl");
	$codeeid=mysql_result($result,$i,"codeeid");
	$pereid=mysql_result($result,$i,"pereid");
	$techs=mysql_result($result,$i,"techs");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	$display_block.="<OPTION value=\"$id\">($id) ---- ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}	
	
?>
<SELECT name="item" size="6">
<? print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</form>
</body>
</html>

