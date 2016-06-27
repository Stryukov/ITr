<?php

include "../db.php";
    $stmt = sqlsrv_query($conn,"SELECT id,name FROM [ITr].[dbo].[refOrganization] order by name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }

echo  $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>