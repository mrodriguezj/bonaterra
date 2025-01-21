<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

try {
    $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
    $stmt = $pdo->query("SELECT id_cliente, nombre FROM Clientes WHERE estado_cliente = 'activo'");
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'clientes' => $clientes]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
