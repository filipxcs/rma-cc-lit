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
$cmp=$_POST['company'];
if ($cmp=='cc-lit')
	{$company='CC-LIT';}
	else
	{$company='NC';}
$query="select id,leename,codcode,itmname,user,serial,problem,pepserial,guar1,guar2,date_format(date,'%d-%c-%Y')AS 'date' from rma.zonlinerma where online='$_POST[rma]'and status=0";
$result=mysql_query($query);
$num=mysql_numrows($result);
?>
<body bgcolor="<?php print $colour?>" onLoad="fillCategory();">
<?php


$ii=0;
for ($i = 0; $i < $num; $i++ )
	{
$ii++;
    $id=mysql_result($result,$i,"id");
	$leename=mysql_result($result,$i,"leename");
	$codcode=mysql_result($result,$i,"codcode");
    $itmname=mysql_result($result,$i,"itmname");
	$user=mysql_result($result,$i,"user");
	$serial=mysql_result($result,$i,"serial");
	$problem=mysql_result($result,$i,"problem");
    $pepserial=mysql_result($result,$i,"pepserial");
    $guar1=mysql_result($result,$i,"guar1");
	$guar2=mysql_result($result,$i,"guar2");
	$date=mysql_result($result,$i,"date");

if ($guar1 == "1" )
{$guar1a="Ναι";}
else if ($guar1 == "0" )
{$guar1a="Όχι";}
if ($guar2 == "1" )
{$guar2a="Ναι";}
else if ($guar2 == "0" )
{$guar2a="Όχι";}

	
$ret ="";
$ret .="<FORM name='form' action='insert.php' method='post'>";
$ret .="<input type=hidden name=numrows value=$num><input type=hidden name=company value=$cmp><input type=hidden name=online_id value=$_POST[rma]><input type=hidden name=id$i value=$id>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<td width=60><font color=$colour1>A/A</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$ii</td>";
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Είδος</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$codcode</td>";
$ret .="<td width=40></td>";
$ret .="<td width=60><font color=$colour1>Περιγραφή</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=*>$itmname</td>";
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Ημ/νία</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$date</td>";
$ret .="<td width=40></td>";
$ret .="<td width=60><font color=$colour1>Σειριακός</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=*>$serial</td>";
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Χρήστης</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$user</td>";
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Εταιρέια</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$company</td>";

if ($pepserial=="0")
{}
else
{
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Pepper</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$pepserial</td>";
}
$ret .="</tr></tbody></table>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="<tr>";
$ret .="<td width=300><font color=$colour1>Το προϊον είναι εντός χρόνου εγγυήσης;</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=*>$guar1a</td>";
$ret .="</tr><tr>";
$ret .="<td width=300><font color=$colour1>Το προϊον πληρεί τους όρους εγγυήσης;</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=*>$guar2a</td>";
$ret .="</tr>";
$ret .="</tr></tbody></table>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="<tr>";
$ret .="<td width=300><font color=$colour1>Βλάβη που δηλώθηκε</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=* rowspan=3 valign=top>$problem</td>";
$ret .="</tr></tbody></table>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="<tr>";
$ret .="<td width=300><font color=$colour1>Εγκριση</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td colspan=2 width=*><select name=approval$i >
      				<option value=1>Εγκρίνεται</option>
      				<option value=2>Αποριπτεται</option>
					<option value=3>Αναμονή επιβεβαιωσης απο πελάτη</option>
					<option value=4 selected>Σε αναμονή</option>
    				</select></td>";
$ret .="</tr><tr>";
$ret .="<td width=300><font color=$colour1>Χρέωση</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
//$ret .="<td width=10><font color=$colour1>:</font></td>";
//$ret .="<td width=*><select name=charge_status$i >
      				//<option value=1>Ναί</option>
      				//<option value=2 selected>Όχι</option>
    				//</select>&nbsp;&nbsp;&nbsp;&nbsp;
$ret .="<td><input type=text name=charge$i size=5 value=0></td>";
$ret .="</tr><tr>";
$ret .="<td width=300><font color=$colour1>Σχόλια</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=50><select size=7 onChange=\"
if(this.value == '') return false;
if(this.form.comments$i.value.indexOf('Select from Drop Down List') > -1)
this.form.comments$i.value = '';
this.form.comments$i.value = this.options[this.selectedIndex].value;
\">";
$ret .="<b>Aπόρριψη</b>";
$ret .="<b><option style='background-color:blue; color:white;' value=''><b> Aπόρριψη</b></option></b>";
$ret .="<option value='Εκτός χρόνου εγγυήσης'>Εγγυηση Χρόνος</option>";
$ret .="<option value='Δεν πληρούνται οι όροι εγγυήσης'>Εγγυηση Οροι</option>";
$ret .="<option value='Το προϊόν δεν είναι διανομής Μακεδονικών Περιφερειακών.'>Εκτός Διανομής</option>";
$ret .="<option value='Μη αποδεκτή περιγραφή βλάβης'>Βλάβη</option>";
$ret .="<option value='Λάθος Serial Number'>Λάθος SN</option>";
$ret .="<option value='Θα πρέπει να απευθυνθείτε στην εταιρεία ΑΛΜΑΝ που χειρίζεται τις εγγυήσεις και το service των προϊόντων Viewsonic. Τηλ. 210-2409150'>Viewsonic</option>";
$ret .="<option value='Θα πρέπει να απευθυνθείτε στην εταιρεία INFOLEX που χειρίζεται τις εγγυήσεις και το service των προϊόντων Lexmark. Τηλ. 210-6722230'>Infolex</option>";

$ret .="<option  style='background-color:blue; color:white;' value=''><b>Χρέωση</b></option>";
$ret .="<option value='Κόστος ανταλλακτικών'>Ανταλλακτικα</option>";
$ret .="<option value='Χρέωση τεχνικού ελέγχου προϊόντος εκτός εγγύησης. Για την επισκευή του, θα χρειαστεί να επιβαρυνθείτε επιπλέον, με τα έξοδα των απαιτούμενων ανταλλακτικών.'>Εγγύηση</option>";
$ret .="<option value='Ο δίσκος δεν είναι διανομής Μακεδονικών Περιφερειακών. Η χρέωση για την διαχείριση της εγγύησής του είναι 3,5 ευρώ.  Επίσης για την αντικατάστασή του, θα χρεωθείτε την αξία του δίσκου που θα επιλέξετε μειωμένη κατά ΧΧ ευρώ.'>Εκτός Διανομής</option>";

$ret .="<option  style='background-color:blue; color:white;' value=''><b>Γενικά Σχόλια</b></option>";
$ret .="<option value='Οι περιγραφές βλάβης θα πρέπει να είναι πιο λεπτομερείς.'>Περιγραφές</option>";
$ret .="<option value='To σύστημα XPC πρέπει να παραδοθεί στο τεχνικό μας τμήμα χωρίς CPU, μνήμη και τα λοιπά περιφερειακά. Σε αντίθετη περίπτωση, θεωρείται ότι αποδέχεστε χρέωση τεχνικού ελέγχου συστήματος εκτός εγγύησης.'>XPC</option>";


$ret .="</select></td>";

 
//$ret .="<td width=50><SELECT  size=8 id=Category Name=Category onChange='SelectSubCat();' ></SELECT>
  //    </td>
   //   <td colspan=4 width=125>
 //     <SELECT Size=8 id=SubCat NAME=SubCat onChange='if(this.value == '') return false;
//if(this.form.comments$i.value.indexOf('Select from Drop Down List') > -1)this.form.comments$i.value = '';
//this.form.comments$i.value = this.options[this.selectedIndex].value;'>
//</SELECT></td>";

$ret .="<td width=200><textarea name=\"comments$i\" cols=\"60\" rows=\"7\"></textarea></td>";
$ret .="</tr>";
$ret .="<tr><td><br></td></tr>";
$ret .="</tbody></table><hr align=left width=75% size=5 noshade>";

print $ret;	


	
}


?>
  
    

      <table border="0">
        <tbody>
          <tr>
      <td width="192"></td>
      <td width="180" valign="top"></td>
      <td width="10" valign="top"></td>
      <td width="370" align="right"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()"></td>
    </tr>
        </tbody>
</table>

</body>
</html>

