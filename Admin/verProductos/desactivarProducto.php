<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login-logout/login.php");
    exit;
}

include('../../config/config.php');


// Obtener el ID del producto a desactivar, que debe pasar por la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Actualiza el campo "activo" del producto a 0 (inactivo)
    $sql = "UPDATE productos SET activo = 0 WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto desactivado exitosamente.";
    } else {
        echo "Error al desactivar el producto: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}

header("Location: verProductos.php"); 
