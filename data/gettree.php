<?php

include "db.php";

$content='<ul>';
mssql_query("SET NAMES 'utf8'");

    $test = mssql_query("SELECT * FROM refOrganization order by Name");
    while ($dt=mssql_fetch_array($test)){
        $org=iconv("windows-1251","utf-8",$dt["Name"]);
        $idorg=$dt["id"];
    $content=$content."<li>".
            "<span><i class='fa fa-building fa-fw'></i>$org</span><ul>";  
             
             
     $test1=mssql_query("select * from refDepartment where idOrg=$idorg order by Name");        
     while ($dt1=mssql_fetch_array($test1)){  
        $sid=$dt1["id"];
     $content=$content."<li class='parent_li'>"; 
     $podr=iconv("windows-1251","utf-8",$dt1["Name"]);
     $content=$content."<span id='e$sid' onclick='cl(this)'><i class='fa fa-briefcase fa-fw'></i>$podr</span>";	                
     $content=$content."</li>";         
        }
        
    $content=$content."</ul></li>";    
        
        
        
        }


$content=$content.'</ul>';
echo $content;

?>