<?php session_start();
include "conex.php";
$informativos = mysqli_fetch_assoc(mysqli_query($link, "select * from _informativos where id=1"));

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include "partials_Meta.php" ?>

	<title><?= $informativos["nombre_pagina"] ?></title>

	<?php include "partials_FONTS.php" ?>

	<?php include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
	<link href="<?= URL ?>/css/checkout.css" rel="stylesheet">

	<link href="<?= URL ?>/css/listing.css" rel="stylesheet">

	<link href="<?=URL?>/css/product_page.css" rel="stylesheet">

	<style>
		.pagination {
			display: flex;
			justify-content: center;
			margin: 10px 0;
		}

		.pagination button {
			padding: 5px 10px;
			margin: 0 5px;
			border: 1px solid #ccc;
			cursor: pointer;
		}

		.hide {
			display: none;
		}

		.show {
			display: block;
		}

		.filterOn {
			display: flex;
			width: 150px;
			margin: 10px;
			text-align: center;
			font-weight: 900;
			border-radius: 5px;
			border: 1px solid #f8f8f8;
			padding: 10px;
			background-color: yellow;
			color: black;
		}
	</style>

</head>

<body>
	<div id="page">

		<?php include "partials_Header.php" ?>
		<!-- /header -->

		<main class="bg_gray">
			<input type="hidden" value="<?= URL ?>" id="weburl" />
			<div class="container">

				<div style="
					display: flex;
					justify-content: end;
					gap: .8rem;">
					<a href="/"><?= translate("Inicio", "Home") ?></a> <span>/</span> <a><?= translate("Productos", "Products") ?></a>
				</div>


				<div style="margin-top:2rem; padding-left:1rem">

					<div style="
						display: flex;
						justify-content: start;
						gap: .8rem;
						align-items: center;
						">
						<h4><?= translate("Filtros", "Filters") ?></h4> <a href="/productos" style="font-size:12px"><?= translate("Limpiar todos", "Clear all") ?></a>

						<select id="sortPrice" onChange="filterSortPrice()">
							<option value=""><?= translate("Ordenar", "Sort") ?></option>
							<option value="lowerToHight"><?= translate("Menor Precio", "Lower price") ?></option>
							<option value="HigherToLower"><?= translate("Mayor Precio", "Higher price") ?></option>
						</select>
					</div>
				</div>


				<div style="margin-top:2rem; padding-left:1rem">

					<div style="
						display: flex;
						justify-content: start;
						gap: .8rem;
						align-items: center;
						">

						<div id="DivCurrentSortPrice"></div>
						<div id="DivCurrentColor"></div>
						<div id="DivCurrentFabricante"></div>
						<div id="DivCurrentCategoria"></div>
						<div id="DivCurrentSubCategoria"></div>

					</div>
				</div>

				<div class="main_nav inner">
					<div class="container">
						<div class="row small-gutters">
							<div class="row container">
								<div class="col-lg-3">

									<nav class="categories">
										<ul class="clearfix">
											<li><span>
													<a href="#">
														<span class="hamburger hamburger--spin">
															<span class="hamburger-box">
																<span class="hamburger-inner"></span>
															</span>
														</span>
														<?= translate("Categor&iacute;as", "Categories") ?>
													</a>
												</span>
												<div id="menu">
													<ul>
<?php

$sql_ = mysqli_query($link, "select * from categorias where estatus='si'");

while ($row = mysqli_fetch_assoc($sql_)) {

$url_to_go = URL . "/productos?category=" . url($row["nombre_" . $_SESSION["idioma"] . ""]) . '&id=' . $row['id'];

?>
<li><span><a href="<?= $url_to_go2 ?>"><?= $row["nombre_" . $_SESSION["idioma"] . ""] ?></a></span>
<ul>
<?php

$sql_ss = mysqli_query($link, "SELECT * FROM `subcategorias` where id_categoria=" . $row['id'] . " ");

while ($row2 = mysqli_fetch_assoc($sql_ss)) {

$nombre = json_decode($row2["nombre_" . $_SESSION["idioma"] . ""]);

$url_to_go2 = URL . "/productos?subcategory=" . url($nombre->padre) . '&id=' . $row2['id'];


																	?>

<li><a href="<?= $url_to_go2 ?>"><?= $nombre->padre ?></a></li>
																	<?php } ?>
																</ul>
															</li>
														<?php } ?>
													</ul>
												</div>
											</li>
										</ul>
									</nav>
								</div>

							</div>
						</div>
					</div>
				</div>


				<div style="margin-top:2rem; padding-left:1rem">

					<div class="row">

						<aside class="col-lg-3" id="sidebar_fixed">

							<div class="" id="">

								<!-- /filter_type -->
								<div class="filter_type version_2">
									<h4><a href="#filter_2" data-toggle="collapse" class="opened"><?= translate("Filtrar por precio", "Filter by price") ?></a></h4>
									<div class="collapse show" id="filter_2">
										<div style="padding:1rem">
											<div style="display: flex; flex-direction:column; gap:0.4rem">

												<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('<50')">
													<?= translate("Menos de S/. 50", "Under $50") ?>
												</button>

												<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('50-100')">
													S/. 50 - S/. 100
												</button>

												<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('100-300')">
													S/. 100 - S/. 300
												</button>

												<button class="btn_1" style="background-color:#FFC107; color: #222" onclick="filterPrice('300-1000')">
													S/. 300 - S/. 1000
												</button>

												<br />

												<?= translate("Desde", "From") ?> <input type="range" id="desde-slider" min="0" max="1000" step="50" value="50">
												<?= translate("Hasta", "To") ?> <input type="range" id="hasta-slider" min="1000" max="10000" step="50" value="3900">

												<div style="display:flex; justify-content: space-between; align-items:center">
													S/.<input type="text" id="desde" value="50" style="width: 50px">- S/. 
													<input type="text" id="hasta" value="3900" style="width: 50px">

													<button class="btn_1" onclick="filterPriceForm()"><?= translate("Filtrar", "Filter") ?></button>
												</div>

											</div>
										</div>
									</div>
								</div>
								<!-- /filter_type -->
						

							</div>
						</aside>




						<div class="col-md-8">

							<div class="row" id="products-table"></div>

							<div class="pagination">
								<button class="btn_1" id="prev-page" onclick="changePage(-1)"><?= translate("Anterior", "Back") ?></button>
								<button class="btn_1" id="next-page" onclick="changePage(1)"><?= translate("Siguiente", "Next") ?></button>
							</div>

						</div>
					</div>


				</div>
			</div>
			<!-- /row -->

			<!-- /container -->

		</main>
		<!--/main-->

		<?php include "partials_FOOTER.php" ?>
		<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->



	<script>
		let currentPage = 1;
		let currentSortPrice = '';
		let currentFilterPrice = '';
		let currentFilterPriceForm = '';
		let currentFilterColor = '';
		let currentFilterFabricante = '';
		let currentFilterCategoria = '';
		let currentFilterSubCategoria = '';

		function clear_filter_modal() {
			// $(".filter_col").toggleClass("show");
			// $("main").toggleClass("freeze");
			// $(".layer").toggleClass("layer-is-visible");
		}

		const desdeSlider = document.getElementById('desde-slider');
		const hastaSlider = document.getElementById('hasta-slider');
		const desde = document.getElementById('desde');
		const hasta = document.getElementById('hasta');

		desdeSlider.addEventListener('input', () => {
			desde.value = desdeSlider.value;
		});

		hastaSlider.addEventListener('input', () => {
			hasta.value = hastaSlider.value;
		});


		desde.addEventListener('input', () => {
			const desdeValue = parseFloat(desde.value);
			const hastaValue = parseFloat(hasta.value);
			desdeSlider.value = desde.value;

		});

		hasta.addEventListener('input', () => {
			const desdeValue = parseFloat(desde.value);
			const hastaValue = parseFloat(hasta.value);
			hastaSlider.value = hasta.value;

		});


		let categoryByGet = "<?= isset($_GET["category"]) ? $_GET["category"] : '' ?>";

		let idCategory = "<?= isset($_GET["id"]) ? $_GET["id"] : '' ?>";


		let subcategoryByGet = "<?= isset($_GET["subcategory"]) ? $_GET["subcategory"] : '' ?>";

		let idSubCategory = "<?= isset($_GET["id"]) ? $_GET["id"] : '' ?>";



		const divElement = document.getElementById("DivCurrentSortPrice");
		divElement.classList = 'hide';

		const divElementColor = document.getElementById("DivCurrentColor");
		divElementColor.classList = 'hide';

		const divElementFabricante = document.getElementById("DivCurrentFabricante");
		divElementFabricante.classList = 'hide';

		const divElementCategoria = document.getElementById("DivCurrentCategoria");
		DivCurrentCategoria.classList = 'hide';


		const divElementSubCategoria = document.getElementById("DivCurrentSubCategoria");
		DivCurrentSubCategoria.classList = 'hide';



		(categoryByGet && idCategory) ? filterCategoria(idCategory, categoryByGet.toString()): '';


		(subcategoryByGet && idSubCategory) ? filterSubCategoria(idSubCategory, subcategoryByGet.toString()): '';


		//const webURL = document.getElementById("weburl").value;
		

		function fetchProducts() {
			const webURL = "<?= URL ?>";
			//document.getElementById("filter").re="hide";

			const url = `${webURL}/getProducts.php?page=${currentPage}&sortPrice=${currentSortPrice}&filterPrice=${currentFilterPrice}&filterPriceForm=${currentFilterPriceForm}&filterColor=${currentFilterColor}&filterFabricante=${currentFilterFabricante}&filterCategoria=${currentFilterCategoria}&filterSubCategoria=${currentFilterSubCategoria}`;

			console.log(url);

			fetch(url)
				.then(response => response.json())
				.then(data => {

					console.log(data);

					const rowBody = document.getElementById("products-table");
					rowBody.innerHTML = "";


					data.forEach(product => {


						const id = product.id;
						const idD = `decrement-btn${id}`;
						const idI = `increment-btn${id}`;
						const idInput = `quantity-input${id}`;


						const div = document.createElement("div");
						div.classList = 'col-6 col-md-4 col-xl-4';
						div.innerHTML = `
						
						
						<div class="grid_item" >
						<figure  >
							<a href="${product.to_url}">
								<img src="${product.images[0]}" class="img-fluid lazy" alt=""  style="object-fit:contain; width: 200px; height:200px" />
							</a>
				</figure>
				<a href="${product.to_url}" style="color:black;font-weight:600">${product.nombre_es}</a>
				<div class="price_box">
				<span class="old_price">${((product.precio*.5)*2.2).toFixed(2)}</span>
					<span class="new_price">${product.precio}</span>

					<div class="review_content" style="display:flex; gap:10px;align-items:center;justify-content:center">
						<span class="rating">${product.stars}</span>
						<span>En Stock</span>
					</div>

					<div style="margin-top:10px">
						<button id="${idD}" style="border: 1px solid #ffb808; border-radius: 5px 0px 0px 5px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						onClick=""
						>-</button>


							<input onlyRead style="width:40px; text-align: center; border:none; height:30px" id="${idInput}" value="0">


						<button id="${idI}" style="border: 1px solid #ffb808; border-radius: 0px 5px 5px 0px; width:40px; background-color: #ffb808; color: white; font-size:17px"
						
						 
						>+</button>
					</div>	
				</div>
				<ul>

					<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"
					onclick="guardarFavorito({
						id:${product.id},
						nombre_es:'${product.nombre_es}',
						nombre_en:'${product.nombre_en}',
						precio:'${product.precio}',
						image:'${product.images[0]}',
						id_talla:'${product.id_talla}',
					})"
					>
					
					<i class="ti-heart"></i><span>Add to favorites</span></a></li>

					<li>
					
					<a href="#0" onClick="addItemToCart(${product.id},${product.id_talla})" rel="${product.id}-${product.id_talla}"   class="tooltip-1 addToCart"  data-toggle="tooltip" data-placement="left" title="<?= translate("Agregar al carrito", "Add to cart") ?>">
					
					<i class="ti-shopping-cart"></i>
					
					<span><?= translate("Agregar al carrito", "Add to cart") ?></span>
					</a>
					
					</li>


				
				</ul>
			</div>
		
		`;
				
						rowBody.appendChild(div);

						const decrementBtn = document.getElementById(idD);
						const incrementBtn = document.getElementById(idI);
						const quantityInput = document.getElementById(idInput);

						decrementBtn.addEventListener("click", async () => {
							let quantity = parseInt(quantityInput.value);

							if (quantity > 0) {
								
								if(quantity === 1) {
									if(confirm('Estas seguro de eliminar el producto del carrito?')){
										
										const data = await(await fetch(`${webURL}/deleteItemFromCartByIdProduct.php`, {
										method: 'post',
										headers: {
											'content-Type' : 'application/json'
										},
										body: JSON.stringify({id})
										})).json();

										console.log(data);

										updateCart();

										quantity--;
										quantityInput.value = quantity.toString();

									}
								} else{
										removeItemToCart(product.id,product.id_talla);

										quantity--;
										quantityInput.value = quantity.toString();

								}
								
								
							}
						});

						incrementBtn.addEventListener("click", () => {
							let quantity = parseInt(quantityInput.value);
							if (quantity < 999) {
								quantity++;
								quantityInput.value = quantity.toString();
								addItemToCart(product.id,product.id_talla);
							}
						});
					});
				})
				.catch(error => console.error("Error fetching products:", error));
		}

		function changePage(increment) {
			currentPage += increment;
			fetchProducts();
		}

		function filterSortPrice() {

			const sorted = document.getElementById("sortPrice").value;
			currentSortPrice = sorted;
			fetchProducts();

		}

		function filterPriceForm() {

			currentFilterPriceForm = [parseFloat(desde.value), parseFloat(hasta.value)].toString();

			resetPrice();

			fetchProducts();
			divElement.classList = 'show filterOn';


			divElement.innerHTML = `<div style="display:flex;align-items:center"><span><?= translate("Precio", "Price") ?> [${currentFilterPriceForm}]</span> <a onClick="resetPriceForm()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;


		}

		function resetPriceForm() {
			currentFilterPriceForm = '';
			fetchProducts();
			divElement.classList = 'hide';
		}

		function filterPrice(price) {
			clear_filter_modal()
			currentFilterPrice = price;
			resetPriceForm();
			fetchProducts();
			divElement.classList = 'show filterOn';


			divElement.innerHTML = `<div style="display:flex;align-items:center"><span><?= translate("Precio", "Price") ?> [${price}]</span> <a onClick="resetPrice()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;


		}

		function resetPrice() {
			currentFilterPrice = '';
			fetchProducts();
			divElement.classList = 'hide';
		}

		function filterColor(color, nombreColor = '') {
			clear_filter_modal()
			currentFilterColor = color;
			fetchProducts();
			divElementColor.classList = 'show filterOn';
			divElementColor.innerHTML = `<div style="display:flex;align-items:center"><span>Color [${nombreColor}]</span> <a onClick="resetColor()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;
		}

		function resetColor() {
			currentFilterColor = '';
			fetchProducts();
			divElementColor.classList = 'hide';
		}

		function filterFabricante(fabricante, nombreFabricante = '') {
			clear_filter_modal()
			currentFilterFabricante = fabricante;
			fetchProducts();
			divElementFabricante.classList = 'show filterOn';


			divElementFabricante.innerHTML = `<div style="display:flex;align-items:center"><span><?= translate("Fabricante", "Maker") ?> [${nombreFabricante}]</span> <a onClick="resetFabricante()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;
		}

		function resetFabricante() {
			currentFilterFabricante = '';
			fetchProducts();
			divElementFabricante.classList = 'hide';
		}


		function filterCategoria(categoria, nombreCategoria) {
			currentFilterCategoria = categoria;
			fetchProducts();
			divElementCategoria.classList = 'show filterOn';

			divElementCategoria.innerHTML = `<div style="display:flex;align-items:center"><span><?= translate("Categor&iacute;a", "Category") ?> [${nombreCategoria}]</span> <a onClick="resetCategoria()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;
		}

		function resetCategoria() {
			currentFilterCategoria = '';
			fetchProducts();
			divElementCategoria.classList = 'hide';
		}


		function filterSubCategoria(subcategoria, nombreSubCategoria) {
			currentFilterSubCategoria = subcategoria;
			fetchProducts();
			divElementSubCategoria.classList = 'show filterOn';

			divElementSubCategoria.innerHTML = `<div style="display:flex;align-items:center"><span><?= translate("SubCategor&iacute;a", "SubCategories") ?> [${nombreSubCategoria}]</span> <a onClick="resetSubCategoria()" style="color:red;font-weight:900;margin-left:10px;font-size:16px">x</a></div>`;
		}

		function resetSubCategoria() {
			currentFilterSubCategoria = '';
			fetchProducts();
			divElementSubCategoria.classList = 'hide';
		}


		fetchProducts();
	</script>


	<!-- COMMON SCRIPTS -->
	<?php include "partials_JS.php" ?>


</body>

</html>