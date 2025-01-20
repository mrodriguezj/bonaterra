<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['term'])) {
    // Captura el término de búsqueda
    $term = trim($_GET['term']);

    try {
        // Conexión a la base de datos
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);

        // Llamada al procedimiento almacenado
        $stmt = $pdo->prepare("CALL BuscarClientesPorNombre(:term)");
        $stmt->bindParam(':term', $term, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener resultados
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($resultados) {
            // Devuelve resultados como JSON
            echo json_encode(['success' => true, 'data' => $resultados]);
        } else {
            // Devuelve una respuesta vacía si no hay resultados
            echo json_encode(['success' => true, 'data' => []]);
        }
    } catch (PDOException $e) {
        // Devuelve error si ocurre algún problema con la base de datos
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    // Devuelve error si no se cumple la solicitud adecuada
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
}
