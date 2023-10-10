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
<body bgcolor=<?php print $colour?>>
<FORM name=f1  action="name_change_find.php" target="_bottom2" method=post>
<table border="0">
  <tbody>
    <tr>
      <td colspan="3">Όνομα Πελατη / Α.Φ.Μ / Κωδικό ΣΕΝ:</td>
     </tr>
     <tr> 
      <td><input name="pel" type="text" size="15"></td>
    </tr>
    <td align="right">
    <input name="rmaid" type="hidden" value="<?php print $_POST[rmaid]; ?>">
    <input name="submit" type="submit" value="Εύρεση" ></td>
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

