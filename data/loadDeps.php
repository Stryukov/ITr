<?php

include "../db.php";

$id=iconv('utf-8','windows-1251',$_GET['id']);
$stmt = sqlsrv_query($conn,"Select id from [refOrganization] where Name = '$id'");
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$idorg=$row['id'];
sqlsrv_free_stmt($stmt);

$stmt = sqlsrv_query($conn,"SELECT id,name FROM [ITr].[dbo].[refDepartment] where idOrg=$idorg order by name");
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }

echo  $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>