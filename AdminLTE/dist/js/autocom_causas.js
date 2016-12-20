$(document).ready(function() {    
    $('#causas').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'lista_causas.php',
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

    $('#causas-general').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'lista_causas_general.php',
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
    $('#comp-cliente').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'datos_adicionales.php',
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