<?php

include "db.php";

$id=iconv('utf-8','windows-1251',$_GET['id']);
mssql_query("SET NAMES 'utf8'");
$sql1 = mssql_query("Select id from [refOrganization] where Name = '$id'");
$dt = mssql_fetch_array($sql1);
$idorg=$dt['id'];
    $sql = mssql_query("SELECT id,name FROM [ITr].[dbo].[refDepartment] where idOrg=$idorg");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }


echo  $content

?>