<?php session_start(); include "../conex.php" ;
$hide="hide";$hide2="hide";
include "guardar_foto.php" ;
$RUTA="../images/";

//E L I M I N A R
if(isset($_GET["eliminar"])){
	eliminar('categorias',$_GET["eliminar"],$link); $hide2="";
}

if (isset($_POST["btn_editar"])){
	if( $_POST["estatus"]==""){$estatus="no";}else{$estatus="si";}
	
		$update=mysqli_query($link,"update categorias    set 
		 estatus='".$estatus."',
		 nombre_es='".$_POST["nombre_es"]."',
         nombre_en='".$_POST["nombre_en"]."' 		 
		
		  where id=".$_POST["id"]." ") or die ("Error al editar  ");	
$hide2="";


if($_FILES['foto']['name']!=""){ 
	         
$ext=extension($_FILES['foto']['name']);
if($ext!=""){		
			 	            $actual_image_name =date("H_i_s")."cat".".".strtolower($ext);
							$tmp = $_FILES['foto']['tmp_name'];
							if(move_uploaded_file($tmp, $RUTA.$actual_image_name))
								{
									mysqli_query($link,"update categorias set foto='".$actual_image_name."'  where id=".$_POST["id"]."") ;
								  }
}else{
	$hide=""; $sms="Imagen invalida, solo formatos .jpg o .png";
	}								  
								  
								  
								  
} // FIN FILE  
		
}// FIN EDITAR


if (isset($_POST["btn_guardar"])){
	if( $_POST["estatus"]=="on"){$est="si";}else{$est="no";}
	
	mysqli_query($link,"insert into categorias values(NULL,NULL,NULL,NULL,NULL,NULL)");
	$id=mysqli_insert_id($link);
	 
		$update=mysqli_query($link,"update categorias    set 
		 estatus='si',
		  nombre_es='".$_POST["nombre_es"]."',
         nombre_en='".$_POST["nombre_en"]."' 
		  where id=".$id." ") or die ("Error al guardar ");	
	   
$hide2="";


if($_FILES['foto']['name']!=""){ 
	         
$ext=extension($_FILES['foto']['name']);
if($ext!=""){		
			 	            $actual_image_name =date("H_i_s")."cat".".".strtolower($ext);
							$tmp = $_FILES['foto']['tmp_name'];
							if(move_uploaded_file($tmp, $RUTA.$actual_image_name))
								{
									mysqli_query($link,"update categorias set foto='".$actual_image_name."'  where id=".$id."") ;
								  }
}else{
	$hide=""; $sms="Imagen invalida, solo formatos .jpg o .png";
	}								  
								  
								  
								  
} // FIN FILE 
		
}// FIN EDITAR


?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Categorías</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<link href="css/tree.css" rel="stylesheet">
	
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
	
	
	
	
	<script src="js/custom.js" defer></script>
	<script src="js/tree.js" defer></script>
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
				<li class="active">Categorías</li>
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
			<a href="categorias-nuevo.php" class="btn btn-default btn-lg">Nuevo <i class="ti-pencil"></i></a>
			
		
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="categorias-ordenar.php" class="btn btn-default btn-lg">Ordenar <i class="ti-move"></i></a>
			<br><br>
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						 <th class="no-sort" style="width:1%">#</th>
						 <th class="no-sort" style="width:1%"></th>
						 <th class="no-sort" style="white-space: nowrap">Categorías</th>
						 <th class="no-sort" style="white-space: nowrap">Imágen Ref.</th>
						 <th style="white-space: nowrap">Estatus</th>
					     
					</tr>
				</thead>
				<tbody>
				
<?php 
                                
$sql1=mysqli_query($link,"select * from  categorias order by orden ASC");
$y=1; while($row1=mysqli_fetch_array($sql1)){ 
                                 
?>
								
					<tr>
						<td><?=$row1["id"]?></td>
						<td class="btn-col" style="white-space: nowrap">
<a href="categorias-editar.php?id=<?=$row1["id"]?>" class="btn btn-default btn-xs"><i class="ti-pencil"></i></a>
<a onClick=" if(confirm('Esta seguro?')){window.location='<?=$_SERVER["PHP_SELF"]?>?eliminar=<?=$row1["id"]?>'};"  class='btn btn-default btn-xs'><i class="ti-close"></i></a>
								
</td>
						<td style="justify-content:space-between">
						<span><?=strtoupper($row1["nombre_es"])?></span>
						
<a style="cursor:pointer" title="SubCategor&iacute;as" onClick="getSubs(<?=$row1["id"]?>)" href="#modal<?=$row1["id"]?>" data-toggle="modal" ><img src="img/tree.png" style="width:20px" /></a>



						</td>
					<td  > <?php  if($row1["foto"]==NULL){echo "NO HAY FOTO CARGADA";}else{  ?>
<img  width="100px" height="100px" style="padding-right:5px;" src="<?=$RUTA?><?=$row1["foto"]?>"> 
                   <?php }?></td>
						  
<td  ><center><?php  if ($row1["estatus"]=='si'){ echo "<i style='color:#72c02c;background-color:#72c02c' class='ti-control-record'></i>";}else{echo "<i style='color:#F93;background-color:#F93' class='ti-control-record'></i>";};?></center></td>			 
										 

</tr>




<!-- Modal -->
<div class="modal fade" id="modal<?=$row1["id"]?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-headermodal<?=$row1["id"]?>
<h4 class="modal-title">Categor&iacute;as <code><?=$row1["nombre_es"]?></code></h4>
<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body">

<h4>Sub Categor&iacute;as  <a onClick="newSub(<?=$row1["id"]?>)" class="btn btn-info btn-sm">Nueva SubCategor&iacute;a</a></h4>

<div style="display:none; background-color:#f7f7f7; padding:30px" class="form-group" id="container<?=$row1["id"]?>">
		<input  type="text" class="form-control" name="txt_subcategoria" id="txt_subcategoria<?=$row1["id"]?>" placeholder="Introduce la nueva sub categoria">
		<br/>
		<button  id="submit<?=$row1["id"]?>" class="btn btn-sm btn-success">Crear</button>
</div>


<div style="display:none; background-color:#f7f7f7; padding:30px" class="form-group" id="containerAdd<?=$row1["id"]?>">
		<input  type="text" class="form-control"  id="txt_subcategoriaAdd<?=$row1["id"]?>" placeholder="Introduce la nueva sub categoria">
		<br/>
		<button  id="submitAdd<?=$row1["id"]?>" class="btn btn-sm btn-primary">Agregar nueva sub categor&iacute;a</button>
</div>


<ul class="myUL" id="myUL<?=$row1["id"]?>">
</ul>




</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

</div>
</div>
</div>
</div>
					
<?php   }  ?>

					
				</tbody>
			</table>
			<!-- END table -->
		</div>
		<!-- END #content -->
<div class="modal modal-inverse fade" id="inverse-modal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Agregar sub categor&iacute;a de <span id="subc"></span></h4>
<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
</div>
<div class="modal-body" id="resultBody">
<input required type="text" class="form-control" name="children" id="children" placeholder="Introduce la nueva sub categoria">
</div>
<div class="modal-footer">
<button type="button" class="btn btn-grey" data-dismiss="modal">Cerrar</button>
<button type="button" class="btn btn-success" id="btn_children">Guardar</button>
</div>
</div>
</div>
</div>
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