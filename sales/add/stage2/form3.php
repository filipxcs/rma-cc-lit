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

if ($_POST[ppp]=='')
{
	print "Δεν έχετε επιλέξει πελάτη.";}
	else {
		
$traid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$leename = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,500);

$query="SELECT * FROM rma.order_invoices where traid='$traid' and flag='1'";
$result=mysql_query($query);
$num=mysql_numrows($result);

if ($num=="0")
{
$query1="insert into rma.order_invoices values('','$traid','$date','1')";
$result1=mysql_query($query1);
#print $query1;
$query1="SELECT * FROM rma.order_invoices where traid='$traid' and flag='1'";
$result1=mysql_query($query1);
$masterid=mysql_result($result1,0,"id"); 
}
else
{
	$masterid=mysql_result($result,0,"id");
	
	}

if ($_POST['close_invoice']=="1")
				{
				
				$query_close_invoice="update rma.order_invoices set flag='21' where id='$masterid' and traid='$traid'";
				$result_close_invoice=mysql_query($query_close_invoice);
				print "<div align=center><h2>Η παραγγελία καταχωρήθηκε</h2></div>";
				?>
				<body bgcolor="<?php print $colour?>">
				<?php 

				}
				else
				{
print 		"<font color='red' size='6'>ΠΡΟΣΟΧΗ ΣΤΟΝ ΤΡΟΠΟ ΠΛΗΡΩΜΗΣ ΤΟΥ ΠΕΛΑΤΗ</font></br>";	
print 		"<font color='red' size='5'>Για να χρησιμοποιήσεις αυτή την εφαρμογή, θα πρέπει να βάλεις τον ίδιο κωδικό πληρωμής </font></br>";	
print "Αριθμός Παραγγελίας : ".$masterid;

if ($_POST['insert']=="1" && isset($_POST['package_select']))
				{
				$package_select = substr("$_POST[package_select]",0,strpos($_POST[package_select],$needle));
				$pcs_count = substr("$_POST[package_select]",strpos($_POST[package_select],$needle)+3,500);
				$query_check="select * from rma.order_packets where packet_id='$package_select'";

				$result_check=mysql_query($query_check);
				$num_check=mysql_numrows($result_check);
				if ($num_check=='0')
				{
				$query_in="insert into rma.order_packets values('','$masterid','$traid','$package_select','$pcs_count','0','$date')";
				$result_in=mysql_query($query_in);
				}
				else
				{$exists_flag='1';}

				}

if ($_POST['remove_packet']=="1")
				{
				
				$query_del="delete from rma.order_packets where packet_id='$_POST[packets_in]'";
				$result_del=mysql_query($query_del);


				}				

				
				
				
		

$querya="SELECT * FROM rma.order_packets where flag1='0' and masterid='$masterid'";
	$resulta=mysql_query($querya);
	$numa=mysql_numrows($resulta);
	$accepted_qty=$numa;
	for ($i = 0; $i < $numa; $i++ )
	{
	$package_id=mysql_result($resulta,$i,"packet_id");
	$pcs_package_count=mysql_result($resulta,$i,"pcs_count");
	$pcs_sum=$pcs_sum + $pcs_package_count;
	
	$display_block1.="<OPTION value='$package_id'>$package_id - $pcs_package_count</OPTION>";
	}
	
if (isset($_POST['find_packet']))
{
$query_find_p="SELECT count(*) as pcs_count,package_id FROM rma.order_detail where package_id='$_POST[search_packet]'";


	$result_find_p=mysql_query($query_find_p);
	$num_find_p=mysql_numrows($result_find_p);
	
	for ($i = 0; $i < $num_find_p; $i++ )
	{
	$packet_id=mysql_result($result_find_p,$i,"package_id");
	$pcs_count=mysql_result($result_find_p,$i,"pcs_count");
	

	#$queryt="SELECT * FROM rma.sort_reject where sn='$rsn'";
	#$resultt=mysql_query($queryt);
	#$numt=mysql_numrows($resultt);
	$display_block.="<OPTION value='$packet_id@@@$pcs_count'>$packet_id - $pcs_count</OPTION>";
	}	
}
	
					
?>		
<body bgcolor="<?php print $colour?>">
<?php 





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
$ret .="<FORM name='form' action='form3.php' method='post'>";
$ret .="<input type=hidden name=ppp value='$_POST[ppp]'>";
$ret .="<table border='0' width=100% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td align=center>$leename</td>";
$ret .="</tr>";
if ($exists_flag=='1')
{
$ret .="<tr>";
$ret .="<td align=center><font color=red>Το πακέτο εχει ήδη επιλεχθεί.</font></td>";
$ret .="</tr>";
}
$ret .="<tr>";
$ret .="<td align=center></td>";
$ret .="</tr>";
$ret .="</tbody></table>";
$ret .="<table border='0' width=100% align=center><tbody><tr>";
$ret .="<tr><td valign=top>";
$ret .="<table border='0'><tbody>";

$ret .="</td>";
$ret .="</tbody></table>";
$ret .="<td>";
$ret .="<table border='0' width=100% align=center><tbody>";
$ret .="<tr>";
if ($_POST['find_packet']=="1")
{
$ret .="<td align=center><select name='package_select' size=12>";
$ret .="$display_block";
$ret .="</select></td>";
$ret .="<input type=hidden name=find_code value=0>";
$ret .="<input type=hidden name=insert value=1>";
}
else
{
$ret .="<td width=60 align=center><font color=$colour1>Πακέτο : <input name='search_packet' type='text' size='25' value=''></font></td>";

$ret .="<input type=hidden name=find_packet value=1>";
}
$ret .="</tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="</tbody></table>";
$ret .="</td></tr>";
$ret .="</tbody></table>";



print $ret;	





?>
  
  

      <table border="0"  width=100% align=center>
        <tbody>
          <tr>
       <td align="center"><input name="submit" type="submit" value="καταχώρηση"></td>
    </tr>
        </tbody>
</table>
</form>
<hr align=center size=5 noshade>
<?php 
$ret ="";
$ret .="<FORM name='form' action='form3.php' method='post'>";
$ret .="<input type=hidden name=ppp value='$_POST[ppp]'>";
$ret .="<table border='0' width=100% align=center><tbody><tr>";
$ret .="<tr>";
$ret .="<td align=center>Πακέτα : $accepted_qty - Τμχ. : $pcs_sum</td>";
$ret .="</tr>";
$ret .="<tr>";
$ret .="<td align=center><select name='packets_in' size=10>";
$ret .="$display_block1";
$ret .="</select></td>";
$ret .="</tr>";
$ret .="<input type=hidden name=remove_packet value=1>";
$ret .="</tbody></table>";

print $ret;	

?>
      <table border="0" width=100% align=center>
        <tbody>
          <tr>
           <td align="center"><input name="submit" type="submit" value="Αφαίρεση"></td>
    </tr>
        </tbody>
</table>
</form>

 <hr align=center size=5 noshade>

<?php 
$ret ="";
$ret .="<FORM name='form' action='form3.php' method='post'>";
$ret .="<input type=hidden name=close_invoice value=1>";
$ret .="<input type=hidden name=ppp value='$_POST[ppp]'>";
$ret .="</tbody></table>";

print $ret;
?>    

       <table border="0" width=100% align=center>
        <tbody>
          <tr>
         <td align="center"><input name="submit" type="submit" value="Καταχώρηση Παραγγελίας"></td>
    </tr>
        </tbody>
</table>
</form>
<?php 
				}
				}
				?>
</body>
</html>

