<?php
putenv("NLS_LANG=GREEK_GREECE.UTF8");
putenv("NLS_CHARACTERSET=UTF8");
$db_conn = ocilogon( "S01001", "S01001", "//192.168.1.199/SEN" );
?>
