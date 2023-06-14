<?php session_start(); include "../conex.php" ;
$hide="hide";$hide2="hide";
include "guardar_foto.php" ;
$RUTA="../items/";


//E L I M I N A R
if(isset($_GET["eliminar"])){
	eliminar('productos',$_GET["eliminar"],$link); $hide2="";
}

if (isset($_POST["btn_editar"])){
	if( $_POST["estatus"]==""){$estatus="no";}else{$estatus="si";}
	if( $_POST["destacado"]==""){$destacado="no";}else{$destacado="si";}
	if( $_POST["especial"]==""){$especial="no";}else{$especial="si";}
	
		$update=mysqli_query($link,"update productos set 
		 estatus='".$estatus."',
		 nombre_es='".mysqli_real_escape_string($link,$_POST["nombre_es"])."',
         nombre_en='".mysqli_real_escape_string($link,$_POST["nombre_en"])."' ,
		 descripcion_es='".mysqli_real_escape_string($link,$_POST["descripcion_es"])."' ,
		 descripcion_en='".mysqli_real_escape_string($link,$_POST["descripcion_en"])."' ,
		 especificaciones_es='".mysqli_real_escape_string($link,$_POST["especificaciones_es"])."' ,
		 especificaciones_en='".mysqli_real_escape_string($link,$_POST["especificaciones_en"])."' ,
		 peso='".mysqli_real_escape_string($link,$_POST["peso"])."' ,
		 dimensiones='".mysqli_real_escape_string($link,$_POST["dimensiones"])."' ,
		 id_categoria=".$_POST["id_categoria"].",
        
		 precio=".$_POST["precio"]." ,
		 id_subcategoria=".$_POST["id_subcategoria"].",
		 idInside=".$_POST["idInside"].",
		 descuento=".$_POST["descuento"].",
		 descuento_caduca='".$_POST["descuento_caduca"]."',
		 destacado='".$destacado."',
		 especial='".$especial."'
		 		 
		
		  where id=".$_POST["id"]." ") or die ("Error al editar  ");	
$hide2="";

 
		
}// FIN EDITAR


if (isset($_POST["btn_guardar"])){
	
	
	$est = $_POST["estatus"] === "on" ? "si" : "no";
	
	$query = $_POST["descuento_caduca"] === ""
	
	? "insert into productos(id_categoria,id_marca,id_modelo,id_tipo,id_color,nombre_es,nombre_en,descripcion_es,descripcion_en,precio,peso,dimensiones,id_subcategoria,idInside,descuento,especificaciones_es,especificaciones_en)  values(".$_POST["id_categoria"].",
		NULL,
		NULL,
		NULL,
		NULL,
		'".mysqli_real_escape_string($link,$_POST["nombre_es"])."',
		'".mysqli_real_escape_string($link,$_POST["nombre_en"])."',
		'".mysqli_real_escape_string($link,$_POST["descripcion_es"])."',
		'".mysqli_real_escape_string($link,$_POST["descripcion_en"])."',
		".$_POST["precio"].",
		'".$_POST["peso"]."',
		'".$_POST["dimensiones"]."',
		".$_POST["id_subcategoria"].",
		".$_POST["idInside"].",
		".$_POST["descuento"].",
		'".mysqli_real_escape_string($link,$_POST["especificaciones_es"])."',
		'".mysqli_real_escape_string($link,$_POST["especificaciones_en"])."'
		)" 
	
	: "insert into productos(id_categoria,id_marca,id_modelo,id_tipo,id_color,nombre_es,nombre_en,descripcion_es,descripcion_en,precio,peso,dimensiones,id_subcategoria,idInside,descuento,descuento_caduca,especificaciones_es,especificaciones_en)  values(".$_POST["id_categoria"].",
	NULL,
	NULL,
	NULL,
	NULL,
		'".mysqli_real_escape_string($link,$_POST["nombre_es"])."',
		'".mysqli_real_escape_string($link,$_POST["nombre_en"])."',
		'".mysqli_real_escape_string($link,$_POST["descripcion_es"])."',
		'".mysqli_real_escape_string($link,$_POST["descripcion_en"])."',
		".$_POST["precio"].",
		'".$_POST["peso"]."',
		'".$_POST["dimensiones"]."',
		".$_POST["id_subcategoria"].",
		".$_POST["idInside"].",
		".$_POST["descuento"].",
		'".$_POST["descuento_caduca"]."',
		'".mysqli_real_escape_string($link,$_POST["especificaciones_es"])."',
		'".mysqli_real_escape_string($link,$_POST["especificaciones_en"])."'
		)";
	
	
		
	mysqli_query($link,$query);
		
	   
	$hide2="";

		
}// FIN NUEVO


?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Productos</title>
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
				<li class="active">Productos</li>
			</ul>
			<!-- END breadcrumb -->
			<!-- BEGIN page-header -->
			<div class="alert alert-danger alert-dark <?=$hide?>">
							<button type="button" class="close" data-dismiss="alert">cerrar</button>
							<strong>Error!</strong>  no se pudo guardar , pruebe nuevamente.
						</div>
                         <div class="alert alert-success alert-dark <?=$hide2?>">
							<button type="button" class="close" data-dismiss="alert">cerrar</button>
							<strong>Perfecto!</strong> Se ha guardado &eacute;xitosamente.
						</div>
		
			<!-- END page-header -->
			<a href="productos-nuevo.php" class="btn btn-default btn-lg">Nuevo <i class="ti-pencil"></i></a>
			
		
			
			<br><br>
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						 <th class="no-sort" style="width:1%">#</th>
						 <th class="no-sort" style="width:1%"></th>
						 <th class="no-sort" style="white-space: nowrap">Producto</th>
						 <th class="no-sort" style="white-space: nowrap">Precio ($)</th>
						 <th class="no-sort" style="white-space: nowrap">Descuento (%)</th>
						 <th class="no-sort" style="white-space: nowrap">Descuento Caduca el</th>
						 <th class="no-sort" style="white-space: nowrap">Categoría</th>
						 
						 
						 <th style="white-space: nowrap">Estatus</th>
					     
					</tr>
				</thead>
				<tbody>
				
<?php 
                                
$sql1=mysqli_query($link,"select * from  productos order by orden ASC");
$y=1; while($row1=mysqli_fetch_array($sql1)){ 

$categorias=consultar("select nombre_es from categorias where id=".$row1["id_categoria"]."",$link);
$marcas=consultar("select nombre_es from marcas where id=".$row1["id_marca"]."",$link);
$tipo=consultar("select nombre_es from tipo where id=".$row1["id_tipo"]."",$link);
$modelo=consultar("select nombre_es from modelo where id=".$row1["id_modelo"]."",$link);
$color=consultar("select nombre_es from color where id=".$row1["id_color"]."",$link);
                              
?>
								
					<tr>
						<td><?=$row1["id"]?></td>
						<td class="btn-col" style="white-space: nowrap">
<a href="productos-tallas.php?id=<?=$row1["id"]?>" class="btn btn-default btn-xs" alt="IMAGENES">Presentaci&oacute;n</a>
<a href="productos-imagenes.php?id=<?=$row1["id"]?>" class="btn btn-default btn-xs" alt="IMAGENES"><i class="ti-image"></i></a>

<a href="productos-editar.php?id=<?=$row1["id"]?>" class="btn btn-default btn-xs" alt="EDITAR"><i class="ti-pencil"></i></a>
<a alt="ELOMINAR" onClick=" if(confirm('Esta seguro?')){window.location='<?=$_SERVER["PHP_SELF"]?>?eliminar=<?=$row1["id"]?>'};"  class='btn btn-default btn-xs'><i class="ti-close"></i></a>
								
</td>
						<td><?=$row1["nombre_es"]?></td>
						<td><?=$row1["precio"]?></td>
						<td><?=$row1["descuento"]?></td>
					    <td><?=$row1["descuento_caduca"]?></td>
						<td><?=$categorias?></td>
						
						
						  
<td  ><center><?php  if ($row1["estatus"]=='si'){ echo "<i style='color:#72c02c;background-color:#72c02c' class='ti-control-record'></i>";}else{echo "<i style='color:#F93;background-color:#F93' class='ti-control-record'></i>";};?></center></td>			 
										 

</tr>
					
<?php   }  ?>
					
				</tbody>
			</table>
			<!-- END table -->
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
		$(document).ready(function() {
			App.init();
			TableData.init();
		});
	</script>

</body>
</html>
