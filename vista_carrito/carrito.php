<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Carrito de Compras</h2>

        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            echo '<table class="table table-bordered">';
            echo '<thead><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><th>Acciones</th></tr></thead><tbody>';

            $total_general = 0;

            foreach ($_SESSION['carrito'] as $item) {
                $total = $item['precio'] * $item['cantidad'];
                $total_general += $total;

                echo '<tr>';
                echo '<td>' . htmlspecialchars($item['nombre']) . '</td>';
                echo '<td>' . $item['cantidad'] . '</td>';
                echo '<td>$' . number_format($item['precio'], 2) . '</td>';
                echo '<td>$' . number_format($total, 2) . '</td>';
                echo '<td><a href="eliminar_del_carrito.php?id=' . $item['id'] . '" class="btn btn-danger btn-sm">Eliminar</a></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '<tfoot><tr><th colspan="3">Total General</th><th>$' . number_format($total_general, 2) . '</th><th></th></tr></tfoot>';
            echo '</table>';
            echo '<a href="finalizar_compra.php" class="btn btn-success">Finalizar Compra</a>';
        } else {
            echo '<p>El carrito está vacío.</p>';
        }
        ?>

        <a href="productos.php" class="btn btn-primary mt-3">Seguir Comprando</a>
    </div>
</body>
</html>
