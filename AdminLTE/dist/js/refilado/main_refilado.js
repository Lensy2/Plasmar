$(function () {               
             $("#ver-admin").click(function() {
          var a = $(".val-admin").val();
        window.location = "http://"+a+"/apps/administracion/dashboard.php";
    });

               $("#ver-infor").click(function() {
          var a = $(".val-infor").val();
        window.location = "http://"+a+"/apps/informes/dashboard.php";
    });
                       
        $('#prog_ext').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        $('#c_requisitos').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_minimal-blue'
        });
        
        $('#chk1,#chk2,#chk3,#chk4,#chk5,#chk7,#chk6,#chk8,#chk9,#chk10,#chk11,#chk12,#chk13,#chk14').click(function () {
          if ($('#chk1:checked,#chk2:checked,#chk3:checked,#chk4:checked,#chk5:checked,#chk6:checked,#chk7:checked,#chk8:checked,#chk9:checked,#chk10:checked,#chk11:checked,#chk12:checked,#chk13:checked,#chk14:checked').length == 14)
            $('#chkrequisitos').removeAttr('disabled');
          else
            $('#chkrequisitos').attr('disabled','disabled');
        });
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
*Comprobacion de campos de un requisito
*/
function comprobarRequisitosRefilado(argument) {
  //Campos generales
  var operario_res = $('#operarios:required');
  var fecha_refilado = $('#fechrefi:required');
  var kilos_refilados = $('#krefi:required');
  var tiempo_curado = $('#tcurado:required');
  var gramos_m = $('#gramosm:required');
  var kilos_p = $('#kilos_p:required');
  var ancho_bobina = $('#ancho_bobina:required');
  var peso_guias = $('#peso_guias:required');
  var maquina_ref = $('#maquina_ref:required');

  var estado1 = validarCampoTexto(operario_res);
  $(operario_res).click(function(){$(this).removeClass('error');});

  var estado2 = validarCampoTexto(fecha_refilado);
  $(fecha_refilado).click(function(){$(this).removeClass('error');});

  var estado3 = validarCampoTexto(kilos_refilados);
  $(kilos_refilados).click(function(){$(this).removeClass('error');});

  var estado4 = validarCampoTexto(tiempo_curado);
  $(tiempo_curado).click(function(){$(this).removeClass('error');});

  var estado5 = validarCampoTexto(gramos_m);
  $(gramos_m).click(function(){$(this).removeClass('error');});

  var estado6 = validarCampoTexto(kilos_p);
  $(kilos_p).click(function(){$(this).removeClass('error');});

  var estado7 = validarCampoTexto(ancho_bobina);
  $(ancho_bobina).click(function(){$(this).removeClass('error');});

  var estado8 = validarCampoTexto(peso_guias);
  $(peso_guias).click(function(){$(this).removeClass('error');});

  var estado9 = validarCampoSelect(maquina_ref);
  $(maquina_ref).click(function(){$(this).removeClass('error');});

      var arrayEstados = [estado1, estado2, estado3, estado4, estado5, estado6, estado7, estado8, estado9];
      var correcto;

      if($.inArray(false, arrayEstados) !== -1){
        correcto = false;
      }else{
        correcto = true;
      }

      return correcto;
      
}
    /*
    *Metodo para guardar un control de requisito, std: si es guardar o aprobado
    */
    function getDatosRequisito(std) {
    var num_orden = $('#num_orden').val();
    var operario_res = $('#operarios').val();
    var estado;
    if (std == 'aprobado') { var estado = 'aprobado';}
    else if (std == 'pendiente') {var estado = 'pendiente'; }
    var fecha_refilado = $('#fechrefi').val();
    var kilos_refilados = $('#krefi').val();
    var ancho_bobina = $('#ancho_bobina').val();
    var peso_guias = $('#peso_guias').val();
    var maquina_ref = $('#maquina_ref :selected').val();
    var tiempo_curado = $('#tcurado').val();
    var gramos_m = $('#gramosm').val();
    var kilos_p = $('#kilos_p').val();
    var checked_refilado  = $("input[name='chkrefilado\\[\\]']:checked").map(function(){return $(this).val();}).get();
    var id_usuario = $('#id_usuario').val();

    var dataArray = 'num_orden='+num_orden+'&operario='+operario_res+'&estado='+estado+'&fechare='+fecha_refilado+'&kilos='+kilos_refilados+'&ancho_bobina='+ancho_bobina+'&peso_guias='+peso_guias+'&maquina_ref='+maquina_ref+'&tcurado='+tiempo_curado+'&gramosm='+gramos_m+'&kilos_p='+kilos_p+'&refilado='+checked_refilado+'&Idusuario='+id_usuario;
   
    return dataArray;

    }

/*
*Transaccion ajax para almacenar requisito
*/
function ajaxGuardarRequisito(array) {
$.ajax({
        type: "POST",
        url: "insert.php",
        data: array,
        cache: false,
        success: function (res, status) {
          if (res != '0') {
             swal({
                title: "¡Control de requisito agregado!",
                text: "",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
              },
              function(){
                  window.location.href = 'requisitos.php';          
              });
          }else{
            alert(res);
          }
           
        },
        error: function(result, status, error){
          console.log(err)
        }
          
      });
}
/*
*Transaccion ajax para actualizar requisito
*/
function ajaxActualizarRequisito(array,id_requisito) {
  var array_con_id = array+"&id_requisito="+id_requisito;
$.ajax({
        type: "POST",
        url: "update.php",
        data: array_con_id,
        cache: false,
        success: function (res, status) {
          if (res == 'ok') {
             swal({
                title: "¡Control de requisito actualizado!",
                text: "",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
              },
              function(){
                  window.location.href = 'requisitos.php';          
              });
          }else{
            alert(res);
          }
           
        },
        error: function(result, status, error){
          console.log(err)
        }
          
      });
}
    $('body').on('click', '#btnAprobar', function(event) {
      event.preventDefault();
      /* Act on the event */
      var estado = 'aprobado';
      if (comprobarRequisitosRefilado()) {
        var data = getDatosRequisito(estado);
        ajaxGuardarRequisito(data);
      }else{
        alert('¡ Por favor diligenciar los campos requeridos !');
      }
      
    });

    $('body').on('click', '#btnGuardar', function(event) {
      event.preventDefault();
      /* Act on the event */
      var estado = 'pendiente';
      if (comprobarRequisitosRefilado()) {
        var data = getDatosRequisito(estado);
        ajaxGuardarRequisito(data);
      }else{
        alert('¡ Por favor diligenciar los campos requeridos !');
      }
    });
    //Botones del formulario Editar requisito
    $('body').on('click', '#btnUpAprobar', function(event) {
      event.preventDefault();
      /* Act on the event */
      var estado = 'aprobado';
      if (comprobarRequisitosRefilado()) {
        var data = getDatosRequisito(estado);
        var id_req = $('#id_requisito').val()
        ajaxActualizarRequisito(data,id_req);
      }else{
        alert('¡ Por favor diligenciar los campos requeridos !');
      }
      
    });

    $('body').on('click', '#btnUpGuardar', function(event) {
      event.preventDefault();
      /* Act on the event */
      var estado = 'pendiente';
      if (comprobarRequisitosRefilado()) {
        var data = getDatosRequisito(estado);
        var id_req = $('#id_requisito').val()
        ajaxActualizarRequisito(data,id_req);
      }else{
        alert('¡ Por favor diligenciar los campos requeridos !');
      }
    });
/*
*Dar por terminado un control de requisito
*/
 $("body").on("click", '.btnTerminarReq', function(e){

   var btn = $(this);
  var id = btn.data('id');//Id lista de empaque
   //window.location.href = 'updateStatus.php?id='+idLe+'&stat=3';

        swal({
          title: "¿ Desea terminar este requisito ?",
          text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Si",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            var dataTerminar = '&estado=terminado&id_requisito='+id;
            $.ajax({ 
              type: "POST",
              url: "updateStatus.php",
              data: dataTerminar,
              cache: false,
              success: function (res, status) {
                swal({
                title: "Terminado!",
                text: "Has finalizado este requisito.",
                type: "success",
                timer: 1000,
                showConfirmButton: false,
              },
              function(){
                  window.location.href = 'apro_requisitos.php';          
              });
                 
              },
              error: function(result, status, error){
                console.log(err)
              }
                
            });
            
          } 
        });
  });
});
