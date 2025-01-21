<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    $stmt = $pdo->query("SELECT id_propiedad, nombre_propiedad FROM Propiedades WHERE disponibilidad = 'disponible'");
    $propiedades = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'propiedades' => $propiedades]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
