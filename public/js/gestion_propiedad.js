document.addEventListener("DOMContentLoaded", () => {
    const btnVer = document.getElementById("btnVer");
    const btnEditar = document.getElementById("btnEditar");
    const btnGuardar = document.getElementById("btnGuardar");
    const btnCancelar = document.getElementById("btnCancelar");
    const formularioDatos = document.getElementById("formularioDatos");
    const modalMensaje = document.getElementById("modalMensaje");
    const resultadoModal = new bootstrap.Modal(document.getElementById("resultadoModal"));

    // Evento para el botón "Ver"
    btnVer.addEventListener("click", () => {
        const idPropiedad = document.getElementById("idPropiedad").value;

        if (!idPropiedad) {
            modalMensaje.textContent = "Por favor, ingresa un ID válido.";
            resultadoModal.show();
            return;
        }

        fetch(`../app/controllers/propiedad_controller.php?id=${idPropiedad}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Rellenar el formulario con los datos
                    formularioDatos.disabled = true;
                    document.getElementById("nombrePropiedad").value = data.propiedad.nombre_propiedad;
                    document.getElementById("ubicacion").value = data.propiedad.ubicacion;
                    document.getElementById("dimensiones").value = data.propiedad.dimensiones;
                    document.getElementById("precioTotal").value = data.propiedad.precio_total;
                    document.getElementById("disponibilidad").value = data.propiedad.disponibilidad;
                    document.getElementById("descripcion").value = data.propiedad.descripcion;

                    // Habilitar botón "Editar"
                    btnEditar.disabled = false;
                } else {
                    modalMensaje.textContent = "Propiedad no encontrada.";
                    resultadoModal.show();
                }
            })
            .catch(error => {
                modalMensaje.textContent = "Error en la consulta: " + error.message;
                resultadoModal.show();
            });
    });

    // Evento para el botón "Editar"
    btnEditar.addEventListener("click", () => {
        formularioDatos.disabled = false;
        btnGuardar.disabled = false;
        btnCancelar.disabled = false;
    });

    // Evento para el botón "Cancelar"
    btnCancelar.addEventListener("click", () => {
        formularioDatos.disabled = true;
        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
    });
});
