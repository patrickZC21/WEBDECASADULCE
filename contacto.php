<?php session_start(); include "conex.php";
$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php  include "partials_Meta.php" ?>
    <title><?=$informativos["nombre_pagina"]?> - Sistema de Pedidos Digitales</title>

    <?php  include "partials_FONTS.php" ?>

	<?php  include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
    <link href="<?=URL?>/css/contact.css" rel="stylesheet">

</head>

<body>
	
	<div id="page">
	
	<?php  include "partials_Header.php" ?>
	
	<main class="bg_gray">
	
	 
	  <center>
<?php  if(isset($_POST["btn_enviar"])){
								 
								 
			
	$email = stripslashes($_POST["email"]);
	 
 
      // SE PROCEDE A ENVIAR EL CORREO
								 
									$headers  = "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
									$headers .= 'From: Contacto desde website   <'.$informativos["correo1"].'>' . "\r\n";
									$message=' <html>
												<head>
												<title></title>
												</head>
												<body >
												<br>
												
												<br><br>
												Nombre: '.$_POST["name"].'  <br><br>
												
												Email: '.$email.'  <br><br>
												
												Mensaje: '.$_POST["comment"].'  <br><br>
												
												<i>'.$informativos["nombre_pagina"].'</i><br>
												<i>'.$informativos["direccion"].'</i><br>
												<i>'.$informativos["telefono1"].'</i><br>
												</body>
												</html>
												';
							mail($informativos["correo1"], "Nuevo Contacto    ", $message, $headers);
							
							?>
							 <div class="alert alert-success alert-msg" style="display:block; position:relative">
								Enviado con éxito
								</div><br>
                             <?php   } // FIN GUARDAR ?>
                            
                            </center>  
	
			<div class="container margin_60">
				<div class="main_title">
					<h2><?=translate("Informaci&oacute;n de contacto", "Contact Information")?></h2>
					<p>--</p>
				</div>
				<div class="row justify-content-center">
					<div class="col-offset-3 col-lg-4">
						<div class="box_contacts">
							<i class="ti-location-pin"></i>
							<h2><?=$informativos["direccion"]?></h2>
							<a href="tel:<?=$informativos["telefono1"]?>"><?=$informativos["telefono1"]?></a>  <a href="mailto:<?=$informativos["email"]?>"><?=$informativos["email"]?></a>
							<small><strong>Horario:</strong> Lunes a Domingo - 3:00 PM a 11:00 PM</small>
						</div>
					</div>
					
				</div>
				<!-- /row -->				
			</div>
			<!-- /container -->
		<div class="bg_white">
			<div class="container margin_60_35">
				<h4 class="pb-3"><?=translate("Escrib&eacute;nos", "write to us")?></h4>
				<form action="" method="post"  enctype="multipart/form-data"> 
				<div class="row">
					<div class="col-lg-4 col-md-6 add_bottom_25">
						<div class="form-group">
							<input required name="name" class="form-control" type="text" placeholder="<?=translate("Nombre *", "Name *")?>">
						</div>
						<div class="form-group">
							<input required name="email" class="form-control" type="email" placeholder="Email *">
						</div>
						<div class="form-group">
							<textarea required name="comment" class="form-control" style="height: 150px;" placeholder="<?=translate("Comentario *", "Comment *")?>"></textarea>
						</div>
						<div class="form-group">
							<input class="btn_1 full-width" type="submit" name="btn_enviar"  value="<?=translate("Enviar", "Send")?>">
						</div>
					</div>
					<div class="col-lg-8 col-md-6 add_bottom_25">
					<iframe class="map_contact" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.515975475586!2d-76.69948768518846!3d-11.93873549153937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105e99af87ba31f%3A0xe9d55000a717660f!2sMi%20P%C3%A1gina%20Web!5e0!3m2!1ses-419!2spe!4v1684295761706!5m2!1ses-419!2spe" style="border: 0" allowfullscreen></iframe>
					</div>
				</div>
				</form>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_white -->
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