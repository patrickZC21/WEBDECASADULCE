<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$item = json_decode($datos);

$sub = mysqli_fetch_assoc(mysqli_query($link,"select nombre_es from subcategorias where id=".$item->id.""));

echo json_encode($sub["nombre_es"]);
?>