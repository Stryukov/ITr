<?php
include "db.php";
session_start();
$ssId = $_SESSION['id'];
$id = $_GET['id'];
$inp = iconv('utf-8','windows-1251',$_GET["inp"]);
$street = iconv('utf-8','windows-1251',$_GET["street"]);

$stmn = mssql_init("createWP", $db);
 mssql_bind($stmn, '@NameWP', $inp, SQLVARCHAR);
 mssql_bind($stmn, '@StreetWP', $street, SQLVARCHAR);
 mssql_bind($stmn, '@idEmployee', $id, SQLINT2);
 mssql_bind($stmn, '@idOwner', $ssId, SQLINT2);
//mssql_bind($stmn, "RETVAL", $retval, SQLINT2);
$res = mssql_execute($stmn) or die("ошибка вставки в базу данных");;
$res2 = mssql_fetch_array($res);
//echo json_encode($res2);
//echo iconv('windows-1251','utf-8',$res2['WP']).','.iconv('windows-1251','utf-8',$res2['Street']); 
echo json_encode(array(iconv('windows-1251','utf-8',$res2['WP']),iconv('windows-1251','utf-8',$res2['Street'])));
//echo $id;
?>