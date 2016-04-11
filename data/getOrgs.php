<?php

include "db.php";


mssql_query("SET NAMES 'utf8'");

    $sql = mssql_query("SELECT id,name FROM [ITr].[dbo].[refOrganization]");
    while ($row = mssql_fetch_array($sql)){
       $content = $content.$row["id"]."[".iconv("windows-1251","utf-8",$row['name'])."]";
   }


echo  $content

?>