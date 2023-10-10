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
?>
<body bgcolor=<?php print $colour?>>
<?php

if ($_POST[egrisi] == "1" )
{
print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center></font>
<font size=\"3\"><Center>
  <p>To RMA ".$_POST[id]." εγκρίθηκε</p>
</Center></font>";
$query = "update sales_stage1 set part='3',egrisi='2' where id=$_POST[id]"; 
$result=mysql_query($query);

#$num=mysql_numrows($result);
}
else
{
$query = "update sales_stage1 set part='3',egrisi='3' where id=$_POST[id]"; 
$result=mysql_query($query);
print "<font size=\"5\"><Center>
  <p>Έγινε καταχώρηση</p>
</Center></font>
<font size=\"3\"><Center>
  <p>To RMA ".$_POST[id]." δεν εγκρίθηκε</p>
</Center></font>";
}

mysql_close();
?>
</body>
</html>
</BODY>
</html>

