$(function(){

    $("#ver-admin").click(function() {
          var a = $(".val-admin").val();
        window.location = "http://"+a+"/apps/administracion/dashboard.php";
    });

      $("#ver-infor").click(function() {
          var a = $(".val-infor").val();
        window.location = "http://"+a+"/apps/informes/dashboard.php";
    });

    $("#defecto").prop( "disabled", true);
    $('#apariencia').on('change',function(){
        var valor = $(this).val();
        if (valor == 'BUENA') {
            $("#defecto").prop( "disabled", true);
        }else if (valor == 'MALA') {
            $("#defecto").prop( "disabled", false);
        }
    });

    $("#inc-ter").click(function() {
        $("#estadoInc").html("<input type='text' name='inc-terminar' value='terminado' />");
    });

    $("#inc-guar").click(function() {
        $("#estadoInc").html("<input type='text' name='inc-guardar' value='pendiente' />");
    });

    $("#inc-guar").on("click", function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controles_calidad/procesar_control_calidad.php",
            data: $('#frmCalidad').serialize(),
            success: function(data) {
                $("#chatbox").append(data + "<br/>");
                setTimeout(function() {
                    $("#frmInc").submit();
                }, 2000);
            },
        });
    });

    $("#inc-ter").on("click", function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "../controles_calidad/procesar_control_calidad.php",
            data: $('#frmCalidad').serialize(),
            success: function(data) {
                $("#chatbox").append(data + "<br/>");
                setTimeout(function() {
                    $("#frmInc").submit();
                }, 2000);
            },
        });
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

    //Funcionalidad de Control de Requisitos - Checkbox
    $('#chk1,#chk2,#chk3,#chk4,#chk5,#chk7,#chk6,#chk8,#chk9,#chk10,#chk11,#chk12,#chk13,#chk14').click(function() {
        if ($('#chk1:checked,#chk2:checked,#chk3:checked,#chk4:checked,#chk5:checked,#chk6:checked,#chk7:checked,#chk8:checked,#chk9:checked,#chk10:checked,#chk11:checked,#chk12:checked,#chk13:checked,#chk14:checked,#chk15:checked,#chk16:checked,#chk17:checked').length == 14)
            $('#chkrequisitos').removeAttr('disabled');
        else
            $('#chkrequisitos').attr('disabled', 'disabled');
    });

    
    $("#archivos").fileinput({
    uploadUrl: "../inconformidades/cargar_fotos.php", 
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
                        $('#inc-ter').removeAttr('disabled');
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
                        $('#inc-ter').removeAttr('disabled');
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
*Metodo para validar los componentes de los tornillos de una mezcla
*/
function camprobarComponentes(comp,kg,lote) {
  for (i = 0; i < comp.length; i++) {
          var compValA = comp[i];
          var kgValA = kg[i];
          var ltValA = lote[i];
          var fallo;
          var estado;
          //Componente: lleno ; kg: igual a .00 ; lote: vacio
          if (compValA != '' && kgValA == '.00' && ltValA == '') {
            fallo = 0;
          }
          //Componente: lleno ; kg: diferente a .00 ; lote: vacio
          else if (compValA != '' && kgValA != '.00' && ltValA == '') {
            fallo = 0;
          }

          //Componente: vacio ; kg: igual a .00 ; lote: lleno
          else if (compValA == '' && kgValA == '.00' && ltValA != '') {
            fallo = 0;
          }

          //Componente: vacio ; kg: diferente a .00 ; lote: lleno
          else if (compValA == '' && kgValA != '.00' && ltValA != '') {
            fallo = 0;
          }

          //Componente: lleno ; kg: vacio ; lote: lleno
          else if (compValA != '' && kgValA == '' && ltValA != '') {
            fallo = 0;
          }

          //Componente: lleno ;  kg: igual a .00 ; lote: lleno
          else if (compValA != '' && kgValA == '.00' && ltValA != '') {
            fallo = 0;
          }

          //Componente: vacio ;  kg: igual a .00 ; lote: vacio
          else if (compValA == '' && kgValA != '.00' && ltValA == '') {
            fallo = 0;
          }
      }
      if (fallo == 0) {
        estado = 0;
        return estado;

      }else{
        estado = 1;
        return estado;
      }
}

/*
*Metodo para validar el ingreso correcto de los componentes en un control de mezcla
*/
  function comprobacionCompleta() {
       // body...
   
    /* Act on the event */
    //Tornillo 1
    var comp_A = $("input[name='comp_A\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_A = $("input[name='kg_A\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_A = $("input[name='lote_A\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobracion de campos
    var comprobacionTor1 = camprobarComponentes(comp_A,kg_A,lote_A);

    //Tornillo 2
    var comp_B = $("input[name='comp_B\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_B = $("input[name='kg_B\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_B = $("input[name='lote_B\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor2 = camprobarComponentes(comp_B,kg_B,lote_B);

    //Tornillo 3
    var comp_C = $("input[name='comp_C\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_C = $("input[name='kg_C\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_C = $("input[name='lote_C\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor3 = camprobarComponentes(comp_C,kg_C,lote_C);

    //Tornillo 4
    var comp_D = $("input[name='comp_D\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_D = $("input[name='kg_D\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_D = $("input[name='lote_D\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor4 = camprobarComponentes(comp_D,kg_D,lote_D);

    //Tornillo 5
    var comp_E = $("input[name='comp_E\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_E = $("input[name='kg_E\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_E = $("input[name='lote_E\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor5 = camprobarComponentes(comp_E,kg_E,lote_E);

    //Tornillo 6
    var comp_F = $("input[name='comp_F\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_F = $("input[name='kg_F\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_F = $("input[name='lote_F\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor6 = camprobarComponentes(comp_F,kg_F,lote_F);

    //Tornillo 7
    var comp_G = $("input[name='comp_G\\[\\]']").map(function(){return $(this).val();}).get();
    var kg_G = $("input[name='kg_G\\[\\]']").map(function(){return $(this).val();}).get();
    var lote_G = $("input[name='lote_G\\[\\]']").map(function(){return $(this).val();}).get();
    //Comprobacion de campos
    var comprobacionTor7 = camprobarComponentes(comp_G,kg_G,lote_G);

    //Estado de campos de tornillos
    var arrayEstados = [comprobacionTor1, comprobacionTor2, comprobacionTor3, comprobacionTor4, comprobacionTor5, comprobacionTor6, comprobacionTor7];
    var correcto;

    if($.inArray(0, arrayEstados) !== -1){correcto = false;}
    else{correcto = true;}

    return correcto;
  }

$("#form-mezcla").submit(function(event) {
    /* Act on the event */
    if (comprobacionCompleta() == true) {
      return true;
    }else{
      alert('¡ Por favor, validar los campos no diligenciados correctamente !');
      return false;

    }
    
  });  

});


