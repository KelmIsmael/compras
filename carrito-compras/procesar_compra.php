<?php
session_start();
include 'db.php';

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    die("El carrito está vacío. <a href='index.php'>Volver</a>");
}

foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    $sql = "INSERT INTO pedidos (id_producto, cantidad) VALUES ($id_producto, $cantidad)";
    $conn->query($sql);
}

unset($_SESSION['carrito']);

echo "Compra realizada con éxito. <a href='index.php'>Volver</a>";
?>
