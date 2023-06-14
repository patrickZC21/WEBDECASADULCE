<footer class="revealed">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1"><?=translate("Acceso directo", "Direct access")?></h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<li><a href="<?=URL?>/nosotros"><?=translate("Acerca de nosotros", "About us")?></a></li>
							<li><a href="<?=URL?>/preguntas-frecuentes"><?=translate("Preguntas frecuentes", "Frequent questions")?></a></li>
							<li><a href="<?=URL?>/contacto"><?=translate("Contacto", "Contact")?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_2"><?=translate("Categor&iacute;as", "Categories")?></h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
						<?php   $cat = mysqli_query($link,"select * from  categorias order by orden ASC");
									while($rows = mysqli_fetch_assoc($cat)){
						?>	
							<li><a href="<?=URL?>/listados/<?=url($rows["nombre_".$_SESSION["idioma"].""])?>-<?=$rows["id"]?>.html"><?=$rows["nombre_".$_SESSION["idioma"].""]?></a></li>
							
							<?php } ?>
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3"><?=translate("Contactos", "Contacts")?></h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li><i class="ti-home"></i><?=$informativos["direccion"]?></li>
							<li><i class="ti-mobile"></i><a href="tel:<?=$informativos["telefono1"]?>"><?=$informativos["telefono1"]?></a></li>
							<li><i class="ti-email"></i><a href="mailto:<?=$informativos["correo1"]?>"><?=$informativos["correo1"]?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						
					<div class="collapse dont-collapse-sm" id="collapse_4">
						
						
							<h3><?=translate("S&iacute;guenos", "follow us")?></h3>
							<ul>
							
							<?php  $con2=mysqli_query($link,"select * from redes_sociales where estatus='si'");

								 while($row2=mysqli_fetch_assoc($con2)){?>
							
								 <li> <a target="_blank" href="<?=$row2["link"]?>"><i class="ti-<?=strtolower($row2["nombre"])?>"></i></a></li>
								  
								 <?php }	 ?>
							
								
							</ul>
						
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
					<li>
							
						</li>
						
						<li><center><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=URL?>/img/pagos.png" alt="" width="198" height="30" class="lazy"></center></li>
					</ul>
				</div>
				<div class="col-lg-6" style="text-align:center">
					<ul class="additional_links">
						<li><a href="<?=URL?>/terminos-condiciones"><?=translate("T&eacute;rminos y condiciones", "Terms and conditions")?></a></li>
						<li><a href="<?=URL?>/politica-privacidad"><?=translate("Pol&iacute;tica de privacidad", "Privacy Policy")?></a></li>
						<li><span>©2023 FOOD QR</span></li>
						 
					</ul>
				</div>
			</div>
			
			<div class="row add_bottom_25">
				<div class="col-lg-12" style="text-align:center">
					<span style="color:black"><?=translate("Sistema de Pedidos de Comida Rápida con QR", "Fast Food Ordering System with qr")?> <a href="https://wa.me/51951740664/" target="_blank" style="color:red">Solicitalo Aquí</a> </span>
				</div>
				 
			</div>
			
			
		</div>
	</footer>
	<!--/footer-->