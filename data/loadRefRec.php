<?php

include "../db.php";

$idRec = $_GET['idRec'];
$tblId = $_GET['tblId'];

$tsql_callSP = "{call loadRefRec( ?,? )}";  

$params = array(
array(&$idRec, SQLSRV_PARAM_IN),
array(&$tblId, SQLSRV_PARAM_IN)
);  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt); 
$content = iconv('windows-1251','utf-8', $row['name']).'|'.iconv('windows-1251','utf-8', $row['description']).'|'.iconv('windows-1251','utf-8', $row['parent']).'|';
echo  $content;
sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);
?>