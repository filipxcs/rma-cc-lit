<html>
<head>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-7">
</head>
<?php
require("../params.php");
?>
<body bgcolor=<?php print $colour ?>>
<FORM name="login" action="menu/index.php" method="POST">
<table width="40%" border="0" align="left">
  <tbody>
    <tr>
      <td width="30%">Όνομα Χρήστη :</td>
      <td width="30%"><?php print "<input type=\"text\" name=\"username\">"; ?></td>
    </tr>
    <tr>
      <td width="10%">Κωδικός Πρόσβασης :</td>
      <td width="10%"><?php print "<input type=\"password\" name=\"passwd\">"; ?></td>
      <td width="20%"><input type="submit" value="OK"></td>
    </tr>
  </tbody>
</table>
</form>
</body>
</html>
