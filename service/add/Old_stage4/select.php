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
$query="SELECT * FROM sales_stage1 where  id = '$_POST[item]' AND part='2' AND egrisi='1' order by id";
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

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM sales_stage1 where  pelaths  like  '$_POST[item]%' AND part='2' AND egrisi='1' order by id";
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
$query="SELECT * FROM sales_stage1 where  kodikos_eidous  like  '%$_POST[item]%' AND part='2' AND egrisi='1' order by id";
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
$query="SELECT * FROM sales_stage1 where  part='2' AND egrisi='1' order by id";
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
<SELECT name="rma" size="6">
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</form>
</FORM>
</html>
