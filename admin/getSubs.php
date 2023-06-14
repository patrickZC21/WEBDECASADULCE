<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$item = json_decode($datos);

$sub = mysqli_query($link,"select * from subcategorias where id_categoria=".$item->id."");

$json = array();
while($row = mysqli_fetch_assoc($sub)){
	
	$json[] = array("id" => $row["id"], "subcategorias" => $row['nombre_es']);
	$i++;
}

echo json_encode($json);
?>