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
require("../../../session_check.php");
?>
<body bgcolor=<?php print $colour?>>

<?php

if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM rmaservice where rmaid = '$_POST[item]' AND (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  leename  like  '$_POST[item]%' AND (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  codcode like '%$_POST[item]%' AND (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM rmaservice where (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
else if ($_POST[searchitem] == "5")
{
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
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
else if ($_POST[searchitem] == "6")
{
$query="SELECT * FROM rmaservice where online = '$_POST[item]' AND (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "7" and $_POST[item]<>"")
{
$query="SELECT distinct tracode,leename,online FROM rmaservice where  leename  like  '$_POST[item]%' AND (stageid='1' OR stageid='2' OR stageid='3' OR stageid='6') order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $pelaths=mysql_result($result,$i,"leename");
	$online=mysql_result($result,$i,"online");
	$kodikos_pelath=mysql_result($result,$i,"tracode");
	$display_block.="<OPTION value=\"$kodikos_pelath\">($online)($pelaths)</OPTION>";
	}
	}
	if 	($_POST[searchitem] == "7")
{
?>
<FORM  name="form" action="form1.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
<?php
}
else
{			
?>
<FORM name="form"  action="form.php" target="_main1" method="post">
<SELECT name="rmaid" size="8">
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
<?php
}
?>
</html>
