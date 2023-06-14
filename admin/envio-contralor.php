<?php session_start();include "../conex.php";
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') && isset($_POST['accion'])){   	
 
	$devolver = null;
	$consulta = '';
	$accion = $_POST['accion'];
	switch($accion){
		
		case 'ordenar':{ // Ordenar los elementos
			$puntos = explode(',',$_POST['puntos']);
            $consulta = 'UPDATE envio SET orden = CASE id '.PHP_EOL;
        	foreach ($puntos as $index => $id){
            	$idPunto = explode('-', $id);
            	$idPunto = mysqli_real_escape_string($link,$idPunto[1]);
            	$orden = mysqli_real_escape_string($link, ($index + 1));
                $consulta .= 'WHEN '.$idPunto.' THEN '.$orden.''.PHP_EOL;
        	}
            $consulta .= 'ELSE orden'.PHP_EOL.'END';
            echo $consulta;
        	if (mysqli_query($link, $consulta)){
				$devolver = array ('realizado' => true);
			}			
			break;
		}
	}
	if ($devolver)
		echo json_encode($devolver);
}
else {
	die('No se está accediendo correctamente');
}
?>