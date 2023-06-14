<?php session_start();
include "../conex.php";
require_once "admin_cupones.php";
$hide = "hide";
$hide2 = "hide";


if (isset($_POST["btn_guardar"])) {
	$codigo_cupon = $_POST["codigo_cupon"];
	$descripcion = $_POST["descripcion"];
	$tipo = $_POST["tipo"];
	$valor = $_POST["valor"];
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];
	$minimo_compra = $_POST["minimo_compra"];
	$usos = $_POST["usos"];
	


	$result = addCoupon($codigo_cupon, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos);

	$result ? $hide2='' : $hide='';
}

//btn_editar

if (isset($_POST["btn_editar"])) {
	$id = $_POST["id"];
	$codigo_cupon = $_POST["codigo_cupon"];
	$descripcion = $_POST["descripcion"];
	$tipo = $_POST["tipo"];
	$valor = $_POST["valor"];
	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_fin = $_POST["fecha_fin"];
	$minimo_compra = $_POST["minimo_compra"];
	$usos = $_POST["usos"];
	


	$result = updateCoupon($id,$codigo_cupon, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos);

	$result ? $hide2='' : $hide='';
}

//E L I M I N A R
if(isset($_GET["eliminar"])){
	$result = deleteCoupon($_GET["eliminar"]); 
	$result ? $hide2='' : $hide='';
}


?>
<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Cupones</title>
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
		<?php include "header.php";  ?>
		<!-- END #header -->

		<!-- BEGIN #sidebar -->
		<?php include "sidebar.php"; ?>
		<!-- END #sidebar -->

		<!-- BEGIN #content -->
		<div id="content" class="content">
			<!-- BEGIN breadcrumb -->
			<ul class="breadcrumb">
				<li><a href="home.php">Home</a></li>
				<li class="active">Cupones</li>
			</ul>
			<!-- END breadcrumb -->
			<!-- BEGIN page-header -->
			<div class="alert alert-danger alert-dark <?= $hide ?>">
				<button type="button" class="close" data-dismiss="alert">cerrar</button>
				<strong>Error!</strong> no se pudo guardar , pruebe nuevamente.
			</div>
			<div class="alert alert-success alert-dark <?= $hide2 ?>">
				<button type="button" class="close" data-dismiss="alert">cerrar</button>
				<strong>Perfecto!</strong> Se ha guardado &eacute;xitosamente.
			</div>

			<!-- END page-header -->
			<a href="cupones-nuevo.php" class="btn btn-default btn-lg">Nuevo <i class="ti-pencil"></i></a>


			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						<th class="no-sort" style="width:1%"></th>
						<th class="no-sort" style="white-space: nowrap">C&oacute;digo</th>
						<th class="no-sort" style="white-space: nowrap">Descripci&oacute;n</th>
						<th class="no-sort" style="white-space: nowrap">Tipo</th>
						<th class="no-sort" style="white-space: nowrap">Valor ($./%)</th>
						<th class="no-sort" style="white-space: nowrap">Fecha_inicio</th>
						<th class="no-sort" style="white-space: nowrap">Fecha_fin</th>
						<th class="no-sort" style="white-space: nowrap">Minimo_compra</th>
						<th class="no-sort" style="white-space: nowrap">Usos</th>
						<th class="no-sort" style="white-space: nowrap">Total Aplicados</th>

					</tr>
				</thead>
				<tbody>

					<?php $sql1 = mysqli_query($link, "select * from cupones");
					
					while ($row = mysqli_fetch_array($sql1)) { ?>

						<tr>
							<td><?= $row["id"] ?></td>
							<td class="btn-col" style="white-space: nowrap">
								<a href="cupones-editar.php?id=<?= $row["id"] ?>" class="btn btn-default btn-xs"><i class="ti-pencil"></i></a>
								<a onClick=" if(confirm('Esta seguro?')){window.location='<?= $_SERVER["PHP_SELF"] ?>?eliminar=<?= $row["id"] ?>'};" class='btn btn-default btn-xs'><i class="ti-close"></i></a>
							</td>
							<td><?=$row["codigo"]?></td>
							<td><?=$row["descripcion"]?></td>
							<td><?=$row["tipo"]?></td>
							<td><?=$row["valor"]?></td>
							<td><?=$row["fecha_inicio"]?></td>
							<td><?=$row["fecha_fin"]?></td>
							<td><?=$row["minimo_compra"]?></td>
							<td><?=$row["usos"]?></td>
							<td><?=$row["total_aplicados"]?></td>
							
						</tr>

					<?php   }  ?>

				</tbody>
			</table>
		
		</div>
		
	
		<a href="#" data-click="scroll-top" class="btn-scroll-top fade"><i class="ti-arrow-up"></i></a>
		
	</div>
	

	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/cookie/js/js.cookie.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/scrollbar/slimscroll/jquery.slimscroll.min.js"></script>
	
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
	

	<script>
		$(document).ready(function() {
			App.init();
			TableData.init();
		});
	</script>

</body>

</html>