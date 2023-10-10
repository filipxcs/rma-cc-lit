<html>
<head>
<title>Top1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php 
require("../../../params.php");
require("../../../oracle.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php  
 $cmdstr = "SELECT DECODE(STRD.actid, 3,'ΠΩΛΗΣΗ',6,'ΔΕΛΤΙΟ
SERVICE',26,'TIM.SERVICE','ΑΛΛΟ') AS REASON,
STRD.TRNDATE, STRD.TTYCODE, STRD.DOCNUMBER, STRD.ITRQTYA, ROUND(STRD.itrvalue/STRD.itrqtya,2) AS ITEM_VALUE   FROM
STR_DRILLVIEW STRD,  STI, CUS
WHERE STRD.mciid=STI.mciid
AND STRD.traidcustomer=CUS.traid
AND STRD.customername='$_POST[pelaths]'
AND STRD.TRNDATE BETWEEN SYSDATE-1095 AND SYSDATE
AND STRD.actid in(3,26,6)
AND STI.codcode='$_POST[kodikos_eidous]'
AND STRD.cancelstatus ='ΚΑΝΟΝΙΚΗ' ";
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
<input name="pelaths" type="hidden" value="<?php print $_POST[pelaths]?>">
<input name="kodikos_eidous" type="hidden" value="<?php print $_POST[kodikos_eidous]?>">
<SELECT name="ppp" size="6" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
