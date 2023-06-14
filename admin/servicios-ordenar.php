<?php session_start(); include "../conex.php";
	// $link = mysqli_connect('localhost', 'en123web_hotel1', '=l{X~H3gMLk-', 'en123web_hotel1');
	$consulta = "SELECT * FROM  servicios where   estatus='si' ORDER BY orden";
	$resultado = mysqli_query($link, $consulta);
	$elementos = null;
	while ($datos = mysqli_fetch_assoc($resultado)){
		$elementos[$datos['id']] = $datos['nombre_es'];
	}
	
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Servicios ordenar</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/icon/themify-icons/themify-icons.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE CSS STYLE ================== -->
	<link href="assets/plugins/table/DataTables/DataTables-1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/AutoFill-2.2.0/css/autoFill.bootstrap.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Buttons-1.3.1/css/buttons.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/ColReorder-1.3.3/css/colReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/FixedColumns-3.2.2/css/fixedColumns.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/FixedHeader-3.1.2/css/fixedHeader.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/KeyTable-2.2.1/css/keyTable.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Responsive-2.1.1/css/responsive.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/RowGroup-1.0.0/css/rowGroup.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/RowReorder-1.2.0/css/rowReorder.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Scroller-1.4.2/css/scroller.bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/table/DataTables/Select-1.2.2/css/select.bootstrap.min.css" rel="stylesheet" />
	<!-- ================== END PAGE CSS STYLE ================== -->
	<link href="pagina.css" rel="stylesheet" type="text/css" media="all">  
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
				<li><a href="servicios.php">Servicios</a></li>
				<li class="active">Servicios [Ordenar]</li>
			</ul>
			<!-- END breadcrumb -->
			<!-- BEGIN page-header -->
			
		
			<!-- END page-header -->
			
					 <div  style=" float:left;display:inline">
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b> <i class="ti-hand-point-down"></i> <small> Principal </small><i class="ti-hand-point-down"></i></b></div>
                 
                 <center><small><b>Arrastrar para Ordenar</b>, La Ordenaci&oacute;n se hace autom&aacute;ticamente</small></center>
						<ul id="lista" class="ui-sortable row" style=" width:auto; margin:auto">
								<?php 
                                    foreach ($elementos as $id => $nombre)
                                        echo '<li class="col-md-2" id="elemento-'.$id.'" contenteditable="false"><b>'.$nombre.'</b></li>';
                                ?>
						</ul>
        
        	<div id="form">
			
				
		</div><br>
				
			
		</div>
		
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		<!-- END btn-scroll-top -->
	</div>
	
    
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/cookie/js/js.cookie.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/table/DataTables/JSZip-3.1.3/jszip.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/pdfmake.min.js"></script>
	<script src="assets/plugins/table/DataTables/pdfmake-0.1.27/build/vfs_fonts.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="assets/plugins/table/DataTables/DataTables-1.10.15/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/dataTables.autoFill.min.js"></script>
	<script src="assets/plugins/table/DataTables/AutoFill-2.2.0/js/autoFill.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/dataTables.buttons.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.colVis.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.flash.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.html5.min.js"></script>
	<script src="assets/plugins/table/DataTables/Buttons-1.3.1/js/buttons.print.min.js"></script>
	<script src="assets/plugins/table/DataTables/ColReorder-1.3.3/js/dataTables.colReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedColumns-3.2.2/js/dataTables.fixedColumns.min.js"></script>
	<script src="assets/plugins/table/DataTables/FixedHeader-3.1.2/js/dataTables.fixedHeader.min.js"></script>
	<script src="assets/plugins/table/DataTables/KeyTable-2.2.1/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/dataTables.responsive.min.js"></script>
	<script src="assets/plugins/table/DataTables/Responsive-2.1.1/js/responsive.bootstrap.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowGroup-1.0.0/js/dataTables.rowGroup.min.js"></script>
	<script src="assets/plugins/table/DataTables/RowReorder-1.2.0/js/dataTables.rowReorder.min.js"></script>
	<script src="assets/plugins/table/DataTables/Scroller-1.4.2/js/dataTables.scroller.min.js"></script>
	<script src="assets/plugins/table/DataTables/Select-1.2.2/js/dataTables.select.min.js"></script>
	<script src="assets/js/page/table-data.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(function(){
			var formulario = $('#formulario'), ordenando = true, lista = $('#lista'),
                    elementos = lista.find('li');
			lista.sortable({
                update: function(event,ui){
                    var ordenPuntos = $(this).sortable('toArray').toString();
                    $.ajax({
                        type: 'POST',
                        url: 'servicios-contralor.php',
                        dataType: 'json',
                        data: {
                            accion: 'ordenar',
                            puntos: ordenPuntos
                        }
                    });
                }
            });
            lista.sortable('enable');
            $('input[name="editar-ordenar"]').on('change', function(){
                if ($(this).val() == 'ordenar'){
                    lista.sortable('enable');
                    elementos.attr('contenteditable',false);
                    ordenando = true;
                }
                else{
                    lista.sortable('disable');
                    elementos.attr('contenteditable',true);
                    ordenando = false;
                }
            });


			formulario.on('submit',function(evento){ //Cuando el formulario se envía, vamos a insertar
				evento.preventDefault();
				var nombre = $('#campo-nombre').val();
				$('#campo-nombre').val('');
				
				$.ajax({
                    type: 'POST',
                    url: 'servicios-controlador.php',
                    dataType: 'json',
                    data: {
                        accion: 'insertar',
                        nombre: nombre,
                        orden: elementos.length + 1 // El orden es el número de elementos + 1
                    },
                    success: function (devolver){
                    	if (devolver.valor){
                    		$('<li>',{
                    			id : 'elemento-' + devolver.valor,
                    			'class': ordenando ? 'ordenable' : '',
                    			text: nombre,
                    			'contenteditable' : !ordenando
                    		}).hide().appendTo($('#lista')).fadeIn('slow');
                    	}
                    }
                });
            });
            lista.on('keydown', 'li', function(evento){
                var punto = $(this);
                var idPunto = punto.attr('id').split('-');
                idPunto = idPunto[1];

                switch(evento.keyCode){
                    case 27:{ //Escape
                        document.execCommand('undo');
                        punto.blur();
                        break;
                    }
                    case 46:{ //Suprimir
                        if (confirm('¿Seguro que quiere eliminar este elemento?')){
                            $.ajax({
                                type: 'POST',
                                data: {
                                    accion: 'eliminar',
                                    orden: punto.index(),
                                    id: idPunto
                                },
                                url: 'videos-controlador.php',
                                success: function(e){
                                    punto.fadeOut('slow').remove();
                                }
                            });
                        }
                        break;
                    }
                    case 13:{ //Enter
                        evento.preventDefault();
                        var texto = punto.text();
                        punto.blur();
                        $.ajax({
                            type: 'POST',
                            data: {
                                accion: 'editar',
                                id: idPunto,
                                nombre: texto
                            },
                            url: 'videos-controlador.php'
                        });
                        break;
                    }
                }
            });
		});
	</script>
	<script>
		$(document).ready(function() {
			App.init();
			TableData.init();
		});
	</script>

</body>
</html>
