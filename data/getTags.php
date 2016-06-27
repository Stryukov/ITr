<?php

include "../db.php";
session_start();

$id = $_GET["id"];
$stmt = sqlsrv_query($conn,"select Name from refutags where idEmployees=$id");
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
 echo iconv('windows-1251','utf-8',$row['Name']).";";   
}
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>