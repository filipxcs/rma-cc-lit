<?php
session_start();
?>
<html>
<head>
<title>Top1</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php 

$query="SELECT * from transactions where rmaid='$_POST[rmaid]' order by date";

$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{
	    $rmaid=mysql_result($result,$i,"rmaid");
        $kind=mysql_result($result,$i,"kind"); 
		$transid=mysql_result($result,$i,"transid");
	
	$display_block.="<OPTION value=\"$rmaid@@@$kind@@@$transid\">$kind</OPTION>";
	if ($kind == 'Ακύρωση') {
		$display_block.="<OPTION value=\"$rmaid@@@Uncancel@@@$transid\">Αναίρεση Ακύρωσης</OPTION>";
	}
	}
?>
<SELECT name="rmaid" size="6" >
<OPTION value="<?php print $rmaid."@@@κεντρικά@@@12"; ?>">Κεντρικα στοιχεία</OPTION>
<?php print $display_block; ?>
</SELECT>
<input name="submit" type="submit" value="Επιλογή">
</FORM>
  </body>
</html>
