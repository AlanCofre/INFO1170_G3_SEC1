<?php
include '../Conex.php'; // Asegúrate de que este archivo contenga la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y sanitizar los datos enviados desde el formulario
    $id_reporte = isset($_POST['id_emergencia']) ? intval($_POST['id_emergencia']) : null;
    $descripcion_admin = isset($_POST['descripcion_actual']) ? htmlspecialchars($_POST['descripcion_actual']) : null;
    $tiempo_estimado = isset($_POST['tiempo_estimado_solucion']) ? htmlspecialchars($_POST['tiempo_estimado_solucion']) : null;

    // Verificar que todos los campos requeridos estén presentes
    if ($id_reporte && $descripcion_admin && $tiempo_estimado) {
        // Preparar la consulta SQL para actualizar la tabla 'reporte'
        $sql = "UPDATE reporte 
                SET descripcion_admin = ?, 
                    tiempo_estimado = ? 
                WHERE id_reporte = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Vincular los parámetros a la consulta
            $stmt->bind_param("ssi", $descripcion_admin, $tiempo_estimado, $id_reporte);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Reporte actualizado correctamente.";
            } else {
                echo "Error al actualizar el reporte: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }
    } else {
        echo "Faltan datos obligatorios.";
    }

    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
