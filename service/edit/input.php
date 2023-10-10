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
$query="SELECT permissions FROM rma.user where userid = '$_SESSION[userid]'";
$result=mysql_query($query);
$perm=mysql_result($result,0,"permissions");
if ($perm==2 || $perm==3 || $perm==4)
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
  </select></td>
      <td><input name="item" type="text" size="10"></td>
<td><input name="submit" type="submit" value="Εύρεση" ></td>
    </tr>
    </tbody>
</table>
</form>


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

