<?php

/**
 * @author mr. green
 * @copyright 2015
 */

include "../db.php";
session_start();

$ssId = $_SESSION['id'];
$id = $_GET['id'];
$inp = iconv('utf-8','windows-1251',$_GET["inp"]);
//узнаем существует ли РМ
$stmt = sqlsrv_query($conn,"select refWorkplace.name, refStreet.Name as street, refWorkplace.idEmployees
FROM refStreet INNER JOIN refWorkplace ON refStreet.id = refWorkplace.idrefStreet 
where refWorkplace.name='$inp'");
if (sqlsrv_has_rows($stmt)){
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row['idEmployees']==0){//Если РМ не занято
        $stmt2 = sqlsrv_query($conn,"select * from refWorkplace where idEmployees=$id");
        if (sqlsrv_has_rows($stmt2)) {//Если у сотрудника уже было РМ
            $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
            $old = $row2['Name'];
            //запись в журнал
            $oldRM = iconv('utf-8','windows-1251','Освобождено рабочее место <strong>'.$old.'</strong>');
            sqlsrv_query($conn,"INSERT INTO [dbo].[uHistory] ([eDate],[Event],[idEmployees],[idAuthor])  VALUES (SYSDATETIME(),'$oldRM',$id,$ssId)");
            //освобождаем РМ, которое занимал сотрудник
            sqlsrv_query($conn,"update refWorkplace set idEmployees=0 where idEmployees=$id");        
        }
        //присваиваем новое РМ
        sqlsrv_query($conn,"update refWorkplace set idEmployees=$id where name='$inp'"); 
        //делаем запись о присвоении нового РМ
        $text = iconv('utf-8','windows-1251','Присвоено рабочее место <strong>'.$inp.'</strong>');
        sqlsrv_query($conn,"INSERT INTO [dbo].[uHistory] ([eDate],[Event],[idEmployees],[idAuthor]) VALUES (SYSDATETIME(),'$text',$id,$ssId)");
        echo json_encode(array(iconv('windows-1251','utf-8',$row['street'])));
    } else {
        //кем занято РМ
        $stmt2 = sqlsrv_query($conn,"select refWorkplace.idemployees,employees.lastname+' '+ employees.Firstname+' '+
                    employees.middlename as fio from refWorkplace INNER JOIN
                    employees ON refWorkplace.idEmployees = Employees.id where refWorkplace.name='$inp'");
        $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
        echo json_encode(array('exist',iconv('windows-1251','utf-8',$row2['fio'])));
        }
    sqlsrv_free_stmt($stmt2);
} else {
            
            echo json_encode(array('noexist'));

        }
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>