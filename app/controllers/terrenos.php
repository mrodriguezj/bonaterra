<?php
//require_once '../config/database.php';
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombrePropiedad = $_POST['nombrePropiedad'];
    $ubicacion = $_POST['ubicacion'];
    $dimensiones = $_POST['dimensiones'];
    $precioTotal = $_POST['precioTotal'];
    $disponibilidad = $_POST['disponibilidad'];
    $descripcion = $_POST['descripcion'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL CrearPropiedad(?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $nombrePropiedad,
            $ubicacion,
            $dimensiones,
            $precioTotal,
            $disponibilidad,
            $descripcion,
        ]);
        header("Location: ../../public/index.php?success=1");
    } catch (PDOException $e) {
        header("Location: ../../public/index.php?error=" . urlencode($e->getMessage()));
    }
}
