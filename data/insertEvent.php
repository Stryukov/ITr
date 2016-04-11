<?php

include "db.php";
session_start();

mssql_query("SET NAMES 'utf8'");

$id = $_GET["id"];
$text = iconv("utf-8","windows-1251",$_GET['text']);


    $ssId = $_SESSION['id'];
    $sql2 = "
    INSERT INTO [dbo].[uHistory]
           ([eDate]
           ,[Event]
           ,[idEmployees]
           ,[idAuthor])
     VALUES
           (SYSDATETIME()
           ,'$text'
           ,$id
           ,$ssId)";
           mssql_query($sql2);
  

echo  $sql2;

?>