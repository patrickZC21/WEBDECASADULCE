<?php
require_once "../conex.php";

function getAllCoupons() {
  global $conn;
  
  $query = "SELECT * FROM cupones";
  $result = $conn->query($query);
  $cupones = [];
  
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $cupones[] = $row;
    }
  }

  return $cupones;
}

function addCoupon($codigo, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos) {
  global $conn;

  $query = "INSERT INTO cupones (codigo, descripcion, tipo, valor, fecha_inicio, fecha_fin, minimo_compra, usos) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssdssii",$codigo, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos);
  
  return $stmt->execute();
}

function deleteCoupon($id) {
  global $conn;

  $query = "DELETE FROM cupones WHERE id = ?";
  
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $id);
  
  return $stmt->execute();
}

function updateCoupon($id, $codigo, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos) {
  global $conn;

  $query = "UPDATE cupones SET codigo = ?, descripcion = ?, tipo = ?, valor = ?, fecha_inicio = ?, fecha_fin = ?, minimo_compra = ?, usos = ? WHERE id = ?";
  
  $stmt = $conn->prepare($query);
  $stmt->bind_param("sssdssiii",$codigo, $descripcion, $tipo, $valor, $fecha_inicio, $fecha_fin, $minimo_compra, $usos, $id);
  
  return $stmt->execute();
}
?>