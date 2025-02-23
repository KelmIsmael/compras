<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

if (isset($_GET['add_to_cart'])) {
    $id_producto = intval($_GET['add_to_cart']);
    $query = "SELECT * FROM accesorios_y_componentes WHERE id_accesorios_y_componentes = $id_producto";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result);

        $item = [
            'id' => $producto['id_accesorios_y_componentes'],
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad' => 1
        ];

        if (isset($_SESSION['carrito'][$id_producto])) {
            $_SESSION['carrito'][$id_producto]['cantidad'] += 1;
        } else {
            $_SESSION['carrito'][$id_producto] = $item;
        }

        header('Location: productos.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Accesorios y Componentes</h2>

        <a href="carrito.php" class="btn btn-warning mb-3">Ver Carrito</a>

        <div class="row">
            <?php
            $sql = "SELECT * FROM accesorios_y_componentes ORDER BY id_accesorios_y_componentes ASC";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="' . htmlspecialchars($row['imagen']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '<p class="card-text">Precio: $' . number_format($row['precio'], 2) . '</p>';
                    echo '<a href="productos.php?add_to_cart=' . $row['id_accesorios_y_componentes'] . '" class="add-to-cart-btn btn btn-primary w-100 mt-3" data-id="' . $row['id_accesorios_y_componentes'] . '">Añadir al carrito</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No se encontraron productos.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
