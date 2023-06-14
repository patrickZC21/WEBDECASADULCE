<?php include "../conex.php";
?>
<option value="">Seleccione...</option>
<?php 
$b=mysqli_query($link,"select * from tallas where id_item=".$_POST["id_item"]."");
while($bb=mysqli_fetch_assoc($b)){?>

<option value="<?=$bb["id"]?>"><?=$bb["talla"]?></option>
<?php }

?>