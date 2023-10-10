<?php
$sessionid=$_SESSION["sessionid"];
$userid=$_SESSION["userid"];
#print $userid;
$query="select sessionid from sessions where sessionid=$sessionid";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num == 0)
{
?>
<script type="text/javascript">
top.location.href="http://192.168.1.46/rma/service/index.php"
//alert("Need to login again");
</script>
<?php
}
else 
{}
?>
