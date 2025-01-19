-- Crear una cuenta por cobrar
DELIMITER //
CREATE PROCEDURE CrearCuentaPorCobrar(
    IN p_id_cliente INT,
    IN p_id_propiedad INT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_saldo_pendiente DECIMAL(12, 2),
    IN p_numero_meses INT,
    IN p_monto_mensual DECIMAL(12, 2),
    IN p_fecha_inicio DATE
)
BEGIN
    INSERT INTO CuentasPorCobrar (id_cliente, id_propiedad, precio_total, saldo_pendiente, numero_meses, monto_mensual, fecha_inicio)
    VALUES (p_id_cliente, p_id_propiedad, p_precio_total, p_saldo_pendiente, p_numero_meses, p_monto_mensual, p_fecha_inicio);
END //
DELIMITER ;

-- Leer cuentas por cobrar
DELIMITER //
CREATE PROCEDURE LeerCuentasPorCobrar()
BEGIN
    SELECT * FROM CuentasPorCobrar;
END //
DELIMITER ;

-- Actualizar una cuenta por cobrar
DELIMITER //
CREATE PROCEDURE ActualizarCuentaPorCobrar(
    IN p_id_cuenta INT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_saldo_pendiente DECIMAL(12, 2),
    IN p_estado_cuenta ENUM('pendiente', 'pagada', 'vencida')
)
BEGIN
    UPDATE CuentasPorCobrar
    SET precio_total = p_precio_total,
        saldo_pendiente = p_saldo_pendiente,
        estado_cuenta = p_estado_cuenta
    WHERE id_cuenta = p_id_cuenta;
END //
DELIMITER ;

-- Eliminar una cuenta por cobrar
DELIMITER //
CREATE PROCEDURE EliminarCuentaPorCobrar(
    IN p_id_cuenta INT
)
BEGIN
    DELETE FROM CuentasPorCobrar WHERE id_cuenta = p_id_cuenta;
END //
DELIMITER ;
