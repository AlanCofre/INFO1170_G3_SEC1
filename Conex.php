<?php
// ESTE ARCHIVO ES PARA HACER LAS CONEXIONES A LA BASE DE DATOS (LA DE ALAN). YA ESTÁ CONFIGURADO. 

// Parámetros de conexión
$host = 'mysql.inf.uct.cl'; // Dirección del servidor MySQL, por lo general localhost
$dbname = 'A2019_acofre'; // Nombre de la base de datos
$username = 'acofre'; // Usuario de MySQL
$password = 'pLEjshtnC29jdyw8X'; // Contraseña de MySQL

try {
    // Crear una nueva conexión PDO (PHP Data Objects)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
   
    // Establecer el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    // Si la conexión es exitosa, puedes usar la variable $pdo para interactuar con la base de datos  
    // echo "Conexión exitosa a la base de datos"; // Puedes descomentar esto para comprobar si la conexión fue exitosa

} catch (PDOException $e) {
    // Si hay un error, muestra el mensaje
    die("Error de conexión: " . $e->getMessage());
}
?>

//----------------------------------- EJEMPLO PARA HACER LA CONEXION ------------------------------------------

<?php
// Incluir la configuración de la base de datos
require_once 'Conex.php';

// Aquí puedes usar $pdo para realizar consultas a la base de datos
// Ejemplo de consulta:
$query = $pdo->query("SELECT * FROM usuarios");
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

// Mostrar los resultados
foreach ($usuarios as $usuario) {
    echo $usuario['nombre'] . ' - ' . $usuario['email'] . '<br>';
}
?>