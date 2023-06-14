<?php session_start();
include "conex.php";
$informativos = mysqli_fetch_assoc(mysqli_query($link, "select * from _informativos where id=1"));

$dolar = $informativos["dolar"];

$buscar = mysqli_query($link, "select * from _carrito where  aux=" . $_SESSION["aux"] . " ");

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "partials_Meta.php" ?>
	<title><?= $informativos["nombre_pagina"] ?></title>

	<?php include "partials_FONTS.php" ?>

	<?php include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
	<link href="<?= URL ?>/css/cart.css" rel="stylesheet">

</head>

<body>

	<div id="page">

		<?php include "partials_Header.php" ?>
		<!-- /header -->

		<main class="bg_gray">
			<div class="container margin_30">
				<div class="page_header">

					<h1><?= translate("Carrito de compras", "Shopping cart") ?></h1>
				</div>
				<!-- /page_header -->
				<table class="table table-striped cart-list">
					<thead>
						<tr>
							<th>
								<?= translate("Producto", "Producto") ?>
							</th>
							<th>
								<?= translate("Precio", "Precio") ?>
							</th>
							<th>
								<?= translate("Cantidad", "Cantidad") ?>
							</th>
							<th>
								<?= translate("Subtotal", "Subtotal") ?>
							</th>
							<th>

							</th>
						</tr>
					</thead>
					<tbody id="tbodyCart">

						<?php


						$total = 0;

						while ($row = mysqli_fetch_assoc($buscar)) {

							$producto = mysqli_fetch_assoc(mysqli_query($link, "select * from productos where id=" . $row["id_producto"] . " "));

							$pic = mysqli_fetch_assoc(mysqli_query($link, "select * from productos_imagenes where id_producto=" . $producto["id"] . " order by orden ASC limit 0,1"));

							$fecha_caduca = str_replace("-", "/", $producto["descuento_caduca"]);

							$precio = $producto["precio"];
							$precioF = $precio * $dolar;

							if ($producto["descuento"] > 0) {

								$precioNew = ($producto["precio"] - ($producto["precio"] * $producto["descuento"]) / 100);

								$precioFWithDescount = 	$precioNew	* $dolar;
							} else {

								$precioFWithDescount = 0;
								$precioNew = 0;
							}
							

							$multiplicador = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where id_producto = ".$producto["id"]." and id_talla=".$row["id_talla"]." and estatus= 'si' "));

							$tallas = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `tallas` where id=" . $row["id_talla"] . " "));


							$total += $producto["descuento"] > 0
							 ? ($precioFWithDescount * $multiplicador["multiplicador"]) * $row["cantidad"]
							  : ($precioF * $multiplicador["multiplicador"]) * $row["cantidad"];


						?>

							<tr>
								<td>
									<div class="thumb_cart">
										<img src="<?= URL ?>/items/<?= $pic["foto"] ?>" data-src="<?= URL ?>/items/<?= $pic["foto"] ?>" class="lazy" alt="Image">
									</div>
									<span class="item_cart"><?= $producto["nombre_" . $_SESSION["idioma"] . ""] ?>
										<br />
										<small><?= $tallas["nombre_" . $_SESSION["idioma"] . ""] ?></small>
									</span>


								</td>
								<td>
									<strong><?= fpreciosD($row["precio"]*$multiplicador["multiplicador"]) ?> <?=translate($informativos["moneda"], "usd$")?></strong>
								</td>
								<td>

									<input onKeyDown="updateCartItem(<?= $row["id"] ?>, this.value)" onKeyUp="updateCartItem(<?= $row["id"] ?>, this.value)" onChange="updateCartItem(<?= $row["id"] ?>, this.value)" type="number" min="1" value="<?= $row["cantidad"] ?>" class="" name="quantity_1">

								</td>
								<td>
									<strong><?= fpreciosD(($row["precio"]*$multiplicador["multiplicador"]) * $row["cantidad"]); ?></strong>
								</td>
								<td class="options">
									<a onClick="deleteCart(<?= $row["id"] ?>)" href="#"><i class="ti-trash"></i></a>
								</td>
							</tr>

						<?php

						} ?>

					</tbody>
				</table>


			</div>
			<!-- /container -->

			<div class="box_cart">
				<div class="container">
					<div class="row justify-content-end">
						<div class="col-xl-4 col-lg-4 col-md-6">
							<ul>
								<li>
									<span>Subtotal</span> <b class="totalSubCart"><?= fpreciosD($total) ?> <?=translate($informativos["moneda"], "usd$")?></b>
								</li>
								<li>
									<span>Total</span> <b class="totalCart"><?= fpreciosD($total) ?> <?=translate($informativos["moneda"], "usd$")?></b>
								</li>
							</ul>

							<div style="display: flex; flex-direction:column; align-items:start">


								<div style="margin-top:25px">
									<span style="font-size:18px; font-weight:900"><?= translate("Tienes alg&uacute;n cup&oacute;n?", "Do you have a coupon?") ?></span>
								</div>

								<form method="post" action="<?= URL ?>/checkout" style="width:100%; background-color: #f7f7f7; padding: 5px">

									<div style="margin-top:10px; width:100%">
										<input id="codigo_cupon" name="codigo_cupon" type="text" class="form-control" placeholder="<?= translate("Introducir el c&oacute;digo del cup&oacute;n", "Enter coupon code") ?>" value="" />
									</div>
									<br />

									<button type="submit" class="btn_1 full-width cart"><?= translate("Crear pedido v&iacute;a WhatsApp", "Create order via WhatsApp") ?></button>
								</form>


							</div>


						</div>
					</div>
				</div>
			</div>
			<!-- /box_cart -->

		</main>
		<!--/main-->

		<?php include "partials_FOOTER.php" ?>
		<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<?php include "partials_JS.php" ?>


</body>

</html>