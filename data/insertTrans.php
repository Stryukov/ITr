<?php

include "db.php";
session_start();

mssql_query("SET NAMES 'utf8'");

$id = $_GET["id"];
$idDep = iconv("utf-8","windows-1251",$_GET['idDep']);
$sc = mssql_query("select [Name] from refDepartment where id = $idDep");
$dt = mssql_fetch_array($sc);
$text = $dt['Name'];

    $ssId = $_SESSION['id'];
    $sql2 = "
    INSERT INTO [dbo].[uHistory]
           ([eDate]
           ,[Event]
           ,[idEmployees]
           ,[idAuthor])
     VALUES
           (SYSDATETIME()
           ,'переведен из отдела : $text'
           ,$id
           ,$ssId)";
           mssql_query($sql2);
  

echo  $text;

?>