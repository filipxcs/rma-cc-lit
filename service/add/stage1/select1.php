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
<?php 
if ($_POST[ispep]=="1")
{ ?>
<FORM action="select2.php"  target="_bottom2" method=post>
<?php  }
else 
{ ?>
<FORM action="form.php"  target="_main1" method=post>
<?php  }

$needle="@@@";
$kodikos_eidous = substr("$_POST[kodikos_eidous]",0,strpos($_POST[kodikos_eidous],$needle));
$perigrafh_eidous = substr("$_POST[kodikos_eidous]",strpos($_POST[kodikos_eidous],$needle)+3,200);
$kodikos_pelath = substr("$_POST[pelaths]",0,strpos($_POST[pelaths],$needle));
$pelaths = substr("$_POST[pelaths]",strpos($_POST[pelaths],$needle)+3,200);

 $cmdstr = "SELECT * FROM Z_RMA_SEARCHTRANS_VIEW 
WHERE customername='$pelaths'
AND codcode='$kodikos_eidous'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
	$reason=$results["REASON"][$i];
        $trndate=$results["TRNDATE"][$i];
        $ttycode=$results["TTYCODE"][$i];
        $docnumber=$results["DOCNUMBER"][$i];
        $itrqtya=$results["ITRQTYA"][$i];
	$item_value=$results["ITEM_VALUE"][$i];
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

	$display_block.="<OPTION value=\"$reason-$trndate-$ttycode-$docnumber-$itrqtya-$item_value\">$trndate&nbsp;$ttycode1&nbsp;&nbsp;$docnumber1&nbsp;&nbsp;$reason</OPTION>";
	}
?>
<input name="pelaths" type="hidden" value="<?php print $pelaths?>">
<input name="kodikos_pelath" type="hidden" value="<?php print $kodikos_pelath?>">
<input name="kodikos_eidous" type="hidden" value="<?php print $kodikos_eidous?>">
<input name="perigrafh_eidous" type="hidden" value="<?php print $perigrafh_eidous?>">
<input name="ispep" type="hidden" value="<?php  print $_POST[ispep] ?>">
<SELECT name="ppp" size="8" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
