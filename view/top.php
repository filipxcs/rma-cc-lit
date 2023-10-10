<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Κατάσταση RMA</title>
<?php require_once("frames.js"); ?>
</head>
<?php
require("../params.php");
?>
<body bgcolor=<?php print $colour?>>
<map name="top">
  <area shape="rect" href="sales.php" target="bottomFrame" coords="415,8,526,35" onclick="changeFrames('top.php')" />
  <area shape="rect" href="service-menu.php" target="mainFrame" coords="245,9,376,34" onclick="changeFrames('top.php')" />
</map>
<img usemap="#top" src="../Images/View.gif" width="640" height="43" align="center" border="0">
<hr>
</body>
</html>
