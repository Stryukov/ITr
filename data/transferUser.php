<?php

include "db.php";


mssql_query("SET NAMES 'utf8'");

$id = $_GET["id"];
$idDep = $_GET["idDep"];

$ssqqll = mssql_query("select idDepartment from employees where id=$id");
$ddtt = mssql_fetch_array($ssqqll);
$oldDep = $ddtt['idDepartment'];


$sql = "UPDATE [dbo].[Employees]
   SET [idDepartment] = $idDep
     
 WHERE [id] = $id";            

mssql_query($sql);           

echo  $oldDep;

?>