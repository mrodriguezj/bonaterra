-- Crear un cliente
DELIMITER //
CREATE PROCEDURE CrearCliente(
    IN p_nombre VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_telefono VARCHAR(15),
    IN p_direccion TEXT
)
BEGIN
    INSERT INTO Clientes (nombre, email, telefono, direccion)
    VALUES (p_nombre, p_email, p_telefono, p_direccion);
END //
DELIMITER ;

-- Leer clientes
DELIMITER //
CREATE PROCEDURE LeerClientes()
BEGIN
    SELECT * FROM Clientes;
END //
DELIMITER ;

-- Actualizar un cliente
DELIMITER //
CREATE PROCEDURE ActualizarCliente(
    IN p_id_cliente INT,
    IN p_nombre VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_telefono VARCHAR(15),
    IN p_direccion TEXT,
    IN p_estado_cliente ENUM('activo', 'inactivo', 'moroso')
)
BEGIN
    UPDATE Clientes
    SET nombre = p_nombre, email = p_email, telefono = p_telefono, direccion = p_direccion, estado_cliente = p_estado_cliente
    WHERE id_cliente = p_id_cliente;
END //
DELIMITER ;

-- Eliminar un cliente
DELIMITER //
CREATE PROCEDURE EliminarCliente(
    IN p_id_cliente INT
)
BEGIN
    DELETE FROM Clientes WHERE id_cliente = p_id_cliente;
END //
DELIMITER ;
