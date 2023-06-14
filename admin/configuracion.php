<?php session_start(); include "../conex.php" ;
include "guardar_foto.php" ;
$hide="hide";$hide2="hide"; $sms="";

$RUTA="../images/";

if (!isset($_SESSION["id_usuario_ADM"])){  header("location:index.php");}$hide="hide";$hide2="hide";$sms="";
if (isset($_POST["btn_editar"])){
	
	if( $_POST["multilenguaje"]==""){$multilenguaje="no";}else{$multilenguaje="si";}

	if( $_POST["staff"]==""){$staff="no";}else{$staff="si";}
	
    if( $_POST["comming_soon"]==""){$comming_soon="no";}else{$comming_soon="si";}


		$update=mysqli_query($link,"update _informativos set 
		direccion='".mysqli_real_escape_string($link,$_POST["direccion"])."',
		telefono1='".mysqli_real_escape_string($link,$_POST["telefono1"])."',
		
		correo1='".mysqli_real_escape_string($link,$_POST["correo1"])."',
		dolar=".mysqli_real_escape_string($link,$_POST["dolar"]).",
		
		horario='".$_POST["horario"]."',
		
		nombre_pagina='".$_POST["nombre_pagina"]."',
		
		moneda='".$_POST["moneda"]."'
		
		
		where id=".$_POST["id"]."
		")or die ("Error Editar ".mysqli_error($link));	
		
		
		
	
	
if($_FILES['photoimg']['name']!=""){ 
	         
$ext=extension($_FILES['photoimg']['name']);
if($ext!=""){		
			 	            $actual_image_name ="logo".date("H_i_s").".".strtolower($ext);
							$tmp = $_FILES['photoimg']['tmp_name'];
							if(move_uploaded_file($tmp, $RUTA.$actual_image_name))
								{
									mysqli_query($link,"update _informativos set logo='".$actual_image_name."'  where id=".$_POST["id"]."") or die ("error subir foto ");
								  }
}else{
	$hide=""; $sms="Imagen invalida, solo formatos .jpg o .png";
	}								  
								  
} // FIN FILE 

// FAVICON

if($_FILES['favicon']['name']!=""){ 
	         
	$ext=extension($_FILES['favicon']['name']);
	if($ext!=""){		
								 $actual_image_name ="favicon".date("H_i_s").".".strtolower($ext);
								$tmp = $_FILES['favicon']['tmp_name'];
								if(move_uploaded_file($tmp, $RUTA.$actual_image_name))
									{
										mysqli_query($link,"update _informativos set favicon='".$actual_image_name."'  where id=".$_POST["id"]."") or die ("error subir favicon ");
									  }
	}else{
		$hide=""; $sms="Imagen invalida, solo formatos .jpg o .png";
		}								  
									  
	} // FIN FILE 
	

	
		
		$hide2="";
} // FIN EDITAR






?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>configuracion</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="assets/plugins/form/bootstrap-slider/css/bootstrap-slider.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- BEGIN #page-container -->
	<div id="page-container" class="page-header-fixed page-sidebar-fixed">
		<!-- BEGIN #header -->
		<?php  include "header.php";  ?>
		<!-- END #header -->
		
		<!-- BEGIN #sidebar -->
		<?php  include "sidebar.php"; ?>
		<!-- END #sidebar -->
		
		<!-- BEGIN #content -->
		<div id="content" class="content">
			<!-- BEGIN breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li class="active">Configuraci&oacute;n</li>
			</ul>
			<!-- END breadcrumb -->
			<!-- BEGIN page-header -->
			 <div class="alert alert-danger alert-dark <?=$hide?>">
							<button type="button" class="close" data-dismiss="alert">cerrar</button>
							<strong>Error!</strong>   <?=$sms?>
                        </div>
                         <div class="alert alert-success alert-dark <?=$hide2?>">
							<button type="button" class="close" data-dismiss="alert">cerrar</button>
							<strong>Perfecto!</strong> Se ha guardado &eacute;xitosamente.
						</div>
			<!-- END page-header -->
			<!-- BEGIN wizard -->
			<div id="rootwizard" class="wizard wizard-full-width">
				<!-- BEGIN wizard-header -->
				<div class="wizard-header">
					<ul class="nav nav-pills">
						<li class="active"><a href="#tab1" data-toggle="tab">CONFIGURACI&Oacute;N</a></li>
						
					</ul>
				</div>
				<!-- END wizard-header -->
				<!-- BEGIN wizard-form -->
<form action="<?=$_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data" onSubmit="$('#btn_editar').html('Editando ...')" name="wizard_form"> <?php 
                                
                                $sql1=mysqli_query($link,"select * from  _informativos");
                                  while($row1=mysqli_fetch_array($sql1)){ 
                                 
                                ?><input type="hidden" name="id" value="<?=$row1["id"]?>">
					<!-- BEGIN wizard-content -->
					<div class="wizard-content tab-content">
						<!-- BEGIN tab-pane -->
						<div class="tab-pane active" id="tab1">
							<!-- BEGIN row -->
							<div class="row">
								<!-- BEGIN col-6 -->
								<div class="col-md-6 col-md-offset-3">
									<p class="desc m-b-20">Datos b&aacute;sicos.</p>
									
									
									<div class="form-group">
										<label class="control-label">Nombre P&aacute;gina </label>
										<input type="text" class="form-control" required name="nombre_pagina" value="<?=$row1["nombre_pagina"]?>" />
									</div>
									
									
									<div class="form-group">
										<label class="control-label">Moneda </label>
										<input type="text" class="form-control"  name="moneda" value="<?=$row1["moneda"]?>" />
									</div>
									
									
									
									<div class="form-group">
										<label class="control-label">Direcci&oacute;n </label>
<input value="<?=$row1["direccion"]?>" type="text"  required name="direccion" rows="3" class="form-control "  >
									</div>
									
									<div class="form-group">
										<label class="control-label">Horarios</label>
										 <input value="<?=$row1["horario"]?>" type="text"   name="horario" rows="3" class="form-control "  >
									</div>
									
									
									<div class="form-group">
										<label class="control-label">Tel&eacute;fono</label>
										  <input type="text" value="<?=$row1["telefono1"]?>"  required name="telefono1" rows="3" class="form-control "  >
									</div>
									
									
									
									<div class="form-group">
										<label class="control-label">Correo</label>
										  <input type="text" value="<?=$row1["correo1"]?>"  required name="correo1" rows="3" class="form-control "  >
									</div>
									
									
									
									<hr>
									<div class="form-group">
										<label class="control-label">Logo</label>
										    <input type="file" name="photoimg">
											
											
											
											<?php if($row1["logo"]!=""){ ?>
											
<img  style="padding-right:5px; width:200px; height:80px; float:right" src="<?=$RUTA?>/<?=$row1["logo"]?>" > 
											 
											<?php } ?>
									</div>
									<br/><br/><hr>
									<div class="form-group">
										<label class="control-label">Favicon</label>
										    <input type="file" name="favicon">
											
											
											
											<?php if($row1["favicon"]!=""){ ?>
											
<img  style="padding-right:5px; width:70px; height:60px; float:right" src="<?=$RUTA?>/<?=$row1["favicon"]?>" > 
											 
											<?php } ?>
									</div><br/><br/>
									<hr>
									<br/><br/><br/>
									<h4>Precio Dolar</h4>
									<div class="form-group">
										<label class="control-label">Dolar.$ Tasa <code>Cantidad entera y separador de decimales con (.) (Ejemplo: 2700000.00) </code></label>
										 <input type="text" class="form-control"  name="dolar" value="<?=$row1["dolar"]?>" />
									</div>
									
														
									
								</div>
								<!-- END col-6 -->
							</div>
							<!-- END row -->
						</div>
						
						<!-- BEGIN wizard-footer -->
						<div class="wizard-footer">
							
							
<button style="float:right" type="submit" class="btn btn-primary  btn-rounded" name="btn_editar" id="btn_editar" >Editar <i class="ti-pencil"></i> </button>
						</div>
						<!-- END wizard-footer -->
					</div>
					<!-- END wizard-content -->
					
					  <?php   }  ?>
				</form>
				<!-- END wizard-form -->
			</div>
			<!-- END wizard -->
		</div>
		<!-- END #content -->
		
		<!-- BEGIN btn-scroll-top -->
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	<!-- END #page-container -->
	
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/cookie/js/js.cookie.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="assets/plugins/form/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/form/bootstrap-typeahead/js/bootstrap-typeahead.min.js"></script>
	<script src="assets/plugins/form/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/form/bootstrap-slider/js/bootstrap-slider.min.js"></script>
	<script src="assets/plugins/form/bootstrap-select/js/bootstrap-select.min.js"></script>
	<script src="assets/plugins/form/masked-input/js/masked-input.min.js"></script>
	<script src="assets/plugins/form/pwstrength/js/pwstrength.js"></script>
	<script src="assets/js/page/form-plugins.demo.min.js"></script>
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/form/bootstrap-wizard/js/bootstrap-wizard.min.js"></script>
	<script src="assets/js/page/form-wizards.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			FormWizards.init();FormPlugins.init();
		});
	</script>

</body>
</html>
