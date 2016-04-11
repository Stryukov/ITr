<?php

/**
 * @author gencyolcu
 * @copyright 2013
 */
 //error_reporting(E_ALL);
 include "db.php";
 session_start();
$headidea = iconv("utf-8","windows-1251",addslashes($_POST['headidea']));
$textidea = iconv("utf-8","windows-1251",addslashes($_POST['textidea']));
$scopeidea = iconv("utf-8","windows-1251",addslashes($_POST['scopeidea']));
$fotoidea = iconv("utf-8","windows-1251",addslashes($_POST['fotoidea']));
$latlongmet = explode(',', addslashes($_POST['latlongmet']));
$id = $_SESSION['user_id'];

$sql="SELECT activate FROM users WHERE id=$id";
$res=mssql_query($sql);
$row = mssql_fetch_array($res);

//if ($row['activate']==0){
// storing a file
if ($fotoidea){
$fotoidea = iconv("utf-8","windows-1251",$_SESSION['login']).session_id().$fotoidea; //iconv("windows-1251","utf-8",$fotoidea); 
$datastring = file_get_contents("./tmp/".$fotoidea);
$data = unpack("H*hex", $datastring);
echo mssql_query("INSERT INTO suggest (header,text,scope,binary_file,longitude,latitude,userid,status,sug_date,views) 
VALUES ('$headidea', '$textidea', '$scopeidea', 0x".$data['hex'].", '$latlongmet[0]', '$latlongmet[1]', '$id', '".iconv('utf-8','windows-1251','На проверке')."', SYSDATETIME(),0)");
unlink('./tmp/',$fotoidea);
} else {
echo mssql_query("INSERT INTO suggest (header,text,scope,longitude,latitude,userid,status,sug_date,views) 
VALUES ('$headidea', '$textidea', '$scopeidea', '$latlongmet[0]', '$latlongmet[1]', '$id', '".iconv('utf-8','windows-1251','На проверке')."', SYSDATETIME(),0)");
}

  $scopeidea = iconv("windows-1251","utf-8",$scopeidea);
  $headidea = iconv("windows-1251","utf-8",stripcslashes($headidea));
  $textidea = iconv("windows-1251","utf-8",stripcslashes($textidea));
  $subject = "Город одобряет - добавлено предложение"; 
  $login = iconv("utf-8","utf-8",$_SESSION['login']);
  $message = " 
          <p>Уважаемый(ая) $login!</p>\n
          <p>Вы создали предложение в сфере $scopeidea в сервисе <a href='http://app.pkgo.ru/approval/'>Город одобряет</a>, оно станет доступно другим пользователям для просмотра и голосования после рассмотрения сотрудниками администрации Петропавловск-Камчатского городского округа.</p>\n 
          <p style='background-color: #E6E1E1;'><strong><blockquote>$headidea</blockquote></strong><br />$textidea</p>\n
          <p>С уважением, <br /> Администрация Петропавловск-Камчатского городского округа<br /><img src='http://app.pkgo.ru/approval/img/logo.png'></p>\n    
"; 
    $body = "<html>\n"; 
    $body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n"; 
    $body .= $message; 
    $body .= "</body>\n"; 
    $body .= "</html>\n";
 
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($_SESSION['email'], $login);
$mail->Send(); 
//} else {
//    echo "block";
//}
?>