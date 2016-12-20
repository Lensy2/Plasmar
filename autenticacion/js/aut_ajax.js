
		$("#form-autentica").click(function(){

		  var txtnombre = $('.txtnombre').val();
		  var txtpass = $('.txtpass').val();
		  var dataString = 'nombre='+txtnombre+'&pass='+txtpass;

		  $.ajax({
		    type: "POST",
		    url: "autenticacion/valida_usuario.php",
		    data: dataString,
		    cache: false,

		    success: function (respuesta, status) {
		       var texto = respuesta;
		       if (texto != 'incorrecto') {
		       	alert('|| Bienvenido a SC Plasmar ||');
		      	window.location.href = texto+'/dashboard.php';
		      }else {
		      	//alert('Datos Incorrectos');
		      	$('.mensaje').text('Datos Incorrectos');	
		      }
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
