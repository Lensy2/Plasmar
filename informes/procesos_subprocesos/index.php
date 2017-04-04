<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'procesos_sub';
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
          <div class="box-header with-border"> 
               
          <div class="col-md-10" align="center">
              <div class="col-md-3">             
                 <label>Fecha Inicial</label>
                  <input  type="date" class="txtInicial form-control" name="inicial">
              </div>
              <div class="col-md-3">
                <label>Fecha Final</label>
                <input type="date" class="txtFinal form-control" name="final">               
              </div>
              <div class="col-md-3"> 
              <label>Acción</label>     
                <button class="btn btn-block btn-default" id="gen2">Generar</button>
              </div>       
          </div>
        </div><!-- /.box-header -->
          
                <div class="box-body">
         <div class="row" align="center">          
               <h4 class="box-title"><i class="fa fa-area-chart" align="center"></i><b>Inconformidades por Procesos y Sub Procesos</b></h4> 
                 <div class="col-md-6" id="grafico" style="display:none">
                  <canvas id='myChart' width='500' height='500'></canvas>
                  <a href="info_detallado.php"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Informe detallado</button></a>
                </div>
          </div>         
          </div>
</div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->

<?php include '../../includes/informes/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario

}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>