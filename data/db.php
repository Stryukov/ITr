<?php
$db = mssql_connect ("sqlserver","service","123456") or die("connect problem");
	mssql_select_db ("[ITr]", $db) or die("db problem") ;
    
?>
