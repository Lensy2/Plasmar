<?php 
$carpetaAdjunta="R:/foto_multas/";

// Contar envían por el plugin
$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
$infoImagenesSubidas = array();
for($i = 0; $i < $Imagenes; $i++) {

	// El nombre y nombre temporal del archivo que vamos para adjuntar
	$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
	$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
	
	$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
	move_uploaded_file($nombreTemporal,$rutaArchivo);
	
	$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar_foto.php","key"=>$nombreArchivo);
	$ImagenesSubidas[$i]="<img  height='120px'  src='ftp://192.168.2.8/NAS_Public/SCPBD/foto_multas/$nombreArchivo' class='file-preview-image'>";
}
$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			 "initialPreview"=>$ImagenesSubidas);
echo json_encode($arr);
?>