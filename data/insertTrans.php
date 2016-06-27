<?php

include "../db.php";
session_start();

$id = $_GET["id"];
$idDep = iconv("utf-8","windows-1251",$_GET['idDep']);
$stmt = sqlsrv_query($conn,"select [Name] from refDepartment where id = $idDep");
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$text = $row['Name'];
$ssId = $_SESSION['id'];
sqlsrv_free_stmt($stmt);
$stmt = sqlsrv_query($conn,"INSERT INTO [dbo].[uHistory] ([eDate],[Event],[idEmployees],[idAuthor]) VALUES (SYSDATETIME(),'".iconv("utf-8","windows-1251",'переведен из отдела: ')."$text',$id,$ssId)");

echo  $text;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>