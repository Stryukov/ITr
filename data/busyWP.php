<?php

/**
 * @author mr. green
 * @copyright 2015
 */

include "../db.php";
session_start();

$idOwner = $_SESSION['id'];
$idEmployee = $_GET['id'];
$NameWP = iconv('utf-8','windows-1251',$_GET["inp"]);
$StreetWP = '';

$tsql_callSP = "{call busyWP( ?,?,?,? )}";  

$params = array(
array(&$NameWP,SQLSRV_PARAM_INOUT),
array(&$StreetWP, SQLSRV_PARAM_OUT), 
array(&$idEmployee, SQLSRV_PARAM_IN),
array(&$idOwner, SQLSRV_PARAM_IN)
);  


$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}
else
{
    while(sqlsrv_next_result($stmt))
    {
        $row = sqlsrv_fetch_array($stmt);
        if($row){
        	echo json_encode(array(iconv('windows-1251','utf-8',$row['WP']),iconv('windows-1251','utf-8',$row['Street'])));
        }
		
    }
}


sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);

?>