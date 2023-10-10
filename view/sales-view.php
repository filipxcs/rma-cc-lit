<html>
<head>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
  return false;
}
//-->
</script>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../params.php");
require("../mysql.php");
?>
<body bgcolor=<?phpprint $colour?>>
<FORM action="form.php"  target="_main1" method=post>
<?php
$s="1";
print "<table width=\"100%\" border=\"0\"><colgroup><col width=10><col width=150><col width=100><col width=20><col width=250></colgroup>";
print " <tr>
    <td align=center><b><font size=\"$s\" face=\"Tahoma\">Αριθμός RMA</font></b></td>
	<td align=center><b><font size=\"$s\" face=\"Tahoma\">Πελάτης</font></b></td>
    <td align=center><b><font size=\"$s\" face=\"Tahoma\">Κωδικός Είδους</font></b></td>
    <td align=center><b><font size=\"$s\" face=\"Tahoma\">Ποσότητα</font></b></td>
    <td align=left><b><font size=\"$s\"  face=\"Tahoma\">Κατάσταση</font></b></td>
  </tr>";
if ($_POST[searchitem] == "1" )
{
$query="SELECT * FROM sales_stage1 where  pelaths like '$_POST[item]%' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();

for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$posotita=mysql_result($result,$i,"posotita");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$egrisi=mysql_result($result,$i,"egrisi");
	$part=mysql_result($result,$i,"part");
	switch($egrisi)
    {case "0":
    $statcolor="#000000";
	$egrisi_status="Αναμονή";
    break;
    case "1":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 1 Εγκρίθηκε";
     break;
	 case "10":
    $statcolor="#cc6600";
	$egrisi_status="Απορρίφθηκε";
     break;
	 case "2":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 2 Εγκρίθηκε";
     break;
	 case "3":
    $statcolor="#cc6600";
	$egrisi_status="Απορρίφθηκε";
     break;}
	 switch($part)
    {case "4":
    $statcolor="#000000";
	$egrisi_status="Πιστώθηκε";
    break;}
 print "
	<tr>
	<td align=center><b><font size=\"$s\" face=\"Tahoma\">$id</font></b></td>
	<td align=center><font size=\"$s\" face=\"Tahoma\">$pelaths</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$kodikos_eidous</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$posotita</font></td>
    <td align=left><font size=\"$s\" color=\"$statcolor\" face=\"Tahoma\"><a href=\"javascript:;\" 
onclick=\"MM_openBrWindow('pop_view.php?id=$id','','scroll=no, top=150, left=150, width=800, height=520')\">-></a>&nbsp;&nbsp;$egrisi_status</font></td>
  </tr>";
	}
	}

else if ($_POST[searchitem] == "2" and $_POST[item]<>"")
{
$query="SELECT * FROM sales_stage1 where  kodikos_eidous  like  '%$_POST[item]%' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$posotita=mysql_result($result,$i,"posotita");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$egrisi=mysql_result($result,$i,"egrisi");
	$part=mysql_result($result,$i,"part");
	switch($egrisi)
    {case "0":
    $statcolor="#000000";
	$egrisi_status="Αναμονή";
    break;
    case "1":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 1 Εγκρίθηκε";
     break;
	 case "10":
    $statcolor="#cc6600";
	$egrisi_status="Σταδιο 1 Δεν Εγκρίθηκε";
     break;
	 case "2":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 2 Εγκρίθηκε";
     break;
	 case "3":
    $statcolor="#cc6600";
	$egrisi_status="Σταδιο 2 Δεν Εγκρίθηκε";
     break;}
	 switch($part)
    {case "4":
    $statcolor="#000000";
	$egrisi_status="Πιστώθηκε";
    break;}
 print "
	<tr>
	<td align=center><b><font size=\"$s\" face=\"Tahoma\">$id</font></b></td>
	<td align=center><font size=\"$s\" face=\"Tahoma\">$pelaths</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$kodikos_eidous</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$posotita</font></td>
    <td align=left><font size=\"$s\" color=\"$statcolor\" face=\"Tahoma\"><a href=\"javascript:;\" 
onclick=\"MM_openBrWindow('pop_view.php?id=$id','','scroll=no, top=150, left=150, width=800, height=520')\">-></a>&nbsp;&nbsp;$egrisi_status</font></td>
  </tr>";
	}
	}	
	else if ($_POST[searchitem] == "3" and $_POST[item]<>"")
{
$query="SELECT * FROM sales_stage1 where  id='$_POST[item]' order by id";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
    $id=mysql_result($result,$i,"id");
	$pelaths=mysql_result($result,$i,"pelaths");
	$posotita=mysql_result($result,$i,"posotita");
	$kodikos_eidous=mysql_result($result,$i,"kodikos_eidous");
	$egrisi=mysql_result($result,$i,"egrisi");
	$part=mysql_result($result,$i,"part");
	switch($egrisi)
    {case "0":
    $statcolor="#000000";
	$egrisi_status="Αναμονή";
    break;
    case "1":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 1 Εγκρίθηκε";
     break;
	 case "10":
    $statcolor="#cc6600";
	$egrisi_status="Σταδιο 1 Δεν Εγκρίθηκε";
     break;
	 case "2":
    $statcolor="#0066ff";
	$egrisi_status="Σταδιο 2 Εγκρίθηκε";
     break;
	 case "3":
    $statcolor="#cc6600";
	$egrisi_status="Σταδιο 2 Δεν Εγκρίθηκε";
     break;}
	 switch($part)
    {case "4":
    $statcolor="#000000";
	$egrisi_status="Πιστώθηκε";
    break;}
 print "
	<tr>
	<td align=center><b><font size=\"$s\" face=\"Tahoma\">$id</font></b></td>
	<td align=center><font size=\"$s\" face=\"Tahoma\">$pelaths</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$kodikos_eidous</font></td>
    <td align=center><font size=\"$s\" face=\"Tahoma\">$posotita</font></td>
    <td align=left><font size=\"$s\" color=\"$statcolor\" face=\"Tahoma\"><a href=\"javascript:;\" 
onclick=\"MM_openBrWindow('pop_view.php?id=$id','','scroll=no, top=150, left=150, width=800, height=520')\">-></a>&nbsp;&nbsp;$egrisi_status</font></td>
  </tr>";
	}
	}
print "</tbody>
</table>";
	
?>
</FORM>
</html>
