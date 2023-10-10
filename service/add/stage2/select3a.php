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
<FORM action="form3.php"  target="_main1" method=post>
<?php 


$needle="@@@";
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$d1 = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);
$leename = substr("$d1",0,strpos($d1,$needle));
$masterid = substr("$d1",strpos($d1,$needle)+3,500);

 $cmdstr = "SELECT distinct docid, dotcode, docnumber, trndate FROM Z_RMA_INCOMING_VIEW
WHERE traid='$traid'
AND trndate>=TO_DATE('$_POST[date_return]', 'DD/MM/YYYY')";
#print $cmdstr;
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
<input name="traid" type="hidden" value="<?php print $traid; ?>">
<input name="leename" type="hidden" value="<?php print $leename; ?>">
<input name="masterid" type="hidden" value="<?php print $masterid; ?>">

<SELECT name="ppp" size="8" >
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή1"  style="vertical-align:top;">
</FORM>
  </body>
</html>
