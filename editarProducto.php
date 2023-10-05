<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["producto"];

    // Conexión a la base de datos (reemplaza con tus propios detalles)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener los detalles del producto seleccionado
    $consulta = "SELECT * FROM productos WHERE id = $id_producto";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows == 1) {
        $fila = $resultado->fetch_assoc();

        // Aquí puedes generar el formulario de edición con los campos de nombre, precio, imagen, etc.
        echo '<h2>Modificar Producto</h2>';
        echo '<form method="post" action="guardar_modificacion.php">';
        echo '<input type="hidden" name="id_producto" value="' . $fila['id'] . '">';
        echo '<label for="nombre">Nombre:</label>';
        echo '<input type="text" name="nombre" value="' . $fila['nombre'] . '" required><br>';
        echo '<label for="precio">Precio:</label>';
        echo '<input type="text" name="precio" value="' . $fila['precio'] . '" required><br>';
        echo '<label for="imagen">URL de la Imagen:</label>';
        echo '<input type="text" name="imagen" value="' . $fila['imagen'] . '" required><br>';
        echo '<input type="submit" value="Guardar Modificaciones">';
        echo '</form>';
    } else {
        echo "Producto no encontrado.";
    }

    $conexion->close();
} else {
    header("Location: modificarProducto.php"); 
}
?>