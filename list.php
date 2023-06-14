<?php session_start(); include "conex.php";
$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));


$categoria = mysqli_fetch_assoc(mysqli_query($link,"select * from categorias where id=".$_GET["c"].""));


$avisos_por_pagina=12;



if( (isset($_GET["p"])) && ($_GET["p"]!=""))
{ 

$_SESSION["pagina"]=$_GET["p"]-1;
$_SESSION["aux3"]=$_SESSION["pagina"]*$avisos_por_pagina;
$dot="../";

}else{
	$_SESSION["aux3"]=0;
	$dot="./".url($categoria["nombre_es"])."-".$categoria["id"].".html/";
}



 
 //echo "select * from productos where id_categoria =".$_GET["c"]." limit ".$_SESSION["aux3"].",".$avisos_por_pagina." ";
 
 $listado = mysqli_query($link,"select * from productos where id_categoria =".$_GET["c"]." limit ".$_SESSION["aux3"].",".$avisos_por_pagina." ");
 
 $count = mysqli_num_rows($listado);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php  include "partials_Meta.php" ?>
    <title><?=$informativos["nombre_pagina"]?></title>

    <?php  include "partials_FONTS.php" ?>
	
	<?php  include "partials_STYLES.php" ?>


	<!-- SPECIFIC CSS -->
    <link href="<?=URL?>/css/listing.css" rel="stylesheet">
	<link href="<?=URL?>/css/product_page.css" rel="stylesheet">
</head>

<body>
	
	<div id="page" class="theia-exception">
		
	<?php  include "partials_Header.php" ?>
	<!-- /header -->
		
	<main>
		<div class="top_banner">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
				<div class="container">
					<div class="breadcrumbs">
						<ul>
							<li><a href="/"><?=translate("Inicio", "Home")?></a></li>
							<li><a href="/"><?=translate("Categor&iacute;a", "Category")?></a></li>
							<li><?=translate("P&aacute;gina activa", "Active page")?></li>
						</ul>
					</div>
					<h1><?=$categoria["nombre_".$_SESSION["idioma"].""]?></h1>
				</div>
			</div>
			<img src="<?=URL?>/images/<?=$categoria["foto"]?>" class="img-fluid" alt="">
		</div>
		<!-- /top_banner -->
			
			
			<div class="container margin_30">
			
			<div class="row">
				
				
				<div class="col-lg-12">
					<div class="row small-gutters">
					
					<?php  if($count > 0) {

						while($rows = mysqli_fetch_assoc($listado)){
			
							$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=".$rows["id"]." order by orden ASC limit 0,1"));
							
							$talla = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `productos_tallas` where estatus='si' and id_producto=".$rows["id"]."  order by id ASC limit 0,1"));
							
							$id_talla = $talla["id_talla"];

							 // Reviews

							 $reviews = mysqli_query($link, "select * from reviews where product_id=" . $rows["id"] . "  ");

							 $estrellas = "";
							 $promedio = 0;
					 
							 if($reviews){
								 $filas = mysqli_num_rows($reviews);
					 
								 if($filas > 0){
					 
									 $valor=0;
					 
									 while($data = mysqli_fetch_assoc($reviews)){
										 $valor+=$data["rating"];
									 }
					 
									 $promedio = $valor / $filas;
									  
								 }
							 }
					 
							 for($i = 1; $i < 6; $i++){
																							 
								 if($promedio>= $i) {
									 $estrellas.='<i class="icon-star"></i> ';
								 } else{
									 $estrellas.='<i class="icon-star empty"></i>';
								 }
											 
							 }
					 
							 $rows['stars'] = $estrellas;

						?>
					
							<div class="col-6 col-md-2">
							<div class="grid_item">
						<figure>
						<?php  if($rows["descuento"] > 0){
						?>
							<span class="ribbon off">-<?=number_format($rows["descuento"], 0)?>%</span>
						<?php 						
						}  ?>
						
							<a href="<?=URL?>/<?=url($rows["nombre_es"])?>-<?=ucfirst($rows["id"])?>.html">
								<img class="img-fluid lazy" src="<?=URL?>/items/<?=$pic["foto"]?>" data-src="<?=URL?>/items/<?=$pic["foto"]?>" alt="" width="400" height="400">
							</a>
							
						
						<?php  if($rows["descuento"] > 0){
							$fecha_caduca = str_replace("-","/",$rows["descuento_caduca"]);
						?>
							<div data-countdown="<?=$fecha_caduca?>" class="countdown"></div>
						<?php 						
						}  ?>
							
							
						</figure>
						<a href="<?=URL?>/<?=url($rows["nombre_".$_SESSION["idioma"].""])?>-<?=ucfirst($rows["id"])?>.html">
							<h3><?=$rows["nombre_".$_SESSION["idioma"].""]?></h3>
						</a>
						<div class="price_box">
						
						<?php 

						$precio = $rows["precio"]; $dolar=$informativos["dolar"]; $precioF = $precio * $dolar; 
						
						if($rows["descuento"] > 0){
							
						$precioNew = ($rows["precio"] - ($rows["precio"] * $rows["descuento"]) / 100); $dolar=$informativos["dolar"];
						$precioFWithDescount = 	$precioNew	* $dolar; 				
							
						?>
							
							<span class="new_price"><?php echo fpreciosD($precioFWithDescount); echo " ";   ?><?=translate($informativos["moneda"], "usd$")?></span>
							<span class="old_price"><?php echo fpreciosD($precioF); echo " ";   ?><?=translate($informativos["moneda"], "usd$")?></span>
						<?php 						
						}else{?>
							
							<span class="new_price"><?php echo fpreciosD($precioF); echo " ";  ?><?=translate($informativos["moneda"], "usd$")?> </span>
						
						<?php }  ?>


<div class="review_content" style="display:flex; gap:10px;align-items:center;justify-content:center">
						<span class="rating"><?=$rows["stars"]?></span>
						<span>En Stock</span>
</div>

						<div style="margin-top:10px">
						<button id="decrement-btn<?=$rows["id"]?>" style="border: 1px solid #ffb808; border-radius: 5px 0px 0px 5px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						>-</button>


							<input onlyRead style="width:40px; text-align: center; border:none; height:30px" id="quantity-input<?=$rows["id"]?>" value="0">


						<button id="increment-btn<?=$rows["id"]?>" style="border: 1px solid #ffb808; border-radius: 0px 5px 5px 0px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						 
						>+</button>
</div>							
							
						</div>
						<ul>

						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"
							onclick="guardarFavorito({
								id:<?=$rows['id']?>,
								nombre_es:'<?=$rows['nombre_es']?>',
								nombre_en:'<?=$rows['nombre_en']?>',
								precio:'<?=$rows['precio']?>',
								image:'<?=URL . '/items/' .$pic['foto']?>',
								id_talla:'<?=$id_talla?>',
							})"
							>
							
							<i class="ti-heart"></i><span><?=translate("Agregar a favoritos", "Add to favorites")?></span></a></li>


							<li><a href="#0" rel="<?=$rows["id"]?>-<?=$id_talla?>" onClick="addItemToCart(<?=$rows["id"]?>,<?=$id_talla?>)"  class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Agregar al carrito</span></a></li>
						</ul>
					</div>
							<!-- /grid_item -->
						</div>
						<!-- /col -->
						<script>
		 

						document.getElementById("decrement-btn<?=$rows["id"]?>").addEventListener("click", async () => {
							let quantity = parseInt(document.getElementById("quantity-input<?=$rows["id"]?>").value);

							if (quantity > 0) {
								
								if(quantity === 1) {
									if(confirm('Estas seguro de eliminar el producto del carrito?')){
										
										const data = await(await fetch(`<?= URL ?>/deleteItemFromCartByIdProduct.php`, {
										method: 'post',
										headers: {
											'content-Type' : 'application/json'
										},
										body: JSON.stringify({id:<?=$rows["id"]?>})
										})).json();


										updateCart();

										quantity--;
										document.getElementById("quantity-input<?=$rows["id"]?>").value = quantity.toString();

									}
								} else{
										removeItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>);

										quantity--;
										document.getElementById("quantity-input<?=$rows["id"]?>").value = quantity.toString();

								}
								
								
							}
						});

						document.getElementById("increment-btn<?=$rows["id"]?>").addEventListener("click", () => {
							
							let quantity = parseInt(document.getElementById("quantity-input<?=$rows["id"]?>").value);
							if (quantity < 999) {
								quantity++;
								document.getElementById("quantity-input<?=$rows["id"]?>").value = quantity.toString();
								addItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>);
							}
						});
</script>				
					<?php }	?>
					<?php }else{
						
						echo '<h2>No hay productos por ahora.</h2>';
					}	?>
						
						
					</div>
					
					<?php  if($count > 0) { 
					
					 $list = mysqli_query($link,"select * from productos where id_categoria =".$_GET["c"]."");
					 
					 $countList = mysqli_num_rows($list);
					$cantidad=ceil($countList/$avisos_por_pagina);

					
					?>
					<div class="pagination__wrapper">
						<ul class="pagination">
						
						<?php   for($i=0;$i<$cantidad;$i++){ $ii=$i+1; ?>
                    
						<li   >
							<a <?php  if($_SESSION["pagina"]==$i){?> class="active" <?php }  ?> 
							href="<?=$dot?>page/<?=$ii?>"  style="cursor:pointer"  ><?=$ii?> </a>
						</li>
						
					<?php 	} ?>
							
						</ul>
					</div>
					
					<?php  } ?>
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->			
				
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->
	
	<?php  include "partials_FOOTER.php" ?>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<?php  include "partials_JS.php" ?>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="js/sticky_sidebar.min.js"></script>
	<script src="js/specific_listing.js"></script>
		
</body>
</html>