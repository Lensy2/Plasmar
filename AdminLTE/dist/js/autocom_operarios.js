$(document).ready(function() {    
    $('#operarios').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'lista_operarios.php',
		      			dataType: "json",
						data: {
						   name_startsWith: request.term
						},
						 success: function( data ) {
							 response( $.map( data, function( item ) {
								return {
									label: item,
									value: item
								}
							}));
						}
		      		});
		      	},
		      	autoFocus: true,
		      	minLength: 0      	
		      });   

	$('#limpiar').click(function() {
  			//alert( "Handler for .click() called." );
  			$('#operarios').val("");

	});         
});    