<?php
include('../base_datos/db.php'); // Conexión a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas</title>
    <link rel="stylesheet" href="../vista_carrito/estilopaginas.css">
</head>
<body>
    <header class="header">
        <h1>Ofertas Disponibles</h1>
    </header>

    <a href="javascript:history.back()" class="back-button">Volver</a>

    <section class="container-fluid my-5">
        <div class="product-grid row">
            <?php
                $sql = "SELECT id_accesorios_y_componentes, nombre, precio, imagen FROM accesorios_y_componentes ORDER BY id_accesorios_y_componentes ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $image_name = $row['imagen'];
                        $image_path = '../media/' . $image_name;

                        if (!file_exists($image_path)) {
                            $image_path = '../media/default.png'; // Imagen por defecto
                        }

                        echo '<div class="col-md-4">';
                            echo '<div class="product-card">';
                                echo '<img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                                echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
                                    echo '<p class="card-text">$' . number_format($row['precio'], 2) . '</p>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p class='text-center'>No se encontraron productos.</p>";
                }
            ?>
        </div>
    </section>

    <footer class="footer text-center">
        <p>&copy; 2024 Marquez Comunicaciones. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
