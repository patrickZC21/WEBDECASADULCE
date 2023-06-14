<?php session_start();
include "../conex.php";
require_once '../phpqrcode/qrlib.php';

$hide = "hide";
$hide2 = "hide";


if (isset($_POST["btn_guardar"])) {
	$text = $_POST['text'];
	$filename = '../qrcodes/' . md5($text) . '.png';
	$tempDir = '../qrcodes/';

	QRcode::png($text, $filename, QR_ECLEVEL_L, 10);

	$stmt = $conn->prepare("INSERT INTO qr_codes (text, filename, created_at) VALUES (?, ?, NOW())");
	$stmt->bind_param("ss", $text, $filename);

	if ($stmt->execute()) {
		//echo "Código QR generado con éxito!";$hide2='';
	} else {
		//echo "Error al generar el código QR.";$hide='';
	}

	$stmt->close();
}

//btn_editar

if (isset($_POST["btn_editar"])) {
	$id = $_POST["id"];

	$text = $_POST['text'];
	$filename = '../qrcodes/' . md5($text) . '.png';
	$tempDir = '../qrcodes/';

	QRcode::png($text, $filename, QR_ECLEVEL_L, 10);

	$stmt = $conn->prepare("UPDATE qr_codes set text=?, filename=?  where id=? ");

	$stmt->bind_param("ssi", $text, $filename, $id);

	if ($stmt->execute()) {
		//echo "Código QR editado con éxito!";
		$hide2 = '';
	} else {
		//echo "Error al editar el código QR.";
		$hide = '';
	}

	$stmt->close();
}

//E L I M I N A R
if (isset($_GET["eliminar"])) {

	$stmt = $conn->prepare("DELETE from qr_codes where id=? ");

	$stmt->bind_param("i", $_GET["eliminar"]);

	if ($stmt->execute()) {
		//echo "Código QR eliminado con éxito!";
		$hide2 = '';
	} else {
		//echo "Error al eliminar el código QR.";
		$hide = '';
	}
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
				<li class="active">QR CODES</li>
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
			<a href="qr-nuevo.php" class="btn btn-default btn-lg">Nuevo <i class="ti-pencil"></i></a>


			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						<th class="no-sort" style="width:1%"></th>
						<th class="no-sort" style="white-space: nowrap">Texto</th>
						<th class="no-sort" style="white-space: nowrap">QR</th>

						<th class="no-sort" style="white-space: nowrap">Created_at</th>

					</tr>
				</thead>
				<tbody>

					<?php $sql1 = mysqli_query($link, "select * from qr_codes");

					while ($row = mysqli_fetch_array($sql1)) { ?>

						<tr>
							<td><?= $row["id"] ?></td>
							<td class="btn-col" style="white-space: nowrap">
								<a href="qr-editar.php?id=<?= $row["id"] ?>" class="btn btn-default btn-xs"><i class="ti-pencil"></i></a>
								<a onClick=" if(confirm('Esta seguro?')){window.location='<?= $_SERVER["PHP_SELF"] ?>?eliminar=<?= $row["id"] ?>'};" class='btn btn-default btn-xs'><i class="ti-close"></i></a>
							</td>
							<td><?= $row["text"] ?></td>
							<td>
								<div style="display:flex; justify-content:space-evenly; gap:1rem">
									<img style="width:100px; height:100px" src="<?= $row["filename"] ?>" alt='QR Code' />

									<a title="Descargar QR" class='btn btn-default btn-xs' style="align-self:center; align-items:center" target="_blank" href="<?= $row["filename"] ?>"><i class="ti-download"></i></a>
								</div>


							</td>
							<td><?= $row["created_at"] ?></td>

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