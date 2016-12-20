$(document).ready(function() {    
    $('.nom_mezcla').autocomplete({
		      	source: function( request, response ) {
		      		$.ajax({
		      			type: "GET",
		      			url : 'lista_mezclas.php',
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

    //Limpiar Tornillo 1
	$('#limpc1tor1').click(function() {
  			$('.c1tor1').val("");
	});
	$('#limpc2tor1').click(function() {
  			$('.c2tor1').val("");
	});
	$('#limpc3tor1').click(function() {
  			$('.c3tor1').val("");
	});  
	$('#limpc4tor1').click(function() {
  			$('.c4tor1').val("");
	});  
	$('#limpc5tor1').click(function() {
  			$('.c5tor1').val("");
	});  
	$('#limpc6tor1').click(function() {
  			$('.c6tor1').val("");
	});


    //Limpiar Tornillo 2
	$('#limpc1tor2').click(function() {
  			$('.c1tor2').val("");
	});
	$('#limpc2tor2').click(function() {
  			$('.c2tor2').val("");
	});
	$('#limpc3tor2').click(function() {
  			$('.c3tor2').val("");
	});  
	$('#limpc4tor2').click(function() {
  			$('.c4tor2').val("");
	});  
	$('#limpc5tor2').click(function() {
  			$('.c5tor2').val("");
	});  
	$('#limpc6tor2').click(function() {
  			$('.c6tor2').val("");
	}); 


    //Limpiar Tornillo 3
	$('#limpc1tor3').click(function() {
  			$('.c1tor3').val("");
	});
	$('#limpc2tor3').click(function() {
  			$('.c2tor3').val("");
	});
	$('#limpc3tor3').click(function() {
  			$('.c3tor3').val("");
	});  
	$('#limpc4tor3').click(function() {
  			$('.c4tor3').val("");
	});  
	$('#limpc5tor3').click(function() {
  			$('.c5tor3').val("");
	});  
	$('#limpc6tor3').click(function() {
  			$('.c6tor3').val("");
	}); 


    //Limpiar Tornillo 4
	$('#limpc1tor4').click(function() {
  			$('.c1tor4').val("");
	});
	$('#limpc2tor4').click(function() {
  			$('.c2tor4').val("");
	});
	$('#limpc3tor4').click(function() {
  			$('.c3tor4').val("");
	});  
	$('#limpc4tor4').click(function() {
  			$('.c4tor4').val("");
	});  
	$('#limpc5tor4').click(function() {
  			$('.c5tor4').val("");
	});  
	$('#limpc6tor4').click(function() {
  			$('.c6tor4').val("");
	}); 


    //Limpiar Tornillo 5
	$('#limpc1tor5').click(function() {
  			$('.c1tor5').val("");
	});
	$('#limpc2tor5').click(function() {
  			$('.c2tor5').val("");
	});
	$('#limpc3tor5').click(function() {
  			$('.c3tor5').val("");
	});  
	$('#limpc4tor5').click(function() {
  			$('.c4tor5').val("");
	});  
	$('#limpc5tor5').click(function() {
  			$('.c5tor5').val("");
	});  
	$('#limpc6tor5').click(function() {
  			$('.c6tor5').val("");
	});


    //Limpiar Tornillo 6
	$('#limpc1tor6').click(function() {
  			$('.c1tor6').val("");
	});
	$('#limpc2tor6').click(function() {
  			$('.c2tor6').val("");
	});
	$('#limpc3tor6').click(function() {
  			$('.c3tor6').val("");
	});  
	$('#limpc4tor6').click(function() {
  			$('.c4tor6').val("");
	});  
	$('#limpc5tor6').click(function() {
  			$('.c5tor6').val("");
	});  
	$('#limpc6tor6').click(function() {
  			$('.c6tor6').val("");
	}); 


    //Limpiar Tornillo 7
	$('#limpc1tor7').click(function() {
  			$('.c1tor7').val("");
	});
	$('#limpc2tor7').click(function() {
  			$('.c2tor7').val("");
	});
	$('#limpc3tor7').click(function() {
  			$('.c3tor7').val("");
	});  
	$('#limpc4tor7').click(function() {
  			$('.c4tor7').val("");
	});  
	$('#limpc5tor7').click(function() {
  			$('.c5tor7').val("");
	});  
	$('#limpc6tor7').click(function() {
  			$('.c6tor7').val("");
	});  
});    