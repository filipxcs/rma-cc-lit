<?php
$sessionid=$_SESSION["sessionid"];
$query="select sessionid from rma.sessions where sessionid=$sessionid";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num == 0)
{
?>
<script type="text/javascript">
//top.location.href="http://192.168.1.130/rma/sales/index.php"
//alert("Need to login again");
</script>
<?php
}
else 
{}
?>
