<?php
function conectar() {
    $host = 'db.inf.uct.cl';
    $db = 'A2024_ylisana';
    $user = 'ylisana';
    $pass = 'WJn4R3xmVPN95t+N9';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Error en la conexión: " . $e->getMessage());
    }
}
?>
