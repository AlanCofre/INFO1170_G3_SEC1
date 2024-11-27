<?php
include '../includes/conex.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tipo_problema = htmlspecialchars($_POST['tipo_problema']);
    $descripcion_cliente = htmlspecialchars($_POST['descripcion_detallada']);
    $fecha_reporte = htmlspecialchars($_POST['fecha_hora_inicio']);
    $ubicacion_problema = htmlspecialchars($_POST['direccion']);
    $imagen = null;

    if (!empty($_FILES['imagenes_videos']['name'][0])) {
        $target_dir = "uploads/";
        $imagen = $target_dir . basename($_FILES['imagenes_videos']['name'][0]);
        move_uploaded_file($_FILES['imagenes_videos']['tmp_name'][0], $imagen);
    }

    $sql = "INSERT INTO reporte (tipo_problema, descripcion_cliente, fecha_reporte, ubicacion_problema, imagen)
            VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $tipo_problema, $descripcion_cliente, $fecha_reporte, $ubicacion_problema, $imagen);

        if ($stmt->execute()) {
            echo "Reporte guardado con éxito.";
        } else {
            echo "Error al guardar el reporte: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no permitido.";
}
?>
