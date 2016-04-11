<?php

include "db.php";
//error_reporting(E_ALL);
session_start();
$tblId = $_GET["tblId"];
$recId = $_GET["recId"];
//echo $recId;
$stmn = mssql_init("delRefRec", $db);
 mssql_bind($stmn, '@txt', $recId, SQLVARCHAR);
 mssql_bind($stmn, '@tblId', $tblId, SQLINT2);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
$res2 = mssql_fetch_array($res);
echo $res2['result'];

?>