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
$needle="@@@";
$docid = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$docdetails = substr("$_POST[ppp]",strpos($_POST[ppp],$needle)+3,200);
$cmdstr = "SELECT TRAID FROM SLD
WHERE docid='$docid'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results); 
for ($i = 0; $i < $nrows; $i++ )
  {
		$traid=$results["TRAID"][$i];
		}
$cmdstr = "SELECT * FROM SSD
WHERE docid='$docid'";
$parsed = ociparse($db_conn, $cmdstr);
ociexecute($parsed);
$nrows = ocifetchstatement($parsed, $results);                                                                   

?>		
<body bgcolor="<?php print $colour?>">
<?php


$ii=0;
for ($i = 0; $i < $nrows; $i++ )
	{
		$codcode=$results["CODCODE"][$i];
		$stdqtya=$results["STDQTYA"][$i];

$query="SELECT rmaid,tracode,leename,codcode,itmname,sn,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname FROM rmaservice where  codcode='$codcode' and tracode='$traid' AND stageid='6'";
$result=mysql_query($query);
$num=mysql_numrows($result);
$display_block="";
for ($ii = 0; $ii < $num; $ii++ )

	{
	
    $rmaid=mysql_result($result,$ii,"rmaid");
	$leename=mysql_result($result,$ii,"LEENAME");
	$serial=mysql_result($result,$ii,"sn");
	$kodikos_eidous=mysql_result($result,$ii,"codcode");
	$display_block.="<OPTION value=\"$i@$stdqtya@$rmaid\"> $serial </OPTION>";
	}

	
$ret ="";
$ret .="<FORM name='form' action='insert1.php' method='post'>";
$ret .="<input type=hidden name=docid value=$docid><input type=hidden name=docdetails value=$docdetails><input type=hidden name=id$i value=$id>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<td width=60><font color=$colour1>A/A</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$i</td>";
$ret .="</tr><tr>";
$ret .="<td width=60><font color=$colour1>Είδος</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$codcode</td>";
$ret .="<td width=40></td>";
$ret .="<td width=60><font color=$colour1>Ποσότητα</font></td>";
$ret .="<td width=10><font color=$colour1>:</font></td>";
$ret .="<td width=250>$stdqtya</td>";
$ret .="<td width=40></td>";
$ret .="</tr>";
$ret .="</tbody></table>";
$ret .="<table border='0'><tbody><tr>";
$ret .="<tr>";
$ret .="<tr><td><br></td></tr>";

$ret .="<tr>";
$ret .="<td width=50><select name='selections[]' size=7 multiple='multiple'>";
$ret .="$display_block";
$ret .="<b>Aπόρριψη</b>";
$ret .="</select></td>";

 
//$ret .="<td width=50><SELECT  size=8 id=Category Name=Category onChange='SelectSubCat();' ></SELECT>
  //    </td>
   //   <td colspan=4 width=125>
 //     <SELECT Size=8 id=SubCat NAME=SubCat onChange='if(this.value == '') return false;
//if(this.form.comments$i.value.indexOf('Select from Drop Down List') > -1)this.form.comments$i.value = '';
//this.form.comments$i.value = this.options[this.selectedIndex].value;'>
//</SELECT></td>";

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

