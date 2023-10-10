<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>

<body bgcolor="#333333">
<FORM action="addc.php"  target="mainFrame" method=post>
<?
mysql_connect("192.168.1.5","nick","12345");
mysql_select_db(Express) or die( "Unable to select database");

if ($_POST[searchitem] == "1")
{
$query="SELECT * FROM adda where  id = '$_POST[item]' AND part='2' OR id = '$_POST[item]' AND partc='1' order by id";
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
	$partc=mysql_result($result,$i,"partc");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	if ($partc=="1" )
	{$partc1="Ανοιχτό";}
	else {$partc1="-";}
	$display_block.="<OPTION value=\"$id\">($id) - ($partc1) - ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM adda where  eppl  like  '$_POST[item]%' AND part='2' OR eppl  like  '$_POST[item]%' AND partc='1'   order by id";
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
	$partc=mysql_result($result,$i,"partc");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	if ($partc=="1" )
	{$partc1="Ανοιχτό";}
	else {$partc1="-";}
	$display_block.="<OPTION value=\"$id\">($id) - ($partc1) - ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM adda where  codeeid  like  '%$_POST[item]%' AND part='2' OR codeeid  like  '%$_POST[item]%' AND partc='1' order by id";
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
	$partc=mysql_result($result,$i,"partc");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	if ($partc=="1" )
	{$partc1="Ανοιχτό";}
	else {$partc1="-";}
	$display_block.="<OPTION value=\"$id\">($id) - ($partc1) - ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
	}
	}	
else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM adda where  part='2' OR partc='1' order by id";
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
	$partc=mysql_result($result,$i,"partc");
	if ($techs=="1" or  $techs=="9" or $techs=="10")
	{$techs1="Αθήνα";}
	else {$techs1="Θεσ/νίκη";}
	if ($partc=="1" )
	{$partc1="Ανοιχτό";}
	else {$partc1="-";}
	$display_block.="<OPTION value=\"$id\">($id) - ($partc1) - ($techs1)---- ($eppl) --- ($codeeid)</OPTION>";
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

