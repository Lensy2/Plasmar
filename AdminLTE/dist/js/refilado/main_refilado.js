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
        
      });