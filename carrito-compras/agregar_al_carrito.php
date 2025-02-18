<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    if (isset($_SESSION['carrito'][$id_producto])) {
        $_SESSION['carrito'][$id_producto] += $cantidad;
    } else {
        $_SESSION['carrito'][$id_producto] = $cantidad;
    }
}

header("Location: ver_carrito.php");
exit();
?>
