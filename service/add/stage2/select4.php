<?php
session_start();
?>
<html>
<head>
<title>Top1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");
require("../../../oracle.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form5.php"  target="_main1" method=post>
<?php 

//print $_POST['kodikos_eidous'];
$needle="@@@";
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$leename = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);


                                                                
$query="SELECT * FROM rma.sort_master where traid='$traid' and openflag='21'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
{
	$masterid=mysql_result($result,$i,"id");
	$query_ac="SELECT rmaid FROM rma.sort_accept where masterid=$masterid order by masterid";
	$result_ac=mysql_query($query_ac);
	$num_ac=mysql_numrows($result_ac);
	if ($num_ac>0)
	{
	$ac_rmaid=mysql_result($result_ac,0,"rmaid");
	}
	$query_se="SELECT online FROM rma.rmaservice where rmaid=$ac_rmaid order by rmaid";
	$result_se=mysql_query($query_se);
	$num_se=mysql_numrows($result_se);
	if ($num_se>0)
	{
	$online=mysql_result($result_se,0,"online");
	}
	$label=mysql_result($result,$i,"label");
	$display_block.="<OPTION value=\"$traid@@@$leename@@@$masterid\">($online) - ($masterid) ---- ($leename) ---- ($label)</OPTION>";
	}

mysql_close();	

?>
<input name="pelaths" type="hidden" value="<?php print $pelaths?>">
<input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
<input name="date_return" type="hidden" value="<?php print $_POST['date_return']; ?>">
<SELECT name="ppp" size="8" >
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
