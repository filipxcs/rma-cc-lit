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

<?php 

if ($_POST[searchitem] == "1" )
{
$query="select * from rma.zonline where status='0' and type='0'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	$id=mysql_result($result,$i,"id");
	$cmp=mysql_result($result,$i,"cmp");
	if ($cmp=='cc-lit')
	{$company='CC-LIT';}
	else if ($cmp=='nc')
	{$company='NC';}
	else
	{$company='Online';}
	
	$query1="select leename from rma.zonlinerma where online='$id'";
	$result1=mysql_query($query1);
	$leename=mysql_result($result1,0,"leename");
	$senid=mysql_result($result,$i,"senid");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($leename) - ($company)</OPTION>";
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

else if ($_POST[searchitem] == "3" )  ####### AYTO TREXEI  #############
{
$query="select * from rma.rma_online where status='0'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	$id=mysql_result($result,$i,"id");
	$cmp=mysql_result($result,$i,"cmp");
	if ($cmp=='1')
	{$company='Netconnect';}
	else if ($cmp=='2')
	{$company='Pcshop';}
	else
	{}
	
	$query1="select leename from rma.rma_onlinerma where online='$id'";

	$result1=mysql_query($query1);
	$leename=mysql_result($result1,0,"leename");
	$senid=mysql_result($result,$i,"senid");
	$display_block.="<OPTION value=\"$id\">($id) ---- ($leename) - ($company)</OPTION>";
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
if 	($_POST[searchitem] == "1")
{
?>
<FORM action="form.php"  target="_main1" method=post>
<SELECT name="rma" size="6">
<?php  print $display_block; ?>
</SELECT>
<input name="company" type="hidden" value="<?php  print $cmp; ?>">
<input name="submit" type="submit" value="Επιλογή">
</form>
</FORM>
<?php 
}
else if ($_POST['searchitem'] == "3")
{
?>
<FORM action="form1.php"  target="_main1" method=post>
<SELECT name="rma" size="6">
<?php  print $display_block; ?>
</SELECT>
<input name="cmp" type="hidden" value="<?php  print $cmp; ?>">
<input name="company" type="hidden" value="<?php  print $company; ?>">
<input name="submit" type="submit" value="Επιλογή">
</form>
</FORM>
<?php 
}	
?>

</html>
