<?php
include "../db.php";
session_start();
$ssId = $_SESSION['id'];
$NameWP = iconv('utf-8','windows-1251',$_GET["inp"]);
$StreetWP = iconv('utf-8','windows-1251',$_GET["street"]);

$tsql_callSP = "{call changeStreet( ?,? )}";  

$params = array(
array($NameWP,SQLSRV_PARAM_INOUT),
array($StreetWP, SQLSRV_PARAM_INOUT) 
);  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);  

if( $stmt === false ) {      
echo "Error in executing statement.\n";      
die( print_r( sqlsrv_errors(), true)); }  

echo json_encode(array(iconv('windows-1251','utf-8', $StreetWP)));    

sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);

?>