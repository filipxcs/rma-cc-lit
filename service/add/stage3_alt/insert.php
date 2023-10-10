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
$year=substr($_POST[date_paralavis],6,2);
$month=substr($_POST[date_paralavis],3,2);
$day=substr($_POST[date_paralavis],0,2);
$date="20".$year."-".$month."-".$day;
?>
<body bgcolor=<?php print $colour?>>

<?php


$query = "update sales_stage1 set part='2', deltio_paralavis='$_POST[deltio_paralavis]',date_paralavis='$date',katastasi_proiontos='$_POST[katastasi_proiontos]',katastasi_proiontos_logos='$_POST[katastasi_proiontos_logos]',katastasi_siskeuasias='$_POST[katastasi_siskeuasias]',katastasi_siskeuasias_logos='$_POST[katastasi_siskeuasias_logos]' where id=$_POST[id]"; 
$result=mysql_query($query);

#$num=mysql_numrows($result);
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

