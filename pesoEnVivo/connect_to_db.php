<?php
function conectarDB() {
    $servername = "localhost"; // Nombre del servidor MySQL (usualmente localhost)
    $username = "root"; // Nombre de usuario de MySQL
    $password = ""; // Contraseña de MySQL
    $database = "pesoplumadb"; // Nombre de la base de datos a la que te quieres conectar

    // Crear una conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Retornar la conexión
    return $conn;
}
?>