<?php include "conex.php";

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$product_id = intval($_POST['product_id']);
$email = $_POST['email'];
$rating = intval($_POST['rating']);
$title = $_POST['title'];
$description = $_POST['description'];

$stmt = $conn->prepare("INSERT INTO reviews (product_id, email, rating, title, description) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isiss", $product_id, $email, $rating, $title, $description);

if ($stmt->execute()) {
  echo true;
} else {
  echo "error";
}

$stmt->close();
$conn->close();
?>