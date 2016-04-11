<?php

include "db.php";

$a=$_GET['a'];
if ($a=='job') {
    $sql = mssql_query("SELECT id,name FROM [ITr].[dbo].[refJob] order by name");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
}

if ($a=='street') {
    $sql = mssql_query("SELECT id,name FROM [ITr].[dbo].[refStreet] order by name");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
}

if ($a=='csStreet') {
    $sql = mssql_query("SELECT id,name FROM [ITr].[dbo].[refStreet] order by name");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
}


if ($a=='rParent') {
    $tblId=$_GET['id'];
    $sq = mssql_query("select tblName from refLinear where id=$tblId");
    $ddt = mssql_fetch_array($sq);
    $tbl=$ddt['tblName'];
    $sql = mssql_query("SELECT PK.TABLE_NAME
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE PK
JOIN INFORMATION_SCHEMA.REFERENTIAL_CONSTRAINTS C ON PK.CONSTRAINT_CATALOG=C.UNIQUE_CONSTRAINT_CATALOG AND PK.CONSTRAINT_SCHEMA=C.UNIQUE_CONSTRAINT_SCHEMA AND PK.CONSTRAINT_NAME=C.UNIQUE_CONSTRAINT_NAME
JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE FK ON C.CONSTRAINT_CATALOG=PK.CONSTRAINT_CATALOG AND C.CONSTRAINT_SCHEMA=FK.CONSTRAINT_SCHEMA AND C.CONSTRAINT_NAME=FK.CONSTRAINT_NAME AND PK.ORDINAL_POSITION=FK.ORDINAL_POSITION
where FK.TABLE_NAME = '$tbl'");
    $ddt = mssql_fetch_array($sql);
    $tbl=$ddt['TABLE_NAME'];
    //echo $tbl;
    $sql = mssql_query("SELECT id,name FROM ".$tbl." order by name");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }    
}

echo  $content

?>