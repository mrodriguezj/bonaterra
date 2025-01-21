-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS aplicacion_cobranza
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

-- Usar la base de datos recién creada
USE aplicacion_cobranza;

-- Opcional: Verificar las bases de datos disponibles
SHOW DATABASES;


-- Tabla Usuarios
CREATE TABLE Usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'agente', 'cliente') DEFAULT 'cliente',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla Clientes
CREATE TABLE Clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    direccion TEXT,
    estado_cliente ENUM('activo', 'inactivo', 'moroso') DEFAULT 'activo',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla Propiedades
CREATE TABLE Propiedades (
    id_propiedad INT PRIMARY KEY AUTO_INCREMENT,
    nombre_propiedad VARCHAR(100) NOT NULL,
    ubicacion TEXT NOT NULL,
    dimensiones FLOAT NOT NULL,
    precio_total DECIMAL(12, 2) NOT NULL,
    disponibilidad ENUM('disponible', 'vendida', 'reservada') DEFAULT 'disponible',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descripcion TEXT
);

-- Tabla Cuentas por Cobrar
CREATE TABLE CuentasPorCobrar (
    id_cuenta INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_propiedad INT NOT NULL,
    precio_total DECIMAL(12, 2) NOT NULL,
    saldo_pendiente DECIMAL(12, 2) NOT NULL,
    numero_meses INT NOT NULL,
    monto_mensual DECIMAL(12, 2) NOT NULL,
    fecha_inicio DATE NOT NULL,
    estado_cuenta ENUM('pendiente', 'pagada', 'vencida') DEFAULT 'pendiente',
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_propiedad) REFERENCES Propiedades(id_propiedad)
);

-- Tabla Pagos
CREATE TABLE Pagos (
    id_pago INT PRIMARY KEY AUTO_INCREMENT,
    id_cuenta INT NOT NULL,
    monto_pago DECIMAL(12, 2) NOT NULL,
    fecha_pago DATE NOT NULL,
    metodo_pago ENUM('transferencia', 'tarjeta', 'efectivo') DEFAULT 'transferencia',
    referencia VARCHAR(100),
    FOREIGN KEY (id_cuenta) REFERENCES CuentasPorCobrar(id_cuenta)
);

-- Tabla Planes de Pago
CREATE TABLE PlanesDePago (
    id_plan INT PRIMARY KEY AUTO_INCREMENT,
    id_cuenta INT NOT NULL,
    numero_cuotas INT NOT NULL,
    monto_por_cuota DECIMAL(12, 2) NOT NULL,
    estado_plan ENUM('activo', 'cumplido', 'cancelado') DEFAULT 'activo',
    FOREIGN KEY (id_cuenta) REFERENCES CuentasPorCobrar(id_cuenta)
);

-- Tabla Historial de Cobranza
CREATE TABLE HistorialCobranza (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_agente INT NOT NULL,
    fecha_contacto TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    metodo_contacto ENUM('llamada', 'email', 'mensaje') DEFAULT 'llamada',
    resultado ENUM('acordado', 'rechazado', 'pendiente') DEFAULT 'pendiente',
    notas TEXT,
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_agente) REFERENCES Usuarios(id_usuario)
);

-- Tabla Notificaciones
CREATE TABLE Notificaciones (
    id_notificacion INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    id_cuenta INT,
    tipo_notificacion ENUM('recordatorio', 'alerta de pago') DEFAULT 'recordatorio',
    contenido TEXT NOT NULL,
    estado ENUM('enviado', 'leído', 'pendiente') DEFAULT 'pendiente',
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_cuenta) REFERENCES CuentasPorCobrar(id_cuenta)
);

-- Tabla Venta de propiedades
CREATE TABLE Ventas (
    id_venta INT PRIMARY KEY AUTO_INCREMENT,       -- ID único de la venta
    id_cliente INT NOT NULL,                       -- Cliente asociado a la venta
    id_propiedad INT NOT NULL,                     -- Propiedad asociada a la venta
    precio_total DECIMAL(12, 2) NOT NULL,          -- Precio total de la venta
    fecha_venta DATE NOT NULL,                     -- Fecha de la venta
    detalles TEXT,                                 -- Detalles adicionales (opcional)
    estado_venta ENUM('activa', 'cancelada') DEFAULT 'activa', -- Estado de la venta
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente),
    FOREIGN KEY (id_propiedad) REFERENCES Propiedades(id_propiedad)
);
