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
require("../../../oracle1.php");
$date=date("Y-m-d");
$needle="@@@";

$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$d1 = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);
$leename = substr("$d1",0,strpos($d1,$needle));
$label = substr("$d1",strpos($d1,$needle)+3,500);  
$post_serial=$_POST['serial'];     
$query="SELECT * FROM rma.sort_master where traid='$traid' and openflag='1' and label='$label'";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num=="0")
{
$query1="insert into rma.sort_master values('','$traid','$date','$label','','0','0',',0','','1')";
$result1=mysql_query($query1);
#print $query1;
$query1="SELECT * FROM rma.sort_master where traid='$traid' and openflag='1' and label='$label'";
$result1=mysql_query($query1);
$masterid=mysql_result($result1,0,"id");


	
}
else
{
	$masterid=mysql_result($result,0,"id");
	
	}
	
print "Αριθμός Διαλογής : ".$masterid;

if (!isset($_POST['insert']) || $_POST['serial']=="" || $_POST['code_select']=="")
				{
				if ($_POST['insert']=="1")
				{
				print "<br><font color=red>Δεν έγινε καταχώρηση κενός σειριακός ή κωδικός.</font>";}
				}
				else
				{
				$queryt="SELECT * FROM rma.sort_detail where sn='$_POST[serial]' and masterid='$masterid'";
				$resultt=mysql_query($queryt);
				$numt=mysql_numrows($resultt);
				if ($numt!="0")
				{print "<br><font color=red>Αυτός ο σειριακός αριθμός έχει καταχωρηθεί ξανά.</font>";}
				$post_code = substr("$_POST[code_select]",0,strpos($_POST[code_select],$needle));
				$mciid = substr("$_POST[code_select]",strpos($_POST[code_select],$needle)+3,200);
				if ($_POST['action']=="1" && $numt=="0")
				{
				$query_in="insert into rma.sort_accept values('','$masterid','$mciid','$post_code','$_POST[serial]','','','','')";
				$result_in=mysql_query($query_in);
				$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$_POST[serial]','','','','','')";
				$result_in=mysql_query($query_in);
				}
				else if ($_POST['action']=="2" && $numt=="0" )
				{
				$query_in="insert into rma.sort_reject values('','$masterid','$mciid','$post_code','$_POST[serial]','Εγγύηση','','')";
				$result_in=mysql_query($query_in);
				$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$_POST[serial]','Εγγύηση','','','')";
				$result_in=mysql_query($query_in);
				}
				else if ($_POST['action']=="3" && $numt=="0")
				{
				$query_in="insert into rma.sort_reject values('','$masterid','$mciid','$post_code','$_POST[serial]','Όροι','','')";
				$result_in=mysql_query($query_in);
				$query_in="insert into rma.sort_detail values('','$masterid','$mciid','$post_code','$_POST[serial]','Όροι','','','')";
				$result_in=mysql_query($query_in);
				}
				
				
				
				$post_serial="";
				}

$querya="SELECT * FROM rma.sort_accept where masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	$price_out=mysql_result($resulta,$i,"price");
	#$queryt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resultt=mysql_query($queryt);
	#$numt=mysql_numrows($resultt);
	$display_block1.="<OPTION value=''>$rcodcode - $rsn - $price_out</OPTION>";
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
if ($label=="WDC")
{
#$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3)='WDC' and itmactive='1' order by codcode";
$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3)='WDC' and codcode like '%$_POST[search_code]%' and  itmactive='1' order by codcode";
}
else if ($label=="NEC")
{
$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3) in ('NEC','SNO','PLD') and codcode like '%$_POST[search_code]%' and itmactive='1' order by codcode";
}
else
{
$cmdstr = "select codcode,mciid from sti where substr(codcode,4,3) in ('NEC','SNO','PLD','WDC','ASR','APR') and codcode like '%$_POST[search_code]%' and itmactive='1' order by codcode";
}
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   
for ($i = 0; $i < $nrows; $i++ )
	{
		$codcode=$results["CODCODE"][$i];
		$mciid=$results["MCIID"][$i];
	
	$display_block.="<OPTION value=\"$codcode@@@$mciid\">$codcode</OPTION>";
	
	}




if ($_POST['action']=="1")
{
$accept="checked";
$guar="";
$terms="";
}
else if ($_POST['action']=="2")
{
$accept="";
$guar="checked";
$terms="";
}
else if ($_POST['action']=="3")
{
$accept="";
$guar="";
$terms="checked";
}
else
{
$accept="checked";
$guar="";
$terms="";
}
	
$ret ="";
$ret .="<FORM name='form' action='form2.php' method='post'>";
$ret .="<input type=hidden name=ppp value='$_POST[ppp]'>";
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
$ret .="<table border='0'><tbody>";
$ret .="<tr>";
$ret .="<td width=60><font color=$colour1>S/N</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=100 colspan=4><input name='serial' type='text' size='25' value='$post_serial'></td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td width=60><font color=$colour1>Αποδοχή</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=15><input name='action' type='radio' value='1' $accept></td>";
$ret .="<td width=60><font color=$colour1>Απόρριψη</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=15></td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td colspan=3></td>";
$ret .="<td width=60><font color=$colour1>Εγγύηση</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=15><input name='action' type='radio' value='2' $guar></td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td colspan=3></td>";
$ret .="<td width=60><font color=$colour1>Όροι</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=15><input name='action' type='radio' value='3' $terms></td>";
$ret .="</tr>";
$ret .="</td>";
$ret .="</tbody></table>";
$ret .="<td>";
$ret .="<table border='0'><tbody>";
$ret .="<tr>";
if ($_POST['find_code']=="1")
{
$ret .="<td width=50><select name='code_select' size=12>";
$ret .="$display_block";
$ret .="</select></td>";
$ret .="<input type=hidden name=find_code value=0>";
$ret .="<input type=hidden name=insert value=1>";
}
else
{
$ret .="<td width=60><font color=$colour1>Κωδικός</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=100 colspan=4><input name='search_code' type='text' size='25' value=''></td>";
$ret .="<input type=hidden name=find_code value=1>";
}
$ret .="</tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="</tbody></table>";
$ret .="</td></tr>";
$ret .="</tbody></table><hr align=left width=75% size=5 noshade>";
$ret .="<table border='0' width=60% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td width=50>Έχουν Αποδεχθεί : $accepted_qty</td>";
$ret .="<td width=50>Έχουν Απoρριφθεί :$rejected_qty</td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td width=50><select name='s' size=10>";
$ret .="$display_block1";
$ret .="</select></td>";
$ret .="<td width=50><select name='s' size=10'>";
$ret .="$display_block2";
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
      <td width="370" align="right"><input name="submit" type="submit" value="καταχώρηση"></td>
    </tr>
        </tbody>
</table>
</form>
	<?php
$ret ="";
$ret .="<FORM name='form' action='insert4.php' method='post'>";
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
$ret .="<FORM name='form' action='insert5.php' method='post'>";
$ret .="<input type=hidden name=masterid value='$masterid'>";
$ret .="<input type=hidden name=docdetails value='$docdetails'>";
$ret .="<table width=\"100%\" border=\"0\" cellpadding=\"5\">";
$ret .="</table>";


print $ret;	





?>
  
    

      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"></td>
      <td width="10" valign="top"></td>
      <td width="370" align="right"><input name="submit" type="submit" value="Καταχώρηση δήλωσης"></td>
    </tr>
        </tbody>
</table>
</form>
</body>
</html>

