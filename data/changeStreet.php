<?php
//error_reporting(E_ALL);
include "db.php";
session_start();
$ssId = $_SESSION['id'];
$inp = iconv('utf-8','windows-1251',$_GET["inp"]);
$street = iconv('utf-8','windows-1251',$_GET["street"]);
//echo $inp;
$stmn = mssql_init("changeStreet", $db);
 mssql_bind($stmn, '@NameWP', $inp, SQLVARCHAR);
 mssql_bind($stmn, '@StreetWP', $street, SQLVARCHAR);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
$res2 = mssql_fetch_array($res);
echo json_encode(array(iconv('windows-1251','utf-8',$res2['Street'])));
?>