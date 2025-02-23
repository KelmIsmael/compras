<?php
// Recibir los datos del carrito desde el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Guardar los datos del carrito en un archivo JSON
file_put_contents('carrito.json', json_encode($data));

echo json_encode(['status' => 'success']);
?>
