<?php

include "db.php";

$id = $_GET['id'];

    $sql = mssql_query("SELECT Employees.id,lastName,firstName,middleName,refJob.Name as 'job',Phone,[Login], refWorkplace.Name as wp
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees) 
where idDepartment=$id and Employees.State = 1 order by lastName");
   $content='';
    while ($row = mssql_fetch_array($sql)){
        $i = iconv("windows-1251","utf-8",$row["firstName"][0]);
        $uid = $row['id'];
        $o = iconv("windows-1251","utf-8",$row["middleName"][0]);
        $dolg =  iconv("windows-1251","utf-8",$row["job"]);
        $phone = iconv("windows-1251","utf-8",$row["Phone"]);
        $wp = iconv("windows-1251","utf-8",$row["wp"]);
        $login = $row['Login'];
       $content = $content.$uid.";".iconv("windows-1251","utf-8",$row["lastName"])." ".$i.".".$o.".".";".$login.";".$dolg.";".
       $phone.";".$wp.";|";
   }


echo  $content;

?>