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
<FORM action="select2b.php"  target="_bottom2" method=post>
<?php  

//print $_POST['kodikos_eidous'];
$needle="@@@";
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$d1 = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);
$leename = substr("$d1",0,strpos($d1,$needle));
$masterid = substr("$d1",strpos($d1,$needle)+3,500);

$query="SELECT * FROM rma.sort_master where id='$masterid'";
$result=mysql_query($query);
$openflag=mysql_result($result,0,"openflag");
$label=mysql_result($result,0,"label");
	
if ($openflag=="2")
	{
	$display_block.="<OPTION value=\"accept\">($masterid) ---- ($leename) ---- ($label) ---- (Accepted)</OPTION>";
	$display_block.="<OPTION value=\"reject\">($masterid) ---- ($leename) ---- ($label) ---- (Rejected)</OPTION>";
	}
else if ($openflag=="3")
	{
	$display_block.="<OPTION value=\"reject\">($masterid) ---- ($leename) ---- ($label) ---- (Rejected)</OPTION>";
	}
else if($openflag=="4")
	{
	$display_block.="<OPTION value=\"accept\">($masterid) ---- ($leename) ---- ($label) ---- (Accepted)</OPTION>";
	}
	

?>
<input name="traid" type="hidden" value="<?php  print $traid; ?>">
<input name="leename" type="hidden" value="<?php  print $leename; ?>">
<input name="masterid" type="hidden" value="<?php  print $masterid; ?>">
<input name="date_return" type="hidden" value="<?php  print $_POST['date_return']; ?>">

<SELECT name="ppp" size="8" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
  </body>
</html>
