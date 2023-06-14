<?php include "conex.php";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// FILTER FORM PRICE


function filterPriceFormFn($filter)

{
    $valores = explode(",", $filter);

   return 'and precio between '. $valores[0].' and '.$valores[1].' ';         
}

$filterPriceForm = isset($_GET['filterPriceForm'])
?
    $_GET['filterPriceForm'] !== ""
    ?
    filterPriceFormFn($_GET['filterPriceForm'])
    : ''
: '';






// FILTER PRICE

function filterPriceFn($filter)
{

    $sql = ' and ';
    switch ($filter) {
        case '<50': {
                $sql .= '  precio < 50 ';
                break;
            }
        case '50-100': {
                $sql .= '  precio between 50 and 100 ';
                break;
            }
        case '100-300': {
                $sql .= ' precio between 100 and 300 ';
                break;
            }
        case '300-1000': {
                $sql .= ' precio between 300 and 1000 ';
                break;
            }
    }

    return $sql;
}


$filterPrice = isset($_GET['filterPrice'])
?
    $_GET['filterPrice'] !== ""
    ?
    filterPriceFn($_GET['filterPrice'])
    : ''
: '';



// FILTER COLOR

$filterColor = isset($_GET['filterColor'])
?
    $_GET['filterColor'] !== ""
    ?
    " and id_color = {$_GET['filterColor']} "
    : ''
: '';


// FILTER FABRICANTE
$filterFabricante = isset($_GET['filterFabricante'])
?
    $_GET['filterFabricante'] !== ""
    ?
    " and id_marca = {$_GET['filterFabricante']} "
    : ''
: '';


// FILTER CATEGORIA
$filterCategoria = isset($_GET['filterCategoria'])
?
    $_GET['filterCategoria'] !== ""
    ?
    " and id_categoria = {$_GET['filterCategoria']} "
    : ''
: '';


// FILTER SUB-CATEGORIA
$filterSubCategoria = isset($_GET['filterSubCategoria'])
?
    $_GET['filterSubCategoria'] !== ""
    ?
    " and id_subcategoria = {$_GET['filterSubCategoria']} "
    : ''
: '';


// SORT PRICE
$orderByPrice = isset($_GET['sortPrice'])
?
    $_GET['sortPrice'] !== ""
        ?
            $_GET['sortPrice'] === "lowerToHight"
                ? " order by precio ASC "
                : " order by precio DESC "
         : ''
: '';



$query =  " where estatus='si' $filterPriceForm $filterPrice $filterColor $filterFabricante $filterCategoria $filterSubCategoria ";

$limit = 12;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM productos $query $orderByPrice LIMIT $offset, $limit";

//echo $sql;

$result = mysqli_query($link, $sql);


if ($result) {
    $products = array();
    while ($row = mysqli_fetch_assoc($result)) {

        // consultamos las imagenes del producto

        $pic = mysqli_query($link, "select * from productos_imagenes where id_producto=" . $row["id"] . " order by orden ASC ");

        $images = array();

        while ($pics = mysqli_fetch_assoc($pic)) {
            array_push($images, URL . '/items/' . $pics["foto"]);
        }
        //$products['images'] = $images;
        $row['images'] = $images;


        // TALLA

        $talla = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM `productos_tallas` where estatus='si' and id_producto=" . $row["id"] . "  order by id ASC limit 0,1"));

        $row['id_talla'] = $talla["id_talla"];

        // Reviews

        $reviews = mysqli_query($link, "select * from reviews where product_id=" . $row["id"] . "  ");

        $estrellas = "";
        $promedio = 0;

        if($reviews){
            $filas = mysqli_num_rows($reviews);

            if($filas > 0){

                $valor=0;

                while($data = mysqli_fetch_assoc($reviews)){
                    $valor+=$data["rating"];
                }

                $promedio = $valor / $filas;
                 
            }
        }

        for($i = 1; $i < 6; $i++){
																		
            if($promedio>= $i) {
                $estrellas.='<i class="icon-star"></i> ';
            } else{
                $estrellas.='<i class="icon-star empty"></i>';
            }
                        
        }

        $row['stars'] = $estrellas;


        $row['to_url'] = URL . '/' . url($row['nombre_es']) . '-' . $row['id'] . '.html';

        // ASIGNAMOS EL LISTADO DE PRODUCTOS
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode($sql);
}
