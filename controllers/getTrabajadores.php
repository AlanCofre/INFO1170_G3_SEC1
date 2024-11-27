<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conex.php';

header('Content-Type: application/json');

try {
    $conn = conectar();
    $sql = "SELECT id, nombre, puesto, estado FROM trabajadores";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $workers = [];
        while ($row = $result->fetch_assoc()) {
            $workers[] = $row;
        }
        echo json_encode($workers);
    } else {
        echo json_encode(['error' => 'No se encontraron trabajadores']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
