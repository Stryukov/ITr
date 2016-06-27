<?php

include "../db.php";
session_start();

$id = $_GET["id"];
$text = iconv("utf-8","windows-1251",$_GET['text']);

$ssId = $_SESSION['id'];
$stmt = sqlsrv_query($conn,"INSERT INTO [dbo].[uHistory] ([eDate],[Event],[idEmployees],[idAuthor]) VALUES (SYSDATETIME(),'$text',$id,$ssId)");

echo  $stmt;

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>