<?php
include('../base_datos/db.php'); // Conexión a la base de datos
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accesorios y Componentes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../vista_carrito/micss.css">
</head>

<body>

    <header class="header d-flex justify-content-between align-items-center p-3 bg-light shadow-sm">
        <div class="logo">
            <a href="../index.html" title="Inicio">
                <img src="../media/shop.jpg" alt="Bar de Mou" width="100">
            </a>
        </div>

        <form action="../../accesorios_componentes/buscar.php" method="GET" class="search-bar d-flex align-items-center">
            <input type="text" id="search-input" name="search" class="form-control" placeholder="Buscar productos..." aria-label="Buscar">
            <button type="submit" class="btn btn-primary ms-2">Buscar</button>
        </form>

        <div class="d-flex align-items-center">
            <a href="../index.html" class="icon-link me-3" aria-label="Iniciar Sesión" id="miCuenta" title="Iniciar Sesión">
                Inicio <i class="fas fa-sign-in-alt"></i>
            </a>

            <a href="../vista_carrito/agregar_al_carrito.php" class="icon-link position-relative" aria-label="Ver Carrito" title="Mi Carrito">
                Mi Carrito <i class="fas fa-shopping-cart"></i>
                <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
                </span>
            </a>

        </div>
    </header>

    <section class="container-fluid my-5">
        <h2 class="text-center mb-4">Nuestros Productos</h2>

        <div class="product-grid">
            <?php
                $sql = "SELECT id_accesorios_y_componentes, nombre, descripcion, precio, imagen, stock FROM accesorios_y_componentes ORDER BY id_accesorios_y_componentes ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $image_name = $row['imagen'];
                        $image_path = '../media/' . $image_name;

                        if (!file_exists($image_path)) {
                            $image_path = '../media/'; // Imagen por defecto
                        }

                        echo '<div class="product-card">';
                            echo '<div class="img-container">';
                                echo '<img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                            echo '</div>';
                            
                            echo '<div class="card-body p-3">';
                                echo '<h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
                                echo '<p class="card-text text-truncate">' . htmlspecialchars($row['descripcion']) . '</p>';
                                echo '<p class="card-text font-weight-bold">$' . number_format($row['precio'], 2) . '</p>';
                                echo '<p class="card-text text-warning">Stock: ' . htmlspecialchars($row['stock']) . '</p>';
                                
                                echo '<div class="quantity-controls">';
                                    echo '<button class="quantity-btn" onclick="adjustQuantity(\'quantity-' . $row['id_accesorios_y_componentes'] . '\', -1)">-</button>';
                                    echo '<span class="quantity-display" id="quantity-' . $row['id_accesorios_y_componentes'] . '-display">1</span>';
                                    echo '<button class="quantity-btn" onclick="adjustQuantity(\'quantity-' . $row['id_accesorios_y_componentes'] . '\', 1)">+</button>';
                                echo '</div>';
                                
                                // ✅ Corrección aquí: comillas simples dentro del echo
                                echo '<button class="add-to-cart-btn w-100 mt-3" onclick="addToCart(' . $row['id_accesorios_y_componentes'] . ')">Añadir al carrito</button>';
                            
                            echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No se encontraron productos.</p>";
                }
            ?>
        </div>
    </section>


    <!-- Footer -->
    <footer class="footer bg-dark text-white text-center py-3">
        <p>© 2025 Marquez Comunicaciones. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS & Font Awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <!-- Funciones JS -->
    <script src="../vista_carrito/carrito.js"></script> <!-- Aquí agregas el archivo carrito.js -->

</body>

</html>


