<?php

include "../db.php";
session_start();

$tblId = $_GET["tblId"];
$edit = $_GET["edit"];
$idRec = $_GET["recId"];
$name = iconv("utf-8","windows-1251",$_GET['name']);
$description = iconv("utf-8","windows-1251",$_GET['descr']);
$parent = iconv("utf-8","windows-1251",$_GET['parent']);

$tsql_callSP = "{call newRefRec( ?,?,?,?,?,? )}";  

$params = array(
array(&$tblId, SQLSRV_PARAM_IN),
array(&$idRec, SQLSRV_PARAM_IN),
array(&$edit, SQLSRV_PARAM_IN),
array(&$name, SQLSRV_PARAM_IN),
array(&$description, SQLSRV_PARAM_IN),
array(&$parent, SQLSRV_PARAM_IN)
);  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

    while(sqlsrv_next_result($stmt))
    {
        $row = sqlsrv_fetch_array($stmt);
        echo $row['result'];
    }
sqlsrv_free_stmt( $stmt);  

include "getISAS.php";
?>