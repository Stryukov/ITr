<?php

include "../db.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$id = $_GET['id'];
    if (substr($id, 0, 1)=='o'){
      $id = substr($id, 1);
      $sql = "SELECT Employees.id,lastName,firstName,middleName,refJob.Name as 'job',Phone,[Login], refWorkplace.Name as wp
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees)
left join [ITr].[dbo].[refDepartment] ON (Employees.idDepartment = refDepartment.id) 
left join [ITr].[dbo].[refOrganization] ON (refDepartment.idOrg = refOrganization.id) 
where refOrganization.id=$id and Employees.State = 1 order by lastName";
    } else {
      $sql = "SELECT Employees.id,lastName,firstName,middleName,refJob.Name as 'job',Phone,[Login], refWorkplace.Name as wp
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees) 
where idDepartment=$id and Employees.State = 1 order by lastName";
    }
    if (substr($id, 0, 5)=='1145'){
      $id = substr($id, 1);
      $sql = "SELECT Employees.id,lastName,firstName,middleName,refJob.Name as 'job',Phone,[Login], refWorkplace.Name as wp
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees) 
where Employees.State = 0 order by lastName";
    }

    $stmt = sqlsrv_query($conn,$sql);
   $content='';$i='';$o='';
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        if ($row["firstName"]<>'') {$i = iconv("windows-1251","utf-8",$row["firstName"][0]);} else {$i='';}
        $uid = $row['id'];
        if ($row["middleName"]<>'') {$o = iconv("windows-1251","utf-8",$row["middleName"][0]);} else {$o='';}
        $dolg =  iconv("windows-1251","utf-8",$row["job"]);
        $phone = iconv("windows-1251","utf-8",$row["Phone"]);
        $wp = iconv("windows-1251","utf-8",$row["wp"]);
        $login = $row['Login'];
       $content = $content.$uid.";".iconv("windows-1251","utf-8",$row["lastName"])." ".$i.".".$o.".".";".$login.";".$dolg.";".
       $phone.";".$wp.";|";
   }


echo  $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>