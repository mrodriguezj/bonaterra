-- Creación de la tabla propiedades
CREATE TABLE propiedades (
    id_lote INT AUTO_INCREMENT PRIMARY KEY,         -- Identificador único del lote
    dimensiones DECIMAL(8,2) NOT NULL,              -- Superficie en metros cuadrados
    precio DECIMAL(10,2) NOT NULL,                  -- Precio actual de la propiedad
    tipo ENUM('premium', 'regular', 'comercial') NOT NULL, -- Clasificación del lote
    disponibilidad ENUM('disponible', 'vendido', 'reservado') NOT NULL, -- Estado del lote
    observaciones TEXT                              -- Detalles adicionales
);

-- Creación de la tabla historial_precios
CREATE TABLE historial_precios (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,    -- Identificador único del registro
    id_lote INT NOT NULL,                           -- Referencia al lote
    precio_anterior DECIMAL(10,2),                  -- Precio antes del cambio
    precio_nuevo DECIMAL(10,2) NOT NULL,            -- Precio actualizado
    fecha_cambio DATETIME NOT NULL DEFAULT NOW(),   -- Fecha y hora del cambio
    motivo_cambio TEXT,                             -- Observaciones sobre el cambio
    FOREIGN KEY (id_lote) REFERENCES propiedades(id_lote) -- Llave foránea a la tabla propiedades
);
