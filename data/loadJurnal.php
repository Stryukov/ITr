<?php

include "../db.php";

$id = $_GET['id'];
$content='';
$stmt = sqlsrv_query($conn,"select ROW_NUMBER() OVER(ORDER BY uHistory.id DESC) AS 'Num',FORMAT(uHistory.eDate, 'yyyy-MM-dd HH:mm:ss') as eDate,[uHistory].[Event],uHistory.idAuthor,[Employees].[Login] as lg 
from uHistory left Join Employees ON (uHistory.idAuthor = Employees.id) where uHistory.idEmployees=$id");
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    $num = $row['Num'];
    $time = $row['eDate'];
    $event = iconv('windows-1251','utf-8',$row['Event']);
    $owner = $row['lg'];
 $content=$content."<tr>
 <td>$num</td>".
 "<td>$time</td>".
 "<td>$event</td>".
 "<td>$owner</td>".
 "</tr>";   
}

echo  $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>