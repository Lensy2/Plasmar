$('#modalProgimp').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "val_pedido_impresion.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});

$("#buscar").click(function(){

  var textboxvalue = $('#recipient-name').val();
  var dataString = 'pedido='+textboxvalue;

  $.ajax({
    type: "GET",
    url: "../val_pedido_impresion.php",
    data: dataString,
    cache: false,

    success: function (code_html, status) {
        console.log(code_html);
      $('#content-validacions').empty();
      $('#content-validacions').append(code_html);
  },

    error: function(result, status, error){
    console.log(err)
  },

  complete: function (result, status) {

      }
    });
    //modal.find('.modal-title').text('New message to ' + recipient)
    //modal.find('.modal-body input').val(recipient)
});

$('#modalNuevoCRimp').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "../control_requisitos/val_pedido_cr.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});

$('#modalNuevoCMimp').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "../muestra_impresor/val_pedido_cmimp.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});

$('#modalNuevoCMmat').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "../muestra_matizador/val_pedido_cmmat.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});

$('#modalNuevoCMana').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "../muestra_analista/val_pedido_cmana.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});


$('#modalNuevoCMsup').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "../muestra_supervisor/val_pedido_cmsup.php",
    data: dataString,
    cache: false,
    success: function (code_html, status) {
        console.log(code_html);
        $('#content-validacion').empty();
        $('#content-validacion').append(code_html);
    },

    error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

    }
    });
    
});



$('#modalNuevaLim').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)

$("#guarda-limp").click(function(){

  var txtEstadoFo = $('input[name=es]:checked').val();
  var txtOperario = $('#operarios').val();
  var txtDescrip = $('.observaciones').val();

  var dataString = 'num_orden='+recipient+'&estado_fo='+txtEstadoFo+'&op_res='+txtOperario+'&observaciones='+txtDescrip;

  $.ajax({
    type: "POST",
    url: "../limpiezas/procesar_limpieza.php",
    data: dataString,
    cache: false,

    success: function (code_html, status) {
        console.log(code_html);
      $('#content-validacions').empty();
      $('#content-validacions').append(code_html);
      setTimeout(function() {
        window.location.href = '../limpiezas/limpiezas.php';
      }, 3000);

  },

    error: function(result, status, error){
    console.log(err)
  },

  complete: function (result, status) {

      }
    });
    //modal.find('.modal-title').text('New message to ' + recipient)
    //modal.find('.modal-body input').val(recipient)
  });
});

//Peticion Ajax - Inconformidades

$("#valida-orden").click(function(){

  var textboxvalue = $('#recipient-name').val();
  var dataString = 'pedido='+textboxvalue;

    if (textboxvalue != '') {
    $.ajax({
      type: "GET",
      url: "../inconformidades/datos_inconformidad.php",
      data: dataString,
      cache: false,

      success: function (code_html, status) {
          console.log(code_html);
        $('#content-validacions').empty();
        $('#content-validacions').append(code_html);
    },

      error: function(result, status, error){
      console.log(err)
    },

    complete: function (result, status) {

        }
      });
  }else{
    alert('¡Ingrese un valor por favor!');
  }
    //modal.find('.modal-title').text('New message to ' + recipient)
    //modal.find('.modal-body input').val(recipient)
});