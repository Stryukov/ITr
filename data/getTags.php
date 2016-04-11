<?php

include "db.php";
session_start();

mssql_query("SET NAMES 'utf8'");


//$tags = $_POST["tags"];
$id = $_GET["id"];

$sql = mssql_query("select Name from refutags where idEmployees=$id");
while ($dt=mssql_fetch_array($sql))
{
 echo iconv('windows-1251','utf-8',$dt['Name']).";";   
}


//echo  $id;

?>