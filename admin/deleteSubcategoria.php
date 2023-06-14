<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$item = json_decode($datos);

$sub = mysqli_query($link,"delete from  subcategorias where id=".$item->id."");


if($sub){
	echo json_encode('Correcto');
}else{
	echo json_encode('Error');
}

?>