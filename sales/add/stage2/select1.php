<?php php 
session_start();
?>
<html>
<head>
<title>Top1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php php 
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check_s.php");
require("../../../oracle.php");
?>
<body bgcolor=<?php php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php php  

$needle="@@@";
$rmaid = substr("$_POST[rma]",0,strpos($_POST[rma],$needle));
$d1 = substr("$_POST[rma]",strpos($_POST[rma],$needle)+3,500);
$pelaths = substr("$d1",0,strpos($d1,$needle));
$kodikos_eidous = substr("$d1",strpos($d1,$needle)+3,500);

 $cmdstr = "SELECT * FROM Z_RMA_INCOMING_VIEW
WHERE leename like '$pelaths'
AND codcode='$kodikos_eidous'
AND trndate>='$_POST[date_return]'";
//print $cmdstr;
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		$docid=$results["DOCID"][$i];
		$dotcode=$results["DOTCODE"][$i];
		$docnumber=$results["DOCNUMBER"][$i];
		$trndate=$results["TRNDATE"][$i];
    $test=strlen($ttycode);
if (strlen($ttycode)=="3")
{
$ttycode1=$ttycode."&nbsp;&nbsp;";
} 
else if (strlen($ttycode)=="5")
{
$ttycode1=$ttycode;
} 
if (strlen($docnumber)=="2")
{
$docnumber1=$docnumber."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
else if (strlen($docnumber)=="3")
{
$docnumber1=$docnumber."&nbsp;&nbsp;&nbsp;&nbsp;";
}
else if (strlen($docnumber)=="4")
{
$docnumber1=$docnumber."&nbsp;&nbsp;";
}
else 
{
$docnumber1=$docnumber;
}

	$display_block.="<OPTION value=\"$docid@@@$dotcode@@@$docnumber@@@$trndate\">$trndate - $dotcode - $docnumber</OPTION>";
	}
	?>
<input name="pelaths" type="hidden" value="<?php php print $pelaths?>">
<input name="rmaid" type="hidden" value="<?php php  print $rmaid; ?>">
<input name="kodikos_pelath" type="hidden" value="<?php php print $kodikos_pelath?>">
<input name="kodikos_eidous" type="hidden" value="<?php php print $kodikos_eidous?>">
<input name="perigrafh_eidous" type="hidden" value="<?php php print $perigrafh_eidous?>">
<SELECT name="ppp" size="8" >
<?php php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
  </body>
</html>
