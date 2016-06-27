<?php
include "../db.php";

$idRef = $_GET['id'];

$tsql_callSP = "{call loadLinerRef( ? )}";  

$params = array(
array(&$idRef, SQLSRV_PARAM_IN)
);  


$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

  if (sqlsrv_num_fields($stmt)==4){
    $content='$';
  } else $content='';
    while ($row = sqlsrv_fetch_array($stmt)){
        $id_ = $row['id'];
        $num = $row['number'];
        $name = iconv("windows-1251","utf-8",$row["name"]);
        $descr =  iconv("windows-1251","utf-8",$row["Description"]);
        $par = iconv("windows-1251","utf-8",$row["parent"]);
        $idPar = $row['idparent'];
       $content = $content.$id_.";".$num.";".$name.";".$descr.";".$par.";".$idPar.";|";
   }
  echo  $content;    

sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);

?>