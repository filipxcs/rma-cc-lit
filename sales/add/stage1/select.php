<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php 
require("../../../params.php");
require("../../../mysql.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php 

if ($_POST[searchitem] == "1" )
{
$query="select * from rma.zonline where status='0' and type='1'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	$id=mysql_result($result,$i,"id");
	$query1="select leename from rma.zonlinerma_s where online='$id'";
	$result1=mysql_query($query1);
	$leename=mysql_result($result1,0,"leename");
	$senid=mysql_result($result,$i,"senid");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($leename)</OPTION>";
	}
	$query="SELECT * FROM rma.rmasales where stageid='6' order by rmaid";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$online=mysql_result($result,$i,"online");
	$pelaths=mysql_result($result,$i,"leename");
	$kodikos_eidous=mysql_result($result,$i,"codcode");
	$display_block1.="<OPTION value=\"$rmaid\">($online)/($rmaid) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM sales_stage1 where  pelaths  like  '$_POST[item]%' AND part='3' AND egrisi='2' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
        $id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM sales_stage1 where  kodikos_eidous  like  '%$_POST[item]%' AND part='3' AND egrisi='2' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}

else if ($_POST[searchitem] == "4")
{
$query="SELECT * FROM sales_stage1 where part='3' AND egrisi='2' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
{
	$id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($pelaths) ---- ($kodikos_eidous)</OPTION>";
	}
	}	
	
?>
<table><tr><td>Νέες αιτήσεις</td><td>Επιστροφές απο αποθήκη</td></tr><tr><td valign=top>
<SELECT name="rma" size="4">
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</form>
</td><td td valign=top>
<FORM action="form1.php"  target="_main1" method=post>
	<SELECT name="rmaid" size="4">
<?php  print $display_block1; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM></td>
</tr>
</table>
</html>
