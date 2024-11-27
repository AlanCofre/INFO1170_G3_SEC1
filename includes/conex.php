<?php
function conectar() {
    $host = 'db.inf.uct.cl';
    $db = 'A2024_ylisana';
    $user = 'ylisana';
    $pass = 'WJn4R3xmVPN95t+N9';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die('Error en la conexión: ' . $conn->connect_error);
    }

    return $conn;
}
?>
