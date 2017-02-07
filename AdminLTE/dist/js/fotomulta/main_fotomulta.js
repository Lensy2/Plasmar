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
    placeholder: "Seleccionar un Tipo de Inconformidad",
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
      alert('Por favor llene los campos')
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
      var correcto;
      //Listas desplegables
      var selectTipo_inconf=$('#tipo_inconf:required');
      var selectTipo_proceso=$('#tipo_proceso:required');
      var selectCausa = $('#causa:required');
      //Campos generales
      var campoEmpleado_res = $('#operarios:required');
      var campoArea = $('#area:required');
      var campoDescripcion_2 = $('#descripcion_inc:required');

      correcto = validarCampoSelect(selectTipo_inconf);
      correcto = validarCampoSelect(selectTipo_proceso);
      correcto = validarCampoSelect(selectCausa);

      correcto = validarCampoTexto(campoEmpleado_res);
      $(campoEmpleado_res).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoArea);
      $(campoArea).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoDescripcion_2);
      $(campoDescripcion_2).click(function(){$(this).removeClass('error');});

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

      correcto = validarCampoSelect(selectTipo_inconf);
      correcto = validarCampoSelect(selectTipo_proceso);
      correcto = validarCampoSelect(selectCausa);
      correcto = validarCampoSelect(selectDispo_final);

      correcto = validarCampoTexto(campoPedido);
      $(campoPedido).click(function(){ $(this).removeClass('error');});

      correcto = validarCampoTexto(campoCliente);
      $(campoCliente).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoDescripcion_1);
      $(campoDescripcion_1).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoReferencia);
      $(campoReferencia).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoNum_rollo);
      $(campoNum_rollo).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoMaquina);
      $(campoMaquina).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoCantidad);
      $(campoCantidad).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoEmpleado_res);
      $(campoEmpleado_res).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoArea);
      $(campoArea).click(function(){$(this).removeClass('error');});

      correcto = validarCampoTexto(campoDescripcion_2);
      $(campoDescripcion_2).click(function(){$(this).removeClass('error');});
  }

}

/*
*Funcion para almacenar la fotomulta
*/
/*
function comprobarCamposFotoMulta(inconformidad) {

  if (inconformidad == 'INCUMPLIMIENTO AL S.G.I') {
    alert('Campos para INCUMPLIMIENTO AL S.G.I');
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
    var txtEmpleado_res    = $('#operarios').val();
    var txtArea            = $('#area').val();
    var txtDescripcion_2   = $('#descripcion_inc').val();
    var txtSistema_Afect   = $("input[name='chkSistema\\[\\]']").map(function(){return $(this).val();}).get();
    var txtFoto_evidencia  = $('#cadenalista').val();
    var datosFotoMulta = 'fecha_fotomulta='+txtFecha_fotomulta; 


    alert(datosFotoMulta);

  }else{
    alert('Campos normales')
    /*
    var txtFecha_fotomulta = $('#fecha_fotomulta').val();
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
    var txtArea            = $('#area').val();
    var txtDescripcion_2   = $('#descripcion_inc').val();
    var txtDispo_final     = $('#dispo_final').val();
    var txtSistema_Afect   = $("input[name='chkSistema\\[\\]']").map(function(){return $(this).val();}).get();
    var txtFoto_evidencia  = $('#cadenalista').val();
  }
  
}
*/
$("body").on("click","#Agregar", function(e){

  alert('Guardando..');
  var txtTipo_inconf = $('#tipo_inconf :selected').text();
  var resValidacion = comprobarCamposFotoMulta(txtTipo_inconf);
  
  if (resValidacion) {
    alert('Get datos de campos...');
    //Metodo para almacenar los valores de los campos de fotomulta
  }else{
    alert('Campos vacios');
  }
  e.preventDefault();
  });
});

