<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
  if (in_array('impresion', $_SESSION['paginas'])) {
//Fin primera parte validacion de Pagina y Usuario
 $archivo = 'nueva_inconf_ext';
  include '../../includes/funciones.php';
$enlace = rutaRecursos('segundo_nivel');
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
            <small>Inconformidades</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Impresión </a></li>
            <li class="active">Inconformidades</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          	<div class="box">
	            <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nueva - Inconformidad</h3>
        </div><!-- /.box-header -->
	            <div class="box-body">
	  				<form id="frmInc" action="procesar_inconformidad.php" method="post" accept-charset="utf-8">
        <div class="modal-body">        
          <h4 align="center"><b>Información del pedido</b></h4>

          <table class="table table-striped" >
                    <tbody>
                      <tr>
                        <th>Pedido #</th>
                        <th>NIT</th>
                        <th>Cliente</th>
                        <th>Descripción</th>
                        <th>Referencia</th>
                      </tr>
                      <tr>
                        <td>
                        	<?php echo "<span class='label label-primary' style='font-size:13px'>".$_POST['pedido']."</span>" ?>
                        	<input type="hidden" name="pedido" value="<?php echo $_POST['pedido'] ?>">  
                        </td>
                        <td>
                        	<span><?php echo $_POST['nit'] ?></span>
            					<input type="hidden" name="nit" value="<?php echo $_POST['nit'] ?>">
                        </td>
                        <td>
                        	<span><?php echo $_POST['cliente'] ?></span>
            					<input type="hidden" name="nom_cliente" value="<?php echo $_POST['cliente'] ?>">
                        </td> 
                        <td>
                        	<span><?php echo $_POST['descripcion'] ?></span>
            					<input type="hidden" name="descripcion" value="<?php echo $_POST['descripcion'] ?>">
                        </td> 
                        <td>
                        	<span><?php echo $_POST['referencia'] ?></span>
            					<input type="hidden" name="referencia" value="<?php echo $_POST['referencia']  ?>">
                        </td>   
                      </tr>
                      
                    </tbody>
                  </table>          

          <h4 align="center"><b>Completar campos</b></h4>
    
            <label>Tipo de Inconformidad</label>
              <select class="form-control" name="tipo_inconf">
                <option value="NO INOCUO">NO INOCUO</option>
                <option value="NO CONFORME">NO CONFORME</option>
                <option value="EN TRANSITO">EN TRANSITO</option>
              </select>

            <label>Rollo N°</label>
            <input type="number" step="any" class="form-control" name="num_rollo">
            <label>Maquina(#):</label>
            <input type="number" step="any" class="form-control" name="maquina">
            <label>Cantidad(Kg)</label>
            <input type="number" step="any" class="form-control" name="cantidad">
            <label>Detectada por</label>
            <input  type="text" class="form-control" name="detectada_por" value="<?php echo $_SESSION["nombreuser"]; ?>" readonly>
            <label>Cargo:</label>
            <input  type="text" class="form-control" name="cargo">
             <label>Operario responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre de Operario" name="op_res" required>
            <label>Causa:</label>
            <textarea id="causas-general" class="form-control" style="max-width: 100%;" name="causa"></textarea>       
           
            <label>Descripción:</label>
            <textarea class="form-control" style="max-width: 100%;" name="descripcion_inc"></textarea>

            <label>Disposición final</label>
              <select class="form-control" name="dispo_final">
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
          <a href="inconformidades.php"><button type="button" id="btn-cerrar" class="btn btn-default" >Cancelar</button></a>
          <input  type="submit" class="btn btn-primary" id="inc-guar" name="inc-guardar" value="Guardar">   
        </div>

        </form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php include '../../includes/impresion/footer.php'; 
//Incio segunda parte validacion de Pagina y Usuario
  }else{
    include '../autenticacion/restrin.php';
  }
}else{

  include '../autenticacion/no_acceso.php';
}
//Fin segunda parte validacion de Pagina y Usuario
?>