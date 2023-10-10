<?php 
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
</head>
<?php 
require("../../../params.php");
require("../../../mysql.php");
require("../../../oracle2.php");
require("../../../session_check_s.php");
?>
<body bgcolor=<?php print $colour?>>

<?php 

if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM rmasales where online = '$_POST[item]' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM rmasales where  leename  like  '$_POST[item]%' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM rmasales where  codcode like '%$_POST[item]%' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM rmasales where stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
else if ($_POST[searchitem] == "5" and $_POST[item]<>"")
{
$cmdstr = "Select leename,traid from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%' and tracode like '%-0-%'";
$parsed = ociparse($db_conn1, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
		$traid=$results["TRAID"][$i];
		$display_block.="<OPTION value=\"$traid@@@$leename\">$leename</OPTION>";
	}
	}
else if ($_POST[searchitem] == "6" and $_POST[item]<>"")
{
#$cmdstr = "Select leename,traid from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%' and tracode like '%-0-%'";
$cmdstr = "Select leename,traid,(select curshortname from cur where cur.curid=cus.curid) as curr from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%' and tracode like '%-0-%'";
$parsed = ociparse($db_conn1, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
		$traid=$results["TRAID"][$i];
		$curr=$results["CURR"][$i];
		$display_block.="<OPTION value=\"$traid@@@$leename\">$leename - $curr</OPTION>";
	}
	}	
if 	($_POST[searchitem] == "5")
{
?>
<FORM  name="form" action="form2.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else
if 	($_POST[searchitem] == "6")
{
?>
<FORM  name="form" action="form3.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else
{			
?>
<FORM name="form"  action="select1.php" target="_bottom2" method="post">
<SELECT name="rma" size="6">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
?>
</html>
