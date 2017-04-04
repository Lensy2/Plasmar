<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SCPlasmar | Software de Calidad</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/iCheck/flat/blue.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/iCheck/all.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/datatables/dataTables.bootstrap.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/morris/morris.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/select2/select2.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo $enlace;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 <link rel="stylesheet" href="<?php echo $enlace;?>/jquery-ui/jquery-ui.css">
 <!--- FileInput - Subir Imagenes--> 
    <link href="<?php echo $enlace;?>/plugins/fileInput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b>CP</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SC</b> - Plasmar</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">


              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Procesos
                  <i class="fa fa-cubes"></i>
                </a>
                <ul class="dropdown-menu">
                  <li>

                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/extruder/dashboard.php">
                          <div class="pull-left">
                            <img src="<?php echo $enlace;?>/dist/img/ext.gif" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Extruder
                          </h4>
                          <p>Proceso de Extrusión</p>
                        </a>
                      </li><!-- end message -->

                      <li>
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion/dashboard.php">
                          <div class="pull-left">
                            <img src="<?php echo $enlace;?>/dist/img/imp.gif" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Impresión
                          </h4>
                          <p>Proceso de Impresión</p>
                        </a>
                      </li>
                      <li>
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/laminacion/dashboard.php">
                          <div class="pull-left">
                            <img src="<?php echo $enlace;?>/dist/img/lam.gif" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Laminación
                          </h4>
                          <p>Proceso de Laminado</p>
                        </a>
                      </li>
                      <li>
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/refilado/dashboard.php">
                          <div class="pull-left">
                            <img src="<?php echo $enlace;?>/dist/img/ref.gif" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Refilado
                          </h4>
                          <p>Proceso de Refilado</p>
                        </a>
                      </li>
                      <li>
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/sellado/dashboard.php">
                          <div class="pull-left">
                            <img src="<?php echo $enlace;?>/dist/img/sellado.gif" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sellado
                          </h4>
                          <p>Proceso de Sellado</p>
                        </a>
                      </li>
                    </ul>


                  </li>                  
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
        <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-camera"></i> Foto Multa 
                </a>

                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <div class="slimScrollDiv" style="position: relative;overflow: hidden;width: auto;height: auto;">
                      <ul class="menu" style="overflow: hidden;width: 100%;height: auto;">
                      

                      <li><!-- start message -->
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/fotomulta/nueva_fotomulta.php">
                          <h3>
                            <i class="fa fa-fw fa-plus-circle"></i> Nueva - Foto Multa 
                          </h3>
                        </a>
                      </li><!-- end message -->
                      <li><!-- start message -->
                        <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/fotomulta/dashboard.php">
                          <h3>
                            <i class="fa fa-fw fa-list-alt"></i> Foto Multas
                          </h3>
                        </a>
                      </li><!-- end message -->

                      </ul>
                        <div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 46px; background: rgb(0, 0, 0);">
                          
                        </div>
                        <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);">
                          
                        </div>
                    </div>
                  </li>
                </ul>

              </li>

              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="ver-infor"><i class="fa fa-fw fa-bar-chart" ></i>Informes
                  <input type="hidden" class="val-infor" value="<?php  echo $_SERVER['SERVER_NAME'];?>" />
                </a>
              </li>

                <?php if (! empty($_SESSION["usuario"])) 
                  {    

                  ?>
                        <?php 
                  if(in_array('config', $_SESSION['paginas'])){
                ?>
              <li>
                <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/administracion/dashboard.php" class="dropdown-toggle" data-toggle="dropdown" id="ver-admin"><i class="fa fa-gears"></i> Administración                  
                </a>
                <input type="hidden" class="val-admin" value="<?php  echo $_SERVER['SERVER_NAME'];?>" />
              </li>
               <?php } ?>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                 <img src="<?php echo $enlace;?>/dist/img/user_img.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php 
                     echo $_SESSION["usuario"];
                     ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                     <img src="<?php echo $enlace;?>/dist/img/user_img.png" class="img-circle" alt="User Image">
                    <p>
                    <?php 
                     echo $_SESSION["nombreuser"];
                     ?>
                     <small>
                        <?php 
                     echo $_SESSION["usuario"];
                     ?>
                     </small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/autenticacion/cerrarsesion.php" class="btn btn-default btn-flat">Cerrar Sesión</a>

                    
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>



      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $enlace;?>/dist/img/user_img.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php 
                     echo $_SESSION["usuario"];
                     ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
          </div>
          <?php
                      }
                    ?>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU PRINCIPAL</li>
          
            <li <?php if ($archivo == 'dashboard') {echo "class='active'";}?> >
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/dashboard.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
          
            <li <?php if ($archivo == 'dispo_final') {echo "class='active'";}?>>
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/disposicion_final">
                <i class="ion ion-clipboard"></i> <span>Inc x Disposición final</span>
              </a>        
            </li> 
           
           
            <li <?php if ($archivo == 'procesos_sub') {echo "class='active'";}?>>              
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/procesos_subprocesos">
                <i class="ion ion-ios-gear-outline"></i> <span>Inc x Procesos y Sub Procesos</span>
              </a>
            </li>

            <li <?php if ($archivo == 'cliente') {echo "class='active'";}?>>              
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/cliente">
                <i class="ion ion-briefcase"></i> <span>Inc x Cliente - Top 10</span>
              </a>
            </li>

            <li <?php if ($archivo == 'operario') {echo "class='active'";}?>>              
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/operario">
                <i class="ion ion-man"></i> <span>Inc x Operarios - Top 10</span>
              </a>
            </li>

            <li <?php if ($archivo == 'incumplimiento') {echo "class='active'";}?>>              
              <a href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/informes/incumplimiento">
                <i class="ion ion-android-walk"></i> <span>Incumplimiento al S.G.I</span>
              </a>
            </li>       

            
           
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>