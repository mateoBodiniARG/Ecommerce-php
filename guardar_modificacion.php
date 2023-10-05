<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_producto = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];

    // Conexión a la base de datos (reemplaza con tus propios detalles)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para actualizar los datos del producto
    $consulta = "UPDATE productos SET nombre = '$nombre', precio = '$precio', imagen = '$imagen' WHERE id = $id_producto";

    if ($conexion->query($consulta) === TRUE) {
        // La actualización fue exitosa, redirigir de nuevo a modificarProducto.php
        header("Location: modificarProducto.php");
    } else {
        echo "Error al actualizar el producto: " . $conexion->error;
    }

    $conexion->close();
} else {
    header("Location: modificarProducto.php"); 
}
?>
