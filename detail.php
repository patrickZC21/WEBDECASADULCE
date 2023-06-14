<?php session_start(); include "conex.php";

$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));

$detalle=mysqli_fetch_array(mysqli_query($link,"select * from productos where id=".limpiar($link,$_GET["id"]).""));


$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=".$detalle["id"]." order by orden ASC limit 0,1"));
							
$talla = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `productos_tallas` where estatus='si' and id_producto=".$detalle["id"]." and stock_actual > stock_inicial order by id ASC limit 0,1"));
							
$id_talla = $talla["id"];

mysqli_query($link,"update productos set contador=contador+1 where id=".limpiar($link,$_GET["id"])."");


$foto=mysqli_fetch_array(mysqli_query($link,"select * from   productos_imagenes where id_producto=".limpiar($link,$_GET["id"])."  order by orden ASC limit 0,1 "));


?>
<!DOCTYPE html>
<html lang="en">

<head>
   <?php  include "partials_Meta.php" ?>
    <title><?=$informativos["nombre_pagina"]?></title>

    <?php  include "partials_FONTS.php" ?>

	<?php  include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
    <link href="<?=URL?>/css/product_page.css" rel="stylesheet">

</head>

<body>
	
	<div id="page">
		
	<?php  include "partials_Header.php" ?>
	<!-- /header -->

	<main>
	    <div class="container margin_30">
		
	       
			
<?php  if($detalle["descuento"] > 0){
				
				$fecha_caduca = str_replace("-","/",$detalle["descuento_caduca"]);
				
?>
							
<div class="countdown_inner">-<?=number_format($detalle["descuento"], 0)?>% Descuento. Oferta caduca en <div data-countdown="<?=$fecha_caduca?>" class="countdown"></div>
	        </div>
						<?php 	 }  ?>
	        <div class="row">
	            <div class="col-md-6">
	                <div class="all">
	                    <div class="slider">
	                        <div class="owl-carousel owl-theme main">
							
							<?php  $images = mysqli_query($link, "SELECT * FROM `productos_imagenes` where id_producto=".$detalle["id"]." order by orden ASC");
									while($rows = mysqli_fetch_assoc($images)){ ?>
									
									<div style="background-image: url(<?=URL?>/items/<?=$rows["foto"]?>);" class="item-box"></div>
										
							<?php } 	?>
	                            
	                           
	                        </div>
	                        <div class="left nonl"><i class="ti-angle-left"></i></div>
	                        <div class="right"><i class="ti-angle-right"></i></div>
	                    </div>
	                    <div class="slider-two">
	                        <div class="owl-carousel owl-theme thumbs">
							<?php  $images = mysqli_query($link, "SELECT * FROM `productos_imagenes` where id_producto=".$detalle["id"]." order by orden ASC");
							$i = 0;
									while($rows = mysqli_fetch_assoc($images)){ ?>
									
									
									 <div style="background-image: url(<?=URL?>/items/<?=$rows["foto"]?>);" class="item <?php  if($i ==0){echo 'active';} ?>"></div>
										
							<?php		$i++;}
							?>
	                           
	                        </div>
	                        <div class="left-t nonl-t"></div>
	                        <div class="right-t"></div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-md-6">
	                <div class="breadcrumbs">
	                    
	                </div>
	                <!-- /page_header -->
	                <div class="prod_info">
	                    <h1><?=$detalle["nombre_".$_SESSION["idioma"].""]?></h1>
	                   
	                    <p><small>SKU: MTKRY-00<?=$_GET["id"]?></small><br><?=$detalle["descripcion_".$_SESSION["idioma"].""]?></p>
	                    <div class="prod_options">
	                       
	                        <div class="row mt-1">
	                            <label class="col-xl-5 col-lg-5 col-md-6 col-6"><strong><?=translate("Presentaci&oacute;n", "Presentation")?></strong></label>
	                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
	                                <div class="custom-select-form">

<?php  
$query = mysqli_query($link, "SELECT * FROM `productos_tallas` where id_producto = ".$detalle["id"]." and estatus= 'si' ");
?>
<select class="wide" id="idTalla" onChange="calcularPrecio()">
	
<?php
while($rows = mysqli_fetch_assoc($query)){

	$tallas = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `tallas` where id=".$rows["id_talla"]." "));
													
?>
<option value="<?=$tallas["id"]?>" rel="<?=$rows["id"]?>"><?=$tallas["nombre_".$_SESSION["idioma"].""]?></option>
												
												
													
<?php }  

$query = mysqli_query($link, "SELECT * FROM `productos_tallas` where id_producto = ".$detalle["id"]." and estatus= 'si' ");

	while($rowss = mysqli_fetch_assoc($query)){ ?>

	<input style="display:none" type="hidden" id="<?=$rowss["id"]?>" value="<?=$rowss["multiplicador"]?>" />

	
<?php } ?>
	                                       
	                                    </select>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row ">
	                            <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong><?=translate("Cantidad", "Amount")?></strong></label>
	                            <div class="col-xl-4 col-lg-5 col-md-6 col-6">
	                                <div class="numbers-row">
	                                    <input type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-5 col-md-6">
							<?php 

								$precio = $detalle["precio"]; $dolar=$informativos["dolar"]; $precioF = $precio * $dolar; 
								
								if($detalle["descuento"] > 0){
									
									$precioNew = ($detalle["precio"] - ($detalle["precio"] * $detalle["descuento"]) / 100); $dolar=$informativos["dolar"];
									$precioFWithDescount = 	$precioNew	* $dolar; 	
								}								
								if($detalle["descuento"] > 0){	
							?>
							
	                            <div class="price_main"><span class="new_price"><?php echo fpreciosD($precioFWithDescount); echo " "; ?> <?=translate($informativos["moneda"], "usd$")?> </span><span class="percentage">-<?=number_format($detalle["descuento"], 0)?>%</span> <span class="old_price"><?php echo fpreciosD($precioF); echo " ";?><?=translate($informativos["moneda"], "usd$")?></span></div>

								<input type="hidden" id="precio" value="<?=$precioFWithDescount?>" />

								<input type="hidden" id="dprecio" value="<?=$detalle["precio"]?>" />
								
								<?php  }else{ ?>
									
									<div class="price_main"><span class="new_price"><?php echo fpreciosD($precioF); echo " ";    ?><?=translate($informativos["moneda"], "usd$")?></span></div>

									<input type="hidden" id="precio" value="<?=$precioF?>" />
									
								<?php } ?>
								
								
	                        </div>
	                        <div class="col-lg-4 col-md-6">


							<div class="mb-3" style="display:flex; align-items:center">
								
							<a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"
							onclick="guardarFavorito({
								id:<?=$detalle['id']?>,
								nombre_es:'<?=$detalle['nombre_es']?>',
								nombre_en:'<?=$detalle['nombre_en']?>',
								precio:'<?=$detalle['precio']?>',
								image:'<?=URL . '/items/' .$pic['foto']?>',
								id_talla:'<?=$id_talla?>',
							})"
							>
							
							<i class="ti-heart"></i> <span><?=translate("Agregar a favoritos", "Add to favorites")?></span></a>
						</div>

	                            <div class="ml-2"><a href="#0" class="btn_1" 
								
								onClick="addItemToCart(
								<?=$detalle["id"]?>,
								document.getElementById('idTalla').value,
								document.getElementById('quantity_1').value
								)" 
								><?=translate("A&ntilde;adir al carrito", "Add to cart")?></a></div>
	                        </div>
	                    </div>
	                </div>
	                <!-- /prod_info -->
	               
	               
	            </div>
	        </div>
	        <!-- /row -->
	    </div>
	    <!-- /container -->
	    
	   
	    <!-- /tabs_product -->

		<div class="tabs_product">
	        <div class="container">
	            <ul class="nav nav-tabs" role="tablist">
	                <li class="nav-item">
	                    <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab"><?=translate("Descripci&oacute;n", "Description")?></a>
	                </li>
	                <li class="nav-item">
	                    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab"><?=translate("Rese&ntilde;as", "Reviews")?></a>
	                </li>
	            </ul>
	        </div>
	    </div>
	    <!-- /tabs_product -->
	    <div class="tab_content_wrapper">
	        <div class="container">
	            <div class="tab-content" role="tablist">
	                <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
	                    <div class="card-header" role="tab" id="heading-A">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
								<?=translate("Descripci&oacute;n", "Description")?>
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
	                        <div class="card-body">
	                            <div class="row justify-content-between">
	                                <div class="col-lg-6">
										<h3><?=translate("Descripci&oacute;n", "Description")?></h3>
	                                    <?=$detalle["descripcion_".$_SESSION["idioma"].""]?>
	                                </div>
	                                <div class="col-lg-5" style="background-color:white; padding:10px">
	                                    <h3><?=translate("Especificaciones", "Specifications")?></h3>
	                                    <div class="table-responsive">
										<?=$detalle["especificaciones_".$_SESSION["idioma"].""]?>
	                                    </div>
	                                    <!-- /table-responsive -->
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- /TAB A -->
	                <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
	                    <div class="card-header" role="tab" id="heading-B">
	                        <h5 class="mb-0">
	                            <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B">
								<?=translate("Rese&ntilde;as", "Reviews")?>
	                            </a>
	                        </h5>
	                    </div>
	                    <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
	                        <div class="card-body">

	                            <div class="row justify-content-between">
<?php 

$query_review = "select * from reviews where product_id = ".$detalle["id"]." order by fecha DESC";

$sql = mysqli_query($link, $query_review);

if($sql){

	if(mysqli_num_rows($sql) > 0 ){


		while($row = mysqli_fetch_assoc($sql)){
	
			// timestamp a partir de la fecha y hora en PHP
			$timestamp = strtotime($row["fecha"]);
			
			// obtener la diferencia en segundos entre la fecha y hora actual y el timestamp
			$diff = time() - $timestamp;
			
			// convertir la diferencia en minutos y redondear hacia abajo
			$minutes = round($diff / 60);
			
			?>
												<div class="col-lg-6">
			
			
													<div class="review_content">
<div class="clearfix add_bottom_10">
<span class="rating">
<?php 
																
for($i = 1; $i < 6; $i++){
																		
if($row["rating"]>= $i) {
echo '<i class="icon-star"></i>';
} else{
echo '<i class="icon-star empty"></i>';
}
			
}
																?>
																
																<em><?=$row["rating"]?>.0/5.0</em></span>
															<em>
			
															<?php 
															
															if ($minutes < 60) {
																
																if($_SESSION["idioma"] == "es"){
																	echo 'Publicado hace ' . $minutes . ' minutos';
																}else{
																	echo 'Published ' . $minutes . ' minutes ago';
																}
																
															} else {
																$hours = round($minutes / 60);
																
																if($_SESSION["idioma"] == "es"){
																	echo 'Publicado hace ' . $minutes . ' horas';
																}else{
																	echo 'Published ' . $minutes . ' hours ago';
																}
															}
															?>
															</em>
														</div>
														<h4><?=$row["title"]?></h4>
														<p><?=$row["description"]?></p>
													</div>
			
													
												</div>
			<?php  }  

	}else{

		if($_SESSION["idioma"] == "es"){
			echo "<h4>No hay rese&ntildeas por los momentos...</h4>";
		}else{
			echo "<h4>There are no reviews at the moment...</h4>";
		}
		

		
	}
}

?>
	                            </div>
	                            <!-- /row -->
	                           
	                         
	                            
	                        </div>
	                        <!-- /card-body -->
	                    </div>
	                </div>
	                <!-- /tab B -->
	            </div>
	            <!-- /tab-content -->
	        </div>
	        <!-- /container -->
	    </div>
	    
	    <!-- /tab_content_wrapper -->

	    <div class="container margin_60_35">
	        <div class="main_title">
	            <h2><?=translate("Relacionados", "Related")?></h2>
	            <span>Productos</span>
	            <p></p>
	        </div>
	        <div class="owl-carousel owl-theme products_carousel">
			
			
			
			<?php  $p = mysqli_query($link, "SELECT * FROM `productos` where  estatus='si' and id_categoria=".$detalle["id_categoria"]." and id not in(".$detalle["id"].") order by id DESC");
						while($rows= mysqli_fetch_assoc($p)) {
							
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
			
			
	            <div class="item">
	                <div class="grid_item">
						<figure>
						<?php  if($rows["descuento"] > 0){
						?>
							<span class="ribbon off">-<?=number_format($rows["descuento"], 0)?>%</span>
						<?php 						
						}  ?>
						
							<a href="<?=URL?>/<?=url($rows["nombre_".$_SESSION["idioma"].""])?>-<?=ucfirst($rows["id"])?>.html">
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
							
							<span class="new_price"><?php echo fpreciosD($precioF); echo " ";   ?> <?=translate($informativos["moneda"], "usd$")?></span>

							
						
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

							<li><a href="#0" rel="<?=$rows["id"]?>-<?=$id_talla?>" 
							
							onClick="addItemToCart(<?=$rows["id"]?>,<?=$id_talla?>)" 
							
							class="tooltip-1" data-toggle="tooltip" data-placement="left" title="<?=translate("Agregar al carrito", "Add to cart")?>"><i class="ti-shopping-cart"></i><span><?=translate("Agregar al carrito", "Add to cart")?></span></a></li>
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
				 <!-- /item -->
				<?php  } ?>	
	           
	         
	            </div>
	            
	        </div>
	        <!-- /products_carousel -->
	    </div>
	    <!-- /container -->

	    <div class="feat">
			<div class="container">
				<ul>
		<?php   $cat = mysqli_query($link,"select * from  servicios where estatus='si' order by orden ASC");
					while($rows = mysqli_fetch_assoc($cat)){
		?>	
					<li>
						<div class="box">
							<i class="ti-dot"></i>
							<div class="justify-content-center">
								<h3><?=$rows["nombre_es"]?></h3>
							</div>
						</div>
					</li>
		<?php  } ?>			
				</ul>
			</div>
		</div>
		<!--/feat-->

	</main>
	<!-- /main -->
	<?php  include "partials_FOOTER.php" ?>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<div id="toTop"></div><!-- Back to top button -->

	
	
	<script>
		function calcularPrecio(){

				var selectElement = document.getElementById("idTalla"); 
				
				var option = selectElement.options[selectElement.selectedIndex]; 
				var relValue = option.getAttribute("rel"); 

				const multiplicador =  document.getElementById(relValue).value ;

				const precio =  document.getElementById("precio").value;
				
				const div_new_price = document.querySelector(".new_price");
				
				const total = precio * multiplicador;
				div_new_price.innerHTML = `${total.toFixed(2)} <?=translate($informativos["moneda"], "usd$")?>`;

				if(document.getElementById("dprecio")){

					const dprecio =  document.getElementById("dprecio").value;
				const divOldPrice = document.querySelector(".old_price");
				divOldPrice.innerHTML = `${(dprecio*multiplicador).toFixed(2)} <?=translate($informativos["moneda"], "usd$")?>`;
				}

				

		}
	</script>
	
	
 	<?php  include "partials_JS.php" ?>
  
    <!-- SPECIFIC SCRIPTS -->
    <script  src="js/carousel_with_thumbs.js"></script>

</body>

</html>
