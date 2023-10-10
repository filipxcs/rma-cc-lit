<?php
session_start();
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check.php");
require("../../../oracle.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="select1.php"  target="_bottom2" method=post>
 <?php
if ($_POST[pel]<> "" )
{
 $cmdstr = "select * FROM  STI where  CODCODE like '%$_POST[pel]%'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
	$slp=$results["CODCODE"][$i];
	$sl=$results["ITMNAME"][$i];
	$display_block.="<OPTION value='$slp@@@$sl'>$slp</OPTION>";
	}
//print $sl;                                    
							}

if ($_POST[pel1]<> "" )
{
$cmdstr1= "select * FROM  lee,cus where LEE.LEEID=CUS.LEEID AND (LEENAME like '%$_POST[pel1]%' or LEEAFM like '$_POST[pel1]%' or TRACODE='$_POST[pel1]')";
$parsed1= ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);
$nrows1 = ocifetchstatement($parsed1, $results1);
for ($i = 0; $i < $nrows1; $i++ )
	{
	$slp1=$results1["LEENAME"][$i];
	$tracode=$results1["TRACODE"][$i];
	$traid=$results1["TRAID"][$i];
	$display_block1.="<OPTION value=\"$traid@@@$slp1\">$tracode - $slp1</OPTION>";
	}	
			}

?>
<table border="0">
  <tbody>
    <tr>
<td><SELECT name="kodikos_eidous" size="6">
<?php print $display_block; ?>
</SELECT></td>
<td><select name="pelaths" size="6">
  <?php print $display_block1; ?> 
 </select></td>

 <td valign="bottom"><input name="submit" type="submit" value="Επιλογή"></td>
 </tr>
 <tr>
 <td colspan="3"> Αν ειναι μερος Pepper καντε κλικ.<input name="ispep" type="checkbox" value="1"></td>
  </tr>
 </tbody>
 </table>
</form>
</BODY>
</html>

