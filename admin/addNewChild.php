<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$item = json_decode($datos);

$sub = mysqli_query($link,"update subcategorias set nombre_es='".json_encode($item->data)."' where id=".$item->id."");


mysqli_query($link,"update productos set idInside=idInside+1 where idInside >= ".$item->mark." and id_subcategoria=".$item->id."");


if($sub){
	echo json_encode('Se ha procesado correctamente');
}else{
	echo json_encode('Ha ocurrido un error');
}
?>

