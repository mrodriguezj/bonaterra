<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCliente = (int)$_POST['idCliente'];
    $idPropiedad = (int)$_POST['idPropiedad'];
    $precioTotal = (float)$_POST['precioTotal'];
    $fechaVenta = $_POST['fechaVenta'];
    $detalles = $_POST['detalles'] ?? '';

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);

        // Validar la propiedad
        $stmt = $pdo->prepare("CALL ValidarPropiedad(:idPropiedad)");
        $stmt->bindParam(':idPropiedad', $idPropiedad, PDO::PARAM_INT);
        $stmt->execute();
        $propiedad = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$propiedad) {
            // Propiedad no existe
            header("Location: ../../public/registro_venta.php?error=Lote no encontrado.");
            exit();
        }

        if ($propiedad['disponibilidad'] !== 'disponible') {
            // Propiedad no está disponible para la venta
            $estado = $propiedad['disponibilidad'];
            header("Location: ../../public/registro_venta.php?error=Lote no disponible para la venta. Estado: $estado");
            exit();
        }

        // Registrar la venta
        $stmt = $pdo->prepare("CALL RegistrarVenta(:idCliente, :idPropiedad, :precioTotal, :fechaVenta, :detalles)");
        $stmt->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stmt->bindParam(':idPropiedad', $idPropiedad, PDO::PARAM_INT);
        $stmt->bindParam(':precioTotal', $precioTotal, PDO::PARAM_STR);
        $stmt->bindParam(':fechaVenta', $fechaVenta, PDO::PARAM_STR);
        $stmt->bindParam(':detalles', $detalles, PDO::PARAM_STR);

        $stmt->execute();

        // Redirigir con mensaje de éxito
        header("Location: ../../public/registro_venta.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Redirigir con mensaje de error
        header("Location: ../../public/registro_venta.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ../../public/registro_venta.php");
    exit();
}
