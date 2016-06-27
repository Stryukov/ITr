<?php

include "../db.php";
session_start();


$tags = $_POST["tags"];
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
//$rabm = iconv("utf-8","windows-1251",$_POST['rabm']);

$photo = $_POST['photo'];
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);
//$result = file_put_contents('img.png',base64_decode($photo));
//$data = unpack("H*hex", $photo);

//$datetm = 
//////////////////////////////////////
$datastring = base64_decode($photo);
$data = unpack("H*hex", $datastring);
$photo = '0x'.$data['hex'];
//////////////////////////////////
$tsql_callSP = "{call newEmployee( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )}";  

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
array(&$photo, SQLSRV_PARAM_IN, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY),SQLSRV_SQLTYPE_VARBINARY('max')),
array(&$tags, SQLSRV_PARAM_IN),
array(&$sId, SQLSRV_PARAM_IN));  

$stmt = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt === false )
{
     echo "Error in executing statement 1.\n";
     die( print_r( sqlsrv_errors(), true));
}

$row = sqlsrv_fetch_array($stmt); 
echo iconv('windows-1251','utf-8', $row['result']);


/*
////////////////////////////////////////////////// добавление пользователя
if ($edit==0) {
    $testsql = mssql_query("select id from [dbo].[Employees] where Login='$userad'");
    $nnn = mssql_num_rows($testsql);
    if ($nnn<1) {
$sql = "INSERT INTO [dbo].[Employees] 
           ([LastName]
           ,[FirstName]
           ,[MiddleName]
           ,[idDepartment]
           ,[idJob]
           ,[Phone]
           ,[Cabinet]
           ,[Login]
           ,[Pwd]
           ,[Description]
           ,[Foto]
           ,[iduTags]
           ,[State]
           ,[PwdItr]
           ,[idRole]
           ,[email])
     VALUES
           ('$fname'
           ,'$iname'
           ,'$oname'
           ,$idDep
           ,(select id from refJob where refJob.Name = '$dolgn')
           ,'$phone'
           ,'$kab'
           ,'$userad'
           ,'$pass'
           ,'$dopinfo'
           ,0x".$data['hex']."
           ,null
           ,1
           ,null
           ,6
           ,'$email')";}
         
           } else {
////////////////////////////////////////////////// Изменение пользователя            
$sql = "UPDATE [dbo].[Employees]
   SET [LastName] = '$fname'
      ,[FirstName] = '$iname'
      ,[email] = '$email'
      ,[MiddleName] = '$oname'
      ,[idDepartment] = $idDep
      ,[idJob] = (select id from refJob where refJob.Name = '$dolgn')
      ,[Phone] = '$phone'
      ,[Cabinet] = '$kab'
      ,[Login] = '$userad'
      ,[Pwd] = '$pass'
      ,[Description] = '$dopinfo'
      ,[Foto] = 0x".$data['hex']."
      ,[iduTags] = null
 WHERE [id] = $id";            
           }
//////////////////////////////////////////////////            
////////////////////////////////////////////////// запись в журнал
mssql_query($sql);   
$sql = mssql_query("select id from Employees where Login ='$userad'");   
$data = mssql_fetch_array($sql); $result = $data['id'];        

if ($edit==0) {
    if ($nnn<1) {
    $text = iconv('utf-8','windows-1251','Создание пользователя');
    $sql2 = "
    INSERT INTO [dbo].[uHistory]
           ([eDate]
           ,[Event]
           ,[idEmployees]
           ,[idAuthor])
     VALUES
           (SYSDATETIME()
           ,'$text'
           ,(select id from Employees where [Employees].[Login]='$userad')
           ,$sId)";
           mssql_query($sql2);}
    }
////////////////////////////////////////////////// 
for ($i=0;$i<count($tags);$i++)
{
    $nname = iconv('utf-8','windows-1251',$tags[$i]);
    $tg_sql = mssql_query("select * from refuTags where 
    idEmployees=(select id from Employees where [Employees].[Login]='$userad') and Name='$nname'");
    if (mssql_num_rows($tg_sql)<1) {
        //echo '0';
        mssql_query("INSERT INTO [dbo].[refuTags]
           ([Name]
           ,[idEmployees])
     VALUES
           ('$nname'
           ,(select id from Employees where [Employees].[Login]='$userad'))");
    }
}
$arrsql2 = mssql_query("select name from refutags where idemployees=(select id from Employees where [Employees].[Login]='$userad')");
while ($arr2=mssql_fetch_array($arrsql2)){
$tmp=iconv('windows-1251','utf-8',$arr2['name']);    
    if (in_array($tmp,$tags)){} else {
        $tmp2=$arr2['name'];
        echo $tmp.',';
        mssql_query("delete from refutags where name='$tmp2' and idemployees=(select id from Employees where [Employees].[Login]='$userad')");
    }
}

if ($nnn>0) {echo 'no';} else 
{echo  $result;}
*/
?>