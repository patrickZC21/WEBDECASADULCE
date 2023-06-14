<?php include "funcion_CROP.php" ;

function guardar_foto($name,$tmp,$thumb_width,$thumb_height,$RUTA,$id,$nombre_imagen,$tabla,$campo){

$ext=extension($name);
if($ext!=""){	
                            $actual_image_name =$id.$nombre_imagen.".".strtolower($ext);
							if(move_uploaded_file($tmp,$RUTA.$actual_image_name))
								{
									 if($ext=="png"){
												
												if(imagecreatefrompng($RUTA.$actual_image_name)){
														  
														   CROP($actual_image_name,$RUTA,$thumb_width,$thumb_height);
														   mysqli_query($link,"update ".$tabla." set ".$campo."='".$actual_image_name."'  where id=".$id."") or die ("error subir foto ".mysql_query());
														}
														else{
															  $sms="formato .PNG invalido, no es un .png valido";
															}
									}else{
														   
														    CROP($actual_image_name,$RUTA,$thumb_width,$thumb_height);
														    mysqli_query($link,"update ".$tabla." set ".$campo."='".$actual_image_name."'  where id=".$id."") or die ("error subir foto ".mysql_query());
													   }
												  
									 }// fin move_uploaded_file
									  
}else{
	 $sms="Imagen invalida, solo formatos .jpg o .png";
	}			


return $sms;	
}
?>