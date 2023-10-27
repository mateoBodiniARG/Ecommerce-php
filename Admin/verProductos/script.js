// Función para manejar la acción de desactivar un producto
function desactivarProducto(id) {
    if (confirm("¿Seguro que deseas desactivar este producto?")) {
        // Ruta del archivo PHP que manejará la desactivación
        let url = "desactivarProducto.php?id=" + id;

        // Realizar la solicitud mediante Fetch 
        fetch(url, {
            method: "POST"
        })
        .then(data => {
            console.log(data);
            // Actualizar la página
            location.reload();
        })
        .catch(error => {
            console.error(error);
        });
    }
}

// Función para manejar la acción de activar un producto
function activarProducto(id) {
    if (confirm("¿Seguro que deseas activar este producto?")) {
        // Ruta del archivo PHP que manejará la activación
        let url = "activarProducto.php?id=" + id;

        // Realizar la solicitud mediante Fetch 
        fetch(url, {
            method: "POST"
        })
        .then(data => {
            console.log(data);
            // Actualizar la página
            location.reload();
        })
        .catch(error => {
            console.error(error);
        });
    }
}

