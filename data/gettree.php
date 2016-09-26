<?php

include "../db.php";

$content='<ul>';
    $stmt = sqlsrv_query($conn,"SELECT * FROM refOrganization order by Name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $org=iconv("windows-1251","utf-8",$row["Name"]);
        $idorg=$row["id"];
    $content .="<li>".
            "<span><i class='fa fa-building fa-fw'></i>$org</span><ul>";  
     
     $stmt2 = sqlsrv_query($conn,"select * from refDepartment where idOrg=$idorg order by Name");
     $content .="<li class='parent_li'>"; 
     $content .="<span id='o$idorg' onclick='cl(this)'><i class='fa fa-users fa-fw'></i> Все сотрудники</span>";                 
     $content .="</li>"; 
     while ($row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)){  
        $sid=$row2["id"];
     $content .="<li class='parent_li'>"; 
     $podr=iconv("windows-1251","utf-8",$row2["Name"]);
     $content .="<span id='e$sid' onclick='cl(this)'><i class='fa fa-briefcase fa-fw'></i> $podr</span>";	                
     $content .="</li>";         
        }
    $content .="</ul></li>";    
        }

$content .="<li class='parent_li'><span id='f0' onclick='cl(this)' title=''><i class='fa fa-trash fa-fw icon-plus-sign'></i>Уволенные сотрудники</span></li></ul>";
echo $content;
sqlsrv_free_stmt($stmt);
sqlsrv_free_stmt($stmt2);
sqlsrv_close($conn);
?>

