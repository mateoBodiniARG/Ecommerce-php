function validarMarca() {
    let nombreMarca = document.getElementById("nombre").value;

    // Realiza una solicitud al para verificar si la marca existe
    let solicitud = new XMLHttpRequest();
    solicitud.open("GET", "verificarMarca.php?nombre=" + nombreMarca, false);
    solicitud.send();
    
    // Si la marca existe, muestra un mensaje de error y no envía el formulario
    // Un estado 200 significa que la solicitud fue procesada correctamente por el servidor.
    if (solicitud.status == 200) {
        if (solicitud.responseText === "existe") {
            alert("Marca ya existente. Por favor, ingrese una nueva marca.");
            return false;
        }
    }
    return true;
}