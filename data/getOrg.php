<?php

include "../db.php";

$content='';
$stmt = sqlsrv_query($conn,"SELECT * FROM refOrganization order by Name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $org=iconv("windows-1251","utf-8",$row["Name"]);
        $idorg=$row["id"];
        
        $content=$content.$org."%".$idorg.";";
        
        }
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo $content;

?>