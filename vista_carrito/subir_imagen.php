<?php
$host = "localhost"; // Cambia si es necesario
$user = "root";      // Usuario de la BD
$pass = "";          // Contraseña de la BD
$db   = "pruebas_marquez2"; // Reemplaza por el nombre de tu BD

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_accesorio_y_componentes = intval($_POST['id_accesorio_y_componentes']);
    $carpeta_destino = "media";

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $nombre_imagen = basename($_FILES["imagen"]["name"]);
        $ruta_final = $carpeta_destino . $nombre_imagen;

        // Verificar que sea una imagen
        $tipo_archivo = strtolower(pathinfo($ruta_final, PATHINFO_EXTENSION));
        $tipos_permitidos = array("jpg", "jpeg", "png", "gif");

        if (in_array($tipo_archivo, $tipos_permitidos)) {
            // Mover la imagen a la carpeta
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_final)) {
                
                // Actualizar la BD con la ruta de la imagen
                $sql = "UPDATE accesorios_y_componentes SET imagen = '$ruta_final' WHERE id_accesorio_y_componentess_y_componentes = $id_accesorio_y_componentes";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            alert('Imagen subida y guardada con éxito.');
                            window.location.href = 'formulario_imagen.php';
                          </script>";
                } else {
                    echo "Error al actualizar la base de datos: " . $conn->error;
                }
            } else {
                echo "Error al mover el archivo al servidor.";
            }
        } else {
            echo "Formato de archivo no permitido. Solo se aceptan JPG, JPEG, PNG y GIF.";
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

$conn->close();
?>
