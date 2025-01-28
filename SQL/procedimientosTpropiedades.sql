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

-- Actualizar una propiedad 2.0
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
    -- Validaciones
    IF p_dimensiones <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las dimensiones deben ser mayores que 0';
END IF;

    IF p_precio_total <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El precio total debe ser mayor que 0';
END IF;

    -- Actualización
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

-- Consultar propiedades por ID version 2.0
    DELIMITER //
CREATE PROCEDURE LeerPropiedadPorId(
    IN p_id_propiedad INT
)
BEGIN
SELECT *
FROM Propiedades
WHERE id_propiedad = p_id_propiedad;
END //
DELIMITER ;

--Validar propiedades antes de hacer una venta
DELIMITER //
CREATE PROCEDURE ValidarPropiedad(
    IN p_id_propiedad INT
)
BEGIN
SELECT
    id_propiedad,
    disponibilidad
FROM Propiedades
WHERE id_propiedad = p_id_propiedad;
END //
DELIMITER ;

--Crear propiedades 2.0
DELIMITER //
CREATE PROCEDURE CrearPropiedad(
    IN p_nombre_propiedad VARCHAR(100),
    IN p_ubicacion TEXT,
    IN p_dimensiones FLOAT,
    IN p_precio_total DECIMAL(12, 2),
    IN p_disponibilidad ENUM('disponible', 'vendida', 'reservada'),
    IN p_tipo_propiedad ENUM('comercial', 'premium', 'regular'),
    IN p_descripcion TEXT
        )
BEGIN
INSERT INTO Propiedades (nombre_propiedad, ubicacion, dimensiones, precio_total, disponibilidad, tipo_propiedad, descripcion)
VALUES (p_nombre_propiedad, p_ubicacion, p_dimensiones, p_precio_total, p_disponibilidad, p_tipo_propiedad, p_descripcion);
END //
DELIMITER ;


--Crear 200 registros rapidos
DELIMITER //
CREATE PROCEDURE InsertarPropiedades()
BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 200 DO
        INSERT INTO Propiedades (
            nombre_propiedad,
            ubicacion,
            dimensiones,
            precio_total,
            disponibilidad,
            tipo_propiedad,
            fecha_registro
        )
        VALUES (
            CONCAT('Lote ', i), -- Genera nombres como 'Propiedad 4', 'Propiedad 5', etc.
            'Cancun',               -- Ubicación fija
            0,                      -- Dimensiones fijas
            1,                      -- Precio fijo
            'disponible',           -- Disponibilidad fija
            'regular',              -- Tipo de propiedad fija
            NOW()                   -- Fecha de registro actual
        );
        SET i = i + 1;
END WHILE;
END //
DELIMITER ;

-- Llama al procedimiento para insertar los registros
CALL InsertarPropiedades();
