$(function () { 
  /*
  *Enlaces del menu superior
  */
  $("#ver-admin").click(function() {
    var a = $(".val-admin").val();
    window.location = "http://"+a+"/apps/administracion/dashboard.php";
  });

  $("#ver-infor").click(function() {
    var a = $(".val-infor").val();
    window.location = "http://"+a+"/apps/informes/dashboard.php";
  });
  /*
  *Funcionamiento utilizado para la gestion de la carga de las imagenes
  */
  $("#archivos").fileinput({
    uploadUrl: "cargar_fotos.php", 
    uploadAsync: false,
    minFileCount: 1,
    maxFileCount: 10,
    showUpload: true, 
    showRemove: true
    }).on("filebatchselected", function(event, files){
      var texto = $(".file-caption-name").text();     
      $("#id").val(texto);
      $(".borrarAnterior").click(function (){
            setTimeout(function() {
                var texto = $(".file-caption-name").text();     
                $("#id").val(texto);
                
                setTimeout(function() {
                    if($('#id').val().length == 0){
                        $('#inc-guar').removeAttr('disabled');
                    }
                }, 1000); 
            }, 1000);       
        });

        $(".borrarTodos, .close.fileinput-remove").click(function (){
            setTimeout(function() {             
                var texto = $(".file-caption-name").text();     
                $("#id").val(texto);
                    setTimeout(function() {
                    if($('#id').val().length == 0){
                        $('#inc-guar').removeAttr('disabled');
                    }
                }, 1000); 
            }, 1000);       
        });
    });

    $('#archivos').on('fileimageloaded', function(event, previewId){
        $('#inc-guar').attr('disabled', 'disabled');  
        $('#inc-ter').attr('disabled', 'disabled');   
        console.log("fileimageloaded");
    });

    $('#archivos').on('fileunlock', function(event, filestack, extraData){
      var fstack = filestack.filter(function(n){ return n != undefined });

      $('.borrarAnterior').css('display', 'none');
      $('.borrarTodos').attr('disabled', 'disabled');
      $('.fileinput-upload-button').attr('disabled', 'disabled');
      $('.btn-file').attr('disabled', 'disabled');
      $('#inc-guar').removeAttr('disabled');
      $('#inc-ter').removeAttr('disabled');
       
      var imgs = $("#id");
      texto = imgs.val();
      nuevaCadena = texto.split('.jpg');
      $("#cadenalista").val(nuevaCadena); 
      console.log('Files selected - ' + fstack.length);
  }); 
  /*
  *Validacion de campos requeridos Listas desplegables
  */
  function comprobarCamposAuto(){
     var correcto=true;
     var selectTipo_inconf=$('#tipo_inconf:required');
     var selectTipo_proceso=$('#tipo_proceso:required');
     $(selectTipo_inconf).each(function() {
        if($(this).text()=='' || $(this).text()=='No Products Found'){
           correcto=false;
           $(this).addClass('error');
        }
     });
     $(selectTipo_proceso).each(function() {
        if($(this).text()=='' || $(this).text()=='No Products Found'){
           correcto=false;
           $(this).addClass('error');
        }
     });
     return correcto;
  }
  /*
  *Autocompletado de Tipos de inconformidad
  */
  $( ".auto_tipo" ).select2({
    placeholder: "Filtre el tipo de inconformidad ó presione la tecla espacio para ver la lista",
      ajax: {
          url: "listaInconformidades.php?t=1",
          dataType: 'json',
          delay: 250,
          data: function (params) {
              return {
                  q: params.term // search term
              };
          },
          processResults: function (data) {
              // parse the results into the format expected by Select2.
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data
              return {
                  results: data
              };
          },
          cache: true
      },
      minimumInputLength: 0
  }); 
  /*
  *Autocompletado de Procesos
  */
  $( ".auto_procesos" ).select2({
    placeholder: "Seleccionar un Proceso",
      ajax: {
          url: "listaInconformidades.php?t=2",
          dataType: 'json',
          cache: false,
          delay: 250,
          data: function (params) {
              return {
                  q: params.term // search term
              };
          },
          processResults: function (data) {
              // parse the results into the format expected by Select2.
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data
              return {
                  results: data
              };
          },
          cache: true
      },
      minimumInputLength: 0
  }); 

  /*
  *Evento para activar el autocompletar de causas utilizando El tipo de inconformidad
  *y el tipo de proceso
  */
  $("body").on("click",".auto_causas", function(e){
    var res = comprobarCamposAuto();
    if (res) {
      /*
      *Se activa autocompletar si los campos Tipo de inconformidad y proceso estan llenos
      */
      var txttipo_inconf = $('#tipo_inconf :selected').text();  
      var txttipo_proceso = $('#tipo_proceso :selected').text();

      $( ".auto_causas" ).select2({
        placeholder: "Seleccionar una Causa",
          ajax: {
              url: "listaInconformidades.php?t=3&tipo_inc="+txttipo_inconf+"&proceso="+txttipo_proceso,
              dataType: 'json',
              delay: 250,
              data: function (params) {
                  return {
                      q: params.term // search term
                  };
              },
              processResults: function (data) {
                  // parse the results into the format expected by Select2.
                  // since we are using custom formatting functions we do not need to
                  // alter the remote JSON data
                  return {
                      results: data
                  };
              },
              cache: false
          },
          minimumInputLength: 0
      });
    }else{     
      swal({
        title: "Aviso",
        text: "¡Son requeridos los campos <b>Tipo de Inconformidad</b> y <b>Tipo de Proceso</b>!",
        type: "warning",
        html: true,
        confirmButtonText: "Cerrar"
      });
    }
    e.preventDefault();
  });

  /*
  *Reestablecer el select Causas al momento de dar click sobre los 
  *select Tipo_inconf o Tipo_proceso
  */
  $("body").on("click","#select2-tipo_inconf-container", function(e){
    $(".auto_causas").select2('destroy'); 
    $(".auto_causas").text(''); 
    e.preventDefault();
  });

  $("body").on("click","#select2-tipo_proceso-container", function(e){
    $(".auto_causas").select2('destroy');
    $(".auto_causas").text('');
    e.preventDefault();
  });
  /*
  *Deshabilitar ciertos campos de acuerdo a un valor del select Tipo_inconf, el valor es
  *INCUMPLIMIENTO AL S.G.I
  */
  $('#tipo_inconf').change(function() {
    var tipo = $('#tipo_inconf :selected').text();
    if (tipo == 'INCUMPLIMIENTO AL S.G.I') {
      //Campo Pedido
      $('#lbl_pedido').toggle(false);
      $('#pedido').toggle(false);
      //Campo cliente
      $('#lbl_cliente').toggle(false);
      $('#comp-cliente').toggle(false);
      //Campo descripcion
      $('#lbl_descripcion').toggle(false);
      $('#descripcion').toggle(false);
      //Campo referencia
       $('#lbl_referencia').toggle(false);
      $('#referencia').toggle(false);
      //Campo num_rollo
      $('#lbl_num_rollo').toggle(false);
      $('#num_rollo').toggle(false);
      //Campo maquina
      $('#lbl_maquina').toggle(false);
      $('#maquina').toggle(false);      
      //Campo cantidad
      $('#lbl_cantidad').toggle(false);
      $('#cantidad').toggle(false);
      //Campo dispo_final
      $('#lbl_dispo_final').toggle(false);
      $('#dispo_final').toggle(false); 
    }else{
      //Campo Pedido
      $('#lbl_pedido').toggle(true);
      $('#pedido').toggle(true);
      //Campo cliente
      $('#lbl_cliente').toggle(true);
      $('#comp-cliente').toggle(true);
      //Campo descripcion
      $('#lbl_descripcion').toggle(true);
      $('#descripcion').toggle(true);
      //Campo referencia
       $('#lbl_referencia').toggle(true);
      $('#referencia').toggle(true);
      //Campo num_rollo
      $('#lbl_num_rollo').toggle(true);
      $('#num_rollo').toggle(true);
      //Campo maquina
      $('#lbl_maquina').toggle(true);
      $('#maquina').toggle(true);      
      //Campo cantidad
      $('#lbl_cantidad').toggle(true);
      $('#cantidad').toggle(true);
      //Campo dispo_final
      $('#lbl_dispo_final').toggle(true);
      $('#dispo_final').toggle(true);     
    }
  });

/*
*Funcion para validar campos de texto
*@param nombre: campo , tipo : texto
*/
function validarCampoTexto(campo) {
   $(campo).each(function() {
    if($(this).val()==''){
      correcto=false;
      $(this).addClass('error');
    }else{
      correcto=true;
    }
  });
  return correcto;
}
/*
*Funcion para validar campos select
*@param nombre: campo , tipo : texto
*/
function validarCampoSelect(campo) {
  $(campo).each(function() {
    if($(this).text()=='' || $(this).text()=='No Products Found'){
      correcto=false;
      $(this).addClass('error');
    }else{
      correcto=true;  
    }
  });
  return correcto;
}
/*
*funcion para validar los campos requeridos de una fotomulta
*@param nombre: inconformidad , tipo : texto , comentario: 
*/
function comprobarCamposFotoMulta(inconformidad) {

  switch(inconformidad) {
    case 'INCUMPLIMIENTO AL S.G.I':
      //Listas desplegables
      var selectTipo_inconf=$('#tipo_inconf:required');
      var selectTipo_proceso=$('#tipo_proceso:required');
      var selectCausa = $('#causa:required');
      //Campos generales
      var campoEmpleado_res = $('#operarios:required');
      var campoArea = $('#area:required');
      var campoDescripcion_2 = $('#descripcion_inc:required');

      var estado1 = validarCampoSelect(selectTipo_inconf);
      var estado2 = validarCampoSelect(selectTipo_proceso);
      var estado3 = validarCampoSelect(selectCausa);

      var estado4 = validarCampoTexto(campoEmpleado_res);
      $(campoEmpleado_res).click(function(){$(this).removeClass('error');});

      var estado5 = validarCampoTexto(campoArea);
      $(campoArea).click(function(){$(this).removeClass('error');});

      var estado6 = validarCampoTexto(campoDescripcion_2);
      $(campoDescripcion_2).click(function(){$(this).removeClass('error');});

      var arrayEstados = [estado1, estado2, estado3, estado4, estado5, estado6];
      var correcto;

      if($.inArray(false, arrayEstados) !== -1){
        correcto = false;
      }else{
        correcto = true;
      }

      return correcto;
        break;

    default:
      var correcto; 
      //Listas desplegables
      var selectTipo_inconf     = $('#tipo_inconf:required');
      var selectTipo_proceso    = $('#tipo_proceso:required');
      var selectCausa           = $('#causa:required');      
      //Lista no visualizada en caso de inconformidad tipo: INCUMPLIMIENTO AL S.G.I 
      var selectDispo_final     = $('#dispo_final:required');
      //Campos no visualizados en caso de inconformidad tipo: INCUMPLIMIENTO AL S.G.I 
      var campoPedido          = $('#pedido:required');
      var campoCliente         = $('#comp-cliente:required');
      var campoDescripcion_1   = $('#descripcion:required');
      var campoReferencia      = $('#referencia:required');
      var campoNum_rollo       = $('#num_rollo:required');
      var campoMaquina         = $('#maquina:required');
      var campoCantidad        = $('#cantidad:required');
      //Campos generales
      var campoEmpleado_res    = $('#operarios:required');
      var campoArea            = $('#area:required');
      var campoDescripcion_2   = $('#descripcion_inc:required');

      var estado1 = validarCampoSelect(selectTipo_inconf);
      var estado2= validarCampoSelect(selectTipo_proceso);
      var estado3 = validarCampoSelect(selectCausa);
      var estado4 = validarCampoSelect(selectDispo_final);

      var estado5 = validarCampoTexto(campoPedido);
      $(campoPedido).click(function(){ $(this).removeClass('error');});

      var estado6 = validarCampoTexto(campoCliente);
      $(campoCliente).click(function(){$(this).removeClass('error');});

      var estado7 = validarCampoTexto(campoDescripcion_1);
      $(campoDescripcion_1).click(function(){$(this).removeClass('error');});

      var estado8 = validarCampoTexto(campoReferencia);
      $(campoReferencia).click(function(){$(this).removeClass('error');});

      var estado9 = validarCampoTexto(campoNum_rollo);
      $(campoNum_rollo).click(function(){$(this).removeClass('error');});

      var estado10 = validarCampoTexto(campoMaquina);
      $(campoMaquina).click(function(){$(this).removeClass('error');});

      var estado11 = validarCampoTexto(campoCantidad);
      $(campoCantidad).click(function(){$(this).removeClass('error');});

      var estado12 = validarCampoTexto(campoEmpleado_res);
      $(campoEmpleado_res).click(function(){$(this).removeClass('error');});

      var estado13 = validarCampoTexto(campoArea);
      $(campoArea).click(function(){$(this).removeClass('error');});

      var estado14 = validarCampoTexto(campoDescripcion_2);
      $(campoDescripcion_2).click(function(){$(this).removeClass('error');});

      var arrayEstados = [estado1, estado2, estado3, estado4, estado5, estado6, estado7, estado8, estado9, estado10, estado11, estado12, estado13, estado14];
      var correcto;

      if($.inArray(false, arrayEstados) !== -1){
        correcto = false;
      }else{
        correcto = true;
      }

      return correcto;
  }

}
/*
*Funcion construir el array de datos completo de una foto multa segun su tipo de
*inconformidad
*/
function arrayDatosFotoMulta(inconformidad) {
  if (inconformidad == 'INCUMPLIMIENTO AL S.G.I') {
    var txtFecha_fotomulta = $('#fecha_fotomulta').val();
    if (txtFecha_fotomulta == '') {
      //07-02-2017 11:55
      //dd-mm-yyy
      var fecha = new Date();
      var dia = fecha.getDate();
      if(dia<10) {dia='0'+dia}
      var mes = fecha.getMonth()+1;
      if(mes<10) {mes='0'+mes}
      var ano = fecha.getFullYear();
      var hr = fecha.getHours();
      if(hr<10) {hr='0'+hr}
      var min = fecha.getMinutes();
      if(min<10) {min='0'+min}
      
      var txtFecha_fotomulta = dia+'-'+mes+'-'+ano+' '+hr+':'+min;
    } 
    var txtTipo_inconf     = $('#tipo_inconf :selected').text();
    var txtTipo_proceso    = $('#tipo_proceso :selected').text();
    var txtCausa           = $('#causa :selected').text();    
    var txtDetectada_por   = $('#detectada_por').val();
    var txtEmpleado_res    = $('#operarios').val();
    var txtArea            = $('#area').val();
    var txtDescripcion_2   = $('#descripcion_inc').val();
    var txtSistema_Afect   = $("input[name='chkSistema\\[\\]']:checked").map(function(){return $(this).val();}).get();
    var txtFoto_evidencia  = $('#cadenalista').val();
    var txtId_usuario = $('#id_usuario').val();
    var datos;

    if (txtFoto_evidencia == '') {
      datos = 'Fecha_foto='+txtFecha_fotomulta+'&Tipo_inconf='+txtTipo_inconf+'&Tipo_proceso='+txtTipo_proceso+'&Causa='+txtCausa+'&Detectada_por='+txtDetectada_por+'&Empleado_res='+txtEmpleado_res+'&Area='+txtArea+'&Descripcion_2='+txtDescripcion_2+'&Sistema_Afect='+txtSistema_Afect+'&Foto_evidencia=null.png'+'&id_usuario='+txtId_usuario;
    }else{
      datos = 'Fecha_foto='+txtFecha_fotomulta+'&Tipo_inconf='+txtTipo_inconf+'&Tipo_proceso='+txtTipo_proceso+'&Causa='+txtCausa+'&Detectada_por='+txtDetectada_por+'&Empleado_res='+txtEmpleado_res+'&Area='+txtArea+'&Descripcion_2='+txtDescripcion_2+'&Sistema_Afect='+txtSistema_Afect+'&Foto_evidencia='+txtFoto_evidencia+'&id_usuario='+txtId_usuario;
    }
    return datos;


  }else{
    //Traer los datos de los campos cuando el tipo de inconformida no es Incumplimiento al S.G.I  
   var txtFecha_fotomulta = $('#fecha_fotomulta').val();
    if (txtFecha_fotomulta == '') {
      //07-02-2017 11:55
      //dd-mm-yyy
      var fecha = new Date();
      var dia = fecha.getDate();
      if(dia<10) {dia='0'+dia}
      var mes = fecha.getMonth()+1;
      if(mes<10) {mes='0'+mes}
      var ano = fecha.getFullYear();
      var hr = fecha.getHours();
      if(hr<10) {hr='0'+hr}
      var min = fecha.getMinutes();
      if(min<10) {min='0'+min}
      
      var txtFecha_fotomulta = dia+'-'+mes+'-'+ano+' '+hr+':'+min;
    }
    var txtTipo_inconf     = $('#tipo_inconf :selected').text();
    var txtTipo_proceso    = $('#tipo_proceso :selected').text();
    var txtCausa           = $('#causa :selected').text();

    var txtPedido          = $('#pedido').val();
    var txtCliente         = $('#comp-cliente').val();
    var txtDescripcion_1   = $('#descripcion').val();
    var txtReferencia      = $('#referencia').val();
    var txtNum_rollo       = $('#num_rollo').val();
    var txtMaquina         = $('#maquina').val();
    var txtCantidad        = $('#cantidad').val();
    var txtDetectada_por   = $('#detectada_por').val();
    var txtEmpleado_res    = $('#operarios').val();
    var txtDispo_final     = $('#dispo_final').val();

    var txtArea            = $('#area').val();
    var txtDescripcion_2   = $('#descripcion_inc').val();
    var txtSistema_Afect   = $("input[name='chkSistema\\[\\]']:checked").map(function(){return $(this).val();}).get();
    var txtFoto_evidencia  = $('#cadenalista').val();
    var txtId_usuario = $('#id_usuario').val();
    var datos;
    
    if (txtFoto_evidencia == '') {
      datos = 'Fecha_foto='+txtFecha_fotomulta+'&Tipo_inconf='+txtTipo_inconf+'&Tipo_proceso='+txtTipo_proceso+'&Causa='+txtCausa+'&Pedido='+txtPedido+'&Cliente='+txtCliente+'&Descripcion_1='+txtDescripcion_1+'&Referencia='+txtReferencia+'&Num_rollo='+txtNum_rollo+'&Maquina='+txtMaquina+'&Cantidad='+txtCantidad+'&Detectada_por='+txtDetectada_por+'&Empleado_res='+txtEmpleado_res+'&Dispo_final='+txtDispo_final+'&Area='+txtArea+'&Descripcion_2='+txtDescripcion_2+'&Sistema_Afect='+txtSistema_Afect+'&Foto_evidencia=null.png'+'&id_usuario='+txtId_usuario;
    }else{
      datos = 'Fecha_foto='+txtFecha_fotomulta+'&Tipo_inconf='+txtTipo_inconf+'&Tipo_proceso='+txtTipo_proceso+'&Causa='+txtCausa+'&Pedido='+txtPedido+'&Cliente='+txtCliente+'&Descripcion_1='+txtDescripcion_1+'&Referencia='+txtReferencia+'&Num_rollo='+txtNum_rollo+'&Maquina='+txtMaquina+'&Cantidad='+txtCantidad+'&Detectada_por='+txtDetectada_por+'&Empleado_res='+txtEmpleado_res+'&Dispo_final='+txtDispo_final+'&Area='+txtArea+'&Descripcion_2='+txtDescripcion_2+'&Sistema_Afect='+txtSistema_Afect+'&Foto_evidencia='+txtFoto_evidencia+'&id_usuario='+txtId_usuario;
    }

    return datos;   
  }
}
/*
*Transaccion ajax para almacenar foto multa
*/
function ajaxGuardarFotoMulta(array,tipo_inc) {

  switch(tipo_inc) {
    case 'INCUMPLIMIENTO AL S.G.I':
      $.ajax({
        type: "POST",
        url: "insert.php",
        data: array,
        cache: false,
        success: function (res, status) {
          if (res == 'ok') {
             swal({
                title: "¡Foto Multa Agregada!",
                text: "",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
              },
              function(){
                  window.location.href = 'foto_multas.php';          
              });
          }
           
        },
        error: function(result, status, error){
          console.log(err)
        }
      });
     break;
    default:
    /*Guardar para los otros tipo de inconformidad*/
      $.ajax({
        type: "POST",
        url: "insert.php",
        data: array,
        cache: false,
        success: function (res, status) {
            if (res == 'ok') {
             swal({
                title: "¡Foto Multa Agregada!",
                text: "",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
              },
              function(){
                  window.location.href = 'foto_multas.php';          
              });
          }
        },
        error: function(result, status, error){
          console.log(err)
        }
      });     
  }
  
}

  $("body").on("click","#inc-guar", function(e){

    var txtTipo_inconf = $('#tipo_inconf :selected').text();
    var txtFoto_evidencia  = $('#cadenalista').val();

    var resValidacion = comprobarCamposFotoMulta(txtTipo_inconf);
    if (resValidacion) {

      if (txtFoto_evidencia == '') {
        swal({
          title: "¿Estás seguro?",
          text: "Aun no ha adjuntado ninguna foto, ¿desea hacerlo?",
          type: "info",
          showCancelButton: true,
          confirmButtonText: "Si",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            $('#lbl_adjuntar').focus();
          } else {
            var datosFotoMulta = arrayDatosFotoMulta(txtTipo_inconf);      
            ajaxGuardarFotoMulta(datosFotoMulta,txtTipo_inconf);
          }
        });
      }else{
        var datosFotoMulta = arrayDatosFotoMulta(txtTipo_inconf);      
        ajaxGuardarFotoMulta(datosFotoMulta,txtTipo_inconf);
      }
      //Metodo para almacenar los valores de los campos de fotomulta
    }else{
      swal({
        title: "Aviso",
        text: "¡Por favor diligencie todos los campos requeridos!",
        type: "warning",
        confirmButtonText: "Cerrar"
      });
    }
    e.preventDefault();
  });
});

