<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM name="form"  action="select1.php" target="_bottom2" method="post">
<?php

if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM rmaservice where rmaid = '$_POST[item]' order by rmaid";
//$query="SELECT * FROM rmaservice where rmaid = '$_POST[item]' AND stageid<>'9' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  leename  like  '$_POST[item]%' AND stageid<>'9' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  codcode like '%$_POST[item]%' AND stageid<>'9' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM rmaservice where stageid='2' OR stageid='3' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
else if ($_POST[searchitem] == "5"){
	if ($_POST[item]=="")
	{
	$query="SELECT * FROM rmaservice where stageid='6' order by rmaid";
	}
	else 
	{
	$query="SELECT * FROM rmaservice where stageid='6' AND leename  like  '$_POST[item]%' order by rmaid";
	}
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	mysql_close();
	for ($i = 0; $i < $num; $i++ )
	{
		$rmaid=mysql_result($result,$i,"rmaid");
		$pelaths=mysql_result($result,$i,"leename");
		$kodikos_eidous=mysql_result($result,$i,"codcode");
		$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
		}
}elseif ($_POST[searchitem] == "8") {
	# code...
}
?>
<SELECT name="rmaid" size="8">
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
</html>
