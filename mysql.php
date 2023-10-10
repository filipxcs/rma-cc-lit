<?php
mysql_connect("192.168.1.40","myadmin","avensis");
mysql_select_db(rma) or die( "Unable to select database");
$query="set names utf8";
$result=mysql_query($query);
?>


<?php
/**
 * @author [Lazaridis Ioannis]
 * @email [lazaridis.ioannis@cc-lit.gr]
 * @create date 2020-10-08 01:22:53
 * @modify date 2020-10-08 01:22:53
 * @desc [Every function is deprecated. DO NOT enable errors.]
 */

 /**THis connection is unsafe. msql_connect is deprecated. */

// mysql_connect("192.168.1.37","rma","avensis");
// mysql_select_db('rma') or die( "Unable to select database");
// //mysqli_connect("192.168.1.37", "rma", "avensis", "rma");
// $query="set names utf8";
// $result=mysql_query($query);
?>
