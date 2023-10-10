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
require("../../../params.php");
require("../../../mysql.php");
require("../../../session_check_s.php");
?>
<?php 
if ($_SESSION["sesid"] == "6" || $_SESSION["sesid"] == "20"  || $_SESSION["sesid"] == "35"  || $_SESSION["sesid"] == "5" || $_SESSION["sesid"] == "27" || $_SESSION["sesid"] == "28" || $_SESSION["sesid"] == "23" || $_SESSION["sesid"] == "23"|| $_SESSION["sesid"] == "24" || $_SESSION["userid"] == "31" || $_SESSION["userid"] == "11" || $_SESSION["userid"] == "7")
{
?>
<br>
<br>
<body bgcolor=<?php print $colour?>>
<FORM name="form"  action="select.php" target="_bottom2" method="post">
<table border="0">
  <tbody>
    <tr>
      <td><select name="searchitem">
    <option value="1">RMA</option>
    <option value="2">Πελάτης</option>
	<option value="3">Έιδος</option>
    <option value="5">Orders</option>
    <option value="6">Packets</option>
    <option value="4">Όλα</option>
  </select></td>
      <td><input name="item" type="text" size="10"></td>
<td><input name="submit" type="submit" value="Εύρεση" ></td>
    </tr>
    <tr>
    <td colspan="3" width="*"><input name="date_return" value="<?php  print $date; ?>" size="11" onKeyPress="return handleEnter(this, event)">&nbsp;<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.date_return);return false;" ><img class="PopcalTrigger" align="absmiddle" src="date/calbtn.gif" width="34" height="22" border="0" alt=""></a></td>
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
?><body bgcolor=<?php  print $colour ?>>
Δεν έχετε τα απαραίτητα δικαιώματα για αυτήν την επιλόγη.
  </body>
<?php 
}
?>

</html>

