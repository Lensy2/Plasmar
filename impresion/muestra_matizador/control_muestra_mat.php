<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario

 $archivo = 'nuevo_control_mez';

  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');

  if (isset($_GET['pedido'])){
    $pedido = $_GET['pedido'];
  }
  include '../../includes/dbconfig.php';
  include '../../includes/impresion/header.php';
  include '../../model/impresion.php';
?>

  <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Control De Muestra
            <small>Matizador</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Matizador</a></li>
            <li><a href="#">Control De Muestra</a></li>
            <li class="active">Matizador</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Control De Muestra - Tintas</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
          
            
            <form action="procesar_cmmatiz.php" method="post" accept-charset="utf-8">
            

            <h3 align="center">Matizador</h3><br>
                   
                            <input type="hidden" name="num_orden" value='<?php echo $pedido; ?>'>


        <!-- Descripcion General aseo maquina  -->

                   <div class="table-responsive"> 
                      <table class="table table-bordered"> 
                         <thead>                            

                          <tr>                                            
                            <th>LISTA</th>
                            <th>MATIZADOR</th>
                          </tr>                            
                          <!--<tr>
                            <th>TIPO DE TINTA</th>
                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_tinta" name="chkMatizador[]" ></td>
                          </tr>-->
                          <tr>
                            <th>TONOS</th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_tonos" name="chkMatizador[]" ></td>                                      
                          </tr>
                      </thead> 
                 </table> 
            </div>


            <div class="table-responsive"> 
                <table class="table table-bordered"> 
                <thead> 
                 <tr>
                <th>LOTE Y TIPO DE TINTAS </th>
              </tr>

                  <tbody> 
                    <tr>   
                      <td><div class="col-md-8"><textarea rows="4" cols="70" class="form-control" name="coment2" required></textarea></td>
                    </tr>           
                   </tbody> 
              </thead> 
             </table> 
          </div>
              <br>
                       
            <?php
            
           sqlsrv_close( $connPlas );
            ?>

   

               <div class="row">
               <div class="col-xs-4">
                    <b>Usuario responsable</b>
                      <br><br>
                      <input type="text" class="form-control"  value="<?php echo $_SESSION["nombreuser"]; ?>" disabled> 
               </div>
               <div class="col-xs-9">
                 <br>
                  <div class="col-md-2">
                        <input type="submit" class="btn btn-block btn-primary" name="aprob" value="Aprobar">
                  </div>                      
                  <div class="col-md-2">
                        <a class="btn btn-block btn-primary" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/apps/impresion//control_requisitos/apro_controles_requisitos_imp.php" style="text-decoration: none;">Cancelar</a>
                  </div>
               </div>
            </div>
            </form>


            </div><!-- /.box-body -->
          </div><!-- /.box -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

<!-- =============================================== -->


<?php include '../../includes/impresion/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>

