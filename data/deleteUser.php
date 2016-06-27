<?php

include "../db.php";
session_start();

$id = $_POST["id"];
$ssId = $_SESSION['id'];

$mass = split(',',$id);
for ($i=0;$i<count($mass);$i++) {
$id2=$mass[$i];    
//////////////////
$tsql_callSP = "{call delUser( ?, ?, )}";  
$params = array(
array($id2,SQLSRV_PARAM_IN),
array($ssId, SQLSRV_PARAM_IN), 
);  
$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);  

if( $stmt === false ) {      
echo "Error in executing statement.\n";      
die( print_r( sqlsrv_errors(), true)); }  

sqlsrv_free_stmt( $stmt); 
sqlsrv_close($conn);
//////////////////////
}

echo  'ok';
?>