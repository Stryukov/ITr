<?php

include "../db.php";

$id = $_GET['id'];

$tsql_callSP = "{call loadUserInfo( ? )}";  

$params = array(
array(&$id, SQLSRV_PARAM_IN));  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

   $content='';
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
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
        $tags = iconv("windows-1251","utf-8",$row["tags"]);
        $WP = iconv("windows-1251","utf-8",$row["WP"]);
        if (is_null($row['WP'])){$WP = 'Рабочее место отсутствует';}
        
        $photo=$row["Foto"];
       $content = $content.$uid.";".iconv("windows-1251","utf-8",$row["lastName"]).";".iconv("windows-1251","utf-8",$row["firstName"]).";".iconv("windows-1251","utf-8",$row["middleName"]).";".$login.";".$dolg.";".
       $phone.";".$kab.";".$photo.";".$pwd.";".$dop.";".$WP.";".$street.";".$email.";".$tags.";|";
  
echo  $content;
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>