$('#modalNuevaInc').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //Button that triggered the modal
  var recipient = button.data('whatever') //Extract info from data-* attributes
  var tipoped = button.data('tipopedido')
  var idmezcla = button.data('idmezcla')
  var numrollo = button.data('numrollo')
  var referencia = button.data('ref')

  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(recipient)
   modal.find('#tipopedido').text(tipoped)
   modal.find('#idmezcla').text(idmezcla)
   modal.find('#numrollo').text(numrollo)
   modal.find('#referencia').text(referencia)   
});



$('#modalNuevoCC').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var tipoped = button.data('tipopedido')
  var idmezcla = button.data('idmezcla')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
   modal.find('#numpedido').text(" "+recipient)   
   if (tipoped == 'ext_normal') {modal.find('#tipopedido').text("Normal")
    }else if (tipoped == 'ext_laminacion') {
     modal.find('#tipopedido').text("Laminación")
   }
   modal.find('#idmez').text(" "+idmezcla)
  var dataString = 'pedido='+recipient+'&tipoped=' + tipoped+'&idmezcla=' + idmezcla;

  $.ajax({
    type: "GET",
    url: "../controles_calidad/val_controles_calidad.php",
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

$('#modalNuevoCR').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  var tipoped = button.data('tipopedido')
  var idmezcla = button.data('idmezcla')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
   modal.find('#numpedido').text(" "+recipient)
   if (tipoped == 'ext_normal') {modal.find('#tipopedido').text("Normal")
    }else if (tipoped == 'ext_laminacion') {
     modal.find('#tipopedido').text("Laminación")
   }
   modal.find('#idmez').text(" "+idmezcla)
  var dataString = 'pedido='+recipient+'&tipoped=' + tipoped+'&idmezcla=' + idmezcla;

  $.ajax({
  	type: "GET",
  	url: "../control_requisitos/val_control_requisitos.php",
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

$('#modalProgramacion').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this);
   modal.find('#num_ped').text(" "+recipient)
  var dataString = 'pedido='+recipient;

  $.ajax({
    type: "GET",
    url: "val_tipo_tabla.php",
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
  var modal = $(this);
  var dataString = 'pedido='+textboxvalue;

  $.ajax({
    type: "GET",
    url: "../val_tipo_tabla.php",
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