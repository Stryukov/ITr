<?php

include "db.php";
session_start();

$id = $_POST["id"];
$ssId = $_SESSION['id'];

$mass = split(',',$id);
for ($i=0;$i<count($mass);$i++) {
$id2=$mass[$i];    
//////////////////
$stmn = mssql_init("delUser", $db);
 mssql_bind($stmn, '@idUser', $id2, SQLINT2);
 mssql_bind($stmn, '@idOwner', $ssId, SQLINT2);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
//////////////////////
}

echo  'ok';

?>