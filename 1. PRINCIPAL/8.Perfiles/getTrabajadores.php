<?php
require_once 'Conex.php'; // Archivo para la conexión a la base de datos

header('Content-Type: application/json');

try {
    $conn = conectar(); // Asumiendo que la función `conectar` retorna la conexión a la base de datos
    $stmt = $conn->prepare("SELECT id, nombre, puesto, estado FROM trabajadores");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result); // Devolver los datos en formato JSON
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
