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
  *Autocompletado de Tipos
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
  *Deshabilitar ciertos campos de acuerdo a un valor del select Tipo_inconf
  */
  $('#tipo_inconf').change(function() {
    var tipo = $('#tipo_inconf :selected').text();
    if (tipo == 'INCUMPLIMIENTO AL S.G.I') {
      $('#pedido').prop( "disabled", true );
      $('#comp-cliente').prop( "disabled", true );
      $('#descripcion').prop( "disabled", true );  
      $('#referencia').prop( "disabled", true );
      $('#num_rollo').prop( "disabled", true );
      $('#cantidad').prop( "disabled", true );
      $('#dispo_final').prop( "disabled", true );

          //$('#text2').prop( "disabled", false )
    }else{
      $('#pedido').prop( "disabled", false );    
      $('#comp-cliente').prop( "disabled", false );
      $('#descripcion').prop( "disabled", false );  
      $('#referencia').prop( "disabled", false );
      $('#num_rollo').prop( "disabled", false );
      $('#cantidad').prop( "disabled", false );
      $('#dispo_final').prop( "disabled", false );
    }

  });




});

