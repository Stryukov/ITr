<?php

include "../db.php";

$id = $_GET['id'];

$tsql_callSP = "{call loadUserInfo( ? )}";  

$params = array(
array(&$id, SQLSRV_PARAM_IN));  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

$userinfo = array("uid" => $row['id'], "lastname" => iconv("windows-1251","utf-8",$row["lastName"]),"firstname" => iconv("windows-1251","utf-8",$row["firstName"]),"middlename" => iconv("windows-1251","utf-8",$row["middleName"]),"login" => $row['Login'],"job" => iconv("windows-1251","utf-8",$row["job"]),"phone" => iconv("windows-1251","utf-8",$row["Phone"]),"cab" => iconv("windows-1251","utf-8",$row["Cabinet"]),"photo" => $row["Foto"],"pwd" => iconv("windows-1251","utf-8",$row["Pwd"]),"info" => iconv("windows-1251","utf-8",$row["Description"]),"WP" => iconv("windows-1251","utf-8",$row["WP"]),"street" => iconv("windows-1251","utf-8",$row["Street"]),"email" => $row['email'],"tags" => iconv("windows-1251","utf-8",$row["tags"]),"access" => $row["Access"]);
echo json_encode($userinfo, JSON_UNESCAPED_UNICODE);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>