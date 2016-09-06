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
    <link href="css/plugins/dataTables/dataTables.tableTools.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet"/>
        
        
    <!-- Page-Level Plugin CSS - Blank -->
<link href="css/plugins/dialog/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
<link href="css/plugins/tag/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
<link href="css/plugins/docs/docs.min.css" rel="stylesheet" type="text/css" />

    

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">
<style type="text/css">
.dataTable {
        width: 100% !important;
    }
</style>
</head>

<body>

<div id="bstrpDiag" style="display: none;"></div>

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
            <!-- /.db connection -->            
<?php //include 'db.php' ?>
            <!-- /.db connection -->            
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
                <div class="col-lg-5 col-lg-offset-7 nav-button" >
                
<!--                
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary ">
    <input type="checkbox" autocomplete="off"> Уволенные
  </label>
</div> -->               
                
                    <button id="ftoogle" type="button" class="btn btn-primary"><i class="fa fa-filter"></i> Фильтр</button>
                    <button  class="btn btn-primary" data-toggle="modal" onclick="showModalD('newUser')" ><i class="fa fa-user-plus"></i> Добавить</button>

<!-- Split button -->
<div class="btn-group">
  <button onclick="editUser()" type="button" class="btn btn-danger"><i class="fa fa-edit"></i> Изменить</button>
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu" style="text-align: left;">
    <li><a href="#" onclick="showModalD('transferUser')"><i class="fa fa-exchange"></i> Перевести</a></li>
    <li><a onclick="deleteUser();" href="#" ><i class="fa fa-user-times"></i> Уволить</a></li>
  </ul>
</div>                    
                </div>                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <!-- /.col-lg-4 -->
                <div class="row">
                <div class="col-lg-12">
                <div id="filtr" class="well" style="display: none;">
                    <h4>Тут будет сам фильтр</h4>
                    <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="#">...</a>.</p>
                    <a class="btn btn-default btn-lg btn-block" id="subfilter" href="#">Применить фильтр</a>
                </div>
                </div>                  
                <div class="col-lg-4">
				<!--tree -->
<div class="tree well" id="treeOrg" data-placement="top" data-trigger="manual" onclick="$('#'+this.id).popover('hide');">

</div>

</div>
                <div class="col-lg-8">

<!--panel-->
 <div class="panel panel-default">
                        <div class="panel-heading" id="tHeadd" tag="-1">
                            Подразделения не выбраны
                        </div>
                        <!-- /.panel-heading -->
 <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataUsers2"> 
                    
                                    <thead>
                                        <tr>
                                            <th>id_user</th>
                                            <th>Фамилия И.О.</th>
                                            <th>Логин AD</th>                                            
                                            <th>Должность</th>
                                            <th>Телефон</th>
                                            <th>Рабочее место</th>
                                        </tr>
                                    </thead>
                                    <tbody id="usersTable" data-placement="top" data-trigger="manual" onclick="$('#'+this.id).popover('hide');">
                                  
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

<div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="delUser" aria-hidden="true" data-backdrop="static"> <!-- modal Delete User -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('delUser');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Уволить сотрудника</h4>
      </div>
      <div class="modal-body">
        <p>Вы действительно хотите уволить выбранного сотрудника?</p>

          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('delUser')" >Нет</button>
            <button type="button" class="btn btn-primary" onclick="confirmDelUser();">Уволить</button>
         </div>
      </div>
    </div>
  </div>
</div>
<!--dialog-->
                            <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
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
                                <li id="main-pill" class="active"><a href="#main-pills" data-toggle="tab">Основная</a>
                                </li>
                                <li><a href="#wplace-pills" data-toggle="tab">Рабочее место</a>
                                </li>
                                <li><a href="#history-pills" data-toggle="tab">Журнал</a>
                                </li>
                                <li><a href="#notes-pills" data-toggle="tab">Дополнительно</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="main-pills">
                                <form id="main"> 
                                    <br />
                                        <div class="row">
                                        <div class="col-lg-9">
                                        <p><label>Фамилия</label>
                                        <input oninput="svButtonB();" id="fname" class="form-control" /></p>
                                        <p><label>Имя</label>
                                        <input oninput="svButtonB();" id="iname" class="form-control" /></p>
                                        </div>
                                        <div class="col-lg-3 media">
                                        <a href="#" class="thumbnail media-bottom" style="margin-top: 8px;margin-bottom: 12px;">               
                                           <div id="tml"> <img id="tml" data-src="holder.js/96x96" alt="..."> </div> 
                                        </a>                                        
                                        </div>                                        
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                        <p><label>Отчество</label>
                                        <input oninput="svButtonB();" id="oname" class="form-control" /></p>                                        
                                        </div>
                                        <div class="col-lg-6">
                                        <p><label>Эл. почта</label>
                                        <input oninput="svButtonB();" id="email" class="form-control" /></p>                                        
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-lg-6">
                                        <p><label>Кабинет</label>
                                        <input oninput="svButtonB();" id="kab" class="form-control" /></p>                                        
                                        </div>
                                        <div class="col-lg-6">
                                        <p><label>Телефон</label>
                                        <input oninput="svButtonB();" id="tel" class="form-control" /></p>                                        
                                        </div>
                                        </div>
                                        <p><label>Должность</label><br />
                                        <input id="job" type="hidden" style="width: 100%;height: 34px;" /></p>                                     
                                        <div class="row">
                                        <div class="col-lg-8">
                                        <label>Пользователь AD</label>                                    
                                        <div class="input-group">
                                            <input oninput="svButtonB();" id="userad" data-placement="top" data-trigger="manual" onfocus="$('#'+this.id).popover('hide');" type="text" class="form-control">
                                            <span class="input-group-btn">
                                                <button onclick="loadFromAd()" class="btn btn-default" type="button">Загрузить из AD</button>
                                            </span>
                                        </div>                                        
                                        </div>
                                        <div class="col-lg-4">
                                        <p><label>Пароль</label>
                                        <input oninput="svButtonB();" id="pass" class="form-control" /></p>                                        
                                        </div>
                                        </div>                                        
                                     </form>                                                                                                                                                                                                  
                                </div>
                                <div class="tab-pane fade" id="wplace-pills">
                                <div class="bs-callout bs-callout-info">
                                    <h4 id="nameWP">Рабочее место отсутствует</h4>
                                    <p id="streetWP">Расположение: </p>
                                </div>
<div class="input-group">
          <input id="inpWP" type="text" class="form-control">
          <div class="input-group-btn">
            <button type="button" id="tWP" class="btn btn-default" onclick="takeWP()">Занять РМ</button>
            <button type="button" id="tDrop" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right" role="menu">
              <li id="chStreet"><a tabindex="-1" data-toggle="modal" onclick="preloadChangeStreet()" href="#">Изменить адрес РМ</a></li>
              <li id="freeWP"><a tabindex="-1" data-toggle="modal" data-target="#emptyWP" href="#">Освободить РМ</a></li>
            </ul>
          </div>
        </div><br />
<div id="newWP" class="modal fade WorkplaceIsMissing" tabindex="-1" role="dialog" aria-labelledby="WorkplaceIsMissing" aria-hidden="true" data-backdrop="static"> <!-- modal new WP -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('newWP');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Создание РМ</h4>
      </div>
      <div class="modal-body">
        <p>Рабочее место с таким именем отсутсвует. Хотите создать РМ?</p>
        <h4 id="nnWP" style="color: #428bca;">Comp-245-3</h4>
        <p><label>Расположение РМ:</label><input id="street" type="hidden" style="width: 100%;height: 34px;" /></p>
        <p><button style="width: 100%;" onclick="newStreet()" type="button" class="btn btn-default" data-toggle="collapse" data-target="#newStreet" aria-expanded="false" aria-controls="newStreet" >Такого адреса нет в списке</button></p>
            <div class="collapse" id="newStreet">
                <div class="well">
                    <input id="addStreet" class="form-control" placeholder="Укажите новый адрес" />
                </div>
            </div>
          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('newWP')" >Нет</button>
            <button type="button" class="btn btn-primary" onclick="saveWP()">Создать</button>
         </div>
      </div>
    </div>
  </div>
</div>

<div id="busyWP" class="modal fade WorkplaceIsBusy" tabindex="-1" role="dialog" aria-labelledby="WorkplaceIsBusy" aria-hidden="true" data-backdrop="static"> <!-- modal busy WP -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('busyWP');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >РМ занят</h4>
      </div>
      <div class="modal-body">
        <p>Рабочее место занято другим пользователем: <h4 id="busyman" style="color: #428bca;"></h4> Вы уверены, что хотите присвоить это РМ?</p>
          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('busyWP');" >Нет</button>
            <button type="button" class="btn btn-primary" onclick="confirmWP()">Я уверен</button>
         </div>
      </div>
    </div>
  </div>
</div> 
<div id="emptyWP" class="modal fade WorkplaceEmpty" tabindex="-1" role="dialog" aria-labelledby="WorkplaceEmpty" aria-hidden="true" data-backdrop="static"> <!-- modal Empty WP -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('emptyWP');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Освободить РМ</h4>
      </div>
      <div class="modal-body">
        <p>Вы уверены, что хотите освободить это рабочее место?</p>
          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('emptyWP');" >Нет</button>
            <button type="button" onclick="clearWP()" class="btn btn-primary">Я уверен</button>
         </div>
      </div>
    </div>
  </div>
</div>
<div id="changeStreet" class="modal fade ChangeStreet" tabindex="-1" role="dialog" aria-labelledby="ChangeStreet" aria-hidden="true" data-backdrop="static"> <!-- modal Change Street -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('changeStreet');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Изменить адрес РМ</h4>
      </div>
      <div class="modal-body">
        <p>Рабочему месту уже присвоен адрес. Хотите изменить?</p>
        <h4 id="cStreet" style="color: #428bca;">ул. Ленинская, 14</h4>
        <p><label>Новый адрес:</label><input id="csStreet" type="hidden" style="width: 100%;height: 34px;" /></p>
        <p><button style="width: 100%;" onclick="newStreet2()" type="button" class="btn btn-default" data-toggle="collapse" data-target="#newStreet2" aria-expanded="false" aria-controls="newStreet2" >Такого адреса нет в списке</button></p>
            <div class="collapse" id="newStreet2">
                <div class="well">
                    <input id="addStreet2" class="form-control" placeholder="Укажите новый адрес" />
                </div>
            </div>
          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('changeStreet')" >Нет</button>
            <button type="button" class="btn btn-primary" onclick="saveStreet()">Изменить</button>
         </div>
      </div>
    </div>
  </div>
</div>

        
                                         
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <div class="row"><div class="col-xs-8" style="margin-top: 7px;">Закрепленное оборудование</div>
<div class="btn-group col-xs-4" style="right: -35px;">
  <button id="addIT" type="button" class="btn btn-primary">Добавить</button>
  <button id="addDrop" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li id="removeIT"><a href="#">Удалить</a></li>
  </ul>
</div></div>                             
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th style="width: 150px;">Инв. номер</th>
                                            <th>Наименование</th>
                                            <th>Закреплено</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>0012212122221</td>
                                            <td>Монитор LG25</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>1231311212121</td>
                                            <td>Системный блок №3</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>3221212122221</td>
                                            <td>Принтер HP2727</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>3221212122221</td>
                                            <td>Планшет ipad</td>
                                            <td style="text-align: center;"><a class="fa fa-check fa-fw" style="text-decoration: none;"></a></td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>                                                  
                                </div>
                                <div class="tab-pane fade" id="history-pills"><br />                                   
                                        <div class="input-group">
                                            <input id="event" type="text" class="form-control">
                                            <span class="input-group-btn">
                                                <button id="insEV" onclick="insert_event()" class="btn btn-default" type="button">Добавить запись</button>
                                            </span>
                                        </div><br />                                 
                            <div  class="table-responsive">
                                <table id="uHistory" class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th style="width: 150px;">Время</th>
                                            <th>Действие</th>
                                            <th>Пользователь</th>
                                        </tr>
                                    </thead>
                                    <tbody id="history_body">
                                        <tr>
                                            <td>1</td>
                                            <td>2014-11-19 16:07</td>
                                            <td>Переведен в ДГЗО - Отдел Архитектуры</td>
                                            <td>Стрюков С.И.</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2014-11-19 16:07</td>
                                            <td>Выдан Планшет</td>
                                            <td>Стрюков С.И.</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2014-11-19 16:07</td>
                                            <td>Уволен</td>
                                            <td>Стрюков С.И.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>                                </div>
                                <div class="tab-pane fade" id="notes-pills">
                                            <br />
                                            <p><label>Дополнительная информация</label>
                                            <textarea id="dopInfo" oninput="svButtonB();" class="form-control" rows="10"></textarea></p>
                                            <p><label>Тэги</label><br />
                                            <input id="utags" class="mytag" data-role="tagsinput" /></p>
                                            <p><label>Доступ к ИР/АС</label><br />
                                            <input id="access" class="mytag" oninput="svButtonB();" data-role="tagsinput" /></p>                                                                                         
                                </div>                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                                         
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" onclick="usrclose()">Закрыть</button>
                                            <button id="svButton"  onclick="saveNewUser()" type="button" class="btn btn-primary">Сохранить изменения</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
<!--dialog-->




<!--dialog-->
                            <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #428bca;">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="alertTtl">Новый пользователь</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="bootstrap-dialog-body">
                                        <div class="bootstrap-dialog-message" id="alertMsg"></div>
                                         </div>
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button id="alertBtn" type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
<!--dialog-->

<!--dialog-->
                            <div class="modal fade" id="depart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #428bca;">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="alertTtl">Выбор подразделения</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="bootstrap-dialog-body">
                                         <p><label>Организация</label><br />
                                        <input id="orgSelect" type="hidden" style="width: 100%;height: 34px;" /></p> 
                                         <p><label>Отдел</label><br />
                                        <input id="depSelect" type="hidden" style="width: 100%;height: 34px;" /></p> 
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                                            <button onclick="transferUser()" type="button" class="btn btn-primary">Перенести</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
<!--dialog-->














    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
      <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->

    <!-- Page-Level Plugin Scripts - Blank -->
    <script src="js/select2.js"></script>
	<script src="js/people.js"></script>
    
    
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script> 
       <script src="js/plugins/dataTables/dataTables.tableTools.js"></script>
       <script src="js/plugins/dialog/bootstrap-dialog.min.js"></script>
       <script src="js/holder.js"></script>
       <script src="js/plugins/tag/bootstrap-tagsinput.js"></script>
       <script type="text/javascript" src="js/plugins/tag/typeahead.bundle.js"></script>

	
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
