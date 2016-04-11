<?php

include "db.php";

//error_reporting(E_ALL);

$idRec = $_GET['idRec'];
$tblId = $_GET['tblId'];

$stmn = mssql_init("loadRefRec", $db);
mssql_bind($stmn, '@idRec', $idRec, SQLVARCHAR);
mssql_bind($stmn, '@tblId', $tblId, SQLINT2);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
$dt = mssql_fetch_array($res);
$content = iconv('windows-1251','utf-8', $dt['name']).'|'.iconv('windows-1251','utf-8', $dt['description']).'|'.iconv('windows-1251','utf-8', $dt['parent']).'|';

echo  $content;

?>