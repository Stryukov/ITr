<?php

include "db.php";

$content='';

    $test = mssql_query("SELECT * FROM refOrganization order by Name");
    while ($dt=mssql_fetch_array($test)){
        $org=iconv("windows-1251","utf-8",$dt["Name"]);
        $idorg=$dt["id"];
        
        $content=$content.$org."%".$idorg.";";
        
        }


echo $content;

?>