<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
function changeFrames(url1) {
    parent._bottom1.location.href = '../menu/blank.php';
    parent._bottom2.location.href = '../menu/blank.php';
    }
</script>
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
require("../../oracle1.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="codcode_change.php"  target="_main1" method=post>
 <?php
if ($_POST[pel]<> "" )
{
 $cmdstr = "select * FROM  STI where  CODCODE like '%$_POST[pel]%'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
	$codcode=$results["CODCODE"][$i];
	$itmname=$results["ITMNAME"][$i];
	$display_block.="<OPTION value='$codcode@@@$itmname'>$codcode</OPTION>";
	}
	}

?>
<table border="0">
  <tbody>
    <tr>
<td><select name="kodikos" size="6">
  <?php print $display_block; ?> 
 </select></td>

 <td valign="bottom">
 <input name="rmaid" type="hidden" value="<?php print $_POST[rmaid]; ?>">
 <input name="change" type="submit" value="Επιλογή" onClick="changeFrames()"></td>
 </tr>
 </tbody>
 </table>
</form>
</BODY>
</html>

