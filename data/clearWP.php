<?php

/**
 * @author mr. green
 * @copyright 2015
 */

include "../db.php";
session_start();

$ssId = $_SESSION['id'];
$id = $_GET['id'];

        $stmt = sqlsrv_query($conn,"select * from refWorkplace where idEmployees=$id");
        //запись в журнал
        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);            
            $old = $row['Name'];
            $oldRM = iconv('utf-8','windows-1251','Освобождено рабочее место <strong>'.$old.'</strong>');
            sqlsrv_query($conn,"INSERT INTO [dbo].[uHistory] ([eDate],[Event],[idEmployees],[idAuthor]) VALUES (SYSDATETIME(),'$oldRM',$id,$ssId)");
        }
        //Освобождаем РМ
            sqlsrv_query($conn,"update refWorkplace set idEmployees=0 where idEmployees=$id");
        
echo 'ok';
sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);
?>