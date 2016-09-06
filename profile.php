<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT equipment, resources and access</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-brand brand-btn" id="br-btn">
                <a class="fa fa-bars fa-fw" style="text-decoration: none;"></a>
            </div>    
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">IT equipment, resources and access</a>
            </div>
            <!-- /.navbar-header -->
<?php include 'notification.php' ?>
            <!-- /.navbar-top-links -->
<?php include 'navigation.php' ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php if (isset($_SESSION['user'])) {echo $_SESSION['user'];} ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                        <div id="notification" class="alert alert-danger alert-dismissable" style="display: none;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <span id="ntftxt"></span>
                        </div>
                        <div id="info"></div>
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#pwd-pills" data-toggle="tab">Сменить пароль</a>
                                </li>
                                <li><a href="#todo-pills" data-toggle="tab">Настроить панель</a>
                                </li>                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="pwd-pills">
                                        <div class="col-lg-3" style="padding: 20px">
                                            <div class="form-group">
                                            <input id="oldpwd" type="password" class="form-control" style="margin: 10px 0 0;" placeholder="Старый пароль">
                                            <input id="newpwd" type="password" class="form-control" style="margin: 10px 0 0;" placeholder="Новый пароль">
                                            <input id="chkpwd" type="password" class="form-control" style="margin: 10px 0 0;" placeholder="Подтвердите новый пароль">
                                            <button id="chgpwd" class="btn btn-default" style="margin: 10px 0 0; float: right;" >Сменить</button>
                                            </div>                                         
                                        </div>                                                                                                                
                                </div>
                                <div class="tab-pane fade in active" id="todo-pills">
                                                                                                                                                         
                                </div>                                
                             </div>
                        </div>
                </div>

             </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
 
                </div>
                <!-- /.col-lg-4 -->
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Profile -->
    <script src="js/profile.js"></script>
   <!-- <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script> -->

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
   <!-- <script src="js/demo/dashboard-demo.js"></script> -->
     

</body>

</html>
