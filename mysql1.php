<?php
$galandriel=mysql_connect("192.168.1.230","myadmin","avensis");
$haldir=mysql_connect("192.168.1.40","myadmin","avensis");
//mysql_select_db(macedonian) or die( "Unable to select database");
$query="set names utf8";
$result=mysql_query($query,$galadriel);
$result=mysql_query($query,$haldir);
?>
