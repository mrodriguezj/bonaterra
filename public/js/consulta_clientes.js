document.addEventListener("DOMContentLoaded", () => {
    const inputBusqueda = document.getElementById("busquedaCliente");
    const listaSugerencias = document.getElementById("sugerencias");
    const formularioDatos = document.getElementById("formularioDatos");
    const btnEditar = document.getElementById("btnEditar");
    const btnGuardar = document.getElementById("btnGuardar");
    const btnCancelar = document.getElementById("btnCancelar");

    inputBusqueda.addEventListener("input", () => {
        const termino = inputBusqueda.value.trim();
        if (termino.length > 1) {
            fetch(`../app/controllers/cliente_busqueda.php?term=${encodeURIComponent(termino)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        mostrarSugerencias(data.data);
                    } else {
                        listaSugerencias.innerHTML = `<li class="list-group-item text-danger">Error: ${data.message}</li>`;
                    }
                });
        } else {
            listaSugerencias.innerHTML = "";
        }
    });

    function mostrarSugerencias(clientes) {
        listaSugerencias.innerHTML = "";
        clientes.forEach(cliente => {
            const li = document.createElement("li");
            li.textContent = `${cliente.nombre} - ${cliente.email}`;
            li.className = "list-group-item list-group-item-action";
            li.addEventListener("click", () => {
                llenarFormulario(cliente);
                listaSugerencias.innerHTML = "";
            });
            listaSugerencias.appendChild(li);
        });
    }

    function llenarFormulario(cliente) {
        document.getElementById("idCliente").value = cliente.id_cliente;
        document.getElementById("nombre").value = cliente.nombre;
        document.getElementById("email").value = cliente.email;
        document.getElementById("telefono").value = cliente.telefono;
        document.getElementById("direccion").value = cliente.direccion;
        document.getElementById("estadoCliente").value = cliente.estado_cliente;

        formularioDatos.disabled = true;
        btnEditar.disabled = false;
    }

    btnEditar.addEventListener("click", () => {
        formularioDatos.disabled = false;
        btnGuardar.disabled = false;
        btnCancelar.disabled = false;
    });

    btnCancelar.addEventListener("click", () => {
        formularioDatos.disabled = true;
        btnGuardar.disabled = true;
        btnCancelar.disabled = true;
    });
});
