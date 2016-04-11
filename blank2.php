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
<link href="css/plugins/docs/docs.min.css" rel="stylesheet" type="text/css" />

    

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
            <!-- /.db connection -->            
<?php include 'db.php' ?>
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
                
  <button  class="btn btn-primary" data-toggle="modal" >Кнопка</button>

<!-- Split button -->
<div class="btn-group">
  <button type="button" class="btn btn-primary">Еще кнопка</button>
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#" >Опять кнопка</a></li>
    <li><a href="#" >И снова кнопка</a></li>
  </ul>
</div>                    
                </div>                
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <!-- /.col-lg-4 -->
                <div class="row">
                <div class="col-lg-4">
				<!--tree -->
<div class="tree well" id="treeRefs" data-placement="top" data-trigger="manual" onclick="$('#'+this.id).popover('hide');"></div>

</div>
                <div class="col-lg-8">

<!--panel-->
 <div class="panel panel-default">
                        <div class="panel-heading" id="tHeadd" tag="-1">
                            Справочник не выбран
                        </div>
                        <!-- /.panel-heading -->
 <div class="panel-body">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="refTable"> 
                    
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>#</th>
                                            <th>Наименование</th>
                                            <th>Описание</th>                                            
                                            <th>Родитель</th>
                                        </tr>
                                    </thead>
                                    <tbody id="refTableBody" data-placement="top" data-trigger="manual" >
                                  
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
    <script src="js/plugins/dialog/bootstrap-dialog.min.js"></script>
	
    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>
    

    <!-- Page-Level Demo Scripts - Blank - Use for reference -->

</body>

</html>
