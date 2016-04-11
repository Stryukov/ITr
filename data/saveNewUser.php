<?php

include "db.php";
session_start();


$tags = $_POST["tags"];
$id = $_POST["id"];
$edit = $_POST["edit"];
$fname = iconv("utf-8","windows-1251",$_POST['fname']);
$iname = iconv("utf-8","windows-1251",$_POST['iname']);
$oname = iconv("utf-8","windows-1251",$_POST['oname']);
$idDep = $_POST["idDep"];
$kab = iconv("utf-8","windows-1251",$_POST['kab']);
$dolgn = iconv("utf-8","windows-1251",$_POST['dolgn']);
$dopinfo = iconv("utf-8","windows-1251",$_POST['dopInfo']);
$phone = $_POST["tel"];
$userad = $_POST["userad"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$rabm = iconv("utf-8","windows-1251",$_POST['rabm']);

$photo = $_POST['photo'];
$photo = str_replace('data:image/png;base64,', '', $photo);
$photo = str_replace(' ', '+', $photo);
//$result = file_put_contents('img.png',base64_decode($photo));
//$data = unpack("H*hex", $photo);

$datetm = 
//////////////////////////////////////
$datastring = base64_decode($photo);
$data = unpack("H*hex", $datastring);
//////////////////////////////////
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
mssql_query($sql);   
$sql = mssql_query("select id from Employees where Login ='$userad'");   
$data = mssql_fetch_array($sql); $result = $data['id'];        

if ($edit==0) {
    if ($nnn<1) {
    $ssId = $_SESSION['id'];
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
           ,$ssId)";
           mssql_query($sql2);}
    }

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

?>