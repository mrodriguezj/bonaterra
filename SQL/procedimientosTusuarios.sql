-- Crear un usuario
DELIMITER //
CREATE PROCEDURE CrearUsuario(
    IN p_nombre VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_contraseña VARCHAR(255),
    IN p_rol ENUM('admin', 'agente', 'cliente')
)
BEGIN
    INSERT INTO Usuarios (nombre, email, contraseña, rol)
    VALUES (p_nombre, p_email, p_contraseña, p_rol);
END //
DELIMITER ;

-- Leer usuarios
DELIMITER //
CREATE PROCEDURE LeerUsuarios()
BEGIN
    SELECT * FROM Usuarios;
END //
DELIMITER ;

-- Actualizar un usuario
DELIMITER //
CREATE PROCEDURE ActualizarUsuario(
    IN p_id_usuario INT,
    IN p_nombre VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_rol ENUM('admin', 'agente', 'cliente'),
    IN p_estado ENUM('activo', 'inactivo')
)
BEGIN
    UPDATE Usuarios
    SET nombre = p_nombre, email = p_email, rol = p_rol, estado = p_estado
    WHERE id_usuario = p_id_usuario;
END //
DELIMITER ;

-- Eliminar un usuario
DELIMITER //
CREATE PROCEDURE EliminarUsuario(
    IN p_id_usuario INT
)
BEGIN
    DELETE FROM Usuarios WHERE id_usuario = p_id_usuario;
END //
DELIMITER ;
