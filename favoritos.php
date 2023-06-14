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

					<h1><?=translate("Favoritos", "WishList")?> <i class="ti-heart"></i></h1>
				</div>
				<!-- /page_header -->
				<table class="table table-striped cart-list">
					<thead>
						<tr>
							<th>
							<?=translate("Producto", "Product")?>
							</th>
							<th>
							<?=translate("Precio", "Price")?>
							</th>
							
							<th>_</th>
						</tr>
					</thead>
					<tbody id="tbodyCartFav">

					</tbody>
				</table>


			</div>
			<!-- /container -->

			
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

   <script>
    document.addEventListener("DOMContentLoaded", listarFavoritos);
   </script>
</body>

</html>