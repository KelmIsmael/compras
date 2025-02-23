<?php
// edit.php
include '../../base_datos/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM accesorios_y_componentes WHERE id_accesorios_y_componentes = $id");
    $row = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $stock = intval($_POST['stock']);

    $imagen = $row['imagen'];
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = 'uploads/' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    }

    $query = "UPDATE accesorios_y_componentes SET nombre='$nombre', descripcion='$descripcion', imagen='$imagen', precio=$precio, stock=$stock WHERE id_accesorios_y_componentes = $id";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al actualizar accesorio: " . mysqli_error($conn);
    }
}
?>

<?php include('../../includes/header.php'); ?>

<div class="container mt-5">
    <h1>Editar Accesorio</h1>
    <a href="../../administrativo/accesorios_componentes/index.php" class="btn btn-secondary mb-3">Volver</a>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id_accesorios_y_componentes']; ?>">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($row['nombre']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" required><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
            <?php if (!empty($row['imagen'])) { ?>
                <img src="<?php echo htmlspecialchars($row['imagen']); ?>" alt="Imagen" width="80" height="80">
            <?php } ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?php echo htmlspecialchars($row['precio']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="<?php echo htmlspecialchars($row['stock']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('../../includes/footer.php'); ?>