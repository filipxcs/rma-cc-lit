<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>input</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
require("../../params.php");
require("../../mysql.php");
require("../../session_check.php");
$date=date("d/m/Y");
?>
<?php
$query="SELECT permissions FROM rma.user where userid = '$_SESSION[userid]'";
$result=mysql_query($query);
$perm=mysql_result($result,0,"permissions");
if ($perm==1 || $perm==2 || $perm==3 || $perm==4)
{
?>
<br>
<body bgcolor=<?php print $colour?>>
<FORM name="form"  action="select.php" target="_bottom2" method="post">
<table border="0">
  <tbody>
    <tr>
      <td><select name="searchitem">
    <option value="1">RMA</option>
    <option value="8">Online</option>
    <option value="2">Πελάτης</option>
	<option value="3">Έιδος</option>
	<option value="4">Όλα</option>
	<option value="5">Serial</option>
    <option value="6">Ανοιχτά Πελάτης</option>
    <option value="7">Ανοιχτά Είδος</option>
   
  </select></td>
      <td><input name="item" type="text" size="10"></td>
<td><input name="submit" type="submit" value="Εύρεση" ></td>
    </tr>
    <tr>
    <td colspan="3" width="*"><input name="date_return" value="<?php print $date; ?>" size="11" onKeyPress="return handleEnter(this, event)">&nbsp;<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.date_return);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
          </tr>
    <tr>
    <td colspan="3">Αναζητηση με ημερομηνία :<input name="date_ok" type="checkbox" value="1"></td>
    </tr>
    </tbody>
</table>
</form>
<iframe width=174 height=189 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="date/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px; margin-top:-7;">
</iframe>
</body>
<?php
}
else 
{
?><body bgcolor=<?php print $colour ?>>
Δεν έχετε τα απαραίτητα δικαιώματα για αυτήν την επιλόγη.
  </body>
<?php
}
?>

</html>

