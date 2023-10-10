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
require("../../../oracle1.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form2.php"  target="_main1" method=post>
<?php  

//print $_POST['kodikos_eidous'];
$needle="@@@";
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$leename = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);

                                                                


	$display_block.="<OPTION value=\"$traid@@@$leename@@@WDC\">Western Digital</OPTION>";
	$display_block.="<OPTION value=\"$traid@@@$leename@@@NEC\">Sony / Nec</OPTION>";
	$display_block.="<OPTION value=\"$traid@@@$leename@@@GEN\">Generic</OPTION>";

?>
<input name="pelaths" type="hidden" value="<?php print $pelaths?>">
<input name="rmaid" type="hidden" value="<?php  print $rmaid; ?>">
<input name="kodikos_pelath" type="hidden" value="<?php print $kodikos_pelath?>">
<input name="kodikos_eidous" type="hidden" value="<?php print $kodikos_eidous?>">
<input name="perigrafh_eidous" type="hidden" value="<?php print $perigrafh_eidous?>">
<SELECT name="ppp" size="8" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
