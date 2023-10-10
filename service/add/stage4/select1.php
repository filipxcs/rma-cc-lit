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

?>
<body bgcolor=<?php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php  

//print $_POST['kodikos_eidous'];
$needle="@@@";
$rmaid = substr("$_POST[rma]",0,strpos($_POST[rma],$needle));

$query="SELECT * FROM rmaservice where rmaid = '$rmaid'";
$result=mysql_query($query);
mysql_close();

#    $company=mysql_result($result,0,"company");
#	if ($company=='cc-lit')
#{
#require("../../../oracle1.php");
#}
#else
#{
#require("../../../oracle.php");
#}

require("../../../oracle1.php");
	
$d1 = substr("$_POST[rma]",strpos($_POST[rma],$needle)+3,500);
$pelaths = substr("$d1",0,strpos($d1,$needle));
$kodikos_eidous = substr("$d1",strpos($d1,$needle)+3,500);
 $cmdstr = "SELECT * FROM Z_RMA_OUTGOING_VIEW_SP 
WHERE leename='$pelaths'
AND (TRNDATE>=TO_DATE('$_POST[date_return]','dd/mm/yyyy')) ORDER BY TRNDATE";
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
<input name="pelaths" type="hidden" value="<?php print $pelaths?>">
<input name="rmaid" type="hidden" value="<?php  print $rmaid; ?>">
<input name="kodikos_pelath" type="hidden" value="<?php print $kodikos_pelath?>">
<input name="kodikos_eidous" type="hidden" value="<?php print $kodikos_eidous?>">
<input name="perigrafh_eidous" type="hidden" value="<?php print $perigrafh_eidous?>">
<SELECT name="ppp" size="8" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή" style="vertical-align:top;">
</FORM>
  </body>
</html>
