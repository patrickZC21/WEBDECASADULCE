<?php include "../conex.php" ;

$datos=file_get_contents('php://input');

$items = json_decode($datos);

$obj = json_encode(array("padre"=>$items->subcategoria));

$sql = "insert into subcategorias (id_categoria,nombre_es,nombre_en) values(

".$items->id.",
'".$obj."','".$obj."'
)";

$sub = mysqli_query($link,$sql);

if($sub){
	echo json_encode(array("success"=>1));
}else{
	echo json_encode($sql);
}
?>