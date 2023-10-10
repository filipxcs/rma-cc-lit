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
require("../../../oracle.php");
require("../../../oracle2.php");
require("../../../oracle_nc1.php");
require("../../../session_check.php");
?>
<body bgcolor=<?php print $colour?>>

<?php 

$company=$_POST['company'];
if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM rmaservice where rmaid = '$_POST[item]' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  leename  like  '$_POST[item]%' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM rmaservice where  codcode like '%$_POST[item]%' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
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
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
else if ($_POST[searchitem] == "5")
{
$query="SELECT * FROM rmaservice where online = '$_POST[item]' AND stageid='1' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "6")
{
$query="SELECT * FROM rmaservice where sn like '%$_POST[item]%'";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block.="<OPTION value=\"$rmaid@@@$pelaths@@@$kodikos_eidous\">($online) ---- ($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "7")
{
$cmdstr = "SELECT DISTINCT DOCID,DOTCODE,DOCNUMBER,TRNDATE,LEENAME FROM Z_RMA_INCOMING_VIEW 
WHERE leename like '$_POST[item]%'
AND trndate>='$_POST[date_return]' ORDER BY TRNDATE";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		$docid=$results["DOCID"][$i];
		$leename=$results["LEENAME"][$i];
		$dotcode=$results["DOTCODE"][$i];
		$docnumber=$results["DOCNUMBER"][$i];
		$trndate=$results["TRNDATE"][$i];
	$display_block.="<OPTION value=\"$docid@@@$dotcode@@@$docnumber@@@$trndate\">($leename) ---- ($docnumber) ---- ($trndate)</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "8" and $_POST[item]<>"")
{
$cmdstr = "Select leename,traid from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%'";
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
	else if ($_POST[searchitem] == "9" and $_POST[item]<>"")
{
$cmdstr = "Select leename,traid from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
		$traid=$results["TRAID"][$i];
		$display_block.="<OPTION value=\"$traid@@@$leename\">$leename</OPTION>";
	}
	}
	else if ($_POST[searchitem] == "10" and $_POST[item]<>"")
{
$cmdstr = "Select leename,traid,tracode from lee,cus where cus.leeid=lee.leeid and leename like '%$_POST[item]%'";
$parsed = ociparse($db_conn1, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
		$traid=$results["TRAID"][$i];
		$tracode=$results["TRACODE"][$i];
		$display_block.="<OPTION value=\"$traid@@@$leename\">$tracode - $leename</OPTION>";
	}
	}
else if ($_POST[searchitem] == "11")
{
$query="SELECT * FROM rmaservice where online = '$_POST[item]' order by rmaid";
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
else if ($_POST[searchitem] == "12" and $_POST[item]<>"")
{
$cmdstr = "Select leename,traid from lee,sup where sup.leeid=lee.leeid and leename like '%$_POST[item]%'";
$parsed = ociparse($db_conn_nc, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		
		$leename=$results["LEENAME"][$i];
		$traid=$results["TRAID"][$i];
		$display_block.="<OPTION value=\"$traid@@@$leename\">$leename</OPTION>";
	}
	}		

if 	($_POST[searchitem] == "7")
{
?>
<FORM  name="form" action="form4.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else if ($_POST['searchitem'] == "8")
{
?>
<FORM  name="form" action="select2.php"  target="_bottom2" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else if ($_POST['searchitem'] == "9")
{
?>
<FORM  name="form" action="select3.php"  target="_bottom2" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else if ($_POST[searchitem] == "10")
{
?>
<FORM  name="form" action="select4.php"  target="_bottom2" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else if ($_POST[searchitem] == "11")
{
?>
<FORM  name="form" action="metafora_form.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}
else if ($_POST['searchitem'] == "12")
{
?>
<FORM  name="form" action="form_credit.php"  target="_main1" method="post">
<SELECT name="ppp" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
<?php 
}


else
{
?>
<FORM name="form"  action="select1.php" target="_bottom2" method="post">
<SELECT name="rma" size="8">
<?php  print $display_block; ?>
</SELECT>
<input name="date_return" type="hidden" value="<?php  print $_POST[date_return]; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;"></FORM>
<?php 
}
?>
</html>
