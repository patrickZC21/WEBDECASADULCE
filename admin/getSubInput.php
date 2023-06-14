<?php require "../conex.php";


$sql = mysqli_query($link,"select * from subcategorias where id_categoria=".mysqli_real_escape_string($link,$_GET["id"])."");

//$sql = mysqli_query($link,"select * from subcategorias where id=14");



$json = array();

while($row = mysqli_fetch_assoc($sql)){
	
	$json[] = array("id"=>$row["id"], "subcategorias" => $row['nombre_es']);
	
}

echo json_encode($json);

?>