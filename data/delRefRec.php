<?php

include "../db.php";
session_start();

$txt = $_GET["recId"];
$tblId = $_GET["tblId"];

$tsql_callSP = "{call delRefRec( ?,? )}";  

$params = array(
array(&$txt, SQLSRV_PARAM_IN),
array(&$tblId, SQLSRV_PARAM_IN)
);  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt); 
echo $row['result'];
sqlsrv_free_stmt( $stmt);  
include "getISAS.php";
?>