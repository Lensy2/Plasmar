<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  //Fin primera parte validacion de Pagina y Usuario
  $archivo = 'nueva_inconf_ext';
  include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');
  include '../includes/dbconfig.php';
  include '../includes/fotomulta/header.php';
  include '../model/fotomulta.php';
?>

    <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Plasmar 
            <small>Foto Multas</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Plasmar </a></li>
            <li class="active">Foto Multas</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          	<div class="box">
	            <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nueva - Foto Multa</h3>
        </div><!-- /.box-header -->
	            <div class="box-body">
	  				<form id="frmInc" action="procesar_fotomulta.php" method="post" accept-charset="utf-8">
        <div class="modal-body">        
          <h4 align="center"><b>Formulario - Foto Multa</b></h4>
            <label>Fecha de foto multa</label>
            <div class="input-group date">
                <input type="text" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="fecha_fotomulta" name="fecha_fotomulta">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
                       
            <label>Tipo de Inconformidad</label>
            <select class="auto_tipo form-control" id="tipo_inconf" name="tipo_inconf" required></select>

            <label>Tipo de Proceso o área</label>
            <select class="auto_procesos form-control" id="tipo_proceso" name="tipo_proceso" required></select>

             <label>Causa:</label>
            <select class="auto_causas form-control" name="causa"></select> 

            <label>Pedido #</label>
            <input type="number" step="any" class="form-control" name="pedido" id="pedido">
            <label>Cliente</label>
            <input id="comp-cliente" type="text" class="form-control" name="nom_cliente">
            <label>Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion">
            <label>Referencia</label>
            <input type="number" step="any" class="form-control" name="referencia" id="referencia">
            <label>Rollo N°</label>
            <input type="number" step="any" class="form-control" name="num_rollo" id="num_rollo">
            <label>Maquina(#):</label>
            <input type="number" step="any" class="form-control" name="maquina">
            <label>Cantidad(Kg)</label>
            <input type="number" step="any" class="form-control" name="cantidad" id="cantidad">
            <label>Detectada por</label>
            <input  type="text" class="form-control" name="detectada_por" value="<?php echo $_SESSION["nombreuser"]; ?>" readonly>
             <label>Empleado responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre empleado" name="op_res" required>
            <label>Area</label>
            <input class="form-control" id="area" name="area">
            <!--<label>Causa:</label>
            <textarea id="causas-general" class="form-control" style="max-width: 100%;" name="causa"></textarea>-->
                             
           
            <label>Descripción:</label>
            <textarea class="form-control" style="max-width: 100%;" name="descripcion_inc"></textarea>
            <label>Disposición final</label>
              <select class="form-control" name="dispo_final" id="dispo_final">
                <option value="DESECHAR">DESECHAR</option>
                <option value="CONCESION">CONCESION</option>
                <option value="REPROCESO">RE-PROCESO</option>
              </select>
            <h4 align="center"><b>Adjuntar evidencia</b></h4>
            <!--<input type="file" name="files[]" accept="image/*"  multiple/> -->
            <input id="archivos" name="imagenes[]" type="file" accept="image/*" multiple=true >
            <input id="cadenalista" type="hidden" name="evidencia">         
            <input id="id" type="hidden">
            <div class="msgdiv" id="chatbox"></div>
              
            </div>
        

        <div class="modal-footer">
          <a href="foto_multas.php"><button type="button" id="btn-cerrar" class="btn btn-default" >Cancelar</button></a>
          <input  type="submit" class="btn btn-primary" id="inc-guar" name="inc-guardar" value="Guardar">   
        </div>

        </form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
</div><!-- /.content-wrapper -->


    <?php include '../includes/fotomulta/footer.php';

}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>
