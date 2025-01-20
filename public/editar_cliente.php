<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Editar Cliente</h2>
    <div class="mb-3 position-relative">
        <label for="busquedaCliente" class="form-label">Buscar Cliente por Nombre</label>
        <input type="text" class="form-control" id="busquedaCliente" placeholder="Escribe un nombre">
        <ul id="sugerencias" class="list-group position-absolute w-100" style="z-index: 1000;"></ul>
    </div>

    <form id="formEditarCliente" action="../app/controllers/editar_cliente_controller.php" method="POST">
        <!-- Campos del cliente -->
        <input type="hidden" id="idCliente" name="idCliente">
        <fieldset id="formularioDatos" disabled>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
                <div class="invalid-feedback">El nombre solo puede contener letras y espacios.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
                <div class="invalid-feedback">El teléfono solo puede contener números.</div>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea class="form-control" id="direccion" name="direccion" rows="2"></textarea>
            </div>
            <div class="mb-3">
                <label for="estadoCliente" class="form-label">Estado del Cliente</label>
                <select class="form-select" id="estadoCliente" name="estadoCliente" required>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="moroso">Moroso</option>
                </select>
            </div>
        </fieldset>

        <!-- Botones -->
        <div class="d-flex justify-content-start">
            <button type="button" id="btnEditar" class="btn btn-warning me-2" disabled>Editar</button>
            <button type="submit" id="btnGuardar" class="btn btn-success me-2" disabled>Guardar</button>
            <button type="button" id="btnCancelar" class="btn btn-secondary" disabled>Cancelar</button>
        </div>
    </form>
</div>

<!-- Modal de resultado -->
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

<?php if (isset($_GET['success'])): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modalMensaje = document.getElementById('modalMensaje');
            modalMensaje.textContent = "¡El cliente se actualizó exitosamente!";
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
<script src="js/consulta_clientes.js"></script>
<script src="js/validaciones_cliente.js"></script>
</body>
</html>
