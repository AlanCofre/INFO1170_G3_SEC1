<?php
// Incluye el archivo de conexión a la base de datos
include 'Conex.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos obligatorios
    $errores = [];

    if (empty($_POST['nombre'])) {
        $errores[] = "El campo 'Nombre' es obligatorio.";
    }

    if (empty($_POST['email'])) {
        $errores[] = "El campo 'Correo Electrónico' es obligatorio.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    if (empty($_POST['password'])) {
        $errores[] = "El campo 'Contraseña' es obligatorio.";
    } elseif (strlen($_POST['password']) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres.";
    }

    if (empty($errores)) {
        // Escapar los datos
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

        // Verificar si el correo ya existe
        $query = "SELECT id FROM tecnicos WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Este correo ya está registrado. Por favor, usa otro.";
        } else {
            // Insertar el nuevo técnico
            $query = "INSERT INTO tecnicos (nombre, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $nombre, $email, $password);

            if ($stmt->execute()) {
                echo "¡Técnico registrado exitosamente!";
            } else {
                echo "Hubo un error al registrar al técnico. Intenta nuevamente.";
            }
        }

        $stmt->close();
    } else {
        // Mostrar los errores encontrados
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>
