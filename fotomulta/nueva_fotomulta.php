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
<style type="text/css" media="screen">
  .error{
     border: 1px solid rgba(215, 0, 0, 0.75);
     box-shadow:inset 0px 0px 2px 0px rgba(255, 0, 0, 0.75); 
  } 
  </style>
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
	  				<!--<form id="frmInc" action="procesar_fotomulta.php" method="post" accept-charset="utf-8">-->
        <div class="modal-body">        
          <!-- ID usuario -->
          <input type="hidden" id="id_usuario" value="<?php echo $_SESSION['idusuario'] ?>">          
            <label>Fecha de foto multa</label>
            <div class="input-group date">
                <input type="text" data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="fecha_fotomulta" name="fecha_fotomulta">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
                       
            <label>Tipo de Inconformidad</label>
            <!--<select class="auto_tipo form-control" id="tipo_inconf" name="tipo_inconf" required>-->
            <select class="form-control" id="tipo_inconf" name="tipo_inconf" required>
              <option value="EN TRANSITO">EN TRANSITO</option>
              <option value="NO CONFORME">NO CONFORME</option>
              <option value="INCUMPLIMIENTO AL S.G.I">INCUMPLIMIENTO AL S.G.I</option>
            </select>

            <label>Tipo de Proceso o área</label>
            <select class="auto_procesos form-control" id="tipo_proceso" name="tipo_proceso" required></select>

            <label>Causa:</label>
            <select class="auto_causas form-control" name="causa" id="causa" required></select> 

            <label id="lbl_pedido">Pedido #</label>
            <input type="number" step="any" class="form-control" name="pedido" id="pedido" required>

            <label id="lbl_cliente">Cliente</label>
            <input id="comp-cliente" type="text" class="form-control" name="nom_cliente" required>

            <label id="lbl_descripcion">Descripción</label>
            <input type="text" class="form-control" name="descripcion" id="descripcion" required>

            <label id="lbl_referencia">Referencia</label>
            <input type="number" step="any" class="form-control" name="referencia" id="referencia" required>

            <label id="lbl_num_rollo">Rollo N°</label>
            <input type="number" step="any" class="form-control" name="num_rollo" id="num_rollo" required>

            <label id="lbl_maquina">Maquina(#):</label>
            <input type="number" step="any" class="form-control" name="maquina" id="maquina" required>

            <label id="lbl_cantidad">Cantidad(Kg)</label>
            <input type="number" step="any" class="form-control" name="cantidad" id="cantidad" required>

            <label id="lbl_detectada_por">Detectada por</label>
            <input  type="text" class="form-control" name="detectada_por" value="<?php echo $_SESSION["nombreuser"]; ?>" id="detectada_por" readonly>

             <label id="lbl_operarios">Empleado responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre empleado" name="op_res" required>

            <label id="lbl_area">Area</label>
            <input class="form-control" id="area" name="area" required>
            <!--<label>Causa:</label>
            <textarea id="causas-general" class="form-control" style="max-width: 100%;" name="causa"></textarea>-->
                             
           
            <label id="lbl_descripcion_inc">Descripción:</label>
            <textarea class="form-control" style="max-width: 100%;" name="descripcion_inc" id="descripcion_inc" required></textarea>

            <label id="lbl_dispo_final">Disposición final</label>
              <select class="form-control" name="dispo_final" id="dispo_final" required>
                <option value="DESECHAR">DESECHAR</option>
                <option value="CONCESION">CONCESION</option>
                <option value="REPROCESO">RE-PROCESO</option>
              </select>
              <br>

            <!-- Sistema afectado-->
            <div class="row">
              <div class="col-xs-6 col-md-3">
                <div class="panel panel-primary">
                  <div class="panel-body">
                     <label><input type="checkbox" name="chkSistema[]" value="Calidad"> Calidad</label><br>
                     <label><input type="checkbox" name="chkSistema[]" value="Ambiental"> Ambiental</label><br>
                     <label><input type="checkbox" name="chkSistema[]" value="Inocuidad"> Inocuidad</label><br>
                     <label><input type="checkbox" name="chkSistema[]" value="SST"> SST</label><br>
                     <label><input type="checkbox" name="chkSistema[]" value="Otro"> Otro</label>
                  </div>
                  <div class="panel-footer"><label>Sistema Afectado</label></div>
                </div>
              </div>
            </div>

            <h4 align="center" id="lbl_adjuntar"><b>Adjuntar evidencia</b></h4>
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

        <!--</form>-->
         
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
