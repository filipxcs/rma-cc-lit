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
    parent._bottom2.location.href = '../menu/blank.php';
    }
function changeFrames1(url1) {
    parent._bottom1.location.href = '../menu/blank.php';
    parent._bottom2.location.href = '../menu/blank.php';
    }	
</script>
<script language="javascript" src="list.js"></script>
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
$needle="@@@";
$rmaid = substr("$_POST[rmaid]",0,strpos($_POST[rmaid],$needle));
$domain = substr("$_POST[rmaid]",strpos($_POST[rmaid],$needle)+3,200);
$kind1 = substr("$domain",0,strpos($domain,$needle));
$transid = substr("$domain",strpos($domain,$needle)+3,200);

#print $_POST[rmaid]."<br>";
#print $rmaid."-".$kind."-".$transid;


$query="SELECT rmaid,stageid,tracode,leename,codcode,itmname,sn,doa,inwar,bumerang,malfunction,date_format(purchdate,'%d-%c-%Y')AS 'purchdate',purchdoc,transport,transportcomments,contactname,noreason,userblame FROM rmaservice where rmaid='$rmaid%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $rmaid=mysql_result($result,$i,"rmaid");
	$stageid=mysql_result($result,$i,"stageid");
	$kodikos_pelath=mysql_result($result,$i,"tracode");
	$pelaths=mysql_result($result,$i,"leename");
    $kodikos_eidous=mysql_result($result,$i,"codcode");
	$perigrafh_eidous=mysql_result($result,$i,"itmname");
	$serial_number=mysql_result($result,$i,"sn");
    $doa=mysql_result($result,$i,"doa");
    $warranty=mysql_result($result,$i,"inwar");
	$bumerang=mysql_result($result,$i,"bumerang");
	$logos_epistrofhs=mysql_result($result,$i,"malfunction");
	$hmeromhnia_agoras=mysql_result($result,$i,"purchdate");
    $timologio_agoras=mysql_result($result,$i,"purchdoc");
	$metafora=mysql_result($result,$i,"transport");
	$metafora_parathrhseis=mysql_result($result,$i,"transportcomments");
	$me_poion_milame=mysql_result($result,$i,"contactname");
	$noreason=mysql_result($result,$i,"noreason");
	$userblame=mysql_result($result,$i,"userblame");
	
}
## ------------------------------------------------------------------------------------------------------------------------------------

$query="SELECT date_format(date,'%d-%c-%Y')AS 'trans_date',kind,userid,docid,docdetails,details FROM transactions where rmaid='$rmaid' and transid='$transid' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");
	$userid=mysql_result($result,$i,"userid");
	$docdetails=mysql_result($result,$i,"docdetails");
	$details=mysql_result($result,$i,"details");
}

$needle="@@@";
$dotcode = substr("$docdetails",0,strpos($docdetails,$needle));
$d1 = substr("$docdetails",strpos($docdetails,$needle)+3,100);
$docnumber = substr("$d1",0,strpos($d1,$needle));
$docdateora = substr("$d1",strpos($d1,$needle)+3,100);
$year=substr($docdateora,6,2);
$month=substr($docdateora,3,2);
$day=substr($docdateora,0,2);
$docdate=$day."-".$month."-20".$year;

$query="SELECT username FROM user WHERE userid='$userid'";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $username=mysql_result($result,$i,"username");
	}

#--------------------------------------------------------------------------------------------------------------------------------


$query="SELECT date_format(date,'%d-%c-%Y')AS 'trans_date',kind,details FROM transactions where rmaid='$rmaid%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $trans_date=mysql_result($result,$i,"trans_date");
	$kind=mysql_result($result,$i,"kind");
    $parathrhseis=mysql_result($result,$i,"details");
	
}

$query="SELECT date_format(date,'%d-%c-%Y')AS 'charge_date',value,comment FROM charges where rmaid='$rmaid%' order by rmaid";
$result=mysql_query($query);
$num=mysql_numrows($result);

for ($i = 0; $i < $num; $i++ )
	{
	
    $charge_date=mysql_result($result,$i,"charge_date");
	$xreosi=mysql_result($result,$i,"value");
    $logos_xreosis=mysql_result($result,$i,"comment");
$teliki_xreosi=$teliki_xreosi+$xreosi;
	
}



if ($doa == "1" )
{$doa1="SELECTED";}
else if ($doa == "2" )
{$doa2="SELECTED";}

if ($warranty == "1" )
{$warranty1="SELECTED";}
else 
{$warranty2="SELECTED";}


if ($bumerang == "1" )
{$bumerang1="SELECTED";}
else if ($bumerang == "2" )
{$bumerang2="SELECTED";}

if ($metafora == "1" )
{$metafora1="ΜΕΣΑ ΔΙΚΑ ΜΑΣ";}
else if ($metafora == "2" )
{$metafora1="ΜΕΣΑ ΤΟΥ ΠΕΛΑΤΗ";}
else if ($metafora == "3" )
{$metafora1="ΜΕΤΑΦΟΡΙΚΗ";}

if ($noreason == "1" )
{$noreason1="SELECTED";}
else
{$noreason2="SELECTED";}
if ($userblame == "1" )
{$userblame1="SELECTED";}
else
{$userblame2="SELECTED";}

if ($kind1 == "κεντρικά")
{

?>
  <body bgcolor="<?php print $colour?>" onLoad="fillCategory();">
   
    


      <table border="0" width="80%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $trans_date;?></td>
          </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός πελάτη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $kodikos_pelath; ?></td>
      <FORM name="form"  action="codcode_change_input.php" target="_bottom1" method="post">
      <td width="135"><font color="<?php print $colour1?>">Κωδικός είδους
      <input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
      <input name="submit" type="submit" value=">" onClick="changeFrames()"></font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><?php print $kodikos_eidous;?></td>
       </FORM>
   </tr>      
    <tr>
      <td width="20"></td>
       <FORM name="form"  action="name_change_input.php" target="_bottom1" method="post">
       
      <td width="135"><font color="<?php print $colour1?>">Πελάτης
      <input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
      <input name="submit" type="submit" value=">" onClick="changeFrames()"></font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php print $pelaths; ?></td>
     
      </FORM>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250" rowspan="2" valign="top"><?php print $perigrafh_eidous ;?></td>
    </tr>
    <tr>
      <td colspan="3"><br></td>
</tr>
    <tr>
      <td colspan="7"><br></td>
</tr>
 <tr>
  <FORM name="drop_list" action="central_change.php" method="post">
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Λόγος Επιστροφής </font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125">
      <SELECT  size="4" id="Category" Name="Category" onChange="SelectSubCat();" >
</SELECT>
      
      <SELECT Size="4" id="SubCat" NAME="SubCat" onChange="
if(this.value == '') return false;
if(this.form.logos_epistrofis.value.indexOf('Select from Drop Down List') > -1)
this.form.logos_epistrofis.value = '';
this.form.logos_epistrofis.value = this.options[this.selectedIndex].value;">
      </SELECT>
        <textarea name="logos_epistrofis" cols="50" rows="3"><?php print $logos_epistrofhs; ?></textarea> </td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
      
   </tbody>
</table>
     <table border="0" width="80%">
  <tbody>
    <tr>
    <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Με ποιόν μιλήσαμε;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><input name="me_poion_milame" value="<?php print $me_poion_milame; ?>" size="15" onKeyPress="return handleEnter(this, event)"></td>
      <td width="135"><font color="<?php print $colour1?>">Σειριακός Αριθμός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><input name="serial_number" value="<?php print $serial_number; ?>" size="20" onKeyPress="return handleEnter(this, event)"></td>
      </tr>
       
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Dead on arrival</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><select name="DOA" >
      				<option value="1" <?php print $doa1; ?>>ΝΑΙ</option>
      				<option value="2" <?php print $doa2; ?> >ΟΧΙ</option>
    				</select>
	  </td>
      
      <td width="135"><font color="<?php print $colour1?>">Έχει εγγύηση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><select name="warranty" >
      				<option value="1" <?php print $warranty1; ?>>ΝΑΙ</option>
      				<option value="2" <?php print $warranty2; ?>>ΟΧΙ</option>
    				</select>
	  </td>
</tr>
<tr>    
      <td width="20"></td>  
      <td width="135"><font color="<?php print $colour1?>">Έχει ξανάρθει;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><select name="bumerang" >
      				<option value="1" <?php print $bumerang1; ?>>ΝΑΙ</option>
      				<option value="2" <?php print $bumerang2; ?>>ΟΧΙ</option>
    				</select>
	  </td>
      <td width="135"><font color="<?php print $colour1?>">Χρέωση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><?php print $teliki_xreosi; ?></td>
    </tr>    

    
      <tr>
    <td>&nbsp;</td>
    </tr>
      <tr>
    <td>&nbsp;</td>
    </tr>
      <tr>
    <td colspan="7">&nbsp;</td>
    </tr>
  
<tr>    
      <td width="20"></td>  
      <td width="135"><font color="<?php print $colour1?>">Αναίτια Επιστροφή</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="250"><select name="noreason" >
      				<option value="1" <?php print $noreason1; ?>>ΝΑΙ</option>
      				<option value="2" <?php print $noreason2; ?>>ΟΧΙ</option>
    				</select>
	  </td>
      <td width="135"><font color="<?php print $colour1?>">Υπαιτιότητα Χρήστη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><select name="userblame" >
      				<option value="1" <?php print $userblame1; ?>>ΝΑΙ</option>
      				<option value="2" <?php print $userblame2; ?>>ΟΧΙ</option>
    				</select>
	  </td>
    </tr> 
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>    
        <tr>
      <td colspan="3" width="*"></td>
      <td width="125" align="right">
      <input name="rmaid" type="hidden" value="<?php print $_POST[rmaid]; ?>">
      <input name="submit" type="submit" value="Αλλαγή" onClick="changeFrames1()"></td>
      <td colspan="5" width="*"></td>
      </FORM>
    </tr>

  
    

   
   </tbody>
</table>
<?php
}
#-----------------------------------------------------------------------------------------------------------------------------------
else if ($kind1 == "Παραλαβή")
{

$query="SELECT package,included,comments FROM package where rmaid='$rmaid'";
$result=mysql_query($query);


    $pack=mysql_result($result,0,"package");
	$incl=mysql_result($result,0,"included");
	$package_details=mysql_result($result,0,"comments");

if ($pack == "1")
{$package1="SELECTED";}
else
{$package2="SELECTED";}
if ($incl == "1")
{$included1="SELECTED";}
else
{$included2="SELECTED";}


	


?>

<body bgcolor="<?php print $colour ?>">
<FORM name="paralavi" action="paralavi_change.php" method="post">
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php print $trans_date;?></td>
      </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php print $username; ?></td>
      </tr>      
 <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Δελτίο Παραλαβής :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php print $dotcode."-".$docnumber;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια Παραλαβής :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php print $docdate;?></td>
      </tr>  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Συσκευασία :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><select name="package" >
      				<option value="1" <?php print $package1;?>>ΝΑΙ</option>
      				<option value="2" <?php print $package2;?>>ΟΧΙ</option>
    				</select>      
	  </td>
      <td width="135"><font color="<?php print $colour1?>">Παρελκυόμενα :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><select name="included" >
      				<option value="1" <?php print $included1;?>>ΝΑΙ</option>
      				<option value="2" <?php print $included2;?>>ΟΧΙ</option>
    				</select>  
	  </td>
      </tr> 
      <tr>
      <td width="20"></td>
      <td width="135" valign=top><font color="<?php print $colour1?>">Συσκευασία </font></td>
      <td width="10" valign=top><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><textarea name="package_details" cols="30" rows="2"><?php print $package_details;?></textarea></td>
      </tr>
     <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="3" width="105"><textarea name="details" cols="50" rows="3"><?php print $details;?></textarea></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" width="*"></td>
      <td width="125" align="right">
      <input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
      <input name="transid" type="hidden" value="<?php print $transid; ?>">
      <input name="kind" type="hidden" value="<?php print $kind1; ?>">
      <input name="submit" type="submit" value="Αλλαγή" onClick="changeFrames1()"></td>
      <td colspan="5" width="*"></td>
      </FORM>
    </tr>
   </tbody>
</table>
<?php
}

else if ($kind1 == "Δήλωση")
{


?>

<body bgcolor="<?php print $colour ?>">
<FORM name="paralavi" action="dilosh_change.php" method="post">
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php print $trans_date;?></td>
      </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php print $username; ?></td>
      </tr>      
      <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="3" width="105"><textarea name="details" cols="50" rows="3"><?php print $details;?></textarea></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" width="*"></td>
      <td width="125" align="right">
      <input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
      <input name="transid" type="hidden" value="<?php print $transid; ?>">
      <input name="kind" type="hidden" value="<?php print $kind1; ?>">
      <input name="submit" type="submit" value="Αλλαγή" onClick="changeFrames1()"></td>
      <td colspan="5" width="*"></td>
      </FORM>
    </tr>
   </tbody>
</table>
<?php
}

else if ($kind1 == "Uncancel")
{



include 'uncancel.php';
}

else if ($kind1 == "Τερματισμός")
{
$query="SELECT checktype FROM checks where rmaid='$rmaid'";
$result=mysql_query($query);
$check=mysql_result($result,0,"checktype");

$query="SELECT * FROM checktypes";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
for ($i = 0; $i < $num; $i++ )
	{
	
	$checktype=mysql_result($result,$i,"checktype");
	$checkdescription=mysql_result($result,$i,"checkdescription");
	if ($checktype==$check)
	{$display_block.="<OPTION value=\"$checktype\" SELECTED>$checkdescription</OPTION>";}
	else
	{$display_block.="<OPTION value=\"$checktype\">$checkdescription</OPTION>";}
	}

?>

<body bgcolor="<?php print $colour ?>">
<FORM name="paralavi" action="termatismos_change.php" method="post">
<table border="0" align="center" width="100%">
  <tbody>
   <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Αριθμός RMA :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50"><?php print $rmaid;?></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια :</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php print $trans_date;?></td>
      </tr>  
    
  
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Τεχνικός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><?php print $username; ?></td>
      </tr>      
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Κίνηση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="50" colspan="4"><SELECT name="new_check">
<?php print $display_block; ?>
</SELECT></td>
      </tr>      
      <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td valign="top" colspan="4" rowspan="3" width="105"><textarea name="details" cols="50" rows="3"><?php print $details;?></textarea></td>
    </tr>
       
      <tr>
    <td>&nbsp;</td>
    </tr>
     <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" width="*"></td>
      <td width="125" align="right">
      <input name="rmaid" type="hidden" value="<?php print $rmaid; ?>">
      <input name="transid" type="hidden" value="<?php print $transid; ?>">
      <input name="kind" type="hidden" value="<?php print $kind1; ?>">
      <input name="submit" type="submit" value="Αλλαγή" onClick="changeFrames1()"></td>
      <td colspan="5" width="*"></td>
      </FORM>
    </tr>
   </tbody>
</table>
<?php
}
?>
</body>
</html>

