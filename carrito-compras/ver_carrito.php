<?php
session_start();
include 'db.php';

$carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : array();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Acción</th>
        </tr>
        <?php foreach ($carrito as $id_producto => $cantidad) : 
            $sql = "SELECT nombre FROM productos WHERE id_productos = $id_producto";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $cantidad ?></td>
            <td><a href="eliminar_del_carrito.php?id=<?= $id_producto ?>">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Seguir Comprando</a> | 
    <a href="procesar_compra.php">Finalizar Compra</a>
</body>
</html>
    