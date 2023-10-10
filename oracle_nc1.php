<?php
putenv("NLS_LANG=GREEK_GREECE.UTF8");
putenv("NLS_CHARACTERSET=UTF8");
$db_conn_nc = ocilogon( "S01005", "S01005", "//192.168.1.199/SEN" );
?>
