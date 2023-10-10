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
<FORM action="name_change.php"  target="_main1" method=post>
 <?php
if ($_POST[pel]<> "" )
{
$cmdstr1= "select * FROM  lee,cus where LEE.LEEID=CUS.LEEID AND (LEENAME like '%$_POST[pel]%' or LEEAFM like '$_POST[pel]%' or TRACODE='$_POST[pel]')";
$parsed1= ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);
$nrows1 = ocifetchstatement($parsed1, $results1);
for ($i = 0; $i < $nrows1; $i++ )
	{
	$leename=$results1["LEENAME"][$i];
	$tracode=$results1["TRACODE"][$i];
	$display_block1.="<OPTION value=\"$leename@@@$tracode\">$tracode - $leename</OPTION>";
	}	
			}

?>
<table border="0">
  <tbody>
    <tr>
<td><select name="pelaths" size="6">
  <?php print $display_block1; ?> 
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

