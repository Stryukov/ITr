<?php

include "db.php";


mssql_query("SET NAMES 'utf8'");

$id = $_GET['id'];
$content='';
$sql = mssql_query("select ROW_NUMBER() OVER(ORDER BY uHistory.id DESC) AS 'Num',FORMAT(uHistory.eDate, 'yyyy-MM-dd HH:mm:ss') as eDate,[uHistory].[Event],uHistory.idAuthor,[Employees].[Login] as lg 
from uHistory left Join Employees ON (uHistory.idAuthor = Employees.id) where uHistory.idEmployees=$id");
while ($dt=mssql_fetch_array($sql))
{
    $num = $dt['Num'];
    $time = $dt['eDate'];
    $event = iconv('windows-1251','utf-8',$dt['Event']);
    $owner = $dt['lg'];
 $content=$content."<tr>
 <td>$num</td>".
 "<td>$time</td>".
 "<td>$event</td>".
 "<td>$owner</td>".
 "</tr>";   
}



echo  $content;

?>