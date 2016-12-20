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

                       
            <label>Tipo de Inconformidad</label>
              <select class="form-control" name="tipo_inconf">
                <option value="NO INOCUO">NO INOCUO</option>
                <option value="NO CONFORME">NO CONFORME</option>
                <option value="EN TRANSITO">EN TRANSITO</option>
              </select>
            <label>Tipo de Proceso</label>

              <select class="form-control" name="tipo_proceso">
                <option value=""></option>
                 <option value="EXTRUSION">EXTRUSION</option>
                <option value="IMPRESION">IMPRESION</option>
                <option value="LAMINACION">LAMINACION</option>
                <option value="REFILADO">REFILADO</option>
                <option value="SELLADO">SELLADO</option>

                <option value="CALIDAD">CALIDAD</option>
                <option value="DESARROLLO">DESARROLLO</option>
                <option value="ELABORACION ORDEN">ELABORACION ORDEN</option>
                <option value="ENFUELLADO">ENFUELLADO</option>
                <option value="FOTOPOLIMERO">FOTOPOLIMERO</option>
                <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                <option value="MAQUINA">MAQUINA</option>
                <option value="PREMONTAJE">PREMONTAJE</option>
                <option value="PROCESO">PROCESO</option>
                <option value="PRODUCCION ">PRODUCCION </option>
                <option value="PROVEEDOR">PROVEEDOR</option>
              </select>

            <label>Pedido #</label>
            <input type="number" step="any" class="form-control" name="pedido">
            <label>Cliente</label>
            <input id="comp-cliente" type="text" class="form-control" name="nom_cliente">
            <label>Descripción</label>
            <input type="text" class="form-control" name="descripcion" >
            <label>Referencia</label>
            <input type="number" step="any" class="form-control" name="referencia" >
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
             <label>Empleado responsable:</label>
                    <i id="limpiar" style="cursor: pointer;" class="fa fa-times"></i>
                     <br>
                     <input id="operarios" type="text" class="form-control" placeholder="Nombre empleado" name="op_res" required>
            <!--<label>Causa:</label>
            <textarea id="causas-general" class="form-control" style="max-width: 100%;" name="causa"></textarea>-->
                        <label>Causa:</label>
            <select class="form-control" name="causa">
              <option value="No definida">No definida.</option>
              <option value="Agacharse sin flexionar las rodillas o nos usar ayudas mécanica disponibles.">Agacharse sin flexionar las rodillas o nos usar ayudas mécanica disponibles.</option>
              <option value="Arrumar cargas que queden inestables.">Arrumar cargas que queden inestables.</option>
              <option value="Atravesarse a la montacargas cuando esta está en movimiento.">Atravesarse a la montacargas cuando esta está en movimiento.</option>
              <option value="Calzado inadecuado.">Calzado inadecuado.</option>
              <option value="Consumo alimentos en lugares prohibidos.">Consumo alimentos en lugares prohibidos.</option>
              <option value="Estado de salud no apto para la actividad.">Estado de salud no apto para la actividad.</option>
              <option value="Exceso de retal">Exceso de retal </option>
              <option value="Fallas en orden y aseo.">Fallas en orden  y aseo. </option>
              <option value="Guantes sucios.">Guantes sucios.</option>
              <option value="Juegos bruscos con los compañeros.">Juegos bruscos con los compañeros.</option>
              <option value="Mal cubrimiento cabello.">Mal cubrimiento cabello.</option>
              <option value="Mal uso de energía.">Mal uso de energía.</option>
              <option value="Mal uso del agua.">Mal uso del agua.</option>
              <option value="Mal uso del aire acondicionado.">Mal uso del aire acondicionado.</option>
              <option value="Mal uso del gas.">Mal uso del gas.</option>
              <option value="Mala disposición o separación de residuos.">Mala disposición o separación de residuos.</option>
              <option value="Mala identificación de recipientes.">Mala identificación de recipientes.</option>
              <option value="Manipular celular en la planta.">Manipular celular en la planta.</option>
              <option value="Manipular herramienta eléctrica sin autorización (Esmeril, taladros, pulidoras etc.)">Manipular herramienta eléctrica sin autorización (Esmeril, taladros, pulidoras etc.)</option>
              <option value="Manos sucias.">Manos sucias.</option>
              <option value="No afeitados.">No afeitados.</option>
              <option value="No hacer uso de las ayudas mecánica y de los compañeros al manipular cargas">No hacer uso de las ayudas mecánica y de los compañeros al manipular cargas</option>
              <option value="No uso cebra peatonal cuando se va sin cargas.">No uso cebra peatonal cuando se va sin cargas.</option>
              <option value="Obstruir cajas y tableros eléctricos">Obstruir cajas y tableros eléctricos</option>
              <option value="Obstruir extintores, pulsadores y salidas de emergencia.">Obstruir extintores, pulsadores y salidas de emergencia.</option>
              <option value="Obstruir extractores.">Obstruir extractores.</option>
              <option value="Obstruir pasillos y vías de circulación.">Obstruir pasillos y vías de circulación.</option>
              <option value="Otros">Otros</option>
              <option value="Pasarse debajo de la uñas de la montacargas cuando esté elevando cargas.">Pasarse debajo de la uñas de la montacargas cuando esté elevando cargas.</option>
              <option value="Poner a cargar celulares en la planta.">Poner a cargar celulares en la planta.</option>
              <option value="Presencia en puntos de operación y/o máquinas sin el uniforme adecuado.">Presencia en puntos de operación y/o máquinas sin el uniforme adecuado.</option>
              <option value="Presentación personal inadecuada.">Presentación personal inadecuada.</option>
              <option value="Realizar trabajos en alturas (1.5 mts) sin la debida protección, sin certificación y sin el respectivo permiso.">Realizar trabajos en alturas (1.5 mts)  sin la debida protección, sin certificación y sin el respectivo permiso.</option>
              <option value="Realizar trabajos en caliente sin el respectivo permiso.">Realizar trabajos en caliente sin el respectivo permiso.</option>
              <option value="Recipientes con quimicos sin tapar.">Recipientes con quimicos sin tapar.</option>
              <option value="Recipientes con sustancias químicas sin rotular.">Recipientes con sustancias químicas sin rotular.</option>
              <option value="Remover las guardas de seguridad de la máquinas sin necesidad.">Remover las guardas de seguridad de la máquinas sin necesidad.</option>
              <option value="Sifones sin rejilla">Sifones sin rejilla</option>
              <option value="Sin bota de seguridad.">Sin bota de seguridad.</option>
              <option value="Sin gafas de seguridad al estar expuesto a químico o material particulado.">Sin gafas de seguridad al estar expuesto a químico o material particulado.</option>
              <option value="Sin protección auditiva.">Sin protección auditiva.</option>
              <option value="Sin respirador para químicos en canoas">Sin respirador para químicos en canoas</option>
              <option value="Uñas maquilladas y/o largas.">Uñas maquilladas y/o largas.</option>
              <option value="Usar zapato destapado para circular en la planta.">Usar zapato destapado para circular en la planta.</option>
              <option value="Uso de audifonos.">Uso de audifonos.</option>
              <option value="Uso de joyas en lugares prohibidos.">Uso de joyas en lugares prohibidos.</option>
              <option value="Uso del uniforme fuera de las instalaciones.">Uso del uniforme fuera de las instalaciones.</option>
              <option value="Uso inadecuado del uniforme.">Uso inadecuado del uniforme.</option>
            </select>       
           
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