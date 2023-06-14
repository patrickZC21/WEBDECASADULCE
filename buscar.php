<?php session_start(); include "conex.php";
$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));
if(!isset($_SESSION["idioma"])){$_SESSION["idioma"]="es";  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php  include "partials_Meta.php" ?>
    <title><?=$informativos["nombre_pagina"]?></title>

    <?php  include "partials_FONTS.php" ?>

	<?php  include "partials_STYLES.php" ?>

	<!-- SPECIFIC CSS -->
    <link href="<?=URL?>/css/contact.css" rel="stylesheet">

</head>

<body>
	
	<div id="page">
	
	<?php  include "partials_Header.php" ?>
	
	<main class="bg_gray">
	

			<div class="container margin_60">
				<div class="main_title">
					<h1><?=translate("Búsqueda", "Búsqueda")?></h1>
				</div>				
			</div>
			<!-- /container -->
		<div class="bg_white">
			<div class="container margin_60_35">
            <div class="row space-top">
              	<div class="col-lg-12 col-md-12 col-sm-12 space-bottom">
                	
					         <?php  if($_POST["buscar"]){

                                $query= "select * from productos where nombre_".$_SESSION["idioma"]." like '%".$_POST["buscar"]."%'";

                                //echo $query;

							 $con=mysqli_query($link,$query);

									
									if($con){ 

                                        $filas=mysqli_num_rows($con);


                                        if($filas>0){  ?>
										
										<div><h4 style="font-weight:bold"><i>
										<?=translate("Se han encontrado", "Have been found")?>	
										 <span style="color:red"><?=$filas?></span> <i><?=translate("Resultados", "Results")?></i></h4></div>
										
										<?php 
										
									while($row=mysqli_fetch_assoc($con)){?>
									
									
									<div style="height:100px;background-color:#ededed;padding:10px" >
									
									           <h5><i class="fa fa-chevron-right"></i> <a href="/<?=url($row["nombre_".$_SESSION["idioma"].""])?>-<?=ucfirst($row["id"])?>.html"><?=$row["nombre_".$_SESSION["idioma"].""]?></a></h5>
											  
									</div>
									
									<?php }	 
									}else{echo "<h4>No hay resultados encontrados. Por favor intente con otra busqueda.</h4>";}
							 
							 }else{
                                echo "<h4>Error.</h4>";
                             }}  ?>
					
					
					
          
                </div>
              	
              </div>
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