<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Cliente</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Agregar Nuevo Cliente</h2>
    <form id="formNuevoCliente" action="../app/controllers/cliente_controller.php" method="POST" class="mt-4">
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
        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
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

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="js/validaciones_cliente.js"></script>
<script>
    // Mostrar el modal si ?success=1 o ?error está en la URL
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const resultadoModal = new bootstrap.Modal(document.getElementById('resultadoModal'));
        const modalMensaje = document.getElementById('modalMensaje');

        if (urlParams.has('success')) {
            modalMensaje.textContent = "¡El cliente se agregó exitosamente!";
            resultadoModal.show();
        } else if (urlParams.has('error')) {
            modalMensaje.textContent = decodeURIComponent(urlParams.get('error'));
            resultadoModal.show();
        }
    });
</script>
</body>
</html>
