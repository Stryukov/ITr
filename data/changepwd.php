<?php
include "../db.php";
session_start();
$uid = $_SESSION['id'];
$new = crypt(iconv('utf-8','windows-1251',$_POST["new"]));

$stmt = sqlsrv_query($conn,
        "SELECT pwditr FROM Employees WHERE id=$uid");
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row['pwditr'] == crypt(iconv('utf-8','windows-1251',$_POST["old"]), $row['pwditr'])) {
    	$stmt = sqlsrv_query($conn,"update Employees set pwditr = '$new' WHERE id=$uid");
        if( $stmt === false ) {      
		echo "Error in executing statement.\n";      
		die( print_r( sqlsrv_errors(), true)); }  
        echo json_encode('yes');
    } else {
    	echo json_encode('notmatch');
    }

sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);

?>