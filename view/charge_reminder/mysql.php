<?php

mysql_connect("192.168.1.40","myadmin","avensis");
mysql_select_db(rma) or die( "Unable to select database");
$query="set names utf8";
$result=mysql_query($query);
?>
