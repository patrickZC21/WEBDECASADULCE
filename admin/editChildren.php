<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$item = json_decode($datos);

$obtenerSub = mysqli_fetch_assoc(mysqli_query($link,"select * from subcategorias where id=".$item->id." "));

$nombre_es = str_replace($item->item, $item->newSubcategory, $obtenerSub["nombre_es"]);


//{"padre":"VideoJuegos","hijos":[{"nombre":"Consolas","hijos":[{"nombre":"PlayStation 5"},{"nombre":"Xbox Series X"},{"nombre":"Nintendo Switch"}]},{"nombre":"Controles","hijos":[{"nombre":"PlayStation 5 DualSense"}]},{"nombre":"Juegos"}]}

//$nombre_es->padre = $item->newSubcategory;



//$json = json_encode($nombre_es);

mysqli_query($link,"update subcategorias set nombre_es='".$nombre_es."' where id=".$item->id."");


echo json_encode('Se ha modificado correctamente!');
?>