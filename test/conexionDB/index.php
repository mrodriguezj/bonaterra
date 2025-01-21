<?php
// Cargar la configuración desde el archivo config.php
$config = require __DIR__ . '/../../config/configRemote.php';

// Crear la conexión utilizando mysqli
$conn = new mysqli(
    $config['db_host'],
    $config['db_user'],
    $config['db_pass'],
    $config['db_name']
);

// Verificar la conexión
if ($conn->connect_error) {
    die("<h1>Conexión fallida</h1><p>Detalles: " . $conn->connect_error . "</p>");
}

echo "<h1>Conexión exitosa a la base de datos</h1>";
?>
