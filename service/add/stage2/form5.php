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
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$d1 = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);
$leename = substr("$d1",0,strpos($d1,$needle));
$masterid = substr("$d1",strpos($d1,$needle)+3,500);




	
					
?>		
<body bgcolor="<?php print $colour?>">
<?php
$ii=0;
$ret ="";
$ret .="<FORM name='form' action='insert4a.php' method='post'>";
$ret .="<table width='70%' border='0' align=center><tbody>";

$ret .="<tr><td width=20><font color=$colour1>A/A</font></td><td width=250><font color=$colour1>Κωδικός</font></td><td width=160><font color=$colour1>Σειριακός</font></td><td width=60><font color=$colour1>Accept</font></td><td width=60><font color=$colour1>Reject - Όροι</font></td><td width=60><font color=$colour1>Reject - Εγγύηση</font></td><td width=60><font color=$colour1>Αφαίρεση</font></td></tr>";
$querya="(SELECT id,codcode,sn, '' reason FROM rma.sort_accept a where masterid='$masterid') union (SELECT id,codcode,sn,reason FROM rma.sort_reject where masterid='$masterid')";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$rid=mysql_result($resulta,$i,"id");
	$rcodcode=mysql_result($resulta,$i,"codcode");
	$rsn=mysql_result($resulta,$i,"sn");
	$rreason=mysql_result($resulta,$i,"reason");
	$ii++;
	if ($rreason=="")
	{$radio_ac="checked";}
	else
	{$radio_ac="";}
	if ($rreason=="Όροι")
	{$radio_or="checked";}
	else
	{$radio_or="";}
	if ($rreason=="Εγγύηση")
	{$radio_eg="checked";}
	else
	{$radio_eg="";}
$ret .="<tr><td>$ii</td><td>$rcodcode</td><td>$rsn</td><td><input name=radio$i type=radio value='1' $radio_ac/></td><td><input name=radio$i type=radio value='2' $radio_or/></td><td><input name=radio$i type=radio value='3' $radio_eg/></td><td><input name=radio$i type=radio value='4'/></td></tr>";
$ret .="<input type=hidden name=id$i value=$rid>";
	}
$ret .="<input type=hidden name=masterid value=$masterid>";

$ret .="</tbody></table>";

	

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
</table></form>

</body>
</html>

