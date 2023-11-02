function validarMarca() {
    let nombreMarca = document.getElementById("nombre").value;

    // Realiza una solicitud al para verificar si la marca existe
    let solicitud = new XMLHttpRequest();
    solicitud.open("GET", "verificarMarca.php?nombre=" + nombreMarca, false); //false para que espere la respuesta del servidor antes de continuar con la ejecución del script 
    solicitud.send();
    
    //Si el estado de la solicitud es === a 200 (que la solicitud fue procesada correctamente por el servidor). muestra un mensaje de error y no envía el formulario
    if (solicitud.status == 200) {
        if (solicitud.responseText === "existe") {
            alert("Marca ya existente. Por favor, ingrese una nueva marca.");
            return false; //no envía el formulario
        }
    }
    return true;
}