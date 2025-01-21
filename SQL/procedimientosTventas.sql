DELIMITER //
CREATE PROCEDURE RegistrarVenta(
    IN p_id_cliente INT,
    IN p_id_propiedad INT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_fecha_venta DATE,
    IN p_detalles TEXT
)
BEGIN
    -- Insertar la nueva venta
INSERT INTO Ventas (id_cliente, id_propiedad, precio_total, fecha_venta, detalles)
VALUES (p_id_cliente, p_id_propiedad, p_precio_total, p_fecha_venta, p_detalles);

-- Actualizar la disponibilidad de la propiedad a 'vendida'
UPDATE Propiedades
SET disponibilidad = 'vendida'
WHERE id_propiedad = p_id_propiedad;
END //
DELIMITER ;
