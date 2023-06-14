<?php session_start();  ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Datos Bancarios nuevo</title>
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
	<!-- ================== BEGIN PAGE CSS STYLE ================== -->
	<link href="assets/plugins/form/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/plugins/form/summernote/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->
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
				<li><a href="datosbancarios.php">Datos Bancarios</a></li>
				<li class="active">Datos Bancarios [Nuevo]</li>
			</ul>
			
			<div id="rootwizard" class="wizard wizard-full-width">
				<!-- BEGIN wizard-header -->
				<div class="wizard-header">
					<ul class="nav nav-pills">
						<li class="active"><a href="#tab1" data-toggle="tab">Datos Bancarios - NUEVO</a></li>
						
					</ul>
				</div>
				
<form action="datosbancarios.php" method="post" enctype="multipart/form-data" onSubmit="$('#btn_guardar').html('Guardando ...')" name="wizard_form">
                              
					<!-- BEGIN wizard-content -->
					<div class="wizard-content tab-content">
						<!-- BEGIN tab-pane -->
						<div class="tab-pane active" id="tab1">
							<!-- BEGIN row -->
							<div class="row">
								<!-- BEGIN col-6 -->
								<div class="col-md-6 col-md-offset-3">
									<p class="desc m-b-20">Datos Bancarios [Nuevo].</p>
									
									
<ul class="nav nav-tabs" id="nav-tabs">
					<li class="active"><a href="#es" data-toggle="tab" aria-expanded="true">DATOS BANCARIOS</a></li>
								 
								
</ul>

							<div class="tab-content tab-content-bordered">
								
								
									<div class="tab-pane fade active in" id="es">
									<div class="form-group">
										<label class="control-label">Banco</label>
<input type="text" name="banco" id="banco" class="form-control" value="<?=$consulta["banco"]?>">
									</div>

<div class="form-group">
										<label class="control-label">Nro. Cuenta</label>
<input type="text" name="cuenta" id="cuenta" class="form-control" value="<?=$consulta["cuenta"]?>">
									</div>

<div class="form-group">
										<label class="control-label">Contacto</label>
<input type="text" name="contacto" id="contacto" class="form-control" value="<?=$consulta["contacto"]?>">
									</div>

<div class="form-group">
										<label class="control-label">Identificacion id</label>
<input type="text" name="identificacionid" id="identificacionid" class="form-control" value="<?=$consulta["identificacionid"]?>">
									</div>

<div class="form-group">
										<label class="control-label">Email</label>
<input type="text" name="email" id="email" class="form-control" value="<?=$consulta["email"]?>">
									</div>									

								</div>
								

								
								
								
								
								
								
							</div>	
									
								</div>
								
							</div>
							
						</div>
						
						<!-- BEGIN wizard-footer -->
						<div class="wizard-footer">
							
<button style="float:right" type="submit" class="btn btn-primary  btn-rounded" name="btn_guardar" id="btn_guardar" >Guardar <i class="ti-pencil"></i> </button>
						</div>
						<!-- END wizard-footer -->
					</div>
					<!-- END wizard-content -->
				
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
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/form/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/form/summernote/summernote.min.js"></script>
	<script src="assets/js/page/email-compose.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();EmailCompose.init();
			FormWizards.init();FormPlugins.init();
		});
	</script>

</body>
</html>
