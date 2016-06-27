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
                    <h1 class="page-header">Линейные справочники</h1>
                </div>
                <div class="col-lg-5 col-lg-offset-7 nav-button" >
                
<!--                
<div class="btn-group" data-toggle="buttons">
  <label class="btn btn-primary ">
    <input type="checkbox" autocomplete="off"> Уволенные
  </label>
</div> -->               
                
  <button  class="btn btn-primary" onclick="newRec()" ><i class="fa fa-plus"></i> Добавить</button>

<!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary" onclick="editRec()"><i class="fa fa-pencil-square-o"></i> Изменить</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu dropdown-menu-right" role="menu">
    <li><a href="#" onclick="delRec()" style="text-align: left;" ><i class="fa fa-trash-o"></i> Удалить</a></li>
  </ul>
</div>                    
                </div>                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <!-- /.col-lg-4 -->
                <div class="row">
                <div class="col-lg-3">
				<!--tree -->
<div class="tree well" id="treeRefs" data-placement="top" data-trigger="manual" onclick="$('#'+this.id).popover('hide');"></div>

</div>
                <div class="col-lg-9">

<!--panel-->
 <div class="panel panel-default">
                        <div class="panel-heading" id="tHeadd" tag="-1">Справочник не выбран</div>
                        <!-- /.panel-heading -->
 <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="refTable"> 
                    
                                    <thead id="tblHead" style="display: none;">
                                        <tr>
                                            <th>ID</th>
                                            <th>#</th>
                                            <th>Наименование</th>
                                            <th>Описание</th>                                            
                                            <th>Родитель</th>
                                            <th>Родитель ИД</th>
                                        </tr>
                                    </thead>
                                    <tbody id="refTableBody" data-placement="top" data-trigger="manual" onclick="$('#'+this.id).popover('hide');">
                                  
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


<div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="delUser" aria-hidden="true" data-backdrop="static"> <!-- modal Delete User -->
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" onclick="clsModal('delUser');" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Удалить запись</h4>
      </div>
      <div class="modal-body">
        <p id="delTxt">Вы действительно хотите удалить запись из справочника?</p>

          <div style="text-align: right;">
            <button type="button" class="btn btn-default" onclick="clsModal('delUser')" >Нет</button>
            <button type="button" class="btn btn-primary" onclick="delRefRec();">Удалить</button>
         </div>
      </div>
    </div>
  </div>
</div>
                
                
                
                
                
<div style="top: 25%;" id="refItem" class="modal fade refItem" tabindex="-1" role="dialog" aria-labelledby="refItem" aria-hidden="true" data-backdrop="static"> <!-- modal lost pass -->
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 id="dialogHead" class="modal-title">Добавить запись</h4>
      </div>
      <div class="modal-body">
        <p><label>Наименование</label>
        <input maxlength="1000" id="rName" class="form-control" /></p>
        <p><label>Описание</label>
        <textarea maxlength="3000" id="rInfo" class="form-control" rows="10"></textarea></p>
        <div id="parentArea">
        <p><label>Родитель</label>
        <input id="rParent" type="hidden" style="width: 100%;height: 34px;" /></p>
        </div>
         <div style="text-align: right;">
            <button type="button" class="btn btn-default" data-dismiss="modal" >Отмена</button>
            <button id="saveBtn" onclick="createRefRow()" type="button" class="btn btn-primary" >Создать</button>
         </div>
      </div>
    </div>
  </div>
</div>             
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- <script src="js/jquery.dataTables.min.js"></script> -->

    <!-- Page-Level Plugin Scripts - Blank -->
    <script src="js/select2.js"></script>
	<script src="js/reference.js"></script>
    
    
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script> 
    <script src="js/plugins/dataTables/dataTables.tableTools.js"></script>
   <!-- <script src="js/plugins/dialog/bootstrap-dialog.min.js"></script> -->
	
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
