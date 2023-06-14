<?php session_start(); include "../conex.php";  ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
	<title>Productos Nuevo</title>
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
	
	<!-- ================== BEGIN PAGE CSS STYLE ================== -->
	<link href="assets/plugins/form/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="assets/plugins/form/summernote/summernote.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/loader/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<link href="css/tree.css" rel="stylesheet">
	<script src="js/main.js" defer></script>
	
	<style>
		a{cursor:pointer}
	</style>
</head>
<body>
	
	<div id="page-container" class="page-header-fixed page-sidebar-fixed">
		
		<?php  include "header.php";  ?>
		
		<?php  include "sidebar.php"; ?>
		
		<div id="content" class="content">
			
			<ul class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li><a href="productos.php">Productos</a></li>
				<li class="active">Productos [Nuevo]</li>
			</ul>
			
			<div id="rootwizard" class="wizard wizard-full-width">
				
				<div class="wizard-header">
					<ul class="nav nav-pills">
						<li class="active"><a href="#tab1" data-toggle="tab">Productos - NUEVO</a></li>
						
					</ul>
				</div>
 				
<form action="productos.php" method="post" enctype="multipart/form-data" onSubmit="$('#btn_guardar').html('Guardando ...')" name="wizard_form">
                              
					
					<div class="wizard-content tab-content">
						
						<div class="tab-pane active" id="tab1">
							
							<div class="row">
								
								<div class="col-md-10 col-md-offset-1">
									
									
<ul class="nav nav-tabs" id="nav-tabs">

					<li class="active"><a href="#es" data-toggle="tab" aria-expanded="true">Español</a></li>
								<li class=""><a href="#en" data-toggle="tab" aria-expanded="true">Inglés</a></li>
								<li class=""><a href="#cat" data-toggle="tab" aria-expanded="true">Categor&iacute;as</a></li>
								<li class=""><a href="#ge" data-toggle="tab" aria-expanded="true">Generales</a></li>
								
</ul>

							<div class="tab-content tab-content-bordered">
								
								<div class="tab-pane fade active in" id="es">
									<div class="form-group">
										<label class="control-label">Producto Nombre</label>
<input type="text" name="nombre_es" id="nombre_es" class="form-control" required value="<?=$consulta["nombre_es"]?>">
									</div>	
									
<div class="form-group">
<label class="control-label">Descripción </label>

<div class="result">
        <textarea id="area_editor" name="descripcion_es"></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label" style="color:orange; font-weight:bold">Especificaciones</label>

<div class="result">
        <textarea id="area_editor2" name="especificaciones_es"></textarea>
</div>
</div>

								</div>
								
								
								<div class="tab-pane fade " id="en">
									<div class="form-group">
										<label class="control-label">Producto Nombre</label>
<input type="text" name="nombre_en" id="nombre_es" class="form-control" required value="<?=$consulta["nombre_en"]?>">
									</div>	
									
<div class="form-group">
<label class="control-label">Descripción </label>

<div class="result">
        <textarea id="area_editor3" name="descripcion_en"></textarea>
</div>
</div>

<div class="form-group">
<label class="control-label" style="color:orange; font-weight:bold">Especificaciones</label>

<div class="result">
        <textarea id="area_editor4" name="especificaciones_en"></textarea>
</div>
</div>

								</div>
								
								
								
								
								<div class="tab-pane fade  " id="cat">
								
								
									<div class="form-group">
										<label class="control-label">Categoría</label>
<select name="id_categoria" id="id_categoria" class="form-control"   required>
<option value="">Seleccione...</option>
 <?php  $rt=mysqli_query($link,"select * from categorias where estatus='si'");
 while($cat=mysqli_fetch_assoc($rt)){?>
 
 <option value="<?=$cat["id"]?>"><?=$cat["nombre_es"]?></option>
 <?php }
 ?>

</select>
									</div>
									
<input type="hidden" name="id_subcategoria" id="id_subcategoria" value="">						
<input type="hidden" name="idInside" id="idInside" value="">
	
<div style="padding:10px;background-color:#f8f8f8;font-size:16px">Sub Categor&iacute;a seleccionada: <code id="selected">Seleccione una opci&oacute;n...</code></div>
<div class="form-group">								
	<ul style="margin-top:20px" class="myUL" id="myUL<?=$row1["id"]?>"></ul>
</div>

</div> 
								
								
								
<div class="tab-pane fade  " id="ge">
									



<div class="form-group">
										<label class="control-label">Peso</label>
<input type="text" name="peso" id="peso" class="form-control" required value="<?=$consulta["peso"]?>">
									</div>	

<div class="form-group">
										<label class="control-label">Dimensiones</label>
<input type="text" name="dimensiones" id="dimensiones" class="form-control" required value="<?=$consulta["dimensiones"]?>">
									</div>	


<div class="form-group">
										<label class="control-label">Precio <code>Cantidad entera y separador de decimales con (.) (Ejemplo: 2700000.00) </code></label>
<input type="number" step=".01" name="precio" id="precio" class="form-control" value="0.00" required>
									</div>	

<div class="form-group">
										<label class="control-label">Descuento <code>Dejar en 0.00 si no tiene descuento</code></label>
<input type="number" step=".01" name="descuento" id="descuento" class="form-control" value="0.00" >
									</div>	

<div class="form-group">
										<label class="control-label">Descuento Caduca en:</label>
<input type="date" name="descuento_caduca" id="descuento_caduca" class="form-control" value="" >
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
	
	<link rel="stylesheet" href="build/jodit.min.css"/>
	<!-- ================== BEGIN BASE JS ================== -->
	 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
	
<script src="build/jodit.min.js"></script>
<script src="assets/prism.js"></script>
<script src="assets/app.js"></script>
<script>
    var editor = new Jodit('#area_editor', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
             "insertImageAsBase64URI": true
        },
        
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });

	var editor2 = new Jodit('#area_editor2', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
             "insertImageAsBase64URI": true
        },
        
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });

	var editor3 = new Jodit('#area_editor3', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
             "insertImageAsBase64URI": true
        },
        
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });

	var editor4 = new Jodit('#area_editor4', {
        textIcons: false,
        iframe: false,
        iframeStyle: '*,.jodit_wysiwyg {color:red;}',
        height: 300,
        defaultMode: Jodit.MODE_WYSIWYG,
        observer: {
            timeout: 100
        },
        uploader: {
             "insertImageAsBase64URI": true
        },
        
        commandToHotkeys: {
            'openreplacedialog': 'ctrl+p'
        }
        // buttons: ['symbol'],
        // disablePlugins: 'hotkeys,mobile'
    });
</script>
    
	<script>
		$(document).ready(function() {
			App.init();
 
		});
	</script>
	 

</body>
</html>
