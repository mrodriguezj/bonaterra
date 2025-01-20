<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $estadoCliente = $_POST['estadoCliente'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL CrearCliente(:nombre, :email, :telefono, :direccion, :estadoCliente)");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':estadoCliente', $estadoCliente, PDO::PARAM_STR);

        $stmt->execute();

        // Redirigir con mensaje de éxito
        header("Location: ../../public/nuevo_cliente.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header("Location: ../../public/nuevo_cliente.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Redirigir si no es una solicitud válida
    header("Location: ../../public/nuevo_cliente.php");
    exit();
}
