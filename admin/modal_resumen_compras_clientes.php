<?php include "../conex.php";$informativos=mysqli_fetch_array(mysqli_query($link,"select * from _informativos where id=1")); 
 $texto=array();$ix=1;
if(!isset($_SESSION["idioma"])){$_SESSION["idioma"]="es";  }



        $query=mysqli_query($link,"select * from _textos order by id ASC");
		while($reg=mysqli_fetch_array($query)){
			 $texto[$ix]=$reg["texto_".strtoupper($_SESSION["idioma"]).""];$ix++;
		}  

$filas=mysqli_fetch_assoc(mysqli_query($link,"select count(id) as filas from orden where id_cliente=".$_POST["user_id"]." and estatus != 'eliminada'  "));


?>


<div class="modal-header">
            <h4 class="modal-title">COMPRAS CLIENTE <b>[<?=$filas["filas"]?>]</b></h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive shopping-cart mb-0">
			
			
<?php  $query=mysqli_query($link,"select * from orden where id_cliente=".$_POST["user_id"]."  and estatus != 'eliminada'");

     while($data=mysqli_fetch_assoc($query)){

?>			
			
			
	
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
            <code><?=$data["estatus"]?></code> 
<div class="text-lg px-2 py-1">Total: <span class='text-medium'>
<?=$informativos["moneda"]?> <?=fprecios($total_final=consultar("SELECT sum(cantidad*precio) as total FROM orden_carrito WHERE id_orden=".$data["id"]."",$link))?></span></div>
            
			
			
			</div>		
			
			
			
              <table id="datatables-default" class="table table-striped table-condensed table-bordered bg-white">
                <thead>
                  <tr>
                    <th>Product Name</th>
                    <th class="text-center">Subtotal</th>
                  </tr>
                </thead>
                <tbody>
				
<?php  $ptotal=0;
			         $carrito=mysqli_query($link,"select * from orden_carrito where id_orden=".$data["id"]."");
					  if(!$carrito){}else{$filas=mysqli_num_rows($carrito);
					 
						while($rr=mysqli_fetch_assoc($carrito)){
                         $product=mysqli_fetch_assoc(mysqli_query($link,"select * from productos where id=".$rr["id_producto"].""));
						 $foto=consultar("select foto from productos_imagenes where id_producto=".$product["id"]." order by orden ASC limit 0,1",$link); 
						 $ptotal=$rr["cantidad"]*$rr["precio"];
						 
					 
$categorias=consultar("select nombre_".$_SESSION["idioma"]." from categorias where id=".$product["id_categoria"]."",$link);
$marcas=consultar("select nombre_".$_SESSION["idioma"]." from marcas where id=".$product["id_marca"]."",$link);
$tipo=consultar("select nombre_".$_SESSION["idioma"]." from tipo where id=".$product["id_tipo"]."",$link);
$modelo=consultar("select nombre_".$_SESSION["idioma"]." from modelo where id=".$product["id_modelo"]."",$link);

$tallas=consultar("select talla from tallas where id=".$product["id_talla"]."",$link);


?>				
				
                  <tr>
                   <td>
                  <div class="product-item">
				  <a target="_blank" class="product-thumb"  href="/detail/<?=url($product["nombre_".$_SESSION["idioma"].""])?>/<?=$product["id"]?>">
				 </a>
                    <div class="product-info">
                      <h4 class="product-title">
						  <a target="_blank" href="/detail/<?=url($product["nombre_".$_SESSION["idioma"].""])?>/<?=$product["id"]?>"><?=$product["nombre_".$_SESSION["idioma"].""]?>
						  <small>x <?=$rr["cantidad"]?></small></a></h4>
					  
					  <span><em><?=$texto[1]?>:</em> <?=$categorias?></span>
					  <span><em><?=$texto[21]?>:</em> <?=$marcas?></span>
					  <span><em><?=$texto[22]?>:</em> <?=$tipo?></span>
					  <span><em><?=$texto[23]?>:</em> <?=$modelo?></span>
					  
					  <span><em><?=$texto[11]?>:</em> <?=$tallas?></span>
                    </div>
                  </div>
                </td>
                    <td class="text-center text-lg text-medium"><?=$informativos["moneda"]?> <?=fprecios($ptotal)?></td>
                  </tr>
 <?php }}  ?>                 
                  
                </tbody>
              </table>
			<hr class="mb-3"><hr class="mb-3">  
 <?php }  ?>			  
            </div>
            
          </div>