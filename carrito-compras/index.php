<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Acción</th>
        </tr>
        <?php
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) :
        ?>
        <tr>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['precio'] ?></td>
            <td>
                <form action="agregar_al_carrito.php" method="POST">
                    <input type="hidden" name="id_producto" value="<?= $row['id_productos'] ?>">
                    <input type="number" name="cantidad" value="1" min="1">
                    <button type="submit">Agregar</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="ver_carrito.php">Ver Carrito</a>
</body>
</html>
