<?php
function CROP($actual_image_name,$RUTA,$thumb_width,$thumb_height,$num){
$tipo=explode(".",$actual_image_name);
if($tipo[1]=="jpg" or $tipo[1]=="jpeg" or $tipo[1]=="JPG"){
$image = imagecreatefromjpeg($RUTA.$actual_image_name);
	}elseif($tipo[1]=="png"){
$image = imagecreatefrompng($RUTA.$actual_image_name);
		}

$filename = $RUTA.$num."_".$actual_image_name;

//echo $filename." w: ".$thumb_width." h: ".$thumb_height;exit();

$width = imagesx($image);
$height = imagesy($image);

$original_aspect = $width / $height;
$thumb_aspect = $thumb_width / $thumb_height;

if ( $original_aspect >= $thumb_aspect )
{
   // If image is wider than thumbnail (in aspect ratio sense)
   $new_height = $thumb_height;
   $new_width = $width / ($height / $thumb_height);
}
else
{
   // If the thumbnail is wider than the image
   $new_width = $thumb_width;
   $new_height = $height / ($width / $thumb_width);
}

$thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

// Resize and crop
imagecopyresampled($thumb,
                   $image,
                   0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                   0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                   0, 0,
                   $new_width, $new_height,
                   $width, $height);

 imagejpeg($thumb, $filename);
//imagedestroy($thumb);
}

?>