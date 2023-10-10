<?php
session_start();
?>
<html>
<head>
<title>Top2a</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php require_once("frames1.js"); ?>
</head>
<?php
require("../../params.php");
?>
<body bgcolor=<?php print $colour?>>
<?php
$stage=$_SESSION["stage"];
require_once($stage);?>
<img usemap="#stagea" src="../Images/stage4.gif" width="290" height="45" align="left" border="0">
  </body>
</html>
