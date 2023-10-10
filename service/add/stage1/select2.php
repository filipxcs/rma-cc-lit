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

<FORM action="form.php"  target="_main1" method=post>

<?php 


 $cmdstr = "SELECT STI.CODCODE AS CODCODE, STI.ITMNAME AS ITMNAME
FROM S01001.STI STI_1,S01001.MBF,S01001.MII, S01001.STI
WHERE ((MBF.MBFACTIVE)=1)
AND MII.MCIID = STI.MCIID
AND MBF.MBFID = MII.MBFID
AND  STI_1.MCIID = MBF.MCIID
AND STI_1.CODCODE='$_POST[kodikos_eidous]'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);
for ($i = 0; $i < $nrows; $i++ )
	{
	$codcode=$results["CODCODE"][$i];
    $itmname=$results["ITMNAME"][$i];

	$display_block.="<OPTION value=\"$codcode@@@$itmname\">$codcode --- $itmname</OPTION>";
	}
?>
<input name="pelaths" type="hidden" value="<?php  print $_POST[pelaths] ?>">
<input name="kodikos_pelath" type="hidden" value="<?php  print $_POST[kodikos_pelath] ?>">
<input name="peppercode" type="hidden" value="<?php  print $_POST[kodikos_eidous] ?>">
<input name="ppp" type="hidden" value="<?php  print $_POST[ppp] ?>">
<input name="ispep" type="hidden" value="<?php  print $_POST[ispep] ?>">
<SELECT name="ppp1" size="8" >
<?php  print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
