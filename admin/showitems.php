<?php include "../conex.php";
?>
<option value="">Seleccione...</option>
<?php 
$b=mysqli_query($link,"select * from items where id_categoria=".$_POST["id_categoria"]."");
while($bb=mysqli_fetch_assoc($b)){?>

<option value="<?=$bb["id"]?>"><?=$bb["nombre_es"]?></option>
<?php }

?>