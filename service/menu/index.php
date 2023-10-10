<?php
session_start();

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

</head>
<?php
require("../../params.php");
require("../../mysql.php");
$today = date("Y-m-d");
$query="SELECT * from user WHERE login='$_POST[username]' and password='$_POST[passwd]'";
$result=mysql_query($query);
$num=mysql_numrows($result);
for ($i = 0; $i < $num; $i++ )
	{	
	$flag="1";
	$userid=mysql_result($result,$i,"userid");
	$username=mysql_result($result,$i,"username");
	}
$query="DELETE FROM sessions WHERE userid=$userid";
$result=mysql_query($query);
$query="DELETE FROM sessions WHERE userid='0'";
$result=mysql_query($query);	
$query="INSERT INTO sessions VALUES(\"\",\"$userid\",\"$today\")";
$result=mysql_query($query);
$query="select sessionid from sessions where userid=$userid";
$result=mysql_query($query);
$sessionid=mysql_result($result,0,"sessionid");

$_SESSION["userid"]=$userid;
$_SESSION["sessionid"]=$sessionid;
mysql_close();
if ($flag=="1") 
{
?>
<title>Συνδεμένος χρήστης :<?php print $username; ?> </title>
<frameset rows="55,10,*,10,160" framespacing="0" frameborder="no" border="0">
	<frameset cols="550,*" framespacing="0" frameborder="no" border="0">
		<frame src="top1.php" name="_top1" scrolling="no">
		<frame src="blank.php" name="_top2" scrolling="no">
	</frameset>
	<frame  src="mainblank1.php" name="_main0" scrolling="no">
	<frame  src="mainblank.php" name="_main1" scrolling="auto">
	<frame  src="mainblank1.php" name="_main2" scrolling="no">
	<frameset cols="300,*" framespacing="0" frameborder="no" border="0">
		<frame  src="blank.php" name="_bottom1" scrolling="no">
		<frame  src="blank.php" name="_bottom2" scrolling="no">
	</frameset>
</frameset>
<noframes><body>
</body></noframes>
<?php
}
else if ($flag=="2")
{
?>
<title>Συνδεμένος χρήστης :<?php print $_POST[username]; ?></title>
<frameset rows="55,10,*,10,160" framespacing="0" frameborder="no" border="0">
	<frameset cols="550,*" framespacing="0" frameborder="no" border="0">
		<frame src="top1a.php" name="_top1" scrolling="no">
		<frame src="blank.php" name="_top2" scrolling="no">
	</frameset>
	<frame  src="mainblank1.php" name="_main0" scrolling="no">
	<frame  src="mainblank.php" name="_main1" scrolling="auto">
	<frame  src="mainblank1.php" name="_main2" scrolling="no">
	<frameset cols="300,*" framespacing="0" frameborder="no" border="0">
		<frame  src="blank.php" name="_bottom1" scrolling="no">
		<frame  src="blank.php" name="_bottom2" scrolling="no">
	</frameset>
</frameset>
<noframes><body>
</body></noframes>
<?php
}
else 
{echo "Access Denied";}
?>
</html>

