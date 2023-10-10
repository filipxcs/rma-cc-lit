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
require("../../../oracle_nc.php");
$date=date("Y-m-d");
$needle="@@@";

$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$leename = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);


$post_serial=$_POST['serial'];     
$query="SELECT * FROM rma.credit_master where traid='$traid' and openflag='1'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num=="0")
{
$query1="insert into rma.credit_master values('','$traid','$date','0','1','0','0','')";
$result1=mysql_query($query1);
#print $query1;
$query1="SELECT * FROM rma.credit_master where traid='$traid' and openflag='1'";
$result1=mysql_query($query1);
$masterid=mysql_result($result1,0,"id");


	
}
else
{
	$masterid=mysql_result($result,0,"id");
	
	}
	
print "Α/A : ".$masterid;



$querya="SELECT * FROM rma.credit_detail where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$qty=mysql_result($resulta,$i,"qty");
	$price_out=mysql_result($resulta,$i,"price");
	#$queryt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resultt=mysql_query($queryt);
	#$numt=mysql_numrows($resultt);
	$display_block1.="<OPTION value=''>$rcodcode - $qty - $price_out</OPTION>";
	}
	
					
?>		
<body bgcolor="<?php print $colour?>">
<?php

$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3)='WDC' and codcode like '%$_POST[search_code]%' and  itmactive='1' order by codcode";

$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		$codcode=$results["CODCODE"][$i];
		$mciid=$results["MCIID"][$i];
	
	$display_block.="<OPTION value=\"$codcode@@@$mciid\">$codcode</OPTION>";
	
	}





	
$ret ="";
$ret .="<FORM name='form' action='form_credit.php' method='post'>";
$ret .="<input type=hidden name=ppp value='$_POST[ppp]'>";

$ret .="<table border='0' width=60% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td width=50>Καταχωρημένα : $accepted_qty</td>";

$ret .="</tr>";
$ret .="<tr>";
$ret .="<td width=50><select name='s' size=10>";
$ret .="$display_block1";
$ret .="</select></td>";
$ret .="</tr>";
$ret .="</tbody></table><hr align=left width=75% size=5 noshade>";


print $ret;	





?>
  

</form>
	<?php
$ret ="";
$ret .="<FORM name='form' action='insert_credit1.php' method='post'>";
$ret .="<input type=hidden name=masterid value='$masterid'>";
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
</form>
	<?php
	
	
$ret ="";
$ret .="<FORM name='form' action='insert_credit2.php' method='post'>";
$ret .="<input type=hidden name=masterid value='$masterid'>";
$ret .="<input type=hidden name=docdetails value='$docdetails'>";
$ret .="<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
$ret .="<tr>";
$ret .="<td>Αριθμοί Διαλογών : <input name=\"dialoges\" size=\"50\"></textarea></td>";
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
      <td width="370" align="right"><input name="submit" type="submit" value="Καταχώρηση"></td>
    </tr>
        </tbody>
</table>
</form>
</body>
</html>

