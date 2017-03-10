<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("../db.php");

$connectionInfo = array( "Database"=>$cnf->dbname, "UID"=>$cnf->dbuser, "PWD"=>$cnf->dbpass);

$txt = iconv('utf-8','windows-1251',$_GET["txt"]);
//поиск сотрудника
$sql = "SELECT refDepartment.id, Employees.LastName+' '+Employees.FirstName+' '+Employees.MiddleName as name, Employees.LastName, Employees.Login, refWorkplace.Name as wp 
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees)
left join [ITr].[dbo].[refDepartment] ON (Employees.idDepartment = refDepartment.id) 
WHERE Employees.LastName like '%$txt%' or Employees.Login like '%$txt%' or refWorkplace.Name like '%$txt%'";
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query($conn,$sql,$params,$options);
$cnt = sqlsrv_num_rows($stmt);
if ($cnt == 1) {
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    $user['depID'] = $row["id"];
    $user['Name'] = iconv('windows-1251','utf-8',$row['LastName']);
    $user['cnt'] = $cnt;
} else {
    $i = 1;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $user['depID'.$i] = $row['id'];
        $user['Name'.$i] = iconv('windows-1251','utf-8',$row['name']);
        $user['login'.$i] = iconv('windows-1251','utf-8',$row['Login']);
        $user['WP'.$i] = iconv('windows-1251','utf-8',$row['wp']);
        $i++;
    }
$user['cnt'] = $cnt;
}

        
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($user);  

?>