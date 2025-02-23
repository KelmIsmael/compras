<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($_SESSION['carrito'] as $key => $item) {
        if ($item['id'] == $id) {
            unset($_SESSION['carrito'][$key]);
            break;
        }
    }
}

header('Location: carrito.php');
exit;
?>
