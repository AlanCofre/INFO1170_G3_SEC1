<?php
// Incluir el archivo de conexión
include '../Conex.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_cliente = 1; // Supongamos que tienes un ID de cliente (puedes cambiar esto por el ID real del cliente)
    $tipo_problema = $_POST['tipo_problema'];
    $descripcion_cliente = $_POST['descripcion_cliente'];
    $fecha_reporte = $_POST['fecha_reporte'];
    $ubicacion_problema = $_POST['ubicacion_problema'];

    // Manejo de la subida de la imagen
    $imagen = '';
    if (!empty($_FILES['imagen']['name'])) {
        $imagen = basename($_FILES['imagen']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $imagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO Reporte (id_cliente, tipo_problema, descripcion_cliente, fecha_reporte, ubicacion_problema, imagen)
            VALUES ('$id_cliente', '$tipo_problema', '$descripcion_cliente', '$fecha_reporte', '$ubicacion_problema', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Datos guardados correctamente.";
        header("Location: ../5. Updates/update_cliente.html"); // Redirigir después de guardar
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
