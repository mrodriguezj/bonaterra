<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Propiedad</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Gestión de Propiedad</h2>
    <form id="formGestionPropiedad" action="../app/controllers/propiedad_controller.php" method="POST">
        <!-- Campo para buscar el ID -->
        <div class="mb-3">
            <label for="idPropiedad" class="form-label">ID de la Propiedad</label>
            <input type="number" class="form-control" id="idPropiedad" name="idPropiedad" required>
        </div>
        <!-- Botones principales -->
        <div class="d-flex justify-content-start mb-4">
            <button type="button" id="btnVer" class="btn btn-primary me-2">Ver</button>
            <button type="button" id="btnEditar" class="btn btn-warning me-2" disabled>Editar</button>
            <button type="submit" id="btnGuardar" class="btn btn-success me-2" disabled>Guardar</button>
            <button type="button" id="btnCancelar" class="btn btn-secondary" disabled>Cancelar</button>
        </div>
        <!-- Formulario de datos (bloqueado inicialmente) -->
        <fieldset id="formularioDatos" disabled>
            <div class="mb-3">
                <label for="nombrePropiedad" class="form-label">Nombre de la Propiedad</label>
                <input type="text" class="form-control" id="nombrePropiedad" name="nombrePropiedad">
            </div>
            <div class="mb-3">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <textarea class="form-control" id="ubicacion" name="ubicacion" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="dimensiones" class="form-label">Dimensiones (m²)</label>
                <input type="number" step="0.01" class="form-control" id="dimensiones" name="dimensiones">
            </div>
            <div class="mb-3">
                <label for="precioTotal" class="form-label">Precio Total</label>
                <input type="number" step="0.01" class="form-control" id="precioTotal" name="precioTotal">
            </div>
            <div class="mb-3">
                <label for="disponibilidad" class="form-label">Disponibilidad</label>
                <select class="form-select" id="disponibilidad" name="disponibilidad">
                    <option value="disponible">Disponible</option>
                    <option value="vendida">Vendida</option>
                    <option value="reservada">Reservada</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>
        </fieldset>
    </form>
</div>

<!-- Modal de resultados -->
<div class="modal fade" id="resultadoModal" tabindex="-1" aria-labelledby="resultadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultadoModalLabel">Resultado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modalMensaje"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Mensajes de éxito o error -->
<?php if (isset($_GET['success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalMensaje = document.getElementById('modalMensaje');
            modalMensaje.textContent = "¡La propiedad se actualizó exitosamente!";
            const resultadoModal = new bootstrap.Modal(document.getElementById('resultadoModal'));
            resultadoModal.show();
        });
    </script>
<?php elseif (isset($_GET['error'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalMensaje = document.getElementById('modalMensaje');
            modalMensaje.textContent = "<?php echo htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'); ?>";
            const resultadoModal = new bootstrap.Modal(document.getElementById('resultadoModal'));
            resultadoModal.show();
        });
    </script>
<?php endif; ?>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/gestion_propiedad.js"></script>
</body>
</html>
