<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $ubicacion = $_POST['ubicacion'];
    $dimensiones = (float)$_POST['dimensiones'];
    $precio = (float)$_POST['precio'];
    $disponibilidad = $_POST['disponibilidad'];
    $tipoPropiedad = $_POST['tipoPropiedad'];
    $descripcion = $_POST['descripcion'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL CrearPropiedad(:nombre, :ubicacion, :dimensiones, :precio, :disponibilidad, :tipoPropiedad, :descripcion)");
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
        $stmt->bindParam(':dimensiones', $dimensiones, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precio, PDO::PARAM_STR);
        $stmt->bindParam(':disponibilidad', $disponibilidad, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPropiedad', $tipoPropiedad, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: ../../public/index.php?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: ../../public/index.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../../public/index.php");
    exit();
}
