<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<hr />
<?php
require("../params.php");
?>
<body bgcolor=<?php print $colour?>>
<FORM name=f1  action="sales-view.php" target="mainFrame" method=post>
<table border="0">
  <tbody>
    <tr>
      <td><select name="searchitem">
    <option value="1">Πελάτης</option>
    <option value="2">Έιδος</option>
	<option value="3">RMA</option>
  </select></td>
      <td><input name="item" type="text" size="20"></td>
<td><input name="submit" type="submit" value="Εύρεση" ></td>
    </tr>
    </tbody>
</table>
</form>
</body>
</html>
