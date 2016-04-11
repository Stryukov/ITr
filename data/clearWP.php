<?php

/**
 * @author mr. green
 * @copyright 2015
 */

include "db.php";
session_start();

$ssId = $_SESSION['id'];
$id = $_GET['id'];

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
        
echo 'ok';
?>