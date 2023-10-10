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
function populate() {
if(this.value == '') return false;
if(this.form.logos_epistrofis.value.indexOf('Select from Drop Down List') > -1)
this.form.logos_epistrofis.value = '';
this.form.logos_epistrofis.value = this.options[this.selectedIndex].value;
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
require("../../../session_check.php");
$date=date("d/m/Y");
$needle="-";
$needle1="@@@";
$domain1 = substr("$_POST[ppp]",0,strpos($_POST[ppp],$needle));
$domain1a = substr("$_POST[ppp]",strlen($domain1)+1,strlen($_POST[ppp]));
$domain2 = substr("$domain1a",0,strpos($domain1a,$needle));
$domain2a = substr("$domain1a",strlen($domain2)+1,strlen($domain1a));
$domain3 = substr("$domain2a",0,strpos($domain2a,$needle));
$domain3a = substr("$domain2a",strlen($domain3)+1,strlen($domain2a));
$domain4 = substr("$domain3a",0,strpos($domain3a,$needle));
$domain4a = substr("$domain3a",strlen($domain4)+1,strlen($domain3a));
$domain5 = substr("$domain4a",0,strpos($domain4a,$needle));
$domain5a = substr("$domain4a",strlen($domain5)+1,strlen($domain4a));

$timologio_agoras=$domain1." : ".$domain3." - ".$domain4;
$hmeromhnia_agoras=$domain2;
$posotita=$domain5;
$aksia_polisis=$domain5a;
if ($_POST[ispep]=="1")
{
$kodikos_eidous=substr("$_POST[ppp1]",0,strpos($_POST[ppp1],$needle1));
$perigrafh_eidous = substr("$_POST[ppp1]",strpos($_POST[ppp1],$needle1)+3,200);
}
else 
{
$kodikos_eidous=$_POST[kodikos_eidous];
$perigrafh_eidous=$_POST[perigrafh_eidous];
}
?>
  <body bgcolor="<?php print $colour?>" onLoad="fillCategory();">
    <FORM name="drop_list" action="insert.php" method="post">
      <table border="0">
  <tbody>
  <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός πελάτη</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $_POST[kodikos_pelath];?><input name="kodikos_pelath" type="hidden" value="<?php  print $_POST[kodikos_pelath];?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Κωδικός είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $kodikos_eidous;?><input name="kodikos_eidous" type="hidden" value="<?php  print $kodikos_eidous;?>">
      <input name="peppercode" type="hidden" value="<?php  print $_POST[peppercode];?>">
      </td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνία Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="*"><?php  print $hmeromhnia_agoras; ?><input name="hmeromhnia_agoras" type="hidden" value="<?php  print $hmeromhnia_agoras;?>"></td>
    </tr>
    
    <tr>
      <td width="20"></td>	
      <td width="135"><font color="<?php print $colour1?>">Πελάτης</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $_POST[pelaths];?><input name="pelaths" type="hidden" value="<?php  print $_POST[pelaths];?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Περιγραφή είδους</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $perigrafh_eidous; ?><input name="perigrafh_eidous" type="hidden" value="<?php  print $perigrafh_eidous;?>"></td>
      <td width="135"><font color="<?php print $colour1?>">Τιμολόγιο Αγοράς </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><?php  print $timologio_agoras; ?><input name="timologio_agoras" type="hidden" value="<?php  print $timologio_agoras;?>"></td>
    </tr>
 
    <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Ημερομηνια </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="220"><?php  print $date;?></td>
    </tr>
<tr>
      <td colspan="10"><br></td>
</tr>
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Με ποιόν μιλάμε;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><input name="me_poion_milame" value="" size="20" onKeyPress="return handleEnter(this, event)"></td>
      <td width="135"><font color="<?php print $colour1?>">Σειριακός Αριθμός</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><input name="serial_number" value="" size="20" onKeyPress="return handleEnter(this, event)"></td>
      <td width="135"><font color="<?php print $colour1?>">Χρέωση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="130"><input name="xreosi" value="0" size="2" onKeyPress="return handleEnter(this, event)"></td>
    </tr>
    <tr>
      <td colspan="7" width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Λόγος χρέωσης </font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td rowspan="2" width="130"><textarea name="logos_xreosis" cols="25" rows="2"></textarea></td>
      </tr>
      <tr>
      <td>&nbsp;</td>
      </tr>
    
<tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Dead on arrival</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><select name="DOA" >
      				<option value="1" >ΝΑΙ</option>
      				<option value="2" SELECTED >ΟΧΙ</option>
    				</select>
      </td>
      <td width="135"><font color="<?php print $colour1?>">Έχει εγγύηση</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><select name="warranty" >
      				<option value="1"  SELECTED>ΝΑΙ</option>
      				<option value="2" >ΟΧΙ</option>
    				</select>
      </td>
      <td width="135"><font color="<?php print $colour1?>">Έχει ξανάρθει;</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><select name="bumerang" >
      				<option value="1" >ΝΑΙ</option>
      				<option value="2" SELECTED >ΟΧΙ</option>
    				</select>
      </td>
    </tr>
    
    <tr>
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
        <textarea name="logos_epistrofis" cols="50" rows="3"></textarea> </td>
    </tr>
    
    <tr>
      <td width="20"></td>
      <td width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td colspan="7" width="125"><textarea name="parathrhseis" cols="50" rows="3"></textarea> </td>
    </tr>
          
    <tr>
      <td width="20"></td>
      <td width="135"><font color="<?php print $colour1?>">Μεταφορά</font></td>
      <td width="10"><font color="<?php print $colour1?>">:</font></td>
      <td width="220"><select name="metafora" >
      				<option value="1" >ΜΕΣΑ ΔΙΚΑ ΜΑΣ</option>
      				<option value="2" SELECTED >ΜΕΣΑ ΤΟΥ ΠΕΛΑΤΗ</option>
                    <option value="3" >ΜΕΤΑΦΟΡΙΚΗ</option>
    				</select>
      </td>
     
      <td  width="135" valign="top"><font color="<?php print $colour1?>">Παρατηρήσεις</font></td>
      <td  width="10" valign="top"><font color="<?php print $colour1?>">:</font></td>
      <td rowspan="3" colspan="4" width="125"><textarea name="metafora_parathrhseis" cols="50" rows="3"></textarea> </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4" width="*"></td>
      <td width="125" align="right"><input name="submit" type="submit" value="καταχώρηση" onClick="changeFrames()"></td>
      <td colspan="5" width="*"></td>
    </tr>
   
   </tbody>
</table>
</FORM>
</body>
</html>

