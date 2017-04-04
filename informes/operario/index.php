<?php
  //Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
//Fin primera parte validacion de Pagina y Usuario

  $archivo = 'operario';
  include '../../includes/dbconfig.php';
  include '../../model/laminacion.php';
  include '../../includes/funciones.php';
  $enlace = rutaRecursos('segundo_nivel');
  include '../../includes/informes/header.php';
  
?>
<?php
    $labels = array();
    $nombres = array();
    $datos = array();  

    $query = "SELECT top 10 operario_res, count(*) as Total from imp_inconformidades group by operario_res having COUNT(*) > 1
    union all select top 10 operario_res, count(*) as Total from ext_inconformidades group by operario_res having COUNT(*) > 1
    union all select top 10 operario_res, count(*) as Total from lam_inconformidades group by operario_res having COUNT(*) > 1
    union all select top 10 operario_res, count(*) as Total from ref_inconformidades group by operario_res having COUNT(*) > 1
    union all select top 10 operario_res, count(*) as Total from sell_inconformidades group by operario_res having COUNT(*) > 1 union all select top 10 operario_res, count(*) as Total from foto_multas group by operario_res having COUNT(*) > 1 order by operario_res asc";

    $resultado = sqlsrv_query($connSCPBD, $query);

    while ($row = sqlsrv_fetch_array($resultado)) 
    {
       $labels[] = $row;
    } 

    function getDateWiseScore($data) {
        $groups = array();
        $key = 0;
        foreach ($data as $item) {
            $key = $item['operario_res'];
            if (!array_key_exists($key, $groups)) {
                $groups[$key] = array(                   
                    'operario_res' => $item['operario_res'],
                    'Total' => $item['Total'],
                );
            } else {
                $groups[$key]['Total'] = $groups[$key]['Total'] + $item['Total'];
            }
            $key++;
        }
        return $groups;
    }

    $ver = getDateWiseScore($labels);

    foreach ($ver as $key) {
        $nombres[] = $key['operario_res'];
        $datos[] = $key['Total'];
    }

    $jsonNombres = json_encode($nombres);
    $jsonDatos = json_encode($datos);

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
          <div class="box-header">
                  <h3 class="box-title">Top 10 Inconformidades por Operario</h3>
          </div><!-- /.box-header -->
                <div class="box-body">
          <div class="row">
              <div class="col-md-6" id="grafico">
                <canvas id='myChart3' width='400' height='400'></canvas>
                  <a href="info_detallado.php"><button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Informe detallado</button></a>
              </div>
          </div><!-- /.row -->          
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
