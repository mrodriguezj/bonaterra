<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCliente = (int)$_POST['idCliente'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $estadoCliente = $_POST['estadoCliente'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL ModificarCliente(:id, :nombre, :email, :telefono, :direccion, :estado)");
        $stmt->bindParam(':id', $idCliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estadoCliente, PDO::PARAM_STR);

        $stmt->execute();

        // Redirigir con éxito
        header("Location: ../../public/editar_cliente.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Redirigir con error
        header("Location: ../../public/editar_cliente.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../../public/editar_cliente.php");
    exit();
}

