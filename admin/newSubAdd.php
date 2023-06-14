<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$items = json_decode($datos);
  
$sql = "update subcategorias set nombre_es='".json_encode($items->object)."' where id=".$items->id.""; 

$sub = mysqli_query($link, $sql);

if($sub){
	echo json_encode(array("success"=>"Se ha creado correctamente"));
}else{
	echo json_encode($sql);
}
?>