<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Lógica para consulta de datos (LeerPropiedadPorId)
    $idPropiedad = (int) $_GET['id'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL LeerPropiedadPorId(:id)");
        $stmt->bindParam(':id', $idPropiedad, PDO::PARAM_INT);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            echo json_encode(['success' => true, 'propiedad' => $resultado]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Propiedad no encontrada.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para actualizar los datos (ActualizarPropiedad)
    $idPropiedad = (int) $_POST['idPropiedad'];
    $nombrePropiedad = $_POST['nombrePropiedad'];
    $ubicacion = $_POST['ubicacion'];
    $dimensiones = (float) $_POST['dimensiones'];
    $precioTotal = (float) $_POST['precioTotal'];
    $disponibilidad = $_POST['disponibilidad'];
    $descripcion = $_POST['descripcion'];

    try {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $stmt = $pdo->prepare("CALL ActualizarPropiedad(:id, :nombre, :ubicacion, :dimensiones, :precio, :disponibilidad, :descripcion)");
        $stmt->bindParam(':id', $idPropiedad, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombrePropiedad, PDO::PARAM_STR);
        $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
        $stmt->bindParam(':dimensiones', $dimensiones, PDO::PARAM_STR);
        $stmt->bindParam(':precio', $precioTotal, PDO::PARAM_STR);
        $stmt->bindParam(':disponibilidad', $disponibilidad, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);

        $stmt->execute();

        // Redirigir al formulario con un mensaje de éxito
        header("Location: ../../public/gestion_propiedad.php?success=1");
        exit();
    } catch (PDOException $e) {
        // Redirigir al formulario con un mensaje de error
        header("Location: ../../public/gestion_propiedad.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // Redirigir si no se cumple ninguna condición válida
    header("Location: ../../public/gestion_propiedad.php");
    exit();
}
