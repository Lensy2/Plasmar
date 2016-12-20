$("#buscar").click(function(){

  var textboxvalue = $('#recipient-name').val();
  var dataString = 'pedido='+textboxvalue;

  $.ajax({
    type: "GET",
    url: "../val_pedido_sellado.php",
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