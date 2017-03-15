<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('extruder', $_SESSION['paginas'])) {
    
//Fin primera parte validacion de Pagina y Usuario
$archivo = 'nueva_inconf_ext';
 include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');

if (isset($_GET['id']))
{
    $Idinconf = $_GET['id'];
}
  
  include '../../includes/dbconfig.php';
  include '../../includes/extruder/header.php'; 
  include '../../model/extruder.php';

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
      <h1>Extruder            
        <small>Inconformidades</small>
      </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Extrusion</a></li>
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
                        <th >Pedido</th>
                        <th >Tipo Extrusion</th>
                        <th >Mezcla #</th>
                        <th >Rollo #</th>
                        <th>NIT</th>
                        <th>Cliente</th>
                        <th>Referencia</th>
                      </tr>
                      <tr>
                        <td><?php echo "<span class='label label-primary' style='font-size:13px'>".$fila->num_orden."</span>" ?></td>
                        <td><?php echo $fila->tipo_ext ?></td>
                        <td><?php echo $fila->num_mezcla ?></td> 
                        <td><?php echo $fila->num_rollo ?></td> 
                        <td><?php echo $fila->nit_cliente ?></td>  
                        <td><?php echo $fila->cliente ?></td>  
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
                        <th>Descripcion</th>
                      </tr>
                      <tr>
                        <td><?php echo "<span class='label label-primary' style='font-size:13px'>".$fila->tipo_inconf."</span>" ?></td>
                        <td><?php echo $fila->maquina ?></td>
                        <td><?php echo $fila->cantidad ?></td>
                        <td><?php echo $fila->detectada_por ?></td> 
                        <td><?php echo $fila->cargo ?></td> 
                        <td><?php echo $fila->causa ?></td>  
                        <td><?php echo $fila->operario_res ?></td>  
                        <td><?php echo $fila->descripcion ?></td>   
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
                echo "<a href='ftp://192.168.2.8/NAS_Public/SCPBD/extruder_img/$separarFotos[$i].jpg' target='blank'><img width='200px' src='ftp://192.168.2.8/NAS_Public/SCPBD/extruder_img/$separarFotos[$i].jpg' /></a>" ;
                echo "<br>";
              }      
           
           ?>
      </div><!-- /.box-body -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->


<?php
sqlsrv_close( $connPlas );
include '../../includes/extruder/footer.php';
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../../autenticacion/restrin.php';
  }
}else{

  include '../../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario;
?>