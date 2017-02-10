$(document).ready(function() {    
    $('#operarios').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'lista_operarios.php?tipo=1',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {label: item,	value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });   

    $('#operarios').on('autocompleteselect', function (e, ui) {
        var nombre_empleado = ui.item.value;
        var dataEmpleado = '&emp='+nombre_empleado;

          $.ajax({
				    type: "GET",
				    url: "lista_operarios.php?tipo=2",
				    data: dataEmpleado,
				    cache: false,
				    success: function (res, status) {
				    	$('#area').val(res);
				    },
				    error: function(result, status, error){
				      console.log(err)
				    }
				  });

    });

	$('#limpiar').click(function() {
  			//alert( "Handler for .click() called." );
  			$('#operarios').val("");

	});         
});    