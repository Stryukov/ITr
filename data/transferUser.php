<?php

include "../db.php";

$id = $_GET["id"];
$idDep = $_GET["idDep"];

$stmt = sqlsrv_query($conn,"select idDepartment from employees where id=$id");
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$oldDep = $row['idDepartment'];
$stmt = sqlsrv_query($conn,"UPDATE [dbo].[Employees] SET [idDepartment] = $idDep WHERE [id] = $id");

echo  $oldDep;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>