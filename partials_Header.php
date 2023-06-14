<?php

function translate($word_es,$word_en){
	return $_SESSION["idioma"] === 'es' ? $word_es : $word_en;
}

?>

<style> a { cursor: pointer } </style>
<header class="version_2">
	<div class="layer"></div><!-- Mobile menu overlay mask -->
	<div class="top_line version_1 plus_select">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-sm-3 col-3"><strong><i class="ti-location-pin"></i> Visítanos: </strong><strong>Mi Dirección 999, Lima, Perú</strong>
				</div>
				<div class="col-sm-6 col-7">
					<ul class="top_links">
						<li>
						<div>
						    <strong><i class="ti-time"></i> Horario: </strong><strong>Lunes a Domingo - 3:00PM a 11:00PM</strong>
							</div>
						</li>
					</ul>
				</div>
				<div  class="col-sm-3 col-5">
				    
							<a class="phone_top " style="color:#fff" href="https://api.whatsapp.com/send?phone=<?= $informativos["telefono1"] ?>&amp;text=Hola%2C%20deseo%20realizar%20una%20consulta" target="_blank"><strong>
									<i class="ti-mobile"></i>
									<span>WhatsApp: </span><?= $informativos["telefono1"] ?></strong></a>

				</div>
			</div>
			<!-- End row -->
		</div>
		<!-- End container-->
	</div>
	<div class="main_header Sticky">
		<div class="container">
			<div class="row small-gutters">
				<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
					<div id="logo">
						<a href="/"><img src="<?= URL ?>/images/<?= $informativos["logo"] ?>" alt="" width="240" height="86"></a>
					</div>
				</div>
				<nav class="col-xl-6 col-lg-7">
					<a class="open_close" href="javascript:void(0);">
						<div class="hamburger hamburger--spin">
							<div class="hamburger-box">
								<div class="hamburger-inner"></div>
							</div>
						</div>
					</a>
					<!-- Mobile menu button -->
					<div class="main-menu align-items-center">
						<div id="header_menu">
							<a href="/"><img src="<?= URL ?>/images/<?= $informativos["logo"] ?>" alt="" width="190" height="85"></a>
							<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
						</div>


						<ul class="" style="text-align: center;margin-top: 20px;">

							<li>
								<a href="<?= URL ?>/" style=" text-shadow: 1px 1px #d8ded2;"><?=translate("Inicio", "Home")?></a>
							</li>
							<li>
								<a href="<?= URL ?>/nosotros" style=" text-shadow: 1px 1px #d8ded2;"><?=translate("Nosotros", "About us")?></a>
							</li>
							
							<li class="megamenu submenu">
									<a href="javascript:void(0);" class="show-submenu-mega"><?=translate("Categor&iacute;as", "Categories")?></a>
									<div class="menu-wrapper" >
										<div class="row small-gutters" >

<?php

$sql_ = mysqli_query($link, "select * from categorias where estatus='si'");

while ($row = mysqli_fetch_assoc($sql_)) {

	$url_to_go= URL."/productos?category=".url($row["nombre_".$_SESSION["idioma"].""]).'&id='.$row['id'];

?>

											<div class="col-lg-3 mb-5">
<h3><a href="<?=$url_to_go?>"><?= $row["nombre_".$_SESSION["idioma"].""] ?></a></h3>
												<ul>
<?php 

$sql_ss = mysqli_query($link, "SELECT * FROM `subcategorias` where id_categoria=".$row['id']." ");

while ($row2 = mysqli_fetch_assoc($sql_ss)) { 

	$nombre = json_decode($row2["nombre_".$_SESSION["idioma"].""]);
	
	$url_to_go2= URL."/productos?subcategory=".url($nombre->padre).'&id='.$row2['id'];

	
?>

<li><a href="<?=$url_to_go2?>"><?=  $nombre ->padre?></a></li>
<?php } ?>													
												</ul>
												</div>


<?php } ?>

										</div>
										<!-- /row -->
									</div>
									<!-- /menu-wrapper -->
								</li>
							<li>
								<a href="<?= URL ?>/contacto" style=" text-shadow: 1px 1px #d8ded2;"><?=translate("Contacto", "Contact")?></a>
							</li>


						</ul>
					</div>
					<!--/main-menu -->
				</nav>
				<div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-right">
					<ul class="top_tools">
						<li>
							<div class="dropdown dropdown-cart">
								<a href="<?= URL ?>/cart" class="cart_bt"><strong id="countCart">0</strong></a>
								<div class="dropdown-menu">
									<ul id="cartList"></ul>
									<div class="total_drop">
										<div class="clearfix"><strong>Total</strong><span id="totalCart"></span></div>
										<a href="<?= URL ?>/cart" class="btn_1 outline"><?=translate("Ver carrito", "Cart")?></a><a href="<?= URL ?>/checkout" class="btn_1">
										<?=translate("Crear pedido v&iacute;a WhatsApp", "Create order via WhatsApp")?>
										</a>
									</div>
								</div>
							</div>
							<!-- /dropdown-cart-->
						</li>

						<li style="display:block">
							<a href="<?= URL ?>/favoritos" class="wishlist" ><span>
							<?=translate("Favoritos", "Wishlist")?>
							</span></a>
						</li>

						<li >
							<a style="top:4px" onclick="showSearchPanel()"><i class="header-icon_search_custom" style="font-size:23px;"></i></a>
						</li>



					</ul>
				</div>
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /main_header -->
</header>
<!-- /header -->
<div class="top_panel boxData">

	<div class="container header_panel">
		<a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
		<label id="titleBoxData"></label>
	</div>

	<div class="item">
		<div class="container">

			<div class="contentBoxData">
				<div class="search-input">
					<input type="text" placeholder="Buscar...">
					<button type="submit"><i class="ti-search"></i></button>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="top_panel filterProducts">
	<div class="container header_panel">
		<a href="#0" class="btn_close_top_panel"><i class="ti-close"></i></a>
		<label>Filtrando Productos [ <code id="nameFilter"></code>]</label>
	</div>

	<div class="container ">

		<div class="row" id="show-data">


		</div>

	</div>
</div>

<!-- Size modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="size-modal" id="size-modal" aria-hidden="true" style="margin-top: 80px;">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Filtro de Categor&iacute;as & Sub Categor&iacute;as</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="ti-close"></i>
				</button>
			</div>
			<div class="modal-body">
				Categor&iacute;a seleccionada:
				<select name="id_categoria" id="id_categoria" class="form-control" required>
					<option value="">Seleccione...</option>
					<?php $rt = mysqli_query($link, "select * from categorias where estatus='si'");
					while ($cat = mysqli_fetch_assoc($rt)) { ?>

						<option value="<?= $cat["id"] ?>"><?= $cat["nombre_".$_SESSION["idioma"].""] ?></option>
					<?php }
					?>

				</select>

				<input type="hidden" name="id_subcategoria" id="id_subcategoria" value="">
				<input type="hidden" name="idInside" id="idInside" value="">


				<div style="padding:10px;background-color:#f8f8f8;font-size:16px">Sub Categor&iacute;a seleccionada: <b id="selected"></b></div>

				<div class="form-group">
					<ul style="margin-top:10px;overflow-y: scroll;height:220px" class="myUL" id="myUL<?= $row1["id"] ?>"></ul>
				</div>
				<a href="#0" class="btn_1 btn_filter"><i class="ti-filter"></i> Filtrar</a>

			</div>
		</div>
	</div>
</div>

<script>

function showSearchPanel(){
	const top_panelboxData = document.querySelector('.top_panel.boxData');
	const titleBoxData = document.querySelector('#titleBoxData')
	const contentBoxData = document.querySelector('.contentBoxData')
	top_panelboxData.classList.add('show');

	
	titleBoxData.innerHTML = `<?=translate("Busqueda", "Search")?>`;

	const block = `<div class="search-input">
	<form class="search-form closed" method="post"  action="/buscar.php">
					<input type="text" placeholder="<?=translate("Buscar...", "Search...")?>" autofocus name="buscar" >
					<button type="submit" name="btn_buscar"><i class="ti-search"></i></button>
	</form>
				</div>`;
	contentBoxData.innerHTML = block
}
</script>