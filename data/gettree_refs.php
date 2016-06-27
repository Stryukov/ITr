<?php

include "../db.php";

$content='<ul>';

    $stmt = sqlsrv_query($conn,"SELECT * FROM refLinear order by Name");
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $name=iconv("windows-1251","utf-8",$row["Name"]);
        $idref=$row["id"];
    $content=$content."<li class='parent_li'>".
            "<span id='e$idref' onclick='cl(this)'><i class='fa fa-book fa-fw'></i>$name</span>";
 
    $content=$content."</li>";    
        
        }


$content=$content.'</ul>';
echo $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>