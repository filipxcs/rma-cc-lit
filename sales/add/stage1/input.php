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
if ($_SESSION["userid"] == "5" || $_SESSION["userid"] == "20" || $_SESSION["userid"] == "6" || $_SESSION["userid"] == "22" || $_SESSION["userid"] == "23" || $_SESSION["userid"] == "24" || $_SESSION["userid"] == "25" || $_SESSION["userid"] == "17" || $_SESSION["userid"] == "26" || $_SESSION["userid"] == "31" || $_SESSION["userid"] == "11")
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
    <option value="1">Έγκριση</option>
   	</select></td>
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
?><body bgcolor=<?php  print $colour ?>>
Δεν έχετε τα απαραίτητα δικαιώματα για αυτήν την επιλόγη.
  </body>
<?php 
}
?>
</html>

