document.addEventListener("DOMContentLoaded", () => {
    const clienteSelect = document.getElementById("idCliente");
    const propiedadSelect = document.getElementById("idPropiedad");

    // Cargar clientes dinámicamente
    fetch("../app/controllers/obtener_clientes.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.clientes.forEach(cliente => {
                    const option = document.createElement("option");
                    option.value = cliente.id_cliente;
                    option.textContent = cliente.nombre;
                    clienteSelect.appendChild(option);
                });
            }
        });

    // Cargar propiedades dinámicamente
    fetch("../app/controllers/obtener_propiedades.php")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                data.propiedades.forEach(propiedad => {
                    const option = document.createElement("option");
                    option.value = propiedad.id_propiedad;
                    option.textContent = propiedad.nombre_propiedad;
                    propiedadSelect.appendChild(option);
                });
            }
        });
});
