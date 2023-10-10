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
<FORM name="form"  action="form.php" target="_main1" method="post">
<?php 
$needle="/";
$day = substr("$_POST[date_return]",0,strpos($_POST[date_return],$needle));
$d1 = substr("$_POST[date_return]",strpos($_POST[date_return],$needle)+1,500);
$month = substr("$d1",0,strpos($d1,$needle));
$year = substr("$d1",strpos($d1,$needle)+1,500);
$date=$year."-".$month."-".$day;

if ($_POST[searchitem] == "1" )
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND transactions_s.rmaid='$_POST[item]' AND transactions_s.kind='Έγκριση' AND date>='$date' order by rmasales.rmaid";
}
else
{
$query="SELECT * FROM rmasales where online='$_POST[item]'";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND rmasales.leename like '$_POST[item]%' AND transactions.kind='Έγκριση' AND date>='$date' order by rmaservice.rmaid";
}
else
{
$query="SELECT * FROM rmasales where leename  like  '$_POST[item]%' order by rmaid";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND rmasales.codcode like '%$_POST[item]%' AND transactions_s.kind='Έγκριση' AND date>='$date' order by rmasales.rmaid";
}
else
{
$query="SELECT * FROM rmasales where codcode like  '%$_POST[item]%' order by rmaid";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "4")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND transactions_s.kind='Έγκριση' AND date>='$date' order by rmasales.rmaid";
}
else
{
$query="SELECT * FROM rmasales order by rmaid";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "5")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND rmasales.sn like '%$_POST[item]%' AND transactions_s.kind='Έγκριση' AND date>='$date' order by rmasales.rmaid";
}
else
{
$query="SELECT * FROM rmasales where sn like '%$_POST[item]%'";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "6")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmasales,transactions_s where rmasales.rmaid=transactions_s.rmaid AND rmasales.stageid='3' AND transactions_s.kind='Έγκριση' AND date>='$date' order by rmasales.rmaid";
}
else
{
$query="SELECT * FROM rmasales where stageid='3'";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
		else if ($_POST[searchitem] == "7")
{
if ($_POST[date_ok]=="1")
{
$query="SELECT * FROM rmaservice,transactions where rmaservice.rmaid=transactions.rmaid AND rmaservice.stageid<'8' AND rmaservice.codcode like '%$_POST[item]%' AND transactions.kind='Έγκριση' AND date>='$date' order by rmaservice.rmaid";
}
else
{
$query="SELECT * FROM rmaservice where stageid<'8' and codcode like '%$_POST[item]%'";
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
	$display_block.="<OPTION value=\"$rmaid\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
?>
<SELECT name="rmaid" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
</html>
