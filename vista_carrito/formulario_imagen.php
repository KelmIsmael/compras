<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Imagen de Accesorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Subir Imagen para Accesorio</h2>
    
    <form action="../vista_carrito/subir_imagen.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="id_accesorio_y_componentes" class="form-label">ID del Accesorio:</label>
            <input type="number" name="id_accesorio_y_componentes" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Seleccionar Imagen:</label>
            <input type="file" name="imagen" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Subir Imagen</button>
    </form>
</body>
</html>
