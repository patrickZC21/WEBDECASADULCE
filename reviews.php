<?php session_start(); include "conex.php";
$informativos=mysqli_fetch_assoc(mysqli_query($link,"select * from _informativos where id=1"));

$product_id = intval($_GET['product_id']);
$email = $_GET['email'];

$detalle=mysqli_fetch_array(mysqli_query($link,"select * from productos where id=".limpiar($link,$product_id).""));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php  include "partials_Meta.php" ?>
	
    <title><?=$informativos["nombre_pagina"]?> - Resenas - Reviews</title>

    <?php  include "partials_FONTS.php" ?>

	<?php  include "partials_STYLES.php" ?>

	
    <link href="<?=URL?>/css/leave_review.css" rel="stylesheet">

    <script>
    function submitReview() {
       
        var radios = document.getElementsByName('rating-input');
        var rating;
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                rating = radios[i].value;
            break;
            }
        }
      const title = document.getElementById('title').value;
     
      const description = document.getElementById('description').value;

      if(title === "" || description ==="" || rating== null){
        alert("Rellene todos los campos");
        return;
      }
   

      const formData = new FormData();
      formData.append('product_id', <?= $product_id ?>);
      formData.append('rating', rating);
      formData.append('title', `${title}`);
      formData.append('description', `${description}`);
      formData.append('email', '<?=$email?>');


      fetch('<?=URL?>/submit_review.php', {
        method: 'POST',
        body: formData
      }).then(response => response.text())
        .then(result => {
          if (!!result === true) {
            alert('Gracias por enviar tu review');
            location.assign("<?=URL?>");
          } else {
            alert('Hubo un error, inténtalo de nuevo');
          }
        });
    }
  </script>
</head>
<body>
	<div id="page">
		
	<?php  include "partials_Header.php" ?>
	<!-- /header -->
	
	<main class="bg_gray">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-5">
				 
					 
				</div>
			</div>
            <div class="container margin_60_35">
	
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="write_review">
						<h1><?=translate("Crear una rese&ntilde;a para ", "Leave a review for")?>
                    
                   <span style="color:coral"><?=$detalle["nombre_".$_SESSION["idioma"].""]?></span>
                    </h1>
                    <form>
                    <label for="email">Correo electrónico: <b><?=$email?></b></label>
                    
                    <br><br>
						<div class="rating_submit">
							<div class="form-group">
							<label class="d-block">
                            <?=translate("Calificación general", "Overall rating")?>    
                            </label>
							<span class="rating mb-0">

								<input type="radio" class="rating-input"   id="5_star" name="rating-input" value="5 Stars">
                                
                                <label for="5_star" class="rating-star"></label>


								<input type="radio" class="rating-input" id="4_star" name="rating-input" value="4 Stars">
                                
                                <label for="4_star" class="rating-star"></label>


								<input type="radio" class="rating-input" id="3_star" name="rating-input" value="3 Stars">
                                
                                <label for="3_star" class="rating-star"></label>


								<input type="radio" class="rating-input" id="2_star" name="rating-input" value="2 Stars">
                                
                                <label for="2_star" class="rating-star"></label>


								<input type="radio" class="rating-input" id="1_star" name="rating-input" value="1 Star">
                                
                                <label for="1_star" class="rating-star"></label>


							</span>
							</div>
						</div>
						<!-- /rating_submit -->
						<div class="form-group">
							<label>
                            <?=translate("El titulo de tu reseña", "Title of your review")?>       
                            </label>

							<input required id="title"  class="form-control" type="text" placeholder="<?=translate("Si pudieras decirlo en una frase, ¿qué dirías?", "If you could say it in one sentence, what would you say?")?>">
						</div>
						<div class="form-group">
							<label><?=translate("Tu reseña", "Your review")?></label>
							<textarea required id="description" class="form-control" style="height: 180px;" placeholder="<?=translate("Escriba su reseña para ayudar a otros a conocer este negocio en línea", "Write your review to help others learn about this online business")?>"></textarea>
						</div>
					 
                        <button class="btn_1" type="button"  onClick="submitReview()" ><?=translate("Enviar opinión", "Submit review")?></button>

</form>   
					</div>
				</div>
		</div>
		<!-- /row -->
		</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		
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