document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("formNuevoCliente");
    const nombreInput = document.getElementById("nombre");
    const telefonoInput = document.getElementById("telefono");

    form.addEventListener("submit", (event) => {
        let isValid = true;

        // Validar el campo Nombre (solo letras y espacios)
        const nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        if (!nombreRegex.test(nombreInput.value)) {
            nombreInput.classList.add("is-invalid");
            isValid = false;
        } else {
            nombreInput.classList.remove("is-invalid");
        }

        // Validar el campo Teléfono (solo números)
        const telefonoRegex = /^[0-9]+$/;
        if (!telefonoRegex.test(telefonoInput.value)) {
            telefonoInput.classList.add("is-invalid");
            isValid = false;
        } else {
            telefonoInput.classList.remove("is-invalid");
        }

        // Si hay errores, evitar el envío del formulario
        if (!isValid) {
            event.preventDefault();
        }
    });
});
