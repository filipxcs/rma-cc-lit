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
<FORM name="form"  action="update.php" target="_main1" method="post">
<?php

if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='1' AND transactions.date<DATE_ADD(curdate(), INTERVAL -15 DAY) order by rmaservice.rmaid";
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

else if ($_POST[searchitem] == "2")
{
$query="SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='1' AND transactions.date<DATE_ADD(curdate(), INTERVAL -30 DAY) order by rmaservice.rmaid";

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
	else if ($_POST[searchitem] == "3")
{
$query="SELECT * FROM rmaservice,transactions WHERE rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid='1' AND transactions.date<DATE_ADD(curdate(), INTERVAL -60 DAY) order by rmaservice.rmaid";

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
$query="SELECT * FROM rmaservice where stageid='1' order by rmaid";
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
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid\">($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}		
?>
<SELECT name="rmaid" size="8">
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Ακύρωση">
</FORM>
</html>
