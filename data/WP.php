<?php

/**
 * @author mr. green
 * @copyright 2015
 */

include "db.php";
session_start();

mssql_query("SET NAMES 'utf8'");
$ssId = $_SESSION['id'];
$id = $_GET['id'];
$inp = iconv('utf-8','windows-1251',$_GET["inp"]);

$sql = mssql_query("select refWorkplace.name, refStreet.Name as street, refWorkplace.idEmployees
FROM            refStreet INNER JOIN
                         refWorkplace ON refStreet.id = refWorkplace.idrefStreet 
where refWorkplace.name='$inp'");
if (mssql_num_rows($sql)>0){
    $dt=mssql_fetch_array($sql);
    if ($dt['idEmployees']==0){
        $ss = mssql_query("select * from refWorkplace where idEmployees=$id");
        //ззааппииссььввжжуурр
        if (mssql_num_rows($ss)>0) {
            $olddt = mssql_fetch_array($ss);
            $old = $olddt['Name'];
            $oldRM = iconv('utf-8','windows-1251','Освобождено рабочее место <strong>'.$old.'</strong>');
            mssql_query("
    INSERT INTO [dbo].[uHistory]
           ([eDate]
           ,[Event]
           ,[idEmployees]
           ,[idAuthor])
     VALUES
           (SYSDATETIME()
           ,'$oldRM'
           ,$id
           ,$ssId)");
        }
        ///удаляем старые
               mssql_query("update refWorkplace set idEmployees=0 where idEmployees=$id");
        ///
        mssql_query("update refWorkplace set idEmployees=$id where name='$inp'");
        $text = iconv('utf-8','windows-1251','Присвоено рабочее место <strong>'.$inp.'</strong>');
        mssql_query("
    INSERT INTO [dbo].[uHistory]
           ([eDate]
           ,[Event]
           ,[idEmployees]
           ,[idAuthor])
     VALUES
           (SYSDATETIME()
           ,'$text'
           ,$id
           ,$ssId)");
        echo json_encode(array(iconv('windows-1251','utf-8',$dt['street'])));
    } else {
        $sql2 = mssql_query("select refWorkplace.idemployees,employees.lastname+' '+ employees.Firstname+' '+
employees.middlename as fio from refWorkplace INNER JOIN
                         employees ON refWorkplace.idEmployees = Employees.id where refWorkplace.name='$inp'");
                         $dt2 = mssql_fetch_array($sql2);
        echo json_encode(array('exist',iconv('windows-1251','utf-8',$dt2['fio'])));}
} else {
            
            echo json_encode(array('noexist'));

        }


?>