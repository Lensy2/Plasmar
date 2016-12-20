<?php
//Incio primera parte validacion de Pagina y Usuario
session_start();
if (isset($_SESSION['usuario'])) {
        if (in_array('config', $_SESSION['paginas'])) {
  //Fin primera parte validacion de Pagina y Usuario
  $archivo = 'usuarios';
  include '../includes/funciones.php';
  $enlace = rutaRecursos('primer_nivel');
  if (isset($_GET['id'])){
    $Iduser = $_GET['id'];
  }  
  include '../includes/dbconfig.php';
  include '../includes/administracion/header.php';
  include '../model/administracion.php';

  $detalleUsuario = "SELECT * FROM usuarios WHERE Idusuario='$Iduser'";
  $registrosUsuarioChk = sqlsrv_query($connSCPBD,$detalleUsuario);

  $datos = sqlsrv_fetch_array($registrosUsuarioChk);
  $chkMenus = explode(',', $datos['ver_menus']);
  $chkPaginas = explode(',', $datos['ver_paginas']);
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
            <li class="active">Editar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          	<div class="box">
	            <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-edit"></i> Editar - Usuario</h3>
        </div><!-- /.box-header -->
	            <div class="box-body">
	  				<form id="frmInc" action="actualizar_usuario.php" method="post" accept-charset="utf-8">
        <div class="modal-body">        
          <h4 align="center"><b>Formulario de registro</b></h4>
             
             <input type="hidden" name="iduser" value="<?php echo $Iduser; ?>">
            <label>Nombre</label>
            <input type="text" class="form-control" name="nombre" value="<?php echo $datos['nombre'] ?>" placeholder="Ingrese nombre completo" required>
            <label>Apellido</label>
            <input type="text" class="form-control" name="apellido" value="<?php echo $datos['apellido'] ?>" placeholder="Ingrese apellido completo" required>
            <label>Cédula</label>
            <input type="number" step="any"  class="form-control" name="cedula" value="<?php echo $datos['cedula'] ?>" placeholder="Ingrese numero de cédula" required>
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario" value="<?php echo $datos['usuario'] ?>" placeholder="Ingrese nombre de usuario" required>
            <label>Contraseña</label>
            <input type="text" class="form-control" value="<?php echo $datos['contrasena'] ?>" placeholder="Ingrese una contraseña" required>
            <input type="hidden" class="form-control" name="contrasena" value="<?php echo $datos['contrasena'] ?>" placeholder="Reescriba la contraseña anterior" required>

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
                    <td><input type="checkbox" class="chkplas" value="extruder" <?php if(in_array('extruder',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]"> Extruder</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="ex_ds" <?php if(in_array('ex_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="ex_pg" <?php if(in_array('ex_pg',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Programación
                      <input type="checkbox" class="chkplas" value="ex_cm" <?php if(in_array('ex_cm',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Mezclas
                      <input type="checkbox" class="chkplas" value="ex_cr" <?php if(in_array('ex_cr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="ex_cc" <?php if(in_array('ex_cc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Calidad
                      <input type="checkbox" class="chkplas" value="ex_inc" <?php if(in_array('ex_inc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="chkplas" value="impresion" <?php if(in_array('impresion',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]">Impresión</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="im_ds" <?php if(in_array('im_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="im_pg" <?php if(in_array('im_pg',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Programación
                      <input type="checkbox" class="chkplas" value="im_pr" <?php if(in_array('im_pr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Premontajes
                      <input type="checkbox" class="chkplas" value="im_cr" <?php if(in_array('im_cr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="im_cmi" <?php if(in_array('im_cmi',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. Muestra Impresor
                      <input type="checkbox" class="chkplas" value="im_cmm" <?php if(in_array('im_cmm',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. Muestra Matizador
                      <input type="checkbox" class="chkplas" value="im_cma" <?php if(in_array('im_cma',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. Muestra Analista
                      <input type="checkbox" class="chkplas" value="im_cms" <?php if(in_array('im_cms',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. Muestra Supervisor
                      <input type="checkbox" class="chkplas" value="im_lp" <?php if(in_array('im_lp',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Limpiezas
                      <input type="checkbox" class="chkplas" value="im_inc" <?php if(in_array('im_inc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" class="chkplas" value="laminacion" <?php if(in_array('laminacion',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]">Laminación</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="la_ds" <?php if(in_array('la_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="la_cr" <?php if(in_array('la_cr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="la_inc" <?php if(in_array('la_inc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="refilado" <?php if(in_array('refilado',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]">Refilado</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="re_ds" <?php if(in_array('re_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="re_cr" <?php if(in_array('re_cr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="re_inc" <?php if(in_array('re_inc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="sellado" <?php if(in_array('sellado',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]">Sellado</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="se_ds" <?php if(in_array('se_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="se_cr" <?php if(in_array('se_cr',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">C. de Requisitos
                      <input type="checkbox" class="chkplas" value="se_inc" <?php if(in_array('se_inc',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Inconformidades
                    </td>
                  </tr>
                  <tr>
                     <td><input type="checkbox" class="chkplas" value="config" <?php if(in_array('config',$chkPaginas)){echo 'checked="checked"';}?> name="ver_paginas[]">Administración</td>
                    <td>
                      <input type="checkbox" class="chkplas" value="cf_ds" <?php if(in_array('cf_ds',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Dashboard
                      <input type="checkbox" class="chkplas" value="cf_us" <?php if(in_array('cf_us',$chkMenus)){echo 'checked="checked"';}?> name="ver_menus[]">Usuario
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
          <input  type="submit" class="btn btn-primary" id="inc-guar" name="inc-guardar" value="Actualizar">   
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