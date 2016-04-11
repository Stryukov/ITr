<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IT equipment, resources and access</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet"/>
	<link href="css/tree.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<!--   	<link href="css/jquery.dataTables.css" rel="stylesheet"> -->
        <link href="css/jquery-ui.css" rel="stylesheet"/>
        
        
    <!-- Page-Level Plugin CSS - Blank -->

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>



    <div id="wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
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
                    <h1 class="page-header">Список пользователей</h1>
                </div>
                <div class="col-lg-3 col-lg-offset-9" style="margin-top: -65px;">
                    <button type="button" class="btn btn-outline btn-primary">Фильтр</button>
                    <button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#newUser">Добавить</button>
                    <button type="button" class="btn btn-outline btn-primary">Изменить</button>
                    <button type="button" class="btn btn-outline btn-primary">Удалить</button>
                </div>                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <!-- /.col-lg-4 -->
                <div class="row">
                <div class="col-lg-4">
				<!--tree -->
<div class="tree well" id="treeOrg">

</div>

</div>
                <div class="col-lg-8">

<!--panel-->
 <div class="panel panel-default">
                        <div class="panel-heading" id="tHeadd">
                            DataTables Advanced Tables
                        </div>
                        <!-- /.panel-heading -->
 <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataUsers2"> 
                    
                                    <thead>
                                        <tr>
                                            <th>Фамилия И.О.</th>
                                            <th>Должность</th>
                                            <th>Телефон</th>
                                            <th>Рабочее место</th>
                                            <th>Состояние</th>
                                        </tr>
                                    </thead>
                                    <tbody id="usersTable">
                                     <tr>
                                            <td>Trident</td>
                                            <td>Internet Explorer 4.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">4</td>
                                            <td class="center">X</td>
                                        </tr>
                                        <tr>
                                            <td>Trident</td>
                                            <td>Internet Explorer 5.0</td>
                                            <td>Win 95+</td>
                                            <td class="center">5</td>
                                            <td class="center">C</td>
                                        </tr>
                                        <tr>
                                            <td>Trident</td>
                                            <td>Internet Explorer 5.5</td>
                                            <td>Win 95+</td>
                                            <td class="center">5.5</td>
                                            <td class="center">A</td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
</div>                    
<!--panel-->


					
					
					<!--tree -->
                    <!-- /.panel -->
                </div>
                </div>
                <!-- /.col-lg-4 -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


<!--dialog-->
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Новый пользователь</h4>
                                        </div>
                                        <div class="modal-body">
                                        
                                        
                                         <div class="panel panel-default">
                     <!--   <div class="panel-heading">
                            Pill Tabs
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <!-- Nav tabs -->
                            <ul class="nav nav-pills">
                                <li class="active"><a href="#home-pills" data-toggle="tab">Основная информация</a>
                                </li>
                                <li><a href="#gajets-pills" data-toggle="tab">Оборудование</a>
                                </li>
                                <li><a href="#doc-pills" data-toggle="tab">Журнал</a>
                                </li>
                                <li><a href="#notes-pills" data-toggle="tab">Заметки</a>
                                </li>
                            </ul>              
                                   <!-- Tab panes -->
                            <div class="tab-content"> 
                            <!--home-->    
                                <div class="tab-pane fade in active" id="home-pills">        
                                        
                                        
                                         <div class="row">
                                        
                                        <div class="col-lg-5">
                                        <p><label>Фамилия</label>
                                        <input class="form-control" id="fname" /></p> 
                                        <p><label>Имя</label>
                                        <input class="form-control" id="iname" /></p> 
                                        <p><label>Отчество</label>
                                        <input class="form-control" id="oname" /></p>   
                                        <p><label>Должность</label>
                                        <input class="form-control" id="dolgn" /></p>   
                                        <p><label>Телефон</label>
                                        <input class="form-control" id="tel" /></p>   
                                         
                                        </div>
                                        
                                        <div class="col-lg-5">
                                        <p><label>Кабинет</label>
                                        <input class="form-control" id="kab" /></p>  
                                        <p><label>Пользователь AD</label>
                                        <input class="form-control" id="userad" /></p>   
                                        <p><label>Пароль</label>
                                        <input type="password" class="form-control" id="pass" /></p>   
                                        <p><label>Рабочее место</label>
                                        <input class="form-control" id="rabm" /></p> 
                                        <p><label>Состояние сотрудника</label>
                                            <select class="form-control" id="sost">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select></p>   
                                       
                                        </div>
                                        
                                        </div>
                                        
                                        
                                        </div>
                                        
                                        
                                        
                                        
                                         <div class="tab-pane fade in active" id="gajets-pills">    
                                         
                                         </div>
                                        
                                         <div class="tab-pane fade in active" id="doc-pills">    
                                         
                                         </div>
                                        
                                         <div class="tab-pane fade in active" id="notes-pills">    
                                         
                                         </div>
                                        
                                        
                                        <!--home-->
                                        
                                        
                                        
                                        </div>
                                        </div>
                                        </div>
                                          </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                            <button onclick="newUser()" type="button" class="btn btn-primary">Добавить пользователя</button>
                                        </div>
                                    </div>


</div>                                </div>
<!--dialog-->



    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
      <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->

    <!-- Page-Level Plugin Scripts - Blank -->
    <script src="js/select2.js"></script>
	<script src="js/equipment.js"></script>
    
    
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script> 

	
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
