<?php
include "../db.php";
session_start();

if (isset($_POST["tags"])){
	$array = $_POST["tags"];
	$tags = iconv("utf-8","windows-1251",implode(",", $array));
} else $tags = '';
$matrix = $_POST["access"];
isset($_POST['id']) ? $id = $_POST['id'] : $id = ''; 
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
/*
$id = '';
$edit=0;
$userad = 'EZykina5';
$idDep = 61;
$photo = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGAAAABgCAYAAADimHc4AAABrUlEQVR4nO3WMW7DIBhA4dz/KGxsXtjYGL1zBK5AJ1xMLFVNKrnKe8OT6jhBzf8h4kdrrdt9Pe7
+B+gJIAA7AQRgJ4AA7AQQgJ0AArATQAB2AgjATgAB2AkgADsBBGAngADsBBCAnQACsBNAAHYCCMBOAAHYCSAAOwEEYCeAAOwEEICdAHSAUkoPIfQQQo8xPt2PMR73c863r
/tRAPu+nwawbVvftu24P1+nlHoIoddab1v34wDGl9/3vbf2vWtrrccQSyn/Zl0MQCnl+Hvcm6u1HsfHeG1c11pfXhcHcHVUjEHlnHsI4Xht3bVjkCml0
+feXRcF0Fo7BjIPZR5USuk0xPmsnoc43vcX66IA5q6OirE71+vWvnf6T0fKb9fFAozdefVjeTWoMfz19+DddTEA48uPszrGeHpcnK
/Xx8VxnXN+OlbeWRcFMA9gnNXr/XmHr08167P9vJNfWRcJQE8AAdgJIAA7AQRgJ4AA7AQQgJ0AArATQAB2AgjATgAB2AkgADsBBG
AngADsBBCAnQACsBNAAHYCCMBOAAHYCSAAOwEEYCeAAOwEEIDdF9nhxGZsAEooAAAAAElFTkSuQmCC';
$fname = '';
$iname = '';
$oname = '';
$kab = '';
$job = '';
$info = '';
$phone = '';
$email = '';
$pass = '';
$tags = '';
$sId = 1;
$idTags = '';
$matrix = '';
*/
$photo = $_POST['photo'];
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);

//////////////////////////////////////
$datastring = base64_decode($photo);
$photo = './img/photo/'.$userad.'.png';
file_put_contents('.'.$photo, $datastring);
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

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC); 

echo json_encode(array(iconv('windows-1251','utf-8',$row['result']),iconv('windows-1251','utf-8',$row['org']),iconv('windows-1251','utf-8',$row['dep'])));

sqlsrv_free_stmt( $stmt);  
sqlsrv_close($conn);
?>