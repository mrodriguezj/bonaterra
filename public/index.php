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
            <label for="precioTotal" class="form-label">Precio Total (USD)</label>
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
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
