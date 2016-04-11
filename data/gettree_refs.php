<?php

include "db.php";

$content='<ul>';
mssql_query("SET NAMES 'utf8'");

    $test = mssql_query("SELECT * FROM refLinear order by Name");
    while ($dt=mssql_fetch_array($test)){
        $name=iconv("windows-1251","utf-8",$dt["Name"]);
        $idref=$dt["id"];
    $content=$content."<li class='parent_li'>".
            "<span id='e$idref' onclick='cl(this)'><i class='fa fa-book fa-fw'></i>$name</span>";
             
            
            
 
     
     
     
     
        
    $content=$content."</li>";    
        
        
        
        }


$content=$content.'</ul>';
echo $content;

?>