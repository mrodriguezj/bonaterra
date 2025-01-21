<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Venta</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Registrar Venta</h2>
    <form id="formRegistroVenta" action="../app/controllers/registro_venta_controller.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="idCliente" class="form-label">Cliente</label>
            <select class="form-select" id="idCliente" name="idCliente" required>
                <option value="">Seleccione un cliente</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3">
            <label for="idPropiedad" class="form-label">Propiedad</label>
            <select class="form-select" id="idPropiedad" name="idPropiedad" required>
                <option value="">Seleccione una propiedad</option>
                <!-- Opciones cargadas dinámicamente -->
            </select>
        </div>
        <div class="mb-3">
            <label for="precioTotal" class="form-label">Precio Total (USD)</label>
            <input type="number" step="0.01" class="form-control" id="precioTotal" name="precioTotal" required>
        </div>
        <div class="mb-3">
            <label for="fechaVenta" class="form-label">Fecha de Venta</label>
            <input type="date" class="form-control" id="fechaVenta" name="fechaVenta" required>
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea class="form-control" id="detalles" name="detalles" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Venta</button>
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
<script>
    // Mostrar el modal con mensajes basados en parámetros en la URL
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const resultadoModal = new bootstrap.Modal(document.getElementById('resultadoModal'));
        const modalMensaje = document.getElementById('modalMensaje');

        if (urlParams.has('success')) {
            modalMensaje.textContent = "¡Venta registrada exitosamente!";
            resultadoModal.show();
        } else if (urlParams.has('error')) {
            modalMensaje.textContent = decodeURIComponent(urlParams.get('error'));
            resultadoModal.show();
        }

        // Cargar dinámicamente los clientes
        fetch("../app/controllers/obtener_clientes.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const clienteSelect = document.getElementById("idCliente");
                    data.clientes.forEach(cliente => {
                        const option = document.createElement("option");
                        option.value = cliente.id_cliente;
                        option.textContent = cliente.nombre;
                        clienteSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error("Error al cargar clientes:", error));

        // Cargar dinámicamente las propiedades
        fetch("../app/controllers/obtener_propiedades.php")
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const propiedadSelect = document.getElementById("idPropiedad");
                    data.propiedades.forEach(propiedad => {
                        const option = document.createElement("option");
                        option.value = propiedad.id_propiedad;
                        option.textContent = propiedad.nombre_propiedad;
                        propiedadSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error("Error al cargar propiedades:", error));
    });
</script>
</body>
</html>
