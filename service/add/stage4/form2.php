<?php
session_start();
?>
<html>
  <head>
<title>input</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
function handleEnter (field, event) {
		var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
		if (keyCode == 13) {
			var i;
			for (i = 0; i < field.form.elements.length; i++)
				if (field == field.form.elements[i])
					break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		} 
		else
		return true;
	}      
function changeFrames(url1) {
    parent._bottom1.location.href = 'input.php';
    parent._bottom2.location.href = '../../menu/blank.php';
    }
</script>
<script language="javascript" src="list.js"></script>
</head>
<?php
require("../../../params.php");
require("../../../mysql.php");
require("../../../oracle.php");
$date=date("Y-m-d");
$needle="@@@";
$docid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$docdetails = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,200);
$masterid=$_POST['masterid'];
$outgoing_choice=$_POST['outgoing_choice'];

if ($outgoing_choice=="accept")
{
$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	#$queryt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resultt=mysql_query($queryt);
	#$numt=mysql_numrows($resultt);
	$display_block.="<OPTION value=''>$rcodcode - $rsn</OPTION>";
	}
}
else if ($outgoing_choice=="reject")
{
	$querya="SELECT * FROM rma.sort_reject where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	$rreason=mysql_result($resulta,$i,"reason");
	#$querytt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resulttt=mysql_query($querytt);
	#$numtt=mysql_numrows($resulttt);
	$display_block.="<OPTION value=''>$rcodcode - $rsn - $rreason</OPTION>";
	
	}
}					
?>		
<body bgcolor="<?php print $colour?>">
<?php





	
$ret ="";
$ret .="<FORM name='form' action='insert2.php' method='post'>";
$ret .="<input type=hidden name=masterid value='$_POST[masterid]'>";
$ret .="<input type=hidden name=docid value='$docid'>";
$ret .="<input type=hidden name=docdetails value='$docdetails'>";
$ret .="<input type=hidden name=outgoing_choice value='$outgoing_choice'>";
$ret .="<table border='0' width=60% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td align=center>$leename</td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td align=center></td>";
$ret .="</tr>";
$ret .="</tbody></table>";
$ret .="<table border='0' width=60% align=center><tbody><tr>";
$ret .="<tr><td valign=top>";
$ret .="<td>";
$ret .="</td></tr>";
$ret .="</tbody></table><hr align=left width=75% size=5 noshade>";
$ret .="<table border='0' width=60% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td width=50 align=center>Τμχ για αποστολή : $qty</td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td width=50 align=center><select name='s' size=10'>";
$ret .="$display_block";
$ret .="</select></td>";
$ret .="</tr>";
$ret .="</tbody></table><hr align=left width=75% size=5 noshade>";


print $ret;	





?>
  
    

      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"></td>
      <td width="10" valign="top"></td>
      <td width="370" align="right"><input name="submit" type="submit" value="Συνεχεια"></td>
    </tr>
        </tbody>
</table>

</body>
</html>

