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
           Impresión
            <small>Control de Muestra - Impresor</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Impresión</a></li>
            <li><a href="#">C. Muestra Impresor</a></li>
            <li class="active">Nuevo</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">            
            <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Control de Muestra</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
          
            
            <form action="procesar_cmimpre.php" method="post" accept-charset="utf-8">
            
            


              <?php
              //conectamos la base de datos de premontaje y traemos los datos de los campos
              //Repeticion,Centros,Rodilloz y observaciones para editarlos

            $control= "SELECT * FROM premontajes where num_orden = '$pedido'";
               $X = sqlsrv_query($connSCPBD, $control);  

                $fila = sqlsrv_fetch_object($X);                      
              ?>


              
             


            <h3 align="center">Impresor</h3><br>
                 <!-- Descripcion General aseo maquina  -->
                  

                            <div class="table-responsive"> 
                                <table class="table table-bordered"> 
                                    <thead> 
                            <input type="hidden" name="num_orden" value='<?php echo $fila->num_orden; ?>'>
                            <tr>                                            
                            <th>LIMPIEZA MANGUERAS,CANOAS,BOMBAS<input  type="checkbox" class="chkplas"  class="minimal" value="chk_limpieza" name="chkImpresor[]" ></th>
                            
                              
                            </tr>
                         </thead> 
                 </table> 
            </div>         
            <br>

        <!-- Descripcion General aseo maquina  -->
                  <div class="table-responsive"> 
                      <table class="table table-bordered"> 
                         <thead>                            

                          <tr>                                            
                            <th>LISTA</th>
                            <th>IMPRESOR</th>
                          </tr>                            
                          <tr>
                            <th>IMPRESION</th>
                              <td><input  type="checkbox" class="chkplas"  class="minimal" value="chk_impresion" name="chkImpresor[]" ></td>
                          </tr>
                          <tr>
                            <th>REGISTRO</th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_registro" name="chkImpresor[]" ></td>                                      
                          </tr>
                          <tr>
                            <th>ALTURAS</th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_alturas" name="chkImpresor[]" ></td>
                            </tr>
                          <tr>
                            <th>SENTIDO DE EMBOBINADO</th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_santido" name="chkImpresor[]" ></td>
                            </tr> 
                          <tr>
                            <th>PIE IMPRENTA</th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_imprenta" name="chkImpresor[]" ></td>
                             
                          </tr>
                          <tr>
                            <th>ADHESION DE TINTA </th>
                              <td><input type="checkbox" class="chkplas" class="minimal" value="chk_adhesion" name="chkImpresor[]" ></td>  
                          </tr>
                            <tr>
                            <th>VISCOCIDAD DEL BARNIZ, SI ES REFERENCIA CALOR CONSTANTE (SEGUNDOS) o UHT</th>
                              <td><input type="text" class="form-control" name="visco_bar"></td>  
                          </tr>
                    </thead> 
                 </table> 
            </div>


            <div class="table-responsive"> 
                <table class="table table-bordered"> 
                <thead> 
                 <tr>
                <th>OBSERVACIONES</th>
              </tr>

                  <tbody> 
                    <tr>   
                      <td><div class="col-md-8"><textarea rows="4" cols="70" class="form-control" name="coment1"></textarea></td>
                    </tr>           
                   </tbody> 
              </thead> 
             </table> 
          </div>
              <br>                            
            <?php
            
           sqlsrv_close( $connPlas );
            ?>


      
            <style>
              @media  (min-width:  350px) {
             .btn {  
              margin-bottom: 12px;
             
            } 
             </style>     

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

