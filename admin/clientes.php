<?php session_start(); include "../conex.php" ;$hide="hide";$hide2="hide";$msj="";

if (!isset($_SESSION["id_usuario_ADM"])){  header("location:index.php");}
$informativos=mysqli_fetch_array(mysqli_query($link,"select * from _informativos where id=1"));
if (isset($_POST["btn_editar"])){
	
	
		$update=mysqli_query($link,"update users set 
		
		
		
		estatus='".$_POST["estatus"]."',
		email='".$_POST["email"]."'
		where user_id=".$_POST["id"]."
		")or die ("Error Editar".mysqli_error($link));		
		$hide2="";
		
}


if (isset($_POST["btn_clave"])){
	
	
	if ($_POST["nclave"]!=$_POST["cclave"]){$hide="";$msj="Claves no coinciden, intente de nuevo";		}else{
	//consulto con la tabla users si existe esta clave
	$query = mysqli_query($link,"SELECT * FROM `users` WHERE  password='".$_POST["clave"]."' and user_id=".$_POST["id"]." ") or die(mysqli_error());
	
	$filas=mysqli_num_rows($query);
	
	if ($filas>0){
		// SI ES CORRECTA PROCEDO A CAMBIAR LA CLAVE
		      mysqli_query($link,"update users set  password='".$_POST["nclave"]."' where user_id=".$_POST["id"]." ");		
		     $hide2="";
		}else{
			$hide="";
			$msj="Introdujo una clave incorrecta";
			}
			
	}
	
}





 ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Clientes</title>
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
 <div class="modal fade" id="orderDetails" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modalpagoresumen">
          
        </div>
      </div>
    </div>
<script language="javascript" type="text/javascript">

function modalpagoresumen(user_id) {                              

var data = {  'user_id'   : user_id };

$.ajax({ type: 'POST',  dataType: 'text',  url: 'modal_resumen_compras_clientes.php', data: data, success: function(text){ $('#modalpagoresumen').html(text);  }
 
});
 
}

</script>

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
				<li class="active">Clientes</li>
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
			 <?php  if ($_SESSION['ADM_tipo_usuario']=="administrador"){ ?> 
                        <a href="clientes-nuevo.php" class="btn btn-default btn-lg">Nuevo <i class="ti-pencil"></i></a> 
                          <?php   }   ?> 
                            <a style="float:right" href="../index.php">Ir a la web</a></span>
			
			<br><br>
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						<th class="no-sort" style="width:1%"></th>
						<th class="no-sort" style="white-space: nowrap">Nombres</th>
						<th style="white-space: nowrap">Email</th>
						<th style="white-space: nowrap">Identificación ID</th>
						<th style="white-space: nowrap">Telefono1</th>
						<th style="white-space: nowrap">Telefono2</th>
						<th style="white-space: nowrap">Dirección</th>
						<th style="white-space: nowrap">Tipo Usuario</th>
						<th style="white-space: nowrap">Estatus</th>
					</tr>
				</thead>
				<tbody>
				
<?php 
								
								$sql1=mysqli_query($link,"select * from  users");
									
                                while($row1=mysqli_fetch_array($sql1)){

$tipoU=consultar("select tipo_es from tipo_usuario where id=".$row1["id_tipo_usuario"]."",$link);
								
 ?>
								
				<tr>
						  <td  ><?php echo $row1["user_id"]?></td>
						  <td class="btn-col" style="white-space: nowrap">
							
							
							
							<button onClick="window.location='clientes-editar.php?id=<?=$row1["user_id"]?>'"  class='btn btn-success btn-xs'>Editar</button>
                                           
                                            <button  onClick="window.location='clientes-cambio-clave.php?id=<?=$row1["user_id"]?>'"   class='btn btn-info btn-xs' >Cambio Clave</button>
							
						</td>
                                                     <td  ><?php echo strtoupper($row1["name"])?></td>
                                                     <td  ><a href="#" data-toggle="modal" data-target="#orderDetails"  onclick="return modalpagoresumen(<?=$row1["user_id"]?>)"><?php echo $row1["email"]?></a></td>
                                                       <td  ><?php echo $row1["social_id"]?></td>
													   <td  ><?php echo $row1["telefono1"]?></td>
													   <td  ><?php echo $row1["telefono2"]?></td>
													   <td  ><?php echo $row1["direccion"]?></td>
													   
                                                     <td  ><?php echo $tipoU?></td>		
<td  ><?php if ($row1["estatus"]=="si"){echo "<i style='color:#72c02c;background-color:#72c02c' class='ti-control-record'></i>";}
														  else{echo"<i style='color:#F93;background-color:#F93' class='ti-control-record'></i>"; }?></td>
                                                     
                                                        
										 
						
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
