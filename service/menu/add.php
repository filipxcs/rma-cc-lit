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
require("../../mysql.php");
require("../../session_check.php");
?>
<body bgcolor=<?php print $colour?>>
<?php require_once("add_stage.php");
$_SESSION["stage"]="add_stage.php";?>

<img usemap="#stagea" src="../Images/top2a.gif" width="290" height="45" align="left" border="0">

  </body>
</html>
