$( function() { $( "#tabs" ).tabs(); } );

//Carga de grid del reporte [Por Referencia y Marca]
$("body").on("click","button#btnGridPorProceso", function(e){
  
  var get = 1;
  var datosProd = 'get='+get; 
    var $contenidoAjax = $('div#gridPorProceso').html('<p style="text-align:center;"><img src="loader.gif" /></p>');
    $.ajax({
      data: datosProd,
      url: 'lista_por_proceso.php',
      success: function(data) { // Aquí desaparece la imagen ya que estamos reemplazando todo el HTML del contenido de la div. 
        $contenidoAjax.html(data);
        if (data != 'No hay Data') {
          var tablaProductos = $('#gridListaPorProceso').DataTable({
          	"order": [[ 2, "desc" ]]
          });          
        }    
      }
    });

  e.preventDefault();
});

//Carga de grid del reporte [Por Referencia y Marca]
$("body").on("click","button#btnGridPorPersona", function(e){
  
  var get = 1;
  var datosProd = 'get='+get; 
    var $contenidoAjax = $('div#gridPorPersona').html('<p style="text-align:center;"><img src="loader.gif" /></p>');
    $.ajax({
      data: datosProd,
      url: 'lista_por_persona.php',
      success: function(data) { // Aquí desaparece la imagen ya que estamos reemplazando todo el HTML del contenido de la div. 
        $contenidoAjax.html(data);
        if (data != 'No hay Data') {
          var tablaProductos = $('#gridListaPorPersona').DataTable({
          	"order": [[ 2, "desc" ]]
          });          
        }    
      }
    });

  e.preventDefault();
});

//Carga de grid del reporte [Por Referencia y Marca]
$("body").on("click","button#btnGridPorAfecta", function(e){
  
  var get = 1;
  var datosProd = 'get='+get; 
    var $contenidoAjax = $('div#gridPorAfecta').html('<p style="text-align:center;"><img src="loader.gif" /></p>');
    $.ajax({
      data: datosProd,
      url: 'lista_por_sistema.php',
      success: function(data) { // Aquí desaparece la imagen ya que estamos reemplazando todo el HTML del contenido de la div. 
        $contenidoAjax.html(data);
        if (data != 'No hay Data') {
          var tablaProductos = $('#gridListaPorAfecta').DataTable({
          	"order": [[ 1, "desc" ]]
          });          
        }    
      }
    });

  e.preventDefault();
});