<?php
$year=substr($_POST[dc],6,4);
$month=substr($_POST[dc],3,2);
$day=substr($_POST[dc],0,2);
$date=$year."-".$month."-".$day;
$rma_date=date("Y/m/d");
?>
