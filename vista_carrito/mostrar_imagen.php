<?php
$conexion = new mysqli("localhost", "root", "", "pruebas_marquez2");

$resultado = $conexion->query("SELECT * FROM accesorios_y_componentes");

while ($row = $resultado->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
    echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
    echo "<p>Stock: " . $row['stock'] . "</p>";

    if (!empty($row['imagen'])) {
        echo "<img src='" . htmlspecialchars($row['imagen']) . "' width='150' alt='Imagen del producto'>";
    } else {
        echo "<p>Sin imagen disponible</p>";
    }

    echo "</div><hr>";
}
$conexion->close();
?>
