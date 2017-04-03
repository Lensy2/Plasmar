<?php 
	
function rutaRecursos($var){
  if ($var == 'primer_nivel'){
    $enlace = '../AdminLTE';
  }
  elseif ($var == 'segundo_nivel'){
    $enlace = '../../AdminLTE';
  }
  
  return $enlace;
}

function tipoPedidoEtiqueta($var){
  if ($var == 'ext_laminacion') { 
    $tipoPed_Etq = 'EXL';
  }
  elseif ($var == 'ext_normal'){  
    $tipoPed_Etq = 'EXT';
  }
    return $tipoPed_Etq;
} 

function rutaCyrel($query){
  $nomCyrel = $query;
  switch ($nomCyrel) {
    case 'hestia\ofimatica\plasmar\producci\cirel0.bmp':
      $numCyrel = 'cirel0.bmp';
      break;
    
    case 'hestia\ofimatica\plasmar\producci\cirel1.bmp':
      $numCyrel = 'cirel1.bmp';
      break;

    case 'hestia\ofimatica\plasmar\producci\cirel2.bmp':
      $numCyrel = 'cirel2.bmp';
      break;

    case 'hestia\ofimatica\plasmar\producci\cirel3.bmp':
      $numCyrel = 'cirel3.bmp';
      break;

    case 'hestia\ofimatica\plasmar\producci\cirel4.bmp':
      $numCyrel = 'cirel4.bmp';
      break;  
  }
  return $numCyrel;
}

function rutaBobina($query){
  $nomBob = $query;
  switch ($nomBob) {
    case 'hestia\ofimatica\plasmar\producci\impresio0.bmp':
      $numBob = 'impresio0.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio1.bmp':
      $numBob = 'impresio1.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio2.bmp':
      $numBob = 'impresio2.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio3.bmp':
      $numBob = 'impresio3.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio4.bmp':
      $numBob = 'impresio4.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio5.bmp':
      $numBob = 'impresio5.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio6.bmp':
      $numBob = 'impresio6.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio7.bmp':
      $numBob = 'impresio7.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio8.bmp':
      $numBob = 'impresio8.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio9.bmp':
      $numBob = 'impresio9.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio10.bmp':
      $numBob = 'impresio10.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio11.bmp':
      $numBob = 'impresio11.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio12.bmp':
      $numBob = 'impresio12.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio13.bmp':
      $numBob = 'impresio13.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio14.bmp':
      $numBob = 'impresio14.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio15.bmp':
      $numBob = 'impresio15.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio16.bmp':
      $numBob = 'impresio16.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\impresio99.bmp':
      $numBob = 'impresio99.bmp';
      break; 
  }
  return $numBob;
}

function rutaMontaje($query){

  $numMont = $query;
  switch ($numMont) {
    case 'hestia\ofimatica\plasmar\producci\refilado0.bmp':
      $numMont = 'refilado0.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado1.bmp':
      $numMont = 'refilado1.bmp';
      break;

    case 'hestia\ofimatica\plasmar\producci\refilado2.bmp':
      $numMont = 'refilado2.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado3.bmp':
      $numMont = 'refilado3.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado4.bmp':
      $numMont = 'refilado4.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado5.bmp':
      $numMont = 'refilado5.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado6.bmp':
      $numMont = 'refilado6.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado7.bmp':
      $numMont = 'refilado7.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado8.bmp':
      $numMont = 'refilado8.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\refilado888.bmp':
      $numMont = 'refilado888.bmp';
      break;
    }
return $numMont;
}

function rutaBoca($query){

  $nomBoc = $query;
  switch ($nomBoc) {
    case 'hestia\ofimatica\plasmar\producci\bocadebajo.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocadebajo.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\bocaderecha.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaderecha.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\bocaencima.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaencima.bmp';
      break;
    case 'hestia\ofimatica\plasmar\producci\bocaizquierda.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaizquierda.bmp';
      break;
      case 'hestia\ofimatica\apps\producci\bocadebajo.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocadebajo.bmp';
      break;
    case 'hestia\ofimatica\apps\producci\bocaderecha.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaderecha.bmp';
      break;
    case 'hestia\ofimatica\apps\producci\bocaencima.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaencima.bmp';
      break;
    case 'hestia\ofimatica\apps\producci\bocaizquierda.bmp':
      $nomBoc = 'ftp://192.168.0.19/apps/producci/bocaizquierda.bmp';
      break;

    }
return $nomBoc;
}

function rutaPlano($query)
{
  $planoMec = trim($query);
  $nombre_fichero = 'ftp://192.168.0.5/PlanoMecanico/Pruebas/JPG PRODUCCION/'.$planoMec.'.jpg';

  if (file_exists($nombre_fichero)) {
    echo "<a href='#' class='btn btn-app' data-toggle='modal' data-target='#modalPlano' >
                    <span class='badge bg-green'>Disponible</span>
                    <i class='fa fa-map-o'></i> Plano Mecánico
    </a>";   
    return $planoMec;
  } else {
      echo "<a href='#' class='btn btn-app' data-toggle='modal' data-target='#' disabled>
                    <span class='badge bg-red'>No disponible</span>
                    <i class='fa fa-map-o'></i> Plano Mecánico
    </a>"; 
  }
}

function armarRodillo($posicion){  
  if($posicion == 1){
    echo 'checked="checked"';
  }elseif ($posicion == 0) {
    echo '';
  }
}

