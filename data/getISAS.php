<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$posts = array();

$stmt = sqlsrv_query($conn,"SELECT id, Name FROM refISAS order by Name");
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
 $id=$row['id']; 
 $name=iconv('windows-1251','utf-8',$row['Name']); 

$posts[] = array('name'=> $name,'id'=> $id);

        }

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
file_put_contents("cities.json", json_encode($posts, JSON_UNESCAPED_UNICODE));

?>