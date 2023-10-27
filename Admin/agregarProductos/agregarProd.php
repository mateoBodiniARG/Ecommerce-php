<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleErrors.css">
    <title>Agregar Producto</title>
</head>
<body>
   <?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $precio = $_POST["precio"];
    $imagen = $_POST["imagen"];
    $stock = $_POST["stock"];
    $id_marca = $_POST["Marca"];


    // Conexión a la base de datos
    include('../../config/config.php');


    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para verificar si el producto ya existe por nombre
    $verificar_producto = "SELECT id FROM productos WHERE nombre = '$nombre'";
    $resultado = $conexion->query($verificar_producto);
    
    if ($resultado->num_rows >= 1) {
        // El producto ya existe, muestra un mensaje de error
        echo "
        <div class='error-container'>
        <p class='error-mensaje'>El producto con el nombre '$nombre' ya existe.</p>
        <a href='./index.php'>Volver a intentar</a>
        </div>
        ";
    } else if ($precio <= 0 or $stock <= 0) {
        echo "
        <div class='error-container'>
        <p class='error-mensaje'>El stock y el precio no pueden ser iguales o menores a 0</p> 
        <a href='./index.php'>Volver a intentar</a>
        </div>
        ";
    } 
    else {
        // El producto no existe, procede a insertarlo
        $consulta = "INSERT INTO productos (nombre, precio, imagen, stock, id_marca) VALUES ('$nombre', '$precio', '$imagen', '$stock','$id_marca')";

        if ($conexion->query($consulta) === TRUE) {
            // Producto agregado con éxito, redirigir a la página de administración
            header("Location: ../panelAdmin.php");
        } else {
            echo "Error al agregar el producto: " . $conexion->error;
        }
    }

    $conexion->close();
}
?> 
</body>
</html>
