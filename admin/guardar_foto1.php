<?php include "funcion_CROP1.php" ;

function guardar_foto($name,$tmp,$t1w,$t1h,$t2w,$t2h,$t3w,$t3h,$RUTA,$id,$nombre_imagen,$tabla,$campo,$link){

$ext=extension($name);
if($ext!=""){	
                            $actual_image_name =$nombre_imagen.$id.".".strtolower($ext);
							if(move_uploaded_file($tmp,$RUTA.$actual_image_name))
								{
									 if($ext=="png"){
												
												if(imagecreatefrompng($RUTA.$actual_image_name)){
														  
														   CROP($actual_image_name,$RUTA,$t1w,$t1h,1);
														   CROP($actual_image_name,$RUTA,$t2w,$t2h,2);
														   CROP($actual_image_name,$RUTA,$t3w,$t3h,3);
mysqli_query($link,"update ".$tabla." set ".$campo."='".$actual_image_name."'  where id=".$id."") or die ("error subir foto png".mysqli_error($link));
														    
														}
														else{
															  $sms="formato .PNG invalido, no es un .png valido";
															}
									}else{
														   
														   CROP($actual_image_name,$RUTA,$t1w,$t1h,1);
														   CROP($actual_image_name,$RUTA,$t2w,$t2h,2);
														   CROP($actual_image_name,$RUTA,$t3w,$t3h,3);
														   
														  
mysqli_query($link,"update ".$tabla." set ".$campo."='".$actual_image_name."'  where id=".$id."") or die ("error subir foto jpg".mysqli_error($link));
															
															
															
													   }
												  
									 }// fin move_uploaded_file
									  
}else{
	 $sms="Imagen invalida, solo formatos .jpg o .png";
	}			


return $sms;	
}
?>