<?php
// Reemplaza esto con la información del cliente y del producto
$email = $to;
$product_id = $orden_id_producto;

// URL del formulario de review en tu sitio web
$review_url = "".URL."/reviews.php?product_id=" . $product_id . "&email=".$email;

// Prepara y envía el correo
$subject = "Por favor, califica tu compra";
$message = "Gracias por comprar en nuestra tienda en línea. Por favor, califica tu experiencia con el siguiente enlace: " . $review_url;
$headers = "From: noreply@example.com";

// Utiliza la función mail() de PHP o una biblioteca como PHPMailer
mail($email, $subject, $message, $headers);
$hide2="";
?>