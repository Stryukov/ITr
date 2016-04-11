<?php

include "db.php";
//error_reporting(E_ALL);
session_start();
$tblId = $_GET["tblId"];
$edit = $_GET["edit"];
$recId = $_GET["recId"];
$name = iconv("utf-8","windows-1251",$_GET['name']);
$descr = iconv("utf-8","windows-1251",$_GET['descr']);
$parent = iconv("utf-8","windows-1251",$_GET['parent']);
$stmn = mssql_init("newRefRec", $db);
 mssql_bind($stmn, '@name', $name, SQLVARCHAR);
 mssql_bind($stmn, '@description', $descr, SQLVARCHAR);
 mssql_bind($stmn, '@parent', $parent, SQLVARCHAR);
 mssql_bind($stmn, '@idRec', $recId, SQLVARCHAR);
 mssql_bind($stmn, '@tblId', $tblId, SQLINT2);
 mssql_bind($stmn, '@edit', $edit, SQLINT2);
 mssql_bind($stmn, '@result', $result, SQLINT2,true);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
while (mssql_next_result($res)){
    $res2 = mssql_fetch_array($res);
}
//echo $name.'.'.$descr.'.'.$parent.'.'.$recId.'.'.$tblId.'.'.$edit;
echo $res2['result'];

?>