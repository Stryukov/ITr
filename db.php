<?php
include("cnf.php");
$cnf = new cnf;
$serverName = $cnf->dbserver; //serverName\instanceName
$connectionInfo = array( "Database"=>$cnf->dbname, "UID"=>$cnf->dbuser, "PWD"=>$cnf->dbpass);
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ) {
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
