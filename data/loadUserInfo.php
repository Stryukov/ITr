<?php

include "db.php";

$id = $_GET['id'];

    $sql = mssql_query("SELECT Employees.id,lastName,email,firstName,middleName,Cabinet,Employees.Description,Foto,Pwd,refJob.Name as 'job',Phone,[Login], refWorkplace.Name as WP, refStreet.Name as Street
FROM [ITr].[dbo].[Employees] left join [ITr].[dbo].[refJob] ON (Employees.idJob = refJob.id) 
left join [ITr].[dbo].[refWorkplace] ON (Employees.id = refWorkplace.idEmployees) 
left join [ITr].[dbo].[refStreet] ON (refStreet.id = refWorkplace.idrefStreet) 
where Employees.id=$id");
   $content='';
    $row = mssql_fetch_array($sql);
        $i = iconv("windows-1251","utf-8",$row["firstName"]);
        $uid = $row['id'];
        $o = iconv("windows-1251","utf-8",$row["middleName"]);
        $dolg =  iconv("windows-1251","utf-8",$row["job"]);
        $phone = iconv("windows-1251","utf-8",$row["Phone"]);
        $kab = iconv("windows-1251","utf-8",$row["Cabinet"]);
         $pwd = iconv("windows-1251","utf-8",$row["Pwd"]);
         $dop = iconv("windows-1251","utf-8",$row["Description"]);
        $login = $row['Login'];
           $email = $row['email'];
        $street= iconv("windows-1251","utf-8",$row["Street"]);
        $WP = iconv("windows-1251","utf-8",$row["WP"]);
        if (is_null($row['WP'])){$WP = 'Рабочее место отсутствует';}
        
        $photo=base64_encode($row["Foto"]);
       $content = $content.$uid.";".iconv("windows-1251","utf-8",$row["lastName"]).";".iconv("windows-1251","utf-8",$row["firstName"]).";".iconv("windows-1251","utf-8",$row["middleName"]).";".$login.";".$dolg.";".
       $phone.";".$kab.";".$photo.";".$pwd.";".$dop.";".$WP.";".$street.";".$email.";|";
  


echo  $content;

?>