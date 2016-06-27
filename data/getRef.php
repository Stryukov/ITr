<?php

include "../db.php";

$a=$_GET['a'];
if ($a=='job') {
    $stmt = sqlsrv_query($conn,"SELECT id,name FROM [ITr].[dbo].[refJob] order by name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
sqlsrv_free_stmt($stmt);
}

if ($a=='street') {
    $stmt = sqlsrv_query($conn,"SELECT id,name FROM [ITr].[dbo].[refStreet] order by name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
sqlsrv_free_stmt($stmt);
}

if ($a=='csStreet') {
    $stmt = sqlsrv_query($conn,"SELECT id,name FROM [ITr].[dbo].[refStreet] order by name");    
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
sqlsrv_free_stmt($stmt);
}


if ($a=='rParent') {
    $tblId=$_GET['id'];
    $stmt = sqlsrv_query($conn,"select tblName from refLinear where id=$tblId");
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $tbl=$row['tblName'];
    sqlsrv_free_stmt($stmt);
    $stmt = sqlsrv_query($conn,"SELECT PK.TABLE_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE PK
JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS C ON PK.CONSTRAINT_CATALOG=C.UNIQUE_CONSTRAINT_CATALOG AND PK.CONSTRAINT_SCHEMA=C.UNIQUE_CONSTRAINT_SCHEMA AND PK.CONSTRAINT_NAME=C.UNIQUE_CONSTRAINT_NAME
JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE FK ON C.CONSTRAINT_CATALOG=PK.CONSTRAINT_CATALOG AND C.CONSTRAINT_SCHEMA=FK.CONSTRAINT_SCHEMA AND C.CONSTRAINT_NAME=FK.CONSTRAINT_NAME AND PK.ORDINAL_POSITION=FK.ORDINAL_POSITION
where FK.TABLE_NAME = '$tbl'");
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $tbl=$row['TABLE_NAME'];
    sqlsrv_free_stmt($stmt);
    $stmt = sqlsrv_query($conn,"SELECT id,name FROM ".$tbl." order by name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
    sqlsrv_free_stmt($stmt);
}

echo  $content;
sqlsrv_close($conn);
?>