-- Crear una propiedad
DELIMITER //
CREATE PROCEDURE CrearPropiedad(
    IN p_nombre_propiedad VARCHAR(100),
    IN p_ubicacion TEXT,
    IN p_dimensiones FLOAT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_disponibilidad ENUM('disponible', 'vendida', 'reservada'),
    IN p_descripcion TEXT
)
BEGIN
    INSERT INTO Propiedades (nombre_propiedad, ubicacion, dimensiones, precio_total, disponibilidad, descripcion)
    VALUES (p_nombre_propiedad, p_ubicacion, p_dimensiones, p_precio_total, p_disponibilidad, p_descripcion);
END //
DELIMITER ;

-- Leer propiedades
DELIMITER //
CREATE PROCEDURE LeerPropiedades()
BEGIN
    SELECT * FROM Propiedades;
END //
DELIMITER ;

-- Actualizar una propiedad
DELIMITER //
CREATE PROCEDURE ActualizarPropiedad(
    IN p_id_propiedad INT,
    IN p_nombre_propiedad VARCHAR(100),
    IN p_ubicacion TEXT,
    IN p_dimensiones FLOAT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_disponibilidad ENUM('disponible', 'vendida', 'reservada'),
    IN p_descripcion TEXT
)
BEGIN
    UPDATE Propiedades
    SET nombre_propiedad = p_nombre_propiedad,
        ubicacion = p_ubicacion,
        dimensiones = p_dimensiones,
        precio_total = p_precio_total,
        disponibilidad = p_disponibilidad,
        descripcion = p_descripcion
    WHERE id_propiedad = p_id_propiedad;
END //
DELIMITER ;

-- Eliminar una propiedad
DELIMITER //
CREATE PROCEDURE EliminarPropiedad(
    IN p_id_propiedad INT
)
BEGIN
    DELETE FROM Propiedades WHERE id_propiedad = p_id_propiedad;
END //
DELIMITER ;
