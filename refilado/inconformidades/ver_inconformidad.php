<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('refilado', $_SESSION['paginas'])) {
    
//Fin primera parte validacion de Pagina y Usuario
$archivo = 'nueva_inconf_ext';
 include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');

if (isset($_GET['id']))
{
    $Idinconf = $_GET['id'];
}
  
  include '../../includes/dbconfig.php';
  include '../../includes/refilado/header.php'; 
  include '../../model/refilado.php';

  $regsInconf = sqlsrv_query($connSCPBD, $det_inconf);
  $fila = sqlsrv_fetch_object($regsInconf);

$fotos = $fila->evidencia;

$separarFotos = explode(",", $fotos);
//numero de elementos
$numElementos = count($separarFotos);
$numElementosReal = $numElementos - 1;

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Refilado            
        <small>Inconformidades</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Refilado</a></li>
            <li><a href="#">Inconformidades</a></li>
            <li class="active">Detalle</li>
          </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Default box -->
      <div class="box">            
        <div class="box-header with-border">
        </div><!-- /.box-header -->
        <div class="box-body">

             <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th>Pedido #</th>
                        <th>Rollo</th>
                        <th>NIT</th>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Referencia</th>
                      </tr>
                      <tr>
                        <td><?php echo "<span class='label label-primary' style='font-size:13px'>".$fila->num_orden."</span>" ?></td>
                        <td><?php echo $fila->num_rollo ?></td> 
                        <td><?php echo $fila->nit_cliente ?></td>  
                        <td><?php echo $fila->cliente ?></td>  
                        <td><?php echo $fila->descripcion ?></td>  
                        <td><?php echo $fila->referencia ?></td>   
                      </tr>
                      
                    </tbody>
                  </table>

                   <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th >Tipo Inconformidad</th>
                        <th>Maquina</th>
                        <th >Cantidad KG</th>
                        <th >Detectada por</th>
                        <th >Cargo</th>
                        <th>Causa</th>
                        <th>Operario responsable</th>
                        <th>Descripcion Inconformidad</th>
                      </tr>
                      <tr>
                        <?php if ($fila->tipo_inconf == 'NO CONFORME'){echo "<td><span class='label label-danger'>NO CONFORME</span></td>";}elseif($fila->tipo_inconf == 'EN TRANSITO'){echo "<td><span class='label label-warning'>EN TRANSITO</span></td>";}elseif ($fila->tipo_inconf == 'NO INOCUO') {echo "<td><span class='label label-danger'>NO INOCUO</span></td>";} ?>
                        <td><?php echo $fila->maquina ?></td>
                        <td><?php echo $fila->cantidad ?></td>
                        <td><?php echo $fila->detectada_por ?></td> 
                        <td><?php echo $fila->cargo ?></td> 
                        <td><?php echo $fila->causa ?></td>  
                        <td><?php echo $fila->operario_res ?></td>  
                        <td><?php echo $fila->descripcion_inc ?></td>   
                      </tr>
                      
                    </tbody>
                  </table>
                  <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th >Disposición final</th>
                      </tr>
                      <tr>
                         
                        <td><?php echo $fila->dispo_final ?></td>   
                      </tr>
                      
                    </tbody>
                  </table>
                  <?php            
               for($i=0; $i<$numElementosReal; $i++){
                //saco el valor de cada elemento
                echo "<a href='ftp://192.168.2.8/NAS_Public/SCPBD/refilado_img/$separarFotos[$i].jpg' target='blank'><img width='200px' src='ftp://192.168.2.8/NAS_Public/SCPBD/refilado_img/$separarFotos[$i].jpg' /></a>" ;
                echo "<br>";
              }      
           
           ?>
      </div><!-- /.box-body -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


<?php
sqlsrv_close( $connPlas );
include '../../includes/refilado/footer.php';
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario;
?>