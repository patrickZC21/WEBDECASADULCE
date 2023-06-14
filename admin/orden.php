<?php session_start(); include "../conex.php" ;
$hide="hide";$hide2="hide";
include "guardar_foto.php" ;
$RUTA="../images/";


if(isset($_POST["btn_e"])){
	
	 if($_POST["estatus"]=="eliminada"){
		
				$consulta=mysqli_query($link,"select * from orden_carrito where id_orden=".$_POST["id"]."");

				while($row=mysqli_fetch_assoc($consulta)){

				   
				   $cdes=$row["cantidad"];
				   //aumento del inventario -> productos ->
				   mysqli_query($link,"update productos_tallas set stock_actual=stock_actual+".$cdes." where id=".$row["id_producto"]." and id_talla=".$row["id_talla"]."");
				  
				} 
				
				 mysqli_query($link,"update orden set estatus='".$_POST["estatus"]."' where id=".$_POST["id"]."");
	 }else{
		 mysqli_query($link,"update orden set estatus='".$_POST["estatus"]."' where id=".$_POST["id"]."");
		 
	 }
		
	
	
	$hide2="";
	
}

if(isset($_GET["send_email"]) && isset($_GET["id_producto"])){

	// enviar correo

	$to = $_GET["send_email"];
	$orden_id_producto = $_GET["id_producto"];

	include_once("../send_review_email.php");
}



?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Ordenes de compra</title>
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
				<li class="active">Orden de compra</li>
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
		
			<br><br>
			<!-- BEGIN table -->
			<table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
				<thead>
					<tr>
						<th class="no-sort" style="width:1%">#</th>
						<th class="no-sort" style="width:1%"></th>
						
						<th class="no-sort" style="white-space: nowrap">ID de Orden</th>
						<th class="no-sort" style="white-space: nowrap">Número de Pedido</th>
						<th class="no-sort" style="white-space: nowrap">Precio Total </th>
						<th class="no-sort" style="white-space: nowrap">Fecha</th>
						<th class="no-sort" style="white-space: nowrap">Envío</th>
						<th class="no-sort" style="white-space: nowrap">Método de Pago</th>
						<th class="no-sort" style="white-space: nowrap">Estado del Pedido</th>
						
					</tr>
				</thead>
				<tbody>
				
				 <?php   $cons=mysqli_query($link,"select * from orden order by id DESC");
					         while($row=mysqli_fetch_array($cons)){  ?>
							
					<tr>
						<?php 
				  
						
						$envio=consultar("select nombre_es from envio where id=".$row["id_envio"]."",$link);
						
						$item=mysqli_query($link,"select * from orden_carrito where id_orden=".$row["id"]."");
						$fil_items=0;
						$total=0;
						  while($registros=mysqli_fetch_array($item)){
					
				   
								$fil_items++;	
									$p_c=$registros["cantidad"]*$registros["precio"];
									$total+=$p_c; 
									
									$_SESSION["total"]=$total;
					
						  }
						
						
						?>
					
					<td class="bold"><?=$row["id"]?></td>
					 <td class="btn-col" style="white-space: nowrap">
							
							<?php if($row["estatus"]!="pagada"){?>
							
							<a href="#modalE<?=$row["id"]?>" data-toggle="modal" class="btn btn-default btn-xs"><i class="ti-pencil"></i></a>
							
							<?php  } ?>	
						</td>
					 
                  <td class="bold"><a href="#modal<?=$row["id"]?>" data-toggle="modal" >00<?=$row["id"]?></a></td>
                  <td><?=$fil_items?></td>
                  <td class="bold"><?=fprecios($total)?> </td>
                  <td><?=voltear($row["fecha"])?></td>
				  <td><?=strtoupper($envio)?></td>
                  <td><?=$row["tipo_pago_pago"]?></td>
				  
				  
				  
				  
				  
<?php  if($row["estatus"]=="por_pagar"){$m="warning";$t="Por pagar";}elseif($row["estatus"]=="pagada"){$m="primary";$t="Pagada";}elseif($row["estatus"]=="eliminada"){$m="default";$t="Eliminada";}elseif($row["estatus"]=="validar_pago"){$m="danger";$t="Por validar pago";} ?>



                  <td class="status <?=$m?>">
				  
				  <span><?=$t?></span>
				  
				  
				 </td> 
				  
                </tr>
					 

<div class="modal modal-cover fade " id="modalE<?=$row["id"]?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
<h3 class="text-purple"><button class="close" data-dismiss="modal">&times;</button>Editar Orden Nro. <b style="color:red">00<?=$row["id"]?></b> </span></h3>
											
										</div>
										<div class="modal-body">
										<form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
										
										<input type="hidden" name="id" value="<?=$row["id"]?>">
										<div class="form-group">
										
										        <select class="form-control" name="estatus">
<option <?php if($row["estatus"]=="por_pagar"){ echo "selected";} ?> value="por_pagar" >Por pagar</option>
<option <?php if($row["estatus"]=="pagada"){ echo "selected";} ?> value="pagada">Pagada</option>
<option <?php if($row["estatus"]=="eliminada"){ echo "selected";} ?> value="eliminada">Eliminada</option>
<option <?php if($row["estatus"]=="validar_pago"){ echo "selected";} ?> value="validar_pago">Validar_pago</option>
												  
												
												</select>
										
										
										</div>

										
											 
											 
											 <hr>
							 <input type="submit" name="btn_e" value="Editar Orden" class="btn btn-info">
										</form>	
										 </div>	
										</div>
										
									</div>
</div>


				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				







				  
<div class="modal modal-cover fade " id="modal<?=$row["id"]?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
<h3 class="text-purple"><button class="close" data-dismiss="modal">&times;</button>Resumen. Orden Código. <b style="color:red"><?=$row["codigo"]?></b> </span></h3>
											
										</div>
										<div class="modal-body">
										

										
<div class="row">										
<div class="col-md-4" style="background-color:#FFF"><h4><b>Orden Detalle</b></h4>
		<div class="row">

		 <div class="col-md-12">
	
			 <fieldset> <legend>Envío</legend>
			 <?=strtoupper($envio)?><br>
			 direcci&oacute;n:<br>
			 - <?=$row["direccion_retiro"]?><br><br>
			 Persona retiro:<br/>
			<?=$row["persona_retiro"]?><br><br/>
			Identificaci&oacute;n retiro:<br/>
			<?=$row["cedula_retiro"]?><br><br>

			Tel&eacute;fono retiro:<br>
			 <?=$row["telefono_retiro"]?><br><br>

			 Email:<br>
			 <b><?=$row["email"]?></b><br><br>
			 </fieldset>
			 
			 <hr>
			   
			 <?=$row["tipo_pago_pago"]?><br>
				
				<?=$row["estatus"]?><br>
				
				<?=voltear($row["fecha"])?><br>
				
				<?=$row["observaciones"]?><hr>
				
		<?php 
					if($row["cupon_total"] !== null){

						echo "Cupon aplicado: ".$row["cupon_code"]; echo "<br/>";
						echo "Descuento aplicado: ".$row["cupon_descuento"]; echo "<br/>";
						echo "Total a pagar: ".$row["cupon_total"]; echo "<br/>";
						
					}
		
		?>
		  
		  </div>
		
		
		
		
		
		
		
		</div>

</div>	



	
										
<div class="col-md-8"> <h4><b>Productos</b></h4>
<div class="row">
                 
                  <div class="col-md-4"><b>Nombre de Producto</b></div>
                  <div class="col-md-2"><b>Precio del Producto</b></div>
                  <div class="col-md-2"><b>Cantidad</b></div>
                  <div class="col-md-2"><b>Total</b></div>
</div>									
<?php  $ptotal=0;
$carrito=mysqli_query($link,"select * from orden_carrito where id_orden=".$row["id"]."");
					 
while($rr=mysqli_fetch_assoc($carrito)){


$product=mysqli_fetch_assoc(mysqli_query($link,"select * from productos where id=".$rr["id_producto"].""));

$foto=consultar("select foto from productos_imagenes where id_producto=".$product["id"]." order by orden ASC limit 0,1",$link); 


$ptotal=$rr["cantidad"]*$rr["precio"];
						 
					 
$categorias=consultar("select nombre_".$_SESSION["idioma"]." from categorias where id=".$product["id_categoria"]."",$link);
$marcas=consultar("select nombre_".$_SESSION["idioma"]." from marcas where id=".$product["id_marca"]."",$link);
$tipo=consultar("select nombre_".$_SESSION["idioma"]." from tipo where id=".$product["id_tipo"]."",$link);
$modelo=consultar("select nombre_".$_SESSION["idioma"]." from modelo where id=".$product["id_modelo"]."",$link);
$talla=consultar("select nombre_".$_SESSION["idioma"]." from tallas where id=".$rr["id_talla"]."",$link);


$multiplicador = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where id_producto = ".$product["id"]." and id_talla=".$rr["id_talla"]." and estatus= 'si' "));



?>	
             
<div class="row">

                  <div class="col-md-4">
					
				 
				 
				  <a href=""><?=ucfirst(strtolower($product["nombre_es"]))?></a>
				  <?php 
				  
				  if ($row["estatus"] == "pagada"){

					// consultar si ya envie el correo y ya creo la review
					$review = mysqli_query($link, "select * from reviews where email='".$row["email"]."' and product_id=".$product["id"]." ");

					

					if($review){
						$filas = mysqli_num_rows($review);

						if($filas == 0){
							echo '<br/><a href="orden.php?send_email='.$row["email"].'&id_producto='.$product["id"].'">ℹ️ Enviar formulario de review de este producto.</a>';
						}else{

							echo '<br/><b style="color:green">Review escrita ✔️</b>';
						}
					}else{
						echo '<br/><a href="orden.php?send_email='.$row["email"].'&id_producto='.$product["id"].'">+Enviar formulario de review de este producto.</a>';
					}

					 

					
				  }
				 
				 ?>
				 
				 
				 
				  <br>
				  
				    <span><em>categorias:</em> <?=$categorias?></span>
					  <span><em>marcas:</em> <?=$marcas?></span>
					  <span><em>tipo:</em> <?=$tipo?></span>
					  <span><em>modelo:</em> <?=$modelo?></span>
					  
					  <span><em>presentaci&oacute;n:</em> <b><?=$talla?></b></span>
				  
				  </div>
                  <div class="col-md-2"><?=fprecios($rr["precio"]* $multiplicador["multiplicador"])?> </div>
                  <div class="col-md-2" align="right"> <?=$rr["cantidad"]?>   </div>
                  <div class="col-md-2"><?=fprecios($ptotal* $multiplicador["multiplicador"])?> </div>
                 
</div><hr>
               
 <?php }  ?> 					


</div>

</div>										
										
											
											 
											
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
