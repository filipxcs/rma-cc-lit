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



$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	#$queryt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resultt=mysql_query($queryt);
	#$numt=mysql_numrows($resultt);
	$display_block1.="<OPTION value=''>$rcodcode - $rsn</OPTION>";
	}
	$querya="SELECT * FROM rma.sort_reject where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$rejected_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	$rreason=mysql_result($resulta,$i,"reason");
	#$querytt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resulttt=mysql_query($querytt);
	#$numtt=mysql_numrows($resulttt);
	$display_block2.="<OPTION value=''>$rcodcode - $rsn - $rreason</OPTION>";
	
	}
					
?>		
<body bgcolor="<?php print $colour?>">
<?php





	
$ret ="";
$ret .="<FORM name='form' action='insert4.php' method='post'>";
$ret .="<input type=hidden name=masterid value='$_POST[masterid]'>";
$ret .="<input type=hidden name=docid value='$docid'>";
$ret .="<input type=hidden name=docdetails value='$docdetails'>";
$ret .="<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
$ret .="<tr>";
$ret .="<td><textarea name=\"batch_data\" cols=\"105\" rows=\"15\">$batch_data</textarea></td>";
$ret .="</tr>";
$ret .="</table>";


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

