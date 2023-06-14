<?php session_start(); include "conex.php";
$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));
$dolar=$informativos["dolar"];
//+58 (412) 825 6644
$telefono = str_replace("(", "", $informativos["telefono1"]);
$telefono = str_replace(")", "", $telefono);
$telefono = str_replace(" ", "", $telefono);

 
if(isset($_POST["btn_pedido"])){
	
if(!isset($_SESSION["aux"])){?>

<script>window.location=URL+"/";</script>

<?php }else{
	
$codigo=generarCodigo(8);	


$shipping = mysqli_fetch_assoc(mysqli_query($link,"select * from envio where nombre_es='".$_POST["shipping"]."' " ));


if(
	isset($_SESSION["cupon_descuento"]) &&
		isset($_SESSION["cupon_total"]) &&
			isset($_SESSION["cupon_code"]) &&
				isset($_SESSION["cupon_id"])
	    
	){

	mysqli_query($link,"insert into orden 

	values(
		NULL,
		NULL,
		'por_pagar',
		".$shipping["id"].",
		NOW(),
		NULL,
		0,
		NULL,
		NULL,
		'".$_POST["payment"]."',
		'".$codigo."',
		'".$_POST["address"]."',
		'".$_POST["name"]."',
		'".$_POST["lastname"]."',
		'".$_POST["phone"]."',
	".$_SESSION["cupon_descuento"].",
	".$_SESSION["cupon_total"].",
	".$_SESSION["cupon_id"].",
	'".$_SESSION["cupon_code"]."',
	'".$_POST["email"]."'
	
	
	) ") or die("error 1");


	

}else{

	mysqli_query($link,"insert into orden 

	values(NULL,NULL,'por_pagar',".$shipping["id"].",NOW(),NULL,0,NULL,NULL,'".$_POST["payment"]."','".$codigo."','".$_POST["address"]."','".$_POST["name"]."','".$_POST["lastname"]."','".$_POST["phone"]."',NULL,NULL,NULL,NULL,'".$_POST["email"]."') ") or die("error 2");

}


$id=mysqli_insert_id($link);	
	
$consulta=mysqli_query($link,"select * from _carrito where aux=".$_SESSION["aux"]."");

while($row=mysqli_fetch_assoc($consulta)){

   mysqli_query($link,"insert into orden_carrito values(NULL,".$row["id_producto"].",".$row["cantidad"].",".$row["precio"].",NOW(),".$id.",".$row["id_talla"].")");
   
   $cdes=$row["cantidad"];
   //descuento del inventario -> productos ->
   mysqli_query($link,"update productos_tallas set stock_actual=stock_actual-".$cdes." where id=".$row["id_producto"]." and id_talla=".$row["id_talla"]."");
  
}



// PEDIDO AL WhatsApp
$buscar=mysqli_query($link,"select * from _carrito where  aux=".$_SESSION["aux"]." ");

$total = 0;
$info = "";
while($row = mysqli_fetch_assoc($buscar)){
	
	$producto = mysqli_fetch_assoc(mysqli_query($link,"select * from productos where id=".$row["id_producto"]." "));

	$precio = $producto["precio"];
	$precioF = $precio * $dolar; 
				
	if($producto["descuento"] > 0){
							
		$precioNew = ($producto["precio"] - ($producto["precio"] * $producto["descuento"]) / 100);
		
		$precioFWithDescount = 	$precioNew	* $dolar; 				
	}else{
		
		$precioFWithDescount = 0;
		$precioNew = 0;
	}

	$multiplicador = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where id_producto = ".$producto["id"]." and id_talla=".$row["id_talla"]." and estatus= 'si' "));

	$tallas = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `tallas` where id=" . $row["id_talla"] . " "));

	$total += $producto["descuento"] > 0
	? ($precioFWithDescount * $multiplicador["multiplicador"]) * $row["cantidad"]
	: ($precioF * $multiplicador["multiplicador"]) * $row["cantidad"];
	
	$info .= "*".$row["cantidad"]."*  x ".$producto['nombre_es']." [".$tallas["nombre_es"]."] *|* ( ".fpreciosD($row["precio"] * $multiplicador["multiplicador"] )." ".$informativos["moneda"]." )%0D%0A";

}	



if(
	isset($_SESSION["cupon_descuento"]) &&
		isset($_SESSION["cupon_total"]) &&
			isset($_SESSION["cupon_code"]) &&
				isset($_SESSION["cupon_id"])
	    
	){


// update cupones
mysqli_query($link, "update cupones set total_aplicados=total_aplicados+1 where id=".$_SESSION["cupon_id"]."");

$text = "
*Nuevo pedido* 🛵 *(".$_SERVER["HTTP_HOST"].")* %0D%0A%0D%0A

".$info."

*SubTotal ".$informativos["moneda"].":* ".fpreciosD($total)."%0D%0A

*Cupon aplicado:* ".fpreciosD($_SESSION["cupon_descuento"])." ".$informativos["moneda"]."%0D%0A

*Total en ".$informativos["moneda"].":* ".fpreciosD($_SESSION["cupon_total"])."%0D%0A


*Forma de entrega:* ".$_POST["shipping"]."%0D%0A
*Metodo de Pago:* ".$_POST["payment"]."%0D%0A%0D%0A

=====*Datos del Cliente*=====%0D%0A%0D%0A

👤 ".$_POST["name"]." ".$_POST["lastname"]." %0D%0A
📱 ".$_POST["phone"]."%0D%0A
📍 *Direccion:* ".$_POST["address"]."%0D%0A
📍 *Punto de referencia:* ".$_POST["referencia"]."%0D%0A
📍 *Ciudad:* ".$_POST["city"]."%0D%0A
📝****%0D%0A%0D%0A

Por favor confirme mediante respuesta.%0D%0A%0D%0A

-----------------------------%0D%0A
(¡Gracias por su pedido!)%0D%0A%0D%0A

*Recuerde cancelar con el método de pago seleccionado!* %0D%0A%0D%0A

*".$_POST["payment"].":* %0D%0A

	(Ingresar Datos de Pago Manualmente) %0D%0A%0D%0A
	
	(Adjuntar la captura del pago por favor con este mensaje.) %0D%0A%0D%0A

";

	}else{

		$text = "
		*Nuevo pedido* 🛵 *(".$_SERVER["HTTP_HOST"].")* %0D%0A%0D%0A
		
		".$info."
		
		
		*Total en ".$informativos["moneda"].":* ".fpreciosD($total)."%0D%0A
		
		
		*Forma de entrega:* ".$_POST["shipping"]."%0D%0A
		*Metodo de Pago:* ".$_POST["payment"]."%0D%0A%0D%0A
		
		=====*Datos del Cliente*=====%0D%0A%0D%0A
		
		👤 ".$_POST["name"]." ".$_POST["lastname"]." %0D%0A
		📱 ".$_POST["phone"]."%0D%0A
		📍 *Direccion:* ".$_POST["address"]."%0D%0A
		📍 *Punto de referencia:* ".$_POST["referencia"]."%0D%0A
		📍 *Ciudad:* ".$_POST["city"]."%0D%0A
		📝****%0D%0A%0D%0A
		
		Por favor confirme mediante respuesta.%0D%0A%0D%0A
		
		-----------------------------%0D%0A
		(¡Gracias por su pedido!)%0D%0A%0D%0A
		
		*Recuerde cancelar con el método de pago seleccionado!* %0D%0A%0D%0A
		
		*".$_POST["payment"].":* %0D%0A
		
		(Ingresar Datos de Pago Manualmente) %0D%0A%0D%0A
		
		(Adjuntar la captura del pago por favor con este mensaje.) %0D%0A%0D%0A
		
		";

	}


// DELETE DATA

mysqli_query($link,"delete from _carrito where aux=".$_SESSION["aux"]."");

unset($_SESSION['aux']);
unset($_SESSION["cupon_descuento"]);
unset($_SESSION["cupon_total"]);
unset($_SESSION["cupon_code"]);
unset($_SESSION["cupon_id"]);

	 
	
 }	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php  include "partials_Meta.php"; ?>
    <title><?=$informativos["nombre_pagina"]?></title>

    <?php  include "partials_FONTS.php"; ?>

	<?php  include "partials_STYLES.php"; ?>

	<!-- SPECIFIC CSS -->
    <link href="css/checkout.css" rel="stylesheet">

</head>

<body>
	
	<div id="page">
		
	<?php  include "partials_Header.php"; ?>
	<!-- /header -->
	
	<main class="bg_gray">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-5">
					<div id="confirm">
					
					<h2><?=translate("Pedido Creado!", "Request Created!")?></h2>
						<div class="icon icon--order-success svg add_bottom_15">
							<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
								<g fill="none" stroke="#8EC343" stroke-width="2">
									<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
									<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
								</g>
							</svg>
						</div>
					
					<a class="btn_1" style="background-color:#ffc107;color:#222" target="_blank" href="https://api.whatsapp.com/send?phone=<?=$telefono?>&amp;text=<?=$text?>"><?=translate("Enviar pedido al WhatsApp", "Send order to WhatsApp")?></a>
					
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->
	
	<?php  include "partials_FOOTER.php" ?>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    	<?php  include "partials_JS.php" ?>

		
</body>
</html>