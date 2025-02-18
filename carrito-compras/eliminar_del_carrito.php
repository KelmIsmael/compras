<?php
session_start();
if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    unset($_SESSION['carrito'][$id_producto]);
}
header("Location: ver_carrito.php");
exit();
?>
