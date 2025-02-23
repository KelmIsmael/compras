<?php
include('../base_datos/db.php');

// Verificar si se pasó el ID del producto en la URL
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); // Asegurarse de que el ID sea un número entero

    // Usar una sentencia preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT id_accesorios_y_componentes, nombre, precio, imagen FROM accesorios_y_componentes WHERE id_accesorios_y_componentes = ?");
    
    // Comprobar si la preparación de la sentencia fue exitosa
    if ($stmt === false) {
        echo json_encode(['error' => 'Error en la preparación de la consulta']);
        exit;
    }

    $stmt->bind_param("i", $productId); // "i" es el tipo de dato para enteros
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontró el producto
    if ($result->num_rows > 0) {
        // Devolver el producto como un objeto JSON
        echo json_encode($result->fetch_assoc());
    } else {
        // Si no se encuentra el producto, devolver un mensaje de error
        echo json_encode(['error' => 'Producto no encontrado']);
    }

    // Cerrar la sentencia
    $stmt->close();
} else {
    // Si no se pasa un ID válido, devolver un mensaje de error
    echo json_encode(['error' => 'ID no válido']);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
