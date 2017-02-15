<?php
  //Incio primera parte validacion de Pagina y Usuario
  session_start();
  if (isset($_SESSION['usuario'])) {
  //Fin primera parte validacion de Pagina y Usuario
  
  $archivo = 'cliente';
  include '../../includes/dbconfig.php';
  include '../../model/laminacion.php';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  include '../../includes/informes/header.php';
  
  ?>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Informes
      <small>Dashboard</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Informes</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <div class="jumbotron">
          <h2 align="center"></h2>
          <h3 align="center">Informes de Incumplimiento al S.G.I</h3>
          <div id="tabs">
            <ul>
              <li><a href="#tabs-1">Por Proceso/Area - Top 10</a></li>
              <li><a href="#tabs-2">Por Persona - Top 10</a></li>
              <li><a href="#tabs-3">Afecta al Sistema</a></li>
            </ul>
            <!-- Reporte de pruductos -->
            <div id="tabs-1">
              <div class="row">
                <div class="col-md-12">
                	<button type="button" class="btn btn-primary" id="btnGridPorProceso"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Generar</button>
                  <div id="gridPorProceso"></div> 
                </div>
                
              </div>
            </div>

            <div id="tabs-2">
              <div class="row">
                <div class="col-md-12">
                 <button type="button" class="btn btn-primary" id="btnGridPorPersona"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Generar</button>
                  <div id="gridPorPersona"></div> 
              	</div>
              </div>               
            </div>

            <div id="tabs-3">
              <div class="row">
                <div class="col-md-12">
                   <button type="button" class="btn btn-primary" id="btnGridPorAfecta"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Generar</button>
                  <div id="gridPorAfecta"></div> 
              	</div>
              </div>               
            </div>

          </div>
        </div>
        <!-- /.row -->          
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- =============================================== -->
<?php include '../../includes/informes/footer.php'; ?>
<script src="../../AdminLTE/dist/js/informes/incumplimiento.js"></script>
<?php
//Incio segunda parte validacion de Pagina y Usuario
  }else{
  
    include '../../autenticacion/no_acceso.php';
  }
  //Fin segunda parte validacion de Pagina y Usuario
  ?>