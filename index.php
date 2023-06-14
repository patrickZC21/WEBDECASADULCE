<?php session_start();

include "conex.php";

if (!isset($_SESSION["idioma"])) {
	$_SESSION["idioma"] = "es";
}

if (isset($_GET["idioma"])) {
	$_SESSION["idioma"] = $_GET["idioma"];
}

$informativos = mysqli_fetch_assoc(mysqli_query($link, "select * from _informativos where id=1"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "partials_Meta.php" ?>
	<title><?= $informativos["nombre_pagina"] ?> - Sistema de Pedidos Digitales</title>

	<?php include "partials_FONTS.php" ?>

	<?php include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
	<link href="<?= URL ?>/css/home_1.css" rel="stylesheet">
	<link href="<?=URL?>/css/product_page.css" rel="stylesheet">

</head>

<body>

	<div id="page">

		<?php include "partials_Header.php" ?>

		<main>
			<?php include "partials_Slider.php" ?>

			<ul id="banners_grid" class="clearfix">
				<?php $cat = mysqli_query($link, "select * from  categorias order by orden ASC");
				while ($rows = mysqli_fetch_assoc($cat)) {
				?>

					<li>
						<a href="<?= URL ?>/listados/<?= url($rows["nombre_es"]) ?>-<?= $rows["id"] ?>.html" class="img_container">
							<img src="<?= URL ?>/images/<?= $rows["foto"] ?>" data-src="<?= URL ?>/images/<?= $rows["foto"] ?>" alt="" class="lazy">
							<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
								<h3><?= $rows["nombre_" . $_SESSION["idioma"] . ""] ?></h3>
								<div><span class="btn_1"><?= translate("IR", "GO") ?></span></div>
							</div>
						</a>
					</li>
				<?php 	 }		 ?>


			</ul>
			<!--/banners_grid -->

			<div class="container margin_60_35">
				<div class="main_title">
					<h2><?= translate("Nuevos", "New") ?></h2>
					<span><?= translate("Productos", "Products") ?></span>
					<p></p>
				</div>
				<div class="row small-gutters">
					<?php $p = mysqli_query($link, "SELECT * FROM `productos` where estatus='si' order by id DESC limit 0,8");
					while ($rows = mysqli_fetch_assoc($p)) {

						$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=" . $rows["id"] . " order by orden ASC limit 0,1"));

						$talla = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where estatus='si' and id_producto=" . $rows["id"] . "  order by id ASC limit 0,1"));

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
						<div class="col-6 col-md-2 col-xl-3">
							<div class="grid_item">
								<figure>
									<?php if ($rows["descuento"] > 0) {
									?>
										<span class="ribbon off">-<?= number_format($rows["descuento"], 0) ?>%</span>
									<?php
									}  ?>

									<a href="<?= URL ?>/<?= url($rows["nombre_es"]) ?>-<?= ucfirst($rows["id"]) ?>.html">
										<img class="img-fluid lazy" src="<?= URL ?>/items/<?= $pic["foto"] ?>" data-src="<?= URL ?>/items/<?= $pic["foto"] ?>" alt="" style="object-fit:contain; width: 200px; height:200px">
									</a>


									<?php if ($rows["descuento"] > 0) {
										$fecha_caduca = str_replace("-", "/", $rows["descuento_caduca"]);
									?>
										<div data-countdown="<?= $fecha_caduca ?>" class="countdown"></div>
									<?php
									}  ?>


								</figure>
								<a href="<?= URL ?>/<?= url($rows["nombre_" . $_SESSION["idioma"] . ""]) ?>-<?= ucfirst($rows["id"]) ?>.html">
									<h3><?= $rows["nombre_" . $_SESSION["idioma"] . ""] ?></h3>
								</a>
								<div class="price_box">

									<?php

									$precio = $rows["precio"];
									$dolar = $informativos["dolar"];
									$precioF = $precio * $dolar;

									if ($rows["descuento"] > 0) {

										$precioNew = ($rows["precio"] - ($rows["precio"] * $rows["descuento"]) / 100);
										$dolar = $informativos["dolar"];
										$precioFWithDescount = 	$precioNew	* $dolar;

									?>

<span class="new_price"><?php echo fpreciosD($precioFWithDescount);
echo " ";
   ?><?=translate($informativos["moneda"], "usd$")?></span>
<span class="old_price"><?php echo fpreciosD($precioF);
echo " ";
   ?><?=translate($informativos["moneda"], "usd$")?></span>
 
<?php
} else { ?>

<span class="new_price"><?php echo fpreciosD($precioF);
echo " ";
  ?><?=translate($informativos["moneda"], "usd$")?> </span>



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
									<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites" onclick="guardarFavorito({
								id:<?= $rows['id'] ?>,
								nombre_es:'<?= $rows['nombre_es'] ?>',
								nombre_en:'<?= $rows['nombre_en'] ?>',
								precio:'<?= $rows['precio'] ?>',
								image:'<?= URL . '/items/' . $pic['foto'] ?>',
								id_talla:'<?= $id_talla ?>',
							})">

											<i class="ti-heart"></i><span><?= translate("Agregar a favoritos", "Add to favorites") ?></span></a></li>


									<li><a href="#0" onClick="addItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>)" rel="<?= $rows["id"] ?>-<?= $id_talla ?>" class="tooltip-1 addToCart" data-toggle="tooltip" data-placement="left" title="<?= translate("Agregar al carrito", "Add to cart") ?>"><i class="ti-shopping-cart"></i><span>
												<?= translate("Agregar al carrito", "Add to cart") ?>
											</span></a></li>
								</ul>
							</div>
							<!-- /grid_item -->
						</div>

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

					<?php } ?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->

			<?php $p = mysqli_query($link, "SELECT * FROM `productos` where  estatus='si' and especial='si'   order by id DESC limit 0,1");
			while ($rows = mysqli_fetch_assoc($p)) {

				$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=" . $rows["id"] . " order by orden ASC limit 0,1"));

				$talla = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where estatus='si' and id_producto=" . $rows["id"] . "  order by id ASC limit 0,1"));

				$id_talla = $talla["id_talla"];

			?>
				<div class="featured lazy" data-bg="url(<?= URL ?>/items/<?= $pic["foto"] ?>)">
					<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
						<div class="container margin_60">
							<div class="row justify-content-center justify-content-md-start">
								<div class="col-lg-6 wow" data-wow-offset="150">
									<h3><?php echo $rows["nombre_" . $_SESSION["idioma"] . ""]; ?></h3>
									<p><?php echo $rows["descripcion_" . $_SESSION["idioma"] . ""]; ?></p>
									<div class="feat_text_block">
										<div class="price_box">
											<?php

											$precio = $rows["precio"];
											$dolar = $informativos["dolar"];
											$precioF = $precio * $dolar;

											if ($rows["descuento"] > 0) {

												$precioNew = ($rows["precio"] - ($rows["precio"] * $rows["descuento"]) / 100);
												$dolar = $informativos["dolar"];
												$precioFWithDescount = 	$precioNew	* $dolar;

											?>

												<span class="new_price"><?php echo fpreciosD($precioFWithDescount);
 echo " ";
    ?><?=translate($informativos["moneda"], "usd$")?></span>
 <span class="old_price"><?php echo fpreciosD($precioF);
 echo " ";
   ?><?=translate($informativos["moneda"], "usd$")?></span>
											<?php
											} else { ?>

												<span class="new_price"><?php echo fpreciosD($precioF);
																		echo " ";
    ?><?=translate($informativos["moneda"], "usd$")?> </span>

											<?php }  ?>

										</div>
										<a class="btn_1" href="<?= URL ?>/<?= url($rows["nombre_es"]) ?>-<?= ucfirst($rows["id"]) ?>.html" role="button">
											<?= translate("Comprar", "Buy") ?>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /featured -->
			<?php  }  ?>
			<div class="container margin_60_35">
				<div class="main_title">
					<h2><?= translate("Destacados", "Featured") ?></h2>
					<span><?= translate("Productos", "Products") ?></span>
					<p></p>
				</div>
				<div class="owl-carousel owl-theme products_carousel">

					<?php $p = mysqli_query($link, "SELECT * FROM `productos` where  estatus='si' and destacado='si'   order by id DESC limit 0,12");
					while ($rows = mysqli_fetch_assoc($p)) {

						$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=" . $rows["id"] . " order by orden ASC limit 0,1"));

						$talla = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where estatus='si' and id_producto=" . $rows["id"] . "  order by id ASC limit 0,1"));

						$id_talla = $talla["id_talla"];

						//and stock_actual > stock_inicial


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
						<div class="item">
							<div class="grid_item">
								<figure>
									<?php if ($rows["descuento"] > 0) {
									?>
										<span class="ribbon off">-<?= number_format($rows["descuento"], 0) ?>%</span>
									<?php
									}  ?>

									<a href="<?= URL ?>/<?= url($rows["nombre_" . $_SESSION["idioma"] . ""]) ?>-<?= ucfirst($rows["id"]) ?>.html">
										<img class="img-fluid lazy" src="<?= URL ?>/items/<?= $pic["foto"] ?>" data-src="<?= URL ?>/items/<?= $pic["foto"] ?>" alt="" style="object:fit">
									</a>


									<?php if ($rows["descuento"] > 0) {
										$fecha_caduca = str_replace("-", "/", $rows["descuento_caduca"]);
									?>
										<div data-countdown="<?= $fecha_caduca ?>" class="countdown"></div>
									<?php
									}  ?>


								</figure>
								<a href="<?= URL ?>/<?= url($rows["nombre_" . $_SESSION["idioma"] . ""]) ?>-<?= ucfirst($rows["id"]) ?>.html">
									<h3><?= $rows["nombre_" . $_SESSION["idioma"] . ""] ?></h3>
								</a>
								<div class="price_box">

									<?php

									$precio = $rows["precio"];
									$dolar = $informativos["dolar"];
									$precioF = $precio * $dolar;

									if ($rows["descuento"] > 0) {

										$precioNew = ($rows["precio"] - ($rows["precio"] * $rows["descuento"]) / 100);
										$dolar = $informativos["dolar"];
										$precioFWithDescount = 	$precioNew	* $dolar;

									?>

										<span class="new_price"><?php echo fpreciosD($precioFWithDescount);
																echo " ";
    ?><?=translate($informativos["moneda"], "usd$")?></span>
										<span class="old_price"><?php echo fpreciosD($precioF);
																echo " ";
   ?><?=translate($informativos["moneda"], "usd$")?></span>
									<?php
									} else {


									?>

										<span class="new_price"><?php echo fpreciosD($precioF);
																echo " ";
    ?><?=translate($informativos["moneda"], "usd$")?> </span>

									<?php }  ?>
<div class="review_content" style="display:flex; gap:10px;align-items:center;justify-content:center">
						<span class="rating"><?=$rows["stars"]?></span>
						<span>En Stock</span>
</div>
<div style="margin-top:10px">
						<button id="decrement-btn2<?=$rows["id"]?>" style="border: 1px solid #ffb808; border-radius: 5px 0px 0px 5px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						>-</button>


							<input onlyRead style="width:40px; text-align: center; border:none; height:30px" id="quantity-input2<?=$rows["id"]?>" value="0">


						<button id="increment-btn2<?=$rows["id"]?>" style="border: 1px solid #ffb808; border-radius: 0px 5px 5px 0px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						 
						>+</button>
</div>

								</div>
								<ul>
									<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites" onclick="guardarFavorito({
								id:<?= $rows['id'] ?>,
								nombre_es:'<?= $rows['nombre_es'] ?>',
								nombre_en:'<?= $rows['nombre_en'] ?>',
								precio:'<?= $rows['precio'] ?>',
								image:'<?= URL . '/items/' . $pic['foto'] ?>',
								id_talla:'<?= $id_talla ?>',
							})">

											<i class="ti-heart"></i><span><?= translate("Agregar a favoritos", "Add to favorites") ?></span></a></li>
									<li><a rel="<?= $rows["id"] ?>-<?= $id_talla ?>" onClick="addItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>)" class="tooltip-1 addToCart" data-toggle="tooltip" data-placement="left" title="<?= translate("Agregar al carrito", "Add to cart") ?>"><i class="ti-shopping-cart"></i><span>
												<?= translate("Agregar al carrito", "Add to cart") ?>
											</span></a></li>
								</ul>
							</div>
							<!-- /grid_item -->
						</div>
<script>
		 
						document.getElementById("decrement-btn2<?=$rows["id"]?>").addEventListener("click", async () => {
							let quantity = parseInt(document.getElementById("quantity-input2<?=$rows["id"]?>").value);

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
										document.getElementById("quantity-input2<?=$rows["id"]?>").value = quantity.toString();

									}
								} else{
										removeItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>);

										quantity--;
										document.getElementById("quantity-input2<?=$rows["id"]?>").value = quantity.toString();

								}
								
								
							}
						});

						document.getElementById("increment-btn2<?=$rows["id"]?>").addEventListener("click", () => {
							
							let quantity = parseInt(document.getElementById("quantity-input2<?=$rows["id"]?>").value);
							if (quantity < 999) {
								quantity++;
								document.getElementById("quantity-input2<?=$rows["id"]?>").value = quantity.toString();
								addItemToCart(<?= $rows["id"] ?>,<?= $id_talla ?>);
							}
						});
</script>
					<?php }  ?>

				</div>
				<!-- /products_carousel -->
			</div>
			<!-- /container -->

			<?php include "partials_BRANDS.php"; ?>
			<!-- /bg_gray -->

			<!-- /container -->
		</main>
		<!-- /main -->

		<?php include "partials_FOOTER.php" ?>
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<?php include "partials_JS.php" ?>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/carousel-home.min.js"></script>

</body>

</html>