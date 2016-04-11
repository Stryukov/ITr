<?php
$serverName = "sqlserver"; //serverName\instanceName
$connectionInfo = array( "Database"=>"ITr", "UID"=>"service", "PWD"=>"123456");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( !$conn ) {
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}


require_once("../PHPMailer/class.phpmailer.php");  //подключаем библиотеку

$mail = new PHPMailer(); //создаем экземпляр класса
$mail->IsSMTP(); //включаем SMTP
$mail->Host = 'mail.pkgo.ru';
$mail->SMTPAuth = true; // включаем аутентификацию по SMTP
$mail->Port = 25; // устанавливаем SMTP порт
$mail->Username = 'postbot@pkgo.ru';  //ваша почта
$mail->Password = 'MLuB1d';  //пароль
$mail->SetFrom('postbot@pkgo.ru', 'ИТ ресурсы');
$mail->IsHTML(true); // отправка в виде HTML
$mail->CharSet='utf-8'; //кодировка письма

/*
 $mail = new PHPMailer();
 $mail->IsSMTP(); // telling the class to use SMTP
 // enables SMTP debug information (for testing) // 1 = errors and messages // 2 = messages only
 //$mail->SMTPDebug = 0;
 $mail->SMTPAuth = true; // enable SMTP authentication
 $mail->SMTPSecure = "tls"; // sets the prefix to the servier
 $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
 $mail->Port = 587; // set the SMTP port for the GMAIL server
 $mail->Username = "pkgo.adm@gmail.com"; // GMAIL username
 $mail->Password = "12Ghyu&y"; // GMAIL password
 $mail->SetFrom('support@pkgo.ru', 'Администрация города одобряет');
 // optional, comment out and test
 $mail->IsHTML(true); // send as HTML
 $mail->CharSet='utf-8'; //кодировка письма
*/
?>
