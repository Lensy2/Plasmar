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
            Adminsitración 
            <small>Usuarios</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Adminsitración </a></li>
            <li class="active">Usuarios</li>
            <li class="active">Nuevo</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          	<div class="box">
	            <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-fw fa-plus-circle"></i>Nuevo - Usuario</h3>
        </div><!-- /.box-header -->
	            <div class="box-body">
	  				<form id="frmInc" action="procesar_usuario.php" method="post" accept-charset="utf-8">
        <div class="modal-body">        
          <h4 align="center"><b>Formulario de registro</b></h4>
             
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" placeholder="Ingrese nombre completo" required>
            <label>Apellido</label>
            <input type="text" class="form-control" name="apellido" placeholder="Ingrese apellido completo">
            <label>Cédula</label>
            <input type="number" step="any"  class="form-control" name="cedula" placeholder="Ingrese numero de cédula" required>
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Ingrese nombre de usuario" required>
            <label>Nueva Contraseña</label>
            <input type="password" step="any" class="form-control" name="contrasena">
            <label>Repetir contraseña</label>
            <input type="password" step="any" class="form-control">

            <h4 align="center"><b>Configuración de Permisos</b></h4>
           <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Procesos</th>
                    <th>Módulos</th>
                </tr>
            </thead>
              <tbody>
                  <tr>
                    <td><input type="checkbox" class="chkplas" value="extruder" name="ver_paginas[]"> Extruder</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="ex_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="ex_pg" name="ver_menus[]">Programación
                      <input type="checkbox" class="chkplas" value="ex_cm" name="ver_menus[]">C. de Mezclas
                      <input type="checkbox" class="chkplas" value="ex_cr" name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="ex_cc" name="ver_menus[]">C. de Calidad
                      <input type="checkbox" class="chkplas" value="ex_inc" name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="chkplas" value="impresion" name="ver_paginas[]">Impresión</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="im_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="im_pg" name="ver_menus[]">Programación
                      <input type="checkbox" class="chkplas" value="im_pr" name="ver_menus[]">Premontajes
                      <input type="checkbox" class="chkplas" value="im_cr" name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="im_cmi" name="ver_menus[]">C. Muestra Impresor
                      <input type="checkbox" class="chkplas" value="im_cmm" name="ver_menus[]">C. Muestra Matizador
                      <input type="checkbox" class="chkplas" value="im_cma" name="ver_menus[]">C. Muestra Analista
                      <input type="checkbox" class="chkplas" value="im_cms" name="ver_menus[]">C. Muestra Supervisor
                      <input type="checkbox" class="chkplas" value="im_lp" name="ver_menus[]">Limpiezas
                      <input type="checkbox" class="chkplas" value="im_inc" name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="chkplas" value="laminacion" name="ver_paginas[]">Laminación</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="la_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="la_cr" name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="la_inc" name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="refilado" name="ver_paginas[]">Refilado</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="re_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="re_cr" name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="re_inc" name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="sellado" name="ver_paginas[]">Sellado</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="se_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="se_cr" name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="se_inc" name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="config" name="ver_paginas[]">Administración</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="cf_ds" name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="cf_us" name="ver_menus[]">Usuario
                    </td>
                  </tr>
              </tbody>
          </table>
          
            <!--<h4 align="center"><b>Adjuntar Foto</b></h4>
            <input type="file" name="files[]" accept="image/*"  multiple/>
            <input id="archivos" name="imagenes[]" type="file" accept="image/*" multiple=true >
            <input id="cadenalista" type="hidden" name="evidencia">         
            <input id="id" type="hidden">
            <div class="msgdiv" id="chatbox"></div>-->
              
            </div>
        

        <div class="modal-footer">
          <a href="usuarios.php"><button type="button" id="btn-cerrar" class="btn btn-default" >Cancelar</button></a>
          <input  type="submit" class="btn btn-primary" id="inc-guar" name="inc-guardar" value="Guardar">   
        </div>

        </form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
</div><!-- /.content-wrapper -->

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