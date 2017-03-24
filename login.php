<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT equipment, resources and access</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>
            <!-- /.db connection -->            
<?php 
	include 'db.php'; 
    include 'mailer.php';
    session_start();
    if (isset($_GET['logout'])) {session_destroy();}

  function generate_password($number)
  {
    $arr = array('a','b','c','d','e','f',
                 'g','h','i','j','k','l',
                 'm','n','o','p','r','s',
                 't','u','v','x','y','z',
                 'A','B','C','D','E','F',
                 'G','H','I','J','K','L',
                 'M','N','O','P','R','S',
                 'T','U','V','X','Y','Z',
                 '1','2','3','4','5','6',
                 '7','8','9','0','!','?',
                 '&','%','@','$','+','-');
    // Генерируем пароль
    $pass = "";
    for($i = 0; $i < $number; $i++)
    {
      // Вычисляем случайный индекс массива
      $index = rand(0, count($arr) - 1);
      $pass .= $arr[$index];
    }
    return $pass;   //echo generate_password(10);
  }

?>
            <!-- /.db connection -->      
                     
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><a style="text-decoration: none;" href="/itr">IT equipment, resources and access</a></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="index.php" method="POST">
                        <?php if (isset($_GET['auth'])) {
                            if ($_GET['txt'] == 'noaccess') {
                                echo '<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="fa fa-warning fa-fw"></span>У вас нет доступа в систему.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><span class="fa fa-warning fa-fw"></span>Вы ввели не верный логин или пароль.</div>';
                            }
                        } 
                            if (isset($_GET['fogot']) and isset($_GET['email'])){
                                $sql = "select firstname+' '+middlename as name, login, pwditr, email from employees where idrole<>6 and email='".$_GET['email']."'";
                                $stmt = sqlsrv_query($conn,$sql);
                                if (!sqlsrv_has_rows($stmt)){
                                echo '<div class="alert alert-danger" role="alert"><a class="close" data-dismiss="alert">×</a><div><span class="fa fa-warning fa-fw"></span>Вы не являетесь пользователем системы.</div></div>';
                                } else {
                                    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                    $newpass = generate_password(10);
                                    $cryptpass = crypt($newpass);
                                    $login = $row['login'];
                                    $subject = "Сброс пароля ИТр"; 
                                    $namesignup = iconv("windows-1251","utf-8",$row['name']);
                                    $message = " 
                                        <p>Уважаемый(ая) $namesignup!</p>\n
                                        <p>Вы запустили процедуру сброса пароля. Мы сгенерировали для Вас новый пароль: <strong>$newpass</strong></p>\n 
                                        <p>Не забывайте больше свой пароль. <a href='http://dev.pkgo.ru/ITr'>ИТ ресурсы</a></p>\n"; 
                                        $body = "<html>\n"; 
                                        $body .= "<body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">\n"; 
                                        $body .= $message; 
                                        $body .= "</body>\n"; 
                                        $body .= "</html>\n";
                                        $mail->Subject = $subject;
                                        $mail->Body = $body;
                                        $mail->AddAddress($row['email'], $namesignup);
                                        $mail->Send();                 
                                sqlsrv_free_stmt($stmt);
                                $stmt = sqlsrv_query($conn,"update employees set pwditr='$cryptpass' where login='$login'");                   
                                echo '<div class="alert alert-success" role="success"><a class="close" data-dismiss="alert">×</a><span class="fa fa-info fa-fw"></span>Новый пароль отправлен на указанный Вами адрес эл. почты.</div>';
                                }
                                sqlsrv_free_stmt($stmt);
                                sqlsrv_close($conn);
                            }
                        ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Логин" name="email" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Пароль" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Запомнить меня
                                    </label>
                                    <a tabindex="-1" data-toggle="modal" data-target="#lostpass"  style="float: right;" href="#">Забыли пароль?</a> 
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block" name="submit" type="submit">Войти</button>
                                
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div style="top: 25%;" id="lostpass" class="modal fade LostPass" tabindex="-1" role="dialog" aria-labelledby="LostPass" aria-hidden="true" data-backdrop="static"> <!-- modal lost pass -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Сбросить пароль</h4>
      </div>
      <div class="modal-body">
        <form action="login.php" method="GET"><p>Введите корпоративный адрес электронной почты на который придет новый пароль для входа.</p>
        <p>
        <input name="email" type="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" required class="form-control" placeholder="Укажите адрес эл. почты" />
        <input hidden="true" name="fogot" value="1" />
        </p>
          <div style="text-align: right;">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Нет</button>
            <button type="submit" class="btn btn-primary" >Сбросить</button>
         </div></form>
      </div>
    </div>
  </div>
</div> 
    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
