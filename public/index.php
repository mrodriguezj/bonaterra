<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Propiedad</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Agregar Nueva Propiedad</h2>
    <form id="formAgregarPropiedad" action="../app/controllers/terrenos.php" method="POST" class="mt-4">
        <div class="mb-3">
            <label for="nombrePropiedad" class="form-label">Nombre de la Propiedad</label>
            <input type="text" class="form-control" id="nombrePropiedad" name="nombrePropiedad" required>
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <textarea class="form-control" id="ubicacion" name="ubicacion" rows="2" required></textarea>
        </div>
        <div class="mb-3">
            <label for="dimensiones" class="form-label">Dimensiones (m²)</label>
            <input type="number" step="0.01" class="form-control" id="dimensiones" name="dimensiones" required>
        </div>
        <div class="mb-3">
            <label for="precioTotal" class="form-label">Precio Total</label>
            <input type="number" step="0.01" class="form-control" id="precioTotal" name="precioTotal" required>
        </div>
        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select class="form-select" id="disponibilidad" name="disponibilidad" required>
                <option value="disponible">Disponible</option>
                <option value="vendida">Vendida</option>
                <option value="reservada">Reservada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Propiedad</button>
    </form>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Operación Exitosa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¡La propiedad se ha agregado exitosamente!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    // Mostrar el modal si ?success=1 está en la URL
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('success') === '1') {
            const successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }
    });
</script>
</body>
</html>
