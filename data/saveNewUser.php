<?php

include "../db.php";
session_start();


$array = $_POST["tags"];
$tags = iconv("utf-8","windows-1251",implode(",", $array));
$matrix = $_POST["access"];
$id = $_POST["id"];
$sId = $_SESSION['id'];
$edit = $_POST["edit"];
$fname = iconv("utf-8","windows-1251",$_POST['fname']);
$iname = iconv("utf-8","windows-1251",$_POST['iname']);
$oname = iconv("utf-8","windows-1251",$_POST['oname']);
$idDep = $_POST["idDep"];
$kab = iconv("utf-8","windows-1251",$_POST['kab']);
$job = iconv("utf-8","windows-1251",$_POST['dolgn']);
$info = iconv("utf-8","windows-1251",$_POST['dopInfo']);
$phone = $_POST["tel"];
$userad = $_POST["userad"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$idTags = '';

$photo = $_POST['photo'];
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);

//////////////////////////////////////
$datastring = base64_decode($photo);
$photo = './img/photo/'.$userad.'.png';
file_put_contents('.'.$path, $datastring);
//$data = unpack("H*hex", $datastring);
//$photo = '0x'.$data['hex'];
//////////////////////////////////
$tsql_callSP = "{call newEmployee( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )}";  

$params = array(
array(&$id, SQLSRV_PARAM_INOUT),
array(&$edit, SQLSRV_PARAM_IN),
array(&$fname, SQLSRV_PARAM_IN),
array(&$iname, SQLSRV_PARAM_IN),
array(&$oname, SQLSRV_PARAM_IN),
array(&$idDep, SQLSRV_PARAM_IN),
array(&$kab, SQLSRV_PARAM_IN),
array(&$job, SQLSRV_PARAM_IN),
array(&$info, SQLSRV_PARAM_IN),
array(&$phone, SQLSRV_PARAM_IN),
array(&$userad, SQLSRV_PARAM_IN),
array(&$email, SQLSRV_PARAM_IN),
array(&$pass, SQLSRV_PARAM_IN),
array(&$photo, SQLSRV_PARAM_IN),
array(&$tags, SQLSRV_PARAM_IN),
array(&$sId, SQLSRV_PARAM_IN),
array(&$idTags, SQLSRV_PARAM_IN),
array(&$matrix, SQLSRV_PARAM_IN)); 

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( iconv('windows-1251','utf-8', print_r( sqlsrv_errors(), true)));
}

$row = sqlsrv_fetch_array($stmt); 
echo iconv('windows-1251','utf-8', $row['result']);

sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);
?>