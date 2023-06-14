<?php
require_once "conex.php";

function getCouponByCode($codigo) {
  global $conn;
  
  $query = "SELECT * FROM cupones WHERE codigo = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $codigo);
  $stmt->execute();
  $result = $stmt->get_result();
  
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  } else {
    return null;
  }
}

function applyCoupon($codigo, $subtotal) {
  $cupon = getCouponByCode($codigo);

  if (!$cupon) {
    return ["error" => "Cupón inválido."];
  }

  $fecha_actual = new DateTime();
  $fecha_inicio = new DateTime($cupon["fecha_inicio"]);
  $fecha_fin = new DateTime($cupon["fecha_fin"]);

  if ($fecha_actual < $fecha_inicio || $fecha_actual > $fecha_fin) {
    return ["error" => "Cupón expirado o aún no disponible."];
  }

  if ($cupon["minimo_compra"] !== null && $subtotal < $cupon["minimo_compra"]) {
    return ["error" => "El importe mínimo de compra para aplicar este cupón es de {$cupon["minimo_compra"]}."];
  }

  $descuento = 0;

  if ($cupon["tipo"] === "porcentaje") {
    $descuento = $subtotal * ($cupon["valor"] / 100);
  } elseif ($cupon["tipo"] === "fijo") {
    $descuento = $cupon["valor"];
  }

  return [
    "codigo" => $cupon["codigo"],
    "id_cupon" => $cupon["id"],
    "descripcion" => $cupon["descripcion"],
    "descuento" => $descuento,
    "total" => $subtotal - $descuento
  ];
}
?>