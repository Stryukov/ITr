<?php

require_once($cnf->libMailer);  //подключаем библиотеку

$mail = new PHPMailer(); //создаем экземпляр класса
$mail->IsSMTP(); //включаем SMTP
$mail->Host = $cnf->smtpHost;
$mail->SMTPAuth = true; // включаем аутентификацию по SMTP
$mail->Port = $cnf->smtpPort; // устанавливаем SMTP порт
$mail->Username = $cnf->smtpUser;  //ваша почта
$mail->Password = $cnf->smtpPwd;  //пароль
$mail->SetFrom($cnf->setFrom, $cnf->setFromName);
$mail->IsHTML(true); // отправка в виде HTML
$mail->CharSet='utf-8'; //кодировка письма

?>
