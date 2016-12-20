<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
      if (in_array('config', $_SESSION['paginas'])) {

//Fin primera parte validacion de Pagina y Usuario
 $archivo = 'usuarios';
  include '../includes/funciones.php';
$enlace = rutaRecursos('primer_nivel');
  include '../includes/dbconfig.php';
  include '../includes/administracion/header.php';
  include '../model/administracion.php';
?>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Administración 
            <small>Usuarios</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>Administración </a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header">
                   <h3 class="box-title">
                    <a href="nuevo_usuario.php"><button class="btn btn-block btn-success"><i class="fa fa-user-plus"></i> Nuevo - Usuario</button></a>
                  </h3>

          </div><!-- /.box-header -->
            <div class="box-body">
            
            <?php
              $registros = sqlsrv_query($connSCPBD, $listaUsuarios);
            ?>

            <table id="c_requisitos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha de registro</th>
            <th>Usuario</th>        
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
      <?php
while($fila = sqlsrv_fetch_object($registros))
{
  echo "<tr>";
    echo "<td>".date_format($fila->fecha_reg, 'd/m/Y g:i:s A')."</td>";
    echo "<td>".$fila->usuario."</td>";
    echo "<td>".$fila->nombre."</td>";
    echo "<td>".$fila->apellido."</td>";
    echo "<td>".$fila->cedula. "</td>";
    echo "<td><i class='fa fa-edit'></i><a href='editar_usario.php?id=$fila->Idusuario'> Editar</a><i class='fa fa-trash-o'></i><a href='eliminar_usuario.php?id=$fila->Idusuario'> Eliminar</a></td>";
  echo "</tr>";
}
sqlsrv_close($connSCPBD);
?>

    </tbody>
</table>
</div><!-- /.box-body -->
</div><!-- /.box -->
</section><!-- /.content -->
</div><!-- /.content-wrapper -->

  <!-- ========== ventanas modales en controles de requisitos ========== -->


  <div class="modal fade" id="modalNuevaInc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;"><i class="fa fa-fw fa-plus-circle"></i>Nueva Inconformidad</h4>
      </div>
      <div class="modal-body">      
          
          <div class="row">
            <div class='col-md-6'>  
                  <b>Información:</b> por favor ingresar el numero de la orden / pedido  para realizar la consulta. 
              </div>
            <div class='col-md-4'>
              <input type="text" placeholder="Ingresar Valor" class="form-control" id="recipient-name">
              
            </div>
            <div class='col-md-2'>
              <button type="button" class="btn btn-primary" id="valida-orden">Buscar</button>
            </div>
          </div>
         <div class="row">
          <div id="content-validacions"></div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /========== ventanas modales en controles de requisitos ========== -->

<?php include '../includes/administracion/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  } 
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>