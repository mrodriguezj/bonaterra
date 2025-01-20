document.addEventListener("DOMContentLoaded", () => {
    // Función genérica para validar un formulario
    function validarFormulario(form) {
        let isValid = true;

        // Validar campo Nombre (solo letras y espacios)
        const nombreInput = form.querySelector("[name='nombre']");
        if (nombreInput) {
            const nombreRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
            if (!nombreRegex.test(nombreInput.value)) {
                nombreInput.classList.add("is-invalid");
                isValid = false;
            } else {
                nombreInput.classList.remove("is-invalid");
            }
        }

        // Validar campo Teléfono (solo números)
        const telefonoInput = form.querySelector("[name='telefono']");
        if (telefonoInput) {
            const telefonoRegex = /^[0-9]+$/;
            if (!telefonoRegex.test(telefonoInput.value)) {
                telefonoInput.classList.add("is-invalid");
                isValid = false;
            } else {
                telefonoInput.classList.remove("is-invalid");
            }
        }

        return isValid;
    }

    // Asociar la validación a cada formulario
    const formularios = document.querySelectorAll("form");
    formularios.forEach((form) => {
        form.addEventListener("submit", (event) => {
            if (!validarFormulario(form)) {
                event.preventDefault(); // Evitar envío si hay errores
            }
        });
    });
});
