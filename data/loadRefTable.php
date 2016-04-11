<?php

include "db.php";

$id = $_GET['id'];




$stmn = mssql_init("loadLinerRef", $db);
 mssql_bind($stmn, '@idRef', $id, SQLINT2);
    $res = mssql_execute($stmn) or die("ошибка вставки в базу данных");
    //$res2 = mssql_fetch_array($res);
  if (mssql_num_fields($res)==4){
    $content='$';
  } else $content='';
    while ($row = mssql_fetch_array($res)){
        $id_ = $row['id'];
        $num = $row['number'];
        $name = iconv("windows-1251","utf-8",$row["name"]);
        $descr =  iconv("windows-1251","utf-8",$row["Description"]);
        $par = iconv("windows-1251","utf-8",$row["parent"]);
        $idPar = $row['idparent'];
       $content = $content.$id_.";".$num.";".$name.";".$descr.";".$par.";".$idPar.";|";
   }


echo  $content; 


?>