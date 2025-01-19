proyecto-cobranza/
├── public/                # Archivos accesibles públicamente
│   ├── index.php          # Página principal (dashboard)
│   ├── css/               # Estilos CSS
│   ├── js/                # Scripts JavaScript
│   └── bootstrap/         # Archivos de Bootstrap
│
├── app/                   # Lógica del servidor
│   ├── controllers/       # Controladores PHP
│   │   ├── terrenos.php   # Gestión de terrenos
│   │   ├── clientes.php   # Gestión de clientes
│   │   ├── pagos.php      # Gestión de pagos
│   │   ├── reportes.php   # Gestión de reportes
│   │   ├── alertas.php    # Gestión de alertas y calendario
│   │   ├── recibos.php    # Generación de recibos electrónicos
│   │   └── usuarios.php   # Gestión de usuarios
│   ├── models/            # Modelos PHP (consultas a la base de datos)
│   │   ├── Terreno.php    # Modelo para terrenos
│   │   ├── Cliente.php    # Modelo para clientes
│   │   ├── Pago.php       # Modelo para pagos
│   │   ├── Alerta.php     # Modelo para alertas
│   │   └── Usuario.php    # Modelo para usuarios
│   └── views/             # Plantillas PHP o HTML
│       ├── terrenos/      # Plantillas relacionadas con terrenos
│       ├── clientes/      # Plantillas relacionadas con clientes
│       ├── pagos/         # Plantillas relacionadas con pagos
│       ├── reportes/      # Plantillas relacionadas con reportes
│       ├── alertas/       # Plantillas relacionadas con calendario y alertas
│       ├── recibos/       # Plantillas relacionadas con recibos electrónicos
│       └── usuarios/      # Plantillas relacionadas con usuarios
│
├── config/                # Configuración global
│   ├── config.php         # Archivo de configuración
│   ├── database.php       # Conexión a la base de datos
│   └── helpers.php        # Funciones comunes
│
├── sql/                   # Scripts SQL para la base de datos
│   ├── schema.sql         # Estructura de tablas
│   ├── procedures.sql     # Procedimientos almacenados
│   ├── alerts.sql         # Procedimientos para alertas
│   └── receipts.sql       # Procedimientos para recibos electrónicos
│
├── tests/                 # Pruebas unitarias
│   ├── test_terrenos.php  # Pruebas para terrenos
│   ├── test_clientes.php  # Pruebas para clientes
│   ├── test_pagos.php     # Pruebas para pagos
│   └── test_alertas.php   # Pruebas para alertas y calendario
│
└── docs/                  # Documentación
    ├── manual_usuario.pdf # Manual de usuario
    └── README.md          # Instrucciones para desarrolladores
