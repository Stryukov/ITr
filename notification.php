            <!-- /.db connection -->            
<?php
include 'db.php';
session_start();


if (isset($_SESSION['login'])) {
} else {

    isset($_POST['email']) ? $usr = $_POST['email'] : $usr = null;
    isset($_POST['password']) ? $pwd = $_POST['password'] : $pwd = null;
    
    //if (isset($_POST['submit'])) {console.log('нажата');}
    if ($usr == '') {header("Location: login.php?auth=0");}
    
    $stmt = sqlsrv_query($conn,
        "SELECT id,[Login],lastname+' '+firstname+' '+middlename as fio, pwditr FROM Employees WHERE login='$usr' and state<>0");
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row['pwditr'] <> crypt(iconv('utf-8','windows-1251',$pwd), $row['pwditr'])) {
        header("Location: login.php?auth=0");
    } else {
        $_SESSION['login'] = $row['Login'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['user'] = iconv('windows-1251', 'utf-8', $row['fio']);
    }
    sqlsrv_free_stmt($stmt);
}
sqlsrv_close($conn);
?>
            <!-- /.db connection -->    
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Юля Шевчук</strong>
                                    <span class="pull-right text-muted">
                                        <em>Вчера</em>
                                    </span>
                                </div>
                                <div>Объем предоставления гарантии качества работ: в полном объеме на все работы, представленные в...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Юля Шевчук</strong>
                                    <span class="pull-right text-muted">
                                        <em>Вчера</em>
                                    </span>
                                </div>
                                <div>Объем предоставления гарантии качества работ: в полном объеме на все работы, представленные в...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>Юля Шевчук</strong>
                                    <span class="pull-right text-muted">
                                        <em>Вчера</em>
                                    </span>
                                </div>
                                <div>Объем предоставления гарантии качества работ: в полном объеме на все работы, представленные в...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Все сообщения</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Задача 1</strong>
                                        <span class="pull-right text-muted">40% Выполнено</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Задача 2</strong>
                                        <span class="pull-right text-muted">20% Выполнено</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Задача 3</strong>
                                        <span class="pull-right text-muted">60% Выполнено</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Задача 4</strong>
                                        <span class="pull-right text-muted">80% Выполнено</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Все задачи</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> Новый комментарий
                                    <span class="pull-right text-muted small">4 минуты назад</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 Новых подписчика
                                    <span class="pull-right text-muted small">12 минуты назад</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Письмо отправлено
                                    <span class="pull-right text-muted small">4 минуты назад</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Новые задачи
                                    <span class="pull-right text-muted small">4 минуты назад</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Сервер перезагружен
                                    <span class="pull-right text-muted small">4 минуты назад</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Все уведомления</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"> <?php if (isset($_SESSION['user'])) {
    echo $_SESSION['user'];
} ?></a>
                        </li>                    
                        <li class="divider"></li>                        
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> Профиль</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Настройки</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.php?logout=1"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
