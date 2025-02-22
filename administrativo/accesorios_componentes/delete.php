<?php
// delete.php
include '../../base_datos/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM accesorios_y_componentes WHERE id_accesorios_y_componentes = $id";

    if (mysqli_query($conn, $query)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al eliminar accesorio: " . mysqli_error($conn);
    }
}
?>
